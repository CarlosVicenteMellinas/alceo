<?php
require_once "../../model/db.php";

function cargarRutina() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM RUTINA WHERE cod='.$_POST['idRutina']);
    $rutina = mysqli_fetch_array($query);
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO_RUTINA WHERE rutina='.$_POST['idRutina']);

    mysqli_free_result($query);

    mysqli_close($link);
    include '../../paginas/rutinas/vistaRutinas.php';
}

if ($_POST['idRutina']) {
    cargarRutina();
} else {
    header("Location: /paginas/fail.php");
}

?>