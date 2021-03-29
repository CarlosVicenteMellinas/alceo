<?php

function comprobarDatos() {
    insertar();
}

function insertar() {
    echo 'Funciona';
}

if (!empty($_POST['nombre']) && !empty($_POST['dificultad'])) {
    comprobarDatos();
} else {
    echo 'Pagina de error';
}

?>