<?php
session_start();
// Si ya hay una sesión activa, lo mandamos directo al inicio
if (isset($_SESSION['usuario_activo'])) {
    header("Location: inicio.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creotec - Acceso al Sistema</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="css/estilos_login.css">
</head>
<body class="login-bg">

    <div class="blur-bg-overlay"></div>

    <div class="form-popup">
        <div class="form-box login">
            <div class="form-details">
                <h2>Bienvenido a CREOTEC</h2>
                <p>Inicie sesión utilizando su usuario para acceder al panel de control del sistema.</p>
            </div>
            <div class="form-content">
                <h2>INICIAR SESIÓN</h2>
                <form action="login.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="usuario" required>
                        <label>Usuario</label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" required>
                        <label>Contraseña</label>
                    </div>
                    <button type="submit">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const formPopup = document.querySelector(".form-popup");
        const signupLink = document.querySelector("#signup-link");
        const loginLink = document.querySelector("#login-link");

        // Agregué un condicional "if" para evitar errores si no estás usando el formulario de registro actualmente
        if (signupLink) {
            signupLink.addEventListener("click", (e) => {
                e.preventDefault();
                formPopup.classList.add("show-signup");
            });
        }

        if (loginLink) {
            loginLink.addEventListener("click", (e) => {
                e.preventDefault();
                formPopup.classList.remove("show-signup");
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ANIMACIONES FLUIDAS Y ELEGANTES PARA LA ALERTA */
        div:where(.swal2-container) div:where(.swal2-popup).swal2-show {
            animation: entradaSuave 0.6s cubic-bezier(0.2, 1, 0.2, 1) !important;
        }
        div:where(.swal2-container) div:where(.swal2-popup).swal2-hide {
            animation: salidaSuave 0.4s cubic-bezier(0.2, 1, 0.2, 1) !important;
        }

        @keyframes entradaSuave {
            0% { opacity: 0; transform: scale(0.85) translateY(20px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        @keyframes salidaSuave {
            0% { opacity: 1; transform: scale(1) translateY(0); }
            100% { opacity: 0; transform: scale(0.85) translateY(20px); }
        }
    </style>

    <?php if(isset($_GET['error'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tipoError = '<?php echo $_GET['error']; ?>';
            
            // 1. CONFIGURACIÓN ANTI-SALTOS
            const configAlerta = {
                confirmButtonColor: '#03045E',
                heightAuto: false,        // Evita que el formulario salte hacia arriba
                scrollbarPadding: false   // Evita que el formulario se mueva a los lados
            };
            
            // 2. DISPARAR LA ALERTA SEGÚN EL ERROR
            if(tipoError === 'inactivo') {
                Swal.fire({ ...configAlerta, icon: 'warning', title: 'Acceso Denegado', text: 'Tu cuenta está desactivada. Por favor, contacta al administrador.' });
            } 
            else if(tipoError === 'clave') {
                Swal.fire({ ...configAlerta, icon: 'error', title: 'Contraseña Incorrecta', text: 'La contraseña ingresada no es válida.' });
            } 
            else if(tipoError === 'usuario') {
                Swal.fire({ ...configAlerta, icon: 'error', title: 'Usuario No Encontrado', text: 'El nombre de usuario no existe en el sistema.' });
            }
            // ---> ESTE ES EL NUEVO BLOQUE DE INACTIVIDAD <---
            else if(tipoError === 'timeout') {
                Swal.fire({ ...configAlerta, icon: 'info', title: 'Sesión Expirada', text: 'Por tu seguridad, la sesión se cerró automáticamente tras 10 minutos de inactividad.' });
            }

            // Limpiamos la URL silenciosamente
            window.history.replaceState(null, null, window.location.pathname);
        });
    </script>
    <?php endif; ?>

</body>
</html>