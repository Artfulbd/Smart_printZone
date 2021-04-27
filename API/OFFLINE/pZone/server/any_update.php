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
    }
    else if(!$kit->_validate($data, $kit->get_any_update_list())){
        $conObg->detach();
        echo "You fool, Get Lost";
    }
    else{
        // print status
        $status_qry = "SELECT given_name, zone_name, IF(u_id != 0, u_id, '--') as u_id, IF(u_id != 0, (SELECT `name` FROM `_user711qd9m` WHERE id = u_id), '--') as user_name, 
        current_status, status FROM printe3242342r_status234232077 ps 
        join print43er_details234c23452 pd on ps.printer_id = pd.printer_id 
        join printer_status_code psc on psc.s_code = pd.current_status 
        join zones as zn on zn.zone_id = pd.zone_id
        WHERE pd.zone_id = $data->zone_code;";
        $res = mysqli_fetch_all(mysqli_query($link, $status_qry), MYSQLI_ASSOC);
        $printer_count = sizeof($res);
        $zone_name = $printer_count > 0 ? $res[0]['zone_name'] : "Unknown"; 
        $status_data = $res;


        // abort code
        $has_abort_qry = "SELECT num as 'index', name, id, printer_name FROM `prin23422ting_queue21314` pq join _user711qd9m usr on pq.u_id = usr.id join print43er_details234c23452 pd on pd.printer_id = pq.p_id where pq.abort = 1 and pd.zone_id = $data->zone_code;";
        $res = mysqli_fetch_all(mysqli_query($link, $has_abort_qry), MYSQLI_ASSOC);
        $abort_count = sizeof($res);
        $abort_list = $res;
        if($abort_count > 0)
        {
            foreach($res as $user)
            {
                $index= $user['index'];
                $id = $user['id'];
                // aborting that user
                $abort_qry = "DELETE FROM `prin23422ting_queue21314` WHERE u_id = $id";
                mysqli_query($link, $abort_qry);
                $priority_reset_qry = "UPDATE `prin23422ting_queue21314` SET `num`= `num` - 1 WHERE `num` > $index";
                mysqli_query($link, $priority_reset_qry);
                $user_table_update_qry = "UPDATE `_user711qd9m` SET `currently_printing` = 0 WHERE id = $id;";
                mysqli_query($link, $user_table_update_qry);
            }

        }

        // queue size
        $max_queue_qry = "SELECT max_capacity FROM `zones` where zone_id = $data->zone_code;";
        $res = mysqli_fetch_all(mysqli_query($link, $max_queue_qry), MYSQLI_ASSOC);
        $max_queue_size = $res[0]['max_capacity'];


        // queue details 
        $queue_details_qry = "SELECT num as 'index', name, id, given_name as 'printer_name', if(current_status != 1, '--', (TIME_FORMAT(DATE_ADD(CURRENT_TIME(), INTERVAL wait_time SECOND), '%h:%i:%s %p'))) as 'time' 
        FROM `prin23422ting_queue21314` pq join _user711qd9m usr on pq.u_id = usr.id 
        join print43er_details234c23452 pd on pd.printer_id = pq.p_id WHERE pd.zone_id = $data->zone_code ORDER BY pq.num ASC";
        $res = mysqli_fetch_all(mysqli_query($link, $queue_details_qry), MYSQLI_ASSOC);
        $punch_data = $res;

        
        // getting less busy printer
        if(sizeof($punch_data) < $max_queue_size)
        {
            $less_busy_printer_qry = "SELECT given_name , 
            TIME_FORMAT(DATE_ADD(CURRENT_TIME(), INTERVAL required_time SECOND), '%h:%i:%s %p') as 'time' 
            FROM `printe3242342r_status234232077` ps left join print43er_details234c23452 pd on ps.printer_id = pd.printer_id 
            WHERE pd.current_status = 1 and pd.zone_id = $data->zone_code ORDER by `required_time` ASC LIMIT 1";
            $res = mysqli_fetch_all(mysqli_query($link, $less_busy_printer_qry), MYSQLI_ASSOC);
            //print_r($res);
            if($res){
                $index = sizeof($punch_data) + 1;
                $printer_name = $res[0]['given_name'];
                $time = $res[0]['time'];
                array_push($punch_data, array(
                    "index" => $index,
                    "name"  => "--",
                    "id" => "--",
                    "printer_name" => $printer_name,
                    "time" => $time
                ));
            }

        }

        $response = array(
            "zone_name" => $zone_name,
            "printer_count" => $printer_count,
            "status_data" => $status_data,
            "abort_count" => $abort_count,
            "abort_list" => $abort_list,
            "queue_size" =>$max_queue_size,
            "punch_data" => $punch_data,
        );
        http_response_code(200);
        echo json_encode($response);
        $conObg->detach();
    }

?>