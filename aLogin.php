<?php
    session_start();
    $dbServername = "95.217.53.138";
    $dbUsername = "jackthepug";
    $dbPassword = "SJ7ivQL4c68Brgv";
    $db = "jackthep_test";
    
    
    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $db);
      
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $pass = $_POST["pass"];
    $user = $_POST["user"];
    $sql = "SELECT username FROM users WHERE pass = '$pass'";
    
    $adminCheckQuery = "SELECT admin FROM users WHERE username = '$user'";
    
    $adminCheck = $conn->query($adminCheckQuery);

    $adminCheckRow = $adminCheck->fetch_assoc();

    $superAdminCheckQuery = "SELECT superAdmin FROM users WHERE username = '$user'";
    
    $superAdminCheck = $conn->query($superAdminCheckQuery);

    $superAdminCheckRow = $superAdminCheck->fetch_assoc();

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row["username"] == $user && $adminCheckRow["admin"] == 1) {
        echo "<form action='banUser.php' method='post'>Ban Account<br>Username<br><input name='banusername', type='text'><br>Reason<br><input name='reason', type='text'><br><input name='submitBan' type='submit'></form><br><br><form action='unban.php' method='post'>Unban User<br><input name='unbanname' type='text'><input name='submitUnban' type='submit'></form><br>";
        echo"<form action='nameColor.php' method='post'>Change Name Color<br><input type='text' name='nColor'><input type='submit'></form>";
        $_SESSION["cName"] = $user;
        if ($superAdminCheckRow["superAdmin"] == 1) {
            echo "<form action='promoteUser.php' method='post'>Promote Account<br>Username<br><input name='promousername', type='text'><input type='submit'></form><br><br><form action='demoteUser.php' method='post'>Demote Account<br>Username<br><input name='demoUsername', type='text'><input type='submit'><br><br><br>";
        }
    } else if ($adminCheckRow["admin"] != 1) {
        echo ("Login Failed!<br>You are not permitted to do that.");  
    } else {
        echo("Login Invalid");
    }
    //$conn->close();
    
?>