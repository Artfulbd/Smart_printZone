<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class ManageStudentController extends Controller
{
    public function goto_search_student_page()
    {
        $data = array(
            'search' => 0,
        );
        return view('admin.search_student')->with('data',$data);
    }


    public function search_student_post(Request $request)
    {

        $validated = $request->validate([
            'nsu_id' => 'required|min:6',
        ]);

        $nsu_id = $request->input('nsu_id');


        $student = Student::where('id',$nsu_id)->first();



        if(!$student)
            return redirect()->route('admin.goto_search_student_page')->with('error','No Student found against this student ID ! ');


        $data = array(
            'search' => 1,
            'student_info' => $student,
        );

        return view('admin.view_searched_student_info')->with('data',$data);
    }

    public function search_student_get($nsu_id)
    {

        $student = Student::where('id',$nsu_id)->first();



        if(!$student)
            return redirect()->route('admin.goto_search_student_page')->with('error','No Student found against this student ID ! ');


        $data = array(
            'search' => 1,
            'student_info' => $student,
        );

        return view('admin.view_searched_student_info')->with('data',$data);
    }


    public function increase_page_amount(Request $request)
    {
        $nsu_id = $request->input('nsu_id');
        $page_amount = $request->input('page_amount');


        $student = Student::find($nsu_id);
        $student->page_left = $student->page_left + $page_amount;
        $student->save();
        return redirect('/search_student_get/'.$nsu_id)->with('success','Page Loaded Successfully');

    }


    public function edit_student_information(Request $request)
    {
        $nsu_id = $request->input('nsu_id');
        $student = Student::find($nsu_id);
        $student->status = !$student->status;
        $student->save();

        return redirect('/search_student_get/'.$nsu_id)->with('success','Updated Successfully');
    }
}
