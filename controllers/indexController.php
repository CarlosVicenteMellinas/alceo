<?php
$link = Conectar::conexion();
$query = mysqli_query($link, 'SELECT * FROM PLANES WHERE cod=4');
$plan1 = mysqli_fetch_array($query);
mysqli_free_result($query);

$query = mysqli_query($link, 'SELECT * FROM PLANES WHERE cod=1');
$plan2 = mysqli_fetch_array($query);
mysqli_free_result($query);

$query = mysqli_query($link, 'SELECT * FROM PLANES WHERE cod=2');
$plan3 = mysqli_fetch_array($query);
mysqli_free_result($query);

$query = mysqli_query($link, 'SELECT * FROM PLANES WHERE cod=3');
$plan4 = mysqli_fetch_array($query);
mysqli_free_result($query);

mysqli_close($link);
include 'paginas/indexView.php'
?>