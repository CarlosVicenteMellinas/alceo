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
    $query = mysqli_query($link, 'SELECT * FROM GRUPO_MUSCULAR');
    $options = array();
    $grupoM = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($grupoM, array($results["cod"], $results["nombre"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../../admin/grupoM/DeletegrupoM.php';
}

function eliminar($cod) {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'DELETE FROM GRUPO_MUSCULAR WHERE cod='.$cod.';');
    mysqli_close($link);
    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido eliminado correctamente</p>";
        include "grupoMController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha eliminado</p>";
        include "grupoMController.php";
    }
}

if (!empty($_POST["deleteForm"])) {
    cargarEliminacion();
} else if (!empty($_POST["eliminarGrupoM"]) && !empty($_POST['id'])) {
    eliminar(limpiarDatos($_POST['id']));
} else {
    header("Location: /paginas/fail.php");
}