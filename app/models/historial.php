<?php
require_once '../app/config/Database.php';

class Historial {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM historial ORDER BY id DESC";
        $result = $this->db->query($query);

        $historial = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $historial[] = $row;
            }
        }

        return $historial;
    }

    public function getById($id) {
        $query = "SELECT * FROM historial WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO historial
                  (user_id, producto, fecha, estado)
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "isss",
            $data['user_id'],
            $data['producto'],
            $data['fecha'],
            $data['estado']
        );

        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE historial
                  SET user_id = ?,
                      producto = ?,
                      fecha = ?,
                      estado = ?
                  WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "isssi",
            $data['user_id'],
            $data['producto'],
            $data['fecha'],
            $data['estado'],
            $id
        );

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM historial WHERE id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}