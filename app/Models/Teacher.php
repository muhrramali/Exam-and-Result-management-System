<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $primaryKey = 'Teacher_ID';
    
    protected $fillable = [
        'user_id', 'Full_Name', 'Qualification', 'Contact'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'Teacher_ID', 'Teacher_ID');
    }
}