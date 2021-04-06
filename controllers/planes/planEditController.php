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
    $query = mysqli_query($link, 'SELECT * FROM PLANES');
    $options = array();
    $planes = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($planes, array($results["cod"], $results["nombre"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../../admin/planes/Editplan.php';
}

function validarNombre($link) {
    $nombre = limpiarDatos($_POST['nombre']);
    $valido = true;

    $query = mysqli_query($link, 'SELECT * FROM PLANES WHERE nombre="'.$nombre.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nombreError = 'El nombre no esta disponible';
        cargarEdicion($nombreError);
    }
    return $valido;
}

function validarPrecio($link) {
    $precio = limpiarDatos($_POST['precio']);
    $valido = true;

    if (!is_numeric($precio) || $precio < 0) {
        mysqli_close($link);
        $valido = false;
        $precioError = 'El precio no es valido';
        cargarEdicion($precioError);
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
    $query = mysqli_query($link, 'UPDATE PLANES SET nombre="'.limpiarDatos($_POST["nombre"]).'", precio='.limpiarDatos($_POST['precio']).' WHERE cod='.limpiarDatos($_POST["id"]).';');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido editado correctamente</p>";
        include "planController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha editado</p>";
        include "planController.php";
    }
}
if (!empty($_POST['editForm'])) {
    cargarEdicion();
} else if (!empty($_POST['editarPlan']) && !empty($_POST['nombre']) && !empty($_POST['precio'])) {
    comprobarDatosEdit();
} 