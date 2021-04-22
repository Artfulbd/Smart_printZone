<?php

    class ConnectTo{
        private $host = 'localhost';
        private $user = 'Ariful';
        private $pass = 'a1234';
        private $pZonedb = '_smartprintzone97830a1';
        private $link;
        function __construct($dbFor) {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            if(!strcmp($dbFor,'_smartprintzone97830a1'))
            {
                try{
                    $this->link = mysqli_connect($this->host , $this->user , $this->pass, $this->pZonedb) or die("cannot connect");
                }catch(Exception $e){
                    $this->link = null;
                }
            }
            else {
                $this->link = null;
            }
                
        }
        function giveLink(){
            return $this->link;
        }
        function detach(){
            mysqli_close($this->link);
        }
        
    }
 ?>