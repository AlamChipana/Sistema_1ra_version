<link rel="stylesheet" href="css/rendimiento.css">

<?php
// Ya NO ponemos session_start() ni header() aquí, porque inicio.php ya lo hace.
// Solo obtenemos los datos que ya existen en la sesión activa.
$id_trabajador = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : '';
$nombre_trabajador = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario';
?>

<!-- Nota: La ruta del CSS y JS debe ser desde la raíz (inicio.php), por eso le ponemos la carpeta 'vistas/' -->
<link rel="stylesheet" href="css/rendimiento.css">

<div class="contenedor-principal">
    <div class="cabecera" style="margin-bottom: 20px;">
        <button type="button" id="btn-volver" class="btn-volver"style="background: none; border: none; color: #0077B6; font-weight: 600; font-size: 15px; cursor: pointer; display: flex; align-items: center; gap: 8px; padding: 0;">← Volver al Formulario</button>
    </div>
    <header class="encabezado">
        <h1>Módulo de Rendimiento</h1>
        <div class="info-usuario">
            <p>👤 Especialista: <span id="nombre-usuario-activo"><?php echo htmlspecialchars($nombre_trabajador); ?></span></p>
            <input type="hidden" id="id-trabajador-oculto" value="<?php echo htmlspecialchars($id_trabajador); ?>">
        </div>
    </header>

    <!-- ==========================================
         VISTA 1: CONFIGURACIÓN 
         ========================================== -->
    <section id="vista-configuracion" class="tarjeta">
        <h2>⚙️ Configuración de Procesos y Subprocesos</h2>
        <p>Define un proceso principal y agrega todos los pasos necesarios en orden.</p>

        <!-- Campo del Proceso Principal -->
        <div class="formulario-grid">
            <div class="grupo-input">
                <label for="proceso-principal">Nombre del Proceso Principal</label>
                <input type="text" id="proceso-principal" placeholder="Ej: Prótesis de Dedo Principal" required>
            </div>
        </div>

        <hr class="separador" style="margin: 15px 0;">
        <h3 style="color: var(--color-2); margin-bottom: 15px;">Subprocesos</h3>

        <!-- Contenedor dinámico de subprocesos -->
        <div id="contenedor-subprocesos">
            <!-- Fila Inicial (No se puede borrar) -->
            <div class="fila-subproceso formulario-grid" style="align-items: end;">
                <div class="grupo-input">
                    <label>1. Nombre del Subproceso</label>
                    <input type="text" class="input-subproceso-nombre" placeholder="Ej: Toma de medidas" required>
                </div>
                <div class="grupo-input">
                    <label>Tiempo Estándar (Minutos)</label>
                    <input type="number" class="input-subproceso-tiempo" placeholder="Ej: 45" required>
                </div>
                <div class="grupo-boton">
                    <!-- Espacio vacío en la primera fila para alinear -->
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div style="display: flex; gap: 15px; margin-top: 20px;">
            <button type="button" id="btn-agregar-fila" class="btn btn-primario" style="background-color: var(--color-3);">+ Añadir otro subproceso</button>
            <button type="button" id="btn-guardar-proceso-completo" class="btn btn-guardar" style="margin-top: 0; width: auto;">💾 Guardar Proceso Completo</button>
        </div>

        <hr class="separador">

        <div class="tabla-contenedor">
            <table id="tabla-procesos">
                <thead>
                    <tr>
                        <th>Proceso Principal</th>
                        <th>Subprocesos (Cantidad)</th>
                        <th>Tiempo Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="lista-procesos-catalogo">
                    <tr>
                        <td colspan="4" class="texto-centro">No hay procesos configurados aún.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <hr class="separador">

    <!-- ==========================================
         VISTA 2: PANEL DE TRABAJO DIARIO
         ========================================== -->
    <section id="vista-trabajo" class="tarjeta">
        <h2>⏱️ Panel de Trabajo Diario</h2>
        
        <div class="panel-seleccion">
            <h3>1. ¿En qué estás trabajando?</h3>
            <div class="formulario-grid">
                
                <div class="grupo-input">
                    <label for="nombre-paciente">Nombre del Paciente 🔍</label>
                    <!-- ==============================================================
                         NOTA FUTURA BASE DE DATOS PACIENTES: 
                         Cuando crees la BD de pacientes, cambiaremos este 'input' por 
                         un buscador con autocompletado (AJAX/Select2) que jalará el ID 
                         real del paciente en lugar de escribir su nombre a mano.
                         ============================================================== -->
                    <input type="text" id="nombre-paciente" placeholder="Ej: Juan Pérez" required>
                </div>

                <div class="grupo-input">
                    <label for="select-proceso">Proceso Principal</label>
                    <select id="select-proceso" required>
                        <option value="">-- Seleccionar Proceso --</option>
                        <!-- Se llenará automáticamente con JS -->
                    </select>
                </div>

                <div class="grupo-input">
                    <label for="select-subproceso">Subproceso a realizar</label>
                    <select id="select-subproceso" required>
                        <option value="">-- Seleccionar Subproceso --</option>
                        <!-- Se llenará al elegir el proceso anterior -->
                    </select>
                </div>
            </div>
        </div>

        <div class="panel-controles">
            <h3>2. Control de Tiempo</h3>
            <div class="estado-tarea">
                <p>Estado Actual: <span id="estado-etiqueta" class="badge-estado listo">🟡 Listo para iniciar</span></p>
                <h2 id="cronometro-display">00:00:00</h2>
            </div>
            <div class="botones-control">
                <button id="btn-iniciar" class="btn btn-iniciar">▶ INICIAR</button>
                <button id="btn-pausar" class="btn btn-pausar" disabled>⏸ PAUSAR</button>
                <button id="btn-finalizar" class="btn btn-finalizar" disabled>⏹ FINALIZAR</button>
            </div>
        </div>

        
        <div class="panel-observaciones">
            <h3>3. Detalles Finales</h3>
            <div class="grupo-input">
                <label for="observaciones-tarea">Observaciones / Inconvenientes (Opcional)</label>
                <textarea id="observaciones-tarea" rows="3" placeholder="Escribe aquí si hubo algún problema..."></textarea>
            </div>
        </div>


        <!-- Este input oculto nos dirá si estamos creando una tarea nueva o retomando una en pausa -->
        <input type="hidden" id="id-registro-activo" value="">

        <!-- ==========================================
             TABLA DE TRABAJOS EN PAUSA (WIP)
             ========================================== -->
        <h3>4. Trabajos en Curso</h3>
        <div class="tarjeta">
            <div class="tabla-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Proceso</th>
                            <th>Subproceso</th>
                            <th>Tiempo Acumulado</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista-tareas-pausadas">
                        <tr><td colspan="5" class="texto-centro">No hay trabajos en pausa.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <button id="btn-guardar-registro" class="b1tn btn-guardar">💾 Guardar Registro Diario</button>
    </section>

</div>


 <!-- Contenedor del Modal de Detalles (Inicia oculto) -->
    <div id="modal-detalles" class="modal-oculto">
        <div class="modal-contenido">
            <span class="cerrar-modal" id="btn-cerrar-modal">&times;</span>
            <h2 id="titulo-modal" style="color: var(--color-1); border-bottom: 2px solid var(--color-4); padding-bottom: 10px; margin-top:0;">Detalles del Proceso</h2>
            
            <div class="tabla-contenedor" style="margin-top: 15px;">
                <table>
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Subproceso</th>
                            <th>Tiempo Asignado</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo-tabla-modal">
                        <!-- Aquí se llenarán los pasos -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script src="js/rendimiento.js"></script>