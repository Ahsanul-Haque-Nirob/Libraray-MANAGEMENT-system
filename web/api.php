<?php
session_start();
header('Content-Type: application/json');

const ADMIN_EMAILS = ['admin@library.com'];
const LOAN_DAYS = 14;
const FINE_PER_DAY = 5.00;

function respond($data, int $code = 200): void
{
    http_response_code($code);
    echo json_encode($data);
    exit;
}

function fail(string $message, int $code = 400): void
{
    respond(['error' => $message], $code);
}

$config = (is_file(__DIR__ . '/config.php') ? require __DIR__ . '/config.php' : []) + [
    'host' => '127.0.0.1',
    'port' => 3307,
    'database' => 'library_management',
    'username' => 'root',
    'password' => '',
];

try {
    $db = new PDO(
        "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8mb4",
        $config['username'],
        $config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    fail('Database connection failed. Check the settings in config.php.', 500);
}

$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true) ?? [];
$method = $_SERVER['REQUEST_METHOD'];

function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

function requireUser(): array
{
    $user = currentUser();
    if (!$user) fail('Please log in first.', 401);
    return $user;
}

function requireAdmin(): array
{
    $user = requireUser();
    if (!$user['is_admin']) fail('Admins only.', 403);
    return $user;
}

function findOrCreateMember(PDO $db, string $name, string $email, ?string $phone = null): int
{
    $stmt = $db->prepare('SELECT id FROM members WHERE email = ? AND deleted_at IS NULL');
    $stmt->execute([$email]);
    $id = $stmt->fetchColumn();
    if ($id) return (int) $id;

    $stmt = $db->prepare(
        'INSERT INTO members (member_code, name, email, phone, membership_start, membership_end, status, created_at, updated_at)
         VALUES (?, ?, ?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 YEAR), "active", NOW(), NOW())'
    );
    $stmt->execute(['LIB-' . strtoupper(uniqid()), $name, $email, $phone]);
    return (int) $db->lastInsertId();
}

function sessionUser(PDO $db, array $row): array
{
    $user = [
        'id' => (int) $row['id'],
        'name' => $row['name'],
        'email' => $row['email'],
        'is_admin' => in_array(strtolower($row['email']), ADMIN_EMAILS, true),
        'member_id' => findOrCreateMember($db, $row['name'], $row['email']),
    ];
    session_regenerate_id(true);
    $_SESSION['user'] = $user;
    return $user;
}

function markOverdue(PDO $db): void
{
    $db->exec('UPDATE borrow_records SET status = "overdue" WHERE status = "borrowed" AND due_date < CURDATE()');
}

const ENTITIES = [
    'books' => [
        'soft' => true,
        'fields' => ['title', 'isbn', 'author_id', 'category_id', 'description', 'publisher', 'published_year', 'total_copies'],
        'required' => ['title', 'isbn', 'author_id', 'category_id', 'total_copies'],
    ],
    'authors' => [
        'soft' => true,
        'fields' => ['name', 'email', 'nationality', 'birth_date', 'bio'],
        'required' => ['name'],
    ],
    'categories' => [
        'soft' => false,
        'fields' => ['name', 'description'],
        'required' => ['name'],
    ],
    'members' => [
        'soft' => true,
        'fields' => ['name', 'email', 'phone', 'address', 'membership_start', 'membership_end', 'status'],
        'required' => ['name', 'email', 'membership_start', 'membership_end', 'status'],
    ],
];

function cleanInput(array $config, array $input): array
{
    $data = [];
    foreach ($config['fields'] as $field) {
        $value = is_string($input[$field] ?? null) ? trim($input[$field]) : ($input[$field] ?? null);
        $data[$field] = ($value === '' ? null : $value);
    }
    foreach ($config['required'] as $field) {
        if ($data[$field] === null) fail(ucfirst(str_replace('_', ' ', $field)) . ' is required.');
    }
    if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) fail('Email is not valid.');
    return $data;
}

