<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Helper\Helper;

class PrintPdfController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }


    public function index()
    {
        return view('student.print_pdf');
    }


    public function print_file_cmd(Request $request)
    {
        $request->validate([
            'uploaded_file' => 'bail|required|mimes:pdf|max:204800'
        ]);

        // PDF Storing Tasks
        if ($request->hasFile('uploaded_file')) {

            if ($request->file('uploaded_file')->isValid()) {


                $information = Helper::check_file($request->file('uploaded_file'));
                if(!$information)
                    return redirect('/print_pdf')->with('error','File Cannot be Uploaded Successfully');
                $extension = $request->uploaded_file->extension();
                $path = $request->file('uploaded_file')->storeAs(
                    'Uploaded_File', 'New_PDF.'.$extension
                );
                if ($path == null)
                    return redirect('/print_pdf')->with('error','File Cannot be Uploaded Successfully');



                // Successfull
                return redirect('/print_pdf')->with('success','File Uploaded Successfully');



            }
        }
        abort(500, 'Could not upload image :(');
    }
}
