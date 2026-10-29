<?php
// 1. CONEXIÓN A LA BASE DE DATOS
require_once $_SERVER['DOCUMENT_ROOT'] . '/creotec/conexion.php';
global $conexion;

// 2. RECIBIR DATOS DE JAVASCRIPT
header('Content-Type: application/json');
$datos = json_decode(file_get_contents("php://input"), true);

// 3. EVALUAR QUÉ ACCIÓN PIDIÓ JAVASCRIPT
if (isset($datos['accion'])) {

    // =================================================================
    // ACCIÓN 1: GUARDAR NUEVO INSUMO (ana_insumos)
    // =================================================================
    if ($datos['accion'] == 'nuevo_insumo') {
        
        $sql = "INSERT INTO ana_insumos 
                (id_insumo, prioridad, nombre_item, unidad_medida, stock_minimo, descripcion) 
                VALUES (?, ?, ?, ?, ?, ?)";
                
        $stmt = $conexion->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sissds", 
                $datos['id_insumo'], 
                $datos['prioridad'], 
                $datos['nombre'], 
                $datos['unidad'], 
                $datos['minimo'], 
                $datos['desc']
            );
            
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "mensaje" => "El insumo se guardó exitosamente."]);
            } else {
                if ($conexion->errno == 1062) {
                    echo json_encode(["status" => "error", "mensaje" => "Este Código de Insumo ya está registrado. Por favor, intenta con un ID diferente."]);
                } else {
                    echo json_encode(["status" => "error", "mensaje" => "Ocurrió un problema al guardar los datos. Verifica la información."]);
                }
            }
            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "mensaje" => "Error al preparar consulta: " . $conexion->error]);
        }

    // =================================================================
    // ACCIÓN 2: OBTENER INSUMOS (Sin filtros de área)
    // =================================================================
    } elseif ($datos['accion'] == 'obtener_insumos') {
        
        // Usamos CAST para obligar a MySQL a ordenarlo como número real
        $sql = "SELECT * FROM ana_insumos ORDER BY CAST(id_insumo AS UNSIGNED) ASC";
        $resultado = $conexion->query($sql);

        $insumos = [];
        if (isset($resultado) && $resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $insumos[] = $fila;
            }
        }

        echo json_encode(["status" => "success", "data" => $insumos]);
    
    // =================================================================
    // ACCIÓN 3: ELIMINAR INSUMO
    // =================================================================
    } elseif ($datos['accion'] == 'eliminar_insumo') {
        
        if (isset($datos['id_insumo'])) {
            
            $sql = "DELETE FROM ana_insumos WHERE id_insumo = ?";
            $stmt = $conexion->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("s", $datos['id_insumo']);
                if ($stmt->execute()) {
                    echo json_encode(["status" => "success", "mensaje" => "El insumo ha sido eliminado correctamente."]);
                } else {
                    echo json_encode(["status" => "error", "mensaje" => "No se pudo eliminar el insumo (puede estar vinculado a una compra)."]);
                }
                $stmt->close();
            } else {
                echo json_encode(["status" => "error", "mensaje" => "Error al preparar la consulta de eliminación."]);
            }
        } else {
            echo json_encode(["status" => "error", "mensaje" => "No se recibió el ID del insumo a eliminar."]);
        }

   // =================================================================
    // ACCIÓN 4: EDITAR INSUMO
    // =================================================================
    } elseif ($datos['accion'] == 'editar_insumo') {
        
        $sql = "UPDATE ana_insumos 
                SET prioridad=?, nombre_item=?, unidad_medida=?, stock_minimo=?, descripcion=? 
                WHERE id_insumo=?";
                
        $stmt = $conexion->prepare($sql);
        
        if ($stmt) {
            // El orden ahora coincide exactamente con los "?" de arriba:
            // i(prioridad) s(nombre) s(unidad) d(minimo) s(desc) s(id)
            $stmt->bind_param("issdss", 
                $datos['prioridad'], 
                $datos['nombre'], 
                $datos['unidad'], 
                $datos['minimo'], 
                $datos['desc'],
                $datos['id_insumo'] // <-- El ID va al final porque es el WHERE
            );
            
            $stmt->execute();
            
            // EL DETECTOR DE CAMBIOS
            if ($stmt->affected_rows > 0) {
                echo json_encode(["status" => "success", "mensaje" => "El insumo se actualizó correctamente."]);
            } else {
                echo json_encode(["status" => "error", "mensaje" => "No se detectaron cambios (o el ID no existe)."]);
            }
            $stmt->close();
        }






    // =================================================================
    // ACCIÓN 5: REGISTRAR NUEVA COMPRA (Corregido con tus nombres de columnas)
    // =================================================================
    } elseif ($datos['accion'] == 'nueva_compra') {
        
        $sql = "INSERT INTO ana_compras (id_compra, items, id_insumo, unidad_insumo, comprado_total, peso_envase, comprado_contenido, precio_total, precio_unitario, fecha_compra) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
        $stmt = $conexion->prepare($sql);
        
        if ($stmt) {
            // "ssssddddds" -> s(id_compra), s(items), s(id_insumo), s(unidad_insumo), d(total), d(envase), d(contenido), d(precio_total), d(precio_unitario), s(fecha)
            $stmt->bind_param("ssssddddds", 
                $datos['compra_id'],          // ID Compra manual
                $datos['item'],               // Nombre del ítem
                $datos['id_insumo'],          // ID del insumo autocompletado
                $datos['unidad'],             // Unidad del insumo autocompletada
                $datos['comprado_total'],     // Ingresado
                $datos['peso_envase'],        // Ingresado
                $datos['comprado_contenido'], // Calculado
                $datos['precio_total'],       // Ingresado
                $datos['precio_unitario'],    // Calculado
                $datos['fecha_compra']        // Fecha seleccionada
            );
            
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "mensaje" => "Compra registrada exitosamente."]);
            } else {
                // MySQL Error 1062 significa "Entrada Duplicada" (Duplicate entry)
                if ($stmt->errno == 1062) {
                    echo json_encode(["status" => "error", "mensaje" => "Este ID de Compra ya está registrado. Por favor, utiliza un número diferente."]);
                } else {
                    // Si es otro error diferente, mostramos el mensaje técnico
                    echo json_encode(["status" => "error", "mensaje" => "Error al guardar en la BD: " . $stmt->error]);
                }
            }
            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "mensaje" => "Error de preparación SQL: " . $conexion->error]);
        }
    // =================================================================
    // ACCIÓN 6: OBTENER COMPRAS
    // =================================================================
    } elseif ($datos['accion'] == 'obtener_compras') {
        
        // Usamos CAST para que ordene el ID matemáticamente de menor a mayor
        $sql = "SELECT * FROM ana_compras ORDER BY CAST(id_compra AS UNSIGNED) ASC";
        $resultado = $conexion->query($sql);

        $compras = [];
        if (isset($resultado) && $resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $compras[] = $fila;
            }
        }
        echo json_encode(["status" => "success", "data" => $compras]);

    // =================================================================
    // ACCIÓN 7: ELIMINAR COMPRA
    // =================================================================
    } elseif ($datos['accion'] == 'eliminar_compra') {
        
        $sql = "DELETE FROM ana_compras WHERE id_compra = ?";
        $stmt = $conexion->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("i", $datos['id_compra']);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "mensaje" => "Compra eliminada correctamente."]);
            } else {
                echo json_encode(["status" => "error", "mensaje" => "No se pudo eliminar la compra."]);
            }
            $stmt->close();
        }

    // =================================================================
    // ACCIÓN 8: EDITAR COMPRA EXISTENTE
    // =================================================================
    } elseif ($datos['accion'] == 'editar_compra') {
        
        $sql = "UPDATE ana_compras 
                SET items=?, id_insumo=?, unidad_insumo=?, comprado_total=?, peso_envase=?, comprado_contenido=?, precio_total=?, precio_unitario=?, fecha_compra=? 
                WHERE id_compra=?";
                
        $stmt = $conexion->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sssddddsss", 
                $datos['item'],               
                $datos['id_insumo'],          
                $datos['unidad'],             
                $datos['comprado_total'],     
                $datos['peso_envase'],        
                $datos['comprado_contenido'], 
                $datos['precio_total'],       
                $datos['precio_unitario'],    
                $datos['fecha_compra'],       
                $datos['compra_id']
            );
            
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "mensaje" => "La compra se actualizó correctamente."]);
            } else {
                echo json_encode(["status" => "error", "mensaje" => "Error al actualizar en la BD: " . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "mensaje" => "Error de preparación SQL: " . $conexion->error]);
        }

    } else {
        echo json_encode(["status" => "error", "mensaje" => "La acción enviada no es reconocida."]);
    }

} else {
    echo json_encode(["status" => "error", "mensaje" => "No se recibió ninguna petición válida."]);
}

// 4. CERRAR CONEXIÓN
if (isset($conexion) && $conexion instanceof mysqli) {
    $conexion->close();
}
?>



