<?php
require_once "../../model/db.php";

function cargarIndex($mensaje = '') {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM OBJETIVO');
    $objetivos = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($objetivos,'<tr><td>'.$results["cod"].'</td><td>'.$results["nombre"].'</td></tr>');
    }
    include '../../admin/objetivo.php';
    mysqli_close($link);
}

if (!empty($mensaje)) {
    cargarIndex($mensaje);
} else {
    cargarIndex();
}

?>