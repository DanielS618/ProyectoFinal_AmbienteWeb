<?php
session_start();

$vista = $_GET['vista'] ?? 'login';

switch ($vista) {

    case 'home':
        require 'Views/Home/Home.php';
        break;

    case 'login':
        require 'Views/Login/Login.php';
        break;

    case 'register':
        require 'Views/Login/Register.php';
        break;

    case 'resenas':
        require 'Views/ModuloResenas/Resenas.php';
        break;

    case 'logout':
        require 'controllers/logout.php';
        break;

    case 'menu':
        require 'Views/Menu/Menu.php';
        break;

    default:
        require 'Views/Login/Login.php';
        break;
}