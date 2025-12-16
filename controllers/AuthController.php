<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

$usuarioModel = new Usuario($pdo);

// Acción por parámetro
$action = $_GET['action'] ?? '';

switch ($action) {

    
    case 'login': //iniciar sesión

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ../Views/Login/Login.php');
            exit;
        }

        $correo     = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $contrasena = $_POST['password'];

        if (empty($correo) || empty($contrasena)) {
            header('Location: ../Views/Login/Login.php?error=Campos obligatorios');
            exit;
        }

        $usuario = $usuarioModel->obtenerPorCorreo($correo);

        // Guardar sesión
        $_SESSION['usuario_id']     = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_correo'] = $usuario['correo'];
        $_SESSION['rol_id']         = $usuario['rol_id'];

        // REDIRECCIÓN SEGÚN ROL
        if ($usuario['rol_id'] == 2) {
            // Admin → Panel de administración
            header('Location: ../Views/Admin/DashboardAdmin.php');
        } else {
            // Usuario normal → Home
            header('Location: ../Views/Home/Home.php');
        }
        exit;

    
    case 'register': //registrarse

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ../Views/Login/Register.php');
            exit;
        }

        $data = [
            'nombre'           => trim($_POST['nombre'] ?? ''),
            'correo'           => trim($_POST['correo'] ?? ''),
            'telefono'         => $_POST['telefono'] ?? null,
            'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
            'contrasena'       => $_POST['contrasena'] ?? '',
            'confirm'          => $_POST['confirm'] ?? ''
        ];

        if (empty($data['nombre']) || empty($data['correo']) || empty($data['contrasena'])) {
            header('Location: ../Views/Login/Register.php?error=Campos obligatorios');
            exit;
        }

        if ($data['contrasena'] !== $data['confirm']) {
            header('Location: ../Views/Login/Register.php?error=Contraseñas no coinciden');
            exit;
        }

        if ($usuarioModel->correoExiste($data['correo'])) {
            header('Location: ../Views/Login/Register.php?error=Correo ya registrado');
            exit;
        }

        $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);

        if ($usuarioModel->crear($data)) {
            header('Location: ../Views/Login/Login.php?success=Registro exitoso');
            exit;
        }

        header('Location: ../Views/Login/Register.php?error=Error al registrar');
        exit;

    
    case 'logout': //salir

        session_unset();
        session_destroy();

        header('Location: ../Views/Login/Login.php');
        exit;

    
    default:
        header('Location: ../Views/Login/Login.php');
        exit;
}
