<?php

class Reserva {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ============================
    // Crear reserva (Home)
    // ============================
    public function crear($usuario_id, $reserva_disponible_id) {

        try {
            $this->pdo->beginTransaction();

            // Insertar reserva
            $sql = "INSERT INTO reservas (usuario_id, reserva_disponible_id)
                    VALUES (:usuario_id, :reserva_disponible_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':usuario_id' => $usuario_id,
                ':reserva_disponible_id' => $reserva_disponible_id
            ]);

            // Marcar mesa como ocupada
            $sql = "UPDATE reservas_disponibles
                    SET estado = 'ocupada'
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $reserva_disponible_id]);

            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    // ============================
    // Obtener reservas admin
    // ============================
    public function obtenerTodas() {
        $sql = "SELECT 
                    r.id,
                    u.nombre AS nombre_usuario,
                    rd.fecha,
                    rd.hora,
                    rd.mesa,
                    rd.capacidad,
                    r.estado
                FROM reservas r
                INNER JOIN usuarios u ON r.usuario_id = u.id
                INNER JOIN reservas_disponibles rd ON r.reserva_disponible_id = rd.id
                ORDER BY rd.fecha, rd.hora";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ============================
    // Cancelar reserva (admin)
    // ============================
    public function cancelar($id) {

        try {
            $this->pdo->beginTransaction();

            // Obtener reserva_disponible_id
            $stmt = $this->pdo->prepare(
                "SELECT reserva_disponible_id FROM reservas WHERE id = :id"
            );
            $stmt->execute([':id' => $id]);
            $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reserva) {
                return false;
            }

            // Cancelar reserva
            $stmt = $this->pdo->prepare(
                "UPDATE reservas SET estado = 'cancelada' WHERE id = :id"
            );
            $stmt->execute([':id' => $id]);

            // Liberar mesa
            $stmt = $this->pdo->prepare(
                "UPDATE reservas_disponibles 
                 SET estado = 'disponible'
                 WHERE id = :id"
            );
            $stmt->execute([':id' => $reserva['reserva_disponible_id']]);

            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
    public function obtenerPorId($id)
{
    $sql = "
        SELECT 
            r.id,
            r.estado,
            r.usuario_id,
            rd.id AS reserva_disponible_id,
            rd.fecha,
            rd.hora,
            rd.mesa,
            rd.capacidad,
            u.nombre AS nombre_usuario
        FROM reservas r
        INNER JOIN reservas_disponibles rd 
            ON r.reserva_disponible_id = rd.id
        INNER JOIN usuarios u 
            ON r.usuario_id = u.id
        WHERE r.id = ?
        LIMIT 1
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public function actualizarEstado($id, $estado)
{
    $stmt = $this->pdo->prepare(
        "UPDATE reservas SET estado = ? WHERE id = ?"
    );
    return $stmt->execute([$estado, $id]);
}

}
