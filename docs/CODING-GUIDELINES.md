### File 3: `CODING-GUIDELINES.md`
```markdown
# CODING-GUIDELINES.md - Production Standards

## 1. Code Convention & Styling
* **Naming Structures:** Tables use lower_snake_case (`expenses`). Models use PascalCase (`Expense`). Livewire UI uses kebab-case (`expense-form.blade.php`).
* **Type Management:** Strict parameter typing and method return definitions must be declared on every method.

## 2. Database & State Integrity
* **Mass Assignment:** Protect models explicitly with fillable attribute arrays.
* **N+1 Performance Mitigation:** Dashboard collection iterations must enforce relationship eager loading (`Expense::with('category')->get()`).
* **Real-time Atomic Entry:** Utilize `Category::firstOrCreate()` when handling real-time runtime submissions to prevent race conditions or integrity faults.
