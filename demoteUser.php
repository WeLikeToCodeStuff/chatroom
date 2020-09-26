<?php

    $user = $_POST["demousername"];

    $dbServername = "95.217.53.138";
    $dbUsername = "jackthepug";
    $dbPassword = "SJ7ivQL4c68Brgv";
    $db = "jackthep_test";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $db);
      
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET admin = false WHERE username = '$user';";

    if ($conn->query($sql)) {
        echo "User demoted";
    } else {
        echo "Invalid Username! SQL Error: '$conn->error()'<br><br>SQL Query Ran: '$sql'";
    }

?>