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
    else if(!$kit->_validate($data, $kit->get_update_status_list())){
        $conObg->detach();
        echo "You fool, Get Lost";
    }
    else{
        $response = array("abort_code" => "1");
        // check presence in status
        $status_qry = "SELECT printer_id, u_required_time, `abort` FROM `printe3242342r_status234232077` ps 
        join `printe618r_status_helper` psh on ps.u_id = psh.u_id WHERE ps.u_id = $data->id;";
        $res = mysqli_fetch_all(mysqli_query($link, $status_qry), MYSQLI_ASSOC);
        if($res)
        {
            $printer_id = $res[0]['printer_id'];
            $own_time = $res[0]['u_required_time'];
            $response = array("abort_code" => $res[0]['abort']);
            
            $update_qry = "UPDATE `print43er_details234c23452` SET `current_status`= $data->printer_status WHERE printer_id = $printer_id;";
            $update_print_queue_qry = "UPDATE `prin23422ting_queue21314` SET `wait_time`= `wait_time` - $own_time WHERE `p_id`= $printer_id;";
            $update_status_qry = "UPDATE `printe3242342r_status234232077` SET `u_id` = NULL, `required_time`= `required_time` - $own_time WHERE `printer_id` = $printer_id;";
            $update_status_helper_qry = "DELETE FROM `printe618r_status_helper` WHERE u_id = $data->id;";
                
            try {
                mysqli_query($link, $update_qry);
                if($res[0]['abort'])
                {
                    mysqli_query($link, $update_status_qry);
                    mysqli_query($link, $update_print_queue_qry);
                    mysqli_query($link, $update_status_helper_qry);   
                }
            } catch (Exception $e) {
                $response = array("abort_code" => $res[0]['abort'], "exception" => $e->getMessage());
            }
            
        }
       
        http_response_code(200);
        echo json_encode($response);
        $conObg->detach();
    }

?>