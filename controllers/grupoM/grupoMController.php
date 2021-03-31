<?php
require_once "../../model/db.php";

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function cargarIndex() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM GRUPO_MUSCULAR');
    $gruposM = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($gruposM,'<tr><td>'.$results["cod"].'</td><td>'.$results["nombre"].'</td></tr>');
    }
    include '../../admin/grupoM.php';
    mysqli_close($link);
}

if (false) {
   
} else {
    cargarIndex();
}

?>