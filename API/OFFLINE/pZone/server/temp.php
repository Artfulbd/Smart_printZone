<?php
    header("Access-Controll-Allow-Origin: *");
    header("Access-Controll-Allow-Headers: access");
    header("Access-Controll-Allow-Methods: POST");
    header("Access-Controll-Allow-Credentials: true");
    header("Content-Type: application/json");

    include_once 'personal/connection.php';
    include_once 'personal/extraTools.php';

    $kit = new Tools();
    $conObg = new ConnectTo('_smartprintzone97830a1');
    $link = $conObg->giveLink();  
    $data = json_decode(file_get_contents("php://input"));
    if($link == null){
        http_response_code(404);
        echo json_encode(array("status" => '0', "msg" => "problem on server"));
    }
    else if(!$kit->_validate($data, $kit->get_any_update_list())){
        $conObg->detach();
        echo "You fool, Get Lost";
    }
    else{
        // print status
        $status_qry = "SELECT given_name, IF(u_id != 0, u_id, '--') as u_id, IF(u_id != 0, (SELECT `name` FROM `_user711qd9m` WHERE id = u_id), '--') as user_name, current_status, status FROM printe3242342r_status234232077 ps join print43er_details234c23452 pd on ps.printer_id = pd.printer_id join printer_status_code psc on psc.s_code = pd.current_status WHERE 1";
        $res = mysqli_fetch_all(mysqli_query($link, $status_qry), MYSQLI_ASSOC);
        $printer_count = sizeof($res);
        $status_data = $res;
        
        http_response_code(200);
        echo json_encode($response);
        $conObg->detach();
    }

?>