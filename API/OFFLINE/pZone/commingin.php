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
    else if(!$kit->_validate($data, $kit->get_comming_list())){
        $conObg->detach();
        echo "You fool, Get Lost";
    }
    else{ // do everything here   
        //get user info
        $qry = "SELECT * FROM `_user711qd9m` WHERE id = '$data->id'";
        $res = mysqli_fetch_all(mysqli_query($link, $qry), MYSQLI_ASSOC);

        // get credentials for app
        $qry2 = "SELECT * FROM `creadentials`";
        $res2 = mysqli_fetch_all(mysqli_query($link, $qry2), MYSQLI_ASSOC);     

        $response = null;
        if($res != null && $res2 != null){
            $res = $res[0];
            //$res2 = $res2[0];
            $sync = true;
            $file_list = array();
            if($res['pending'] > 0){
                //pending catched
                //check for file to be printed
                $qry3 = "SELECT `file_name`, `time`, `pg_count`, `size`, `is_online` FROM `_pending5cq71rd` WHERE id = $data->id";
                $res3 = mysqli_fetch_all(mysqli_query($link, $qry3), MYSQLI_ASSOC);
                if($res3 == null)$sync = false;
                else{
                    $file_list = $res3;
                    /*
                     * check for online files
                     * if online, send this to be downloaded.
                     *
                    */
                }
            }

            if($sync){
                if($res['status'] == '1' ){
                    // active id
                   $server = $temp = $hidden = null;
                   foreach($res2 as $hold){
                        if($hold['type'] == 'server') $server = $hold['dir'];
                        if($hold['type'] == 'hidden') $hidden = $hold['dir'];
                        if($hold['type'] == 'temp') $temp = $hold['dir'];
                   }
                   
                    $response = array(
                        "status" => "1",  // protocol
                        "name" => $res['name'],
                        "active" => $res['status'], //as flag if account is active
                        "pgLeft" => $res['page_left'],
                        "pgPrinted" => $res['total_printed'],
                        "server" => $server,
                        "temp" => $temp,
                        "hidden" => $hidden,
                        "filePending" => $res['pending'],
                        "files" => $file_list,
                        "ip" => $kit->get_client_ip() // delete it before production
                    );
                }
                else{
                    //disabaled id
                    $response = array(
                        "status"=> "1",
                        "active" => $res['status'],
                        "ip" => $kit->get_client_ip()  // delete it before production
                    );
                }


                // set request log here

            }
            else{
                // database not synchronized
                $response = array(
                    "status"=> "0",
                    "msg" => "not synchronized"
                );

            }           
                        
        }else{  
            // id not found
             $response = array(
                "status" => "0",
                "msg" => "invalid id"
            );
        }
        http_response_code(200);
        echo json_encode($response);
        $conObg->detach();
    }

    


?>