<?php
require_once "../model/db.php";

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
        cargarIndex();
    }
    return $valido;
}

function comprobarDatosInsert() {
    $link = Conectar::conexion();

    if (validarNombre($link)) {
        mysqli_close($link);
        insertar();
    } else {
        mysqli_close($link);
    }
}

function insertar() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'INSERT INTO GRUPO_MUSCULAR (nombre) VALUES ("'.limpiarDatos($_POST["nombre"]).'")');
    mysqli_close($link);
    cargarIndex();
}

function cargarEdicion() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM GRUPO_MUSCULAR');
    $options = array();
    $grupoM = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($grupoM, array($results["cod"], $results["nombre"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../admin/grupoM/EditgrupoM.php';
}

function comprobarDatosEdit() {
    $link = Conectar::conexion();
    if (validarNombre($link)) {
        mysqli_close($link);
        editar();
    }
    mysqli_close($link);
    editar();
}

function editar() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'" WHERE cod='.limpiarDatos($_POST["id"]).';');
    mysqli_close($link);
    cargarIndex();
} 

function cargarIndex() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM GRUPO_MUSCULAR');
    $gruposM = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($gruposM,'<tr><td>'.$results["cod"].'</td><td>'.$results["nombre"].'</td></tr>');
    }
    include '../admin/grupoM.php';
    mysqli_close($link);
}

if (!empty($_POST['addForm'])) {
    include '../admin/grupoM/AddgrupoM.php';
} else if (!empty($_POST['crearGrupoM']) && !empty($_POST['nombre'])) {
    comprobarDatosInsert();
} else if (!empty($_POST['editForm'])) {
    cargarEdicion();
} else if (!empty($_POST['editarGrupoM']) && !empty($_POST['nombre'])) {
    comprobarDatosEdit();
} else {
    cargarIndex();
}

?>