<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../../Login/Login.php');
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../models/Reserva.php';

$reservaModel = new Reserva($pdo);

// Obtener usuarios (clientes)
$usuarios = $pdo->query(
    "SELECT id, nombre FROM usuarios WHERE rol_id = 1"
)->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ⚠️ OJO: este método debe existir en el modelo
    $reservaModel->crear(
        $_POST['usuario_id'],
        $_POST['cantidad_personas'],
        $_POST['fecha'],
        $_POST['hora'],
        $_POST['estado']
    );

    header('Location: ListarReservas.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Reserva</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<header>
    <h1>Nueva Reserva</h1>
    <a href="ListarReservas.php" class="btn btn-secondary">Volver</a>
</header>

<main>
<div class="gestion-container">

<form method="POST" class="admin-form">

    <label>Cliente</label>
    <select name="usuario_id" required>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id'] ?>">
                <?= htmlspecialchars($u['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Cantidad de Personas</label>
    <input type="number" name="cantidad_personas" min="1" max="20" required>

    <label>Fecha</label>
    <input type="date" name="fecha" required>

    <label>Hora</label>
    <input type="time" name="hora" required>

    <label>Estado</label>
    <select name="estado">
        <option value="activa">Activa</option>
        <option value="cancelada">Cancelada</option>
    </select>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
        <a href="ListarReservas.php" class="btn btn-secondary">
            Volver
        </a>
    </div>

</form>

</div>
</main>

</body>
</html>
