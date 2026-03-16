<?php
    $prova = file_get_contents('registro.json');
    var_dump($prova);
    $data = json_decode($prova, true);
    $percorsofile = $data["datasource"]["path"];
    var_dump($percorsofile);

    if (file_exists($percorsofile)) {
        $xml = new DOMDocument();
        $xml->load($percorsofile);
    } else {
        die("Errore: File XML non trovato.");
    }
    var_dump($xml);

    if($xml->validate()){
        echo "Il documento è valido";
    } else {
        echo "Il documento non è valido";
    }

    $xmlPath = new DOMXPath($xml);

    $indice = 0;
    $idConf=003;

    do{
        $indice++;
        $query = "/registro/alunno[" . $indice . "]/id";
        $risultato = $xmlPath->query($query);
    }while($risultato->item(0)->nodeValue != $idConf);
    $query = "/registro/alunno[". $indice ."]/classe";
    $classe = $xmlPath->query($query);
    $query = "/registro/alunno[". $indice ."]/nome";
    $nome = $xmlPath->query($query);
    echo "<br><br>Classe: " . $classe->item(0)->nodeValue . "<br>Nome: ". $nome->item(0)->nodeValue;
?>