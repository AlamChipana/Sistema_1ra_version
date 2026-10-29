<link rel="stylesheet" href="css/inventario.css">

<!-- ========================================================= -->
<!-- VISTA DE INVENTARIO - CREOTEC ERP (SISTEMA KARDEX)        -->
<!-- ========================================================= -->

<div class="modulo-contenedor">
    
    <!-- ========================================== -->
    <!-- 1. CABECERA Y PESTAÑAS PRINCIPALES (ÁREAS) -->
    <!-- ========================================== -->
    <div class="modulo-cabecera">
        <div class="cabecera-titulos">
            <h2 class="titulo-modulo">Gestión de Inventario Maestro</h2>
            <p class="subtitulo-modulo">Control centralizado de insumos, historial de compras y consumo diario.</p>
        </div>
        
        <div class="tabs-areas">
            <button id="btn-todos" class="tab-btn activo" data-area="todos">Visión Global</button>
            <button id="btn-anaplastologia" class="tab-btn" data-area="anaplastologia">Anaplastología</button>
            <button id="btn-manufactura" class="tab-btn" data-area="manufactura">Manufactura</button>
            <button id="btn-comercial" class="tab-btn" data-area="comercial">Comercial</button>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 2. SUB-PESTAÑAS (CAMBIO DE TABLAS)         -->
    <!-- ========================================== -->
    <div class="sub-tabs-contenedor oculto">
        <button id="sub-btn-insumos" class="sub-tab-btn activo" data-tabla="insumos">📦 Catálogo de Insumos</button>
        <button id="sub-btn-compras" class="sub-tab-btn" data-tabla="compras">🛒 Historial de Compras</button>
        <button id="sub-btn-registros" class="sub-tab-btn" data-tabla="registros">📉 Registro de Consumo</button>
    </div>

    <!-- ========================================== -->
    <!-- 3. TARJETAS DE INDICADORES (KPIs)          -->
    <!-- ========================================== -->
    <div class="kpi-dashboard">
        <div class="kpi-card">
            <span class="kpi-titulo">Total Insumos</span>
            <span class="kpi-valor" id="kpi-total-insumos">---</span>
            <span class="kpi-detalle">En catálogo activo</span>
        </div>
        <div class="kpi-card alerta">
            <span class="kpi-titulo">Stock Crítico</span>
            <span class="kpi-valor text-danger" id="kpi-stock-critico">---</span>
            <span class="kpi-detalle">Requieren compra</span>
        </div>
        <div class="kpi-card">
            <span class="kpi-titulo">Última Compra</span>
            <span class="kpi-valor" id="kpi-ultima-compra">---</span>
            <span class="kpi-detalle" id="kpi-detalle-compra">Cargando...</span>
        </div>
        <div class="kpi-card">
            <span class="kpi-titulo">Consumo General</span>
            <span class="kpi-valor" id="kpi-consumo-general">---</span>
            <span class="kpi-detalle">Unidades consumidas</span>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 4. CONTROLES AVANZADOS Y BÚSQUEDA          -->
    <!-- ========================================== -->
    <div class="controles-avanzados">
        <div class="grupo-filtros">
            <div class="input-con-icono">
                <span class="icono-busqueda">🔍</span>
                <input type="text" id="buscar-inventario" class="input-control" placeholder="Buscar por ID o nombre...">
            </div>
            
            <select class="input-control" id="filtro-estado">
                <option value="">Todos los Estados</option>
                <option value="optimo">Stock Óptimo</option>
                <option value="bajo">Stock Bajo / Crítico</option>
            </select>
        </div>

        <div class="grupo-acciones">
            <button class="btn-secundario" id="btn-exportar">📥 Exportar Vista</button>
            <button id="btn-nuevo-insumo" class="btn-primario">➕ Nuevo Insumo</button>
            <button id="btn-nueva-compra" class="btn-primario oculto">🛒 Registrar Compra</button>
            <button id="btn-nuevo-registro" class="btn-primario oculto">📉 Registrar Consumo</button>
        </div>
    </div>

   <!-- ========================================== -->
    <!-- 5. CONTENEDORES DE TABLAS (Se alternan)    -->
    <!-- ========================================== -->
    <div class="tabla-tarjeta">
        
        <!-- TABLA 0: VISIÓN GLOBAL (Consolidado de todas las áreas) -->
        <div id="contenedor-tabla-global" class="tabla-contenedor">
            <table class="tabla-creotec">
                <thead>
                    <tr>
                        <th class="text-center">ID INSUMO</th>
                        <!-- Esta es la columna clave para la vista global -->
                        <th class="text-center bg-light">ÁREA ASIGNADA</th> 
                        <th class="text-center">PRIORIDAD</th>
                        <th class="text-left">ITEMS</th>
                        <th class="text-center">UNIDAD</th>
                        <th class="text-right">CANT. ACTUAL</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody id="cuerpo-tabla-global">
                    <!-- Filas inyectadas por JS -->
                </tbody>
            </table>
        </div>

        <!-- TABLA 1: INSUMOS-->
        <div id="contenedor-tabla-insumos" class="tabla-contenedor oculto">
            <table style="width: 100%; table-layout: fixed; border-collapse: collapse;" class="tabla-creotec">
                <thead>
                    <tr>
                        <th onclick="ordenarTabla(this, 0, 'numero')" style="cursor: pointer;" title="Clic para ordenar">ID Insumo ↕️</th>
                        <th onclick="ordenarTabla(this, 1, 'numero')" style="cursor: pointer;" title="Clic para ordenar">Prioridad ↕️</th>
                        <th>Nombre del Insumo</th>
                        <th>Unidad</th>
                        <th style="width: 12%; text-align: center;">Cantidad Actual</th>
                        <th style="width: 10%; text-align: center;">Stock Mínimo</th>
                        <th onclick="ordenarTabla(this, 6, 'texto')" style="cursor: pointer;" title="Clic para ordenar">Estado ↕️</th>
                        <th style="width: 11%; text-align: left;">Descripción</th>
                        <th style="width: 9%; text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody-insumos">
                    <tr>
                        <td colspan="9" style="text-align:center;">Cargando datos...</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- TABLA 2: COMPRAS (Historial de ingresos) -->
        <div id="contenedor-tabla-compras" class="tabla-contenedor oculto"style="overflow-x: auto; width: 100%;">
            <table style="width: 100%; table-layout: fixed; border-collapse: collapse;" class="tabla-creotec">                
                <thead>
                    <tr>
                        <th class="text-center" style="width: 6%; line-height: 1.1; cursor: pointer;" onclick="ordenarTablaCompras(this, 0, 'numero')" title="Clic para ordenar">ID<br>COMPRA↕️</th>
                        <th class="text-center" style="width: 15%;">ITEMS</th>
                        <th class="text-center" style="width: 7%; line-height: 1.1;">ID<br>INSUMO</th>
                        <th class="text-center" style="width: 6%; line-height: 1.1;">UNIDAD<br>INSUMO</th>
                        <th class="text-center" style="width: 7%; line-height: 1.1;">COMPRADO<br>TOTAL</th>
                        <th class="text-center" style="width: 7%; line-height: 1.1;">PESO<br>ENVASE</th>
                        <th class="text-center" style="width: 8%; line-height: 1.1;">COMPRADO<br>CONTENIDO</th>
                        <th class="text-center" style="width: 7%; line-height: 1.1; cursor: pointer;" onclick="ordenarTablaCompras(this, 7, 'moneda')" title="Clic para ordenar">PRECIO<br>TOTAL↕️</th>
                        <th class="text-center" style="width: 7%; line-height: 1.1;">PRECIO<br>UNITARIO</th>
                        <th class="text-center" style="width: 7%; line-height: 1.1; cursor: pointer;" onclick="ordenarTablaCompras(this, 9, 'fecha')" title="Clic para ordenar">FECHA DE<br>LA COMPRA↕️</th>
                        <th class="text-center" style="width: 7%; line-height: 1.1; cursor: pointer;" onclick="ordenarTablaCompras(this, 10, 'fecha')" title="Clic para ordenar">FECHA<br>ÚLTIMO<br>REGISTRO↕️</th>
                        <th class="text-center" style="width: 7%; line-height: 1.1;">CANTIDAD<br>ACTUAL</th>
                        <th class="text-center" style="width: 9%;">ACCIONES</th>
                    </tr>
                    <thead>
                <tbody id="cuerpo-tabla-compras">
                    <tr>
                        <td colspan="14" style="text-align:center;">Cargando compras...</td> 
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- TABLA 3: REGISTROS (Kardex de consumo diario) -->
        <div id="contenedor-tabla-registros" class="tabla-contenedor oculto">
            <input type="hidden" id="area-activa" value="comercial">
            <table class="tabla-creotec">
                <thead>
                    <tr>
                        <th class="text-center">ID REGISTRO</th>
                        <th class="text-center">ID COMPRA</th>
                        <th class="text-left">ITEMS</th>
                        <th class="text-center">FECHA REG.</th>
                        <th class="text-right">CANT. ANT.</th>
                        <th class="text-right">CONSUMO ACTUAL</th>
                        <th class="text-right">GASTOS</th>
                        <th class="text-center">STOCK</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody id="cuerpo-tabla-registros">
                </tbody>
            </table>
        </div>
        
        <!-- Paginación Global -->
        <div class="paginacion-contenedor">
            <div class="paginacion-controles">
                <button class="btn-pag">Anterior</button>
                <button class="btn-pag activo">1</button>
                <button class="btn-pag">Siguiente</button>
            </div>
        </div>
    </div>

