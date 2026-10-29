<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comparativa de Similitud | Creotec</title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #F4FBFC; color: #03045E; margin: 20px; }
        .cabecera { max-width: 1200px; margin: auto; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #00B4D8; padding-bottom: 10px; margin-bottom: 25px; }
        .btn-volver { background-color: #03045E; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; text-decoration: none; font-weight: bold; }
        
        #contenedor-comparativa { max-width: 1200px; margin: auto; }
        
        /* Ficha Base */
        .ficha-molde { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 35px; border-left: 8px solid #00B4D8; }
        
        /* Variaciones de color para identificar las tablas de un vistazo */
        .tabla-busqueda { border-left: 8px solid #03045E; background: #E6F0FA; } /* Color oscuro para lo solicitado */
        .tabla-resultado { border-left: 8px solid #00B4D8; }
        
        .seccion-titulo { background-color: #03045E; color: white; padding: 8px 15px; border-radius: 5px; margin-top: 18px; margin-bottom: 12px; font-size: 15px; font-weight: bold; }
        .tabla-busqueda .seccion-titulo { background-color: #0056b3; }
        
        /* Grids de alineación */
        .grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; }
        .grid-6 { display: grid; grid-template-columns: repeat(6, 1fr); gap: 12px; }
        
        .dato-caja { background: #DDF4F9; padding: 10px; border-radius: 6px; border: 1px solid #B0E0E6;}
        .tabla-busqueda .dato-caja { background: #FFFFFF; border: 1px solid #A2C8EE; } /* Fondo blanco para diferenciar la búsqueda */
        
        .dato-label { font-size: 11px; color: #0077B6; font-weight: bold; display: block; margin-bottom: 4px; text-transform: uppercase;}
        .dato-valor { font-size: 14px; color: #03045E; font-weight: bold;}
        
        /* Espacios estáticos en rojo para diferencias */
        .dif-rojo { color: red; font-size: 11px; font-weight: bold; margin-left: 4px; }
        
        /* Listado interno de dedos */
        .sub-medida { font-size: 12px; margin-top: 4px; color: #03045E; border-bottom: 1px dashed #B0E0E6; padding-bottom: 2px; display: flex; justify-content: space-between; }
        .sub-medida:last-child { border-bottom: none; }
        .tabla-busqueda .sub-medida { border-bottom: 1px dashed #A2C8EE; }
    </style>
</head>
<body>

<div class="cabecera">
    <h2>Panel Comparativo de Similitud Anatómica</h2>
    <button onclick="volverAtras()" class="btn-volver">← Volver al Formulario</button>
</div>

<div id="contenedor-comparativa">
    <div style="margin-bottom: 15px; text-align: right;">
        <button id="btn-mi-boton" class="btn-volver" style="background:#8AC926; padding: 10px 35px;">
            RESUMEN DE BUSQUEDA
        </button>
    </div>


    <div id="contenedor-t1" class="ficha-molde tabla-busqueda">
        <div style="margin-bottom:10px; border-bottom: 2px solid #03045E; padding-bottom:8px;">
            <h3 style="color:#03045E; margin:0;">📋 Criterios de tu Búsqueda Actual</h3>
        </div>

        <div class="seccion-titulo">1. Datos Generales Solicitados</div>
        <div class="grid-5">
            <div class="dato-caja"><span class="dato-label">Paciente</span><span id="t1-nombre_paciente" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Edad</span><span id="t1-edad" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Celular</span><span id="t1-celular" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Residencia</span><span id="t1-residencia" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Fecha</span><span id="t1-fecha" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">2. Contextura Física Requerida</div>
        <div class="grid-6">
            <div class="dato-caja"><span class="dato-label">Tipo Prótesis</span><span id="t1-tipo_protesis" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Tipo Registro</span><span id="t1-tipo_registro" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Lado</span><span id="t1-lado" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Longitud</span><span id="t1-longitud" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Grosor</span><span id="t1-grosor" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Textura</span><span id="t1-textura" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">3. Medidas del Paciente Actual</div>

        <p style="margin: 5px 0 10px 0; font-size:12px; font-weight:bold; color:#0056b3;">
            Dimensiones de la Palma Base (mm):
        </p>

        <div class="grid-5" style="margin-bottom:12px;">
            <div class="dato-caja"><span class="dato-label">Palma Largo</span><span id="t1-palma_largo" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Palma Ancho</span><span id="t1-palma_ancho" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro</span><span id="t1-palma_perimetro" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Largo (A-B)</span><span id="t1-palma_largo_ab" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro (A-B)</span><span id="t1-palma_perimetro_ab" class="dato-valor">---</span></div>
        </div>

        <p style="margin: 5px 0 10px 0; font-size:12px; font-weight:bold; color:#0056b3;">
            Dimensiones de los Dedos (mm):
        </p>

        <div class="grid-5">

        <div class="dato-caja" style="border-top:3px solid #0056b3;">
            <span class="dato-label">PULGAR</span>
            <div class="sub-medida">Largo: <b id="t1-pulgar_largo">---</b></div>
            <div class="sub-medida">Perím: <b id="t1-pulgar_perimetro">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t1-pulgar_alto">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t1-pulgar_ancho">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t1-pulgar_tipo">---</b></div>
        </div>

        <div class="dato-caja" style="border-top:3px solid #0056b3;">
            <span class="dato-label">ÍNDICE</span>
            <div class="sub-medida">Largo: <b id="t1-indice_largo">---</b></div>
            <div class="sub-medida">Perím: <b id="t1-indice_perimetro">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t1-indice_alto">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t1-indice_ancho">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t1-indice_tipo">---</b></div>
        </div>

        <div class="dato-caja" style="border-top:3px solid #0056b3;">
            <span class="dato-label">MEDIO</span>
            <div class="sub-medida">Largo: <b id="t1-medio_largo">---</b></div>
            <div class="sub-medida">Perím: <b id="t1-medio_perimetro">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t1-medio_alto">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t1-medio_ancho">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t1-medio_tipo">---</b></div>
        </div>

        <div class="dato-caja" style="border-top:3px solid #0056b3;">
            <span class="dato-label">ANULAR</span>
            <div class="sub-medida">Largo: <b id="t1-anular_largo">---</b></div>
            <div class="sub-medida">Perím: <b id="t1-anular_perimetro">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t1-anular_alto">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t1-anular_ancho">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t1-anular_tipo">---</b></div>
        </div>

        <div class="dato-caja" style="border-top:3px solid #0056b3;">
            <span class="dato-label">MEÑIQUE</span>
            <div class="sub-medida">Largo: <b id="t1-menique_largo">---</b></div>
            <div class="sub-medida">Perím: <b id="t1-menique_perimetro">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t1-menique_alto">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t1-menique_ancho">---</b></div>
            <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t1-menique_tipo">---</b></div>
        </div>

        </div>
    </div>



    

    <div class="ficha-molde tabla-resultado">
        <div style="margin-bottom:10px; border-bottom: 1px solid #DDF4F9; padding-bottom:8px;">
            <h3 style="color:#03045E; margin:0;">🔍 Opción Coincidente #1 <span style="color:#8AC926;">(Máxima Similitud)</span></h3>
        </div>

        <div class="seccion-titulo">1. Datos Generales del Registro</div>
        <div class="grid-5">
            <div class="dato-caja"><span class="dato-label">Código</span><span class="t2-codigo">---</span></div>
            <div class="dato-caja"><span class="dato-label">Paciente</span><span id="t2-nombre_paciente" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Edad</span><span id="t2-edad" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Celular</span><span id="t2-celular" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Residencia</span><span id="t2-residencia" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">2. Contextura y Anatomía</div>
        <div class="grid-6">
            <div class="dato-caja"><span class="dato-label">Tipo Prótesis</span><span id="t2-tipo_protesis" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Tipo Registro</span><span id="t2-tipo_registro" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Lado</span><span id="t2-lado" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Longitud</span><span id="t2-longitud" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Grosor</span><span id="t2-grosor" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Textura</span><span id="t2-textura" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">3. Medidas Estructurales y Desviaciones</div>
        <p style="margin: 5px 0 10px 0; font-size:12px; font-weight:bold; color:#0077B6;">Dimensiones de la Palma (mm):</p>
        <div class="grid-5" style="margin-bottom:12px;">
            <div class="dato-caja"><span class="dato-label">Palma Largo</span><span id="t2-palma_largo" class="dato-valor">---</span><span id="t2-dif-palma_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Palma Ancho</span><span id="t2-palma_ancho" class="dato-valor">---</span><span id="t2-dif-palma_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro</span><span id="t2-palma_perimetro" class="dato-valor">---</span><span id="t2-dif-palma_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Largo (A-B)</span><span id="t2-palma_largo_ab" class="dato-valor">---</span><span id="t2-dif-palma_largo_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro (A-B)</span><span id="t2-palma_perimetro_ab" class="dato-valor">---</span><span id="t2-dif-palma_perimetro_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
        </div>

        <p style="margin: 5px 0 10px 0; font-size:13px; font-weight:bold; color:#0077B6;">Dimensiones de los Dedos y Uñas (mm):</p>
        <div class="grid-5">
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">PULGAR</span>
                <div class="sub-medida">Largo: <b id="t2-pulgar_largo">---</b><span id="t2-dif-pulgar_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t2-pulgar_perimetro">---</b><span id="t2-dif-pulgar_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t2-pulgar_alto">---</b><span id="t2-dif-pulgar_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t2-pulgar_ancho">---</b><span id="t2-dif-pulgar_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t2-pulgar_tipo">---</b><span id="t2-dif-pulgar_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">ÍNDICE</span>
                <div class="sub-medida">Largo: <b id="t2-indice_largo">---</b><span id="t2-dif-indice_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t2-indice_perimetro">---</b><span id="t2-dif-indice_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t2-indice_alto">---</b><span id="t2-dif-indice_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t2-indice_ancho">---</b><span id="t2-dif-indice_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>                
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t2-indice_tipo">---</b><span id="t2-dif-indice_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">MEDIO</span>
                <div class="sub-medida">Largo: <b id="t2-medio_largo">---</b><span id="t2-dif-medio_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t2-medio_perimetro">---</b><span id="t2-dif-medio_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t2-medio_alto">---</b><span id="t2-dif-medio_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t2-medio_ancho">---</b><span id="t2-dif-medio_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t2-medio_tipo">---</b><span id="t2-dif-medio_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">ANULAR</span>
                <div class="sub-medida">Largo: <b id="t2-anular_largo">---</b><span id="t2-dif-anular_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t2-anular_perimetro">---</b><span id="t2-dif-anular_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t2-anular_alto">---</b><span id="t2-dif-anular_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t2-anular_ancho">---</b><span id="t2-dif-anular_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t2-anular_tipo">---</b><span id="t2-dif-anular_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">MEÑIQUE</span>
                <div class="sub-medida">Largo: <b id="t2-menique_largo">---</b><span id="t2-dif-menique_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t2-menique_perimetro">---</b><span id="t2-dif-menique_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t2-menique_alto">---</b><span id="t2-dif-menique_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t2-menique_ancho">---</b><span id="t2-dif-menique_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t2-menique_tipo">---</b><span id="t2-dif-menique_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
        </div>
    </div>


    <div class="ficha-molde tabla-resultado">
        <div style="margin-bottom:10px; border-bottom: 1px solid #DDF4F9; padding-bottom:8px;">
            <h3 style="color:#03045E; margin:0;">🔍 Opción Coincidente #2</h3>
        </div>

        <div class="seccion-titulo">1. Datos Generales del Registro</div>
        <div class="grid-5">
            <div class="dato-caja"><span class="dato-label">Código</span><span class="t3-codigo">---</span></div>
            <div class="dato-caja"><span class="dato-label">Paciente</span><span id="t3-nombre_paciente" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Edad</span><span id="t3-edad" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Celular</span><span id="t3-celular" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Residencia</span><span id="t3-residencia" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">2. Contextura y Anatomía</div>
        <div class="grid-6">
            <div class="dato-caja"><span class="dato-label">Tipo Prótesis</span><span id="t3-tipo_protesis" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Tipo Registro</span><span id="t3-tipo_registro" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Lado</span><span id="t3-lado" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Longitud</span><span id="t3-longitud" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Grosor</span><span id="t3-grosor" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Textura</span><span id="t3-textura" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">3. Medidas Estructurales y Desviaciones</div>
        <p style="margin: 5px 0 10px 0; font-size:12px; font-weight:bold; color:#0077B6;">Dimensiones de la Palma (mm):</p>
        <div class="grid-5" style="margin-bottom:12px;">
            <div class="dato-caja"><span class="dato-label">Palma Largo</span><span id="t3-palma_largo" class="dato-valor">---</span><span id="t3-dif-palma_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Palma Ancho</span><span id="t3-palma_ancho" class="dato-valor">---</span><span id="t3-dif-palma_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro</span><span id="t3-palma_perimetro" class="dato-valor">---</span><span id="t3-dif-palma_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Largo (A-B)</span><span id="t3-palma_largo_ab" class="dato-valor">---</span><span id="t3-dif-palma_largo_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro (A-B)</span><span id="t3-palma_perimetro_ab" class="dato-valor">---</span><span id="t3-dif-palma_perimetro_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
        </div>

        <p style="margin: 5px 0 10px 0; font-size:13px; font-weight:bold; color:#0077B6;">Dimensiones de los Dedos y Uñas (mm):</p>
        <div class="grid-5">
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">PULGAR</span>
                <div class="sub-medida">Largo: <b id="t3-pulgar_largo">---</b><span id="t3-dif-pulgar_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t3-pulgar_perimetro">---</b><span id="t3-dif-pulgar_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t3-pulgar_alto">---</b><span id="t3-dif-pulgar_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t3-pulgar_ancho">---</b><span id="t3-dif-pulgar_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t3-pulgar_tipo">---</b><span id="t3-dif-pulgar_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;" class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">ÍNDICE</span>
                <div class="sub-medida">Largo: <b id="t3-indice_largo">---</b><span id="t3-dif-indice_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t3-indice_perimetro">---</b><span id="t3-dif-indice_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t3-indice_alto">---</b><span id="t3-dif-indice_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t3-indice_ancho">---</b><span id="t3-dif-indice_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>                
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t3-indice_tipo">---</b><span id="t3-dif-indice_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">MEDIO</span>
                <div class="sub-medida">Largo: <b id="t3-medio_largo">---</b><span id="t3-dif-medio_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t3-medio_perimetro">---</b><span id="t3-dif-medio_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t3-medio_alto">---</b><span id="t3-dif-medio_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t3-medio_ancho">---</b><span id="t3-dif-medio_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t3-medio_tipo">---</b><span id="t3-dif-medio_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">ANULAR</span>
                <div class="sub-medida">Largo: <b id="t3-anular_largo">---</b><span id="t3-dif-anular_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t3-anular_perimetro">---</b><span id="t3-dif-anular_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t3-anular_alto">---</b><span id="t3-dif-anular_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t3-anular_ancho">---</b><span id="t3-dif-anular_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t3-anular_tipo">---</b><span id="t3-dif-anular_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">MEÑIQUE</span>
                <div class="sub-medida">Largo: <b id="t3-menique_largo">---</b><span id="t3-dif-menique_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t3-menique_perimetro">---</b><span id="t3-dif-menique_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t3-menique_alto">---</b><span id="t3-dif-menique_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t3-menique_ancho">---</b><span id="t3-dif-menique_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t3-menique_tipo">---</b><span id="t3-dif-menique_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
        </div>
    </div>


    <div class="ficha-molde tabla-resultado">
        <div style="margin-bottom:10px; border-bottom: 1px solid #DDF4F9; padding-bottom:8px;">
            <h3 style="color:#03045E; margin:0;">🔍 Opción Coincidente #3</h3>
        </div>

        <div class="seccion-titulo">1. Datos Generales del Registro</div>
        <div class="grid-5">
            <div class="dato-caja"><span class="dato-label">Código</span><span class="t4-codigo">---</span></div>
            <div class="dato-caja"><span class="dato-label">Paciente</span><span id="t4-nombre_paciente" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Edad</span><span id="t4-edad" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Celular</span><span id="t4-celular" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Residencia</span><span id="t4-residencia" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">2. Contextura y Anatomía</div>
        <div class="grid-6">
            <div class="dato-caja"><span class="dato-label">Tipo Prótesis</span><span id="t4-tipo_protesis" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Tipo Registro</span><span id="t4-tipo_registro" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Lado</span><span id="t4-lado" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Longitud</span><span id="t4-longitud" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Grosor</span><span id="t4-grosor" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Textura</span><span id="t4-textura" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">3. Medidas Estructurales y Desviaciones</div>
        <p style="margin: 5px 0 10px 0; font-size:12px; font-weight:bold; color:#0077B6;">Dimensiones de la Palma (mm):</p>
        <div class="grid-5" style="margin-bottom:12px;">
            <div class="dato-caja"><span class="dato-label">Palma Largo</span><span id="t4-palma_largo" class="dato-valor">---</span><span id="t4-dif-palma_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Palma Ancho</span><span id="t4-palma_ancho" class="dato-valor">---</span><span id="t4-dif-palma_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro</span><span id="t4-palma_perimetro" class="dato-valor">---</span><span id="t4-dif-palma_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Largo (A-B)</span><span id="t4-palma_largo_ab" class="dato-valor">---</span><span id="t4-dif-palma_largo_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro (A-B)</span><span id="t4-palma_perimetro_ab" class="dato-valor">---</span><span id="t4-dif-palma_perimetro_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
        </div>

        <p style="margin: 5px 0 10px 0; font-size:13px; font-weight:bold; color:#0077B6;">Dimensiones de los Dedos y Uñas (mm):</p>
        <div class="grid-5">
            <div class="dato-caja" style="border-top: 3px solid #03045E;" class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">PULGAR</span>
                <div class="sub-medida">Largo: <b id="t4-pulgar_largo">---</b><span id="t4-dif-pulgar_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-pulgar_perimetro">---</b><span id="t4-dif-pulgar_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t4-pulgar_alto">---</b><span id="t4-dif-pulgar_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t4-pulgar_ancho">---</b><span id="t4-dif-pulgar_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t4-pulgar_tipo">---</b><span id="t4-dif-pulgar_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">ÍNDICE</span>
                <div class="sub-medida">Largo: <b id="t4-indice_largo">---</b><span id="t4-dif-indice_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-indice_perimetro">---</b><span id="t4-dif-indice_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t4-indice_alto">---</b><span id="t4-dif-indice_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t4-indice_ancho">---</b><span id="t4-dif-indice_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>                
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t4-indice_tipo">---</b><span id="t4-dif-indice_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">MEDIO</span>
                <div class="sub-medida">Largo: <b id="t4-medio_largo">---</b><span id="t4-dif-medio_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-medio_perimetro">---</b><span id="t4-dif-medio_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t4-medio_alto">---</b><span id="t4-dif-medio_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t4-medio_ancho">---</b><span id="t4-dif-medio_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t4-medio_tipo">---</b><span id="t4-dif-medio_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"><span class="dato-label" style="color:#03045E; font-size:12px;">ANULAR</span>
                <span class="dato-label">ANULAR</span>
                <div class="sub-medida">Largo: <b id="t4-anular_largo">---</b><span id="t4-dif-anular_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-anular_perimetro">---</b><span id="t4-dif-anular_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t4-anular_alto">---</b><span id="t4-dif-anular_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t4-anular_ancho">---</b><span id="t4-dif-anular_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t4-anular_tipo">---</b><span id="t4-dif-anular_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">MEÑIQUE</span>
                <div class="sub-medida">Largo: <b id="t4-menique_largo">---</b><span id="t4-dif-menique_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-menique_perimetro">---</b><span id="t4-dif-menique_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t4-menique_alto">---</b><span id="t4-dif-menique_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t4-menique_ancho">---</b><span id="t4-dif-menique_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t4-menique_tipo">---</b><span id="t4-dif-menique_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
        </div>
    </div>



    <div class="ficha-molde tabla-resultado">
        <div style="margin-bottom:10px; border-bottom: 1px solid #DDF4F9; padding-bottom:8px;">
            <h3 style="color:#03045E; margin:0;">🔍 Opción Coincidente #4</h3>
        </div>

        <div class="seccion-titulo">1. Datos Generales del Registro</div>
        <div class="grid-5">
            <div class="dato-caja"><span class="dato-label">Código</span><span class="t5-codigo">---</span></div>
            <div class="dato-caja"><span class="dato-label">Paciente</span><span id="t5-nombre_paciente" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Edad</span><span id="t5-edad" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Celular</span><span id="t5-celular" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Residencia</span><span id="t5-residencia" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">2. Contextura y Anatomía</div>
        <div class="grid-6">
            <div class="dato-caja"><span class="dato-label">Tipo Prótesis</span><span id="t5-tipo_protesis" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Tipo Registro</span><span id="t5-tipo_registro" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Lado</span><span id="t5-lado" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Longitud</span><span id="t5-longitud" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Grosor</span><span id="t5-grosor" class="dato-valor">---</span></div>
            <div class="dato-caja"><span class="dato-label">Textura</span><span id="t5-textura" class="dato-valor">---</span></div>
        </div>

        <div class="seccion-titulo">3. Medidas Estructurales y Desviaciones</div>
        <p style="margin: 5px 0 10px 0; font-size:12px; font-weight:bold; color:#0077B6;">Dimensiones de la Palma (mm):</p>
        <div class="grid-5" style="margin-bottom:12px;">
            <div class="dato-caja"><span class="dato-label">Palma Largo</span><span id="t5-palma_largo" class="dato-valor">---</span><span id="t4-dif-palma_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Palma Ancho</span><span id="t5-palma_ancho" class="dato-valor">---</span><span id="t4-dif-palma_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro</span><span id="t5-palma_perimetro" class="dato-valor">---</span><span id="t4-dif-palma_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Largo (A-B)</span><span id="t5-palma_largo_ab" class="dato-valor">---</span><span id="t4-dif-palma_largo_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            <div class="dato-caja"><span class="dato-label">Perímetro (A-B)</span><span id="t5-palma_perimetro_ab" class="dato-valor">---</span><span id="t4-dif-palma_perimetro_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
        </div>

        <p style="margin: 5px 0 10px 0; font-size:13px; font-weight:bold; color:#0077B6;">Dimensiones de los Dedos y Uñas (mm):</p>
        <div class="grid-5">
            <div class="dato-caja" style="border-top: 3px solid #03045E;" class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">PULGAR</span>
                <div class="sub-medida">Largo: <b id="t4-pulgar_largo">---</b><span id="t5-dif-pulgar_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-pulgar_perimetro">---</b><span id="t5-dif-pulgar_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t5-pulgar_alto">---</b><span id="t5-dif-pulgar_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t5-pulgar_ancho">---</b><span id="t5-dif-pulgar_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t5-pulgar_tipo">---</b><span id="t5-dif-pulgar_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">ÍNDICE</span>
                <div class="sub-medida">Largo: <b id="t4-indice_largo">---</b><span id="t5-dif-indice_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-indice_perimetro">---</b><span id="t5-dif-indice_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t5-indice_alto">---</b><span id="t5-dif-indice_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t5-indice_ancho">---</b><span id="t5-dif-indice_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>                
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t5-indice_tipo">---</b><span id="t5-dif-indice_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">MEDIO</span>
                <div class="sub-medida">Largo: <b id="t4-medio_largo">---</b><span id="t4-dif-medio_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-medio_perimetro">---</b><span id="t4-dif-medio_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t5-medio_alto">---</b><span id="t5-dif-medio_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t5-medio_ancho">---</b><span id="t5-dif-medio_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t5-medio_tipo">---</b><span id="t5-dif-medio_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"><span class="dato-label" style="color:#03045E; font-size:12px;">ANULAR</span>
                <span class="dato-label">ANULAR</span>
                <div class="sub-medida">Largo: <b id="t4-anular_largo">---</b><span id="t5-dif-anular_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-anular_perimetro">---</b><span id="t5-dif-anular_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t5-anular_alto">---</b><span id="t5-dif-anular_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t5-anular_ancho">---</b><span id="t5-dif-anular_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t5-anular_tipo">---</b><span id="t5-dif-anular_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
            <div class="dato-caja" style="border-top: 3px solid #03045E;"class="dato-label" style="color:#03045E; font-size:12px;">
                <span class="dato-label">MEÑIQUE</span>
                <div class="sub-medida">Largo: <b id="t4-menique_largo">---</b><span id="t5-dif-menique_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida">Perím: <b id="t4-menique_perimetro">---</b><span id="t5-dif-menique_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Alto: <b id="t5-menique_alto">---</b><span id="t5-dif-menique_alto" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Ancho: <b id="t5-menique_ancho">---</b><span id="t5-dif-menique_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                <div class="sub-medida" style="color:#0077B6;">Uña Tipo: <b id="t5-menique_tipo">---</b><span id="t5-dif-menique_tipo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
            </div>
        </div>
    </div>

</div>
    
    <div id="ventana-flotante" class="modal-fondo">
        <div class="modal-cuerpo">
    
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 30px;">
        
        <div style="flex: 2;">
            <h3 style="color:#ffffff; border-bottom: 3px solid #ffffff; padding-bottom: 10px; margin-top:0;">
                Comparativa Exclusiva de Medidas
            </h3>
            <div class="ficha-molde tabla-resultado" style="padding: 15px; margin-bottom: 20px;">
                <h4 style="margin:0 0 15px 0; color:#03045E; font-size:16px;">
                    Código: <span style="color:#8AC926;"></span><span class="f2-codigo">---</span>
                </h4>             
                <p style="margin: 0 0 5px 0; font-size:12px; font-weight:bold; color:#0077B6;">Palma (mm):</p>
                <div class="grid-5" style="margin-bottom:10px;">
                    <div class="dato-caja"><span class="dato-label">Palma Largo</span><span id="f2-palma_largo" class="dato-valor">---</span><span id="f2-dif-palma_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    <div class="dato-caja"><span class="dato-label">Palma Ancho</span><span id="f2-palma_ancho" class="dato-valor">---</span><span id="f2-dif-palma_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    <div class="dato-caja"><span class="dato-label">Perímetro</span><span id="f2-palma_perimetro" class="dato-valor">---</span><span id="f2-dif-palma_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    <div class="dato-caja"><span class="dato-label">Largo (A-B)</span><span id="f2-palma_largo_ab" class="dato-valor">---</span><span id="f2-dif-palma_largo_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    <div class="dato-caja"><span class="dato-label">Perímetro (A-B)</span><span id="f2-palma_perimetro_ab" class="dato-valor">---</span><span id="f2-dif-palma_perimetro_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                </div>

                <p style="margin: 0 0 5px 0; font-size:12px; font-weight:bold; color:#0077B6;">Dedos (mm):</p>
                <div class="grid-5">
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">PULGAR</span>
                        <div class="sub-medida">Largo: <b id="f2-pulgar_largo">---</b><span id="f2-dif-pulgar_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                        <div class="sub-medida">Perím: <b id="f2-pulgar_perimetro">---</b><span id="f2-dif-pulgar_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">ÍNDICE</span>
                        <div class="sub-medida">Largo: <b id="f2-indice_largo">---</b><span id="f2-dif-indice_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                        <div class="sub-medida">Perím: <b id="f2-indice_perimetro">---</b><span id="f2-dif-indice_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">MEDIO</span>
                         <div class="sub-medida">Largo: <b id="f2-medio_largo">---</b><span id="f2-dif-medio_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                         <div class="sub-medida">Perím: <b id="f2-medio_perimetro">---</b><span id="f2-dif-medio_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">ANULAR</span>
                         <div class="sub-medida">Largo: <b id="f2-anular_largo">---</b><span id="f2-dif-anular_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                         <div class="sub-medida">Perím: <b id="f2-anular_perimetro">---</b><span id="f2-dif-anular_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">MEÑIQUE</span>
                         <div class="sub-medida">Largo: <b id="f2-menique_largo">---</b><span id="f2-dif-menique_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                       <div class="sub-medida">Perím: <b id="f2-menique_perimetro">---</b><span id="f2-dif-menique_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                </div>
            </div>

            <div class="ficha-molde tabla-resultado" style="padding: 15px; margin-bottom: 20px;">
               <h4 style="margin:0 0 15px 0; color:#03045E; font-size:16px;">
                    Código: <span style="color:#8AC926;"><span class="f3-codigo">---</span>
                </h4>
                
                <p style="margin: 0 0 5px 0; font-size:12px; font-weight:bold; color:#0077B6;">Palma (mm):</p>
                <div class="grid-5" style="margin-bottom:10px;">
                    <div class="dato-caja"><span class="dato-label">Palma Largo</span><span id="f3-palma_largo" class="dato-valor">---</span><span id="tf-dif-palma_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    <div class="dato-caja"><span class="dato-label">Palma Ancho</span><span id="f3-palma_ancho" class="dato-valor">---</span><span id="tf-dif-palma_ancho" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    <div class="dato-caja"><span class="dato-label">Perímetro</span><span id="f3-palma_perimetro" class="dato-valor">---</span><span id="tf-dif-palma_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    <div class="dato-caja"><span class="dato-label">Largo (A-B)</span><span id="f3-palma_largo_ab" class="dato-valor">---</span><span id="tf-dif-palma_largo_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    <div class="dato-caja"><span class="dato-label">Perímetro (A-B)</span><span id="f3-palma_perimetro_ab" class="dato-valor">---</span><span id="tf-dif-palma_perimetro_ab" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                </div>

                <p style="margin: 0 0 5px 0; font-size:12px; font-weight:bold; color:#0077B6;">Dedos y Uñas (mm):</p>
                <div class="grid-5">
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">PULGAR</span>
                       <div class="sub-medida">Largo: <b id="f3-pulgar_largo">---</b><span id="f3-dif-pulgar_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                       <div class="sub-medida">Perím: <b id="f3-pulgar_perimetro">---</b><span id="f3-dif-pulgar_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">ÍNDICE</span>
                          <div class="sub-medida">Largo: <b id="f3-indice_largo">---</b><span id="f3-dif-indice_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                          <div class="sub-medida">Perím: <b id="f3-indice_perimetro">---</b><span id="f3-dif-indice_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">MEDIO</span>
                         <div class="sub-medida">Largo: <b id="f3-medio_largo">---</b><span id="f3-dif-medio_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                        <div class="sub-medida">Perím: <b id="f3-medio_perimetro">---</b><span id="f3-dif-medio_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">ANULAR</span>
                       <div class="sub-medida">Largo: <b id="f3-anular_largo">---</b><span id="f3-dif-anular_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                        <div class="sub-medida">Perím: <b id="f3-anular_perimetro">---</b><span id="f3-dif-anular_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                    <div class="dato-caja" style="border-top: 3px solid #03045E; padding:8px;"><span class="dato-label" style="font-size:10px;">
                        <span class="dato-label">MEÑIQUE</span>
                         <div class="sub-medida">Largo: <b id="f3-menique_largo">---</b><span id="f3-dif-menique_largo" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                        <div class="sub-medida">Perím: <b id="f3-menique_perimetro">---</b><span id="f3-dif-menique_perimetro" class="dif-rojo" style="margin-left: 5px; font-weight: bold;"></span></div>
                    </div>
                </div>
            </div>            

        </div>

        <div style="flex: 1;">
            <div style="background: white; padding: 20px; border-radius: 12px; border-top: 8px solid #03045E; box-shadow: 0 4px 15px rgba(0,0,0,0.1); position: sticky; top: 0;">
                <h3 style="color:#03045E; margin-top:0; margin-bottom: 5px;">Tabla de Análisis</h3>
                
                <table class="tabla-analisis">
                    <thead>
                        <tr>
                            <th></th>
                            <th>PALMA</th>
                            <th>DEDOS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                        <tr>
                            <td>Opcion 1.</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                        <tr>
                            <td>Opcion 2.</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                        <tr>
                            <td>Opcion 3.</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    </tbody>
                </table>
                    <button 
                    class="btn-cerrar-flotante" style="width: 100%; margin-top: 25px; background: #FF595E; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 14px;">
                        ❌ Cerrar Análisis de Medidas
                    </button>
            </div>
        </div>

    </div>
</div>
    </div>
  <script>
     // Agregar que el nuevo botón de la columna derecha también cierre el modal
    document.querySelector('.btn-cerrar-flotante').addEventListener('click', function() {
    document.getElementById('ventana-flotante').style.display = 'none';
    document.body.style.overflow = 'auto'; // Devuelve el scroll a la pantalla de fondo
    });

    // Función infalible para volver al formulario sin importar las carpetas
    function volverAtras() {
    // Esto le dice al navegador que retroceda exactamente a la página de donde viniste
    window.history.back();
    }

    // LÓGICA DE LA VENTANA FLOTANTE
    const botonAbrir = document.getElementById('btn-mi-boton'); // Tu botón verde de arriba
    const modal = document.getElementById('ventana-flotante');
    const botonCerrar = document.querySelector('.cerrar-modal');
    
    // 1. Al hacer clic en el botón, ABRE el modal
    botonAbrir.addEventListener('click', function() {
        modal.style.display = 'block';
        // Bloqueamos el scroll de la página de fondo para que no se mueva sola
        document.body.style.overflow = 'hidden'; 
    });  


        
        document.addEventListener("DOMContentLoaded", () => {

        // Todos los datos del formulario
        const datosBusqueda = {
            nombre_paciente: localStorage.getItem("f_nombre_paciente"),
            edad: localStorage.getItem("f_edad"),
            celular: localStorage.getItem("f_celular"),
            residencia: localStorage.getItem("f_residencia"),
            fecha: localStorage.getItem("f_fecha"),

            tipo_protesis: localStorage.getItem("f_tipo_protesis"),
            tipo_registro: localStorage.getItem("f_tipo_registro"),
            lado: localStorage.getItem("f_lado"),
            longitud: localStorage.getItem("f_longitud"),
            grosor: localStorage.getItem("f_grosor"),
            textura: localStorage.getItem("f_textura"),

            palma_largo: localStorage.getItem("f_palma_largo"),
            palma_ancho: localStorage.getItem("f_palma_ancho"),
            palma_perimetro: localStorage.getItem("f_palma_perimetro"),
            palma_largo_ab: localStorage.getItem("f_palma_largo_ab"),
            palma_perimetro_ab: localStorage.getItem("f_palma_perimetro_ab"),

            pulgar_largo: localStorage.getItem("f_pulgar_largo"),
            pulgar_perimetro: localStorage.getItem("f_pulgar_perimetro"),
            pulgar_alto: localStorage.getItem("f_pulgar_alto"),
            pulgar_ancho: localStorage.getItem("f_pulgar_ancho"),
            pulgar_tipo: localStorage.getItem("f_pulgar_tipo"),

            indice_largo: localStorage.getItem("f_indice_largo"),
            indice_perimetro: localStorage.getItem("f_indice_perimetro"),
            indice_alto: localStorage.getItem("f_indice_alto"),
            indice_ancho: localStorage.getItem("f_indice_ancho"),
            indice_tipo: localStorage.getItem("f_indice_tipo"),

            medio_largo: localStorage.getItem("f_medio_largo"),
            medio_perimetro: localStorage.getItem("f_medio_perimetro"),
            medio_alto: localStorage.getItem("f_medio_alto"),
            medio_ancho: localStorage.getItem("f_medio_ancho"),
            medio_tipo: localStorage.getItem("f_medio_tipo"),

            anular_largo: localStorage.getItem("f_anular_largo"),
            anular_perimetro: localStorage.getItem("f_anular_perimetro"),
            anular_alto: localStorage.getItem("f_anular_alto"),
            anular_ancho: localStorage.getItem("f_anular_ancho"),
            anular_tipo: localStorage.getItem("f_anular_tipo"),

            menique_largo: localStorage.getItem("f_menique_largo"),
            menique_perimetro: localStorage.getItem("f_menique_perimetro"),
            menique_alto: localStorage.getItem("f_menique_alto"),
            menique_ancho: localStorage.getItem("f_menique_ancho"),
            menique_tipo: localStorage.getItem("f_menique_tipo")
        };

            llenarTabla("t1", datosBusqueda);

            fetch("../ajax/buscar-similitud.php",{
                method:"POST",
                headers:{
                    "Content-Type":"application/json"
                },
                body:JSON.stringify(datosBusqueda)
            })
            .then(r=>r.json())
            .then(data=>{
                if(data.status!=="success") return;
            
                // 1° Opción
                if(data.moldes?.length>0)
                    llenarTabla("t2", data.moldes[0], datosBusqueda);
                
                // 2° Opción
                if(data.moldes?.length>1)
                    llenarTabla("t3", data.moldes[1], datosBusqueda);
            
                // 👇 AQUÍ AUMENTAS EL T5 (3° Opción) 👇
                if(data.moldes?.length>2)
                    llenarTabla("t5", data.moldes[2], datosBusqueda);
                
                // Donante
                if(data.humano?.length>0)
                    llenarTabla("t4", data.humano[0], datosBusqueda);
            })
            .catch(console.error);

        });

        // Función modificada para calcular diferencias
        function llenarTabla(prefijo, datos, busqueda = null){

            if(!datos) return;

            Object.keys(datos).forEach(campo=>{

                // 1. Llenar el dato principal
                const elemento=document.getElementById(`${prefijo}-${campo}`);
                if(elemento) {
                    elemento.textContent=(datos[campo]!==null && datos[campo]!=="")
                        ? datos[campo]
                        : "---";
                }

                // 2. Lógica para calcular y mostrar la diferencia
                if(busqueda && busqueda[campo] !== undefined && busqueda[campo] !== null && busqueda[campo] !== "") {
                    const elementoDif = document.getElementById(`${prefijo}-dif-${campo}`);

                    if(elementoDif) {
                        let valEncontrado = parseFloat(datos[campo]);
                        let valBuscado = parseFloat(busqueda[campo]);

                        // Verificamos si son medidas numéricas (Largo, Ancho, Alto, Perímetro)
                        if(!isNaN(valEncontrado) && !isNaN(valBuscado)) {
                            let diferencia = valEncontrado - valBuscado;

                            if(diferencia === 0) {
                                elementoDif.textContent = '(Dif: 0.0)';
                                elementoDif.style.color = 'gray'; // Gris para coincidencias exactas
                            } else {
                                let signo = diferencia > 0 ? '+' : '';
                                elementoDif.textContent = `(Dif: ${signo}${diferencia.toFixed(1)})`;
                                elementoDif.style.color = '#D90429'; // Rojo para diferencias
                            }
                        } 
                        // Verificamos si son textos (Tipo de Uña A, B, C)
                        else {
                            if(String(datos[campo]).trim() === String(busqueda[campo]).trim()) {
                                elementoDif.textContent = '(--)';
                                elementoDif.style.color = 'gray';
                            } else {
                                elementoDif.textContent = '(≠)';
                                elementoDif.style.color = '#D90429';
                            }
                        }
                    }
                }
            });
        }







        document.getElementById("btn-mi-boton").addEventListener("click", function () {

            copiarDatos("t2", "f2");
            copiarDatos("t3", "f3");

            document.getElementById("ventana-flotante").style.display = "flex";

        });

        function copiarDatos(origen, destino){

            const elementos = document.querySelectorAll("[id^='" + origen + "-']");

            elementos.forEach(function(origenEl){

                const idDestino = origenEl.id.replace(origen, destino);
                const destinoEl = document.getElementById(idDestino);

                if(destinoEl){
                    destinoEl.textContent = origenEl.textContent;
                }

            });

        }



    </script>
      
    </body>
        <style>
        /* ESTILOS DE LA VENTANA FLOTANTE (MODAL)    */
        .modal-fondo {
            display: none; /* Oculto por defecto */
            position: fixed;
            z-index: 9999; /* Por encima de absolutamente todo */
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(3, 4, 94, 0.85); /* Azul institucional oscuro transparente */
            backdrop-filter: blur(4px); /* Efecto de desenfoque al fondo */
        }
        
        .modal-contenido {
            background-color: #F4FBFC;
            margin: 1.5vh auto; /* Centrado con un mínimo margen arriba y abajo */
            width: 97vw; /* 97% del ancho de la pantalla */
            height: 97vh; /* 97% del alto de la pantalla */
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Evita que el contenido se desborde del borde redondeado */
        }
        
        .modal-cabecera {
            background-color: #DDF4F9;
            padding: 15px 25px;
            border-bottom: 3px solid #00B4D8;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .cerrar-modal {
            color: #FF595E;
            font-size: 38px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
            transition: 0.3s;
        }
        
        .cerrar-modal:hover {
            color: #b30000;
            transform: scale(1.1);
        }
        
        .modal-cuerpo {
            padding: 25px;
            overflow-y: auto; /* Permite hacer scroll independiente dentro de la ventana */
            flex-grow: 1; /* Ocupa todo el resto del alto disponible */
        }

        /* ========================================= */
        /* ESTILOS DE LA NUEVA TABLA (4x3) EN MODAL  */
        /* ========================================= */
        .tabla-analisis {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            margin-top: 15px;
        }
        .tabla-analisis th {
            background-color: #0077B6; /* Azul medio para no opacar el encabezado principal */
            color: white;
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #0056b3;
        }
        .tabla-analisis td {
            padding: 12px 15px;
            border: 1px solid #DDF4F9;
            color: #03045E;
            text-align: center;
            font-weight: bold;
        }
        .tabla-analisis tr:nth-child(even) {
            background-color: #F4FBFC;
        }
        </style>

</html>