function borrowFor(PDO $db, int $memberId, int $bookId): string
{
    $db->beginTransaction();
    $stmt = $db->prepare('SELECT name, status FROM members WHERE id = ? AND deleted_at IS NULL');
    $stmt->execute([$memberId]);
    $member = $stmt->fetch();
    if (!$member) {
        $db->rollBack();
        fail('Member not found.', 404);
    }
    if ($member['status'] !== 'active') {
        $db->rollBack();
        fail("Membership of {$member['name']} is not active.");
    }

    $stmt = $db->prepare('SELECT title, available_copies FROM books WHERE id = ? AND deleted_at IS NULL FOR UPDATE');
    $stmt->execute([$bookId]);
    $book = $stmt->fetch();
    if (!$book) {
        $db->rollBack();
        fail('Book not found.', 404);
    }
    if ((int) $book['available_copies'] < 1) {
        $db->rollBack();
        fail('No copies of this book are available right now.');
    }

    $stmt = $db->prepare('SELECT 1 FROM borrow_records WHERE member_id = ? AND book_id = ? AND status IN ("borrowed","overdue")');
    $stmt->execute([$memberId, $bookId]);
    if ($stmt->fetchColumn()) {
        $db->rollBack();
        fail("{$member['name']} already has this book borrowed.");
    }

    $db->prepare(
        'INSERT INTO borrow_records (book_id, member_id, borrow_date, due_date, status, fine_amount, created_at, updated_at)
         VALUES (?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL ' . LOAN_DAYS . ' DAY), "borrowed", 0, NOW(), NOW())'
    )->execute([$bookId, $memberId]);
    $db->prepare(
        'UPDATE books SET available_copies = available_copies - 1,
                status = IF(available_copies = 0, "unavailable", "available"), updated_at = NOW()
         WHERE id = ?'
    )->execute([$bookId]);
    $db->commit();

    return "\"{$book['title']}\" issued to {$member['name']}. Due in " . LOAN_DAYS . ' days.';
}

const BORROW_SELECT = '
    SELECT br.id, br.book_id, br.member_id, br.borrow_date, br.due_date, br.return_date, br.status,
           br.fine_amount, b.title AS book_title, m.name AS member_name, m.member_code,
           DATEDIFF(br.due_date, CURDATE()) AS days_left
    FROM borrow_records br
    JOIN books b ON b.id = br.book_id
    JOIN members m ON m.id = br.member_id';

