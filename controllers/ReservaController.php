<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Reserva.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../Views/Login/Login.php');
    exit;
}

$reserva_disponible_id = $_GET['id'] ?? null;

if (!$reserva_disponible_id) {
    header('Location: ../Views/Home/Home.php');
    exit;
}

$reservaModel = new Reserva($pdo);

$resultado = $reservaModel->crear(
    $_SESSION['usuario_id'],
    $reserva_disponible_id
);

if ($resultado) {
    header('Location: ../Views/Home/Home.php?success=Reserva confirmada');
} else {
    header('Location: ../Views/Home/Home.php?error=No se pudo reservar');
}
exit;
