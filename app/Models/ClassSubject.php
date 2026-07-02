<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;

    protected $primaryKey = 'Class_Subject_ID';
    protected $table = 'class_subject';
    
    protected $fillable = [
        'Class_ID', 'Subject_ID', 'Teacher_ID'
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'Class_ID', 'Class_ID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'Subject_ID', 'Subject_ID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'Teacher_ID', 'Teacher_ID');
    }

    public function getRouteKeyName(): string
    {
        return 'Class_Subject_ID';
    }
}