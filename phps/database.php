<?php 

    $localhost = "localhost";
    $username = "root";
    $password = "";
    $db_name = "attendance_tracking-system";

    $conn = mysqli_connect($localhost,
                        $username, 
                        $password, 
                        $db_name);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>