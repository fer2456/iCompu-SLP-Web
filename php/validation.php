<?php
require 'db_config.php';

$usuario = $_POST['usuario'];
$password = $_POST['password'];


/*$usuario = $conn->real_escape_string($usuario);
$password = $conn->real_escape_string($password);*/

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
$result = $conn->query($sql);
if (empty($usuario) || empty($password)) {
    echo "<script>
        alert('Completa todos los campos.');
        window.location.href = '../login.html';
    </script>";
    exit();
}

if ($result && $result->num_rows === 1) {

    header("Location: ../empleados.php");
    exit();
} else {
    echo "<script>
        alert('Usuario o contraseña incorrectos.');
        window.location.href = '../login.html';
    </script>";
}

$conn->close();
?>