<link rel="stylesheet" href="css/usuarios.css">

<div class="contenedor-usuarios">
    
    <div class="cabecera-modulo">
        <h2>Gestión de Usuarios y Personal</h2>
    </div>

    <div class="grid-usuarios">
        
        <div class="panel-formulario">
            <form id="formRegistrarUsuario">
                
                <input type="hidden" name="id_editando" id="id_editando" value="">
                
                <div class="titulo-seccion">Datos Personales</div>
                <div class="grupo-input">
                    <label>Nombres</label>
                    <input type="text" name="nombres" id="inputNombres" class="input-moderno" required>
                    <small id="errorNombres" style="color: #dc3545; display: none; font-size: 11px; margin-top: 4px; font-weight: 600;"></small>
                </div>
                
                <div class="grupo-input">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" id="inputApellidos" class="input-moderno" required>
                    <small id="errorApellidos" style="color: #dc3545; display: none; font-size: 11px; margin-top: 4px; font-weight: 600;"></small>
                </div>
                
                <div class="grupo-input">
                    <label>Carnet de Identidad (CI)</label>
                    <input type="text" name="ci" id="inputCI" class="input-moderno" required>
                    <small id="errorCI" style="color: #dc3545; display: none; font-size: 11px; margin-top: 4px; font-weight: 600;"></small>
                </div>

                <div class="titulo-seccion" style="margin-top: 24px;">Asignación</div>
                <div class="grupo-input">
                    <label>Área de Trabajo</label>
                    <select name="id_area" class="input-moderno" required>
                        <option value="">Seleccione...</option>
                        <option value="1">Administración</option>
                        <option value="2">Anaplastología</option>
                        <option value="3">Comercial</option>
                        <option value="4">Manufactura</option>
                    </select>
                </div>
                <div class="grupo-input">
                    <label>Nivel / Tipo</label>
                    <select name="id_tipo" class="input-moderno" required>
                        <option value="">Seleccione...</option>
                        <option value="1">Administrador</option>
                        <option value="2">Trabajador</option>
                        <option value="3">Pasante</option>
                    </select>
                </div>

                <div class="titulo-seccion" style="margin-top: 24px;">Credenciales</div>
                <div class="grupo-input">
                    <label>Usuario (Login)</label>
                    <input type="text" name="usuario" id="inputUsuario" class="input-moderno" required>
                    <small id="errorUsuario" style="color: #dc3545; display: none; font-size: 11px; margin-top: 4px; font-weight: 600;"></small>
                </div>
                <div class="grupo-input">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="input-moderno" minlength="6" required>
                    <small id="notaPassword" style="display:none; color: var(--text-muted); font-size: 11px;">Déjalo en blanco si no quieres cambiarla.</small>
                </div>

                <div class="contenedor-acciones" style="flex-direction: column; gap: 10px;">
                    <button type="submit" id="btnGuardarForm" class="btn-accion-form btn-guardar">
                        Registrar Empleado
                    </button>
                    <button type="button" id="btnCancelarEdicion" class="btn-accion-form" style="display: none; background-color: #dc3545; color: white; width: 100%;">
                        Cancelar Edición
                    </button>
                </div>
            </form>
        </div>

        <div class="panel-tabla">
            <table class="tabla-moderna">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>CI</th>
                        <th>Área</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="listaUsuarios">
                    <tr>
                        <td colspan="7" style="text-align:center;">Cargando datos...</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="js/usuarios.js"></script>