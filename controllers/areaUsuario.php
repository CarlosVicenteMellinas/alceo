<?php
require_once "../model/db.php";

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function comprobarCredenciales() {
    $link = Conectar::conexion();
    $usuario = limpiarDatos($_POST['loginNombre']);
    $contrasena = limpiarDatos($_POST['loginContrasena']);
    $valido = true;

    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE nickname="'.$usuario.'" ');
    $results = mysqli_num_rows($query);
    if ($results === 0) {
        mysqli_close($link);
        $valido = false;
        $usuarioError = 'El usuario no existe';
        include '../paginas/area-usuario.php';
    }
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE nickname="'.$usuario.'" ');
    $results = mysqli_fetch_array($query);
    if ($results['contrasenya'] !== $contrasena) {
        mysqli_close($link);
        $valido = false;
        $contrasenaError = 'La contraseña no es correcta';
        include '../paginas/area-usuario.php';
    }

    mysqli_close($link);
    if ($valido) {
        iniciarSesion($usuario);
    }
}

function iniciarSesion($usuario) {
    session_start();
    session_regenerate_id();
    $_SESSION['usuario'] = $usuario;
    $_SESSION["timeout"] = time();
    header("Location: /paginas/area-usuario.php");
}

function cerrarSesion() {
    session_start();
    session_destroy();
    header("Location: /paginas/area-usuario.php");

}

if(!empty($_SESSION['usuario'])) {
    comprobarCredenciales();
} else {
    echo 'Pagina de error';
}

?>