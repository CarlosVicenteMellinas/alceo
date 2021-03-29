<?php

function validarNick($link) {
    $nick = limpiarDatos($_POST['nick']);
    $valido = true;

    if (strlen($nick) > 20) {
        mysqli_close($link);
        $valido = false;
        $nickError = 'El nick no puede tener una longitud superior a 20 caracteres';
        include '../paginas/signin.php';
    }
    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE nickname="'.$nick.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nickError = 'El nick no esta disponible';
        include '../paginas/signin.php';
    }
    return $valido;
}

function validarContrasena($link) {
    $contrasena1 = limpiarDatos($_POST['contrasena']);
    $contrasena2 = limpiarDatos($_POST['contrasena2']);
    $valido = true;

    if (strlen($contrasena1) < 8) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña debe de tener una longitud superior a 8 caracteres';
        include '../paginas/signin.php';
    }

    if (!preg_match('`[a-z]`', $contrasena1)) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña debe de tener al menos una letra minúscula';
        include '../paginas/signin.php';
    }

    if (!preg_match('`[A-Z]`', $contrasena1)) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña debe de tener al menos una letra mayúscula';
        include '../paginas/signin.php';
    }

    if (!preg_match('`[0-9]`',$contrasena1)){
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña debe de tener al menos un caracter numérico';
        include '../paginas/signin.php';
    }

    if ($contrasena2 !== $contrasena1) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'Las contraseñas no coinciden';
        include '../paginas/signin.php';
    }

    return $valido;
}

function validarCorreo($link) {
    $correo = limpiarDatos($_POST['correo']);
    $valido = true;

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        mysqli_close($link);
        $valido = false;
        $emailError = 'La direccion introducida no es válida';
        include '../paginas/signin.php';
    }

    return $valido;
}

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function comprobarDatos() {
    $link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
    if (validarNick($link) && validarContrasena($link) && validarCorreo($link)) {
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


if (!empty($_POST['nombre']) && !empty($_POST['nick']) && !empty($_POST['contrasena']) && !empty($_POST['contrasena2']) && !empty($_POST['correo']) && !empty($_POST['telefono']) && !empty($_POST['plan'])) {
    comprobarDatos();
} else {
    echo 'Pagina de error';
}

?>