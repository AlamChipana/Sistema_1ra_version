<?php
session_start();

// 1. CONTROL DE SEGURIDAD BÁSICO: Si no hay sesión activa, al login directo
if (!isset($_SESSION['usuario_activo'])) {
    header("Location: index.php");
    exit();
}

// ==========================================
// 2. SEGURIDAD AVANZADA: CIERRE POR INACTIVIDAD
// ==========================================
$tiempo_maximo = 3600; // 600 segundos = 10 minutos exactos

// Verificamos si ya existe un registro de la última vez que entró
if (isset($_SESSION['ultimo_acceso'])) {
    // Calculamos el tiempo inactivo (Hora actual - Hora del último movimiento)
    $tiempo_inactivo = time() - $_SESSION['ultimo_acceso'];
    
    // Si el tiempo inactivo supera los 10 minutos (600 seg), destruimos la sesión
    if ($tiempo_inactivo > $tiempo_maximo) {
        session_unset();
        session_destroy();
        // Lo pateamos al login enviando la señal de 'timeout'
        header("Location: index.php?error=timeout");
        exit();
    }
}
// Si pasó la prueba (o si acaba de iniciar sesión), reiniciamos su reloj a la hora actual
$_SESSION['ultimo_acceso'] = time(); 

// ... (A partir de aquí continúa tu código normal leyendo $pagina, $id_tipo, $id_area, etc.) ...

// Leemos qué sección quiere ver el usuario.
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'inicio';

// Variables de sesión traídas desde login.php
$id_tipo = $_SESSION['id_tipo'];
$id_area = $_SESSION['id_area'];

// ==========================================
// LÓGICA DE PERMISOS: true = Pase libre, false = Bloqueado
// ==========================================
$acceso_ana = ($id_tipo == 1 || $id_area == 2) ? true : false; // Anaplastología
$acceso_man = ($id_tipo == 1 || $id_area == 4) ? true : false; // Manufactura
$acceso_com = ($id_tipo == 1 || $id_area == 3) ? true : false; // Comercial
$acceso_rep = ($id_tipo == 1 || $id_area == 1) ? true : false; // Reportes (Admin)
$acceso_usu = ($id_tipo == 1) ? true : false; // Usuarios (Solo Admin Principal)

