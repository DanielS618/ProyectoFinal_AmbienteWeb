CREATE DATABASE IF NOT EXISTS delfin_blanco;
USE delfin_blanco;

-- ======================================================
-- TABLA ROLES
-- ======================================================
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

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
    rol_id INT DEFAULT 1,

    FOREIGN KEY (rol_id) REFERENCES roles(id)
);

-- ======================================================
-- TABLA ESTADO (Estados generales)
-- ======================================================
CREATE TABLE estado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
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
-- TABLA RESERVAS
-- ======================================================
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    cantidad_personas INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado_id INT,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (estado_id) REFERENCES estado(id)
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
-- TABLA PEDIDOS
-- ======================================================
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado_id INT NOT NULL,   -- Pendiente, Preparación, Entregado, Cancelado
    total DECIMAL(10,2) DEFAULT 0,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (estado_id) REFERENCES estado(id)
);
-- ======================================================
-- TABLA DETALLE PEDIDOS
-- ======================================================
CREATE TABLE pedido_detalle (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);


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
