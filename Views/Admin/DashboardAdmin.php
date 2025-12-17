<?php
session_start();

// ======================
// Validar acceso admin
// ======================
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../Login/Login.php?error=Acceso denegado');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

<header class="admin-header">
    <h1>Panel de Administrador</h1>
    <p>Bienvenido <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></p>

    <a href="../../controllers/AuthController.php?action=logout"
       class="btn btn-danger">
        Cerrar sesión
    </a>
</header>

<main class="admin-container">

    <div class="admin-options">

        <!-- HOME -->
        <div class="admin-card">
            <i class="fas fa-home fa-3x"></i>
            <h3>Ir al Home</h3>
            <p>Visualiza la página pública del restaurante</p>
            <a href="../Home/Home.php" class="btn btn-primary">
                Ver Home
            </a>
        </div>

        <!-- USUARIOS -->
        <div class="admin-card">
            <i class="fas fa-users fa-3x"></i>
            <h3>Gestión de Usuarios</h3>
            <p>Administra los usuarios del sistema</p>
            <a href="Usuarios/ListarUsuario.php" class="btn btn-primary">
                Gestionar
            </a>
        </div>

        <!-- RESERVAS -->
        <div class="admin-card">
            <i class="fas fa-calendar-alt fa-3x"></i>
            <h3>Gestión de Reservas</h3>
            <p>Administra las reservas de mesas</p>
            <a href="Reservas/ListarReservas.php" class="btn btn-primary">
                Gestionar
            </a>
        </div>

    </div>

</main>

</body>
</html>
