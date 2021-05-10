<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\File_Upload_Credential;
use App\Models\Pending_File;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Helper\Helper;

class PrintPdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('student.print_pdf');
    }


    public function print_file_cmd(Request $request)
    {

        // File Upload Setting for Verification
        $setting_id = Helper::$file_upload_setting;


        // Settings for File Upload
        $file_upload_credential = File_Upload_Credential::find($setting_id);
        $max_file_count = $file_upload_credential->max_file_count;
        $max_size_total = $file_upload_credential->max_size_total;
        $storing_location = $file_upload_credential->storing_location;


        // User's Already Uploaded File Count
        $user_id = Auth::id();
        $pending_file_count = Pending_File::where('id',$user_id)->count();


        // Checking Page Limits
        $student = Student::find($user_id);
        $account_status = $student->status;
        $page_left = $student->page_left;


        // Checking Account Active or Not
        if(!$account_status)
            return redirect('/print_pdf')->with('error','Your account is deactivated ! You cannot upload File');



        // Checking Max File Upload Limit crossed or not
        if($pending_file_count >= $max_file_count)
            return redirect('/print_pdf')->with('error','You cannot upload more than '.$max_file_count.' files at a time !');


        // Validating Uploaded PDF File
        $request->validate([
            'uploaded_file' => 'bail|required|mimes:pdf|max:'.$max_size_total.','
        ]);


        // PDF Storing Tasks
        if ($request->hasFile('uploaded_file')) {

            $file = $request->file('uploaded_file');

            if ($file->isValid()) {


                // Extra Checking Functon
                $checked = Helper::check_file($file);
                if(!$checked)
                    return redirect('/print_pdf')->with('error','File Cannot be Uploaded Successfully');


                // Page Count of Uploaded File
                $uploaded_file_pages = Helper::count_pages($file);
                if($uploaded_file_pages > $page_left)
                    return redirect('/print_pdf')->with('error','Insufficient Page | Page Remaining : '.$page_left.' | Current PDF Page : '.$uploaded_file_pages);


                // File Name for Storing in DB
                $file_name_with_ex = $file->getClientOriginalName();
                $file_name_without_ex = pathinfo($file_name_with_ex, PATHINFO_FILENAME);


                // Extension
                $extension = $file->extension();


                // Preparing Storing Information
                $file_name_server = $user_id.'_'.$file_name_with_ex;


                // Checking file already uploaded or not
                if(Storage::exists($storing_location.$file_name_server))
                    return redirect('/print_pdf')->with('error','File Already Uploaded');


                // Storing File
                $path = $file->storeAs(
                    $storing_location, $file_name_server,'public'
                );
                if ($path == null)
                    return redirect('/print_pdf')->with('error','File Cannot be Uploaded Successfully');


                // Successfull and Storing Data in Database in Pending_File Table
                $pending = new Pending_File();
                $pending->id = $user_id;
                $pending->file_name = $file_name_without_ex;
                $pending->pg_count = $uploaded_file_pages;
                $pending->size =  ceil($file->getSize()/1024);
                $pending->is_online = 1;
                $pending->save();


                // Storing information in student table
                $student->pending = $pending_file_count + 1;
                $student->save();

                return redirect('/print_pdf')->with('success','File Uploaded Successfully');
            }
        }
        abort(500, 'Could not upload image :(');
    }



    public function cancel_print()
    {

    }
}
