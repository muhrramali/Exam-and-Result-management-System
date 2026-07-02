<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultCard extends Model
{
    use HasFactory;

    protected $primaryKey = 'Result_ID';
    protected $table = 'result_cards';
    
    protected $fillable = [
        'Student_ID', 'Exam_ID', 'Academic_Year_ID',
        'Total_Marks', 'Percentage', 'Overall_Grade',
        'Class_Rank', 'Pass_Status', 'Is_Published',
    ];

    protected $casts = [
        'Pass_Status' => 'boolean',
        'Is_Published' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_ID', 'Student_ID');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'Exam_ID', 'Exam_ID');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'Academic_Year_ID', 'Year_ID');
    }
}