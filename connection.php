<?php
    function connection(){
        $server_name = "localhost";
        $username = "root";
        $password = "";  //for mac user $password="root";
        $db_name = "minimart_catalog";

        //Create a connection
        $conn = new mysqli($server_name, $username, $password, $db_name);
        //$conn holds the connection
        //The value od $conn is a object
        //mysqli - class that contains cifferent functions and variables inside

        //Check the connectin
        if($conn->connect_error) { // Checks if there's an error in the connection
            die("Connection failed:".$conn->connect_error);
            //die() terminates the current script connection
            //$conn->connect_errr holds the error encountered during the attempt to connect
        } else {
            //No error. Successful connection
            return $conn;
        }
    }


?>