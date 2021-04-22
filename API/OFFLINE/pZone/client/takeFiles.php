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
        echo json_encode(array(
            "status" => "0",
            "msg" => "problem on server"
        ));
    }
    else if(!$kit->_validate($data, $kit->take_file_list())){
        $conObg->detach();
        echo "You fool, Get Lost";
    }
    else{ // do everything here 
        $qry = "SELECT `status`, `page_left`, `pending` FROM `_user711qd9m` WHERE id = $data->id";
        $res = mysqli_fetch_all(mysqli_query($link, $qry), MYSQLI_ASSOC);  

        $response = null;
        if($res != null ){
            $res = $res[0];
            if($res['status']){
                //active id
                $count = $data->file_count;
                $files = $data->files;
                $pending = $res['pending'];

                if($count > 0 && count($files) == $count){
                    $qry = "INSERT INTO `_pending5cq71rd`(`id`, `file_name`, `time`, `pg_count`, `size`, `is_online`,`source`) VALUES ";
                    $prb = false;
                    $total_count = 0;
                    for($i = 0; $i < $count; $i++){
                        $file = $files[$i];
                        // creating file, following this formate -> nsuid_fileName.pdf
                        $name = $kit->get_server_dir().'/'.$data->id.'_'.$file->file_name.".pdf";
                        $page_count = $kit->count_page($name); //returns 0 if file not found
                        if(file_exists($name) && $page_count == $file->pg_count){
                        //if(true){
                            $qry .= "('$data->id', '$file->file_name', '$file->time', '$file->pg_count', '$file->size', 0, '$data->pc_name')";
                            if($i+1 != $count) $qry .= ",";  
                            $pending ++;
                            $total_count += $file->pg_count; 
                        }
                        else{
                            // file not reached to server
                            $prb = true;
                            break;
                        }
                    }
                    if($prb){
                        $response = array(
                            "status" => "0",
                            "active" => "1",
                            "duplicate" => "0",
                            "msg" => "file not found"
                        );
                    }
                    else if($res['page_left'] < $total_count){
                        // total page exceeds the available page limit
                        $conObg->detach();
                        die("You  fool, Get Lost");
                    }
                    else{
                        
                        $qry .= ";";
                        $qry2 = "UPDATE `_user711qd9m` SET `pending` = $pending WHERE `_user711qd9m`.`id` = $data->id";
                        $duplicate = false;

                        //starting transaction as update must be done on insertion on other table
                        mysqli_autocommit($link, false);

                        //to catch duplicate file entry, which is not allowed
                        try{
                            $res = mysqli_query($link, $qry);
                            $res2 = mysqli_query($link, $qry2);
                        }catch(Exception $e){
                            $duplicate = true;
                        }
                        if($duplicate){
                            $response = array(
                                "status" => "0",
                                "active" => "1",
                                "duplicate" => "1",
                                "msg" => "file already exists"
                            ); 

                        }
                        else if($res && $res2){
                            mysqli_commit($link);
                            $response = array(
                                "status" => "1",
                                "msg" => "success"
                            );           
                        }
                        else{  
                            mysqli_rollback($link);
                            $response = array(
                                "status" => "0",
                                "active" => "1",
                                "duplicate" => "0",
                                "msg" => "problem on server"
                            ); 
                        }

                    }
                                       
                }
                else{
                    $response = array(
                        "status" => "0",
                        "active" => "1",
                        "duplicate" => "0",
                        "msg" => "mis binding"
                    );
                }
           
            }
            else {
                $response = array(
                    "status" => "0",
                    "active" => "0",
                    "duplicate" => "0",
                    "msg" => "ID blocked"
                );
            }
            
            http_response_code(200);
            echo json_encode($response);
        }
        else{
            echo "You  fool, Get Lost";
        }   
        $conObg->detach();
    }
?>