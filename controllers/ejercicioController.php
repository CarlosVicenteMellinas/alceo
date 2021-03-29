<?php

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validarNombre($link) {
    $nombre = limpiarDatos($_POST['nombre']);
    $valido = true;

    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO WHERE nombre="'.$nombre.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nombreError = 'El nombre no esta disponible';
        include '../admin/ejercicio.php';
    }
    return $valido;
}


function comprobarDatos() {
    $link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');

    if (validarNombre($link)) {
        insertar();
    }
    mysqli_close($link);
}

function insertar() {
    $link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
    if (!empty($_POST['foto']) && !empty($_POST['video'])) {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, foto, video) VALUES 
        ("'.$_POST["nombre"].'", '.$_POST["dificultad"].', "'.$_POST["foto"].'", "'.$_POST["video"].'")');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else if (!empty($_POST['foto'])) {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, foto) VALUES 
        ("'.$_POST["nombre"].'", '.$_POST["dificultad"].', "'.$_POST["foto"].'")');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else if (!empty($_POST['video'])) { 
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, video) VALUES 
        ("'.$_POST["nombre"].'", '.$_POST["dificultad"].', "'.$_POST["video"].'")');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad) VALUES 
        ("'.$_POST["nombre"].'", '.$_POST["dificultad"].')');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    }
}

if (!empty($_POST['nombre']) && !empty($_POST['dificultad'])) {
    comprobarDatos();
} else {
    echo 'Pagina de error';
}

?>