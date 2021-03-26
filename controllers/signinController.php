<?php



if (!empty($_POST['nombre']) && !empty($_POST['nick']) && 
!empty($_POST['contrasena']) && !empty($_POST['correo']) && 
!empty($_POST['telefono'])) {
    echo 'Funciona';
} else {
    echo 'Pagina de error';
}

?>