<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "root";
$db   = "registro_elettronico";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
