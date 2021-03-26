<?php



if (!empty($_POST['nombre']) && !empty($_POST['nick']) && 
!empty($_POST['contrasena']) && !empty($_POST['correo']) && 
!empty($_POST['telefono']) && !empty($_POST['plan'])) {
    echo 'Funciona';
} else {
    echo 'Pagina de error';
}

?>