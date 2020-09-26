<?php
    $dbServername = "95.217.53.138";
    $dbUsername = "jackthepug";
    $dbPassword = "SJ7ivQL4c68Brgv";
    $db = "jackthep_test";
    
    
    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $db);
    
    session_start();
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $pass = $_POST["pass"];
    $user = $_POST["user"];
    $sql = "SELECT username FROM users WHERE pass = '$pass'";
    
    $blCheckQuery = "SELECT blacklisted FROM users WHERE username = '$user'";
    $blReasonQuery = "SELECT blReason FROM users WHERE username = '$user'";
    $adminCheck = "SELECT admin FROM users WHERE username = '$user'";
    
    $blCheck = $conn->query($blCheckQuery);
    $blReason = $conn->query($blReasonQuery);
    $admin = $conn->query($adminCheck);

    $adminRow = $admin->fetch_assoc();
    $blCheckRow = $blCheck->fetch_assoc();
    $blReasonRow = $blReason->fetch_assoc();

    $blr = $blReasonRow["blReason"];

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row["username"] == $user && $blCheckRow["blacklisted"] != 1) {
      header("Location:https://jackthepug.tk/chatroom/chat.php");
      $_SESSION["name"] = $user;
      $_SESSION["isAdmin"] = $adminRow["admin"];
    } else if ($blCheckRow["blacklisted"] == 1) {
      echo ("Login Failed!<br>You are blacklisted from chatroom.<br>Reason: '$blr'");  
    } else {
      echo("Login Invalid");
    }
    //$conn->close();
    
?>