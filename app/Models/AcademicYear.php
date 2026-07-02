<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $primaryKey = 'Year_ID';
    
    protected $fillable = [
        'Session', 'Start_Date', 'End_Date'
    ];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class, 'Academic_Year_ID', 'Year_ID');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'Academic_Year_ID', 'Year_ID');
    }

    public function resultCards()
    {
        return $this->hasMany(ResultCard::class, 'Academic_Year_ID', 'Year_ID');
    }
}