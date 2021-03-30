<?php
class Conectar{

    public static function conexion(){
        /*
        $direccion = "localhost";
        $usuario = "root";
        $contrasenya = "";
        $bd = "AlceoBD";
        */
        $direccion = "172.18.0.2";
        $usuario = "dbAdmin";
        $contrasenya = "C0nTr@s3ñ4";
        $bd = "AlceoBD";
        
        $conexion=new mysqli($direccion, $usuario, $contrasenya, $bd);
        return $conexion;
    }
}
?>
