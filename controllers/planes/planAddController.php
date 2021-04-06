<?php
require_once "../../model/db.php";

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
        include '../../admin/planes/Addplan.php';
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
        include '../../admin/planes/Addplan.php';
    }
    return $valido;
}

function comprobarDatosInsert() {
    $link = Conectar::conexion();

    if (validarNombre($link) && validarPrecio($link)) {
        mysqli_close($link);
        insertar();
    } 
}

function insertar() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'INSERT INTO PLANES (nombre, precio) VALUES ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["precio"]).')');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido creado correctamente</p>";
        include "planController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha insertado</p>";
        include "planController.php";
    }
}

if (!empty($_POST['addForm'])) {
    header("Location: /admin/planes/Addplan.php");
} else if (!empty($_POST['crearPlan']) && !empty($_POST['nombre']) && !empty($_POST['precio'])) {
    comprobarDatosInsert();
}