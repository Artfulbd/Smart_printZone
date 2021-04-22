<?php
    header("Access-Controll-Allow-Origin: *");
    header("Access-Controll-Allow-Headers: access");
    header("Access-Controll-Allow-Methods: POST");
    header("Access-Controll-Allow-Credentials: true");
    header("Content-Type: application/json");

    include_once '../personal/connection.php';
    include_once '../personal/extraTools.php';

    $kit = new Tools();
    $conObg = new ConnectTo('_smartprintzone97830a1');
    $link = $conObg->giveLink();  
    $data = json_decode(file_get_contents("php://input"));
    if($link == null){
        http_response_code(404);
        echo json_encode(array("status" => '0', "msg" => "problem on server"));
        exit(0);
    }
    else if(!$kit->_validate($data, $kit->get_punch_list())){
        $conObg->detach();
        echo "You fool, Get Lost";
    }
    else{
        $response = array("abort_code" => "1");
        // check user is active or not
        $status_qry = "SELECT status, pending FROM `_user711qd9m` WHERE id = $data->id;";
        $res = mysqli_fetch_all(mysqli_query($link, $status_qry), MYSQLI_ASSOC);
        if($res && $res[0]['status'] == 1 && $res[0]['pending'] != 0)
        {
            // means active and has files
            $doc_count = $res[0]['pending'];

            // now get total page count
            $pg_count_qry = "SELECT sum(pg_count) as 'total_page_count' FROM `_pending5cq71rd` WHERE id = $data->id;";
            $res = mysqli_fetch_all(mysqli_query($link, $pg_count_qry), MYSQLI_ASSOC);
            $total_pg_count = $res[0]['total_page_count'];
            
            // get least busy printer
            $printer_selection_qry = "SELECT * FROM `printe3242342r_status234232077` ps left join print43er_details234c23452 pd
            on ps.printer_id = pd.printer_id 
            WHERE pd.current_status = 1 and pd.zone_id = $data->zone_code
            ORDER BY ps.required_time ASC;";
            $res = mysqli_fetch_all(mysqli_query($link, $printer_selection_qry), MYSQLI_ASSOC);
            if($res && sizeof($res) > 0){
                // has a printer to print
                $printer_id = $res[0]['printer_id'];
                $printer_name = $res[0]['printer_name'];
                $printer_port = $res[0]['port'];
                $driver_name = $res[0]['driver_name'];
                $time_one_pg = $res[0]['time_one_pg'];
                $required_time = $res[0]['required_time'];

                // get queue size
                $queue_size_qry = "SELECT count(*) as 'queue_size' FROM `prin23422ting_queue21314` pq left join print43er_details234c23452 pd on pq.p_id = pd.printer_id where pd.zone_id = $data->zone_code;";
                $res = mysqli_fetch_all(mysqli_query($link, $queue_size_qry), MYSQLI_ASSOC);
                $current_queue_size = $res[0]['queue_size'];
                $updated_queue_size = $current_queue_size + 1;

                // calculate own printing time
                $pad_time_qry = "SELECT value as 'pad_time' FROM `creadentials` WHERE type = 'pad_time';";
                $res = mysqli_fetch_all(mysqli_query($link, $pad_time_qry), MYSQLI_ASSOC);
                $padding = $res[0]['pad_time'];
                $own_printing_time = ($time_one_pg * $total_pg_count) + $padding;

                $print_queue_insert_qry = "INSERT INTO `prin23422ting_queue21314`(`num`, `u_id`, `p_id`, `time`, `wait_time`) 
                VALUES ($updated_queue_size, $data->id, $printer_id , $own_printing_time, $required_time);";
                $printer_status_update_qry = "UPDATE `printe3242342r_status234232077` 
                SET `required_time` = `required_time` +  $own_printing_time WHERE printer_id = $printer_id;";

                //printf("%s \n %s",$print_queue_insert_qry,$printer_status_update_qry);
                mysqli_autocommit($link, false);
                mysqli_query($link, $print_queue_insert_qry);
                mysqli_query($link, $printer_status_update_qry);
                mysqli_commit($link);
                $response = array(
                    "abort_code" => "0",
                    "printer_id" => $printer_id,
                    "printer_name" => $printer_name,
                    "time_one_page" => $time_one_pg,
                    "port" => $printer_port,
                    "driver_name" => $driver_name,
                    "wait_time" => $required_time,
                    "doc_count" => $doc_count,
                    "page_count" => $total_pg_count
                );

            }
            
        }
        
       
        
        http_response_code(200);
        echo json_encode($response);
        $conObg->detach();
    }

?>