</div> <!-- Fin del modulo-contenedor -->

<!-- ========================================================= -->
<!-- MODAL: NUEVO INSUMO (Anaplastología)                      -->
<!-- ========================================================= -->
<div id="modal-insumo" class="modal-overlay oculto">
    <div class="modal-contenido">
        <div class="modal-cabecera">
            <h3 id="modal-titulo-insumo">Registrar Nuevo Insumo - Anaplastología</h3>
            <button type="button" class="btn-cerrar-modal" id="cerrar-modal-insumo">✖</button>
        </div>
        
        <div class="modal-cuerpo">
            <form id="form-insumo">
                
                <!-- Fila 1: ID Insumo y Prioridad -->
                <div class="form-fila">
                    <div class="form-grupo">
                        <label>ID INSUMO</label>
                        <input type="text" id="insumo-id" class="input-control" placeholder="Ej: 001" required>
                    </div>
                    <div class="form-grupo">
                        <label>Prioridad</label>
                        <select id="insumo-prioridad" class="input-control" required>
                            <option value="1">1 - Alta (Rojo)</option>
                            <option value="2">2 - Media (Amarillo)</option>
                            <option value="3">3 - Baja (Verde)</option>
                        </select>
                    </div>
                </div>
                
                <!-- Fila 2: Nombre del Ítem y Unidad de Medida -->
                <div class="form-fila">
                    <div class="form-grupo">
                        <label>Nombre del Ítem</label>
                        <input type="text" id="insumo-nombre" class="input-control" required>
                    </div>
                    <div class="form-grupo">
                        <label>Unidad de Medida</label>
                        <select id="insumo-unidad" class="input-control" required>
                            <option value="g">Gramos (g)</option>
                            <option value="u">Unidades (u)</option>
                            <option value="rollo">Rollo</option>
                            <option value="kg">Kilogramos (kg)</option>
                            <option value="lt">Litros (lt)</option>
                        </select>
                    </div>
                </div>
                
                <!-- Fila 3: Stock Mínimo -->
                <div class="form-fila">
                    <div class="form-grupo" style="width: 100%;">
                        <label>Stock Mínimo</label>
                        <input type="number" id="insumo-minimo" class="input-control" min="0" step="0.01" required>
                    </div>
                </div>
                
                <!-- Fila 4: Descripción / Observaciones -->
                <div class="form-grupo">
                    <label>Descripción / Observaciones</label>
                    <input type="text" id="insumo-desc" class="input-control">
                </div>
                
                <!-- Pie del Modal -->
                <div class="modal-pie">
                    <button type="button" class="btn-secundario btn-cerrar-modal" onclick="document.getElementById('modal-insumo').classList.add('oculto')">Cancelar</button>
                    <button type="submit" class="btn-primario">Guardar Insumo</button>
                </div>
                
            </form>
        </div>
    </div>
