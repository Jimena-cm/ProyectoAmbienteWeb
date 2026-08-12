<?php

require_once '../app/config/Database.php';

class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT id, name, email, phone, address, created_at
                  FROM users
                  ORDER BY id DESC";

        $result = $this->db->query($query);

        $usuarios = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }
}