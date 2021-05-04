<?php 
require_once "../../model/db.php";

function limpiarDatos($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function guardarRutina() {
    $link = Conectar::conexion();
    $query = mysqli_query($link, 'INSERT INTO RUTINA (nombre, dificultad, duracion, fecha, objetivo) VALUES ("'.limpiarDatos($_POST['nombre']).'", '.limpiarDatos($_POST['dificultad']).',
    '.limpiarDatos($_POST['duracion']).', "'.limpiarDatos($_POST['fecha']).'", '.limpiarDatos($_POST['objetivo']).')');
    mysqli_close($link);
    if ($query) {
        header("Location: /paginas/rutinas.php");
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha insertado (Rutina)</p>";
        include "../../paginas/rutinas/generadorRutinas.php";
    }
}

if (!empty($_POST['enviar'])) {
    guardarRutina();
} else {
    header("Location: /paginas/rutinas/generadorRutinas.php");
}
