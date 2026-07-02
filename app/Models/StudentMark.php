<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;

    protected $primaryKey = 'Marks_ID';
    protected $table = 'student_marks';
    
    protected $fillable = [
        'Student_ID', 'Schedule_ID', 'Obtained_Marks', 
        'Grade', 'Percentage'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_ID', 'Student_ID');
    }

    public function examSchedule()
    {
        return $this->belongsTo(ExamSchedule::class, 'Schedule_ID', 'Schedule_ID');
    }
}