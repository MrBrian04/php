<?php
include "modelos/producto.modelo.php";
class ControladorProducto{
    static public function ctrProducto(){
        if(isset($_POST["nombreProducto"])){

            $tabla = "productos";

            $datos = array(
                "nombre" => $_POST["nombreProducto"],
                "cantidad" => $_POST["cantidadProducto"],
                "precio" => $_POST["precioProducto"]           
            );

            $respuesta = ModeloProducto::mdlProducto($tabla, $datos);

            return $respuesta;

        }
    }
}