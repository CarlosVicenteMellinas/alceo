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
    $query = mysqli_query($link, 'INSERT INTO RUTINA (nombre, dificultad, duracion, fecha, objetivo) VALUES ("'.limpiarDatos($_POST['nombre']).'", '.limpiarDatos($_POST['dificultad']).',"'.limpiarDatos($_POST['duracion']).' minutos", "'.limpiarDatos($_POST['fecha']).'", '.limpiarDatos($_POST['objetivo']).')');
    $id = mysqli_insert_id($link);
    mysqli_close($link);

    
    if ($query) {
        enlazarRutinaEjercicio($id);
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha insertado (Rutina)</p>";
        include "rutinasController.php";
    }
    
}

function enlazarRutinaEjercicio($cod) {
    $link = Conectar::conexion();

    $ejercicios = array();
    $numEjer = 0;
    $ejercicio = array();
    foreach (array_keys($_POST) as $var) {
        $ejer = explode("-", $var);

        if (isset($ejer[1])) {
            if ($numEjer === $ejer[1]) {
                array_push($ejercicio, $_POST[$var]);
            } else {
                $numEjer = $ejer[1];

                if (!empty($ejercicio)) {
                    array_push($ejercicios, $ejercicio);
                    
                }

                $ejercicio = array();
                array_push($ejercicio, $_POST[$var]);
            }
        }
    }
    array_push($ejercicios, $ejercicio);

    foreach ($ejercicios as $ejercicio) {
        $query = mysqli_query($link, 'INSERT INTO EJERCICIO_RUTINA (rutina, ejercicio, repeticiones, series, descanso) VALUES ('.$cod.', '.$ejercicio[0].', '.$ejercicio[1].', '.$ejercicio[2].', "'.$ejercicio[3].' segundos")');
    }

    if ($query) {
        enlazarRutinaUsuario($cod);
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha insertado (Ejercicio)</p>";
        mysqli_query($link,'DELETE FROM RUTINA WHERE cod='.$cod.';');
        mysqli_close($link);
        include "rutinasController.php";
    }
}

function enlazarRutinaUsuario($cod) {
    $link = Conectar::conexion();
    session_start();

    $query = mysqli_query($link, 'INSERT INTO RUTINA_USUARIO (usuario, rutina) VALUES ('.$_SESSION['id'].', '.$cod.')');

    if ($query) {
        $mensaje = "<p class='correcto'>El dato ha sido creado correctamente</p>";
        mysqli_close($link);
        include "rutinasController.php";
    } else {
        $mensaje = "<p class='incorrecto'>¡Error! El dato no se ha insertado (Usuario)</p>";
        mysqli_query($link,'DELETE FROM RUTINA WHERE cod='.$cod.';');
        mysqli_close($link);
        include "rutinasController.php";
    }
}

if (!empty($_POST['enviar'])) {
    guardarRutina();
} else {
    header("Location: /paginas/rutinas/generadorRutinas.php");
}
