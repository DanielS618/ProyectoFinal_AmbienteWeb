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

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: ListarUsuario.php');
    exit;
}

$usuario = $usuarioModel->obtenerPorId($id);
if (!$usuario) {
    header('Location: ListarUsuario.php');
    exit;
}

$error = '';

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = $_POST['telefono'] ?? null;
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
    $rol_id = $_POST['rol_id'] ?? 1;

    if (!$nombre || !$correo) {
        $error = "Nombre y correo son obligatorios.";
    } else {
        $usuarioModel->actualizar($id, [
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono,
            'fecha_nacimiento' => $fecha_nacimiento,
            'rol_id' => $rol_id
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
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<header>
    <h1>Editar Usuario</h1>
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
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

            <label>Correo electrónico *</label>
            <input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>

            <label>Teléfono</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">

            <label>Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($usuario['fecha_nacimiento']) ?>">

            <label>Rol</label>
            <select name="rol_id">
                <option value="1" <?= $usuario['rol_id']==1?'selected':'' ?>>Cliente</option>
                <option value="2" <?= $usuario['rol_id']==2?'selected':'' ?>>Administrador</option>
            </select>

            <button type="submit" class="btn-primary">Guardar Cambios</button>
            <div style="margin-top: 20px;">
                <a href="ListarUsuario.php" class="btn btn-secondary">Volver</a>
            </div>

        </form>
    </div>
</main>

</body>
</html>
