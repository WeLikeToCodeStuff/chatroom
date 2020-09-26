<?php
    $dbServername = "95.217.53.138";
    $dbUsername = "jackthepug";
    $dbPassword = "SJ7ivQL4c68Brgv";
    $db = "jackthep_test";
                    
    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
                      
    $sql = "SELECT * FROM messages ORDER BY id DESC LIMIT 4";
    $result = $conn->query($sql);
                      
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $user = $row["user"];
            $sql2 = "SELECT admin FROM users WHERE username = '$user'";
            $res2 = $conn->query($sql2);
            $r2row = $res2->fetch_assoc();
            if ($r2row["admin"] == 1) {
                echo "<p style='color: lime'>" . $row['user'] . ": " . $row["content"]. " " . "</p><br>";    
            } else {
                echo "<p>" . $row['user'] . ": " . $row["content"]. " " . "</p><br>";
            }
        }
    } else {
        echo "No messages to show here. Type something here to be the first one!";
    }
    $conn->close();
?>