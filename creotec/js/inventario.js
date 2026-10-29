// =========================================================
// SCRIPT DE INVENTARIO - CREOTEC ERP (DELEGACIÓN DE EVENTOS)
// =========================================================

// Usamos document.addEventListener para escuchar clics en toda la página.
// Esto soluciona el problema de inyectar HTML con fetch.
document.addEventListener('click', function(evento) {
    
    // ---------------------------------------------------------
    // 1. CLIC EN PESTAÑAS PRINCIPALES (ÁREAS)
    // ---------------------------------------------------------
    let btnArea = evento.target.closest('.tab-btn');
    if (btnArea) {
        evento.preventDefault();
        
        // 1. Cambiar la pestaña activa visualmente
        document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('activo'));
        btnArea.classList.add('activo');
        
        let areaSeleccionada = btnArea.getAttribute('data-area');
        let contenedorSubTabs = document.querySelector('.sub-tabs-contenedor');
        let tarjetaTabla = document.querySelector('.tabla-tarjeta'); 
        
        // 2. APLICAR TEMA DE COLOR VISUAL
        tarjetaTabla.classList.remove('tema-todos', 'tema-anaplastologia', 'tema-manufactura', 'tema-comercial');
        tarjetaTabla.classList.add('tema-' + areaSeleccionada);

        // 3. Ocultar TODAS las tablas por precaución antes de mostrar la correcta
        document.getElementById('contenedor-tabla-global').classList.add('oculto');
        document.getElementById('contenedor-tabla-insumos').classList.add('oculto');
        document.getElementById('contenedor-tabla-compras').classList.add('oculto');
        document.getElementById('contenedor-tabla-registros').classList.add('oculto');

        // 4. Lógica de vistas (Global vs Área)
        if (areaSeleccionada === 'todos') {
            contenedorSubTabs.classList.add('oculto');
            document.getElementById('contenedor-tabla-global').classList.remove('oculto');
        } else {
            contenedorSubTabs.classList.remove('oculto');
            document.getElementById('sub-btn-insumos').click(); 
        }
    }

    // ---------------------------------------------------------
    // 2. CLIC EN SUB-PESTAÑAS (CAMBIO DE TABLAS)
    // ---------------------------------------------------------
    if (evento.target.closest('.sub-tab-btn')) {
        let subBotonClickeado = evento.target.closest('.sub-tab-btn');
        
        // Cambiar color del botón
        document.querySelectorAll('.sub-tab-btn').forEach(t => t.classList.remove('activo'));
        subBotonClickeado.classList.add('activo');
        
        // Ocultar todas las tablas
        document.getElementById('contenedor-tabla-insumos').classList.add('oculto');
        document.getElementById('contenedor-tabla-compras').classList.add('oculto');
        document.getElementById('contenedor-tabla-registros').classList.add('oculto');
        
        // Mostrar la correcta
        let tablaDeseada = subBotonClickeado.getAttribute('data-tabla');
        
        if (tablaDeseada === 'insumos') {
            document.getElementById('contenedor-tabla-insumos').classList.remove('oculto');
        } 
        else if (tablaDeseada === 'compras') {
            document.getElementById('contenedor-tabla-compras').classList.remove('oculto');
        } 
        else if (tablaDeseada === 'registros') {
            document.getElementById('contenedor-tabla-registros').classList.remove('oculto');
        }
    }

    // ---------------------------------------------------------
    // 3. ABRIR MODALES DESDE EL BOTÓN PRINCIPAL
    // ---------------------------------------------------------
    let btnPrincipal = evento.target.closest('#btn-accion-principal');
    if (btnPrincipal) {
        evento.preventDefault();
        let textoBoton = btnPrincipal.innerText;
        
        if (textoBoton.includes('Insumo')) {
            document.getElementById('form-insumo').reset();
            
            // --- MAGIA: ÁREA AUTOMÁTICA ---
            let areaActiva = document.querySelector('.tab-btn.activo').getAttribute('data-area');
            let selectArea = document.getElementById('insumo-area');
            let contenedorArea = selectArea.closest('.form-grupo'); // Selecciona el div que lo envuelve
            
            if (areaActiva === 'todos') {
                // Si estamos en Visión Global, mostramos el campo para que el usuario decida
                contenedorArea.classList.remove('oculto');
            } else {
                // Si estamos en un área, lo ocultamos y lo auto-asignamos por debajo
                contenedorArea.classList.add('oculto');
                selectArea.value = areaActiva;
            }
            // -----------------------------

            document.getElementById('modal-insumo').classList.remove('oculto');
        } 
        else if (textoBoton.includes('Compra')) {
            document.getElementById('form-compra').reset();
            document.getElementById('modal-compra').classList.remove('oculto');
        } 
        else if (textoBoton.includes('Consumo')) {
            document.getElementById('form-registro').reset();
            document.getElementById('modal-registro').classList.remove('oculto');
        }
    }

    // ---------------------------------------------------------
    // 4. CERRAR MODALES (Botón X o Cancelar)
    // ---------------------------------------------------------
    if (evento.target.closest('.btn-cerrar-modal')) {
        document.getElementById('modal-insumo').classList.add('oculto');
        document.getElementById('modal-compra').classList.add('oculto');
        document.getElementById('modal-registro').classList.add('oculto');
    }
});

