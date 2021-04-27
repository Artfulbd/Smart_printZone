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
        // check user is active or not
        $abort_
        $update_qry = "UPDATE print43er_details234c23452 pd join printe3242342r_status234232077 ps 
        on ps.printer_id = pd.printer_id SET pd.current_status = 1 WHERE ps.u_id = 1722231;";
        mysqli_query($link, $status_qry);
       
        http_response_code(200);
        echo json_encode($response);
        $conObg->detach();
    }

?>