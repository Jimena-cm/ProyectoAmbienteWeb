<?php
require_once '../app/config/Database.php';

class Estadistica {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM stats ORDER BY id ASC";
        $result = $this->db->query($query);

        $estadisticas = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $estadisticas[] = $row;
            }
        }

        return $estadisticas;
    }

    public function getById($id) {
        $query = "SELECT * FROM stats WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function create($data) {
        $query = "INSERT INTO stats
                  (description, value)
                  VALUES (?, ?)";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "ss",
            $data['description'],
            $data['value']
        );

        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE stats
                  SET description = ?,
                      value = ?
                  WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "ssi",
            $data['description'],
            $data['value'],
            $id
        );

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM stats WHERE id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}