// ==========================================
// FILTRO EN LA URL: Por si escriben la ruta a la fuerza
// ==========================================
if ($pagina == 'anaplastologia' && !$acceso_ana) $pagina = 'inicio';
if ($pagina == 'manufactura' && !$acceso_man) $pagina = 'inicio';
if ($pagina == 'comercial' && !$acceso_com) $pagina = 'inicio';
if ($pagina == 'reportes' && !$acceso_rep) $pagina = 'inicio';
if ($pagina == 'usuarios' && !$acceso_usu) $pagina = 'inicio';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/moldes.css?v=<?php echo time(); ?>">

    <title>Panel de Control - Creotec</title> 
    <style>
        /* Estilo para que los botones bloqueados se vean en gris y no parezcan cliqueables */
        .boton-bloqueado {
            opacity: 0.4;
            cursor: not-allowed !important;
            filter: grayscale(100%);
        }
        .boton-bloqueado a {
            cursor: not-allowed !important;
            pointer-events: none; /* Evita que el enlace de HTML funcione */
        }
        /* ==========================================
           ANIMACIÓN DE ENTRADA AL SISTEMA (CORREGIDA)
        ========================================== */
        
        /* 1. Fondo general */
        body {
            animation: aparecerFondo 0.5s ease-out forwards;
        }

        /* 2. La barra lateral y la barra superior solo aparecen (Fade-in) para no romper el diseño */
        nav, .dashboard .top {
            opacity: 0;
            animation: aparecerSuave 0.6s ease-out forwards;
        }

        /* 3. SOLO el contenido central se desliza hacia arriba elegantemente */
        .dash-content {
            opacity: 0;
            animation: deslizarArriba 0.8s cubic-bezier(0.2, 1, 0.2, 1) forwards;
            animation-delay: 0.15s; /* Un ligero retraso para efecto cascada */
        }

        /* Fotogramas clave */
        @keyframes aparecerFondo {
            0% { background-color: #ffffff; }
            100% { background-color: var(--light); }
        }

        @keyframes aparecerSuave {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes deslizarArriba {
            0% { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            100% { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="imagenes/c.png" alt="Logo Creotec">
            </div>
            <span class="logo_name">CREOTEC</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="inicio.php?pagina=inicio">
                    <img src="imagenes/hogar.png" class="icono-local" alt="Inicio">
                    <span class="link-name">Inicio</span>
                </a></li>

                <?php if($acceso_ana): ?>
                    <li><a href="inicio.php?pagina=anaplastologia">
                        <img src="imagenes/anaplastologia.png" class="icono-local" alt="Anaplastología">
                        <span class="link-name">Anaplastología</span>
                    </a></li>
                <?php else: ?>
                    <li class="boton-bloqueado" onclick="alertaBloqueo()">
                        <a href="#"><img src="imagenes/anaplastologia.png" class="icono-local" alt="Anaplastología"><span class="link-name">Anaplastología 🔒</span></a>
                    </li>
                <?php endif; ?>

                <?php if($acceso_man): ?>
                    <li><a href="inicio.php?pagina=manufactura">
                        <img src="imagenes/manufactura.png" class="icono-local" alt="Manufactura">
                        <span class="link-name">Manufactura</span>
                    </a></li>
                <?php else: ?>
                    <li class="boton-bloqueado" onclick="alertaBloqueo()">
                        <a href="#"><img src="imagenes/manufactura.png" class="icono-local" alt="Manufactura"><span class="link-name">Manufactura 🔒</span></a>
                    </li>
                <?php endif; ?>

                <?php if($acceso_com): ?>
                    <li><a href="inicio.php?pagina=comercial">
                        <img src="imagenes/comercial.png" class="icono-local" alt="Comercial">
                        <span class="link-name">Comercial</span>
                    </a></li>
                <?php else: ?>
                    <li class="boton-bloqueado" onclick="alertaBloqueo()">
                        <a href="#"><img src="imagenes/comercial.png" class="icono-local" alt="Comercial"><span class="link-name">Comercial 🔒</span></a>
                    </li>
                <?php endif; ?>

                <li><a href="inicio.php?pagina=inventario">
                    <img src="imagenes/inventario.png" class="icono-local" alt="Inventario">
                    <span class="link-name">Inventario</span>
                </a></li>

                <?php if($acceso_rep): ?>
                    <li><a href="inicio.php?pagina=reportes">
                        <img src="imagenes/reportes.png" class="icono-local" alt="Reportes">
                        <span class="link-name">Reportes</span>
                    </a></li>
                <?php else: ?>
                    <li class="boton-bloqueado" onclick="alertaBloqueo()">
                        <a href="#"><img src="imagenes/reportes.png" class="icono-local" alt="Reportes"><span class="link-name">Reportes 🔒</span></a>
                    </li>
                <?php endif; ?>

                <?php if($acceso_usu): ?>
                    <li><a href="inicio.php?pagina=usuarios">
                        <img src="imagenes/agregar-usuario.png" class="icono-local" alt="Usuarios">
                        <span class="link-name">Gestion de Usuarios</span>
                    </a></li>
                <?php else: ?>
                    <li class="boton-bloqueado" onclick="alertaBloqueo()">
                        <a href="#"><img src="imagenes/agregar-usuario.png" class="icono-local" alt="Usuarios"><span class="link-name">Usuarios 🔒</span></a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <img src="imagenes/salida.png" class="icono-local" alt="Salir">
                    <span class="link-name">Cerrar Sesión</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <img src="imagenes/luna.png" class="icono-local" alt="Modo">
                        <span class="mode-text text">Modo Oscuro</span>
                    </a>
                    <div class="mode-toggle">
                      <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <img src="imagenes/barra.png" class="sidebar-toggle icono-top" alt="Menu">        
            
            <div class="perfil-usuario">
                <span class="nombre-perfil">
                    <?php 
                        // Mostramos el nombre completo, o el usuario por defecto
                        echo isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo'] : $_SESSION['usuario_activo']; 
                    ?>
                </span>
                <img src="imagenes/usuario-robot.png" class="profile-pic" alt="Foto Perfil">
            </div>
        </div>

        <?php
        switch ($pagina) {
            case 'inicio':
                include_once 'vistas/vistas-inicio.php';
                break;
                
            case 'manufactura':
                include_once 'vistas/vistas-manufactura.php';
                break;
            
            case 'anaplastologia':
                include_once 'vistas/vistas-anaplastologia.php';
                break;
            
            case 'ana_moldes':
                echo '<div class="dash-content"><h3>Módulo: Búsqueda de Moldes (Próximamente)</h3></div>';
                break;
            case 'ana_inventario':
                echo '<div class="dash-content"><h3>Módulo: Inventario de Anaplastología (Próximamente)</h3></div>';
                break;
            case 'ana_procesos':
                echo '<div class="dash-content"><h3>Módulo: Control de Procesos (Próximamente)</h3></div>';
                break;
            case 'ana_rendimiento':
                include_once 'vistas/vistas-rendimiento.php';
                break;

            case 'comercial':
                include_once 'vistas/vistas-comercial.php';
                break;
                
            case 'inventario':
                include_once 'vistas/vistas-inventario.php';
                break;                
                
            case 'reportes':
                echo '<div class="dash-content"><h3>Módulo Reportes (Próximamente)</h3></div>';
                break;

            case 'usuarios':
                include_once 'vistas/vistas-usuarios.php';
                break;

            default:
                include_once 'vistas/vistas-inicio.php';
                break;
        }
        ?>
    </section>

    <script>
        function alertaBloqueo() {
            Swal.fire({
                icon: 'warning',
                title: 'Acceso Restringido',
                text: 'No tienes los permisos necesarios para ingresar a esta área.',
                confirmButtonColor: '#03045E'
            });
        }
    </script>

    <script src="js/inicio.js"></script>
    <script src="js/moldes.js?v=<?php echo time(); ?>"></script>
    <script src="js/buscar-moldes.js"></script>
    <script src="js/rendimiento.js"></script>
    <script src="js/inventario.js"></script>

</body>
</html>