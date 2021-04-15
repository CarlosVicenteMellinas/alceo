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
    $query = mysqli_query($link, 'SELECT * FROM PLANES');
    $options = array();
    $planes = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($planes, array($results["cod"], $results["nombre"], $results["precio"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../../admin/planes/Deleteplan.php';
}

function eliminar($cod) {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'DELETE FROM PLANES WHERE cod='.$cod.';');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido eliminado correctamente</p>";
        include "planController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha eliminado</p>";
        include "planController.php";
    }
}

if (!empty($_POST["deleteForm"])) {
    cargarEliminacion();
} else if (!empty($_POST["eliminarPlan"]) && !empty($_POST['id'])) {
    eliminar(limpiarDatos($_POST['id']));
} else {
    header("Location: /paginas/fail.php");
}