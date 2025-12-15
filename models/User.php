<?php

class Usuario {

    private $pdo;

    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

 
    public function crear($data) {
        $sql = "INSERT INTO usuarios 
                (nombre, correo, telefono, fecha_nacimiento, contrasena, rol_id)
                VALUES 
                (:nombre, :correo, :telefono, :fecha_nacimiento, :contrasena, :rol_id)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':correo' => $data['correo'],
            ':telefono' => $data['telefono'],
            ':fecha_nacimiento' => $data['fecha_nacimiento'],
            ':contrasena' => $data['contrasena'],
            ':rol_id' => $data['rol_id'] ?? 1 // Rol por defecto: Usuario
        ]);
    }

    // ============================
    // Obtener usuario por correo
    // ============================
    public function obtenerPorCorreo($correo) {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':correo' => $correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ============================
    // Obtener usuario por ID
    // ============================
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ============================
    // Verificar correo existente
    // ============================
    public function correoExiste($correo) {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE correo = :correo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':correo' => $correo]);
        return $stmt->fetchColumn() > 0;
    }
}
