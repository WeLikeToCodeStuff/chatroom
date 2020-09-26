<?php
    session_start();
    $dbServername = "95.217.53.138";
    $dbUsername = "jackthepug";
    $dbPassword = "SJ7ivQL4c68Brgv";
    $db = "jackthep_test";
    
    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $db);

    $message = $_POST["textBox"];
    $user = $_SESSION["name"];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
                
    $sql = "INSERT INTO messages (user, content) VALUES ('$user', '$message')";
    $result = $conn->query($sql);
?>