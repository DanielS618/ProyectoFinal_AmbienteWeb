<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with FoodHut landing page.">
    <meta name="author" content="Devcrud">
    <title>Restaurante Delfin Blanco | Free Bootstrap 4.3.x template</title>

    <!-- font icons -->
    <link rel="stylesheet" href="../assets/vendors/themify-icons/css/themify-icons.css">

    <link rel="stylesheet" href="../assets/vendors/animate/animate.css">

    <!-- Bootstrap + FoodHut main styles -->
    <link rel="stylesheet" href="../assets/css/foodhut.css">
</head>

<!-- prueba git -->

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">


<!-- Navbar -->
<nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">Info</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?vista=menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="#book-table">Reservas</a></li>
        </ul>

        <a class="navbar-brand m-auto" href="#">
            <img src="img/Logo.png" class="brand-img" alt="">
            <span class="brand-txt">Restaurante Delfín Blanco</span>
        </a>

        <ul class="navbar-nav">

            <?php if (isset($_SESSION["usuario_id"]) && $_SESSION["rol_id"] == 2): ?>
                <!-- Solo para admins -->
                <li class="nav-item">
                    <a class="nav-link" href="../Admin/DashboardAdmin.php">Panel Admin</a>
                </li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="#blog"></a></li>
            <?php endif; ?>

            <li class="nav-item"><a class="nav-link" href="#testmonial">Reviews</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Contactanos</a></li>

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


    <!-- header -->
    <header id="home" class="header">
        <div class="overlay text-white text-center">
            <h1 class="display-2 font-weight-bold my-3">Delfin Blanco</h1>
            <h2 class="display-4 mb-5">Always fresh &amp; Delightful</h2>
            <a class="btn btn-lg btn-primary" href="index.php?vista=menu">Menú</a>
        </div>
    </header>

    <!--  About Section  -->
    <div id="about" class="container-fluid wow fadeIn" id="about" data-wow-duration="1.5s">
        <div class="row">
            <div class="col-lg-6 has-img-bg"></div>
            <div class="col-lg-6">
                <div class="row justify-content-center">
                    <div class="col-sm-8 py-5 my-5">
                        <h2 class="mb-4">Sobre Nosotros</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, quisquam accusantium
                            nostrum modi, nemo, officia veritatis ipsum facere maxime assumenda voluptatum enim! Labore
                            maiores placeat impedit, vero sed est voluptas!Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Expedita alias dicta autem, maiores doloremque quo perferendis, ut
                            obcaecati harum, <br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum
                            necessitatibus iste,
                            nulla recusandae porro minus nemo eaque cum repudiandae quidem voluptate magnam voluptatum?
                            <br>Nobis, saepe sapiente omnis qui eligendi pariatur. quis voluptas. Assumenda facere
                            adipisci quaerat. Illum doloremque quae omnis vitae.</p>
                        <p><b>Lonsectetur adipisicing elit. Blanditiis aspernatur, ratione dolore vero asperiores
                                explicabo.</b></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ab itaque modi, reprehenderit
                            fugit soluta, molestias optio repellat incidunt iure sed deserunt nemo magnam rem explicabo
                            vitae. Cum, nostrum, quidem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <!--  gallary Section  -->
    <div id="gallary" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <h2 class="section-title">Nuestro Menu</h2>
    </div>
    
    <div class="gallary row">
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/1.jpeg" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/2.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/3.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/4.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/5.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/6.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/7.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/8.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/9.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/10.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/11.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
        <div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">
            <img src="../assets/img/12.png" class="gallary-img">
            <a href="#" class="gallary-overlay"><i class="gallary-icon ti-plus"></i></a>
        </div>
    
    </div>

    <!-- Modal para Platillos -->
    <div id="modal-platillo" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.55); backdrop-filter:blur(3px);
    justify-content:center; align-items:center; padding:20px; z-index:9999;">

        <div
            style="background:white; padding:20px; border-radius:12px; max-width:420px; text-align:center; position:relative;">

            <button id="close-modal"
                style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:1.4rem; cursor:pointer;">
                ✖
            </button>

            <img id="modal-img" src="" alt="" style="width:100%; border-radius:8px; margin-bottom:15px;">
            <h3 id="modal-title" style="color:#ee6c4d; margin-bottom:10px;"></h3>
            <p id="modal-desc" style="color:#333;"></p>
        </div>
    </div>
    

    <!-- book a table Section  -->
    <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="book-table">
        <div class="">
            <h2 class="section-title mb-5">Reserva una Mesa</h2>
            <div class="row mb-5">
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="email" id="booktable" class="form-control form-control-lg custom-form-control"
                        placeholder="EMAIL">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="number" id="booktable" class="form-control form-control-lg custom-form-control"
                        placeholder="CANTIDAD DE PERSONAS " max="20" min="0">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="time" id="booktable" class="form-control form-control-lg custom-form-control"
                        placeholder="EMAIL">
                </div>
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="date" id="booktable" class="form-control form-control-lg custom-form-control"
                        placeholder="12/12/12">
                </div>
            </div>
            <a href="#" class="btn btn-lg btn-primary" id="rounded-btn">Encuentra una Mesa</a>
        </div>
    </div>

