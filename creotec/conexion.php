<?php
$servidor   = "localhost";
$usuario    = "root";
$password   = "";
$base_datos = "creotec";

// EL NOMBRE DE LA VARIABLE DEBE SER EXACTAMENTE ESTE
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>