<?php

if (!empty($_POST['usuario']) && !empty($_POST['contasena'])) {
    comprobarDatos();
} else {
    echo 'Pagina de error';
}

?>