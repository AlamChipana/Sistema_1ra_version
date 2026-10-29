<?php
session_start();        // 1. Busca la sesión actual
session_destroy();      // 2. Destruye toda la memoria (usuario, área, tipo)
header("Location: index.php"); // 3. Patea al usuario de vuelta al login
exit();
?>