// ==========================================
// 5. SIMULACIÓN DE FORMULARIOS (TEMPORAL)
// ==========================================
// Aquí se quedan Compras y Registros hasta que les hagamos su propio módulo
document.addEventListener('submit', function(evento) {
    
    if (evento.target.id === 'form-compra') {
        evento.preventDefault();
        document.getElementById('modal-compra').classList.add('oculto');
        Swal.fire({ title: '¡Compra Registrada!', icon: 'success', confirmButtonColor: '#0077B6' });
    }
    else if (evento.target.id === 'form-registro') {
        evento.preventDefault();
        document.getElementById('modal-registro').classList.add('oculto');
        Swal.fire({ title: '¡Consumo Registrado!', icon: 'info', confirmButtonColor: '#0077B6' });
    }
});

// =========================================================
// SCRIPT DE INVENTARIO - CREOTEC ERP (DELEGACIÓN DE EVENTOS)
// =========================================================

document.addEventListener('click', function(evento) {
    
    // ---------------------------------------------------------
    // 1. CLIC EN PESTAÑAS PRINCIPALES (ÁREAS)
    // ---------------------------------------------------------
    let btnArea = evento.target.closest('.tab-btn');
    if (btnArea) {
        evento.preventDefault();
        
        document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('activo'));
        btnArea.classList.add('activo');
        
        let areaSeleccionada = btnArea.getAttribute('data-area');
        let contenedorSubTabs = document.querySelector('.sub-tabs-contenedor');
        let tarjetaTabla = document.querySelector('.tabla-tarjeta'); 
        
        tarjetaTabla.classList.remove('tema-todos', 'tema-anaplastologia', 'tema-manufactura', 'tema-comercial');
        tarjetaTabla.classList.add('tema-' + areaSeleccionada);

        // Ocultar todas las tablas
        document.getElementById('contenedor-tabla-global').classList.add('oculto');
        document.getElementById('contenedor-tabla-insumos').classList.add('oculto');
        document.getElementById('contenedor-tabla-compras').classList.add('oculto');
        document.getElementById('contenedor-tabla-registros').classList.add('oculto');

        // Referencias a los 3 botones de acción
        const btnInsumo = document.getElementById('btn-nuevo-insumo');
        const btnCompra = document.getElementById('btn-nueva-compra');
        const btnRegistro = document.getElementById('btn-nuevo-registro');

        if (areaSeleccionada === 'todos') {
            contenedorSubTabs.classList.add('oculto');
            document.getElementById('contenedor-tabla-global').classList.remove('oculto');
            
            // Ocultar todos los botones de acción en Visión Global
            if (btnInsumo) btnInsumo.classList.add('oculto');
            if (btnCompra) btnCompra.classList.add('oculto');
            if (btnRegistro) btnRegistro.classList.add('oculto');
        } else {
            contenedorSubTabs.classList.remove('oculto');
            document.getElementById('sub-btn-insumos').click(); 
        }
    }

    // ---------------------------------------------------------
    // 2. CLIC EN SUB-PESTAÑAS (CAMBIO DE TABLAS Y BOTONES)
    // ---------------------------------------------------------
    if (evento.target.closest('.sub-tab-btn')) {
        let subBotonClickeado = evento.target.closest('.sub-tab-btn');
        
        document.querySelectorAll('.sub-tab-btn').forEach(t => t.classList.remove('activo'));
        subBotonClickeado.classList.add('activo');
        
        // 1. Ocultar todas las tablas
        document.getElementById('contenedor-tabla-insumos').classList.add('oculto');
        document.getElementById('contenedor-tabla-compras').classList.add('oculto');
        document.getElementById('contenedor-tabla-registros').classList.add('oculto');
        
        // 2. Ocultar todos los botones de acción
        const btnInsumo = document.getElementById('btn-nuevo-insumo');
        const btnCompra = document.getElementById('btn-nueva-compra');
        const btnRegistro = document.getElementById('btn-nuevo-registro');

        if (btnInsumo) btnInsumo.classList.add('oculto');
        if (btnCompra) btnCompra.classList.add('oculto');
        if (btnRegistro) btnRegistro.classList.add('oculto');

        // 3. Mostrar la tabla y el botón correspondiente
        let tablaDeseada = subBotonClickeado.getAttribute('data-tabla');
        
        if (tablaDeseada === 'insumos') {
            document.getElementById('contenedor-tabla-insumos').classList.remove('oculto');
            if (btnInsumo) btnInsumo.classList.remove('oculto');
        } 
        else if (tablaDeseada === 'compras') {
            document.getElementById('contenedor-tabla-compras').classList.remove('oculto');
            if (btnCompra) btnCompra.classList.remove('oculto');
        } 
        else if (tablaDeseada === 'registros') {
            document.getElementById('contenedor-tabla-registros').classList.remove('oculto');
            if (btnRegistro) btnRegistro.classList.remove('oculto');
        }
    }
});

