<?php
 
if(!empty($_POST['submit_contacto'])) {
    $nombre = "";
    $email = "";
    $asunto = "";
    $concerned_department = "";
    $mensaje = "";
    $recipient = "contact@domain.com";
     
    if(isset($_POST['nombre'])) {
      $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['correo'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['correo']);
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
     /*
    if(mail($recipient, $asunto, $mensaje, $headers)) {
        echo "<p>Gracias por contactarnos, $nombre. Recibiras una respuesta en menos de 24 horas.</p>";
    } else {
        echo '<p>No se ha podido enviar el correo.</p>';
    }*/

    $respuesta =  "<p>Gracias por contactarnos, $nombre. Recibiras una respuesta en menos de 24 horas.</p>";
    include '../paginas/mail.php';
} else if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    $correo = $_POST['email'];
    $nombre = $_POST['name'];
    $mensaje = $_POST['message'];
    include '../paginas/contacto.php';
} else if (!empty($_POST['name']) && !empty($_POST['email'])) {
    $correo = $_POST['email'];
    $nombre = $_POST['name'];
    include '../paginas/contacto.php';
} else if (!empty($_POST['name']) && !empty($_POST['message'])) {
    $mensaje = $_POST['message'];
    $nombre = $_POST['name'];
    include '../paginas/contacto.php';
} else if (!empty($_POST['email']) && !empty($_POST['message'])) {
    $mensaje = $_POST['message'];
    $correo = $_POST['email'];
    include '../paginas/contacto.php';
} else if (!empty($_POST['email'])) {
    $correo = $_POST['email'];
    include '../paginas/contacto.php';
} else if (!empty($_POST['message'])) {
    $mensaje = $_POST['message'];
    include '../paginas/contacto.php';
} else if (!empty($_POST['name'])) {
    $nombre = $_POST['name'];
    include '../paginas/contacto.php';
} else {
    header("Location: /paginas/fail.php");
}
 
?>