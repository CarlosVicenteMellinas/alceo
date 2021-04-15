<?php

require_once "../model/db.php";

function cargarPaginaEdicion() {
    $link =Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM PLANES');
    $options = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
    }
    mysqli_close($link);

    include "../paginas/editarUsuario.php";
}

if (!empty($_POST['editar'])) {
    header("Location: /controller/areaUsuarioController.php");
} else {
    cargarPaginaEdicion();
}