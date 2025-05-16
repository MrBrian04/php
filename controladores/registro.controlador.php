<?php

include "modelos/registro.modelo.php";

class ControladorRegistro{

   /*=============================================
    Agregar Registros
    =============================================*/  
    
static public function ctrRegistro(){

    if (isset($_POST["registroNombre"])) {

        $tabla = "personas";

        // 1. Sanitizar y recortar espacios sobrantes
        $nombre   = trim($_POST['registroNombre']);
        $telefono = trim($_POST['registroTelefono']);
        $correo   = trim($_POST['registroEmail']);
        $rolId    = trim($_POST['registroRolId']);
        $clave    = $_POST['registroClave'];

        // 2. Definir la expresión regular: solo letras (incluye tildes y ñ) y espacios entre palabras
        $patternNombre   = '/^[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?: [A-Za-zÁÉÍÓÚáéíóúÑñ]+)*$/';
        $patternTelefono = '/^[0-9]{7,15}$/';                         // sólo dígitos, longitud entre 7 y 15
        $patternEmail    = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
        $patternRolId    = '/^[1-9][0-9]*$/';
       
        // 3. Validar con preg_match
        if (!preg_match($patternNombre, $nombre)) {
            // Nombre inválido: detener el flujo y notificar error
            return "errorNombre";
        }

        if (!preg_match($patternTelefono, $telefono)) {
            // Telefono inválido: detener el flujo y notificar error
            return "errorTelefono";
        }

        if (!preg_match($patternEmail, $correo)) {
            // Telefono inválido: detener el flujo y notificar error
            return "errorCorreo";
        }
        if (!preg_match($patternRolId, $rolId)) {
            // Telefono inválido: detener el flujo y notificar error
            return "errorRol";
        }

        // 4. Si pasa la validación, armar datos con el nombre ya sanitizado
        $datos = array(
            "nombre"      => $nombre,
            "telefono"    => $telefono,
            "correo"      => $correo,
            "fk_id_rol"   => $rolId,
            "clave"       => password_hash($clave, PASSWORD_DEFAULT)
        );

        $respuesta = ModeloRegistro::mdlRegistro($tabla, $datos);
        return $respuesta;
    }

}


   /*=============================================
    Seleccionar Registros
    =============================================*/

    static public function ctrSeleccionarRegistro($item = null, $valor = null){
        $tabla = "personas";
        // Le pasamos el $item y $valor al modelo para que haga el WHERE cuando venga
        $respuesta = ModeloRegistro::mdlSeleccionarRegistro($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    Ingresar Usuario
    =============================================*/

    public function ctrIngreso() {
        if (isset($_POST["ingresoCorreo"], $_POST["ingresoClave"])) {

            $tabla  = "personas";
            $item   = "pers_correo";
            $valor  = trim($_POST["ingresoCorreo"]);

            $respuesta = ModeloRegistro::mdlSeleccionarRegistro($tabla, $item, $valor);

            if (!$respuesta) {
                echo '<div class="alert alert-danger">Correo o contraseña incorrectos</div>';
                return;
            }

            if (password_verify(trim($_POST["ingresoClave"]), $respuesta["pers_clave"])) {
                // ¡Asegúrate de tener session_start() antes de esto!
                $_SESSION["validarIngreso"] = "ok";
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location = "contenido";
                </script>';
            } else {
                echo '<div class="alert alert-danger">Correo o contraseña incorrectos</div>';
            }
        }
    }


    /*=============================================
    Actualizar Usuario
    =============================================*/

    public static function ctrActualizar() {
        if (isset($_POST['actualizarNombre'], $_POST['actualizarTelefono'], $_POST['actualizarCorreo'])) {
            
            // Primero obtenemos el registro actual para saber el hash viejo
            $tabla = "personas";
            $item  = "pk_id_persona";
            $valor = $_GET["id"];
            $actual = ModeloRegistro::mdlSeleccionarRegistro($tabla, $item, $valor);
            
            // Si el campo clave viene vacío, mantenemos el hash existente
            if (!empty(trim($_POST['actualizarClave']))) {
                $nuevoHash = password_hash($_POST['actualizarClave'], PASSWORD_DEFAULT);
            } else {
                $nuevoHash = $actual["pers_clave"];
            }

            // Preparamos datos
            $datos = [
                "id"     => $valor,
                "nombre" => $_POST["actualizarNombre"],
                "telefono" => $_POST["actualizarTelefono"],
                "correo" => $_POST["actualizarCorreo"],
                "clave"  => $nuevoHash
            ];

            return ModeloRegistro::mdlActualizarRegistro($tabla, $datos);
        }

        return null;
    }


    /*=============================================
    Eliminar Usuario
    =============================================*/
    public static function ctrEliminarRegistro($id) {
        $tabla = "personas";
        $respuesta = ModeloRegistro::mdlEliminarRegistro($tabla, $id);
        return $respuesta;
    }


}