<?php
require "config.php";

$div_messaggio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    $prova = file_get_contents('registro.json');
    $data = json_decode($prova, true);
    $percorsofile = $data["datasource"]["path"];

    if (file_exists($percorsofile)) {
            $xml = new DOMDocument();
            $xml->load($percorsofile);
        } else {
            die("Errore: File XML non trovato.");
        }

        if($xml->validate()){
        } else {
            echo "Il documento non è valido";
        }

    $xpath = new DOMXPath($xml);

    $query = "/registro/alunno[".$id."]";
    $risultato = $xpath->query($query);

    if ($risultato->length > 0 && strlen($id)==5) {
        // L'ID è stato trovato
        $username = $_POST["username"];
        $password = $_POST["password"];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO utenti (id, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $id, $username, $hashed_password);

        if ($stmt->execute()) {
            $div_messaggio = "<div class='corretto'><span>Registrazione effettuata! Torna alla home per accedere.</span></div>";
        } else {
            // Controlliamo se l'errore è un duplicato (codice 1062)
            if ($stmt->errno == 1062) {
                // Verifichiamo se il messaggio d'errore contiene la parola 'id' o 'username'
                if (strpos($stmt->error, 'PRIMARY') !== false || strpos($stmt->error, 'id') !== false) {
                    $div_messaggio = "<div class='errore'><span>ID già registrato!</span></div>";
                } elseif (strpos($stmt->error, 'username') !== false) {
                    $div_messaggio = "<div class='errore'><span>Username già esistente!</span></div>";
                } else {
                    $div_messaggio = "<div class='errore'><span>Dati duplicati! Controlla ID e Username.</span></div>";
                }
            } else {
                $div_messaggio = "<div class='errore'><span>Errore di registrazione: " . $stmt->error . "</span></div>";
            }
        }

        $stmt->close();
    } else {
        $div_messaggio = "<div class='errore'><span>Id non valido!</span></div>";
    }

}
?>

<html>
    <head>
        <title>Registrati</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cascadia+Mono:ital,wght@0,200..700;1,200..700&display=swap');
            body{
                background-image: url("background.jpg");
                font-family: "Cascadia Mono", Italic;
                font-size: medium;
                color: #1E293B;
            }
            .center {
                display: flex;
                justify-content:center;
                align-items: baseline;
                height: 250px;
                width: 500px;
                background-color: #F8FAFC;
                backdrop-filter: blur(5px);
                border-width: 1px;
                border-style: double;
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
            .corretto{
                position: absolute;
                background-color: green;
                height: 50px;
                left: 0px;
                right: 0px;
                top: 0px;
                text-align: center;
                color: white;
            }
            .errore{
                position: absolute;
                background-color: red;
                height: 50px;
                left: 0px;
                right: 0px;
                top: 0px;
                text-align: center;
                color: white;
            }
            span{
                position: relative;
                top: 12.5px;
            }
        </style>
    </head>
    <body>
        <?php echo $div_messaggio; ?>
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