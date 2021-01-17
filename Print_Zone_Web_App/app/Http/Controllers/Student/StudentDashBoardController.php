<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Pending_File;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentDashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    // Student Dash Board
    public function index()
    {
        $student_id = auth()->user()->id;


        // Getting User Print Information
        $pending = Student::find($student_id);

        if($pending == NULL)
        {
            $data = array(
                'found' => false,
                'status'=> 0,
                'page_left' => 0,
                'total_printed' => 0,
                'pending' => 0,
            );
        }else
        {
            $data = array(
                'found' => true,
                'status'=> $pending->status,
                'page_left' => $pending->page_left,
                'total_printed' => $pending->total_printed,
                'pending' => $pending->pending,
            );
        }
        return view('student.student_landing')->with('data',$data);
    }
}
