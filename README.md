# Expense Tracker Web App

A responsive, full-stack Laravel application designed for personal and professional financial tracking. Features include manual expense entry, dynamic category management, and AI-powered (mocked) receipt parsing.

## 🚀 Core Features

- **Manual Expense Entry**: Log expenses with amount, date, category, and description.
- **Dynamic Categories**: Automatically create new categories on the fly during expense entry.
- **AI/OCR Receipt Processing (Mocked)**: Upload receipt images to automatically extract and pre-fill form data.
- **Analytical Dashboard**: 
    - Month-wise expense summaries.
    - Category-specific expenditure breakdowns.
    - Real-time date range filtering.
- **Reactive UI**: Built with Livewire for a seamless, SPA-like experience without page refreshes.

## 🛠 Tech Stack

- **Framework**: [Laravel 13.x](https://laravel.com)
- **Frontend**: [Livewire 4.x](https://livewire.laravel.com) (TALL Stack)
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Database**: SQLite (Default) / PostgreSQL / MySQL
- **AI Engine**: Mocked Zen Open-Code Model for OCR.

## 📂 Project Structure & File Map

### 🧩 Core Documentation (`/docs`)
- **`REQUIREMENT_SPEC.MD`**: The foundational functional and technical requirements for the project.
- **`ARCHITECTURE.md`**: High-level system design, database schema, and relationship mapping.
- **`CODING-GUIDELINES.md`**: Production standards for naming, typing, and performance.
- **`AGENTS.MD`**: Multi-agent framework roles and escalation protocols for the development lifecycle.

### 🏗 Models & Database (`/app/Models`, `/database`)
- **`app/Models/Expense.php`**: Represents a single financial transaction. Handles relationships and data casting for dates/amounts.
- **`app/Models/Category.php`**: Manages unique expense tags.
- **`database/migrations/..._create_categories_table.php`**: Schema for the categories table.
- **`database/migrations/..._create_expenses_table.php`**: Schema for the expenses table with foreign key constraints.

### ⚡ Livewire Components (`/resources/views/components`)
*Using Livewire Single File Components (SFC) with the ⚡ prefix.*
- **`⚡expense-form.blade.php`**: Handles the logic and UI for adding expenses, including the AI receipt processing and dynamic category creation.
- **`⚡expense-dashboard.blade.php`**: Handles data aggregation, date filtering, and the display of summaries and the expense list.

### 🌐 Routing & Views
- **`routes/web.php`**: The main entry point for the web application.
- **`resources/views/welcome.blade.php`**: The main application layout where the Livewire components are integrated.

## 🛠 Setup Instructions

1. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

4. **Start Development Server**:
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` to view the app.

---
*Built as part of the LLM Agentic Coding Assignment.*
