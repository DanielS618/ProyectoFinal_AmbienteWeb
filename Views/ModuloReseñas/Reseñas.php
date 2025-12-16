<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reseñas – Delfín Blanco</title>
    <link rel="stylesheet" href="../assets/css/StyleSheet.css">
</head>

<body>
<section id="review-section" class="auth-container">
    <div class="auth-card form-card">

        <div class="auth-header">
            <h2 class="auth-title">Deja tu Reseña</h2>
            <p class="auth-subtitle">Tu opinión es importante para nosotros</p>
        </div>

        <!-- MENSAJES DESDE EL CONTROLADOR -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <p class="success"><?php echo htmlspecialchars($_GET['success']); ?></p>
        <?php endif; ?>

        <!--FORMULARIO-->
        <form
            id="reviewForm"
            class="auth-body"
            method="POST"
            action="../../controllers/ReviewController.php?action=crear"
        >

            <div class="form-row">
                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    placeholder="Escribe tu nombre"
                    required
                >
            </div>

            <div class="form-row"
