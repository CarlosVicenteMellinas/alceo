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

    $query = mysqli_query($link, 'SELECT * FROM OBJETIVO WHERE nombre="'.$nombre.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nombreError = 'El nombre no esta disponible';
        include '../../admin/objetivos/Addobjetivo.php';
    }
    return $valido;
}

function comprobarDatosInsert() {
    $link = Conectar::conexion();

    if (validarNombre($link)) {
        mysqli_close($link);
        insertar();
    } 
}

function insertar() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'INSERT INTO OBJETIVO (nombre) VALUES ("'.limpiarDatos($_POST["nombre"]).'")');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido creado correctamente</p>";
        include "objetivoController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha insertado</p>";
        include "objetivoController.php";
    }
}

if (!empty($_POST['addForm'])) {
    header("Location: /admin/objetivos/Addobjetivo.php");
} else if (!empty($_POST['crearObjetivo']) && !empty($_POST['nombre'])) {
    comprobarDatosInsert();
}