</div>


<!-- ======================================================= -->
<!-- MODAL REGISTRAR NUEVA COMPRA -->
<!-- ======================================================= -->
<div id="modal-compra" class="modal-overlay oculto">
    <div class="modal-contenido">
        <div class="modal-cabecera">
            <h3 id="modal-titulo-compra">Registrar Nueva Compra</h3>
            <button type="button" class="btn-cerrar-modal" id="cerrar-modal-compra" onclick="document.getElementById('modal-compra').classList.add('oculto')">✖</button>
        </div>
        
        <div class="modal-cuerpo">
            <form id="form-compra" data-modo="nueva_compra">
                
                <!-- Fila 1: ID de Compra e Ítems (Buscador) -->
                <div class="form-fila">
                    <div class="form-grupo">
                        <label>ID de Compra </label>
                        <input type="text" id="compra-id" class="input-control" required placeholder="Ej: 001">
                    </div>
                    <div class="form-grupo">
                        <label>Ítems </label>
                        <input type="text" id="compra-items" list="lista-insumos" class="input-control" autocomplete="off" required placeholder="Escribe para buscar...">
                        <datalist id="lista-insumos"></datalist>
                    </div>
                </div>

                <!-- Fila 2: ID Insumo y Unidad (Automáticos) -->
                <div class="form-fila">
                    <div class="form-grupo">
                        <label>ID Insumo (Automático)</label>
                        <input type="text" id="compra-id-insumo" class="input-control" readonly style="background-color: #f0f0f0;">
                    </div>
                     <div class="form-grupo">
                        <label>Unidad de Medida (Automático)</label>
                        <input type="text" id="compra-unidad" class="input-control" readonly style="background-color: #f0f0f0;">
                    </div>
                </div>

                <!-- Fila 3: Comprado Total y Peso Envase (Manuales) -->
                <div class="form-fila">
                    <div class="form-grupo">
                        <label>Comprado Total</label>
                        <input type="number" id="compra-total" class="input-control" step="0.01" required>
                    </div>
                    <div class="form-grupo">
                        <label>Peso Envase</label>
                        <input type="number" id="compra-envase" class="input-control" step="0.01" required>
                    </div>
                </div>

                <!-- Fila 4: Contenido Neto (Fórmula) y Precio Total -->
                <div class="form-fila">
                    <div class="form-grupo">
                        <label>Contenido Neto (Automático)</label>
                        <input type="number" id="compra-contenido" class="input-control" step="0.01" readonly style="background-color: #e6f7ff; font-weight: bold;">
                    </div>
                    <div class="form-grupo">
                        <label>Precio Total</label>
                        <input type="number" id="compra-precio-total" class="input-control" step="0.01" required>
                    </div>
                </div>

                <!-- Fila 5: Precio Unitario (Fórmula) y Fecha -->
                <div class="form-fila">
                    <div class="form-grupo">
                        <label>Precio Unitario (Automático)</label>
                        <input type="number" id="compra-precio-unitario" class="input-control" step="0.01" readonly style="background-color: #e6f7ff; font-weight: bold;">
                    </div>
                    <div class="form-grupo">
                        <label>Fecha de Compra</label>
                        <input type="date" id="compra-fecha" class="input-control" required>
                    </div>
                </div>

                <!-- Pie del Modal -->
                <div class="modal-pie">
                    <button type="button" class="btn-secundario btn-cerrar-modal" onclick="document.getElementById('modal-compra').classList.add('oculto')">Cancelar</button>
                    <button type="submit" class="btn-primario">Guardar Compra</button>
                </div>

            </form>
        </div>
    </div>
</div>



<!-- Modal: NUEVO REGISTRO (Consumo/Kardex) -->
<div id="modal-registro" class="modal-overlay oculto">
    <div class="modal-contenido">
        <div class="modal-cabecera">
            <h3 id="modal-titulo-registro">Registrar Consumo Diario</h3>
            <button class="btn-cerrar-modal">✖</button>
        </div>
        <div class="modal-cuerpo">
            <form id="form-registro">
                <!-- Aquí irán los campos del Excel REGISTRO en el futuro -->
                <p class="text-muted">Formulario para descontar stock (registrar pesaje/uso) en construcción...</p>
                <div class="modal-pie">
                    <button type="button" class="btn-secundario btn-cerrar-modal">Cancelar</button>
                    <button type="submit" class="btn-primario bg-warning">Confirmar Consumo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="inventario.js?v=1"></script>