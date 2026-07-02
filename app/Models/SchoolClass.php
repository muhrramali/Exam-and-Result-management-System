<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $primaryKey = 'Class_ID';
    
    protected $fillable = [
        'Class_Name', 'Capacity', 'Academic_Year_ID'
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'Academic_Year_ID', 'Year_ID');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'Class_ID', 'Class_ID');
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'Class_ID', 'Class_ID');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'Section_ID'); // Indirect via sections
    }
}