<?php
session_start();

// Vaciar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al login
header("Location: ../Login/Login.php");
exit;
