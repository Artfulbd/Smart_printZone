<?php

    class ConnectTo{
        private $host = 'localhost';
        private $user = 'root';
        private $pass = '';
        private $pZonedb = 'smartprintzone';
        private $link;
        function __construct($dbFor) {
            if(!strcmp($dbFor,'original'))$this->link = mysqli_connect($this->host , $this->user , $this->pass, $this->pZonedb) or die("cannot connect");
            else $this->link = null;
        }
        function giveLink(){
            return $this->link;
        }
        function detach(){
            mysqli_close($this->link);
        }
        
    }
 ?>