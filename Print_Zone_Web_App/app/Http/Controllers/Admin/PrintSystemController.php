<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File_Upload_Credential;
use App\Models\PrinterStatus;
use App\Models\PrinterStatusHelper;
use App\Models\PrintingQueue;
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


        $response_1 = PrintingQueue::truncate();
        $response_2 = PrinterStatusHelper::truncate();
        $response_3 = PrinterStatus::where('printer_id','>','0')->update(['u_id' => null, 'required_time' => 0]);


        return redirect('/on_off_system')->with('success',$change_string);
    }


    public function view_print_setting(Request $request)
    {
        $print_setting = File_Upload_Credential::all();

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
            'c_hidden_dir' => 'required',
            'c_temp_dir' => 'required',
        ]);


        $max_file_count = $request->input('c_max_file_count');
        $max_size_total = $request->input('c_max_size_total');
        $storing_location = $request->input('c_storing_location');
        $hidden_dir = $request->input('c_hidden_dir');
        $temp_dir = $request->input('c_temp_dir');

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
        $setting->server_dir = $storing_location;
        $setting->hidden_dir = $hidden_dir;
        $setting->temp_dir = $temp_dir;
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
            'hidden_dir' => 'required',
            'temp_dir' => 'required',
        ]);

        $setting_id = $request->input('setting_id');
        $max_file_count = $request->input('max_file_count');
        $max_size_total = $request->input('max_size_total');
        $storing_location = $request->input('storing_location');
        $hidden_dir = $request->input('hidden_dir');
        $temp_dir = $request->input('temp_dir');


        $setting = File_Upload_Credential::find($setting_id);
        $setting->max_file_count = $max_file_count;
        $setting->max_file_count = $max_file_count;
        $setting->max_size_total = $max_size_total;
        $setting->server_dir = $storing_location;
        $setting->hidden_dir = $hidden_dir;
        $setting->temp_dir = $temp_dir;
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