switch ($action) {
    case 'me':
        respond(['user' => currentUser()]);

    case 'login':
        if ($method !== 'POST') fail('POST required', 405);
        $email = trim($input['email'] ?? '');
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row || !password_verify($input['password'] ?? '', $row['password'])) {
            fail('Invalid email or password.', 401);
        }
        respond(['user' => sessionUser($db, $row)]);

    case 'register':
        if ($method !== 'POST') fail('POST required', 405);
        $name = trim($input['name'] ?? '');
        $email = strtolower(trim($input['email'] ?? ''));
        $phone = trim($input['phone'] ?? '') ?: null;
        $password = $input['password'] ?? '';
        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) fail('Valid name and email are required.');
        if (strlen($password) < 6) fail('Password must be at least 6 characters.');

        $stmt = $db->prepare('SELECT 1 FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetchColumn()) fail('This email is already registered. Please sign in.');

        $db->beginTransaction();
        $stmt = $db->prepare('INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())');
        $stmt->execute([$name, $email, password_hash($password, PASSWORD_BCRYPT)]);
        $userId = (int) $db->lastInsertId();
        findOrCreateMember($db, $name, $email, $phone);
        $db->commit();

        respond(['user' => sessionUser($db, ['id' => $userId, 'name' => $name, 'email' => $email])]);

    case 'logout':
        $_SESSION = [];
        session_destroy();
        respond(['ok' => true]);

    case 'stats':
        $user = requireUser();
        markOverdue($db);
        $one = function (string $sql, array $params = []) use ($db): int {
            $s = $db->prepare($sql);
            $s->execute($params);
            return (int) $s->fetchColumn();
        };
        respond([
            'books' => $one('SELECT COUNT(*) FROM books WHERE deleted_at IS NULL'),
            'available_books' => $one('SELECT COUNT(*) FROM books WHERE deleted_at IS NULL AND available_copies > 0'),
            'authors' => $one('SELECT COUNT(*) FROM authors WHERE deleted_at IS NULL'),
            'categories' => $one('SELECT COUNT(*) FROM categories'),
            'members' => $one('SELECT COUNT(*) FROM members WHERE deleted_at IS NULL'),
            'active_borrows' => $one('SELECT COUNT(*) FROM borrow_records WHERE status IN ("borrowed","overdue")'),
            'overdue' => $one('SELECT COUNT(*) FROM borrow_records WHERE status = "overdue"'),
            'my_borrows' => $one('SELECT COUNT(*) FROM borrow_records WHERE member_id = ? AND status IN ("borrowed","overdue")', [$user['member_id']]),
        ]);

    case 'books':
        requireUser();
        respond($db->query(
            'SELECT b.id, b.title, b.isbn, b.author_id, b.category_id, b.publisher, b.published_year,
                    b.total_copies, b.available_copies, b.description, a.name AS author, c.name AS category
             FROM books b
             LEFT JOIN authors a ON a.id = b.author_id
             LEFT JOIN categories c ON c.id = b.category_id
             WHERE b.deleted_at IS NULL
             ORDER BY b.title'
        )->fetchAll());

    case 'authors':
        requireUser();
        respond($db->query(
            'SELECT a.id, a.name, a.email, a.nationality, a.birth_date, a.bio, COUNT(b.id) AS book_count
             FROM authors a LEFT JOIN books b ON b.author_id = a.id AND b.deleted_at IS NULL
             WHERE a.deleted_at IS NULL GROUP BY a.id ORDER BY a.name'
        )->fetchAll());

    case 'categories':
        requireUser();
        respond($db->query(
            'SELECT c.id, c.name, c.description, COUNT(b.id) AS book_count
             FROM categories c LEFT JOIN books b ON b.category_id = c.id AND b.deleted_at IS NULL
             GROUP BY c.id ORDER BY c.name'
        )->fetchAll());

    case 'members':
        requireAdmin();
        respond($db->query(
            'SELECT id, member_code, name, email, phone, address, membership_start, membership_end, status
             FROM members WHERE deleted_at IS NULL ORDER BY name'
        )->fetchAll());

    case 'borrows':
        requireAdmin();
        markOverdue($db);
        respond($db->query(BORROW_SELECT . ' ORDER BY br.borrow_date DESC, br.id DESC')->fetchAll());

    case 'my_borrows':
        $user = requireUser();
        markOverdue($db);
        $stmt = $db->prepare(BORROW_SELECT . ' WHERE br.member_id = ? ORDER BY br.borrow_date DESC, br.id DESC');
        $stmt->execute([$user['member_id']]);
        respond($stmt->fetchAll());

    case 'borrow':
        if ($method !== 'POST') fail('POST required', 405);
        $user = requireUser();
        respond(['message' => borrowFor($db, $user['member_id'], (int) ($input['book_id'] ?? 0))]);

    case 'issue':
        if ($method !== 'POST') fail('POST required', 405);
        requireAdmin();
        respond(['message' => borrowFor($db, (int) ($input['member_id'] ?? 0), (int) ($input['book_id'] ?? 0))]);

    case 'save':
        if ($method !== 'POST') fail('POST required', 405);
        requireAdmin();
        $entity = $_GET['entity'] ?? '';
        if (!isset(ENTITIES[$entity])) fail('Unknown entity.', 404);
        $data = cleanInput(ENTITIES[$entity], $input);
        $id = (int) ($input['id'] ?? 0);

        if ($entity === 'books') {
            $data['total_copies'] = (int) $data['total_copies'];
            if ($data['total_copies'] < 1) fail('Total copies must be at least 1.');
            if ($id) {
                $stmt = $db->prepare('SELECT total_copies, available_copies FROM books WHERE id = ? AND deleted_at IS NULL');
                $stmt->execute([$id]);
                $old = $stmt->fetch() ?: fail('Book not found.', 404);
                $available = (int) $old['available_copies'] + $data['total_copies'] - (int) $old['total_copies'];
                if ($available < 0) fail('Total copies cannot be lower than the number of copies currently on loan.');
            } else {
                $available = $data['total_copies'];
            }
            $data['available_copies'] = $available;
            $data['status'] = $available > 0 ? 'available' : 'unavailable';
        } elseif ($entity === 'categories') {
            $data['slug'] = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($data['name'])), '-');
        } elseif ($entity === 'members') {
            if (!in_array($data['status'], ['active', 'inactive', 'suspended'], true)) fail('Invalid status.');
            if ($data['membership_end'] < $data['membership_start']) fail('Membership end must be after the start date.');
            if (!$id) $data['member_code'] = 'LIB-' . strtoupper(uniqid());
        }

        $columns = array_keys($data);
        try {
            if ($id) {
                $set = implode(', ', array_map(fn($c) => "`$c` = ?", $columns));
                $stmt = $db->prepare("UPDATE `$entity` SET $set, updated_at = NOW() WHERE id = ?");
                $stmt->execute([...array_values($data), $id]);
                if ($stmt->rowCount() === 0) {
                    $exists = $db->prepare("SELECT 1 FROM `$entity` WHERE id = ?");
                    $exists->execute([$id]);
                    if (!$exists->fetchColumn()) fail('Record not found.', 404);
                }
            } else {
                $cols = implode(', ', array_map(fn($c) => "`$c`", $columns));
                $marks = implode(', ', array_fill(0, count($columns), '?'));
                $db->prepare("INSERT INTO `$entity` ($cols, created_at, updated_at) VALUES ($marks, NOW(), NOW())")
                    ->execute(array_values($data));
                $id = (int) $db->lastInsertId();
            }
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                fail(str_contains($e->getMessage(), 'Duplicate')
                    ? 'A record with the same ' . ($entity === 'books' ? 'ISBN' : ($entity === 'categories' ? 'name' : 'email')) . ' already exists.'
                    : 'Invalid author or category selected.');
            }
            throw $e;
        }
        respond(['message' => 'Saved successfully.', 'id' => $id]);

    case 'delete':
        if ($method !== 'POST') fail('POST required', 405);
        requireAdmin();
        $entity = $_GET['entity'] ?? '';
        if (!isset(ENTITIES[$entity])) fail('Unknown entity.', 404);
        $id = (int) ($input['id'] ?? 0);

        $blockers = [
            'books' => ['SELECT COUNT(*) FROM borrow_records WHERE book_id = ? AND status <> "returned"', 'This book is currently on loan. Return it first.'],
            'members' => ['SELECT COUNT(*) FROM borrow_records WHERE member_id = ? AND status <> "returned"', 'This member still has borrowed books. Return them first.'],
            'authors' => ['SELECT COUNT(*) FROM books WHERE author_id = ? AND deleted_at IS NULL', 'This author still has books. Delete or reassign them first.'],
            'categories' => ['SELECT COUNT(*) FROM books WHERE category_id = ? AND deleted_at IS NULL', 'This category still has books. Move them to another category first.'],
        ];
        [$sql, $message] = $blockers[$entity];
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        if ((int) $stmt->fetchColumn() > 0) fail($message);

        $stmt = ENTITIES[$entity]['soft']
            ? $db->prepare("UPDATE `$entity` SET deleted_at = NOW() WHERE id = ? AND deleted_at IS NULL")
            : $db->prepare("DELETE FROM `$entity` WHERE id = ?");
        $stmt->execute([$id]);
        if ($stmt->rowCount() === 0) fail('Record not found.', 404);
        respond(['message' => 'Deleted successfully.']);

    case 'return':
        if ($method !== 'POST') fail('POST required', 405);
        $user = requireUser();
        $borrowId = (int) ($input['borrow_id'] ?? 0);

        $db->beginTransaction();
        $stmt = $db->prepare('SELECT * FROM borrow_records WHERE id = ? FOR UPDATE');
        $stmt->execute([$borrowId]);
        $record = $stmt->fetch();
        if (!$record || $record['status'] === 'returned') {
            $db->rollBack();
            fail('Active borrow record not found.', 404);
        }
        if ((int) $record['member_id'] !== $user['member_id'] && !$user['is_admin']) {
            $db->rollBack();
            fail('You can only return your own books.', 403);
        }

        $daysLate = max(0, (int) ((strtotime(date('Y-m-d')) - strtotime($record['due_date'])) / 86400));
        $fine = $daysLate * FINE_PER_DAY;

        $db->prepare('UPDATE borrow_records SET status = "returned", return_date = CURDATE(), fine_amount = ?, updated_at = NOW() WHERE id = ?')
            ->execute([$fine, $borrowId]);
        $db->prepare(
            'UPDATE books SET available_copies = LEAST(available_copies + 1, total_copies), status = "available", updated_at = NOW() WHERE id = ?'
        )->execute([$record['book_id']]);
        $db->commit();

        respond(['message' => $fine > 0 ? "Book returned. Late fine: " . number_format($fine, 2) : 'Book returned. Thank you!']);

    default:
        fail('Unknown action.', 404);
}
