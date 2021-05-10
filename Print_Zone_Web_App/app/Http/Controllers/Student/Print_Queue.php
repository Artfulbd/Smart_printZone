<?php

namespace App\Http\Controllers\Student;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\File_Upload_Credential;
use App\Models\Pending_File;
use App\Models\Student;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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



    public function cancel_print(Request $request)
    {
        $user_id = $request->input('user_id');
        $file_id = $request->input('file_id');
        $file_name = $request->input('file_name');

        // Getting Location from Setting
        $setting_id = Helper::$file_upload_setting;
        $setting = File_Upload_Credential::find($setting_id);
        $storing_location = $setting->storing_location;


        // File to be deleted
        $file_url = $storing_location.$file_id.'_'.$file_name.'.pdf';



        if(Storage::disk('public')->exists($file_url)){
            Storage::disk('public')->delete($file_url);

            /*
                Delete Multiple File like this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }else{
            return redirect('/print_queue')->with('error','File Cannot Deleted Successfully');
        }




        // Deleting Information from Database
        $response = Pending_File::where('file_name','=',$file_name)->delete();

        $student = Student::find($user_id);
        $student->pending = $student->pending-1;
        $student->save();

        if($response)
            return redirect('/print_queue')->with('success','File Deleted Successfully');
        else
            return redirect('/print_queue')->with('error','File Cannot Deleted Successfully');

    }

}
