<?php
    $server_name = "localhost";
    $user = "root";
    $password = "";
    //$port = "3306";
    $database = "php";

    $connect = mysqli_connect($server_name, $user, $password, $database);
    mysqli_select_db($connect, $database) or die("DB failed");//데이터베이스가 실제로 존재하는 지

?>