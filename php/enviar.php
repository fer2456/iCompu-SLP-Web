<?php
/*$destino = "idesing.slp20@gmail.com";*/
$recaptchaSecret = "TU_SECRET_KEY";



if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $verificacion = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$captcha&remoteip=$ip");
    $respuesta = json_decode($verificacion);

    if (!$respuesta->success) {
        die("Error: reCAPTCHA no verificado.");
    }
} else {
    die("Error: reCAPTCHA faltante.");
}

function limpiar($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

$nombre = limpiar($_POST['nombre'] ?? '');
$email = limpiar($_POST['email'] ?? '');
$mensaje = limpiar($_POST['mensaje'] ?? '');


if (empty($nombre) || empty($email) || empty($mensaje)) {
    die("Error: Todos los campos son obligatorios.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: El correo no es válido.");
}

$destino = "fernandootero40gmail.com";
$asunto = "Nuevo mensaje desde el formulario de contacto";
$cuerpo = "
  <html>
    <body>
      <h2>Nuevo mensaje de contacto</h2>
      <p><strong>Nombre:</strong> $nombre</p>
      <p><strong>Correo:</strong> $email</p>
      <p><strong>Mensaje:</strong><br>$mensaje</p>
    </body>
  </html>";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";


if (mail($destino, $asunto, $cuerpo, $headers)) {
    header("Location: gracias.html");
    exit();
} else {
    echo "Error al enviar el mensaje.";
}

?>