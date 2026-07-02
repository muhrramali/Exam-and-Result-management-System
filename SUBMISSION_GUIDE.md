# Final Submission Guide — Exam & Result Management System

## 1. Run the project (examiner / viva)

```bash
cd school-management
composer install
cp .env.example .env
php artisan key:generate
# Configure MySQL in .env, then:
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

Open: **http://127.0.0.1:8000/login**

| Role    | Email              | Password |
|---------|--------------------|----------|
| Admin   | admin@school.com   | password |
| Student | student@school.com | password |

## 2. Demo data included after seed

- **Classes 1–12** with sections (A, B, C for most; A, B for 11–12)
- **8 subjects** (English, Math, Urdu, Islamiyat, Physics, Chemistry, Biology, Pakistan Studies)
- **Exams:** Midterm Examination 2025-26 & Annual Examination 2025-26
- **Schedules:** Every class × subject for both exams
- **Sample student:** Ali Hassan — Class 9-A with marks and **published** results for both exams

## 3. Viva demo flow (5–10 minutes)

### Admin

1. **Dashboard** — stats for exams, results, re-checks  
2. **Exams** — show Midterm + Annual  
3. **Open Annual** → Schedules → **Enter marks** for a class  
4. **Grading scales** — configurable A+ to F  
5. **Results** → Generate → **Publish**  
6. **Reports** → Class performance summary (pick Class 9 + exam)  
7. **Audit trail** — after a mark correction  
8. **Re-check** — approve/reject student requests  

### Student (Ali Hassan)

1. **My results** — Midterm + Annual published cards  
2. **Re-check** — dropdown lists subjects from both exams → submit request  
3. Admin approves → marks & rank update (audited)

## 4. Requirement checklist

| Feature | Where to show |
|---------|----------------|
| Exam scheduling (class × subject) | Admin → Exams → Schedules |
| Student marks per subject | Admin → Enter marks |
| Configurable grading | Admin → Grading scales |
| Pass/fail & class rank | Results → Generate |
| Publish result cards | Results → Publish |
| Individual result card | Results → Card / Student view |
| Class summary report | Class report |
| Mark correction + audit | Marks → correction + Audit trail |
| Re-check requests | Student submit / Admin Re-check |

## 5. If re-check dropdown is empty

Run: `php artisan migrate:fresh --seed`  
Student must have **published** results and marks (done by `DemoResultsSeeder`).

## 6. Project folders to submit

- `school-management/` (full Laravel app)
- `Normalization.sql` (ER / schema reference)
- `README.md` and this `SUBMISSION_GUIDE.md`
