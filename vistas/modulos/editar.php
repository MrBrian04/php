<?php
// editar.php

// 0) Iniciamos o reanudamos la sesión, si no está activa
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(); // Inicia la sesión para usar variables $_SESSION
}

// 1) Verificamos que el usuario ha iniciado sesión correctamente
if (!isset($_SESSION["validarIngreso"]) || $_SESSION["validarIngreso"] !== "ok") {
    header("Location: ingreso"); // Redirige al login si no está autenticado
    exit; // Detiene la ejecución para no mostrar contenido restringido
}

// 2) Importamos la lógica del controlador y el modelo
require_once "controladores/registro.controlador.php"; // Define ControladorRegistro
require_once "modelos/registro.modelo.php";          // Define ModeloRegistro

// 3) Validamos que recibimos un 'id' válido en la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<div class="alert alert-danger">ID inválido.</div>'; // Error si falta o es inválido
    exit; // Detiene la ejecución
}

// 4) Convertimos y saneamos el parámetro a entero
$id = intval($_GET['id']);

// 5) Solicitamos al controlador el registro para ese ID
//    Pasamos el nombre real de la PK en la BD: 'pk_id_persona'
$registro = ControladorRegistro::ctrSeleccionarRegistro("pk_id_persona", $id);

// 6) Si el registro no existe, mostramos un mensaje y detenemos
if (!$registro) {
    echo '<div class="alert alert-danger">Registro no encontrado.</div>';
    exit;
}

// 7) Procesamos el envío del formulario de actualización
//    El método ctrActualizar() internamente lee $_POST y actualiza si hay datos
$actualizar = ControladorRegistro::ctrActualizar();

// 8) Si la actualización fue exitosa, mostramos confirmación usando heredoc
if ($actualizar === 'ok') {
    echo <<<HTML
    <script>
        // Evita reenvío del formulario al recargar página
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <div class="alert alert-success">El usuario ha sido actualizado</div>
    HTML;
}
?>

<!-- 9) Comienzo del formulario en HTML -->
<div class="container-fluid">
    <div class="container py-5">
        <h1>Actualizar</h1>
        <div class="d-flex justify-content-center text-center py-3">
            <form class="p-5 bg-light" method="post">

                <!-- Campo Nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="actualizarNombre"
                            value="<?= htmlspecialchars($registro['pers_nombre'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                </div>

                <!-- Campo Teléfono -->
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input
                            type="text"
                            class="form-control"
                            id="telefono"
                            name="actualizarTelefono"
                            value="<?= htmlspecialchars($registro['pers_telefono'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                </div>

                <!-- Campo Correo Electrónico -->
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input
                            type="email"
                            class="form-control"
                            id="correo"
                            name="actualizarCorreo"
                            value="<?= htmlspecialchars($registro['pers_correo'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                </div>

                <!-- Campo Contraseña -->
                <div class="form-group">
                    <label for="clave">Contraseña:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input
                            type="password"
                            class="form-control"
                            id="clave"
                            name="actualizarClave"
                            placeholder="Deja en blanco para mantener la actual">
                    </div>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-primary">Actualizar</button>

            </form>
        </div>
    </div>
</div>