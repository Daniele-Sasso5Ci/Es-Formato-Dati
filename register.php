<?php
require "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO utenti (id, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id, $username, $hashed_password);

    if ($stmt->execute()) {
        $message = "Registrazione completata!";
    } else {
        $message = "Username già esistente!";
    }

    $stmt->close();
}
?>

<html>
    <head>
        <title>Registrati</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cascadia+Mono:ital,wght@0,200..700;1,200..700&display=swap');
            body{
                background-color: rgb(165, 249, 255);
                font-family: "Cascadia Mono", Italic;
                font-size: medium;
            }
            .center {
                background-color: rgb(119, 255, 214);
                display: flex;
                justify-content:center;
                align-items: baseline;
                height: 250px;
                width: 500px;
                border: 3px solid green;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            form{
                position: absolute;
                align-items: center;
            }
            h4{
                text-align: center;
            }
            button{
                position: absolute;
                width: 100px;
                left: 30%;
            }
            .return{
                position: absolute;
                bottom: 5px;
                left: 40%
            }
        </style>
    </head>
    <body>
        <div class="center">
            <form method="POST" autocomplete="off">
                <h4>Registrati!</h4>
                ID: <input type="text" name="id" autocomplete="off" required><br><br>
                Username: <input type="text" name="username" autocomplete="off" required><br><br>
                Password: <input type="password" name="password" autocomplete="new-password" required><br><br>
                <button type="submit">Registrati</button>
            </form>
        </div>
        <a href="index.html" class="return">Torna alla home!</a>
    </body>
</html>