<!-- SECCIÓN DE RESEÑAS -->
<div id="testmonial" class="container-fluid wow fadeIn bg-dark text-light has-height-lg middle-items">

    <!-- Título de la sección -->
    <h2 class="section-title my-5 text-center">Reseñas</h2>

    <!-- BOTONES DE ACCIÓN -->
    <div class="text-center mb-4">
        <!--Botón para ir a la vista donde el usuario
            puede agregar una nueva reseña-->
        <a href="../Resenas/Resena.php" class="btn btn-primary btn-lg mr-2">
            Agregar Reseña
        </a>

        <!--Botón que solo baja a esta misma sección!-->
        <a href="#testmonial" class="btn btn-outline-light btn-lg">
            Ver Reseñas
        </a>
    </div>

    <!-- CONTENEDOR DE LAS RESEÑAS -->
    <div class="row mt-3 mb-5">

        <?php
        /*Verifica si la variable $resenas existe
            y tiene contenido.
            Esta variable viene desde ReviewModel*/
        ?>
        <?php if (!empty($resenas)): ?>

            <?php
            /*Recorre todas las reseñas obtenidas
                desde la base de datos*/
            ?>
            <?php foreach ($resenas as $r): ?>

                <!-- Cada reseña ocupa una columna -->
                <div class="col-md-4 my-3 my-md-0">
                    <div class="testmonial-card">

                        <!--Nombre escrito en la reseña
                            (campo: resenas.nombre)-->
                        <h3 class="testmonial-title">
                            <?php echo htmlspecialchars($r['nombre']); ?>
                        </h3>

                        <!-- Nombre del usuario que la escribió
                            (campo: usuarios.nombre)-->
                        <h6 class="testmonial-subtitle">
                            <?php echo htmlspecialchars($r['nombre_usuario']); ?>
                        </h6>

                        <!--Texto de la reseña (campo: resenas.descripcion)-->
                        <div class="testmonial-body">
                            <p>
                                <?php echo htmlspecialchars($r['descripcion']); ?>
                            </p>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <!-- Mensaje si aún no existen reseñas -->
            <div class="col-12 text-center">
                <p>No hay reseñas todavía.</p>
            </div>

        <?php endif; ?>

    </div>
</div>




    <!-- CONTACT Section  -->
    <div id="contact" class="container-fluid bg-dark text-light border-top wow fadeIn">
        <div class="row">
            <div class="col-md-6 px-0">
                <div id="map" style="width: 100%; height: 100%; min-height: 400px"></div>
            </div>
            <div class="col-md-6 px-5 has-height-lg middle-items">
                <h3>Encuentranos</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, laboriosam doloremque odio delectus,
                    sunt magnam laborum impedit molestiae, magni quae ipsum, ullam eos! Alias suscipit impedit et,
                    adipisci illo quam.</p>
                <div class="text-muted">
                    <p><span class="ti-location-pin pr-3"></span> GMPV+QPX Frente Hotel Oro Verde, Puntarenas Province,
                        Puerto Jiménez</p>
                    <p><span class="ti-support pr-3"></span> (506) 8888-8888</p>
                    <p><span class="ti-email pr-3"></span>info@website.com</p>
                </div>
            </div>
        </div>
    </div>

    <!-- page footer  -->
    <div class="container-fluid bg-dark text-light has-height-md middle-items border-top text-center wow fadeIn">
        <div class="row">
            <div class="col-sm-4">
                <h3>EMAIL</h3>
                <P class="text-muted">info@website.com</P>
            </div>
            <div class="col-sm-4">
                <h3>Contactanos</h3>
                <P class="text-muted">(506) 8888-8888</P>
            </div>
            <div class="col-sm-4">
                <h3>Encuentranos</h3>
                <P class="text-muted">GMPV+QPX Frente Hotel Oro Verde, Puntarenas Province, Puerto Jiménez</P>
            </div>
        </div>
    </div>
    <div class="bg-dark text-light text-center border-top wow fadeIn">
        <p class="mb-0 py-3 text-muted small">&copy; Copyright
            <script>document.write(new Date().getFullYear())</script> Made with <i class="ti-heart text-danger"></i>
            ..... <a href="http://devcrud.com">....</a>
        </p>
    </div>
    <!-- end of page footer -->

    <!-- core  -->
    <script src="../assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="../assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap affix -->
    <script src="../assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- wow.js -->
    <script src="../assets/vendors/wow/wow.js"></script>

    <!-- google maps -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script>

    <!-- FoodHut js -->
    <script src="../assets/js/foodhut.js"></script>
    <script src="../assets/js/modalMenu.js"></script>

</body>

</html>