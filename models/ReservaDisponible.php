<?php

class ReservaDisponible {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener reservas disponibles (para Home)
    public function obtenerDisponibles() {
        $sql = "SELECT * FROM reservas_disponibles
                WHERE estado = 'disponible'
                ORDER BY fecha, hora";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todas (admin)
    public function obtenerTodas() {
        $sql = "SELECT * FROM reservas_disponibles ORDER BY fecha, hora";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear reserva disponible (admin)
    public function crear($data) {
        $sql = "INSERT INTO reservas_disponibles 
                (fecha, hora, mesa, capacidad)
                VALUES (:fecha, :hora, :mesa, :capacidad)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    // Cambiar estado
    public function marcarOcupada($id) {
        $sql = "UPDATE reservas_disponibles
                SET estado = 'ocupada'
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function actualizarFechaHora($id, $fecha, $hora)
{
    $stmt = $this->pdo->prepare(
        "UPDATE reservas_disponibles 
         SET fecha = ?, hora = ? 
         WHERE id = ?"
    );
    return $stmt->execute([$fecha, $hora, $id]);
}

}
