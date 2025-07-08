# Laravel Follow-up Skills Test V2

Please review the all of the concepts applied to complete this assessment. Although these were not part of the core requirements but I tried to cover as many concepts applicable for this task available in laravel.
---

## Features

- Product Management (Add, Edit, List)
- Persistent storage using JSON File & DB
- AJAX-based form submissions using jQuery
- Yajra DataTables integration with server-side processing
- Modal-based Create and Update forms using Laravel Components
- Access restriction to admin-authenticated users
- Route and request validation using Laravel Form Requests

---

### Laravel Fundamentals
- Controllers (RESTful & custom methods)
- Middleware for authentication and role-based access (`is_admin`)
- Blade templating with `@extends`, `@section`, and `@push`
- Laravel components (`x-product.add-product-modal`, `x-product.edit-product-modal`)
- Form Request Validation (`StoreProductRequest`, `UpdateProductRequest`)

### Frontend
- Bootstrap 5 for UI and modals
- jQuery and AJAX for asynchronous form submissions
- Real-time DataTables updates and form reset
- DataTables footer callback for live total summation
- Responsive modal popups for editing and adding

### JSON Storage (instead of DB)
- Products are stored and updated in a `products.json` file inside Laravel's storage system
- Custom helper methods to `readData()` and `writeData()`
- Auto-increment simulated via max ID lookup or UUID fallback

### DataTables
- Server-side processing
- Dynamic column rendering
- Custom footer sum via `footerCallback`
- Column customization: `orderable: false`, `searchable: false`

### Additional Tools and Practices
- Laravel UI auth scaffolding
- Middleware protection for admin-only access
- `.gitignore` optimized for Laravel + Vite + NPM + Composer
- Human-readable timestamps via `Carbon::diffForHumans()`

---

## 🛠 Requirements

- PHP 8.1+
- Composer
- Node.js + NPM
- Laravel 10+
- Laravel UI (`composer require laravel/ui`)
- Yajra DataTables (`composer require yajra/laravel-datatables-oracle`)

---

## 🧪 Setup Instructions

```bash
git clone https://github.com/your-username/laravel-product-dashboard.git
cd laravel-product-dashboard

# Install PHP dependencies
composer install

# Install frontend tooling
npm install
npm run dev

# Set up auth
php artisan ui bootstrap --auth
php artisan migrate

# Create storage symlink
php artisan storage:link

# Serve the app
php artisan serve