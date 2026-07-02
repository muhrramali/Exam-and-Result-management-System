<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;

    protected $primaryKey = 'Exam_Type_ID';
    
    protected $fillable = [
        'Type_Name'
    ];
}