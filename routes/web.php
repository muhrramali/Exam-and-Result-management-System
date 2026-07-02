<?php

use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\ClassSubjectController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamScheduleController;
use App\Http\Controllers\Admin\GradingScaleController;
use App\Http\Controllers\Admin\RecheckRequestController as AdminRecheckRequestController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ResultCardController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\StudentMarkController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\RecheckRequestController as StudentRecheckRequestController;
use App\Http\Controllers\Student\ResultController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('students', AdminStudentController::class);
        Route::resource('sections', SectionController::class)->except(['show']);
        Route::resource('classes', SchoolClassController::class)->except(['show']);
        Route::resource('subjects', SubjectController::class)->except(['show']);

        Route::get('/assignments/students', [AssignmentController::class, 'students'])->name('assignments.students');
        Route::patch('/assignments/students/{student}', [AssignmentController::class, 'updateStudentSection'])->name('assignments.students.update');

        Route::resource('class-subjects', ClassSubjectController::class)->only(['index', 'create', 'store', 'destroy']);

        Route::resource('exams', ExamController::class);
        Route::get('exams/{exam}/schedules', [ExamScheduleController::class, 'index'])->name('exams.schedules.index');
        Route::get('exams/{exam}/schedules/create', [ExamScheduleController::class, 'create'])->name('exams.schedules.create');
        Route::post('exams/{exam}/schedules', [ExamScheduleController::class, 'store'])->name('exams.schedules.store');
        Route::delete('exams/{exam}/schedules/{schedule}', [ExamScheduleController::class, 'destroy'])->name('exams.schedules.destroy');

        Route::get('schedules/{schedule}/marks', [StudentMarkController::class, 'index'])->name('marks.index');
        Route::post('schedules/{schedule}/marks', [StudentMarkController::class, 'store'])->name('marks.store');
        Route::patch('marks/{mark}/correct', [StudentMarkController::class, 'correct'])->name('marks.correct');

        Route::resource('grading-scales', GradingScaleController::class)->except(['show']);

        Route::get('results', [ResultCardController::class, 'index'])->name('results.index');
        Route::post('exams/{exam}/results/generate', [ResultCardController::class, 'generate'])->name('results.generate');
        Route::post('exams/{exam}/results/publish', [ResultCardController::class, 'publish'])->name('results.publish');
        Route::post('exams/{exam}/results/unpublish', [ResultCardController::class, 'unpublish'])->name('results.unpublish');

        Route::get('recheck-requests', [AdminRecheckRequestController::class, 'index'])->name('recheck.index');
        Route::patch('recheck-requests/{recheckRequest}', [AdminRecheckRequestController::class, 'update'])->name('recheck.update');

        Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit.index');

        Route::get('reports/class-summary', [ReportController::class, 'classSummary'])->name('reports.class-summary');
        Route::get('reports/result-card/{resultCard}', [ReportController::class, 'resultCard'])->name('reports.result-card');
    });

    Route::prefix('student')->middleware('role:student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/results', [ResultController::class, 'index'])->name('results.index');
        Route::get('/results/{resultCard}', [ResultController::class, 'show'])->name('results.show');
        Route::get('/recheck', [StudentRecheckRequestController::class, 'index'])->name('recheck.index');
        Route::post('/recheck', [StudentRecheckRequestController::class, 'store'])->name('recheck.store');
    });
});
