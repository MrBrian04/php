
<div class="container-fluid">
    <div class="container py-5">
        <div class="d-flex justify-content-center text-center py-3">
            <form class="p-5 bg-light" method="post">
                
                <!-- Nombre del Rol -->
                <div class="form-group mb-3">
                    <label for="rolNombre">Nombre del Rol:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user-tag"></i>
                            </span>
                        </div>
                        <input 
                          type="text" 
                          class="form-control" 
                          id="rolNombre" 
                          name="registroRolNombre" 
                          placeholder="Escribe el nombre del rol"
                          required
                        >
                    </div>
                </div>
                
                <!-- Descripción del Rol -->
                <div class="form-group mb-3">
                    <label for="rolDescripcion">Descripción:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-align-left"></i>
                            </span>
                        </div>
                        <textarea 
                          class="form-control" 
                          id="rolDescripcion" 
                          name="registroRolDescripcion" 
                          rows="3" 
                          placeholder="Descripción breve del rol"
                          required
                        ></textarea>
                    </div>
                </div>
                
                <!-- Estado del Rol -->
                <div class="form-group mb-4">
                    <label for="rolEstado">Estado:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-toggle-on"></i>
                            </span>
                        </div>
                        <select 
                          class="form-control" 
                          id="rolEstado" 
                          name="registroRolEstado"
                          required
                        >
                            <option value="" disabled selected>Selecciona un estado</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
                
                <?php
                    /*=============================================
                    INSTANCIAMOS EL MÉTODO DEL CONTROLADOR
                    =============================================*/
                    $crearRol = ControladorRol::ctrCrearRol();
                    if ($crearRol === 'ok') {
                        echo '<script>
                                if (window.history.replaceState) {
                                  window.history.replaceState(null, null, window.location.href);
                                }
                              </script>';
                        echo '<div class="alert alert-success">El rol ha sido registrado con éxito</div>';
                    } elseif ($crearRol === 'error') {
                        echo '<div class="alert alert-danger">Hubo un error al registrar el rol</div>';
                    }
                ?>
                
                <button type="submit" class="btn btn-primary">Guardar Rol</button>
            </form>
        </div>
    </div>
</div>