// ==================================================================================
// ==================================================================================
//                      MÓDULO 1: LÓGICA DE TABLA INSUMOS (ANAPLASTOLOGÍA)
// ==================================================================================
// ==================================================================================

// ---------------------------------------------------------
// 1.1 VALIDACIÓN EN TIEMPO REAL: ID Insumo (Ej: ANA-001)
// ---------------------------------------------------------
document.addEventListener('input', function(evento) {
    if (evento.target.id === 'insumo-id') {
        let valor = evento.target.value.toUpperCase();
        valor = valor.replace(/[^A-Z0-9-]/g, '');
        valor = valor.replace(/^([A-Z]{3})([0-9])/, '$1-$2');
        evento.target.value = valor;
    }
});

// ---------------------------------------------------------
// 1.2 RENDERIZADO VISUAL: Colores para Prioridad (Badge)
// ---------------------------------------------------------
function obtenerBadgePrioridad(prioridad) {
    if (prioridad === '1') {
        return '<span style="background:#E76F51; color:white; padding:4px 8px; border-radius:12px; font-size:12px; font-weight:bold;">1 - Alta</span>'; // Rojo
    } else if (prioridad === '2') {
        return '<span style="background:#E9C46A; color:black; padding:4px 8px; border-radius:12px; font-size:12px; font-weight:bold;">2 - Media</span>'; // Amarillo
    } else if (prioridad === '3') {
        return '<span style="background:#2A9D8F; color:white; padding:4px 8px; border-radius:12px; font-size:12px; font-weight:bold;">3 - Baja</span>'; // Verde
    }
    return '';
}

// ---------------------------------------------------------
// 1.2.5 ABRIR MODAL PARA NUEVO INSUMO
// ---------------------------------------------------------
const btnNuevoInsumo = document.getElementById('btn-nuevo-insumo');

if (btnNuevoInsumo) {
    btnNuevoInsumo.addEventListener('click', () => {
        // 1. Limpiamos el formulario por si quedó algo escrito de una edición anterior
        document.getElementById('form-insumo').reset();
        
        // 2. Nos aseguramos de que esté en modo "nuevo" y no en modo "editar"
        document.getElementById('form-insumo').removeAttribute('data-modo');
        
        // 3. Desbloqueamos el campo del ID (por si se bloqueó al editar)
        document.getElementById('insumo-id').readOnly = false; 
        
        // 4. Finalmente, le quitamos la clase 'oculto' para que el modal aparezca
        document.getElementById('modal-insumo').classList.remove('oculto');
    });
}

// ---------------------------------------------------------
// También nos aseguramos de que la X de cerrar funcione
// ---------------------------------------------------------
const btnCerrarModalInsumo = document.getElementById('cerrar-modal-insumo');
if (btnCerrarModalInsumo) {
    btnCerrarModalInsumo.addEventListener('click', () => {
        document.getElementById('modal-insumo').classList.add('oculto');
    });
}

