<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File_Upload_Credential;
use App\Models\System;
use Illuminate\Http\Request;

class PrintSystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Admin Dash Board
    public function index()
    {
        $system = System::find(1);
        $data = array(
            'system_id'=> $system->system_id,
            'status' => $system->status
        );
        return view('admin.on_off_system')->with('data',$data);
    }


    public function on_off_action(Request $request)
    {
        $system_id = $request->input('system_id');
        $current_status = $request->input('status');

        if($current_status == 1)
        {
            $change_status = 0;
            $change_string = "System has been Turned off Successfully";
        }else
        {
            $change_status = 1;
            $change_string = "System has been Turned On Successfully";
        }

        // Updating System table
        $system = System::find($system_id);
        $system->status = $change_status;
        $system->save();
        return redirect('/on_off_system')->with('success',$change_string);
    }


    public function view_print_setting(Request $request)
    {
        $print_setting = File_Upload_Credential::get();

        $data = array(
            'found' => false,
        );

        if(!$print_setting->isEmpty())
        {
            $data = array(
                'found' => true,
                'data' => $print_setting
            );
        }
        return view('admin.print_setting')->with('data',$data);
    }



    public function create_print_setting(Request $request)
    {


        $validated = $request->validate([
            'c_max_file_count' => 'required',
            'c_max_size_total' => 'required',
            'c_storing_location' => 'required',
        ]);


        $max_file_count = $request->input('c_max_file_count');
        $max_size_total = $request->input('c_max_size_total');
        $storing_location = $request->input('c_storing_location');

        $setting_n = File_Upload_Credential::count();

        if($setting_n <1)
            $setting_id = 1;
        else{
            $setting_p = File_Upload_Credential::max('setting_id');
            $setting_id = ++$setting_p;
        }

        $setting = new File_Upload_Credential();
        $setting->setting_id = $setting_id;
        $setting->max_file_count = $max_file_count;
        $setting->max_file_count = $max_file_count;
        $setting->max_size_total = $max_size_total;
        $setting->storing_location = $storing_location;
        $setting->created_at = now();
        $setting->save();
        $setting_id = $setting->setting_id;

        return redirect('/view_print_setting')->with('success','Setting ID no : '.$setting_id.' Created Successfully');
    }

    public function edit_print_setting(Request $request)
    {

        $validated = $request->validate([
            'setting_id' => 'required',
            'max_file_count' => 'required',
            'max_size_total' => 'required',
            'storing_location' => 'required',
        ]);

        $setting_id = $request->input('setting_id');
        $max_file_count = $request->input('max_file_count');
        $max_size_total = $request->input('max_size_total');
        $storing_location = $request->input('storing_location');


        $setting = File_Upload_Credential::find($setting_id);
        $setting->max_file_count = $max_file_count;
        $setting->max_file_count = $max_file_count;
        $setting->max_size_total = $max_size_total;
        $setting->storing_location = $storing_location;
        $setting->updated_at = now();
        $setting->save();

        return redirect('/view_print_setting')->with('success','Setting ID no : '.$setting_id.' Updated Successfully');
    }


    public function delete_print_setting(Request $request)
    {

        $validated = $request->validate([
            'setting_id' => 'required',
        ]);

        $setting_id = $request->input('setting_id');



        $setting = File_Upload_Credential::find($setting_id)->delete();

        return redirect('/view_print_setting')->with('success','Setting ID no : '.$setting_id.' Deleted Successfully');
    }
}

