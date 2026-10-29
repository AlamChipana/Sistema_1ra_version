<?php
// Configuración para recibir JSON desde JavaScript
header('Content-Type: application/json; charset=utf-8');

// Configuración de la base de datos (Ajusta si tienes contraseña en XAMPP)
$host = 'localhost';
$dbname = 'creotec'; 
$username = 'root';  
$password = '';      

try {
    // Conexión usando PDO (El estándar más seguro para PHP)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Habilitar el reporte de errores de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si falla la conexión, devolvemos el error a JavaScript
    echo json_encode(["status" => "error", "mensaje" => "Error de conexión a la BD: " . $e->getMessage()]);
    exit();
}

// Recibir los datos enviados por fetch() en JS
$datos = json_decode(file_get_contents("php://input"), true);

// Verificar qué acción se está solicitando (si no hay acción, queda vacío)
$accion = isset($datos['accion']) ? $datos['accion'] : '';

switch ($accion) {
    
    // =======================================================
    // ACCIÓN 1: GUARDAR CATÁLOGO DE PROCESOS (VISTA CONFIGURACIÓN)
    // =======================================================
    case 'guardar_proceso_catalogo':
        $proceso_principal = $datos['proceso_principal'];
        $subprocesos = $datos['subprocesos'];

        try {
            // Iniciamos una transacción: o se guardan todos los subprocesos, o ninguno.
            $pdo->beginTransaction();

            // Preparamos la consulta SQL
            $stmt = $pdo->prepare("INSERT INTO procesos_catalogo (proceso_principal, nombre_subproceso, tiempo_esperado_minutos) VALUES (:proceso, :subproceso, :tiempo)");

            // Recorremos el arreglo de subprocesos y ejecutamos la consulta por cada uno
            foreach ($subprocesos as $sub) {
                $stmt->execute([
                    ':proceso'    => $proceso_principal,
                    ':subproceso' => $sub['nombre'],
                    ':tiempo'     => $sub['tiempo_minutos']
                ]);
            }

            // Confirmamos la transacción para guardar en la BD
            $pdo->commit();
            
            echo json_encode(["status" => "success", "mensaje" => "Proceso y " . count($subprocesos) . " subprocesos guardados correctamente en el catálogo."]);

        } catch (PDOException $e) {
            // Si hay error, deshacemos cualquier cambio a medias (Rollback)
            $pdo->rollBack();
            echo json_encode(["status" => "error", "mensaje" => "Error al guardar el proceso: " . $e->getMessage()]);
        }
        break;

    // =======================================================
    // ACCIÓN 2: GUARDAR REGISTRO DIARIO (VISTA TRABAJADOR)
    // =======================================================
    case 'guardar_registro':
        try {
            $id_registro = isset($datos['id_registro']) ? $datos['id_registro'] : '';
            
            if ($id_registro != '') {
                // ACTUALIZAR: La tarea estaba en pausa y se sumó más tiempo
                $stmt = $pdo->prepare("UPDATE registro_rendimiento SET tiempo_invertido_segundos = :tiempo, estado_final = :estado, observaciones = :obs WHERE id_registro = :id_registro");
                $stmt->execute([
                    ':tiempo'      => $datos['tiempo_segundos'],
                    ':estado'      => $datos['estado'],
                    ':obs'         => $datos['observaciones'],
                    ':id_registro' => $id_registro
                ]);
            } else {
                // INSERTAR: Es una tarea completamente nueva
                $stmt = $pdo->prepare("INSERT INTO registro_rendimiento (id_trabajador, nombre_paciente, id_proceso, tiempo_invertido_segundos, estado_final, observaciones) VALUES (:id_trabajador, :paciente, :id_proceso, :tiempo, :estado, :obs)");
                $stmt->execute([
                    ':id_trabajador' => $datos['id_trabajador'],
                    ':paciente'      => $datos['paciente'],
                    ':id_proceso'    => $datos['id_proceso'],
                    ':tiempo'        => $datos['tiempo_segundos'],
                    ':estado'        => $datos['estado'],
                    ':obs'           => $datos['observaciones']
                ]);
            }
            echo json_encode(["status" => "success", "mensaje" => "Registro guardado correctamente."]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "mensaje" => "Error al guardar el registro: " . $e->getMessage()]);
        }
        break;

    // =======================================================
    // ACCIÓN 3: CARGAR DATOS A LA TABLA
    // =======================================================
    case 'cargar_procesos':
        try {
            // Hacemos una consulta agrupando por el proceso principal. 
            // Sumamos los tiempos y contamos cuántos subprocesos tiene cada uno.
            $sql = "SELECT proceso_principal, 
                           COUNT(id_proceso) as cantidad_subprocesos, 
                           SUM(tiempo_esperado_minutos) as tiempo_total 
                    FROM procesos_catalogo 
                    GROUP BY proceso_principal 
                    ORDER BY MIN(fecha_creacion) DESC";
            
            $stmt = $pdo->query($sql);
            $procesos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Devolvemos los datos en formato JSON
            echo json_encode(["status" => "success", "data" => $procesos]);

        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "mensaje" => "Error al cargar la tabla: " . $e->getMessage()]);
        }
    break;

    // =======================================================
    // ACCIÓN 4: VER DETALLES DE UN PROCESO ESPECÍFICO
    // =======================================================
    case 'ver_detalles':
        $proceso_principal = $datos['proceso_principal'];
        
        try {
            $stmt = $pdo->prepare("SELECT nombre_subproceso, tiempo_esperado_minutos FROM procesos_catalogo WHERE proceso_principal = :proceso ORDER BY id_proceso ASC");
            $stmt->execute([':proceso' => $proceso_principal]);
            $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode(["status" => "success", "data" => $detalles]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "mensaje" => "Error al buscar detalles: " . $e->getMessage()]);
        }
    break;

    // =======================================================
    // ACCIÓN 5: LLENAR DESPLEGABLE DE PROCESOS (TRABAJADOR)
    // =======================================================
    case 'cargar_select_procesos':
        try {
            // Buscamos solo los nombres principales sin repetirlos (DISTINCT)
            $stmt = $pdo->query("SELECT DISTINCT proceso_principal FROM procesos_catalogo ORDER BY proceso_principal ASC");
            $procesos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(["status" => "success", "data" => $procesos]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "mensaje" => $e->getMessage()]);
        }
        break;

    // =======================================================
    // ACCIÓN 6: LLENAR DESPLEGABLE DE SUBPROCESOS
    // =======================================================
    case 'cargar_select_subprocesos':
        $proceso_principal = $datos['proceso_principal'];
        try {
            // Traemos el ID real y el nombre del subproceso para ese proceso principal
            $stmt = $pdo->prepare("SELECT id_proceso, nombre_subproceso, tiempo_esperado_minutos FROM procesos_catalogo WHERE proceso_principal = :proceso ORDER BY id_proceso ASC");
            $stmt->execute([':proceso' => $proceso_principal]);
            $subprocesos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(["status" => "success", "data" => $subprocesos]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "mensaje" => $e->getMessage()]);
        }
    break;


    // =======================================================
    // ACCIÓN 7: CARGAR TAREAS EN PAUSA (WORK IN PROGRESS)
    // =======================================================
    case 'cargar_tareas_pausadas':
        $id_trabajador = $datos['id_trabajador'];
        try {
            // Unimos el registro con el catálogo para traer los nombres reales de los procesos
            $sql = "SELECT r.id_registro, r.nombre_paciente, r.tiempo_invertido_segundos, r.id_proceso, c.proceso_principal, c.nombre_subproceso 
                    FROM registro_rendimiento r
                    JOIN procesos_catalogo c ON r.id_proceso = c.id_proceso
                    WHERE r.id_trabajador = :id_trabajador AND r.estado_final = 'pausado'
                    ORDER BY r.fecha_actualizacion DESC";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id_trabajador' => $id_trabajador]);
            $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode(["status" => "success", "data" => $tareas]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "mensaje" => $e->getMessage()]);
        }
        break;
}
?>