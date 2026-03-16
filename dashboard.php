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

<h2>Benvenuto <?php echo $nome . " " . $cognome;?></h2>
Data di nascita: <?php echo $datanascita; ?>
<br>
Classe: <?php echo $classe; ?>

<p>Sei nella pagina riservata.</p>

<a href="logout.php">Logout</a>