<?php
// procesos/buscar-moldes.php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/creotec/conexion.php';
global $conexion;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Recibir Contextura (Filtros Exactos)
    $lado = $_POST['lado'] ?? '';
    $longitud_tipo = $_POST['longitud'] ?? '';
    $grosor = $_POST['grosor'] ?? '';
    $textura = $_POST['textura'] ?? '';
    
    // 2. Recibir Medida Base (Para el filtro de tolerancia)
    $palma_largo = (float)($_POST['palma_largo'] ?? 0);

    // 3. Aplicar regla matemática de Similitud (± 5 milímetros)
    $min_palma = $palma_largo - 5;
    $max_palma = $palma_largo + 5;

    // 4. Consulta SQL Híbrida (Exacta + Rango)
    $sql = "SELECT * FROM ana_moldes 
            WHERE lado = ? 
            AND longitud = ? 
            AND grosor = ? 
            AND textura = ? 
            AND palma_largo BETWEEN ? AND ?";

    $stmt = $conexion->prepare($sql);
    
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["error" => "Error de base de datos"]);
        exit();
    }

    // ssssdd = 4 strings (contextura) + 2 decimales (mínimo y máximo)
    $stmt->bind_param("ssssdd", $lado, $longitud_tipo, $grosor, $textura, $min_palma, $max_palma);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $moldes_encontrados = [];
    while ($fila = $resultado->fetch_assoc()) {
        $moldes_encontrados[] = $fila;
    }

    // Devolver lista de moldes compatibles
    echo json_encode($moldes_encontrados);
    
    $stmt->close();
    exit();
}
?>