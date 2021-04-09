<?php
require_once "../../model/db.php";

$foto = '';
$video = '';
$nombreError = '';
$fotoError = '';
$videoError = '';
$grupoMError = '';
$materialError = '';

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
        cargarEdicion();
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
            cargarEdicion();
        }
        else {
            if (move_uploaded_file($temp, '../../images/'.$foto)) {
                chmod('../../images/'.$foto, 0777);
            }
            else {
                mysqli_close($link);
                $valido = false;
                $fotoError = 'Ocurrió algún error al subir el fichero. No pudo guardarse';
                cargarEdicion();
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
            cargarEdicion();
        }
        else {
            if (move_uploaded_file($temp, '../../video/'.$video)) {
                chmod('../../video/'.$video, 0777);
            }
            else {
                mysqli_close($link);
                $valido = false;
                $videoError = 'Ocurrió algún error al subir el fichero. No pudo guardarse';
                cargarEdicion();
            }
        }
    }

    return $valido;
}

function comprobarGrupoM($link) {
    global $grupoMError;
    $valido = false;

    foreach (array_keys($_POST) as $var) {
        if (substr($var, 0, 6) == "grupoM") {
            $valido = true;
        }
    }

    if(!$valido) {
        mysqli_close($link);
        $grupoMError = "Debes introducir un grupo muscular como mínimo";
        cargarEdicion();
    }

    return $valido;
}

function comprobarMaterial($link) {
    global $materialError;
    $valido = false;

    foreach (array_keys($_POST) as $var) {
        if (substr($var, 0, 8) == "material") {
            $valido = true;
        }
    }

    if(!$valido) {
        mysqli_close($link);
        $materialError = "Debes introducir un material como mínimo";
        cargarInserccion();
    }

    return $valido;
}

function comprobarDatosEdit1() {
    $link = Conectar::conexion();

    if (($_POST['nombre'] === $_POST['nombre2'] || validarNombre($link)) && comprobarGrupoM($link) && comprobarMaterial($link)) {
        mysqli_close($link);
        editar();
    }
}

function comprobarDatosEdit2() {
    $link = Conectar::conexion();

    if (($_POST['nombre'] === $_POST['nombre2'] || validarNombre($link)) && validarFoto($link) && comprobarGrupoM($link) && comprobarMaterial($link)) {
        mysqli_close($link);
        editar();
    }
}

function comprobarDatosEdit3() {
    $link = Conectar::conexion();

    if (($_POST['nombre'] === $_POST['nombre2'] || validarNombre($link)) && validarVideo($link) && comprobarGrupoM($link) && comprobarMaterial($link)) {
        mysqli_close($link);
        editar();
    }
}

function comprobarDatosEdit4() {
    $link = Conectar::conexion();

    if (($_POST['nombre'] === $_POST['nombre2'] || validarNombre($link)) && validarFoto($link) && validarVideo($link) && comprobarGrupoM($link) && comprobarMaterial($link)) {
        mysqli_close($link);
        editar();
    }
}

function editar() {
    global $foto;
    global $video;
    $link = Conectar::conexion();

    if (!empty($_POST['foto']) && !empty($_POST['video'])) {
        $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", dificultad='.limpiarDatos($_POST["dificultad"]).', 
        foto="'.$foto.'", video="'.$video.'" WHERE cod='.limpiarDatos($_POST["id"]).';');
        mysqli_close($link);
    } else if (!empty($_POST['foto'])) {
        $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", dificultad='.limpiarDatos($_POST["dificultad"]).', 
        foto="'.$foto.'" WHERE cod='.limpiarDatos($_POST["id"]).';');
        mysqli_close($link);
    } else if (!empty($_POST['video'])) { 
        $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", dificultad='.limpiarDatos($_POST["dificultad"]).', 
        video="'.$video.'" WHERE cod='.limpiarDatos($_POST["id"]).';');
        mysqli_close($link);
    } else {
        $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", dificultad='.limpiarDatos($_POST["dificultad"]).' WHERE cod='.limpiarDatos($_POST["id"]).';');
        mysqli_close($link);
    }

    if ($query) {
        editarGrupoM();
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha editado (Ejercicio)</p>";
        include "ejercicioController.php";
    }
}

function editarGrupoM() {
    $link = Conectar::conexion();

    $gruposM = array();
    foreach (array_keys($_POST) as $var) {
        if (substr($var, 0, 6) == "grupoM") {
            array_push($gruposM, $_POST[$var]);
        }
    }

    $query = mysqli_query($link, 'DELETE FROM GRUPOM_EJERCICIO WHERE ejercicio='.$_POST["id"].';');

    foreach ($gruposM as $grupoM) {
        $cod2 = explode(":", $grupoM)[0];
        $query = mysqli_query($link, 'INSERT INTO GRUPOM_EJERCICIO (ejercicio, grupo_m) VALUES ('.$_POST["id"].', '.$cod2.')');
    }

    if ($query) {
        editarMaterial();
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha editado (GM)</p>";
        mysqli_close($link);
        include "ejercicioController.php";
    }
}

function editarMaterial() {
    $link = Conectar::conexion();

    $materiales = array();
    foreach (array_keys($_POST) as $var) {
        if (substr($var, 0, 8) == "material") {
            array_push($materiales, $_POST[$var]);
        }
    }

    $query = mysqli_query($link, 'DELETE FROM MATERIAL_EJERCICIO WHERE ejercicio='.$_POST["id"].';');

    foreach ($materiales as $material) {
        $cod2 = explode(":", $material)[0];
        $query = mysqli_query($link, 'INSERT INTO MATERIAL_EJERCICIO (ejercicio, material) VALUES ('.$_POST["id"].', '.$cod2.')');
    }

    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido editado correctamente</p>";
        mysqli_close($link);
        include "ejercicioController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha editado (Material)</p>";
        mysqli_close($link);
        include "ejercicioController.php";
    }
}

function cargarEdicion() {
    global $nombreError;
    global $fotoError;
    global $videoError;
    global $grupoMError;
    global $materialError;

    $link = Conectar::conexion();

    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO');
    $options = array();
    $ejercicios = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($ejercicios, array($results["cod"], $results["nombre"], $results["dificultad"]));
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

    include '../../admin/ejercicios/EditEjercicios.php';
}

if (!empty($_POST['editForm'])) {
    cargarEdicion();
}  else if (!empty($_POST['editarEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad']) && !empty($_FILES['foto']['name']) && !empty($_FILES['video']['name'])) {
    comprobarDatosInsert4();
} else if (!empty($_POST['editarEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad']) && !empty($_FILES['video']['name'])) {
    comprobarDatosInsert3();
} else if (!empty($_POST['editarEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad']) && !empty($_FILES['foto']['name'])) {
    comprobarDatosInsert2();
} else if (!empty($_POST['editarEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad'])) {
    comprobarDatosEdit1();
}