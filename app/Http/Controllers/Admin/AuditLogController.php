<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user')
            ->latest('Change_Date')
            ->paginate(25);

        return view('admin.audit.index', compact('logs'));
    }
}
