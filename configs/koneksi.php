<?php

    $connect = new mysqli("localhost","root","","apoteksehati");

    if($connect->connect_error){
        die ("koneksi err");
    }
    
    session_start();
?>