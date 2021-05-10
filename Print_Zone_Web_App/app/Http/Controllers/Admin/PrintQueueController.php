<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrinterStatus;
use App\Models\PrintingQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintQueueController extends Controller
{

    public function view_card_punched_print_queue() {

        $print_queue = PrintingQueue::where('abort',0)
                        ->join('print43er_details234c23452 as pd','pd.printer_id','=','prin23422ting_queue21314.p_id')
                        ->leftJoin('zones as z', 'z.zone_id','=','pd.zone_id')
                        ->get();


        $data = array(
            'found' => false,
        );

        if($print_queue->isEmpty())
            return view('admin.card_punched_printing_queue')->with('data',$data);

        $data = array(
            'found' => true,
            'data' => $print_queue
        );
        return view('admin.card_punched_printing_queue')->with('data',$data);

    }



    public function abort_from_card_punched_print_queue(Request $request)
    {
        $request->validate([
            'u_id' => 'required'
        ]);
        $u_id = $request->input('u_id');


        $queue = PrintingQueue::where('u_id',$u_id)->update(['abort' => 1]);

        return redirect()->route('admin.view_card_punched_print_queue')->with('success','Aborted Successfully');
    }



    public function view_current_status_print_queue()
    {
        return view('admin.current_status_printing_queue');
    }



    public function get_current_status_print_queue_data()
    {

        $data = PrinterStatus::join('print43er_details234c23452 as pd','pd.printer_id','=','printe3242342r_status234232077.printer_id')
                                ->leftjoin('zones as z','z.zone_id','=','pd.zone_id')
                                ->leftjoin('printe618r_status_helper as ph','ph.u_id','=','printe3242342r_status234232077.u_id')
                                ->where('ph.abort',0)
                                ->get();




        if($data->isEmpty())
        {
            $data = array(
                'success' => false,
                'message' => 'No Data Found'
            );
            return response()->json($data);
        }


        $data = array(
            'success' => true,
            'data' => $data->toArray(),
        );



        return response()->json($data);
        //return response(['success' => true, 'data' => $data]);
    }


    public function abort_from_current_status_print_queue($u_id)
    {
        $response = DB::table('printe618r_status_helper')
            ->where('u_id',$u_id)
            ->update(['abort' => 1]);

        if($response)
        {
            $data = array(
                'success' => true,
            );
            return response()->json($data);
        }else {
            $data = array(
                'success' => false,
                'error' => 'Incorrect ID'
            );
            return response()->json($data);
        }
    }
}
