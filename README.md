# Exam & Result Management System

Laravel application for the full school examination workflow: schedule exams per class and subject, enter marks, calculate grades from configurable scales, generate result cards with pass/fail and class rank, publish results, handle re-check requests, and audit mark corrections.

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL (recommended) or SQLite

## Quick start (final submission)

```bash
cd school-management
composer install
cp .env.example .env
php artisan key:generate
```

Configure MySQL in `.env`, then:

```bash
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

Visit: **http://127.0.0.1:8000/login**

See **[SUBMISSION_GUIDE.md](SUBMISSION_GUIDE.md)** for viva demo steps and requirement checklist.

## Demo accounts

| Role    | Email              | Password |
|---------|--------------------|----------|
| Admin   | admin@school.com   | password |
| Student | student@school.com | password |

**Demo student:** Ali Hassan — Class 9-A (Midterm + Annual results published; re-check dropdown ready).

## Seeded data

- **Classes 1–12** with sections A/B/C  
- **Midterm Examination 2025-26** and **Annual Examination 2025-26**  
- Exam schedules for all class–subject combinations  
- Sample marks, generated results, and published cards for the demo student  

## Features

- Exam scheduling (class × subject)  
- Student marks entry with auto grade/percentage  
- Configurable grading scales  
- Pass/fail, class rank, generate & publish result cards  
- Printable individual result cards  
- Class-wise performance summary  
- Mark corrections with audit trail  
- Student re-check requests (admin approve/reject)  

## Roles

- **Admin:** Full examination and result management  
- **Student:** Published results and re-check requests  
