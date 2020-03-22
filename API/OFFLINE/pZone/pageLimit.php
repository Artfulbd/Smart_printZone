<?php
    header("Access-Controll-Allow-Origin: *");
    header("Access-Controll-Allow-Headers: access");
    header("Access-Controll-Allow-Methods: GET");
    header("Access-Controll-Allow-Credentials: true");
    header("Content-Type: application/json");

    include_once 'personal/connection.php';
    include_once 'personal/extraTools.php';

    $kit = new tools();
    $conObg = new ConnectTo('original');
    $link = $conObg->giveLink();  
    $data = json_decode(file_get_contents("php://input"));
    if($link == null){
        http_response_code(404);
        echo json_encode(array("status" => "Connection problem on server"));
    }else if($data == null || !property_exists($data, 'id') || !property_exists($data, 'machineName')){
        $conObg->detach();
        echo "Get Lost";
    }else if( !$kit->test_input($data->id) || !$kit->test_input($data->machineName) ){    
        $conObg->detach();
        echo "You  fool, Get Lost";
    }
    else{ // do everything here, key is needed to intify request source.   
            
         $qry = "SELECT pgCount, accountStatus FROM `trace` WHERE id = $data->id";
         $res = mysqli_fetch_all(mysqli_query($link, $qry), MYSQLI_ASSOC);
        if($res != null){
            $response = array(
                "status"=> "ok",
                "pgCount" => $res[0]['pgCount'],
                "accountStatus"  => $res[0]['accountStatus'],
                "ip" => $kit->get_client_ip()
            );
            http_response_code(200);
            echo json_encode($response);            
        }else{  
             echo "Invlid ID..!";
        }
        $conObg->detach();
    }
?>