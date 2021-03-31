<?php
require_once "../model/db.php";

function validarNombre($link) {
    $nombre = limpiarDatos($_POST['nombre']);
    $valido = true;

    if (strlen($nombre) > 200) {
        mysqli_close($link);
        $valido = false;
        $nombreError = 'El nombre no puede tener una longitud superior a 200 caracteres';
        cargarPaginaSignin();
    }

    return $valido;
}

function validarNick($link) {
    $nick = limpiarDatos($_POST['nick']);
    $valido = true;

    if (strlen($nick) > 20) {
        mysqli_close($link);
        $valido = false;
        $nickError = 'El nick no puede tener una longitud superior a 20 caracteres';
        cargarPaginaSignin();
    }
    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE nickname="'.$nick.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nickError = 'El nick no esta disponible';
        cargarPaginaSignin();
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
        cargarPaginaSignin();
    }

    if (strlen($contrasena1) > 200) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña no puede tener una longitud superior a 200 caracteres';
        cargarPaginaSignin();
    }

    if (!preg_match('`[a-z]`', $contrasena1)) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña debe de tener al menos una letra minúscula';
        cargarPaginaSignin();
    }

    if (!preg_match('`[A-Z]`', $contrasena1)) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña debe de tener al menos una letra mayúscula';
        cargarPaginaSignin();
    }

    if (!preg_match('`[0-9]`',$contrasena1)){
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña debe de tener al menos un caracter numérico';
        cargarPaginaSignin();
    }

    if ($contrasena2 !== $contrasena1) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'Las contraseñas no coinciden';
        cargarPaginaSignin();
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
        cargarPaginaSignin();
    }

    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE correo="'.$correo.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $emailError = 'El correo ya esta registrado';
        cargarPaginaSignin();
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
    $link = Conectar::conexion();
    if (validarNombre($link) && validarNick($link) && validarContrasena($link) && validarCorreo($link)) {
        mysqli_close($link);
        crearUsuario();
    }
    mysqli_close($link);
}

function crearUsuario() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'INSERT INTO USUARIO (nombre, nickname, contrasenya, correo, telefono, plan) VALUES 
    ("'.$_POST["nombre"].'", "'.$_POST["nick"].'", "'.$_POST["contrasena"].'", "'.$_POST["correo"].'", "'.$_POST["telefono"].'", '.$_POST["plan"].')');
    mysqli_close($link);
    header("Location: ../paginas/area-usuario.php");
}

function cargarPaginaSignin() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM PLANES');
    $options = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
    }
    mysqli_close($link);
    include "../paginas/signin.php";
}

if (!empty($_POST['nombre']) && !empty($_POST['nick']) && !empty($_POST['contrasena']) && !empty($_POST['contrasena2']) && !empty($_POST['correo']) && !empty($_POST['telefono']) && !empty($_POST['plan'])) {
    comprobarDatos();
} else {
    cargarPaginaSignin();
}

?>