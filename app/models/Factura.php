<?php
require_once '../app/config/Database.php';

class Factura {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM factura ORDER BY id DESC";
        $result = $this->db->query($query);

        $facturas = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $facturas[] = $row;
            }
        }

        return $facturas;
    }

    public function getById($id) {
        $query = "SELECT * FROM factura WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO factura (fecha, total, estado, user_id)
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "sdsi",
            $data['fecha'],
            $data['total'],
            $data['estado'],
            $data['user_id']
        );

        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE factura
                  SET fecha = ?, total = ?, estado = ?, user_id = ?
                  WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "sdsii",
            $data['fecha'],
            $data['total'],
            $data['estado'],
            $data['user_id'],
            $id
        );

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM factura WHERE id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}