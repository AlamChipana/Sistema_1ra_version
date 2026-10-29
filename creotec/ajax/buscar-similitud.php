<?php
// Le decimos al navegador que este archivo solo escupe datos puros (JSON), no HTML
header('Content-Type: application/json; charset=utf-8');

// 1. Recibimos los datos enviados desde JavaScript (el formulario)
$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if (!$datos) {
    echo json_encode(["status" => "error", "mensaje" => "No se recibieron datos."]);
    exit;
}

// Extraemos las variables para que sea más fácil leer el código
$lado = $datos['lado'];

$palma_largo = floatval($datos['palma_largo']);
$pulgar_largo = floatval($datos['pulgar_largo']);
$medio_largo = floatval($datos['medio_largo']);

// 2. CONEXIÓN A LA BASE DE DATOS
$host = 'localhost';
$dbname = 'creotec'; // <--- CAMBIA ESTO por el nombre real de tu BD
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // =========================================================================
    // CONSULTA 1: BUSCAR LOS 2 MEJORES MOLDES (Con Filtro Estricto de ±5mm)
    // =========================================================================
    // Usamos ABS() que significa "Valor Absoluto". Esto convierte los números 
    // negativos en positivos, permitiéndonos saber la diferencia real en milímetros.
    
    $sql_moldes = "SELECT *, 
    (ABS(palma_largo - :palma) + ABS(pulgar_largo - :pulgar) + ABS(medio_largo - :medio)) AS diferencia_total
    FROM ana_moldes 
    WHERE tipo_registro = 'MOLDE'
    AND lado = :lado
    AND ABS(palma_largo - :palma) <= 5
    AND ABS(pulgar_largo - :pulgar) <= 5
    AND ABS(medio_largo - :medio) <= 5
    ORDER BY diferencia_total ASC
    LIMIT 2";

    $stmt = $pdo->prepare($sql_moldes);
    $stmt->execute([
    ':palma' => $palma_largo,
    ':pulgar' => $pulgar_largo,
    ':medio' => $medio_largo,
    ':lado' => $lado
    ]);
    $resultados_moldes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // =========================================================================
    // CONSULTA 2: BUSCAR EL MEJOR PACIENTE O DONANTE (Más flexible, sin límite 5mm)
    // =========================================================================
    $sql_humanos = "SELECT *, 
    (ABS(palma_largo - :palma) + ABS(pulgar_largo - :pulgar) + ABS(medio_largo - :medio)) AS diferencia_total
    FROM ana_moldes 
    WHERE tipo_registro IN ('PACIENTE', 'DONANTE')
    AND lado = :lado
    ORDER BY diferencia_total ASC
    LIMIT 1";

    $stmt2 = $pdo->prepare($sql_humanos);
    $stmt2->execute([
    ':palma' => $palma_largo,
    ':pulgar' => $pulgar_largo,
    ':medio' => $medio_largo,
    ':lado' => $lado
    ]);
    $resultado_humano = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // 3. ENVIAMOS LA RESPUESTA DE VUELTA AL NAVEGADOR
    echo json_encode([
        "status" => "success",
        "moldes" => $resultados_moldes, // Tendrá 0, 1 o 2 registros
        "humano" => $resultado_humano   // Tendrá 0 o 1 registro
    ]);

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "mensaje" => "Error de BD: " . $e->getMessage()]);
}
?>