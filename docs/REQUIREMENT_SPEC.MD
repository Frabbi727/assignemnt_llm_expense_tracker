# REQUIREMENT_SPEC.MD - Expense Tracker Web App

## 1. Project Overview
The **Expense Tracker Web App** is a responsive, full-stack Laravel application designed to simplify personal and professional financial tracking. The system supports manual expense entry, dynamic category management, automated AI/OCR receipt parsing, and flexible date-range analytical reporting.

---

## 2. Core Functional Requirements

### 2.1. Expense Management
* **Manual Entry:** Users must be able to log expenses with the following mandatory fields:
    * `Amount` (Decimal)
    * `Date` (Date picker, defaults to current date)
    * `Category` (Dropdown selection)
    * `Description/Merchant` (String, optional)
* **Dynamic Category Creation:** During manual entry, if a user types a category that does not exist in the system, the application must dynamically create and assign that new category on the fly without breaking the entry workflow.

### 2.2. Automated Receipt Processing (AI/OCR)
* **File Upload:** Users can upload file attachments (PNG, JPEG, PDF screenshots).
* **Zen Integration AI Skill:** Upon upload, a specialized backend service passes the file to a vision-capable open-code model hosted via **Zen**.
* **Data Extraction:** The AI model must parse the image and return a structured JSON payload containing:
    * `amount`
    * `date`
    * `merchant`
* **Form Pre-filling:** The web UI must automatically populate the expense entry form fields with the extracted AI data for the user to review and confirm before saving to the database.

### 2.3. Analytics & Reporting Dashboard
* **Month-Wise Summaries:** The dashboard must display aggregated cost metrics broken down by month.
* **Custom Date Filters:** Users can input custom `start_date` and `end_date` ranges to filter metrics dynamically.
* **Category-Specific Analysis:** Visual breakdowns showing total expenditures grouped by specific categories within the selected timeframe.

---

## 3. Tech Stack Constraints
* **Framework:** Full-Stack Laravel (Blade Templates + Tailwind CSS + Livewire for reactive UI components).
* **Database:** PostgreSQL / MySQL handled via Eloquent ORM.
* **Storage:** Laravel File Storage abstraction (local public disk or Docker volumes) for uploaded receipt media.
* **AI Engine:** Zen Open-Code Model APIs for OCR processing.

---

## 4. User Acceptance Criteria
* **AC 1:** A user can successfully add an expense using a newly typed category without refreshing the page.
* **AC 2:** Uploading a clear receipt screenshot auto-fills the expense form within 5 seconds.
* **AC 3:** Changing the custom date filter on the dashboard instantly re-calculates the totals displayed on the page.
