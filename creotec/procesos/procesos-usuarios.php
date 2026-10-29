<?php
// Usamos la ruta absoluta que solucionó el problema
require_once $_SERVER['DOCUMENT_ROOT'] . '/creotec/conexion.php';
global $conexion;

if(isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    // ====================================================================
    // ACCIÓN: REGISTRAR NUEVO EMPLEADO
    // ====================================================================
    if($accion == 'registrar') {
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $ci = $_POST['ci'];
        $id_area = $_POST['id_area'];
        $id_tipo = $_POST['id_tipo'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        // 1. VERIFICACIÓN: ¿El CI ya está registrado en la empresa?
        $stmt_check_ci = mysqli_prepare($conexion, "SELECT id_personal FROM personal WHERE ci = ?");
        mysqli_stmt_bind_param($stmt_check_ci, "s", $ci);
        mysqli_stmt_execute($stmt_check_ci);
        mysqli_stmt_store_result($stmt_check_ci);
        
        if(mysqli_stmt_num_rows($stmt_check_ci) > 0) {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Este Carnet de Identidad (CI) ya pertenece a un trabajador registrado.']);
            exit;
        }

        // 2. VERIFICACIÓN: ¿El Usuario digital ya está en uso?
        $stmt_check_usu = mysqli_prepare($conexion, "SELECT id_usuario FROM usuarios WHERE usuario = ?");
        mysqli_stmt_bind_param($stmt_check_usu, "s", $usuario);
        mysqli_stmt_execute($stmt_check_usu);
        mysqli_stmt_store_result($stmt_check_usu);
        
        if(mysqli_stmt_num_rows($stmt_check_usu) > 0) {
            echo json_encode(['estado' => 'error', 'mensaje' => 'El nombre de usuario ya está en uso. Por favor, elige uno diferente (ej. juan.perez2).']);
            exit;
        }

        // 3. SI TODO ESTÁ LIBRE, PROCEDEMOS A GUARDAR
        mysqli_begin_transaction($conexion);

        try {
            $sql_personal = "INSERT INTO personal (nombres, apellidos, ci, id_area, id_tipo) VALUES (?, ?, ?, ?, ?)";
            $stmt_personal = mysqli_prepare($conexion, $sql_personal);
            mysqli_stmt_bind_param($stmt_personal, "sssii", $nombres, $apellidos, $ci, $id_area, $id_tipo);
            mysqli_stmt_execute($stmt_personal);
            
            $id_personal_nuevo = mysqli_insert_id($conexion);

            $sql_usuarios = "INSERT INTO usuarios (id_personal, usuario, password) VALUES (?, ?, ?)";
            $stmt_usuarios = mysqli_prepare($conexion, $sql_usuarios);
            mysqli_stmt_bind_param($stmt_usuarios, "iss", $id_personal_nuevo, $usuario, $password);
            mysqli_stmt_execute($stmt_usuarios);

            mysqli_commit($conexion);
            echo json_encode(['estado' => 'exito', 'mensaje' => 'Empleado y usuario registrados correctamente.']);

        } catch (Exception $e) {
            mysqli_rollback($conexion);
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error inesperado al guardar los datos en la base de datos.']);
        }
        exit;
    }
    // ====================================================================
    // ACCIÓN: ACTUALIZAR (EDITAR) EMPLEADO EXISTENTE
    // ====================================================================
    if($accion == 'editar') {
        $id_personal = $_POST['id_editando'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $ci = $_POST['ci'];
        $id_area = $_POST['id_area'];
        $id_tipo = $_POST['id_tipo'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        mysqli_begin_transaction($conexion);

        try {
            $sql_per = "UPDATE personal SET nombres=?, apellidos=?, ci=?, id_area=?, id_tipo=? WHERE id_personal=?";
            $stmt_per = mysqli_prepare($conexion, $sql_per);
            mysqli_stmt_bind_param($stmt_per, "sssiii", $nombres, $apellidos, $ci, $id_area, $id_tipo, $id_personal);
            mysqli_stmt_execute($stmt_per);

            if(!empty($password)) {
                $sql_usu = "UPDATE usuarios SET usuario=?, password=? WHERE id_personal=?";
                $stmt_usu = mysqli_prepare($conexion, $sql_usu);
                mysqli_stmt_bind_param($stmt_usu, "ssi", $usuario, $password, $id_personal);
            } else {
                $sql_usu = "UPDATE usuarios SET usuario=? WHERE id_personal=?";
                $stmt_usu = mysqli_prepare($conexion, $sql_usu);
                mysqli_stmt_bind_param($stmt_usu, "si", $usuario, $id_personal);
            }
            mysqli_stmt_execute($stmt_usu);

            mysqli_commit($conexion);
            echo json_encode(['estado' => 'exito', 'mensaje' => 'Datos actualizados correctamente.']);

        } catch (Exception $e) {
            mysqli_rollback($conexion);
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al actualizar. Verifique que el CI o Usuario no estén duplicados.']);
        }
        exit;
    }

    // ====================================================================
    // ACCIÓN: OBTENER DATOS DE UN USUARIO (PARA LLENAR EL FORMULARIO)
    // ====================================================================
    if($accion == 'obtener') {
        $id_personal = $_POST['id_personal'];
        
        $sql = "SELECT p.*, u.usuario 
                FROM personal p 
                INNER JOIN usuarios u ON p.id_personal = u.id_personal 
                WHERE p.id_personal = $id_personal";
                
        $resultado = mysqli_query($conexion, $sql);
        $datos = mysqli_fetch_assoc($resultado);
        
        echo json_encode($datos);
        exit;
    }

    // ====================================================================
    // ACCIÓN: CAMBIAR ESTADO DEL USUARIO (ACTIVAR / DESACTIVAR)
    // ====================================================================
    if($accion == 'cambiar_estado') {
        $id_personal = $_POST['id_personal'];
        $nuevo_estado = $_POST['nuevo_estado'];

        $sql = "UPDATE usuarios SET estado = ? WHERE id_personal = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $nuevo_estado, $id_personal);

        if(mysqli_stmt_execute($stmt)) {
            $mensaje = $nuevo_estado == 1 ? 'Usuario activado correctamente.' : 'Usuario desactivado correctamente.';
            echo json_encode(['estado' => 'exito', 'mensaje' => $mensaje]);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al cambiar el estado.']);
        }
        exit;
    }

    // ====================================================================
    // ACCIÓN: LISTAR USUARIOS PARA LA TABLA
    // ====================================================================
    if($accion == 'listar') {
        $sql = "SELECT p.id_personal, p.nombres, p.apellidos, p.ci, a.nombre_area, u.usuario, u.estado 
                FROM personal p 
                INNER JOIN areas a ON p.id_area = a.id_area 
                INNER JOIN usuarios u ON p.id_personal = u.id_personal
                ORDER BY p.id_personal DESC";
                
        $resultado = mysqli_query($conexion, $sql);
        $html = "";
        
        if(mysqli_num_rows($resultado) == 0){
            echo "<tr><td colspan='7' style='text-align:center;'>No hay usuarios registrados</td></tr>";
            exit;
        }

        while($fila = mysqli_fetch_assoc($resultado)) {
            $estado = $fila['estado'] ? '<span class="estado-badge estado-activo">Activo</span>' : '<span class="estado-badge estado-inactivo">Inactivo</span>';
            
            // Botón de activar/desactivar dinámico
            $btn_estado = $fila['estado'] 
                ? "<button type='button' onclick='cambiarEstado({$fila['id_personal']}, 0)' class='btn-accion-form' style='padding: 6px 12px; font-size: 12px; background-color: #dc3545; color: white; margin-left: 5px;'>Desactivar</button>"
                : "<button type='button' onclick='cambiarEstado({$fila['id_personal']}, 1)' class='btn-accion-form' style='padding: 6px 12px; font-size: 12px; background-color: #10b981; color: white; margin-left: 5px;'>Activar</button>";

            $html .= "<tr>
                        <td>{$fila['id_personal']}</td>
                        <td>{$fila['nombres']} {$fila['apellidos']}</td>
                        <td>{$fila['ci']}</td>
                        <td>{$fila['nombre_area']}</td>
                        <td>{$fila['usuario']}</td>
                        <td>{$estado}</td>
                        <td style='white-space: nowrap;'>
                            <button type='button' onclick='obtenerDatosUsuario({$fila['id_personal']})' class='btn-accion-form' style='padding: 6px 12px; font-size: 12px; background-color: var(--primary); color: white;'>Editar</button>
                            {$btn_estado}
                        </td>
                      </tr>";
        }
        
        echo $html;
        exit;
    }
}
?>