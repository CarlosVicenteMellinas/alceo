<?php
 
if($_POST['submit_contacto']) {
    $nombre = "";
    $email = "";
    $asunto = "";
    $concerned_department = "";
    $mensaje = "";
    $recipient = "contact@domain.com";
     
    if(isset($_POST['nombre'])) {
      $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
     
    if(isset($_POST['asunto'])) {
        $asunto = filter_var($_POST['asunto'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['mensaje'])) {
        $mensaje = htmlspecialchars($_POST['mensaje']);
    }
          
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
     
    if(mail($recipient, $asunto, $mensaje, $headers)) {
        echo "<p>Gracias por contactarnos, $nombre. Recibiras una respuesta en menos de 24 horas.</p>";
    } else {
        echo '<p>No se ha podido enviar el correo.</p>';
    }
     
} else {
    header("Location: /paginas/fail.php");
}
 
?>