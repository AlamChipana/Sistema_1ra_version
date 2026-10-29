// ==========================================
// 1. ELEMENTOS DEL DOM
// ==========================================

// Elementos - Configuración de Procesos
const contenedorSubprocesos = document.getElementById('contenedor-subprocesos');
const btnAgregarFila = document.getElementById('btn-agregar-fila');
const btnGuardarProcesoCompleto = document.getElementById('btn-guardar-proceso-completo');
let contadorSubprocesos = 1;

// Elementos - Cronómetro y Panel de Trabajo
let tiempoIntervalo;
let segundosTranscurridos = 0;
let estadoActual = 'listo'; // listo, activo, pausado, completado

const displayTiempo = document.getElementById('cronometro-display');
const estadoEtiqueta = document.getElementById('estado-etiqueta');
const btnIniciar = document.getElementById('btn-iniciar');
const btnPausar = document.getElementById('btn-pausar');
const btnFinalizar = document.getElementById('btn-finalizar');
const btnGuardarRegistro = document.getElementById('btn-guardar-registro');


// ==========================================
// REDIRECCIÓN: VOLVER AL FORMULARIO
// ==========================================
const btnVolver = document.getElementById('btn-volver');

if (btnVolver) {
    btnVolver.addEventListener('click', function(event) {
        event.preventDefault(); // Evitamos recargas accidentales
        
        // Simula presionar el botón "Atrás" del navegador
        window.history.back(); 
    });
}
// ==========================================
// 2. LÓGICA DE CONFIGURACIÓN (ADMINISTRADOR)
// ==========================================

// Añadir una nueva fila de subproceso
btnAgregarFila.addEventListener('click', () => {
    contadorSubprocesos++;
    
    const nuevaFila = document.createElement('div');
    nuevaFila.className = 'fila-subproceso formulario-grid';
    nuevaFila.style.alignItems = 'end';
    nuevaFila.style.marginTop = '15px';
    
    nuevaFila.innerHTML = `
        <div class="grupo-input">
            <label>${contadorSubprocesos}. Nombre del Subproceso</label>
            <input type="text" class="input-subproceso-nombre" placeholder="Ej: Siguiente paso..." required>
        </div>
        <div class="grupo-input">
            <label>Tiempo Estándar (Minutos)</label>
            <input type="number" class="input-subproceso-tiempo" placeholder="Ej: 30" required>
        </div>
        <div class="grupo-boton">
            <button type="button" class="btn btn-eliminar-fila" style="background-color: #e74c3c; color: white;">🗑️ Quitar</button>
        </div>
    `;
    
    contenedorSubprocesos.appendChild(nuevaFila);

    // Darle vida al botón de "Quitar" de esta fila
    nuevaFila.querySelector('.btn-eliminar-fila').addEventListener('click', function() {
        nuevaFila.remove();
    });
});

