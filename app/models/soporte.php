<?php
require_once '../app/config/Database.php';

class Soporte {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM soporte ORDER BY id DESC";
        $result = $this->db->query($query);
        $soportes = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $soportes[] = $row;
            }
        }

        return $soportes;
    }

    public function getById($id) {
        $query = "SELECT * FROM soporte WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO soporte (nombre_completo, telefono, correo, mensaje_soporte)
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "ssss",
            $data['nombre_completo'],
            $data['telefono'],
            $data['correo'],
            $data['mensaje_soporte']
        );

        if($stmt->execute()) {
            return $this->db->insert_id;
        }

        return false;
    }

    public function update($id, $data) {
        $query = "UPDATE soporte
                  SET nombre_completo = ?, telefono = ?, correo = ?, mensaje_soporte = ?
                  WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "ssssi",
            $data['nombre_completo'],
            $data['telefono'],
            $data['correo'],
            $data['mensaje_soporte'],
            $id
        );

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM soporte WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}