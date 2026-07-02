<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $primaryKey = 'Section_ID';
    
    protected $fillable = [
        'Section_Name', 'Class_ID'
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'Class_ID', 'Class_ID');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'Section_ID', 'Section_ID');
    }
}