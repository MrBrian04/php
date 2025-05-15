<?php
    // Incluimos las clases necesarias del patrón MVC:
    // - Controlador para manejar la lógica de negocio
    require_once "controladores/registro.controlador.php";
    // - Modelo para interactuar con la base de datos
    require_once "modelos/registro.modelo.php";

    // 1) Procesar borrado si el formulario envió la petición
    //    Detectamos un POST con los campos 'delete' e 'idRegistro'
    if ($_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['delete'], $_POST['idRegistro'])
    ) {
        // Convertimos el ID a entero para mayor seguridad
        $id = intval($_POST['idRegistro']);

        // Llamamos al controlador para eliminar el registro
        $res = ControladorRegistro::ctrEliminarRegistro($id);

        // Mostramos un mensaje según el resultado de la operación
        if ($res === 'ok') {
            echo '<div class="alert alert-success">
                    Registro eliminado correctamente.
                  </div>';
        } else {
            echo '<div class="alert alert-danger">
                    Ocurrió un error al eliminar el registro.
                  </div>';
        }
    }

    // 2) Verificar que el usuario está autenticado
    //    Si no existe la sesión o no es válida, redirigimos al login
    if (!isset($_SESSION["validarIngreso"])
        || $_SESSION["validarIngreso"] !== "ok"
    ) {
        header("Location: index.php?modulo=ingreso");
        exit; // Detenemos la ejecución para evitar que se muestre contenido protegido
    }

    // 3) Obtener el listado actualizado de registros
    //    Después de procesar (o no) el borrado, pedimos al controlador
    //    que nos devuelva todos los registros de la tabla 'personas'
    $registros = ControladorRegistro::ctrSeleccionarRegistro();
?>


<section class="container-fluid">
    <div class="container py-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($registros)): ?>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?= htmlspecialchars($registro["pers_nombre"],   ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($registro["pers_telefono"], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($registro["pers_correo"],   ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($registro["pers_clave"],    ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <form method="post" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                                    <input type="hidden" name="idRegistro" value="<?= htmlspecialchars($registro['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" name="delete" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <a href="index.php?modulo=editar&id=<?= $registro['id'] ?>" class="btn btn-warning">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No hay registros de personas para mostrar.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
