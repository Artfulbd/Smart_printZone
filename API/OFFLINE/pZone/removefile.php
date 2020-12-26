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
        echo json_encode(array(
            "status" => "0",
            "msg" => "problem on server"
        ));
    }
    else if(!$kit->_validate($data, $kit->remove_file_list())){
        $conObg->detach();
        echo "You fool, Get Lost.!";
    }
    else{ // do everything here 
        $qry = "SELECT `status`, `page_left`, `pending` FROM `_user711qd9m` WHERE id = $data->id";
        $res = mysqli_fetch_all(mysqli_query($link, $qry), MYSQLI_ASSOC);  

        $response = null;
        if($res != null ){
            $res = $res[0];
            if($res['status']){
                //active id
                $fileName = $kit->get_server_dir().'/'.$data->id.'_'.$data->file_name.".pdf";
                $page_count = $page_count = $kit->count_page($fileName); //returns 0 if file not found
                
                if($res['pending'] > 0 && file_exists ($fileName) && $page_count == $data->pg_count){
                    $qry1 = "DELETE FROM `_pending5cq71rd` WHERE id = '$data->id' and file_name = '$data->file_name' and pg_count = '$data->pg_count' and size = '$data->size';";
                    $pending = $res['pending'] - 1;
                    $qry2 = "UPDATE `_user711qd9m` SET `pending` = $pending WHERE `_user711qd9m`.`id` = $data->id";

                    //transaction mood on
                    mysqli_autocommit($link, false);
                    $res1 = mysqli_query($link, $qry1);
                    $res2 = mysqli_query($link, $qry2);
                    //to catch duplicate file entry, which is not allowed
                    if($res1 && $res2){
                        //not delete that file
                        if (unlink($fileName)) {  
                            //seccessfully deleted
                            mysqli_commit($link);
                            $response = array(
                                "status" => "1",
                                "deleted" => "1",
                                "msg" => "success"
                            ); 
                             
                        }  
                        else {  
                            mysqli_rollback($link);
                            $response = array(
                            "status" => "0",
                            "active" => "1",
                            "deleted" => "0",
                            "msg" => "file cannot be deleted, problem on server"
                        ); 
                            
                        }
                                  
                    }
                    else{  
                        mysqli_rollback($link);
                        $response = array(
                            "status" => "0",
                            "active" => "1",
                            "deleted" => "0",
                            "msg" => "problem on server"
                        ); 
                    }    
                }
                else{
                    $response = array(
                        "status" => "0",
                        "active" => "1",
                        "deleted" => "0",
                        "msg" => "file not found"
                    ); 
                }
                
                http_response_code(200);
                echo json_encode($response);

            }
        }
        else{
            echo "You  fool, Get Lost.!";
        }   
        $conObg->detach();
    }
?>