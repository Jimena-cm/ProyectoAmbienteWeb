<?php
require_once '../app/config/Database.php';

class Producto {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function obtenerDisponibles() {
        $sql = "SELECT id, nombre, descripcion, material, tamano, precio, imagen_nombre, categoria_id
                FROM placa
                WHERE disponible = 1
                ORDER BY nombre ASC";

        $resultado = $this->conn->query($sql);

        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare(
            "SELECT id, nombre, descripcion, material, tamano, precio, imagen_nombre, categoria_id
             FROM placa
             WHERE id = ? AND disponible = 1"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function obtenerDestacados($limite = 4) {
        $limite = (int) $limite;

        $sql = "SELECT id, nombre, descripcion, material, tamano, precio, imagen_nombre, categoria_id
                FROM placa
                WHERE disponible = 1 AND destacado = 1
                ORDER BY id DESC
                LIMIT $limite";

        $resultado = $this->conn->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function obtenerCategorias() {
        $resultado = $this->conn->query("SELECT id, nombre FROM categoria ORDER BY nombre ASC");
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
}