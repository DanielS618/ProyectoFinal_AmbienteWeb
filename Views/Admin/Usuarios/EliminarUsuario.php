<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol_id'] != 2) {
    header('Location: ../../Login/Login.php?error=Acceso denegado');
    exit;
}

require_once __DIR__ . '/../../../models/User.php';
require_once __DIR__ . '/../../../config/database.php';

$usuarioModel = new Usuario($pdo);

$id = $_GET['id'] ?? null;
if ($id) {
    $usuarioModel->eliminar($id);
}

header('Location: ListarUsuario.php');
exit;
