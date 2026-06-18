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

### Option 1: Local Setup (Manual)
1. **Install Dependencies**: `composer install` and `npm install`.
2. **Environment Setup**: `cp .env.example .env` and `php artisan key:generate`.
3. **Run Migrations**: `php artisan migrate`.
4. **Start Development Server**: `php artisan serve`.

### Option 2: Docker Setup (Recommended)
This project uses **Laravel Sail** for Docker-based development.
1. **Start Docker Containers**:
   ```bash
   ./vendor/bin/sail up -d
   ```
   *Note: Sail automatically uses the generated `compose.yaml` file.*
2. **Install Dependencies (if needed)**:
   ```bash
   ./vendor/bin/sail composer install
   ./vendor/bin/sail npm install
   ```
3. **Run Migrations**:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```
4. **Access the App**: The app will be available at `http://localhost`.
5. **Stop Containers**: `./vendor/bin/sail stop`.

---
*Built as part of the LLM Agentic Coding Assignment.*


1. Start the Docker Containers
  This will start the web server, database, and other services in the background.
   1 ./vendor/bin/sail up -d

  2. Install Dependencies (if not already done)
  Ensure both PHP and Node.js packages are installed inside the container.
   1 ./vendor/bin/sail composer install
   2 ./vendor/bin/sail npm install

  3. Setup Database
  Run the migrations to create the tables and seed the database with initial data.

   1 ./vendor/bin/sail artisan migrate --seed

  4. Build Frontend Assets
  Compile the CSS and JavaScript (Tailwind and Livewire assets).

   1 ./vendor/bin/sail npm run build


 http://localhost:8080
