<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menú | Restaurante Delfín Blanco</title>

    <!-- font icons -->
    <link rel="stylesheet" href="../assets/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/animate/animate.css">

    <!-- Bootstrap + FoodHut main styles -->
    <link rel="stylesheet" href="../assets/css/foodhut.css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40">

<!-- Navbar -->
<nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php?vista=home">Home</a></li>
            <li class="nav-item"><a class="nav-link active" href="index.php?vista=menu">Menus</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?vista=home#book-table">Reservas</a></li>
        </ul>

        <a class="navbar-brand m-auto" href="index.php?vista=home">
            <img src="img/Logo.png" class="brand-img" alt="">
            <span class="brand-txt">Restaurante Delfín Blanco</span>
        </a>

        <ul class="navbar-nav">
            <?php if (isset($_SESSION["usuario_id"])): ?>
                <li class="nav-item">
                    <span class="nav-link text-light">
                        Bienvenido <?= htmlspecialchars($_SESSION["usuario_nombre"]) ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a href="../../controllers/AuthController.php?action=logout" class="btn btn-danger ml-xl-2">
                        Cerrar sesión
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a href="../Login/Login.php" class="btn btn-primary ml-xl-4">
                        Inicio Sesión
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- HEADER MENÚ -->
<header class="header">
    <div class="overlay text-white text-center">
        <h1 class="display-3 font-weight-bold">Nuestro Menú</h1>
        <p class="lead mt-3">Descubre nuestros platillos</p>
    </div>
</header>

<!-- CONTENIDO MENÚ (PLACEHOLDER) -->
<div class="container my-5">
    <div class="row text-center">
        <div class="col-12">
            <h2 class="mb-4">Próximamente</h2>
            <p class="text-muted">
                Aquí se mostrarán los platillos del restaurante.
            </p>
        </div>
    </div>
</div>

<!-- FOOTER -->
<div class="bg-dark text-light text-center border-top">
    <p class="mb-0 py-3 text-muted small">
        &copy; <?php echo date('Y'); ?> Restaurante Delfín Blanco
    </p>
</div>

<!-- core -->
<script src="../assets/vendors/jquery/jquery-3.4.1.js"></script>
<script src="../assets/vendors/bootstrap/bootstrap.bundle.js"></script>
<script src="../assets/vendors/bootstrap/bootstrap.affix.js"></script>
<script src="../assets/vendors/wow/wow.js"></script>
<script src="../assets/js/foodhut.js"></script>

</body>
</html>