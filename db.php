<?php


function connect_db() {

    $conn = new mysqli("localhost","root","","h");
    if ($conn->connect_error){
        die("connect error".$conn->$connect_error);
    }
    // $conn->close();

    return $conn;
}

?>