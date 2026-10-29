<div class="dash-content" style="padding-bottom: 50px;">
    
    <div class="overview" style="margin-top: 20px; margin-bottom: 40px;">
        <div class="title" style="display: flex; align-items: center; background: white; padding: 20px 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-left: 6px solid var(--primary-color);">
            <img src="imagenes/anaplastologia.png" class="icono-titulo" alt="Anaplastología" style="width: 45px; height: 45px; margin-right: 15px; object-fit: contain;">
            <div>
                <h1 style="color: var(--text-color); font-size: 26px; font-weight: 700; margin-bottom: 5px;">Departamento de Anaplastología</h1>
                <p style="color: #4A5568; font-size: 15px;">Seleccione el módulo operativo al que desea ingresar.</p>
            </div>
        </div>
    </div>

    <div class="boxes" style="display: flex; gap: 30px; flex-wrap: wrap;">

        <a href="javascript:void(0);" id="cargar-busqueda-moldes" class="area-detail-card" style="text-decoration: none; width: calc(50% - 15px); min-width: 320px; display: flex; flex-direction: column; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
            <div style="height: 180px; width: 100%; position: relative; background-color: var(--box1-color);">
            <img src="imagenes/manoo.jpg" alt="Fondo Moldes" style="width: 100%; height: 100%; object-fit: cover;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(3, 4, 94, 0.4); display: flex; align-items: center; justify-content: center;">
            </div>
            </div>
            <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
            <h3 style="color: var(--text-color); font-size: 22px; font-weight: 700; margin-bottom: 12px;">Búsqueda de Moldes</h3>
            <p style="color: #4A5568; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                Módulo destinado a la localización, trazabilidad y gestión del archivo físico y digital de moldes técnicos. Permite vincular cada molde con el historial clínico del paciente correspondiente.
            </p>
            <div style="margin-top: auto; color: var(--primary-color); font-weight: 600; font-size: 16px; display: flex; align-items: center;">
                Ingresar al módulo <span style="margin-left: 8px; font-size: 20px;">→</span>
            </div>
            </div>

             <div id="modal-confirmacion" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:10001; justify-content:center; align-items:center;">
        </div>


        </a>

        <a href="inicio.php?pagina=ana_inventario" class="area-detail-card" style="text-decoration: none; width: calc(50% - 15px); min-width: 320px; display: flex; flex-direction: column; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
            <div style="height: 180px; width: 100%; position: relative; background-color: var(--box2-color);">
                <img src="imagenes/inventario.jpg" alt="Fondo Inventario" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(3, 4, 94, 0.4); display: flex; align-items: center; justify-content: center;">
                </div>
            </div>
            <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
                <h3 style="color: var(--text-color); font-size: 22px; font-weight: 700; margin-bottom: 12px;">Inventario del Área</h3>
                <p style="color: #4A5568; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                    Control absoluto de las existencias de materiales clínicos, siliconas de grado médico, pigmentos y herramientas. Evita quiebres de stock mediante alertas automáticas de reposición.
                </p>
                <div style="margin-top: auto; color: var(--primary-color); font-weight: 600; font-size: 16px; display: flex; align-items: center;">
                    Ingresar al módulo <span style="margin-left: 8px; font-size: 20px;">→</span>
                </div>
            </div>
        </a>

        <a href="inicio.php?pagina=ana_procesos" class="area-detail-card" style="text-decoration: none; width: calc(50% - 15px); min-width: 320px; display: flex; flex-direction: column; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
            <div style="height: 180px; width: 100%; position: relative; background-color: var(--box3-color);">
                <img src="imagenes/registro-actividades.jpg" alt="Fondo Procesos" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(3, 4, 94, 0.4); display: flex; align-items: center; justify-content: center;">            
                </div>
            </div>
            <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
                <h3 style="color: var(--text-color); font-size: 22px; font-weight: 700; margin-bottom: 12px;">Control de Procesos</h3>
                <p style="color: #4A5568; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                    Supervisión paso a paso de la fabricación del los guantes 
                </p>
                <div style="margin-top: auto; color: var(--primary-color); font-weight: 600; font-size: 16px; display: flex; align-items: center;">
                    Ingresar al módulo <span style="margin-left: 8px; font-size: 20px;">→</span>
                </div>
            </div>
        </a>

        <a href="inicio.php?pagina=ana_rendimiento" class="area-detail-card" style="text-decoration: none; width: calc(50% - 15px); min-width: 320px; display: flex; flex-direction: column; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
            <div style="height: 180px; width: 100%; position: relative; background-color: var(--black-light-color);">
                <img src="imagenes/registro-actividades.jpg" alt="Fondo Personal" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(3, 4, 94, 0.4); display: flex; align-items: center; justify-content: center;">            
                </div>
            </div>
            <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1;">
                <h3 style="color: var(--text-color); font-size: 22px; font-weight: 700; margin-bottom: 12px;">Rendimiento del Personal</h3>
                <p style="color: #4A5568; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                    Evaluación de KPIs, carga de trabajo y cumplimiento de objetivos del equipo de anaplastólogos. Genera métricas de eficiencia en la atención a pacientes.
                </p>
                <div style="margin-top: auto; color: var(--primary-color); font-weight: 600; font-size: 16px; display: flex; align-items: center;">
                    Ingresar al módulo <span style="margin-left: 8px; font-size: 20px;">→</span>
                </div>
            </div>
        </a>

    </div>
       
</div>