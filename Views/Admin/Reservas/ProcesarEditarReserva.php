<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../../Login/Login.php');
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../models/Reserva.php';
require_once __DIR__ . '/../../../models/ReservaDisponible.php';

$reservaId = $_POST['reserva_id'];
$reservaDisponibleId = $_POST['reserva_disponible_id'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$estado = $_POST['estado'];

$reservaModel = new Reserva($pdo);
$disponibleModel = new ReservaDisponible($pdo);

// Actualizar fecha y hora
$disponibleModel->actualizarFechaHora($reservaDisponibleId, $fecha, $hora);

// Actualizar estado
$reservaModel->actualizarEstado($reservaId, $estado);

header('Location: ListarReservas.php?success=Reserva actualizada');
exit;
