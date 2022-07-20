<?php
 define('DB_NAME','cuurency_app');
 define('DB_USER','root');
 define('DB_PASSWORD','12345');
 define('DB_HOST','localhost');

class DbConnect{
   
    function __construct(){

    }

    function connect(){
        $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if(mysqli_connect_error()){
            echo "Failed to connect with database".mysqli_connect_error();            
        }
        return $this->con;
    }

}


?>