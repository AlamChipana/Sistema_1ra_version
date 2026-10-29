<div class="contenedor-moldes" style="animation: fadeIn 0.4s ease-in-out; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
    
    <div style="margin-bottom: 20px;">
        <button id="btn-regresar-anaplastologia" style="background: none; border: none; color: #0077B6; font-weight: 600; font-size: 15px; cursor: pointer; display: flex; align-items: center; gap: 8px; padding: 0;">
            <span style="font-size: 20px;">←</span> Volver al Panel de Módulos
        </button>
    </div>

    <div class="cabecera-modulo" style="border-bottom: 2px solid #DDF4F9; padding-bottom: 20px; margin-bottom: 25px;">
        <h2 style="color: #03045E; margin: 0 0 8px 0; font-size: 24px;">Búsqueda de Moldes - Anaplastología</h2>
        <p style="color: #0077B6; margin: 0; font-size: 15px;">Encuentra rápidamente los registros de moldes físicos y digitales.</p>
    </div>

    <form id="form-busqueda-moldes" action="procesos/procesos-moldes.php" method="POST">
        
        <div class="seccion-busqueda" style="margin-bottom: 30px; display: flex; flex-direction: column; gap: 15px;">
            <div style="display: flex; gap: 10px; width: 100%; margin-bottom: 20px;">
                <input type="text" id="input-busqueda" name="termino_busqueda" placeholder="Ingrese el CÓDIGO para buscar en Paciente, Donante y Molde..." style="width: 100%; padding: 12px 15px; border: 1px solid #00B4D8; border-radius: 6px; font-size: 15px; outline: none; box-sizing: border-box;">
                    <button type="button" onclick="buscarPorCodigo()" style="background-color: #03045E; color: white; border: none; padding: 0 25px; border-radius: 6px; font-weight: bold; cursor: pointer; white-space: nowrap; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        🔍 Buscar por Código
                    </button>
            </div>            
            <div class="contenedor-acciones" style="display: flex; justify-content: center; gap: 20px;">
                <button type="button" onclick="buscarMolde()" class="btn-accion-form btn-buscar">
                    Buscar Molde
                </button>
                <button type="button" onclick="guardarMolde()" class="btn-accion-form btn-guardar">
                    Guardar Molde
                </button>
                <button type="button" onclick="limpiarFormulario()" class="btn-accion-form btn-limpiar">
                    Limpiar
                </button>
                <input type="hidden" name="accion" id="accion_formulario" value="">
            </div>
        </div>

        <div class="contenedor-ficha-tecnica">
            <table class="tabla-medidas">
                
                <thead>
                    <tr>
                        <th colspan="9" class="cabecera-botones dark-bg">
                            <div class="contenedor-grid-cabecera cuatro-columnas">
                                <label class="btn-cabecera-sel">
                                    <input type="radio" name="tipo_protesis" value="MANO"> MANO
                                </label>
                                <label class="btn-cabecera-sel">
                                    <input type="radio" name="tipo_protesis" value="PARCIAL DE MANO"> PARCIAL DE MANO
                                </label>
                                <label class="btn-cabecera-sel">
                                    <input type="radio" name="tipo_protesis" value="TRANSHUMERAL"> TRANSHUMERAL
                                </label>
                                <label class="btn-cabecera-sel">
                                    <input type="radio" name="tipo_protesis" value="TRANSRADIAL"> TRANSRADIAL
                                </label>
                            </div>
                        </th>
                    </tr>
                    
                    <tr>
                        <th colspan="6" class="cabecera-botones primary-bg">
                            <div class="contenedor-grid-cabecera tres-columnas">
                                <label class="btn-cabecera-sel">
                                    <input type="radio" name="tipo_registro" value="PACIENTE"> PACIENTE
                                </label>
                                <label class="btn-cabecera-sel">
                                    <input type="radio" name="tipo_registro" value="DONANTE"> DONANTE
                                </label>
                                <label class="btn-cabecera-sel">
                                    <input type="radio" name="tipo_registro" value="MOLDE"> MOLDE
                                </label>
                            </div>
                        </th>
                        
                        <th colspan="3" class="cabecera-botones primary-bg" style="border-left: 1px solid rgba(255,255,255,0.2) !important;">
                            <div class="contenedor-codigo-molde">
                                <span class="label-codigo">CÓDIGO:</span>
                                <input type="text" name="codigo_molde" placeholder="-" class="input-codigo-cabecera" required>
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="fila-datos">
                        <td colspan="4">
                            <div class="contenedor-datos-personales">
                                <div class="campo-dato">
                                    <span class="label-medida">NOMBRE:</span>
                                    <input type="text" name="nombre_paciente" class="input-medida input-nombre">
                                </div>
                                <div class="campo-dato">
                                    <span class="label-medida">EDAD:</span>
                                    <input type="text" name="edad" class="input-medida input-edad">
                                </div>
                                <div class="campo-dato">
                                    <span class="label-medida">CELULAR:</span>
                                    <input type="text" name="celular" class="input-medida input-celular">
                                </div>
                                <div class="campo-dato">
                                    <span class="label-medida">RESIDENCIA:</span>
                                    <input type="text" name="residencia" class="input-medida">
                                </div>
                                <div class="campo-dato">
                                    <span class="label-medida">FECHA:</span>
                                    <input type="date" name="fecha" class="input-medida">
                                </div>
                            </div>
                        </td>

                        <td></td>

                        <td colspan="4">
                            <div style="display: flex; flex-direction: column; gap: 6px; padding: 10px;">
                                <div style="margin-bottom: 5px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
                                    <span class="label-medida" style="font-weight: bold; color: #03045E;">CONTEXTURA FÍSICA DE LA MANO:</span>
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                    <label class="btn-seleccion"><input type="radio" name="mano_lado" value="IZQUIERDA"> IZQUIERDA</label>
                                    <label class="btn-seleccion"><input type="radio" name="mano_lado" value="DERECHA"> DERECHA</label>

                                    <label class="btn-seleccion"><input type="radio" name="mano_longitud" value="LARGO"> LARGO</label>
                                    <label class="btn-seleccion"><input type="radio" name="mano_longitud" value="CORTO"> CORTO</label>

                                    <label class="btn-seleccion"><input type="radio" name="mano_grosor" value="GRUESO"> GRUESO</label>
                                    <label class="btn-seleccion"><input type="radio" name="mano_grosor" value="DELGADO"> DELGADO</label>

                                    <label class="btn-seleccion"><input type="radio" name="mano_textura" value="LISO"> LISO</label>
                                    <label class="btn-seleccion"><input type="radio" name="mano_textura" value="ARRUGADO"> ARRUGADO</label>
                                </div>
                            </div>
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="9" class="mensaje-alerta">
                            ⚠️ LA TOMA DE MEDIDAS SE REALIZA CON CINTA MÉTRICA EN CENTÍMETROS Y CON PUNTO DECIMAL.
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" class="seccion-verde">PALMA</td>
                        <td colspan="3" class="seccion-azul">DEDOS</td>
                        <td colspan="3" class="seccion-naranja">UÑAS</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="area-dibujo">
                            <img src="imagenes/moldes1.png" class="img-esquema">
                        </td>
                        <td colspan="3" class="area-dibujo">
                            <img src="imagenes/moldes2.png" class="img-esquema">
                        </td>
                        <td colspan="3" class="area-dibujo">
                            <img src="imagenes/moldes3.png" class="img-esquema">
                        </td>
                    </tr>

                    <tr class="subtitulos-medidas">
                        <td colspan="3" class="sub-verde">MEDIDAS</td>
                        <td class="sub-azul">DEDOS</td>
                        <td class="sub-azul">LARGO</td>
                        <td class="sub-azul">PERÍMETRO</td>
                        <td class="sub-naranja">ALTO</td>
                        <td class="sub-naranja">ANCHO</td>
                        <td class="sub-naranja">TIPO</td>
                    </tr>

                    <tr class="fila-medida">
                        <td class="label-medida">LARGO</td>
                        <td colspan="2"><input type="number" step="0.1" name="palma_largo" class="input-medida"></td>
                        
                        <td class="label-medida">MEÑIQUE</td>
                        <td><input type="number" step="0.1" name="menique_largo" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="menique_perimetro" class="input-medida"></td>
                        
                        <td><input type="number" step="0.1" name="menique_alto" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="menique_ancho" class="input-medida"></td>
                        <td><input type="text" name="menique_tipo" class="input-medida"></td>
                    </tr>

                    <tr class="fila-medida">
                        <td class="label-medida">ANCHO</td>
                        <td colspan="2"><input type="number" step="0.1" name="palma_ancho" class="input-medida"></td>
                        
                        <td class="label-medida">ANULAR</td>
                        <td><input type="number" step="0.1" name="anular_largo" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="anular_perimetro" class="input-medida"></td>
                        
                        <td><input type="number" step="0.1" name="anular_alto" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="anular_ancho" class="input-medida"></td>
                        <td><input type="text" name="anular_tipo" class="input-medida"></td>
                    </tr>

                    <tr class="fila-medida">
                        <td class="label-medida">PERÍMETRO</td>
                        <td colspan="2"><input type="number" step="0.1" name="palma_perimetro" class="input-medida"></td>
                        
                        <td class="label-medida">MEDIO</td>
                        <td><input type="number" step="0.1" name="medio_largo" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="medio_perimetro" class="input-medida"></td>
                        
                        <td><input type="number" step="0.1" name="medio_alto" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="medio_ancho" class="input-medida"></td>
                        <td><input type="text" name="medio_tipo" class="input-medida"></td>
                    </tr>

                    <tr class="fila-medida">
                        <td class="label-medida">LARGO A.B.</td>
                        <td colspan="2"><input type="number" step="0.1" name="palma_largo_ab" class="input-medida"></td>
                        
                        <td class="label-medida">ÍNDICE</td>
                        <td><input type="number" step="0.1" name="indice_largo" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="indice_perimetro" class="input-medida"></td>
                        
                        <td><input type="number" step="0.1" name="indice_alto" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="indice_ancho" class="input-medida"></td>
                        <td><input type="text" name="indice_tipo" class="input-medida"></td>
                    </tr>

                    <tr class="fila-medida">
                        <td class="label-medida">PERÍMETRO A.B.</td>
                        <td colspan="2"><input type="number" step="0.1" name="palma_perimetro_ab" class="input-medida"></td>
                        
                        <td class="label-medida">PULGAR</td>
                        <td><input type="number" step="0.1" name="pulgar_largo" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="pulgar_perimetro" class="input-medida"></td>
                        
                        <td><input type="number" step="0.1" name="pulgar_alto" class="input-medida"></td>
                        <td><input type="number" step="0.1" name="pulgar_ancho" class="input-medida"></td>
                        <td><input type="text" name="pulgar_tipo" class="input-medida"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>

<style>
    /* Estilos mínimos para animaciones y hover que no afectan la estructura global */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .tabla-creotec tbody tr:hover {
        background-color: #F4FBFC;
    }
    #btn-regresar-anaplastologia:hover {
        color: #03045E !important;
    }
</style>
