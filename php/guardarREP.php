<?php
require 'db_config.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$servicio = $_POST['servicio'];
$fecha = $_POST['fecha'];
$comentario = $_POST['comentario'];

// Si eligió "Otro...", sustituir el valor
if ($servicio === 'Otro' && !empty($_POST['otro_servicio'])) {
    $servicio = "Otro: " . $_POST['otro_servicio'];
}

$sql = "INSERT INTO citas (nombre, correo, servicio, fecha, comentario)
        VALUES ('$nombre', '$correo', '$servicio', '$fecha', '$comentario')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Cita agendada correctamente.');
        window.location.href = '../reparaciones.html';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>