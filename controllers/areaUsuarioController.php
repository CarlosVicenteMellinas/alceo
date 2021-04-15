<?php
require_once "../model/db.php";
session_start();

function cargarArea() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM USUARIO WHERE cod='.$_SESSION['id']);
    $usuario = mysqli_fetch_array($query);
    mysqli_free_result($query);

    $query = mysqli_query($link, 'SELECT * FROM PLANES WHERE cod='.$usuario['plan']);
    $plan = mysqli_fetch_array($query);
    
    include '../paginas/area-usuario.php';
}

if(!empty($_SESSION['usuario'])) {
    cargarArea();
} else {
    header("Location: /paginas/area-usuario.php");
}

?>