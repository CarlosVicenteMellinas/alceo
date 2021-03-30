<?php
class Conectar{

    public static function conexion(){
        $direccion = "localhost";
        $usuario = "root";
        $contrasenya = "";
        $bd = "AlceoBD";

        $conexion=new mysqli($direccion, $usuario, $contrasenya, $bd);
        return $conexion;
    }
}
?>