// ---------------------------------------------------------
// 1.3 GUARDAR O EDITAR INSUMO EN BASE DE DATOS
// ---------------------------------------------------------
document.addEventListener('submit', function(evento) {
    if (evento.target.id === 'form-insumo') {
        evento.preventDefault(); // Evita que la página se recargue

        // ⚠️ CORREGIDO: Se eliminó el campo "area" porque ya no existe en el HTML
        const datosInsumo = {
            accion: document.getElementById('form-insumo').getAttribute('data-modo') || 'nuevo_insumo', 
            id_insumo: document.getElementById('insumo-id').value,
            prioridad: document.getElementById('insumo-prioridad').value,
            nombre: document.getElementById('insumo-nombre').value,
            unidad: document.getElementById('insumo-unidad').value,
            minimo: document.getElementById('insumo-minimo').value,
            desc: document.getElementById('insumo-desc').value,
            estado: 'Óptimo'
        };

        const btnGuardar = evento.target.querySelector('button[type="submit"]');
        if (btnGuardar) {
            btnGuardar.disabled = true;
            btnGuardar.innerText = 'Guardando...';
        }

        fetch('procesos/procesos-inventario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datosInsumo)
        })
        .then(respuesta => respuesta.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('modal-insumo').classList.add('oculto');
                document.getElementById('form-insumo').reset();
                document.getElementById('form-insumo').removeAttribute('data-modo'); // Limpiar modo edición
                document.getElementById('insumo-id').readOnly = false; // Desbloquear ID por si estaba en edición
                
                Swal.fire({ title: '¡Guardado!', text: data.mensaje, icon: 'success', confirmButtonColor: '#0077B6' });
                cargarTablaInsumos(); 
            } else {
                Swal.fire({ title: 'No se pudo registrar', text: data.mensaje, icon: 'warning', confirmButtonColor: '#E76F51' });
            }
        })
        .catch(error => console.error("Error en petición de guardado:", error))
        .finally(() => {
            if (btnGuardar) {
                btnGuardar.disabled = false;
                btnGuardar.innerText = 'Guardar Insumo';
            }
        });
    }
});

