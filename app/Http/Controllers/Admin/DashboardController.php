<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\RecheckRequest;
use App\Models\ResultCard;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalStudents' => Student::count(),
            'activeExams' => Exam::where('End_Date', '>=', now())->count(),
            'publishedResults' => ResultCard::where('Is_Published', true)->count(),
            'pendingRechecks' => RecheckRequest::where('Status', 'Pending')->count(),
            'recentExams' => Exam::with('academicYear')->latest('Start_Date')->take(5)->get(),
        ]);
    }
}
