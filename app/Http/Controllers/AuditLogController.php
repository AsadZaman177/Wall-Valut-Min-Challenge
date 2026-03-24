<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::all();

        if ($request->ajax()) {
            $logs = AuditLog::orderBy('created_at', 'desc');

            // Filter by client
            if ($request->filled('client_id')) {
                $logs->where('new_values->client', 'like', '%' . $request->client_id . '%')
                     ->orWhere('old_values->client', 'like', '%' . $request->client_id . '%');
            }

            // Filter by action
            if ($request->filled('action')) {
                $logs->where('action', $request->action);
            }

            return DataTables::of($logs->get())
                ->addIndexColumn()
                ->editColumn('client', function($log) {
                    // Try to get client from new_values first
                    if(isset($log->new_values['client'])) return $log->new_values['client'];
                    if(isset($log->old_values['client'])) return $log->old_values['client'];
                    return 'N/A';
                })
                ->editColumn('old_values', function($log) {
                    return '<pre>'.json_encode($log->old_values, JSON_PRETTY_PRINT).'</pre>';
                })
                ->editColumn('new_values', function($log) {
                    return '<pre>'.json_encode($log->new_values, JSON_PRETTY_PRINT).'</pre>';
                })
                ->rawColumns(['old_values','new_values'])
                ->make(true);
        }

        return view('audit_logs.index', compact('clients'));
    }
}
