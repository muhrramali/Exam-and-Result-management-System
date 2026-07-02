<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $primaryKey = 'Log_ID';
    protected $table = 'audit_logs';
    
    protected $fillable = [
        'Table_Name', 'Record_ID', 'Old_Value', 'New_Value',
        'Changed_By', 'Change_Date', 'Reason',
    ];

    protected $casts = [
        'Change_Date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'Changed_By');
    }
}