// ---------------------------------------------------------
// 1.4 FUNCIÓN PARA CARGAR LA TABLA DE INSUMOS
// ---------------------------------------------------------
function cargarTablaInsumos() {
    // ⚠️ CORREGIDO: Ya no mandamos el área, solo pedimos la tabla completa de anaplastología
    fetch('procesos/procesos-inventario.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ accion: 'obtener_insumos' }) 
    })
    .then(respuesta => respuesta.json())
    .then(data => {
        if (data.status === 'success') {
            window.listaInsumos = data.data; 
            
            const tbody = document.getElementById('tbody-insumos');
            if (!tbody) return;
            
            tbody.innerHTML = '';
            
            if (data.data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="9" style="text-align:center;">No hay insumos registrados</td></tr>';
                return;
            }
            
            data.data.forEach(insumo => {
                let badgePrioridad = obtenerBadgePrioridad(insumo.prioridad);
                let colorEstado = insumo.estado === 'Óptimo' ? '#2A9D8F' : '#E76F51'; 
                
                let tr = document.createElement('tr');
                
                // ⚠️ CORREGIDO: Se eliminó la celda de Área Asignada para alinear con los 9 encabezados
                tr.innerHTML = `
                    <td style="text-align: center;"><strong>${insumo.id_insumo}</strong></td>
                    <td style="text-align: center;">${badgePrioridad}</td>
                    <td style="text-align: left;">${insumo.nombre_item}</td>
                    <td style="text-align: center;">${insumo.unidad_medida}</td>
                    <td style="text-align: center;"><strong>0</strong></td> <td style="text-align: center;">${insumo.stock_minimo}</td>
                    <td style="text-align: center;"><span style="background:${colorEstado}; color:white; padding:4px 8px; border-radius:12px; font-size:12px;">Óptimo</span></td>
                    <td style="text-align: left; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="${insumo.descripcion}">${insumo.descripcion}</td>
                    <td style="text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 10px;">
                            <button class="btn-icono btn-editar" data-id="${insumo.id_insumo}" title="Editar Insumo" style="border:none; background:none; cursor:pointer; font-size: 16px;">✏️</button>
                            <button class="btn-icono btn-eliminar" data-id="${insumo.id_insumo}" title="Eliminar Insumo" style="border:none; background:none; cursor:pointer; font-size: 16px;">🗑️</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }
    })
    .catch(error => console.error("ERROR DE COMUNICACIÓN:", error));
}

// ---------------------------------------------------------
// 1.5 DISPARAR LA CARGA DE LA TABLA AL INICIAR
// ---------------------------------------------------------
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', cargarTablaInsumos);
} else {
    cargarTablaInsumos();
}

// ---------------------------------------------------------
// 1.6 ELIMINAR Y EDITAR INSUMO (Delegación de eventos)
// ---------------------------------------------------------
document.getElementById('tbody-insumos').addEventListener('click', function(evento) {
    
    // --- LÓGICA ELIMINAR ---
    const botonEliminar = evento.target.closest('.btn-eliminar');
    if (botonEliminar) {
        const idInsumo = botonEliminar.getAttribute('data-id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: `Vas a eliminar el insumo "${idInsumo}". Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E76F51',
            cancelButtonColor: '#2A9D8F',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('procesos/procesos-inventario.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ accion: 'eliminar_insumo', id_insumo: idInsumo })
                })
                .then(respuesta => respuesta.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('¡Eliminado!', data.mensaje, 'success');
                        cargarTablaInsumos();
                    } else {
                        Swal.fire('Error', data.mensaje, 'error');
                    }
                })
                .catch(error => console.error("Error al eliminar:", error));
            }
        });
    }

    // --- LÓGICA EDITAR ---
    const botonEditar = evento.target.closest('.btn-editar');
    if (botonEditar) {
        const idInsumo = botonEditar.getAttribute('data-id');
        const insumo = window.listaInsumos.find(i => i.id_insumo === idInsumo);
        
        if (insumo) {
            // ⚠️ CORREGIDO: Ya no intentamos asignar el área
            document.getElementById('insumo-id').value = insumo.id_insumo;
            document.getElementById('insumo-id').readOnly = true; 
            document.getElementById('insumo-nombre').value = insumo.nombre_item;
            document.getElementById('insumo-prioridad').value = insumo.prioridad;
            document.getElementById('insumo-unidad').value = insumo.unidad_medida;
            document.getElementById('insumo-minimo').value = insumo.stock_minimo;
            document.getElementById('insumo-desc').value = insumo.descripcion;
            
            document.getElementById('form-insumo').setAttribute('data-modo', 'editar_insumo');
            document.getElementById('modal-insumo').classList.remove('oculto');
        }
    }
});
// =================================================================
// FILTROS DE ORDENAMIENTO DE TABLA (CLICK EN ENCABEZADOS)
// =================================================================

let ordenAscendente = false; // Variable para saber en qué orden estamos

function ordenarTabla(th, indiceColumna, tipoDato) {
    // 1. Encontrar la tabla y las filas a ordenar
    const tabla = th.closest('table');
    const tbody = tabla.querySelector('tbody');
    const filas = Array.from(tbody.querySelectorAll('tr'));

    // 2. Cambiar la dirección (de menor a mayor / mayor a menor)
    ordenAscendente = !ordenAscendente;

    // 3. Ordenar las filas
    filas.sort((a, b) => {
        let valorA = a.children[indiceColumna].innerText.trim();
        let valorB = b.children[indiceColumna].innerText.trim();

        if (tipoDato === 'numero') {
            // Convertir a número para ordenar correctamente (1, 2, 10) y no (1, 10, 2)
            let numA = parseFloat(valorA) || 0;
            let numB = parseFloat(valorB) || 0;
            return ordenAscendente ? (numA - numB) : (numB - numA);
        } else {
            // Ordenar alfabéticamente
            return ordenAscendente ? valorA.localeCompare(valorB) : valorB.localeCompare(valorA);
        }
    });

    // 4. Volver a pegar las filas ya ordenadas en la tabla
    tbody.innerHTML = '';
    filas.forEach(fila => tbody.appendChild(fila));
}





// ==================================================================================
//                      MÓDULO 2: LÓGICA DE TABLA COMPRAS
// ==================================================================================

// 2.1 CÁLCULOS AUTOMÁTICOS EN EL FORMULARIO (Contenido Neto y Precio Unitario)
const formCompra = document.getElementById('form-compra');
if (formCompra) {
    
}

