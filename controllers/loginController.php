<?php

function comprobarCredenciales() {
    iniciarSesion();
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