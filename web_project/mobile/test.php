<?php
    $hostname = "http://185.27.134.10";
    $username = "epiz_33614880";
    $password = "VYEb0Z5dM8fAMZ";
    $database = "epiz_33614880_user_visit";

    $conn = new mysqli($hostname, $username, $password, $database);
    if($conn->connect_error){
        die("Connection failed: " .$conn->connect_error);
    }
    $sql = 'INSERT INTO Ip_user_active_logs (Ip_logs)
    VALUES ("'.$_SERVER['REMOTE_ADDR'].'")';

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
$conn->close();
?>