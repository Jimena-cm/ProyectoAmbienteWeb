<?php
require_once '../app/config/Database.php';

class Material {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM material ORDER BY nombre ASC";
        $result = $this->db->query($query);
        $materiales = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $materiales[] = $row;
            }
        }
        return $materiales;
    }

    public function getById($id) {
        $query = "SELECT * FROM material WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO material (nombre, precio) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sd", $data['nombre'], $data['precio']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE material SET nombre = ?, precio = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sdi", $data['nombre'], $data['precio'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM material WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}