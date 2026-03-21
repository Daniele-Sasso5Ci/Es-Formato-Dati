<?php
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

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

    $xmlPath = new DOMXPath($xml);

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/nome";
    $risultato = $xmlPath->query($query);
    $nome = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/cognome";
    $risultato = $xmlPath->query($query);
    $cognome = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/datanascita";
    $risultato = $xmlPath->query($query);
    $datanascita = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/classe";
    $risultato = $xmlPath->query($query);
    $classe = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/votomateria/italiano";
    $risultato = $xmlPath->query($query);
    $votomateria["italiano"] = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/votomateria/matematica";
    $risultato = $xmlPath->query($query);
    $votomateria["matematica"] = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/votomateria/storia";
    $risultato = $xmlPath->query($query);
    $votomateria["storia"] = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/votomateria/informatica";
    $risultato = $xmlPath->query($query);
    $votomateria["informatica"] = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/votomateria/sistemiereti";
    $risultato = $xmlPath->query($query);
    $votomateria["sistemiereti"] = $risultato->item(0)->nodeValue;

    $query = "/registro/alunno[". $_SESSION["user_id"] ."]/votomateria/tps";
    $risultato = $xmlPath->query($query);
    $votomateria["tps"] = $risultato->item(0)->nodeValue;
?>

<html>
    <header>
        <title>Benvenuto!</title>
    </header>
    <style>
        body{
            /*background-color: rgb(165, 249, 255);*/
            background-image: url("background.jpg");
            font-family: "Cascadia Mono", Italic;
            font-size: medium;
            color: #1E293B;
        }
        table, th, td{
            border-width: 1px;
            border-style: double;
            text-align: center;
            background-color: #F8FAFC;
            backdrop-filter: blur(5px);
        }
        .center{
            position: absolute;
            left: 20px;
            right: 20px;
            top: 5px;
        }
    </style>
    <body>
        <div class="center">
            <h2>Benvenuto <?php echo $nome . " " . $cognome;?>!</h2>
            Data di nascita: <?php echo $datanascita; ?>
            <br>
            Classe: <?php echo $classe; ?>
            <br><br><br>
            Registro voti
            <table>
                <tr>
                    <th><b>Nome Materia</b></th>
                    <th><b>Voto Materia</b></th>
                </tr>
                <tr>
                    <td>Italiano</td>
                    <td>
                        <span style="color: <?php echo ($votomateria['italiano'] >= 6) ? 'green' : 'red'; ?>;">
                            <?php echo $votomateria["italiano"]; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Matematica</td>
                    <td>
                        <span style="color: <?php echo ($votomateria['matematica'] >= 6) ? 'green' : 'red'; ?>;">
                            <?php echo $votomateria["matematica"]; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>storia</td>
                    <td>
                        <span style="color: <?php echo ($votomateria['storia'] >= 6) ? 'green' : 'red'; ?>;">
                            <?php echo $votomateria["storia"]; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Informatica</td>
                    <td>
                        <span style="color: <?php echo ($votomateria['informatica'] >= 6) ? 'green' : 'red'; ?>;">
                            <?php echo $votomateria["informatica"]; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Sistemi e Reti</td>
                    <td>
                        <span style="color: <?php echo ($votomateria['sistemiereti'] >= 6) ? 'green' : 'red'; ?>;">
                            <?php echo $votomateria["sistemiereti"]; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Tecnologie per la Progettazione del Software</td>
                    <td>
                        <span style="color: <?php echo ($votomateria['tps'] >= 6) ? 'green' : 'red'; ?>;">
                            <?php echo $votomateria["tps"]; ?>
                        </span>
                    </td>
                </tr>
            </table>
            <br><br>
            <a href="logout.php">Logout</a>
        </div>
    </body>
</html>

