<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $primaryKey = 'Subject_ID';
    
    protected $fillable = [
        'Subject_Code', 'Subject_Name', 'Credits'
    ];

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'Subject_ID', 'Subject_ID');
    }
}