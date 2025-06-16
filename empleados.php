<?php
require 'php/db_config.php';

// Obtener citas de los próximos 7 días
$lunes = date('Y-m-d', strtotime('monday this week'));
$domingo = date('Y-m-d', strtotime('sunday this week'));

$sql = "SELECT id, nombre, fecha FROM citas WHERE fecha BETWEEN '$lunes' AND '$domingo' ORDER BY fecha ASC";
$result = $conn->query($sql);

// Si seleccionaron una cita
$detalle = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $detalle_sql = "SELECT * FROM citas WHERE id = $id";
    $detalle_result = $conn->query($detalle_sql);
    if ($detalle_result->num_rows > 0) {
        $detalle = $detalle_result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Citas Agendadas</title>
    <link rel="stylesheet" href="css/estilos.css" />
</head>
<body>
    <header class="header">
    <nav>
      <div class="contenedor-logo">
            <img src="img/logo.png" alt="Logo" class="logo" id="logo"/>
        </div>
      <ul class="nav-links">
        <div class="active">
          <li><a  href="index.html">Inicio</a></li>
        </div>
        <div>
          <li><a href="productos.html">Productos</a></li>
        </div>
        <div>
          <li><a  href="reparaciones.html">Reparaciones y Servicios</a></li>
        </div>
        <div>
          <li><a href="contacto.html">Contacto</a></li>
        </div>
      </ul>
    </nav>
  </header>
    <h2>Citas para los próximos 7 días</h2>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <a href="empleados.php?id=<?php echo $row['id']; ?>">
                    <?php echo $row['fecha'] . " - " . htmlspecialchars($row['nombre']); ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>

    <?php if ($detalle): ?>
        <hr>
        <h3>Detalles de la cita</h3>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($detalle['nombre']); ?></p>
        <p><strong>Correo:</strong> <?php echo htmlspecialchars($detalle['correo']); ?></p>
        <p><strong>Servicio:</strong> <?php echo htmlspecialchars($detalle['servicio']); ?></p>
        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($detalle['fecha']); ?></p>
        <p><strong>Comentario:</strong> <?php echo nl2br(htmlspecialchars($detalle['comentario'])); ?></p>
    <?php elseif (isset($_GET['id'])): ?>
        <p><em>No se encontró la cita seleccionada.</em></p>
    <?php endif; ?>
</body>
</html>

<?php $conn->close(); ?>