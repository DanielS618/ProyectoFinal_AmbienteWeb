<?php
session_start();

// ======================
// Validar acceso admin
// ======================
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../../Login/Login.php?error=Acceso denegado');
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../models/Reserva.php';

$reservaModel = new Reserva($pdo);
$reservas = $reservaModel->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Reservas</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<header>
    <h1>Gestión de Reservas</h1>
    <div style="display:flex; gap:15px; align-items:center;">
        <a href="../DashboardAdmin.php" class="btn btn-secondary">
            Volver
        </a>
    </div>
</header>

<main>
    <div class="gestion-container">

        <!-- Botón crear reserva -->
        <div style="margin-bottom:20px;">
            <a href="CrearReserva.php" class="btn btn-primary">
                Crear Reserva
            </a>
        </div>

        <!-- Tabla de reservas -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Personas</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php if (!empty($reservas)): ?>
                <?php foreach ($reservas as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r['id']) ?></td>
                        <td><?= htmlspecialchars($r['nombre_usuario']) ?></td>
                        <td><?= htmlspecialchars($r['capacidad']) ?></td>
                        <td><?= htmlspecialchars($r['fecha']) ?></td>
                        <td><?= htmlspecialchars($r['hora']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($r['estado'])) ?></td>
                        <td>
                            <a href="EditarReserva.php?id=<?= $r['id'] ?>"
                               class="edit-btn">
                               Editar
                            </a>

                            <?php if ($r['estado'] === 'activa'): ?>
                                <a href="EliminarReserva.php?id=<?= $r['id'] ?>"
                                   class="delete-btn"
                                   onclick="return confirm('¿Cancelar esta reserva?')">
                                   Cancelar
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center;">
                        No hay reservas registradas
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>

    </div>
</main>

</body>
</html>
