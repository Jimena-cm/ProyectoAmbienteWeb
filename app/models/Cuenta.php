<?php
require_once '../app/config/Database.php';

class Cuenta {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT c.*, u.name AS usuario, u.email
                  FROM cuenta c
                  JOIN users u ON c.user_id = u.id
                  ORDER BY c.id DESC";

        $result = $this->db->query($query);
        $cuentas = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cuentas[] = $row;
            }
        }

        return $cuentas;
    }

    public function getById($id) {
        $query = "SELECT * FROM cuenta WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO cuenta (ubicacion, genero, user_id)
                  VALUES (?, ?, ?)";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "ssi",
            $data['ubicacion'],
            $data['genero'],
            $data['user_id']
        );

        if($stmt->execute()) {
            return $this->db->insert_id;
        }

        return false;
    }

    public function update($id, $data) {
        $query = "UPDATE cuenta
                  SET ubicacion = ?, genero = ?, user_id = ?
                  WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "ssii",
            $data['ubicacion'],
            $data['genero'],
            $data['user_id'],
            $id
        );

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM cuenta WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}