<?php
require_once "../../model/db.php";

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function cargarEliminacion() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO');
    $options = array();
    $ejercicios = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($ejercicios, array($results["cod"], $results["nombre"], $results["dificultad"], $results["foto"], $results["video"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../../admin/ejercicios/DeleteEjercicios.php';
}

function borrarFoto() {
    if (!empty($_POST['foto'])) {
        $link = Conectar::conexion();
        $vacio = true;
        $query = mysqli_query($link, "SELECT * FROM EJERCICIO WHERE foto IS NOT NULL AND cod != ".$_POST["id"] );
        while ($results = mysqli_fetch_array($query))  {
            
            if ($results['foto'] === $_POST['foto']) {
                $vacio = false;
            }
        }

        if ($vacio) {
            unlink("../../images/ejercicio/".$_POST['foto']);
        }
    }
}

function borrarVideo() {
    if (!empty($_POST['video'])) {
        $link = Conectar::conexion();
        $vacio = true;

        $query = mysqli_query($link, "SELECT video FROM EJERCICIO WHERE video IS NOT NULL AND cod != ".$_POST["id"]);
        while ($results = mysqli_fetch_array($query))  {
            if ($results[0] === $_POST['video']) {
                $vacio = false;
            }
        }

        if ($vacio) {
            unlink("../../video/ejercicio/".$_POST['video']);
        }
    }
}

function eliminar($cod) {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'DELETE FROM EJERCICIO WHERE cod='.$cod.';');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido eliminado correctamente</p>";
        borrarFoto();
        borrarVideo();
        include "ejercicioController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha eliminado</p>";
        include "ejercicioController.php";
    }
}

if (!empty($_POST["deleteForm"])) {
    cargarEliminacion();
} else if (!empty($_POST["eliminarEjercicio"]) && !empty($_POST['id'])) {
    eliminar(limpiarDatos($_POST['id']));
} else {
    echo 'Pagina de error';
}