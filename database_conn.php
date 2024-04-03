<?php

    $db_name = "tasks_db";
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";


    try {
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        
    } catch (mysqli_sql_exception $e) {
        echo "<b>"."Unable to connect to database: ". $e->getMessage() ."</b><br>";
    }

    // if ($conn) {
    //     echo"Connected!";
    // } else {
    //     echo"Unable to connect";
    // }
?>