// Guardar el Catálogo Completo
btnGuardarProcesoCompleto.addEventListener('click', () => {
    const procesoPrincipal = document.getElementById('proceso-principal').value.trim();
    
    if (!procesoPrincipal) {
        Swal.fire({
        icon: 'warning',
        title: 'Faltan datos',
        text: 'Por favor, ingresa el nombre del Proceso Principal.',
        customClass: { confirmButton: 'btn btn-primario' },
        buttonsStyling: false
        });
        return;
    }

    const subprocesos = [];
    const filas = document.querySelectorAll('.fila-subproceso');
    let hayErrores = false;

    filas.forEach(fila => {
        const nombre = fila.querySelector('.input-subproceso-nombre').value.trim();
        const tiempo = fila.querySelector('.input-subproceso-tiempo').value.trim();
        
        if (!nombre || !tiempo) {
            hayErrores = true;
        } else {
            subprocesos.push({ nombre: nombre, tiempo_minutos: tiempo });
        }
    });

    if (hayErrores || subprocesos.length === 0) {
        Swal.fire({
        icon: 'warning',
        title: 'Campos incompletos',
        text: 'Por favor, completa todos los campos de los subprocesos antes de guardar.',
        customClass: { confirmButton: 'btn btn-primario' },
        buttonsStyling: false
        });
        return;
    }

    const paqueteDatos = {
        accion: 'guardar_proceso_catalogo',
        proceso_principal: procesoPrincipal,
        subprocesos: subprocesos
    };

    fetch('procesos/procesos-rendimiento.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(paqueteDatos)
    })
    .then(respuesta => respuesta.json())
    .then(data => {
        if(data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Guardado!',
                text: data.mensaje,
                customClass: { confirmButton: 'btn btn-primario' },
                buttonsStyling: false
            });
            // Limpiar formulario
            document.getElementById('proceso-principal').value = '';
            contenedorSubprocesos.innerHTML = `
                <div class="fila-subproceso formulario-grid" style="align-items: end;">
                    <div class="grupo-input">
                        <label>1. Nombre del Subproceso</label>
                        <input type="text" class="input-subproceso-nombre" placeholder="Ej: Toma de medidas" required>
                    </div>
                    <div class="grupo-input">
                        <label>Tiempo Estándar (Minutos)</label>
                        <input type="number" class="input-subproceso-tiempo" placeholder="Ej: 45" required>
                    </div>
                    <div class="grupo-boton"></div>
                </div>
            `;
            contadorSubprocesos = 1;
            cargarTablaProcesos(); // Actualiza la tabla del catálogo automáticamente
            cargarSelectProcesos(); // Actualiza el menú desplegable del trabajador automáticamente
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al guardar',
                text: data.mensaje,
                customClass: { confirmButton: 'btn btn-primario' },
                buttonsStyling: false
            });
        }
    })
    .catch(error => console.error('Error:', error));
});


// ==========================================
// 3. CARGAR TABLA DE PROCESOS 
// ==========================================
// IMPORTANTE: PON AQUÍ LA RUTA EXACTA QUE TE FUNCIONA PARA GUARDAR
const RUTA_PHP = 'procesos/procesos-rendimiento.php'; // o 'vistas/procesos-rendimiento.php'

function cargarTablaProcesos() {
    fetch(RUTA_PHP, { 
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ accion: 'cargar_procesos' })
    })
    .then(respuesta => respuesta.json())
    .then(data => {
        if(data.status === 'success') {
            const tbody = document.getElementById('lista-procesos-catalogo');
            tbody.innerHTML = ''; 
            
            if(data.data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="texto-centro">No hay procesos configurados aún.</td></tr>';
                return;
            }
            
            data.data.forEach(proceso => {
                // Aquí el botón YA NO tiene "disabled" y tiene la clase "btn-ver-detalle"
                tbody.innerHTML += `
                    <tr>
                        <td style="font-weight: 600; color: var(--color-1);">${proceso.proceso_principal}</td>
                        <td>${proceso.cantidad_subprocesos} pasos</td>
                        <td>${proceso.tiempo_total} minutos</td>
                        <td>
                            <button class="btn btn-ver-detalle" data-proceso="${proceso.proceso_principal}" style="background-color: var(--color-3); color: white; padding: 6px 12px; font-size: 0.85rem; cursor: pointer;">Ver Detalle</button>
                        </td>
                    </tr>
                `;
            });
        }
    })
    .catch(error => console.error('Error:', error));
}

cargarTablaProcesos();

// ==========================================
// 4. LÓGICA DEL MODAL DE DETALLES (ACTUALIZADA)
// ==========================================
const modalDetalles = document.getElementById('modal-detalles');
const btnCerrarModal = document.getElementById('btn-cerrar-modal');

