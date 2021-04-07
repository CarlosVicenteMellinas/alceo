<?php
require_once "../../model/db.php";

$foto = '';
$video = '';
$nombreError = '';
$fotoError = '';
$videoError = '';

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validarNombre($link) {
    global $nombreError;
    $nombre = limpiarDatos($_POST['nombre']);
    $valido = true;

    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO WHERE nombre="'.$nombre.'" ');
    $results = mysqli_fetch_array($query);
    if ($results > 0) {
        mysqli_close($link);
        $valido = false;
        $nombreError = 'El nombre no esta disponible';
        include '../../admin/ejercicios/AddEjercicios.php';
    }
    return $valido;
}

function validarFoto($link) {
    global $foto;
    global $fotoError;
    $foto = $_FILES['foto']['name'];
    $valido = true;
    if (isset($foto) && $foto != "") {

        $tipo = $_FILES['foto']['type'];
        $tamano = $_FILES['foto']['size'];
        $temp = $_FILES['foto']['tmp_name'];

        if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
            mysqli_close($link);
            $valido = false;
            $fotoError = 'La extensión o el tamaño de los archivos no es correcto';
            include '../../admin/ejercicios/AddEjercicios.php';
        }
        else {
            if (move_uploaded_file($temp, '../../images/'.$foto)) {
                chmod('../../images/'.$foto, 0777);
            }
            else {
                mysqli_close($link);
                $valido = false;
                $fotoError = 'Ocurrió algún error al subir el fichero. No pudo guardarse';
                include '../../admin/ejercicios/AddEjercicios.php';
            }
       }
    }

    return $valido;
}

function validarVideo($link) {
    global $video;
    global $videoError;
    $video = $_FILES['video']['name'];
    $valido = true;
    if (isset($video) && $video != "") {

        $tipo = $_FILES['video']['type'];
        $tamano = $_FILES['video']['size'];
        $temp = $_FILES['video']['tmp_name'];

        if (!((strpos($tipo, "mp4") || strpos($tipo, "avi") || strpos($tipo, "mkv")) && ($tamano < 5000000))) {
            mysqli_close($link);
            $valido = false;
            $videoError = 'La extensión o el tamaño de los archivos no es correcto';
            include '../../admin/ejercicios/AddEjercicios.php';
        }
        else {
            if (move_uploaded_file($temp, '../../video/'.$video)) {
                chmod('../../video/'.$video, 0777);
            }
            else {
                mysqli_close($link);
                $valido = false;
                $videoError = 'Ocurrió algún error al subir el fichero. No pudo guardarse';
                include '../../admin/ejercicios/AddEjercicios.php';
            }
       }
    }

    return $valido;
}

function comprobarDatosInsert1() {
    $link = Conectar::conexion();

    if (validarNombre($link)) {
        mysqli_close($link);
        insertar();
    } else {
        mysqli_close($link);
    }
}

function comprobarDatosInsert2() {
    $link = Conectar::conexion();
    if (validarNombre($link) && validarFoto($link)) {
        mysqli_close($link);
        insertar();
    } else {
        mysqli_close($link);
    }
}

function comprobarDatosInsert3() {
    $link = Conectar::conexion();
    if (validarNombre($link) && validarVideo($link)) {
        mysqli_close($link);
        insertar();
    } else {
        mysqli_close($link);
    }

}

function comprobarDatosInsert4() {
    $link = Conectar::conexion();
    if (validarNombre($link) && validarFoto($link) && validarVideo($link)) {
        mysqli_close($link);
        insertar();
    } else {
        mysqli_close($link);
    }

}

function insertar() {
    global $foto;
    global $video;
    $link = Conectar::conexion();

    if (!empty($foto) && !empty($video)) {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, foto, video) VALUES 
        ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["dificultad"]).', "'.$foto.'", "'.$video.'")');
        mysqli_close($link);
    } else if (!empty($foto)) {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, foto) VALUES 
        ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["dificultad"]).', "'.$foto.'")');
        mysqli_close($link);
    } else if (!empty($video)) { 
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, video) VALUES 
        ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["dificultad"]).', "'.$video.'")');
        mysqli_close($link);
    } else {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad) VALUES 
       ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["dificultad"]).')');
        mysqli_close($link);
    }

    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido creado correctamente</p>";
        include "ejercicioController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha insertado</p>";
        include "ejercicioController.php";
    }
}

function cargarInserccion() {
    global $nombreError;
    global $fotoError;
    global $videoError;

    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM GRUPO_MUSCULAR');
    $gruposM = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($gruposM,'<div class="gruposM" style="display:none" data-value="'.$results["cod"].'">'.$results["nombre"].'</div>');
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../../admin/ejercicios/AddEjercicios.php';
}

if (!empty($_POST['addForm'])) {
    cargarInserccion();
} else if (!empty($_POST['crearEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad']) && !empty($_FILES['foto']['name']) && !empty($_FILES['video']['name'])) {
    comprobarDatosInsert4();
} else if (!empty($_POST['crearEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad']) && !empty($_FILES['video']['name'])) {
    comprobarDatosInsert3();
} else if (!empty($_POST['crearEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad']) && !empty($_FILES['foto']['name'])) {
    comprobarDatosInsert2();
} else if (!empty($_POST['crearEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad'])) {
    comprobarDatosInsert1();
} 