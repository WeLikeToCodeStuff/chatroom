<?php
    session_start();
    $sessionUser = $_SESSION["name"];
    $isAdmin = $_SESSION["isAdmin"];

    if (!$sessionUser) {
        header("Location:https://jackthepug.tk/chatroom/");
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Chatroom</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(() => {
                var msg = $(".textBox").val()

                $(document).on("keypress", (key) => {
                    if (key.which == 13) {
                        $.ajax({
                            url: "sendMessage.php",
                            type: "POST",
                            dataType: "text",
                            data: {textBox: $(".textBox").val()}
                        })
                        $(".textBox").val(" ")  
                    }
                })
                $("#snd").click(() => {
                    if ($(".textBox").val() == undefined || $(".textBox").val() == " ") {
                        return
                    }
                    $.ajax({
                        url: "sendMessage.php",
                        type: "POST",
                        dataType: "text",
                        data: {textBox: $(".textBox").val()}
                    })
                    $(".textBox").val(" ")
                })
                setInterval(() => {
                    $(".messages").load("getMessages.php");
                }, 500)
            })
        </script>
    </head>
    <body>
        <p id="p">Logged in as <?php echo $sessionUser?></p>
        <?php
            if ($isAdmin == 1) {
                echo("<a href='adminLogin.php'>Admin Panel</a>");
            }
        ?>
        <div class="chat">
            <div class="messages">
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
                    $colorSql = "SELECT nameColor FROM users WHERE username = '$user'";
                    $colorResult = $conn->query($colorSql);
                    $colorRow = $colorResult->fetch_assoc();
                    $result = $conn->query($sql);
                    $color = $colorRow["nameColor"];
                       
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
            </div>
            <textarea class="textBox" name="textBox" placeholder="Send a message"></textarea>
            <button id="snd" name="send">Send</button>
        </div>
    </body>
</html>