// Usamos el contenedor principal de la tabla para atrapar el clic
document.getElementById('lista-procesos-catalogo').addEventListener('click', (e) => {
    
    // Buscamos si lo que se hizo clic fue el botón o algo dentro del botón
    const botonPresionado = e.target.closest('.btn-ver-detalle');
    
    // Si efectivamente se presionó el botón de detalle
    if(botonPresionado) {
        
        // ¡PRUEBA DE VIDA! Si sale este mensaje, el botón SÍ funciona.
        console.log("Botón presionado correctamente");
        
        const nombreProceso = botonPresionado.getAttribute('data-proceso');
        document.getElementById('titulo-modal').textContent = "Proceso: " + nombreProceso;
        
        // Asegúrate de que esta variable RUTA_PHP esté definida arriba en tu archivo
        fetch(RUTA_PHP, { 
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ accion: 'ver_detalles', proceso_principal: nombreProceso })
        })
        .then(respuesta => respuesta.json())
        .then(data => {
            if(data.status === 'success') {
                const tbodyModal = document.getElementById('cuerpo-tabla-modal');
                tbodyModal.innerHTML = ''; 
                
                let contador = 1;
                data.data.forEach(paso => {
                    tbodyModal.innerHTML += `
                        <tr>
                            <td style="text-align:center;">${contador}</td>
                            <td>${paso.nombre_subproceso}</td>
                            <td style="text-align:center;">${paso.tiempo_esperado_minutos} min</td>
                        </tr>
                    `;
                    contador++;
                });
                
                // Mostrar ventana
                if(modalDetalles) {
                    modalDetalles.style.display = 'flex'; // Forzamos mostrarlo
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Error de interfaz',
                    text: 'No se encuentra la ventana oculta (modal-detalles) en el HTML.',
                    customClass: { confirmButton: 'btn btn-primario' },
                    buttonsStyling: false
                    });
                }
                
            } else {
                Swal.fire({
                icon: 'error',
                title: 'Error del servidor',
                text: data.mensaje,
                customClass: { confirmButton: 'btn btn-primario' },
                buttonsStyling: false
                });
            }
        })
        .catch(error => {
            // En el catch: "Error al buscar datos. Revisa la consola F12."
            Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'Error al buscar datos. Revisa la consola F12.',
            customClass: { confirmButton: 'btn btn-primario' },
            buttonsStyling: false
            });
        });
    }
});

// Cerrar el modal al presionar la "X"
if(btnCerrarModal) {
    btnCerrarModal.addEventListener('click', () => {
        modalDetalles.style.display = 'none';
    });
}

// Cerrar el modal al hacer clic en el fondo oscuro
window.addEventListener('click', (e) => {
    if (e.target === modalDetalles) {
        modalDetalles.style.display = 'none';
    }
});


// ==========================================
// 5. LÓGICA DE MENÚS DESPLEGABLES (TRABAJADOR)
// ==========================================

function cargarSelectProcesos() {
    fetch(RUTA_PHP, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ accion: 'cargar_select_procesos' })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            const selectProceso = document.getElementById('select-proceso');
            selectProceso.innerHTML = '<option value="">-- Seleccionar Proceso --</option>';
            
            data.data.forEach(p => {
                selectProceso.innerHTML += `<option value="${p.proceso_principal}">${p.proceso_principal}</option>`;
            });
        }
    });
}

// Ejecutamos al iniciar la página
cargarSelectProcesos();

// Cuando el trabajador elige un Proceso, cargamos sus Subprocesos
document.getElementById('select-proceso').addEventListener('change', (e) => {
    const procesoSeleccionado = e.target.value;
    const selectSubproceso = document.getElementById('select-subproceso');

    if(!procesoSeleccionado) {
        selectSubproceso.innerHTML = '<option value="">-- Seleccionar Subproceso --</option>';
        return;
    }

    fetch(RUTA_PHP, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ accion: 'cargar_select_subprocesos', proceso_principal: procesoSeleccionado })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            selectSubproceso.innerHTML = '<option value="">-- Seleccionar Subproceso --</option>';
            data.data.forEach(sub => {
                // El "value" será el ID real de la base de datos, vital para los reportes
                selectSubproceso.innerHTML += `<option value="${sub.id_proceso}">${sub.nombre_subproceso} (Est: ${sub.tiempo_esperado_minutos}m)</option>`;
            });
        }
    });
});