// =================================================================
// 2.2 GUARDAR / EDITAR COMPRA (Definitivo - Nombre Corregido)
// =================================================================
const formAccionCompra = document.getElementById('form-compra');
if (formAccionCompra) {
    formAccionCompra.addEventListener('submit', function(e) {
        e.preventDefault();

        // Leemos el modo del formulario (editar_compra o nueva_compra)
        const modo = this.getAttribute('data-modo') || 'nueva_compra';

        const datosCompra = {
            accion: modo, // Aquí le decimos a PHP exactamente qué hacer
            compra_id: document.getElementById('compra-id').value,
            id_insumo: document.getElementById('compra-id-insumo').value,
            item: document.getElementById('compra-items').value,
            unidad: document.getElementById('compra-unidad').value,
            comprado_total: document.getElementById('compra-total').value,
            peso_envase: document.getElementById('compra-envase').value,
            comprado_contenido: document.getElementById('compra-contenido').value,
            precio_total: document.getElementById('compra-precio-total').value,
            precio_unitario: document.getElementById('compra-precio-unitario').value,
            fecha_compra: document.getElementById('compra-fecha').value
        };

        console.log("Enviando a PHP:", datosCompra);

        fetch('procesos/procesos-inventario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datosCompra)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire('¡Éxito!', data.mensaje, 'success');
                document.getElementById('modal-compra').classList.add('oculto');
                
                // Limpiamos usando el nuevo nombre de la variable
                formAccionCompra.reset();
                formAccionCompra.removeAttribute('data-modo');
                formAccionCompra.removeAttribute('data-id-compra');
                cargarTablaCompras();
            } else {
                Swal.fire('Error', data.mensaje, 'error');
            }
        });
    });
}

