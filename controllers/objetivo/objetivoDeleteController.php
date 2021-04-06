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
    $query = mysqli_query($link, 'SELECT * FROM OBJETIVO');
    $options = array();
    $objetivo = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($objetivo, array($results["cod"], $results["nombre"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../../admin/objetivos/Deleteobjetivo.php';
}

function eliminar($cod) {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'DELETE FROM OBJETIVO WHERE cod='.$cod.';');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido eliminado correctamente</p>";
        include "objetivoController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha eliminado</p>";
        include "objetivoController.php";
    }
}

if (!empty($_POST["deleteForm"])) {
    cargarEliminacion();
} else if (!empty($_POST["eliminarObjetivo"]) && !empty($_POST['id'])) {
    eliminar(limpiarDatos($_POST['id']));
} else {
    echo 'Pagina de error';
}