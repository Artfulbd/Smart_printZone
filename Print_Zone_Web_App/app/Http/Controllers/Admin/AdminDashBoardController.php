<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Admin Dash Board
    public function admin_dashboard()
    {
        return view('admin.admin_landing');
    }
}
