<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Student Dash Board
    public function student_dashboard()
    {
        return view('student.student_landing');
    }
}
