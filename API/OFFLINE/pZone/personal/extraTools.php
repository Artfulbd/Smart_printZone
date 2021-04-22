<?php
    class Tools {
        private $fileReqUrl = "http://something.php";
        private $comming_in_list = array('id','key','machine');
        private $take_file_list = array('id','key','pc_name','file_count','files');
        private $remove_file_list = array('id','key','pc_name','file_name','time', 'pg_count','size');
        private $any_update_list = array('ip','key','machine');
        private $punch_list = array('id','punch_time','zone_code','key','ip');
        private $server_dir = "\\\DESKTOP-5RNDV53\ServerFolder";

        function _validate($data, $list){
            if($data == null){
                return false;
            }
            $size = count($list); $i = 0;
            // checking for property presence and injection
            while($i < $size && property_exists($data, $list[$i]) && $this->test_input($data->{$list[$i++]}));
            return ($size == $i && $this->checkKey($data));
        }

        private function checkKey($data){
            //check key machanism here
            return true;
        }
        function get_server_dir(){
            return $this->server_dir;
        }
        function count_page($path) {
            $num = 0;
            if(file_exists($path)){
                $raw = file_get_contents($path);
                $num = preg_match_all("/\/Page\W/", $raw, $dummy);
            }            
            return $num;
          }
        function get_comming_list(){
            return $this->comming_in_list;
        }
        function get_any_update_list(){
            return $this->any_update_list;
        }
        function take_file_list(){
            return $this->take_file_list;
        }
        function remove_file_list(){
            return $this->remove_file_list;
        }
        function get_punch_list(){
            return $this->punch_list;
        }

        function test_input($data) {  // return true if VALID
            //$data = trim($data);
            $operators = array(
                'select *',
                'select',
                'union all',
                'union',
                'all',
                'where',
                'and 1',
                'and',
                'or',
                '1=1',
                '2=2',
                '--',
                '--',
                '_',
                '- --'
            );
           
            if(is_array($data) || is_object($data))
            {
                $isInjection = false;
                foreach($data as $value)
                {
                    $isInjection =  $this->test_input($value) ? false : true;
                    if($isInjection) return false;
                }
                return true;
            }
            else
            {
                foreach($operators as $operator)
                {
                    if (preg_match("/".$operator."/i", urldecode(strtolower(trim($data))))) {
                        return false;
                    }
                }
                $holdOn = $data;
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return strcmp($holdOn,$data)? false : true;
            }
        }

        // post request to server, cURL
        function make_req($url, $load ){
            //url-ify the data for the POST
            $json_string = json_encode($load);

            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $json_string);

            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

            //execute post
            $result = curl_exec($ch);
            return $result;
        }

        //get client IP address
        function get_client_ip() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
    }  
    
?>