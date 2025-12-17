<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reseñas – Delfín Blanco</title>

    <!-- Hoja de estilos principal -->
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/Views/assets/css/StyleSheet.css">
</head>

<body>

<section id="review-section" class="auth-container">
    <div class="auth-card form-card">

        <!-- ENCABEZADO DEL MÓDULO -->
        <div class="auth-header">
            <h2 class="auth-title">Deja tu Reseña</h2>
            <p class="auth-subtitle">Tu opinión es importante para nosotros</p>
        </div>

        <!-- MENSAJES ENVIADOS DESDE ReviewController -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </p>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <p class="success">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </p>
        <?php endif; ?>

        <!-- FORMULARIO DE RESEÑA -->
        <!--
            method="POST"  → envía datos al servidor
            action         → apunta al ReviewController
        -->
        <form
            id="reviewForm"
            class="auth-body"
            method="POST"
            action="/ProyectoFinal_AmbienteWeb/controllers/ReviewController.php?action=crear"
        >

            <!-- CAMPO NOMBRE -->
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

            <!-- CAMPO DESCRIPCIÓN -->
            <!-- IMPORTANTE:
                 El name DEBE llamarse "descripcion"
                 porque así lo espera el ReviewController -->
            <div class="form-row">
                <label for="descripcion">Comentario</label>
                <textarea
                    id="descripcion"
                    name="descripcion"
                    rows="4"
                    placeholder="Escribe tu opinión..."
                    required
                ></textarea>
            </div>

            <!-- BOTÓN DE ENVÍO -->
            <button type="submit" class="btn-auth">
                Enviar Reseña
            </button>

            <!-- VOLVER AL HOME -->
            <a href="/ProyectoFinal_AmbienteWeb/Views/Home/Home.php"
               class="auth-link"
               style="margin-top:10px;">
                Volver al inicio
            </a>

        </form>

    </div>
</section>

</body>
</html>
