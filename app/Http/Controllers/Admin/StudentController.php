<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'section.schoolClass'])
            ->orderBy('Roll_No')
            ->paginate(15);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create', [
            'sections' => Section::with('schoolClass')->orderBy('Class_ID')->get(),
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'Roll_No' => $request->Roll_No,
                'Full_Name' => $request->Full_Name,
                'Date_Of_Birth' => $request->Date_Of_Birth,
                'Gender' => $request->Gender,
                'Contact' => $request->Contact,
                'Section_ID' => $request->Section_ID,
            ]);
        });

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load(['user', 'section.schoolClass']);

        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $student->load('user');

        return view('admin.students.edit', [
            'student' => $student,
            'sections' => Section::with('schoolClass')->orderBy('Class_ID')->get(),
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        DB::transaction(function () use ($request, $student) {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $student->user->update($userData);

            $student->update([
                'Roll_No' => $request->Roll_No,
                'Full_Name' => $request->Full_Name,
                'Date_Of_Birth' => $request->Date_Of_Birth,
                'Gender' => $request->Gender,
                'Contact' => $request->Contact,
                'Section_ID' => $request->Section_ID,
            ]);
        });

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {
            $user = $student->user;
            $student->delete();
            $user?->delete();
        });

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
