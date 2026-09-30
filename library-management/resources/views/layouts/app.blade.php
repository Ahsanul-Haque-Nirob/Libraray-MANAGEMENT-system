<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Library Management System')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #2c3e6b;
            --accent:  #e8a838;
        }

        body { background: #f4f6fb; font-family: 'Segoe UI', sans-serif; }

        /* ── Sidebar ── */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--primary);
            position: fixed;
            top: 0; left: 0;
            z-index: 1040;
            transition: transform .3s ease;
            display: flex;
            flex-direction: column;
        }

        #sidebar .brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        #sidebar .brand h5 { color: var(--accent); font-weight: 700; margin: 0; font-size: 1.1rem; }
        #sidebar .brand small { color: rgba(255,255,255,.5); font-size: .75rem; }

        #sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: .6rem 1.5rem;
            border-radius: 0;
            display: flex;
            align-items: center;
            gap: .65rem;
            font-size: .9rem;
            transition: background .2s, color .2s;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: rgba(255,255,255,.12);
            color: #fff;
        }
        #sidebar .nav-link i { font-size: 1rem; width: 20px; text-align: center; }

        #sidebar .nav-section {
            color: rgba(255,255,255,.35);
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 1rem 1.5rem .3rem;
        }

        /* ── Main ── */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ── */
        #topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: .75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* ── Cards ── */
        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.07);
        }
        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }

        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .card-header { background: #fff; border-bottom: 1px solid #f0f0f0; font-weight: 600; }

        /* Badges */
        .badge-available   { background: #d1fae5; color: #065f46; }
        .badge-unavailable { background: #fee2e2; color: #991b1b; }
        .badge-borrowed    { background: #dbeafe; color: #1e40af; }
        .badge-returned    { background: #d1fae5; color: #065f46; }
        .badge-overdue     { background: #fee2e2; color: #991b1b; }
        .badge-active      { background: #d1fae5; color: #065f46; }
        .badge-inactive    { background: #f3f4f6; color: #374151; }
        .badge-suspended   { background: #fef3c7; color: #92400e; }

        /* Table */
        .table th { font-size: .8rem; text-transform: uppercase; letter-spacing: .05em; color: #6b7280; border-bottom: 2px solid #e5e7eb; }
        .table td { vertical-align: middle; font-size: .9rem; }

        /* Page header */
        .page-header { padding: 1.5rem; background: #fff; border-bottom: 1px solid #e2e8f0; margin-bottom: 1.5rem; }
        .page-header h4 { margin: 0; font-weight: 700; color: var(--primary); }

        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<nav id="sidebar">
    <div class="brand">
        <h5><i class="bi bi-book-half me-2"></i>LibraryMS</h5>
        <small>Management System</small>
    </div>

    <ul class="nav flex-column pt-2 flex-grow-1">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li><span class="nav-section">Catalog</span></li>

        <li class="nav-item">
            <a href="{{ route('books.index') }}"
               class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                <i class="bi bi-journals"></i> Books
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('authors.index') }}"
               class="nav-link {{ request()->routeIs('authors.*') ? 'active' : '' }}">
                <i class="bi bi-person-lines-fill"></i> Authors
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('categories.index') }}"
               class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i> Categories
            </a>
        </li>

        <li><span class="nav-section">Circulation</span></li>

        <li class="nav-item">
            <a href="{{ route('members.index') }}"
               class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Members
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('borrows.index') }}"
               class="nav-link {{ request()->routeIs('borrows.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Borrow Records
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('borrows.create') }}"
               class="nav-link {{ request()->routeIs('borrows.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> Issue Book
            </a>
        </li>
    </ul>

    <div class="p-3" style="border-top:1px solid rgba(255,255,255,.1);">
        <small class="text-white-50">© {{ date('Y') }} LibraryMS</small>
    </div>
</nav>

<!-- Main Content -->
<div id="main-content">

    <!-- Topbar -->
    <div id="topbar" class="d-flex align-items-center justify-content-between">
        <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebarToggle">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div class="fw-semibold text-muted d-none d-md-block">@yield('breadcrumb', 'Dashboard')</div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary rounded-pill">Admin</span>
        </div>
    </div>

    <!-- Flash Messages -->
    <div class="px-4 pt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Page Content -->
    <main class="flex-grow-1 p-4">
        @yield('content')
    </main>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>
@stack('scripts')
</body>
</html>
