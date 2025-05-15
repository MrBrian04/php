<?php

include "modelos/rol.modelo.php";

class ControladorRol {

    /**
     * Método para crear un nuevo rol.
     * Retorna "ok" si la inserción fue exitosa, "error" en caso contrario.
     */
    static public function ctrCrearRol() {

        // Verificamos que el formulario fue enviado
        if (isset($_POST["registroRolNombre"]) && isset($_POST["registroRolEstado"])) {

            // Sanitizamos/trim de los campos
            $nombre      = trim($_POST["registroRolNombre"]);
            $descripcion = trim($_POST["registroRolDescripcion"]);
            $estado      = intval($_POST["registroRolEstado"]);

            // Validación básica
            if ($nombre === "" || !in_array($estado, [0,1], true)) {
                return "error";
            }

            // Preparamos datos para el modelo
            $datos = [
                "rol_nombre"      => $nombre,
                "rol_descripcion" => $descripcion,
                "rol_estado"      => $estado
            ];
   
            // Llamada al modelo
            $respuesta = ModeloRol::mdlIngresarRol("roles", $datos);

            return ($respuesta === "ok") ? "ok" : "error";
        }
    }

    /**
     * Puedes agregar aquí otros métodos como:
     * - ctrListarRoles()
     * - ctrEditarRol()
     * - ctrEliminarRol()
     * según vayan surgiendo tus necesidades.
     */


    // … aquí ya tienes ctrCrearRol() …

    /**
     * Recupera todos los roles de la tabla.
     *
     * @return array|false  Array de roles (cada elemento es un array asociativo)
     *                      o false si falla la consulta.
     */
    static public function ctrListarRoles() {
        $tabla = "roles";
        $respuesta = ModeloRol::mdlListarRoles($tabla);
        return $respuesta;
    }

    // … otros métodos …

}