// ==========================================
// 6. LÓGICA DEL CRONÓMETRO (TRABAJADOR)
// ==========================================

function formatearTiempo(segundosTotales) {
    const horas = Math.floor(segundosTotales / 3600);
    const minutos = Math.floor((segundosTotales % 3600) / 60);
    const segundos = segundosTotales % 60;
    
    return [horas, minutos, segundos].map(val => val < 10 ? "0" + val : val).join(":");
}

function actualizarDisplay() {
    displayTiempo.textContent = formatearTiempo(segundosTranscurridos);
}

btnIniciar.addEventListener('click', () => {
    if (estadoActual === 'listo' || estadoActual === 'pausado') {
        estadoActual = 'activo';
        estadoEtiqueta.textContent = '🟢 En proceso';
        estadoEtiqueta.className = 'badge-estado activo';
        
        // AQUÍ ESTÁ EL SECRETO: Al iniciar, bloqueamos Iniciar, pero DESBLOQUEAMOS Pausa y Finalizar
        btnIniciar.disabled = true;
        btnPausar.disabled = false;
        btnFinalizar.disabled = false;
        
        // Bloqueamos guardar mientras trabaja
        if(btnGuardarRegistro) btnGuardarRegistro.disabled = true;

        tiempoIntervalo = setInterval(() => {
            segundosTranscurridos++;
            actualizarDisplay();
        }, 1000);
    }
});

btnPausar.addEventListener('click', () => {
    if (estadoActual === 'activo') {
        clearInterval(tiempoIntervalo);
        estadoActual = 'pausado';
        estadoEtiqueta.textContent = '🟠 Pausado';
        estadoEtiqueta.className = 'badge-estado pausado';
        
        btnIniciar.disabled = false;
        btnIniciar.textContent = '▶ REANUDAR';
        btnPausar.disabled = true;
        
        // Desbloqueamos guardar si quiere pausar y guardar
        if(btnGuardarRegistro) btnGuardarRegistro.disabled = false; 
    }
});

btnFinalizar.addEventListener('click', () => {
    // 1. Detenemos el reloj
    clearInterval(tiempoIntervalo);

    // 2. Mandamos los datos a la tabla
    try {
        const paciente = document.getElementById('nombre-paciente').value;
        const selectProceso = document.getElementById('select-proceso');
        const selectSubproceso = document.getElementById('select-subproceso');
        const observaciones = document.getElementById('observaciones-tarea').value.trim();
        
        // Capturamos el nombre del Proceso Principal
        let nombreProceso = "Sin especificar";
        if(selectProceso && selectProceso.selectedIndex > 0) {
            nombreProceso = selectProceso.options[selectProceso.selectedIndex].text;
        }

        // Capturamos el nombre del Subproceso
        let nombreSubproceso = "Sin especificar";
        if(selectSubproceso && selectSubproceso.selectedIndex > 0) {
            nombreSubproceso = selectSubproceso.options[selectSubproceso.selectedIndex].text;
        }

        const tiempoTexto = document.getElementById('cronometro-display').textContent; 
        const tbody = document.getElementById('lista-tareas-pausadas') || document.getElementById('lista-actividades-dia');
        
        if (tbody) {
            // Limpiamos el mensaje de "No hay trabajos"
            if (tbody.innerHTML.includes("No hay")) {
                tbody.innerHTML = '';
            }
            
            // Paciente | Proceso | Subproceso | Tiempo | Observaciones | Acciones
            tbody.innerHTML += `
                <tr data-paciente="${paciente}" data-idproceso="${selectSubproceso ? selectSubproceso.value : ''}" data-tiempo="${segundosTranscurridos}" data-obs="${observaciones}">
                    <td style="font-weight:bold;">${paciente}</td>
                    <td>${nombreProceso}</td>
                    <td>${nombreSubproceso}</td>
                    <td style="font-weight:bold; color: var(--color-1);">${tiempoTexto}</td>
                    <td style="font-size: 0.9em; color: #555;">${observaciones || '-'}</td>
                    <td style="color: var(--estado-completado); font-weight:bold;">✅ Finalizado</td>
                </tr>
            `;
        }
    } catch (error) {
        console.error("Error al intentar dibujar en la tabla:", error);
    }

    // 3. Reiniciamos el panel automáticamente para el siguiente proceso
    segundosTranscurridos = 0;      
    actualizarDisplay();            
    
    estadoActual = 'listo';         
    estadoEtiqueta.textContent = '🟡 Listo para iniciar';
    estadoEtiqueta.className = 'badge-estado listo';
    estadoEtiqueta.style.backgroundColor = '';
    
    btnIniciar.disabled = false;    
    btnIniciar.textContent = '▶ INICIAR';
    btnPausar.disabled = true;
    btnFinalizar.disabled = true;
    
    // Nuestro parche mágico: Desbloqueamos el botón de guardar
    if(btnGuardarRegistro) btnGuardarRegistro.disabled = false;

    // 4. Limpiamos selectores para obligar a elegir el siguiente paso
    if(document.getElementById('select-subproceso')) document.getElementById('select-subproceso').value = '';
    if(document.getElementById('observaciones-tarea')) document.getElementById('observaciones-tarea').value = ''; 
});



