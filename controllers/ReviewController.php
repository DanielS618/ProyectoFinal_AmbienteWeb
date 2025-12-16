<?php
/**
 * ReviewController
 * Controlador encargado de gestionar las reseñas
 */

session_start();

// ===============================
// Dependencias
// ===============================
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/ReviewModel.php';

// Instancia del modelo
$reviewModel = new ReviewModel($pdo);

// Acción recibida por GET
$action = $_GET['action'] ?? '';

// ===============================
// RUTEO DE ACCIONES
// ===============================
switch ($action) {

    // ===============================
    // CREAR RESEÑA
    // ===============================
    case 'crear':

        // Solo se permite POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ../Views/Resenas/Resena.php');
            exit;
        }

        // Verificar sesión activa
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ../Views/Login/Login.php?error=Debes iniciar sesión');
            exit;
        }

        // Datos del formulario
        $nombre      = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $usuario_id  = $_SESSION['usuario_id'];

        // Validaciones
        if ($nombre === '' || $descripcion === '') {
            header('Location: ../Views/Resenas/Resena.php?error=Todos los campos son obligatorios');
            exit;
        }

        // Datos para el modelo
        $data = [
            'usuario_id'  => $usuario_id,
            'nombre'      => $nombre,
            'descripcion' => $descripcion
        ];

        // Guardar reseña
        if ($reviewModel->crear($data)) {
            header('Location: ../Views/Resenas/Resena.php?success=Reseña enviada correctamente');
            exit;
        }

        // Error al guardar
        header('Location: ../Views/Resenas/Resena.php?error=Error al guardar la reseña');
        exit;

    // ===============================
    // LISTAR RESEÑAS
    // ===============================
    case 'listar':

        // Obtener todas las reseñas
        $resenas = $reviewModel->obtenerTodas();

        // Enviar a la vista correspondiente
        require_once __DIR__ . '/../Views/Resenas/ListaResenas.php';
        exit;

    // ===============================
    // ACCIÓN POR DEFECTO
    // ===============================
    default:
        header('Location: ../Views/Home/Home.php');
        exit;
}
