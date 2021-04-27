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
    else if(!$kit->_validate($data, $kit->get_wait_time_list())){
        $conObg->detach();
        echo "You fool, Get Lost";
    }
    else{
        $response = array("abort_code" => "1");
        // check user is active or not
        $status_qry = "SELECT pq.wait_time, pd.current_status, pq.abort FROM `prin23422ting_queue21314` pq 
        join `print43er_details234c23452` pd on pq.p_id = pd.printer_id  WHERE u_id = $data->id;";
        $res = mysqli_fetch_all(mysqli_query($link, $status_qry), MYSQLI_ASSOC);
        if($res && $res[0]['abort'] == 0){
            /* if current_status is not 1 means printer WAS okay, but currently has some problem
            *  so now, wait or abort. If abort command is given, "any_update" will remove it automitacally.
            */
            $wait_time = $res[0]['current_status'] != 1 ? 10000 : $res[0]['wait_time'];
            $response = array("abort_code" => "0","wait_time" => $wait_time);
        }
        http_response_code(200);
        echo json_encode($response);
        $conObg->detach();
    }

?>