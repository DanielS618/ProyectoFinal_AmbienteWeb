<?php

class ReviewModel {

    private $pdo;

    /**
     * Constructor
     * Recibe la conexión PDO
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // =====================================
    // Crear una nueva reseña
    // =====================================
    public function crear($data) {

        $sql = "INSERT INTO resenas 
                (usuario_id, nombre, descripcion)
                VALUES 
                (:usuario_id, :nombre, :descripcion)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':usuario_id'  => $data['usuario_id'],
            ':nombre'      => $data['nombre'],
            ':descripcion' => $data['descripcion']
        ]);
    }

    // =====================================
    // Obtener todas las reseñas
    // =====================================
    public function obtenerTodas() {

        // Uso de alias para evitar ambigüedades
        $sql = "SELECT r.*, u.nombre AS nombre_usuario
                FROM resenas r
                LEFT JOIN usuarios u ON r.usuario_id = u.id
                ORDER BY r.fecha_resena DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =====================================
    // Obtener reseñas por usuario (opcional)
    // =====================================
    public function obtenerPorUsuario($usuario_id) {

        $sql = "SELECT *
                FROM resenas
                WHERE usuario_id = :usuario_id
                ORDER BY fecha_resena DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuario_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
