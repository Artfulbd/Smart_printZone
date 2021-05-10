<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrinterDetails;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function view_zones()
    {
        $zones = Zone::all();



        if($zones->isEmpty())
        {
            $data = array(
                'found' => false,
            );
        }else{
            $data = array(
                'found' => true,
                'data' => $zones
            );
        }

        return view('admin.zone_setting')->with('data',$data);
    }



    public function create_zone(Request $request)
    {
        $request->validate([
            'zone_name' => 'required'
        ]);


        $zone_name = $request->input('zone_name');


        $zone = new Zone();
        $zone->zone_name = $zone_name;
        $zone->save();

        return redirect()->route('admin.view_zones')->with('success','New Zone Created Successfully');
    }


    public function edit_zone(Request $request)
    {
        $request->validate([
            'zone_name' => 'required',
            'zone_id' => 'required',
        ]);


        $zone_id = $request->input('zone_id');
        $zone_name = $request->input('zone_name');


        $zone = Zone::find($zone_id);
        $zone->zone_name = $zone_name;
        $zone->save();

        return redirect()->route('admin.view_zones')->with('success','Zone Edited Successfully');
    }


    public function delete_zone(Request $request)
    {
        $request->validate([
            'zone_id' => 'required',
        ]);


        $zone_id = $request->input('zone_id');


        // Checking if zone is registered in PrinterDetails
        $response = PrinterDetails::where('zone_id',$zone_id)->exists();
        if($response)
            return redirect()->route('admin.view_zones')->with('error','Zone Already Registered in Printer Details');

        $zone = Zone::find($zone_id);
        $zone->delete();

        return redirect()->route('admin.view_zones')->with('success','Zone Deleted Successfully');
    }
}
