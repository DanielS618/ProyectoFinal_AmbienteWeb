CREATE DATABASE IF NOT EXISTS delfin_blanco;
USE delfin_blanco;

-- ======================================================
-- TABLA ROLES
-- ======================================================
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

INSERT INTO roles (nombre) VALUES
('Cliente'),
('Administrador');

-- ======================================================
-- TABLA USUARIOS
-- ======================================================
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    fecha_nacimiento DATE,
    contrasena VARCHAR(255) NOT NULL,
    rol_id INT NOT NULL DEFAULT 1,
    FOREIGN KEY (rol_id) REFERENCES roles(id)
);

-- ======================================================
-- TABLA RESEÑAS
-- ======================================================
CREATE TABLE resenas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_resena DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- ======================================================
-- TABLA RESERVAS DISPONIBLES (PRECARGADAS)
-- ======================================================
CREATE TABLE reservas_disponibles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    mesa VARCHAR(50) NOT NULL,
    capacidad INT NOT NULL,
    estado ENUM('disponible', 'ocupada') DEFAULT 'disponible'
);

-- ======================================================
-- TABLA RESERVAS (CONFIRMADAS POR USUARIOS)
-- ======================================================
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    reserva_disponible_id INT NOT NULL,
    fecha_confirmacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activa', 'cancelada') DEFAULT 'activa',

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (reserva_disponible_id) REFERENCES reservas_disponibles(id),
    UNIQUE (reserva_disponible_id)
);

-- ======================================================
-- TABLA PRODUCTOS
-- ======================================================
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    disponibilidad TINYINT(1) DEFAULT 1,
    imagen VARCHAR(255)
);

-- ======================================================
-- DATOS INICIALES: RESERVAS DISPONIBLES
-- ======================================================
INSERT INTO reservas_disponibles (fecha, hora, mesa, capacidad) VALUES
('2025-10-20', '18:00:00', 'Mesa 1', 4),
('2025-10-20', '19:00:00', 'Mesa 2', 2),
('2025-10-20', '20:00:00', 'Mesa 3', 6),
('2025-10-21', '18:30:00', 'Mesa 4', 4);


INSERT INTO estado (nombre) VALUES
('Pendiente'),
('Confirmado'),
('En Preparación'),
('Listo'),
('Entregado'),
('Cancelado');


INSERT INTO roles (nombre) VALUES
('Cliente'),
('Administrador');
