<?php
    header("Access-Controll-Allow-Origin: *");
    header("Access-Controll-Allow-Headers: access");
    header("Access-Controll-Allow-Methods: POST");
    header("Access-Controll-Allow-Credentials: true");
    header("Content-Type: application/json");

    include_once '../personal/connection.php';
    include_once '../personal/extraTools.php';  

    $kit = new tools();
    $conObg = new ConnectTo('original');
    $link = $conObg->giveLink();  
    $data = json_decode(file_get_contents("php://input"));
    if($link == null){
        http_response_code(404);
        echo json_encode(array("status" => "Connection problem on server"));
    }else if($data == null || !property_exists($data, 'id')  || !property_exists($data, 'appKey') || !property_exists($data, 'files')){
        $conObg->detach();
        echo "Get Lost";
    }else if( !$kit->test_input($data->id) || !$kit->test_input($data->appKey) || !$kit->test_input($data->files) ){    
        $conObg->detach();
        echo "You  fool, Get Lost";
    }
    else{ 
        // do everything here, key is needed to intify request source, but not used yet.   
        $fileList = $data->files;
        $id = $data->id;
        $qry = "INSERT INTO `printdata`(`nsuId`, `fileName`, `page`, `available`)  VALUES ";
        $i = 0;
        $len = sizeof($fileList);
        while( $i < $len ) $qry .= "(".$id.",'".$fileList[$i++]."',".$fileList[$i++].", 1 ) ,";
        $qry[strlen($qry)-1] = ";";
        
        mysqli_autocommit($link, false);
        $res = mysqli_query($link, $qry);
        if($res){
            mysqli_commit($link);
            $response = array(
                "status"=> "ok"
            );
            http_response_code(200);
            echo json_encode($response);            
        }else{  
            mysqli_rollback($link);
            $response = array(
                "status"=> "invalid request"
            );
            http_response_code(200);
            echo json_encode($response); 
        }
        $conObg->detach();
    }
?>