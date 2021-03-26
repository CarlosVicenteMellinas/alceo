<?php

function comprobarDatos() {
    echo 'Funciona1';
    crearUsuario();
}

function crearUsuario() {
    echo 'Funciona2';
}


if (!empty($_POST['nombre']) && !empty($_POST['nick']) && !empty($_POST['contrasena']) && !empty($_POST['correo']) && !empty($_POST['telefono'])) {
    if (!empty($_POST['plan'])) {
        comprobarDatos();
    } else {
        echo $_POST['plan'];
        echo 'Error';
    }
} else {
    echo 'Pagina de error';
}

?>