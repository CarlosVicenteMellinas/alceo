<?php
require_once "../../model/db.php";

function cargarRutina() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM RUTINA WHERE cod='.$_POST['idRutina']);
    $rutina = mysqli_fetch_array($query);
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM OBJETIVO WHERE cod='.$rutina['objetivo']);
    $objetivo = mysqli_fetch_array($query)['nombre'];
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO_RUTINA WHERE rutina='.$_POST['idRutina']);
    $ejercicios = array();
    while ($results = mysqli_fetch_array($query)) {
        $query2 = mysqli_query($link, 'SELECT * FROM EJERCICIO WHERE cod='.$results['ejercicio']);
        $ejercicio = mysqli_fetch_array($query2);
        array_push($ejercicios, '<tr><td>'.$ejercicio['nombre'].'</td><td>'.$results['series'].'</td><td>'.$results['repeticiones'].'</td><td>'.$results['descanso'].'</td><td>'.$ejercicio['dificultad'].'</td></tr>');
    }
    mysqli_free_result($query);

    mysqli_close($link);
    include '../../paginas/rutinas/vistaRutinas.php';
}

function borrarRutina() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'DELETE FROM RUTINA WHERE cod='.$_POST['idBorrarRutina']);
    mysqli_free_result($query);
    mysqli_close($link);
    header("Location: /controllers/rutinas/rutinasController.php");
}

if (!empty($_POST['idRutina'])) {
    cargarRutina();
} else if (!empty($_POST['deleteForm'])) {
    borrarRutina();
} else {
    header("Location: /paginas/fail.php");
}

?>