<?php

require_once "../model/db.php";
session_start();

$nombreError = ''; 
$nickError = '';
$contasenaError = ''; 
$emailError = '';
$NcontasenaError = '';

function validarNombre($link) {
    global $nombreError;

    $nombre = limpiarDatos($_POST['nombre']);
    $valido = true;

    if (strlen($nombre) > 200) {
        mysqli_close($link);
        $valido = false;
        $nombreError = 'El nombre no puede tener una longitud superior a 200 caracteres';
        cargarPaginaEdicion();
    }

    return $valido;
}

function validarNick($link) {
    global $nickError;

    $nick = limpiarDatos($_POST['nick']);
    $valido = true;

    if (strlen($nick) > 20) {
        mysqli_close($link);
        $valido = false;
        $nickError = 'El nick no puede tener una longitud superior a 20 caracteres';
        cargarPaginaEdicion();
    } else if (preg_match('`\s`', $nick)) {
        mysqli_close($link);
        $valido = false;
        $nickError = 'El nick no puede contener espacios';
        cargarPaginaEdicion();
    }
    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE nickname="'.$nick.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nickError = 'El nick no esta disponible';
        cargarPaginaEdicion();
    }
    return $valido;
}

function validarNContrasena($link) {
    global $NcontasenaError;

    $contrasena1 = limpiarDatos($_POST['Ncontrasena']);
    $contrasena2 = limpiarDatos($_POST['Ncontrasena2']);
    $valido = true;

    if (strlen($contrasena1) < 8) {
        mysqli_close($link);
        $valido = false;
        $NcontasenaError = 'La contraseña debe de tener una longitud superior a 8 caracteres';
        cargarPaginaEdicion();
    }

    else if (strlen($contrasena1) > 200) {
        mysqli_close($link);
        $valido = false;
        $NcontasenaError = 'La contraseña no puede tener una longitud superior a 200 caracteres';
        cargarPaginaEdicion();
    }

    else if (!preg_match('`[a-z]`', $contrasena1)) {
        mysqli_close($link);
        $valido = false;
        $NcontasenaError = 'La contraseña debe de tener al menos una letra minúscula';
        cargarPaginaEdicion();
    }

    else if (!preg_match('`[A-Z]`', $contrasena1)) {
        mysqli_close($link);
        $valido = false;
        $NcontasenaError = 'La contraseña debe de tener al menos una letra mayúscula';
        cargarPaginaEdicion();
    }

    else if (!preg_match('`[0-9]`',$contrasena1)){
        mysqli_close($link);
        $valido = false;
        $NcontasenaError = 'La contraseña debe de tener al menos un caracter numérico';
        cargarPaginaEdicion();
    }

    else if ($contrasena2 !== $contrasena1) {
        mysqli_close($link);
        $valido = false;
        $NcontasenaError = 'Las contraseñas no coinciden';
        cargarPaginaEdicion();
    }

    return $valido;
}

function validarCorreo($link) {
    global $emailError;

    $correo = limpiarDatos($_POST['correo']);
    $valido = true;

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        mysqli_close($link);
        $valido = false;
        $emailError = 'La direccion introducida no es válida';
        cargarPaginaEdicion();
    }

    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE correo="'.$correo.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $emailError = 'El correo ya esta registrado';
        cargarPaginaEdicion();
    }

    return $valido;
}

function validarContrasena($link) {
    global $contasenaError;
    $valido =  true;
    $usuario = limpiarDatos($_POST['nick2']);
    $contrasena = limpiarDatos($_POST['contrasena']);

    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE nickname="'.$usuario.'" ');
    $results = mysqli_fetch_array($query);
    if ($results['contrasenya'] !== $contrasena) {
        mysqli_close($link);
        $valido = false;
        $contasenaError = 'La contraseña no es correcta';
        cargarPaginaEdicion();
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
    if (validarContrasena($link) && ($_POST['nombre'] === $_POST['nombre2'] || validarNombre($link)) && 
    ($_POST['nick'] === $_POST['nick2'] || validarNick($link)) && ($_POST['correo'] === $_POST['correo2'] || validarCorreo($link))) {
        mysqli_close($link);
        editarUsuario();
    }
}

function comprobarDatos2() {
    $link = Conectar::conexion();
    if (validarContrasena($link) && ($_POST['nombre'] === $_POST['nombre2'] || validarNombre($link)) && 
    ($_POST['nick'] === $_POST['nick2'] || validarNick($link)) && validarNContrasena($link) && ($_POST['correo'] === $_POST['correo2'] || validarCorreo($link))) {
        mysqli_close($link);
        editarUsuario();
    }
}

function editarUsuario() {
    $link =Conectar::conexion();
    if (!empty($_POST['Ncontrasena']) && !empty($_POST['Ncontrasena2'])) {
        $query = mysqli_query($link, 'UPDATE USUARIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", nickname="'.limpiarDatos($_POST["nick"]).'", contrasenya="'.limpiarDatos($_POST["Ncontrasena"]).'",
        correo="'.limpiarDatos($_POST["correo"]).'", telefono="'.limpiarDatos($_POST["telefono"]).'", plan='.limpiarDatos($_POST['plan']).' WHERE cod='.limpiarDatos($_POST['id']));
        mysqli_close($link);
    } else {
        $query = mysqli_query($link, 'UPDATE USUARIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", nickname="'.limpiarDatos($_POST["nick"]).'", 
        correo="'.limpiarDatos($_POST["correo"]).'", telefono="'.limpiarDatos($_POST["telefono"]).'", plan='.limpiarDatos($_POST['plan']).' WHERE cod='.limpiarDatos($_POST['id']));
        mysqli_close($link);
    }

    if ($query) {
        session_destroy();
        header("Location: /controllers/areaUsuarioController.php");
    } else {
        header("Location: /paginas/fail.php");
    }
}

function cargarPaginaEdicion() {
    global $nombreError;
    global $nickError;
    global $contasenaError;
    global $emailError;
    global $NcontasenaError;
    
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE cod='.$_SESSION['id']);
    $usuario = mysqli_fetch_array($query);
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM PLANES');
    $options = array();
    while ($results = mysqli_fetch_array($query)) {
        if ($results['cod'] === $usuario['plan']) {
            array_push($options,'<option value="'.$results["cod"].'" selected>'.$results["nombre"].'</option>');
        } else {
            array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        }
    }
    mysqli_close($link);

    include "../paginas/editarUsuario.php";
}

if (!empty($_POST['editar']) && !empty($_POST['Ncontrasena']) && !empty($_POST['Ncontrasena2'])) {
    comprobarDatos2();
} else if (!empty($_POST['editar'])) {
    comprobarDatos();
} else {
    cargarPaginaEdicion();
}