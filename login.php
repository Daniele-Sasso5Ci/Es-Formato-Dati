<?php
    require "config.php";

    $error = ""; //Variabile per messaggi di errore. Serve per mostrare eventuali errori nel form. La useremo in seguito

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result(); //$stmt è un nome completamente arbitrario.Si potrebbe scrivere $miaQuery

    if ($stmt->num_rows > 0) {
             $stmt->bind_result($id, $hashed_password);
             $stmt->fetch();
             if (password_verify($password, $hashed_password)) {
            		$_SESSION["user_id"] = $id;
            		$_SESSION["username"] = $username;
            		header("Location: dashboard.php");//Indica al browser di caricare la pagina dashboard.php, a seconda della configurazione. 
                                                          //Reindirizza (redirect) il browser dell'utente verso un'altra pagina web 
            		exit();  			       } 
             else { $error = "Password errata!"; }
                             } 
    else { $error = "Utente non trovato!"; }

    $stmt->close();
                                           }
?>

<html>
    <head>
        <title>Accedi</title>
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
                height: 200px;
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
                <h4>Inserisci le credenziali per accedere!</h4>
                Username: <input type="text" name="username" autocomplete="off" required><br><br>
                Password: <input type="password" name="password" autocomplete="new-password" required><br><br>
                <button type="submit">Login</button>
            </form>
        </div>
        <a href="index.html" class="return">Torna alla home!</a>
    </body>
</html>
