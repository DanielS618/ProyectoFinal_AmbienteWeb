<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../../Login/Login.php');
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../models/Reserva.php';
require_once __DIR__ . '/../../../models/ReservaDisponible.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ListarReservas.php');
    exit;
}

$reservaModel = new Reserva($pdo);
$disponibleModel = new ReservaDisponible($pdo);

$reserva = $reservaModel->obtenerPorId($id);

if (!$reserva) {
    header('Location: ListarReservas.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<header>
    <h1>Editar Reserva</h1>
    <a href="ListarReservas.php" class="btn btn-secondary">Volver</a>
</header>

<main>
<div class="gestion-container">

<form action="ProcesarEditarReserva.php" method="POST">

    <input type="hidden" name="reserva_id" value="<?= $reserva['id'] ?>">
    <input type="hidden" name="reserva_disponible_id" value="<?= $reserva['reserva_disponible_id'] ?>">

    <label>Cliente</label>
    <input type="text" value="<?= htmlspecialchars($reserva['nombre_usuario']) ?>" disabled>

    <label>Mesa</label>
    <input type="text" value="<?= htmlspecialchars($reserva['mesa']) ?>" disabled>

    <label>Capacidad</label>
    <input type="number" value="<?= $reserva['capacidad'] ?>" disabled>

    <label>Fecha</label>
    <input type="date" name="fecha" value="<?= $reserva['fecha'] ?>" required>

    <label>Hora</label>
    <input type="time" name="hora" value="<?= substr($reserva['hora'], 0, 5) ?>" required>

    <label>Estado</label>
    <select name="estado">
        <option value="activa" <?= $reserva['estado'] === 'activa' ? 'selected' : '' ?>>Activa</option>
        <option value="cancelada" <?= $reserva['estado'] === 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
    </select>

    <button type="submit" class="btn btn-primary">
        Guardar Cambios
    </button>

</form>

</div>
</main>

</body>
</html>
