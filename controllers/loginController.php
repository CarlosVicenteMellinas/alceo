<?php

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function comprobarCredenciales() {
    $link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
    $usuario = limpiarDatos($_POST['loginNombre']);
    $contrasena = limpiarDatos($_POST['loginContrasena']);
    $valido = true;

    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE nickname="'.$usuario.'" ');
    $results = mysqli_fetch_array($query);
    if ($results === 0) {
        mysqli_close($link);
        $valido = false;
        $usuarioError = 'El usuario no existe';
        include '../paginas/area-usuario.php';
    }
    mysqli_free_result($query);

    if ($valido) {
        echo $results;
        //iniciarSesion();
    }
}

function iniciarSesion() {
    echo 'Funciona';
}

if (!empty($_POST['loginNombre']) && !empty($_POST['loginContrasena'])) {
    comprobarCredenciales();
} else {
    echo 'Pagina de error';
}

?>