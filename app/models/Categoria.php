<?php
require_once '../app/config/Database.php';

class Categoria {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM categoria ORDER BY nombre ASC";
        $result = $this->db->query($query);
        $categorias = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categorias[] = $row;
            }
        }
        return $categorias;
    }

    public function getById($id) {
        $query = "SELECT * FROM categoria WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO categoria (nombre, descripcion) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $data['nombre'], $data['descripcion']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE categoria SET nombre = ?, descripcion = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssi", $data['nombre'], $data['descripcion'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM categoria WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}