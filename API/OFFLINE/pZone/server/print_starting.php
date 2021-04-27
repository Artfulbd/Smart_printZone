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
    else if(!$kit->_validate($data, $kit->get_print_starting_list())){
        $conObg->detach();
        echo "You fool, Get Lost";
    }
    else{
        $response = array("abort_code" => "1");
        // get printing details of that user
        $queue_details_qry = "SELECT * FROM `prin23422ting_queue21314` WHERE u_id = $data->id;";
        $res = mysqli_fetch_all(mysqli_query($link, $queue_details_qry), MYSQLI_ASSOC);
        
        // check for duplicate entry
        $status_check_qry = "SELECT * FROM `printe3242342r_status234232077` WHERE u_id = $data->id";
        $on_status = mysqli_fetch_all(mysqli_query($link, $status_check_qry), MYSQLI_ASSOC);
        $status_helper_check_qry = "SELECT * FROM `printe618r_status_helper` WHERE u_id = $data->id;";
        $on_helper = mysqli_fetch_all(mysqli_query($link, $status_helper_check_qry), MYSQLI_ASSOC);
        
        if(!$on_status && !$on_helper && $res && $res[0]['abort'] == 0 && $res[0]['wait_time'] == 0){
            $printer_id = $res[0]['p_id'];
            $index = $res[0]['num'];
            $required_time = $res[0]['time'];

            // add that user to printer status
            $printer_status_update_qry = "UPDATE `printe3242342r_status234232077` SET `u_id`= $data->id  WHERE printer_id = $printer_id;";
            // also add to status helper
            $status_helper_qry = "INSERT INTO `printe618r_status_helper`(`u_id`, `u_required_time`) VALUES ($data->id, $required_time)"; 
            // remove that user from queue
            $queue_update_qry = "DELETE FROM `prin23422ting_queue21314` WHERE u_id = $data->id;";
            // reset queue priority
            $priority_reset_qry = "UPDATE `prin23422ting_queue21314` SET `num`= `num` - 1 WHERE `num` > $index";
            
            mysqli_autocommit($link, false);
            mysqli_query($link, $printer_status_update_qry);
            mysqli_query($link, $status_helper_qry);
            mysqli_query($link, $queue_update_qry);
            mysqli_query($link, $priority_reset_qry);
            mysqli_commit($link);

            $response = array("abort_code" => "0");
        }
        http_response_code(200);
        echo json_encode($response);
        $conObg->detach();
    }

?>