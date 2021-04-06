<?php
require_once "../../model/db.php";

function cargarIndex($mensaje = '') {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM PLANES');
    $planes = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($planes,'<tr><td>'.$results["cod"].'</td><td>'.$results["nombre"].'</td><td>'.$results["precio"].' €</td></tr>');
    }
    include '../../admin/planes.php';
    mysqli_close($link);
}

if (!empty($mensaje)) {
    cargarIndex($mensaje);
} else {
    cargarIndex();
}

?>