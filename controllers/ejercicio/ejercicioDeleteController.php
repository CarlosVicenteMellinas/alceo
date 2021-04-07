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
        array_push($ejercicios, array($results["cod"], $results["nombre"], $results["dificultad"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../../admin/ejercicios/DeleteEjercicios.php';
}

function eliminar($cod) {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'DELETE FROM EJERCICIO WHERE cod='.$cod.';');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido eliminado correctamente</p>";
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