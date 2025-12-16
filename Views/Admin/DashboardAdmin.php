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
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<header>
    <h1>Panel de Administrador</h1>
    <p>Bienvenido <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></p>
    <a href="../../controllers/AuthController.php?action=logout" class="btn btn-danger">Cerrar sesión</a>
</header>

<main>
    <div class="admin-options">

        <!-- Botón Home -->
        <div class="admin-card">
            <h3>Ir al Home</h3>
            <p>Visualiza la página pública del restaurante</p>
            <a href="../Home/Home.php" class="btn btn-primary">Ir al Home</a>
        </div>

        <!-- Gestión de usuarios -->
        <div class="admin-card">
            <h3>Gestión de Usuarios</h3>
            <p>Administra todos los usuarios registrados</p>
            <a href="Usuarios/ListarUsuario.php" class="btn btn-primary">Ver Usuarios</a>
        </div>

    </div>
</main>

</body>
</html>
