<?php
require_once "../../model/db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function cargarPagina() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM RUTINA_USUARIO WHERE usuario='.$_SESSION['id']);
    $rutinasCod = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($rutinasCod, $results[1]);
    }
    mysqli_free_result($query);

    $rutinas = array();
    foreach ($rutinasCod as $cod) {
        $query = mysqli_query($link, 'SELECT * FROM RUTINA WHERE cod='.$cod);
        $results = mysqli_fetch_array($query, MYSQLI_NUM);
        mysqli_free_result($query);

        array_push($rutinas, $results);
    }
    
    include '../../paginas/rutinas.php';
}

function cargarGenerador($mensaje = '') {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM OBJETIVO');
    $options = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
    }
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO');
    $EjOptions = array();
    $ejercicios = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($EjOptions,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($ejercicios, array($results["cod"], $results["nombre"], $results["dificultad"], $results["foto"], $results["video"]));
    }
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM GRUPO_MUSCULAR');
    $gruposM = array();
    $gruposM2 = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($gruposM,'<div class="gruposM" data-value="'.$results["cod"].'">'.$results["nombre"].'</div>');
        array_push($gruposM2, array($results["cod"], $results["nombre"]));
    }
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM GRUPOM_EJERCICIO');
    $gruposMEjercicios = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($gruposMEjercicios, array($results["ejercicio"], $results["grupo_m"]));
    }
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM MATERIAL');
    $materiales = array();
    $materiales2 = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($materiales,'<div class="materiales" data-value="'.$results["cod"].'">'.$results["nombre"].'</div>');
        array_push($materiales2, array($results["cod"], $results["nombre"]));

    }
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM MATERIAL_EJERCICIO');
    $materialEjercicio = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($materialEjercicio, array($results["ejercicio"], $results["material"]));
    }
    mysqli_free_result($query);

    mysqli_close($link);

    include "../../paginas/rutinas/generadorRutinas.php";
}

if (!empty($mensaje)) {
    cargarGenerador($mensaje);
} else if (!empty($_POST['generarRutina'])){
    cargarGenerador();
} else if (!empty($_SESSION['usuario'])) {
    cargarPagina();
} else {
    header("Location: /paginas/fail.php");
}