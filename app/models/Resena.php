<?php
require_once '../app/config/Database.php';

class Resena {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

public function getAll() {
    $query = "SELECT * FROM resenas ORDER BY id DESC";
    $result = $this->db->query($query);

    $resenas = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $resenas[] = $row;
        }
    }

    return $resenas;
}

public function create($data) {
    $query = "INSERT INTO resenas (nombre, comentario, calificacion)
              VALUES (?, ?, ?)";

    $stmt = $this->db->prepare($query);

    $stmt->bind_param(
        "ssi",
        $data['nombre'],
        $data['comentario'],
        $data['calificacion']
    );

    return $stmt->execute();
}
}