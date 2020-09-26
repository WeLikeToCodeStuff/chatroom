<?php

    $user = $_POST["user"];
    $pass = $_POST["pass"];

    $dbServername = "95.217.53.138";
    $dbUsername = "jackthepug";
    $dbPassword = "SJ7ivQL4c68Brgv";
    $db = "jackthep_test";
    
    
    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $db);
    
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, pass) VALUES ('$user', '$pass')";
    $userCheck = "SELECT username FROM users WHERE username = '$user'";
    $resCheck = $conn->query($userCheck);
    $row = $resCheck->fetch_assoc();
    
    if ($row["username"] == $user) {
        echo "That user already exists. <a href='/chatroom/signup.php'>Back</a>";
    } else {
        if ($conn->query($sql)) {
            echo "Signed up successfully. <a href='/chatroom/'>Back</a>";
        } else {
            echo "SQL Error: '$conn->error'";
        }
    }

?>