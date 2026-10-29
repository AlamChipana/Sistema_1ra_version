<?php
session_start();

class conectar{
    private $servidor = "localhost";
    private $usuario = "root";
    private $password = "";
    private $bd = "creotec";

    public function conexion(){
        $conexion = mysqli_connect($this->servidor, $this->usuario, $this->password, $this->bd);
        $conexion->set_charset('utf8mb4');
        if(!$conexion){
            die("Error de conexión: " . mysqli_connect_error());
        }
        return $conexion;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    $conexion_db = new conectar();
    $conexion = $conexion_db->conexion();

    $sql = "SELECT u.id_usuario, u.usuario, u.password, u.estado, p.id_area, p.id_tipo, p.nombres, p.apellidos 
            FROM usuarios u 
            INNER JOIN personal p ON u.id_personal = p.id_personal 
            WHERE u.usuario = ?";
            
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        
        // Si está inactivo, lo mandamos al login con error de inactivo
        if ($fila['estado'] == 0) {
            header("Location: index.php?error=inactivo");
            exit();
        }

        // Si la contraseña es correcta, entra
        if ($pass === $fila['password']) {
            $_SESSION['usuario_activo'] = $fila['usuario'];
            $_SESSION['id_area'] = $fila['id_area'];  
            $_SESSION['id_tipo'] = $fila['id_tipo'];  
            $_SESSION['nombre_completo'] = $fila['nombres'] . " " . $fila['apellidos']; // <-- ESTA ES LA LÍNEA MAGICA
            
            header("Location: inicio.php");
            exit();
        } else {
            // Contraseña mal
            header("Location: index.php?error=clave");
            exit();
        }
    } else {
        // Usuario no existe
        header("Location: index.php?error=usuario");
        exit();
    }
    
    $stmt->close();
    $conexion->close();
} else {
    header("Location: index.php");
    exit();
}
?>