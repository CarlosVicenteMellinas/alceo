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

    $query = mysqli_query($link, 'SELECT * FROM GRUPO_MUSCULAR WHERE nombre="'.$nombre.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nombreError = 'El nombre no esta disponible';
        include '../../admin/grupoM/AddgrupoM.php';
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
    $query = mysqli_query($link, 'INSERT INTO GRUPO_MUSCULAR (nombre) VALUES ("'.limpiarDatos($_POST["nombre"]).'")');
    mysqli_close($link);
    header("Location: /controllers/grupoM/grupoMController.php");
}

if (!empty($_POST['addForm'])) {
    header("Location: /admin/grupoM/AddgrupoM.php");
} else if (!empty($_POST['crearGrupoM']) && !empty($_POST['nombre'])) {
    comprobarDatosInsert();
}