// ==========================================
// 7. GUARDAR REGISTRO DIARIO (TRABAJADOR)
// ==========================================
document.addEventListener('click', async (e) => {
    // 1. Verificamos si el clic provino exactamente de tu botón
    const botonGuardarLote = e.target.closest('#btn-guardar-registro');
    
    // Si el clic no fue en ese botón, ignoramos y no hacemos nada
    if (!botonGuardarLote) return;

    // 2. ¡Si llegó aquí, el botón reaccionó! Evitamos que recargue la página
    e.preventDefault(); 
    console.log("▶ ¡El botón reaccionó perfectamente!");

    // 3. Buscamos todas las filas de la tabla
    const tbody = document.getElementById('lista-actividades-dia') || document.getElementById('lista-tareas-pausadas');
    
    if (!tbody) {
        Swal.fire({
        icon: 'error',
        title: 'Error visual',
        text: 'No se encuentra la tabla en el HTML.',
        customClass: { confirmButton: 'btn btn-primario' },
        buttonsStyling: false
        });
        return;
    }

    const filas = tbody.querySelectorAll('tr[data-idproceso]');

    if(filas.length === 0) {
        Swal.fire({
        icon: 'info',
        title: 'Tabla vacía',
        text: 'No hay actividades completadas en la tabla para guardar.',
        customClass: { confirmButton: 'btn btn-primario' },
        buttonsStyling: false
        });
        return;
    }

    // 4. Bloqueamos el botón para que no le den doble clic
    botonGuardarLote.disabled = true;
    const textoOriginal = botonGuardarLote.textContent; // Guardamos lo que decía el botón
    botonGuardarLote.textContent = "⏳ Guardando...";

    let registrosExitosos = 0;

    // 5. Recorremos fila por fila y la enviamos a la Base de Datos
    for(let fila of filas) {
        const datosRegistro = {
            accion: 'guardar_registro', 
            id_trabajador: document.getElementById('id-trabajador-oculto').value,
            paciente: fila.getAttribute('data-paciente'), 
            id_proceso: fila.getAttribute('data-idproceso'), 
            tiempo_segundos: fila.getAttribute('data-tiempo'),
            estado: 'completado', 
            observaciones: fila.getAttribute('data-obs')
        };

        try {
            const respuesta = await fetch(RUTA_PHP, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(datosRegistro)
            });
            const data = await respuesta.json();
            
            if(data.status === 'success') {
                registrosExitosos++;
            } else {
                console.error("❌ Error de PHP:", data.mensaje);
            }
        } catch (error) {
            console.error('❌ Error de conexión al guardar fila:', error);
        }
    }

    // 6. Resultados finales y limpieza de pantalla
    Swal.fire({
    icon: 'success',
    title: '¡Excelente!',
    text: `Se guardaron ${registrosExitosos} registros en la base de datos.`,
    customClass: { confirmButton: 'btn btn-primario' },
    buttonsStyling: false
    });
    
    // Limpiamos la tabla visual 
    tbody.innerHTML = '<tr><td colspan="6" class="texto-centro">No hay actividades en la lista todavía.</td></tr>';
    
    // Restauramos el botón
    botonGuardarLote.textContent = textoOriginal;
    botonGuardarLote.disabled = false; 
});

