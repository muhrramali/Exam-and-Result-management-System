<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ResultCard;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Student::with('section.schoolClass')
            ->where('user_id', auth()->id())
            ->first();

        $latestResult = $student
            ? ResultCard::with('exam')
                ->where('Student_ID', $student->Student_ID)
                ->where('Is_Published', true)
                ->latest()
                ->first()
            : null;

        return view('student.dashboard', compact('student', 'latestResult'));
    }
}
