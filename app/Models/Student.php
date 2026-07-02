<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'Student_ID';
    
    protected $fillable = [
        'user_id', 'Roll_No', 'Full_Name', 'Date_Of_Birth',
        'Gender', 'Contact', 'Section_ID',
    ];

    protected $casts = [
        'Date_Of_Birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'Section_ID', 'Section_ID');
    }

    public function studentMarks()
    {
        return $this->hasMany(StudentMark::class, 'Student_ID', 'Student_ID');
    }

    public function resultCards()
    {
        return $this->hasMany(ResultCard::class, 'Student_ID', 'Student_ID');
    }

    public function recheckRequests()
    {
        return $this->hasMany(RecheckRequest::class, 'Student_ID', 'Student_ID');
    }
}