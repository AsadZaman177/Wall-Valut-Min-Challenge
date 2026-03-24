<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //index
    public function index(){
        $data = [];
        $data['users'] = 10;
        $data['reports'] = 20;
        return view('dashboard',compact('data'));
    }
}
