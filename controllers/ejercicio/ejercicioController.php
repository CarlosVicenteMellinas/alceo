<?php
require_once "../../model/db.php";

function cargarIndex($mensaje = '') {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO');
    $ejercicios = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($ejercicios,'<tr><td>'.$results["cod"].'</td><td>'.$results["nombre"].'</td><td>'.$results["dificultad"].'</td><td>'.$results["foto"].'</td><td>'.$results["video"].'</td></tr>');
    }
    include '../../admin/ejercicios.php';
    mysqli_close($link);
}

if (!empty($mensaje)) {
    cargarIndex($mensaje);
} else {
   cargarIndex();
}
?>