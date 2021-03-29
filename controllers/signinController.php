<?php

function validarNick($link) {
    $nick = limpiarDatos($_POST['nick']);
    if (strlen($nick) > 20) {
        mysqli_close($link);
        $nickError = 'El nick no puede tener una longitud superior a 20 caracteres';
        include '../paginas/signin.php';
    }
    $query = mysqli_query($link, 'SELECT * FROM USUARIOS WHERE nickname="'.$nick.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $nickError = 'El nick no esta disponible';
        include '../paginas/signin.php';
    } else {
        echo '<p>Casi crack</p>';
    }
}

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function comprobarDatos() {
    $link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
    if (validarNick($link)) {
        crearUsuario();
    }
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