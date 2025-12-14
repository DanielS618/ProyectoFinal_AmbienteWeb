<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function correoExiste($correo) {
        $stmt = $this->pdo->prepare(
            "SELECT id FROM usuarios WHERE correo = ?"
        );
        $stmt->execute([$correo]);
        return $stmt->fetch();
    }

    public function crear($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios
            (nombre, correo, telefono, fecha_nacimiento, contrasena, rol_id)
            VALUES (?, ?, ?, ?, ?, 1)
        ");

        return $stmt->execute([
            $data['nombre'],
            $data['correo'],
            $data['telefono'],
            $data['fecha_nacimiento'],
            $data['contrasena']
        ]);
    }
}
