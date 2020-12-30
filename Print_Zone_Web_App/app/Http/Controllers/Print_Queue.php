<?php

namespace App\Http\Controllers;

use App\Models\Pending_File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Print_Queue extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user_id = Auth::id();
        $print_queue = Pending_File::where('id',$user_id)->get();



        $data = array(
            'found' => false,
        );


        if($print_queue->isempty())
            return view('student.print_queue')->with('data',$data);


        $data = array(
            'found' => true,
            'data' => $print_queue
        );
        return view('student.print_queue')->with('data',$data);
    }
}
