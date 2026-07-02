<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingScale extends Model
{
    use HasFactory;

    protected $primaryKey = 'Scale_ID';
    
    protected $fillable = [
        'Grade_Letter', 'Min_Percent', 'Max_Percent', 'Grade_Point'
    ];
}