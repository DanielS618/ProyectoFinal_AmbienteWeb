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

// Procesar formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = $_POST['telefono'] ?? null;
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
    $rol_id = $_POST['rol_id'] ?? 1; // 1 = Cliente, 2 = Admin
    $contrasena = $_POST['contrasena'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    $error = '';

    if (!$nombre || !$correo || !$contrasena || !$confirm) {
        $error = "Todos los campos obligatorios deben completarse.";
    } elseif ($contrasena !== $confirm) {
        $error = "Las contraseñas no coinciden.";
    } elseif ($usuarioModel->correoExiste($correo)) {
        $error = "Correo ya registrado.";
    }

    if (!$error) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $usuarioModel->crear([
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono,
            'fecha_nacimiento' => $fecha_nacimiento,
            'rol_id' => $rol_id,
            'contrasena' => $hash
        ]);
        header('Location: ListarUsuario.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<header>
    <h1>Crear Usuario</h1>
    <div>
        <span>Bienvenido <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
        <a href="../../controllers/AuthController.php?action=logout" class="btn btn-danger">Cerrar sesión</a>
    </div>
</header>

<main>
    <div class="gestion-container">
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <label>Nombre completo *</label>
            <input type="text" name="nombre" required>

            <label>Correo electrónico *</label>
            <input type="email" name="correo" required>

            <label>Teléfono</label>
            <input type="text" name="telefono">

            <label>Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento">

            <label>Rol</label>
            <select name="rol_id">
                <option value="1">Cliente</option>
                <option value="2">Administrador</option>
            </select>

            <label>Contraseña *</label>
            <input type="password" name="contrasena" required>

            <label>Confirmar contraseña *</label>
            <input type="password" name="confirm" required>

            <button type="submit" class="btn-primary">Crear Usuario</button>
            <div style="margin-top: 20px;">
                <a href="ListarUsuario.php" class="btn btn-secondary">Volver</a>
            </div>

        </form>
    </div>
</main>

</body>
</html>
