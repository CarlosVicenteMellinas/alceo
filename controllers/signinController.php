<?php

function comprobarDatos() {
    crearUsuario();
}

function crearUsuario() {
    $link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
    $query = mysqli_query($link, 'INSERT INTO USUARIO (nombre, nickname, contrasenya, correo, telefono, plan) VALUES 
    ("'.$_POST["nombre"].'", "'.$_POST["nick"].'", "'.$_POST["contrasena"].'", "'.$_POST["correo"].'", "'.$_POST["telefono"].'", '.$_POST["plan"].')');
    mysqli_close($link);
    header("Location: ../paginas/area-usuario.html");
}


if (!empty($_POST['nombre']) && !empty($_POST['nick']) && !empty($_POST['contrasena']) && !empty($_POST['correo']) && !empty($_POST['telefono']) && !empty($_POST['plan'])) {
    comprobarDatos();
} else {
    echo 'Pagina de error';
}

?>