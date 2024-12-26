<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate   = $request->get('end_date', now()->endOfMonth());

        $logs = ActivityLog::with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        return view('logs.index', compact('logs', 'startDate', 'endDate'));
    }
}
