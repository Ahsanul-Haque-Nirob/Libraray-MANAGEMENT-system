# Library Management System — Laravel 11

A full-featured Library Management System built with **Laravel 11**, **Bootstrap 5**, and **MySQL**.

---

## Features

| Module | Capabilities |
|--------|-------------|
| **Dashboard** | Stats overview, recent borrows, overdue list, popular books |
| **Books** | CRUD, search by title/ISBN/author, filter by category & status, cover image upload |
| **Authors** | CRUD, nationality & bio, view all books per author |
| **Categories** | CRUD, auto-slug generation, view books per category |
| **Members** | CRUD, member code auto-generation, membership dates, status management |
| **Borrow Records** | Issue books, return books, automatic fine calculation ($1/day), overdue detection |

---

## Requirements

- PHP **8.2+**
- Composer
- MySQL 8+ (or MariaDB)
- PHP extensions: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`

---

## Installation

### 1. Navigate to the project folder
```bash
cd "Library Management System/library-management"
```

### 2. Install dependencies
```bash
composer install
```

### 3. Copy environment file
```bash
cp .env.example .env
```

### 4. Generate application key
```bash
php artisan key:generate
```

### 5. Configure your database
Edit `.env` and set your MySQL credentials:
```
DB_DATABASE=library_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Create the database
```sql
CREATE DATABASE library_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7. Run migrations and seed
```bash
php artisan migrate --seed
```

### 8. Create storage link (for book cover images)
```bash
php artisan storage:link
```

### 9. Start the development server
```bash
php artisan serve
```

Visit **http://localhost:8000**

---

## Default Admin Credentials

| Field | Value |
|-------|-------|
| Email | admin@library.com |
| Password | password |

---

## Project Structure

```
library-management/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php
│   │   │   ├── BookController.php
│   │   │   ├── AuthorController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── MemberController.php
│   │   │   └── BorrowRecordController.php
│   │   └── Requests/
│   │       ├── BookRequest.php
│   │       ├── AuthorRequest.php
│   │       ├── CategoryRequest.php
│   │       ├── MemberRequest.php
│   │       └── BorrowRecordRequest.php
│   └── Models/
│       ├── Book.php
│       ├── Author.php
│       ├── Category.php
│       ├── Member.php
│       └── BorrowRecord.php
├── database/
│   ├── migrations/     # All table migrations
│   ├── seeders/        # Sample data seeders
│   └── factories/      # Model factories (Faker)
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── dashboard/
│   ├── books/
│   ├── authors/
│   ├── categories/
│   ├── members/
│   └── borrows/
└── routes/web.php
```

---

## Fine Calculation

- Fine rate: **$1.00 per overdue day**
- Fines are calculated automatically when a book is marked as returned
- Fine constant is in `BorrowRecord::FINE_PER_DAY`

---

## Screenshot Guide

| URL | Page |
|-----|------|
| `/` | Dashboard |
| `/books` | Book list with search & filters |
| `/books/create` | Add new book |
| `/authors` | Author list |
| `/categories` | Category cards |
| `/members` | Member list |
| `/borrows` | Borrow records |
| `/borrows/create` | Issue a book to a member |
