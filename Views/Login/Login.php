<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="../assets/css/StyleSheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

<div class="auth-container">
    <div class="auth-card form-card">

        <!-- HEADER -->
        <div class="auth-header">
            <h2 class="auth-title">Iniciar Sesión</h2>
            <p class="auth-subtitle">Accede a tu cuenta</p>
        </div>

        <!-- BODY -->
        <div class="auth-body">
            <form id="login-form" method="POST" action="../../controllers/AuthController.php?action=login" novalidate>

                <div class="form-row">
                    <label for="email">Correo electrónico</label>
                    <div class="input-icon-wrapper">
                        <input type="email" id="email" name="email" required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    <small id="error-email" class="error-text"></small>
                </div>

                <div class="form-row">
                    <label for="password">Contraseña</label>
                    <div class="input-icon-wrapper">
                        <input type="password" id="password" name="password" required>
                        <i class="fas fa-lock input-icon"></i>

                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <small id="error-password" class="error-text"></small>
                </div>

                <!-- BOTÓN REAL -->
                <button type="submit" class="btn-auth">
                    <i class="fas fa-sign-in-alt"></i> Ingresar
                </button>

            </form>
        </div>

        <!-- FOOTER -->
        <div class="auth-footer">
            <p class="small">
                ¿No tienes cuenta?
                <a href="Register.php" class="auth-link">Regístrate aquí</a>
            </p>
        </div>

    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    field.type = field.type === 'password' ? 'text' : 'password';
}
</script>

<script src="../assets/js/formulario.js"></script>

</body>
</html>
