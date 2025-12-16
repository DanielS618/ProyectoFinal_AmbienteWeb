<?php
session_start();

// Validar acceso admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../Login/Login.php?error=Acceso denegado');
    exit;
}

require_once __DIR__ . '/../../../models/User.php';
require_once __DIR__ . '/../../../config/database.php';

$usuarioModel = new Usuario($pdo);
$usuarios = $usuarioModel->obtenerTodos(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<header>
    <h1>Gestión de Usuarios</h1>
    <div style="display: flex; align-items: center; gap: 20px;">
        <span>Bienvenido <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
        <a href="../../controllers/AuthController.php?action=logout" class="btn btn-danger">Cerrar sesión</a>
    </div>
</header>

<main>
    <div class="gestion-container">
        <!-- Botones de acción -->
        <div style="margin-bottom: 20px; display: flex; gap: 10px;">
            <a href="../DashboardAdmin.php" class="btn btn-secondary">Volver al Dashboard</a>
            <a href="CrearUsuario.php" class="btn btn-primary">Crear Usuario</a>
        </div>


        <!-- Tabla de usuarios -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Fecha Nacimiento</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['id']) ?></td>
                        <td><?= htmlspecialchars($u['nombre']) ?></td>
                        <td><?= htmlspecialchars($u['correo']) ?></td>
                        <td><?= htmlspecialchars($u['telefono']) ?></td>
                        <td><?= htmlspecialchars($u['fecha_nacimiento']) ?></td>
                        <td><?= $u['rol_id'] == 2 ? 'Administrador' : 'Cliente' ?></td>
                        <td>
                            <a href="EditarUsuario.php?id=<?= $u['id'] ?>" class="edit-btn">Editar</a>
                            <a href="EliminarUsuario.php?id=<?= $u['id'] ?>" class="delete-btn">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>


</body>
</html>
