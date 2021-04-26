<?php
require_once "../../model/db.php";

session_start();

function cargarPagina() {
    
    include '../../paginas/rutinas.php';
}

function cargarGenerador() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM OBJETIVO');
    $options = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
    }
    mysqli_close($link);

    include "../../paginas/rutinas/generadorRutinas.php";
}

if (!empty($_POST['generarRutina'])) {
    cargarGenerador();
} else if (!empty($_SESSION['usuario'])) {
    cargarPagina();
} else {
    header("Location: /paginas/fail.php");
}