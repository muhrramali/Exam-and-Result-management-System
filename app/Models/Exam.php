<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $primaryKey = 'Exam_ID';
    
    protected $fillable = [
        'Exam_Name', 'Academic_Year_ID', 'Start_Date', 'End_Date',
    ];

    protected $casts = [
        'Start_Date' => 'date',
        'End_Date' => 'date',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'Academic_Year_ID', 'Year_ID');
    }

    public function examSchedules()
    {
        return $this->hasMany(ExamSchedule::class, 'Exam_ID', 'Exam_ID');
    }

    public function resultCards()
    {
        return $this->hasMany(ResultCard::class, 'Exam_ID', 'Exam_ID');
    }
}