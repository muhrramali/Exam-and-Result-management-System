<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditService
{
    public function log(
        string $tableName,
        int $recordId,
        mixed $oldValue,
        mixed $newValue,
        ?string $reason = null
    ): void {
        AuditLog::create([
            'Table_Name' => $tableName,
            'Record_ID' => $recordId,
            'Old_Value' => is_string($oldValue) ? $oldValue : json_encode($oldValue),
            'New_Value' => is_string($newValue) ? $newValue : json_encode($newValue),
            'Changed_By' => Auth::id(),
            'Change_Date' => now(),
            'Reason' => $reason,
        ]);
    }
}
