<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>

    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="../assets/css/StyleSheet.css">
</head>

<body>

<section id="registro" aria-labelledby="registro-title">
    <h2 id="registro-title">Registro de Usuario</h2>

    <div class="form-card" role="form" aria-describedby="registro-desc">
        <p id="registro-desc" class="muted">
            Crea una cuenta para recibir ofertas y gestionar reservas fácilmente.
        </p>

        <!-- MENSAJE DE ERROR DESDE PHP -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form
            id="register-form"
            method="POST"
            action="../../controllers/AuthController.php?action=register"
            novalidate
        >


            <!-- Nombre -->
            <div class="form-row">
                <label for="nombre">Nombre completo *</label>
                <input id="nombre" name="nombre" type="text"
                       placeholder="Ej. Ana María" required>
            </div>

            <!-- Email -->
            <div class="form-row">
                <label for="correo">Correo electrónico *</label>
                <input id="correo" name="correo" type="email"
                       placeholder="correo@ejemplo.com" required>
            </div>

            <!-- Teléfono + Fecha nacimiento -->
            <div class="row-flex">

                <div class="form-row">
                    <label for="telefono">Teléfono (opcional)</label>
                    <input id="telefono" name="telefono" type="tel"
                           placeholder="8888-8888">
                </div>

                <div class="form-row">
                    <label for="fecha_nacimiento">Fecha de nacimiento (opcional)</label>
                    <input id="fecha_nacimiento" name="fecha_nacimiento" type="date">
                </div>

            </div>

            <!-- Contraseña -->
            <div class="form-row">
                <label for="contrasena">Contraseña *</label>
                <input id="contrasena" name="contrasena" type="password"
                       placeholder="Mín. 8 caracteres" required>
            </div>

            <!-- Confirmación -->
            <div class="form-row">
                <label for="confirm">Confirmar contraseña *</label>
                <input id="confirm" name="confirm" type="password" required>
            </div>

            <!-- Términos -->
            <div class="form-row" style="align-items:center;">
                <label style="display:flex; gap:8px; align-items:center;">
                    <input id="terms" name="terms" type="checkbox" required>
                    <span>
                        Acepto los
                        <a href="#" target="_blank">términos y condiciones</a>
                    </span>
                </label>
            </div>

            <!-- Botón -->
            <div style="display:flex; gap:12px; align-items:center; margin-top:8px;">
                <button id="btn-register" type="submit">Registrarse</button>

                <a href="Login.php">
                    Volver al inicio de sesión
                </a>
            </div>

        </form>
    </div>
</section>

<script src="../assets/js/formulario.js"></script>

</body>
</html>
