<?php
$host = "localhost";
$dbname = "servicio_tecnico";
$user = "root";
$pass = "";


$conn = new mysqli($host, $user, $pass, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>