<?php
require 'db_config.php';

$nombre = $_POST['nombre'];
$correo = $_POST['usuario'];
$password = $_POST['password'];
$confPassword = $_POST['confPassword'];

$sql_check = "SELECT * FROM usuarios WHERE usuario = '$correo'";
$result = $conn->query($sql_check);

if ($result && $result->num_rows > 0) {
    echo "<script>
        alert('El nombre de usuario ya está en uso. Por favor, elige otro.');
        window.location.href = '../signup.html';
    </script>";
    exit();
}
$sql="INSERT INTO usuarios ( nombreMP, usuario, password, tipUsuario)
        VALUES ('$nombre', '$correo', '$password', 3)";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Usuario creado correctamente.');
        window.location.href = '../login.html';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>