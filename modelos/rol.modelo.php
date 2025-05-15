<?php
require_once "conexion.php";

class ModeloRol {

    /**
     * Inserta un nuevo rol en la tabla indicada.
     *
     * @param string $tabla Nombre de la tabla (p.ej. "roles").
     * @param array  $datos  Array asociativo con las claves:
     *                       - rol_nombre
     *                       - rol_descripcion
     *                       - rol_estado
     *
     * @return string "ok" si la inserción fue exitosa, "error" en caso contrario.
     */
    static public function mdlIngresarRol($tabla, $datos) {
        try {
            // 1) Preparamos la sentencia SQL con placeholders
            $sql = "INSERT INTO $tabla (rol_nombre, rol_descripcion, rol_estado)
                    VALUES (:rol_nombre, :rol_descripcion, :rol_estado)";

            // 2) Obtenemos la conexión PDO y preparamos la query
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare($sql);

            // 3) Bind de parámetros
            $stmt->bindParam(":rol_nombre",      $datos["rol_nombre"],      PDO::PARAM_STR);
            $stmt->bindParam(":rol_descripcion", $datos["rol_descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":rol_estado",      $datos["rol_estado"],      PDO::PARAM_INT);

            // 4) Ejecutamos y evaluamos resultado
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            // En caso de error de PDO, podrías registrar:
            // error_log($e->getMessage());
            return "error";
        } finally {
            // 5) Cerramos cursor y liberamos statement
            if (isset($stmt)) {
                $stmt->closeCursor();
            }
        }
    }

    // … aquí ya tienes mdlIngresarRol() …

    /**
     * Devuelve todos los registros de la tabla indicada.
     *
     * @param string $tabla Nombre de la tabla (p.ej. "roles").
     * @return array|false  Array de filas o false en caso de error.
     */
    static public function mdlListarRoles($tabla) {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $resultado;
        } catch (PDOException $e) {
            // En desarrollo puedes hacer:
            error_log("Error al listar roles: " . $e->getMessage());
            return false;
        }
    }

}