// ==========================================
// 8. LÓGICA DE TAREAS EN PAUSA (WIP)
// ==========================================
function cargarTareasPausadas() {
    const idTrabajador = document.getElementById('id-trabajador-oculto').value;
    
    fetch(RUTA_PHP, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ accion: 'cargar_tareas_pausadas', id_trabajador: idTrabajador })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            const tbody = document.getElementById('lista-tareas-pausadas');
            tbody.innerHTML = '';
            
            if(data.data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="texto-centro">No hay trabajos en pausa.</td></tr>';
                return;
            }
            
            data.data.forEach(tarea => {
                const tiempoTexto = formatearTiempo(tarea.tiempo_invertido_segundos);
                
                tbody.innerHTML += `
                    <tr>
                        <td style="font-weight:bold;">${tarea.nombre_paciente}</td>
                        <td>${tarea.proceso_principal}</td>
                        <td>${tarea.nombre_subproceso}</td>
                        <td style="color:#f39c12; font-weight:bold;">${tiempoTexto}</td>
                        <td>
                            <button class="btn btn-reanudar" 
                                data-id="${tarea.id_registro}" 
                                data-paciente="${tarea.nombre_paciente}"
                                data-proceso="${tarea.proceso_principal}"
                                data-subproceso="${tarea.id_proceso}"
                                data-tiempo="${tarea.tiempo_invertido_segundos}"
                                style="background-color: var(--color-2); color: white; padding: 5px 10px; font-size: 0.85rem; cursor:pointer;">
                                ▶ Reanudar
                            </button>
                        </td>
                    </tr>
                `;
            });
        }
    });
}

// Cargar la tabla en cuanto entras a la página
cargarTareasPausadas();



// Detectar clic en el botón "Reanudar"
document.getElementById('lista-tareas-pausadas').addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-reanudar');
    if(btn) {
        // 1. Cargamos los datos al formulario
        document.getElementById('id-registro-activo').value = btn.getAttribute('data-id');
        document.getElementById('nombre-paciente').value = btn.getAttribute('data-paciente');
        document.getElementById('select-proceso').value = btn.getAttribute('data-proceso');
        
        // 2. Simulamos el cambio en el selector principal para que cargue los subprocesos
        const eventoChange = new Event('change');
        document.getElementById('select-proceso').dispatchEvent(eventoChange);
        
        // Un pequeño truco de tiempo para esperar a que carguen los subprocesos y luego seleccionarlo
        setTimeout(() => {
            document.getElementById('select-subproceso').value = btn.getAttribute('data-subproceso');
        }, 300);

        // 3. Cargamos el tiempo acumulado al cronómetro
        segundosTranscurridos = parseInt(btn.getAttribute('data-tiempo'));
        actualizarDisplay();
        
        // 4. Cambiamos visualmente para indicar que está listo para retomarse
        estadoActual = 'pausado'; // Lo forzamos a pausado para que le puedan dar "Reanudar"
        estadoEtiqueta.textContent = '🟡 Listo para continuar';
        
        // Hacemos un scroll suave hacia el inicio del panel
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});