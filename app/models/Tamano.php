<?php
require_once '../app/config/Database.php';

class Tamano {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM tamano ORDER BY precio_adicional ASC";
        $result = $this->db->query($query);
        $tamanos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tamanos[] = $row;
            }
        }
        return $tamanos;
    }

    public function getById($id) {
        $query = "SELECT * FROM tamano WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO tamano (dimensiones, precio_adicional) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sd", $data['dimensiones'], $data['precio_adicional']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE tamano SET dimensiones = ?, precio_adicional = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sdi", $data['dimensiones'], $data['precio_adicional'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM tamano WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}