<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../../Login/Login.php');
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../models/Reserva.php';

if (!isset($_GET['id'])) {
    header('Location: ListarReservas.php');
    exit;
}

$reservaModel = new Reserva($pdo);
$reservaModel->cancelar($_GET['id']);

header('Location: ListarReservas.php');
exit;
