<?php
session_start();

// 1. Conexión segura usando ruta absoluta
$ruta_conexion = $_SERVER['DOCUMENT_ROOT'] . '/creotec/conexion.php';
if (file_exists($ruta_conexion)) {
    require_once $ruta_conexion;
} else {
    http_response_code(500);
    die("Error: No se encontró el archivo de conexión.");
}
global $conexion;

// 2. Verificar que recibimos datos vía POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'guardar') {
    
    // 3. Recopilación de los 42 datos del formulario en un array
    $datos = [
        $_POST['codigo_molde'], $_POST['tipo_protesis'], $_POST['tipo_registro'], 
        $_POST['nombre_paciente'], $_POST['edad'], $_POST['celular'], 
        $_POST['residencia'], $_POST['fecha'],
        $_POST['mano_lado'], $_POST['mano_longitud'], $_POST['mano_grosor'], $_POST['mano_textura'],
        $_POST['palma_largo'], $_POST['palma_ancho'], $_POST['palma_perimetro'], 
        $_POST['palma_largo_ab'], $_POST['palma_perimetro_ab'],
        $_POST['menique_largo'], $_POST['menique_perimetro'], $_POST['menique_alto'], $_POST['menique_ancho'], $_POST['menique_tipo'],
        $_POST['anular_largo'], $_POST['anular_perimetro'], $_POST['anular_alto'], $_POST['anular_ancho'], $_POST['anular_tipo'],
        $_POST['medio_largo'], $_POST['medio_perimetro'], $_POST['medio_alto'], $_POST['medio_ancho'], $_POST['medio_tipo'],
        $_POST['indice_largo'], $_POST['indice_perimetro'], $_POST['indice_alto'], $_POST['indice_ancho'], $_POST['indice_tipo'],
        $_POST['pulgar_largo'], $_POST['pulgar_perimetro'], $_POST['pulgar_alto'], $_POST['pulgar_ancho'], $_POST['pulgar_tipo']
    ];

    // 4. Preparación de consulta SQL
    // Creamos la cadena de tipos: 17 strings/ints iniciales + 25 decimales/strings finales
    $tipos = "ssssisssssssddddd" . str_repeat("dddds", 5);

    $sql = "INSERT INTO ana_moldes (
        codigo_molde, tipo_protesis, tipo_registro, nombre_paciente, edad, celular, residencia, fecha,
        lado, longitud, grosor, textura,
        palma_largo, palma_ancho, palma_perimetro, palma_largo_ab, palma_perimetro_ab,
        menique_largo, menique_perimetro, menique_alto, menique_ancho, menique_tipo,
        anular_largo, anular_perimetro, anular_alto, anular_ancho, anular_tipo,
        medio_largo, medio_perimetro, medio_alto, medio_ancho, medio_tipo,
        indice_largo, indice_perimetro, indice_alto, indice_ancho, indice_tipo,
        pulgar_largo, pulgar_perimetro, pulgar_alto, pulgar_ancho, pulgar_tipo
    ) VALUES (" . str_repeat("?,", 41) . "?)";

    $stmt = $conexion->prepare($sql);
    
    // 5. Gestión de errores silenciosa para el usuario final
    if (!$stmt) {
        http_response_code(500);
        error_log("Error SQL en preparación: " . $conexion->error);
        echo "Error de base de datos.";
        exit();
    }

    // 6. Vinculación y Ejecución
    $stmt->bind_param($tipos, ...$datos);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        http_response_code(500);
        error_log("Error SQL al ejecutar: " . $stmt->error);
        echo "No se pudo guardar la información.";
    }
    
    $stmt->close();
    exit();
}
?>
?>