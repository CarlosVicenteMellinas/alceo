<?php
require_once "../model/db.php";

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
        include '../admin/ejercicios.php';
    }
    return $valido;
}


function comprobarDatosInsert() {
    $link = Conectar::conexion();

    if (validarNombre($link)) {
        mysqli_close($link);
        insertar();
    } else {
        mysqli_close($link);
    }
}

function insertar() {
    $link = Conectar::conexion();
    if (!empty($_POST['foto']) && !empty($_POST['video'])) {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, foto, video) VALUES 
        ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["dificultad"]).', "'.limpiarDatos($_POST["foto"]).'", "'.limpiarDatos($_POST["video"]).'")');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else if (!empty($_POST['foto'])) {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, foto) VALUES 
        ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["dificultad"]).', "'.limpiarDatos($_POST["foto"]).'")');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else if (!empty($_POST['video'])) { 
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad, video) VALUES 
        ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["dificultad"]).', "'.limpiarDatos($_POST["video"]).'")');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO (nombre, dificultad) VALUES 
       ("'.limpiarDatos($_POST["nombre"]).'", '.limpiarDatos($_POST["dificultad"]).'")');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    }
}

function cargarEdicion() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'SELECT * FROM EJERCICIO');
    $options = array();
    $ejercicios = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($options,'<option value="'.$results["cod"].'">'.$results["nombre"].'</option>');
        array_push($ejercicios, array($results["cod"], $results["nombre"], $results["dificultad"]));
    }
    mysqli_free_result($query);
    mysqli_close($link);
    include '../admin/ejercicios/EditEjercicios.php';
}

function comprobarDatosEdit() {
    $link = Conectar::conexion();

    /*
    if (validarNombre($link)) {
        mysqli_close($link);
        editar();
    }*/
    mysqli_close($link);
    editar();
}

function editar() {
    $link = Conectar::conexion();
    if (!empty($_POST['foto']) && !empty($_POST['video'])) {
        $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", dificultad='.limpiarDatos($_POST["dificultad"]).', 
        foto="'.limpiarDatos($_POST["foto"]).'", video="'.limpiarDatos($_POST["video"]).'" WHERE cod='.limpiarDatos($_POST["id"]).';');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else if (!empty($_POST['foto'])) {
        $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", dificultad='.limpiarDatos($_POST["dificultad"]).', 
        foto="'.limpiarDatos($_POST["foto"]).'" WHERE cod='.limpiarDatos($_POST["id"]).';');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else if (!empty($_POST['video'])) { 
        $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", dificultad='.limpiarDatos($_POST["dificultad"]).', 
        video="'.limpiarDatos($_POST["video"]).'" WHERE cod='.limpiarDatos($_POST["id"]).';');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    } else {
        $query = mysqli_query($link, 'UPDATE EJERCICIO SET nombre="'.limpiarDatos($_POST["nombre"]).'", dificultad='.limpiarDatos($_POST["dificultad"]).' WHERE cod='.limpiarDatos($_POST["id"]).';');
        mysqli_close($link);
        header("Location: ../admin/ejercicios.php");
    }
} 

if (!empty($_POST['addForm'])) {
    include '../admin/ejercicios/AddEjercicios.php';
} else if (!empty($_POST['crearEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad'])) {
    comprobarDatosInsert();
} else if (!empty($_POST['editForm'])) {
    cargarEdicion();
} else if (!empty($_POST['editarEjercicio']) && !empty($_POST['nombre']) && !empty($_POST['dificultad'])) {
    comprobarDatosEdit();
} else {
    echo 'Pagina de error';
}
?>