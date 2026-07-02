<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'Schedule_ID';
    protected $table = 'exam_schedules';
    
    protected $fillable = [
        'Exam_ID', 'Class_ID', 'Subject_ID', 'Exam_Type_ID',
        'Exam_Date', 'Max_Marks', 'Duration_Minutes',
    ];

    protected $casts = [
        'Exam_Date' => 'date',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'Exam_ID', 'Exam_ID');
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'Class_ID', 'Class_ID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'Subject_ID', 'Subject_ID');
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'Exam_Type_ID', 'Exam_Type_ID');
    }

    public function studentMarks()
    {
        return $this->hasMany(StudentMark::class, 'Schedule_ID', 'Schedule_ID');
    }
}