<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

$usuarioModel = new Usuario($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'nombre'           => trim($_POST['nombre']),
        'correo'           => trim($_POST['correo']),
        'telefono'         => $_POST['telefono'] ?? null,
        'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
        'contrasena'       => $_POST['contrasena'],
        'confirm'          => $_POST['confirm']
    ];

    // Validaciones
    if (empty($data['nombre']) || empty($data['correo']) || empty($data['contrasena'])) {
        header("Location: ../Views/Login/Register.php?error=Campos obligatorios vacíos");
        exit;
    }

    if ($data['contrasena'] !== $data['confirm']) {
        header("Location: ../Views/Login/Register.php?error=Las contraseñas no coinciden");
        exit;
    }

    // Encriptar contraseña
    $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);

    // Validar correo
    if ($usuarioModel->correoExiste($data['correo'])) {
        header("Location: ../Views/Login/Register.php?error=Correo ya registrado");
        exit;
    }

    // Crear usuario
    if ($usuarioModel->crear($data)) {
        header("Location: ../Views/Login/Login.php?success=Registro exitoso");
        exit;
    }

    header("Location: ../Views/Login/Register.php?error=Error al registrar");
    exit;
}