// 2.3 CARGAR TABLA DE COMPRAS
function cargarTablaCompras() {
    fetch('procesos/procesos-inventario.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ accion: 'obtener_compras' })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            window.listaCompras = data.data; // Guardar en memoria para editar
            const tbody = document.getElementById('cuerpo-tabla-compras'); // Asegúrate que tu tbody tenga este ID
            if (!tbody) return;
            
            tbody.innerHTML = '';
            
            if (data.data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="15" style="text-align:center;">No hay compras registradas</td></tr>';
                return;
            }
            
            data.data.forEach(c => {
                let tr = document.createElement('tr');
               tr.innerHTML = `
                    <td class="text-center"><strong>${c.id_compra}</strong></td>
                    <td class="text-left">${c.items}</td>
                    <td class="text-center">${c.id_insumo}</td>
                    <td class="text-center">${c.unidad_insumo}</td>
                    <td class="text-center">${c.comprado_total}</td>
                    <td class="text-center">${c.peso_envase}</td>
                    <td class="text-center" style="color:#0077B6; font-weight:bold;">${c.comprado_contenido}</td>
                    <td class="text-center">Bs. ${c.precio_total}</td>
                    <td class="text-center" style="color:#2A9D8F; font-weight:bold;">Bs. ${c.precio_unitario}</td>
                    <td class="text-center">${c.fecha_compra}</td>
                    <td class="text-center">-</td> <!-- Fecha Último Registro (Fórmula) -->
                    <td class="text-center">-</td> <!-- Cantidad Actual (Fórmula) -->
                    <td class="text-center">
                        <div style="display: flex; justify-content: center; gap: 10px;">
                            <button class="btn-icono btn-editar-compra" data-id="${c.id_compra}" title="Editar" style="border:none; background:none; cursor:pointer;">✏️</button>
                            <button class="btn-icono btn-eliminar-compra" data-id="${c.id_compra}" title="Eliminar" style="border:none; background:none; cursor:pointer;">🗑️</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }
    });
}

// =================================================================
// 2.4 ELIMINAR Y EDITAR COMPRA (Completo y Definitivo)
// =================================================================
document.addEventListener('click', function(e) {
    
    // ---------------------------------------------------
    // A) LÓGICA PARA ELIMINAR
    // ---------------------------------------------------
    if (e.target.closest('.btn-eliminar-compra')) {
        const idCompra = e.target.closest('.btn-eliminar-compra').getAttribute('data-id');
        Swal.fire({
            title: '¿Eliminar compra?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E76F51',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('procesos/procesos-inventario.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ accion: 'eliminar_compra', id_compra: idCompra })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('Eliminado', data.mensaje, 'success');
                        cargarTablaCompras();
                    } else {
                        Swal.fire('Error', data.mensaje, 'error');
                    }
                })
                .catch(err => console.error("Error al eliminar:", err));
            }
        });
    }

    // ---------------------------------------------------
    // B) LÓGICA PARA EDITAR
    // ---------------------------------------------------
    if (e.target.closest('.btn-editar-compra')) {
        const idCompra = e.target.closest('.btn-editar-compra').getAttribute('data-id');
        const compra = window.listaCompras.find(c => c.id_compra == idCompra);
        
        if (compra) {
            const elForm = document.getElementById('form-compra');

            // 1. Asignamos correctamente el ID de la Compra y lo bloqueamos
            const inputIdCompra = document.getElementById('compra-id');
            inputIdCompra.value = compra.id_compra;
            inputIdCompra.readOnly = true;
            inputIdCompra.style.backgroundColor = '#f0f0f0';

            // 2. Asignamos el ID del Insumo a su propia casilla
            document.getElementById('compra-id-insumo').value = compra.id_insumo;

            // 3. Rellenamos el resto de los datos
            document.getElementById('compra-items').value = compra.items;
            document.getElementById('compra-unidad').value = compra.unidad_insumo;
            document.getElementById('compra-total').value = compra.comprado_total;
            document.getElementById('compra-envase').value = compra.peso_envase;
            document.getElementById('compra-contenido').value = compra.comprado_contenido;
            document.getElementById('compra-precio-total').value = compra.precio_total;
            document.getElementById('compra-precio-unitario').value = compra.precio_unitario;
            document.getElementById('compra-fecha').value = compra.fecha_compra;
            
            // 4. Cambiamos el formulario a MODO EDICIÓN
            elForm.setAttribute('data-modo', 'editar_compra');
            
            document.getElementById('modal-compra').classList.remove('oculto');
        }
    }
});

// =================================================================
// FILTROS DE ORDENAMIENTO PARA TABLA DE COMPRAS
// =================================================================

let ordenAscendenteCompras = true; // Empezamos en true porque el PHP ya lo trae de menor a mayor

function ordenarTablaCompras(th, indiceColumna, tipoDato) {
    const tabla = th.closest('table');
    const tbody = tabla.querySelector('tbody');
    const filas = Array.from(tbody.querySelectorAll('tr'));

    // Cambiar la dirección (ascendente/descendente)
    ordenAscendenteCompras = !ordenAscendenteCompras;

    filas.sort((a, b) => {
        let valorA = a.children[indiceColumna].innerText.trim();
        let valorB = b.children[indiceColumna].innerText.trim();

        if (tipoDato === 'numero') {
            // Ordenar números puros
            let numA = parseFloat(valorA) || 0;
            let numB = parseFloat(valorB) || 0;
            return ordenAscendenteCompras ? (numA - numB) : (numB - numA);
            
        } else if (tipoDato === 'moneda') {
            // Eliminar letras (como "Bs.") y dejar solo el número para poder ordenar
            let numA = parseFloat(valorA.replace(/[^0-9.-]+/g, "")) || 0;
            let numB = parseFloat(valorB.replace(/[^0-9.-]+/g, "")) || 0;
            return ordenAscendenteCompras ? (numA - numB) : (numB - numA);
            
        } else if (tipoDato === 'fecha') {
            // Convertir las fechas a tiempo para compararlas, ignorando los guiones "-"
            let dateA = valorA !== '-' ? new Date(valorA).getTime() : 0;
            let dateB = valorB !== '-' ? new Date(valorB).getTime() : 0;
            return ordenAscendenteCompras ? (dateA - dateB) : (dateB - dateA);
            
        } else {
            // Ordenar alfabéticamente (por defecto)
            return ordenAscendenteCompras ? valorA.localeCompare(valorB) : valorB.localeCompare(valorA);
        }
    });

    // Volver a inyectar las filas ordenadas
    tbody.innerHTML = '';
    filas.forEach(fila => tbody.appendChild(fila));
}


// =================================================================
// 2.5 ABRIR MODAL NUEVA COMPRA (CORREGIDO)
// =================================================================
const btnNuevaCompra = document.getElementById('btn-nueva-compra');
if (btnNuevaCompra) {
    btnNuevaCompra.addEventListener('click', () => {
        const elForm = document.getElementById('form-compra');
        elForm.reset();

        // Desbloquear el campo de ID para una compra nueva
        const inputIdCompra = document.getElementById('compra-id');
        inputIdCompra.readOnly = false;
        inputIdCompra.style.backgroundColor = '#ffffff';

        // Establecer el modo en nueva_compra
        elForm.setAttribute('data-modo', 'nueva_compra');
        elForm.removeAttribute('data-id-compra');
        
        document.getElementById('modal-compra').classList.remove('oculto');
    });
}

// CARGAR AL INICIAR
document.addEventListener('DOMContentLoaded', () => {
    if(document.getElementById('cuerpo-tabla-compras')) {
        cargarTablaCompras();
    }
});



// =================================================================
// CEREBRO DE COMPRAS: BUSCADOR, AUTOCOMPLETADO Y CALCULADORA
// =================================================================

let insumosDisponibles = []; // Memoria temporal para guardar los insumos

// 1. Cargar las opciones en el buscador al abrir la página o el modal
function cargarOpcionesBuscador() {
    fetch('procesos/procesos-inventario.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ accion: 'obtener_insumos' })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            insumosDisponibles = data.data; 
            const datalist = document.getElementById('lista-insumos');
            
            // Si el datalist no existe en el HTML, lo creamos dinámicamente por seguridad
            let lista = datalist;
            if (!lista) {
                lista = document.createElement('datalist');
                lista.id = 'lista-insumos';
                document.body.appendChild(lista);
            }
            
            lista.innerHTML = ''; // Limpiamos opciones anteriores
            
            // Creamos una opción por cada insumo disponible
            insumosDisponibles.forEach(insumo => {
                let opcion = document.createElement('option');
                opcion.value = insumo.nombre_item; // Lo que el usuario escribe/selecciona
                lista.appendChild(opcion);
            });
        }
    })
    .catch(error => console.error("Error al cargar insumos para el buscador:", error));
}

// Ejecutamos la función al cargar la página
cargarOpcionesBuscador();


// 2. Autocompletar ID Insumo y Unidad al escribir o elegir un Ítem
const inputItems = document.getElementById('compra-items');
if (inputItems) {
    // Aseguramos que el input tenga conectado el datalist
    inputItems.setAttribute('list', 'lista-insumos');

    inputItems.addEventListener('input', function() {
        const nombreEscrito = this.value.trim();
        
        // Buscamos coincidencia exacta en nuestra memoria de insumos
        const insumoEncontrado = insumosDisponibles.find(i => i.nombre_item === nombreEscrito);
        
        if (insumoEncontrado) {
            // Si coincide, rellenamos automáticamente los campos bloqueados
            document.getElementById('compra-id-insumo').value = insumoEncontrado.id_insumo;
            document.getElementById('compra-unidad').value = insumoEncontrado.unidad_medida;
        } else {
            // Si no coincide o se borra, limpiamos los campos
            document.getElementById('compra-id-insumo').value = '';
            document.getElementById('compra-unidad').value = '';
        }
    });
}


// =================================================================
// 3. LA CALCULADORA INTEGRADA (Fórmulas) - CORREGIDO
// =================================================================
const formularioCompra = document.getElementById('form-compra');
if (formularioCompra) {
    formularioCompra.addEventListener('input', function(e) {
        // Disparamos la matemática solo cuando cambien estos tres campos
        if (['compra-total', 'compra-envase', 'compra-precio-total'].includes(e.target.id)) {
            
            let compradoTotal = parseFloat(document.getElementById('compra-total').value) || 0;
            let pesoEnvase = parseFloat(document.getElementById('compra-envase').value) || 0;
            let precioTotal = parseFloat(document.getElementById('compra-precio-total').value) || 0;

            // FÓRMULA 1: Contenido Neto
            let contenidoNeto = compradoTotal - pesoEnvase;
            document.getElementById('compra-contenido').value = contenidoNeto.toFixed(2);

            // FÓRMULA 2: Precio Unitario
            let precioUnitario = 0;
            if (contenidoNeto !== 0) {
                precioUnitario = precioTotal / contenidoNeto;
            }
            document.getElementById('compra-precio-unitario').value = precioUnitario.toFixed(2);
        }
    });
}