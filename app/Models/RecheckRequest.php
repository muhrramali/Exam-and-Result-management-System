<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecheckRequest extends Model
{
    use HasFactory;

    protected $primaryKey = 'Request_ID';
    protected $table = 'recheck_requests';
    
    protected $fillable = [
        'Student_ID', 'Marks_ID', 'Reason', 'Status',
        'New_Marks', 'Request_Date',
    ];

    protected $casts = [
        'Request_Date' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_ID', 'Student_ID');
    }

    public function studentMark()
    {
        return $this->belongsTo(StudentMark::class, 'Marks_ID', 'Marks_ID');
    }
}