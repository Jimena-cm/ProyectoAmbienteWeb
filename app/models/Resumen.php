<?php
require_once '../app/config/Database.php';

class Resumen {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM stats ORDER BY id ASC";
        $result = $this->db->query($query);

        $resumen = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resumen[] = $row;
            }
        }

        return $resumen;
    }
}