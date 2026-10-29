<div class="dash-content" style="padding-bottom: 50px;">
    
    <div class="hero-section" style="position: relative; border-radius: 15px; overflow: hidden; margin-top: 20px; margin-bottom: 40px; box-shadow: 0 4px 20px rgba(3, 4, 94, 0.15); height: 300px;">
        
        <div class="slider-container" style="display: flex; width: 300%; height: 100%; transition: transform 0.8s ease-in-out;">
            <img src="imagenes/imagen1.jpg" alt="Innovación 1" style="width: 33.333%; height: 100%; object-fit: cover;">
            <img src="imagenes/imagen2.jpg" alt="Innovación 2" style="width: 33.333%; height: 100%; object-fit: cover;">
            <img src="imagenes/imagen3.jpg" alt="Innovación 3" style="width: 33.333%; height: 100%; object-fit: cover;">
            <img src="imagenes/imagen4.jpg" alt="Innovación 3" style="width: 33.333%; height: 100%; object-fit: cover;">
            <img src="imagenes/imagen5.jpg" alt="Innovación 3" style="width: 33.333%; height: 100%; object-fit: cover;">
        </div>
        
        <div class="hero-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(3, 4, 94, 0.85), rgba(0, 180, 216, 0.45)); display: flex; align-items: center; padding: 40px; color: white; z-index: 2;">
            <div class="hero-text">
                <h1 style="font-size: 28px; font-weight: 600; margin-bottom: 10px; line-height: 1.4;">
                    ¡Bienvenido a Creotec, <?php echo isset($_SESSION['usuario_activo']) ? htmlspecialchars($_SESSION['usuario_activo']) : 'Usuario'; ?>!
                </h1>
                <p style="font-size: 16px; max-width: 600px; opacity: 0.95; line-height: 1.6;">
                    Transformando la tecnología biomédica a través de la innovación digital.
                </p>
            </div>
        </div>
    </div>

    <div class="mision-vision-container" style="display: flex; gap: 25px; margin-bottom: 40px; flex-wrap: wrap;">
        <div class="mivisi-card" style="flex: 1; min-width: 300px; background: white; padding: 30px; border-radius: 12px; border-left: 6px solid var(--primary-color); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <img src="imagenes/mision.png" alt="Misión" style="width: 35px; height: 35px; margin-right: 12px; object-fit: contain;">
                <h2 style="color: var(--text-color); font-size: 22px; font-weight: 600;">Nuestra Misión</h2>
            </div>
            <p style="color: #4A5568; font-size: 15px; line-height: 1.6; text-align: justify; font-style: italic;">
                "Crear prótesis y órtesis funcionales para integrarse de forma natural a la vida de las personas, impulsándolas a alcanzar su mejor versión."
            </p>
        </div>

        <div class="mivisi-card" style="flex: 1; min-width: 300px; background: white; padding: 30px; border-radius: 12px; border-left: 6px solid var(--black-light-color); box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <img src="imagenes/vision.png" alt="Visión" style="width: 35px; height: 35px; margin-right: 12px; object-fit: contain;">
                <h2 style="color: var(--text-color); font-size: 22px; font-weight: 600;">Nuestra Visión</h2>
            </div>
            <p style="color: #4A5568; font-size: 15px; line-height: 1.6; text-align: justify; font-style: italic;">
                "Desarrollar tecnología para que ninguna barrera física o emocional, presente o futura, limite la capacidad y el propósito de las personas."
            </p>
        </div>
    </div>

    <div class="sistema-proposito" style="background: white; padding: 35px; border-radius: 12px; margin-bottom: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border-top: 4px solid var(--primary-color);">
        <div style="display: flex; align-items: center; margin-bottom: 20px;">
            <img src="imagenes/computadora.png" alt="Sistema" style="width: 35px; height: 35px; margin-right: 12px; object-fit: contain;">
            <h2 style="color: var(--text-color); font-size: 24px; font-weight: 600;">¿Qué hace este Sistema de Gestión?</h2>
        </div>
        
        <p style="color: #4A5568; font-size: 15px; line-height: 1.7; text-align: justify; margin-bottom: 20px;">
            El sistema desarrollado es una plataforma diseñada para gestionar, supervisar y dar seguimiento a las diferentes tareas y procesos desarrollados por cada área de la empresa. Su principal objetivo es centralizar la información operativa y administrativa, permitiendo un control eficiente de las actividades diariamente, la asignación de responsabilidades y el monitoreo del cumplimiento de objetivos.
        </p>
        
        <p style="color: #4A5568; font-size: 15px; line-height: 1.7; text-align: justify; margin-bottom: 20px;">
            A través de este sistema, los responsables de cada área pueden registrar, actualizar y verificar el estado de sus actividades en tiempo real, facilitando la coordinación entre departamentos y mejorando la comunicación interna. Además, la plataforma permite generar reportes e indicadores de desempeño que apoyan la toma de decisiones y contribuyen a la optimización de los recursos de la organización.
        </p>

        <h3 style="color: var(--text-color); font-size: 18px; font-weight: 600; margin-bottom: 15px;">Entre sus principales funcionalidades se encuentran:</h3>
        
        <ul style="list-style: none; padding-left: 0; display: flex; flex-direction: column; gap: 12px; color: #4A5568; font-size: 15px;">
            <li style="display: flex; align-items: center;"><span style="color: var(--primary-color); margin-right: 10px; font-weight: bold;">•</span> Registro y seguimiento de actividades por área.</li>
            <li style="display: flex; align-items: center;"><span style="color: var(--primary-color); margin-right: 10px; font-weight: bold;">•</span> Asignación de tareas a responsables específicos.</li>
            <li style="display: flex; align-items: center;"><span style="color: var(--primary-color); margin-right: 10px; font-weight: bold;">•</span> Control de fechas de inicio, avance y finalización.</li>
            <li style="display: flex; align-items: center;"><span style="color: var(--primary-color); margin-right: 10px; font-weight: bold;">•</span> Gestión de solicitudes, compras, encomiendas y proyectos internos.</li>
            <li style="display: flex; align-items: center;"><span style="color: var(--primary-color); margin-right: 10px; font-weight: bold;">•</span> Generación de reportes e historial de actividades.</li>
            <li style="display: flex; align-items: center;"><span style="color: var(--primary-color); margin-right: 10px; font-weight: bold;">•</span> Consulta centralizada de información para todos los departamentos autorizados.</li>
        </ul>
        
        <p style="color: #4A5568; font-size: 15px; line-height: 1.7; text-align: justify; margin-top: 25px;">
            La implementación de este sistema permitirá a CREOTEC mejorar la organización de sus procesos, incrementar la productividad de sus colaboradores y contar con información actualizada para una gestión más eficiente y transparente. Asimismo, contribuirá al fortalecimiento del control interno, garantizando un mejor seguimiento de las actividades estratégicas y operativas que impulsan el crecimiento de la empresa.
        </p>
    </div>

    <div class="areas-title" style="margin-bottom: 25px; display: flex; align-items: center;">
        <span class="text" style="font-size: 24px; font-weight: 600; color: var(--text-color); margin-left: 12px;">Descripción de las Áreas Operativas</span>
    </div>

    <div class="areas-vertical-flow" style="display: flex; flex-direction: column; gap: 30px;">
        
        <div class="area-detail-card" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 280px; background-color: var(--box2-color); padding: 30px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                <img src="imagenes/anaplastologia.png" alt="Anaplastología" style="width: 60px; height: 60px; margin-bottom: 15px; object-fit: contain;">
                <h3 style="color: var(--text-color); font-size: 22px; font-weight: 600;">Anaplastología Clinical</h3>
            </div>
            <div style="flex: 2; min-width: 300px; padding: 35px;">
                <h4 style="color: var(--text-color); margin-bottom: 12px; font-size: 18px; font-weight: 600;">Gestión de Pacientes y Tratamientos</h4>
                <p style="color: #4A5568; font-size: 15px; line-height: 1.6; text-align: justify;">
                    El área de Anaplastología de CREOTEC está especializada en el diseño, desarrollo y fabricación de prótesis externas personalizadas destinadas a la rehabilitación estética y funcional de pacientes que han sufrido pérdidas o deformaciones en diferentes partes del cuerpo. Esta área integra conocimientos de ingeniería, diseño digital, modelado tridimensional, biomateriales y técnicas avanzadas de fabricación para crear soluciones adaptadas a las necesidades específicas de cada usuario. La anaplastología desempeña un papel fundamental en la mejora de la calidad de vida de las personas, contribuyendo a su rehabilitation física, emocional y social. Por ello, esta área mantiene un enfoque centrado en el paciente, promoviendo la innovación tecnológica y la mejora continua de sus procesos para ofrecer soluciones de alta precisión y calidad.
                </p>
            </div>
        </div>

        <div class="area-detail-card" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-wrap: wrap; flex-direction: row-reverse;">
            <div style="flex: 1; min-width: 280px; background-color: var(--box1-color); padding: 30px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                <img src="imagenes/manufactura.png" alt="Manufactura" style="width: 60px; height: 60px; margin-bottom: 15px; object-fit: contain;">
                <h3 style="color: var(--text-color); font-size: 22px; font-weight: 600;">Manufactura 3D</h3>
            </div>
            <div style="flex: 2; min-width: 300px; padding: 35px;">
                <h4 style="color: var(--text-color); margin-bottom: 12px; font-size: 18px; font-weight: 600;">Control Tecnológico e Inventarios</h4>
                <p style="color: #4A5568; font-size: 15px; line-height: 1.6; text-align: justify;">
                    Dentro de esta área se realizan actividades relacionadas con la planificación de la producción, preparación de materiales, fabricación de componentes, ensamblaje, acabados, inspección de calidad y entrega de productos terminados. Para ello, se emplean diferentes tecnologías y herramientas de producción, incluyendo equipos de manufactura digital, impresión 3D, mecanizado, procesos de acabado y técnicas especializadas según los requerimientos de cada proyecto. La gestión de manufactura también contempla el control de inventarios, la optimización de recursos, el mantenimiento de equipos y el cumplimiento de estándares de calidad y seguridad. Gracias a estos procesos, se garantiza que los productos elaborados cumplan con las especificaciones técnicas, los plazos establecidos y las expectativas de los clientes.
                </p>
            </div>
        </div>

        <div class="area-detail-card" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 280px; background-color: var(--box3-color); padding: 30px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                <img src="imagenes/comercial.png" alt="Comercial" style="width: 60px; height: 60px; margin-bottom: 15px; object-fit: contain;">
                <h3 style="color: var(--text-color); font-size: 22px; font-weight: 600;">Área Comercial</h3>
            </div>
            <div style="flex: 2; min-width: 300px; padding: 35px;">
                <h4 style="color: var(--text-color); margin-bottom: 12px; font-size: 18px; font-weight: 600;">Ventas, Cotizaciones y Métricas Operativas</h4>
                <p style="color: #4A5568; font-size: 15px; line-height: 1.6; text-align: justify;">
                    El área Comercial de CREOTEC tiene la responsabilidad de gestionar las relaciones con los clientes, promover los productos y servicios de la empresa, identificar oportunidades de negocio y generar estrategias que contribuyan al crecimiento sostenible de la organización. Esta área actúa como el principal vínculo entre la empresa y el mercado, permitiendo comprender las necesidades de los clientes y traducirlas en soluciones de valor. Entre sus funciones principales se encuentran la atención y asesoramiento a clientes, elaboración de cotizaciones, gestión de ventas, seguimiento de oportunidades comerciales, negociación de contratos y coordinación de entregas. Asimismo, desarrolla actividades de investigación de mercado, análisis de la competencia, promoción institucional y fortalecimiento de la imagen corporativa de la empresa.
                </p>
            </div>
        </div>

    </div>
</div>