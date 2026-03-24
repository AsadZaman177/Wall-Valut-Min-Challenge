<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Client;
use App\Models\Report;
use App\Models\ServiceLog;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //index
    public function index(){
        $data = [];
        $data['users'] = User::where('crp_id', auth()->user()->crp_id)->count();
        $data['clients'] = Client::count();
        $data['service_logs'] = ServiceLog::count();
        $data['audit_logs'] = AuditLog::count();
        return view('dashboard',compact('data'));
    }
}
