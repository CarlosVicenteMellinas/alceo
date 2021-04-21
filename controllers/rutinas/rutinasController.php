<?php

session_start();

function cargarPagina() {
    
    include '../../paginas/rutinas.php';
}

if (!empty($_SESSION['usuario'])) {
    cargarPagina();
} else {
    header("Location: /paginas/fail.php");
}