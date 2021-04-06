<?php
require_once "../../model/db.php";

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function cargarEdicion($nombreError = '') {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM OBJETIVO');
    $options = array();
    $objetivo = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($objetivo, array($results["cod"], $results["nombre"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../../admin/objetivos/Editobjetivo.php';
}

function validarNombre($link) {
    $nombre = limpiarDatos($_POST['nombre']);
    $valido = true;

    $query = mysqli_query($link, 'SELECT * FROM OBJETIVO WHERE nombre="'.$nombre.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nombreError = 'El nombre no esta disponible';
        cargarEdicion($nombreError);
    }
    return $valido;
}

function comprobarDatosEdit() {
    $link = Conectar::conexion();

    if (validarNombre($link)) {
        mysqli_close($link);
        editar();
    }
}

function editar() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'UPDATE OBJETIVO SET nombre="'.limpiarDatos($_POST["nombre"]).'" WHERE cod='.limpiarDatos($_POST["id"]).';');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido editado correctamente</p>";
        include "objetivoController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha editado</p>";
        include "objetivoController.php";
    }
}
if (!empty($_POST['editForm'])) {
    cargarEdicion();
} else if (!empty($_POST['editarObjetivo']) && !empty($_POST['nombre'])) {
    comprobarDatosEdit();
} 