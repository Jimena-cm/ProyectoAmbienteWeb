<?php
require_once '../app/config/Database.php';

class Carrito {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM venta ORDER BY nombre ASC";
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
        $query = "SELECT * FROM venta WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO venta (cantidad, precio, material_id, tamano_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssii", $data['cantidad'], $data['precio'], $data['material_id'], $data['tamano_id']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE venta SET cantidad = ?, precio = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssi", $data['cantidad'], $data['precio'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM venta WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}