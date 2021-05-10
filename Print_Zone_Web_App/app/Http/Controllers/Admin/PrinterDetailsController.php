<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrinterDetails;
use Illuminate\Http\Request;
use App\Models\PrinterStatus;

class PrinterDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function view_printer_details()
    {
        $printer_details = PrinterDetails::leftJoin('zones as z','z.zone_id','=','print43er_details234c23452.zone_id')
                                        ->leftJoin('printer_status_code as psc','psc.s_code','=','print43er_details234c23452.current_status')
                                        ->get();



        if($printer_details->isEmpty())
        {
            $data = array(
                'found' => false,
            );
        }else{
            $data = array(
                'found' => true,
                'data' => $printer_details
            );
        }

        return view('admin.printer_details')->with('data',$data);
    }




    public function create_printer_details(Request $request)
    {
        $request->validate([
            'zone_id' => 'required',
            'printer_name' => 'required|unique:print43er_details234c23452',
            'given_name' => 'required|unique:print43er_details234c23452',
            'port' => 'required',
            'time_one_pg' => 'required',
            'driver_name' => 'required',
            'current_status' => 'required',
        ]);



        // Generating Printer ID
        $printer_id = PrinterDetails::max('printer_id') + 1;
        

        $printer_details = new PrinterDetails();
        $printer_details->printer_id = $printer_id;
        $printer_details->zone_id = $request->input('zone_id');
        $printer_details->printer_name = $request->input('printer_name');
        $printer_details->given_name = $request->input('given_name');
        $printer_details->port = $request->input('port');
        $printer_details->time_one_pg = $request->input('time_one_pg');
        $printer_details->driver_name = $request->input('driver_name');
        $printer_details->current_status = $request->input('current_status');
        $printer_details->save();

        

        $printer_status = new PrinterStatus();
        $printer_status->printer_id = $printer_id;
        $printer_status->save();


        return redirect()->route('admin.view_printer_details')->with('success','New Printer added Successfully');
    }


    public function edit_printer_details(Request $request)
    {
        $request->validate([
            'printer_id_e' => 'required',
            'zone_id_e' => 'required',
            'printer_name_e' => 'required',
            'given_name_e' => 'required',
            'port_e' => 'required',
            'time_one_pg_e' => 'required',
            'driver_name_e' => 'required',
            'current_status_e' => 'required',
        ]);

        $printer_id = $request->input('printer_id_e');


        $printer_details = PrinterDetails::find($printer_id);
        $printer_details->zone_id = $request->input('zone_id_e');
        $printer_details->printer_name = $request->input('printer_name_e');
        $printer_details->given_name = $request->input('given_name_e');
        $printer_details->port = $request->input('port_e');
        $printer_details->time_one_pg = $request->input('time_one_pg_e');
        $printer_details->driver_name = $request->input('driver_name_e');
        $printer_details->current_status = $request->input('current_status_e');
        $printer_details->save();

        return redirect()->route('admin.view_printer_details')->with('success','Printer Details Edited Successfully');
    }


    public function delete_printer_details(Request $request)
    {
        $request->validate([
            'printer_id' => 'required',
        ]);


        $printer_id = $request->input('printer_id');

        // Deleting from Printer Status Table
        $printer_status = PrinterStatus::find($printer_id);
        $printer_status->delete();

        $printer_details = PrinterDetails::find($printer_id);
        $printer_details->delete();

        

        return redirect()->route('admin.view_printer_details')->with('success','Printer Details Deleted Successfully');
    }
}
