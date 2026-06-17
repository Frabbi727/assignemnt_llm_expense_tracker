# ARCHITECTURE.md - Expense Tracker Web App

## 1. High-Level Architecture Pattern
This web application is built as a monolithic **Full-Stack Laravel Application** leveraging the **TALL Stack** layout (Tailwind CSS, Alpine.js, Laravel, and Livewire). 

* **Frontend Layer:** Reactive UI components built using **Laravel Livewire** to provide a Single Page Application (SPA) feel without the overhead of a separate frontend framework.
* **Backend Layer:** Traditional Laravel MVC architecture powering standard routing, business logic, validation, and file systems.
* **Database Layer:** Relational storage handled efficiently through **Laravel Eloquent ORM**.

---

## 2. Database Schema & Migrations
The application requires three primary tables with strict relational integrity.

### 2.1. `categories` Table
Stores unique tags used for organization.
* `id` (BigIncrements, Primary Key)
* `name` (String, Unique)
* `timestamps`

### 2.2. `expenses` Table
Stores individual core transaction logs.
* `id` (BigIncrements, Primary Key)
* `category_id` (UnsignedBigInteger, Foreign Key pointing to `categories.id` on delete cascade)
* `amount` (Decimal, 10, 2)
* `expense_date` (Date)
* `description` (String, Nullable)
* `receipt_path` (String, Nullable)
* `timestamps`

### 2.3. Eloquent Relationships
* **`Expense` Model:**
```php
public function category() {
    return $this->belongsTo(Category::class);
}
