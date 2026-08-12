<?php
require_once '../app/config/Database.php';

class Placa {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM placa ORDER BY id DESC";
        $result = $this->db->query($query);
        $placas = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $placas[] = $row;
            }
        }
        return $placas;
    }

    public function getById($id) {
        $query = "SELECT * FROM placa WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getDisponibles() {
        $query = "SELECT id, nombre, descripcion, material, tamano, precio, imagen_nombre, categoria_id
                  FROM placa
                  WHERE disponible = 1
                  ORDER BY nombre ASC";
        $result = $this->db->query($query);
        $placas = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $placas[] = $row;
            }
        }
        return $placas;
    }

    public function getDestacadas($limite = 4) {
        $limite = (int) $limite;

        $query = "SELECT id, nombre, descripcion, material, tamano, precio, imagen_nombre, categoria_id
                  FROM placa
                  WHERE disponible = 1 AND destacado = 1
                  ORDER BY id DESC
                  LIMIT $limite";

        $result = $this->db->query($query);
        $placas = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $placas[] = $row;
            }
        }
        return $placas;
    }

    public function create($data) {
        $query = "INSERT INTO placa (nombre, descripcion, material, tamano, precio, imagen_nombre, disponible, destacado, categoria_id)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        $disponible = isset($data['disponible']) ? (int) $data['disponible'] : 1;
        $destacado = isset($data['destacado']) ? (int) $data['destacado'] : 0;

        $stmt->bind_param(
            "ssssdsiii",
            $data['nombre'],
            $data['descripcion'],
            $data['material'],
            $data['tamano'],
            $data['precio'],
            $data['imagen_nombre'],
            $disponible,
            $destacado,
            $data['categoria_id']
        );

        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE placa
                  SET nombre = ?, descripcion = ?, material = ?, tamano = ?, precio = ?,
                      imagen_nombre = ?, disponible = ?, destacado = ?, categoria_id = ?
                  WHERE id = ?";
        $stmt = $this->db->prepare($query);

        $disponible = isset($data['disponible']) ? (int) $data['disponible'] : 1;
        $destacado = isset($data['destacado']) ? (int) $data['destacado'] : 0;

        $stmt->bind_param(
            "ssssdsiiii",
            $data['nombre'],
            $data['descripcion'],
            $data['material'],
            $data['tamano'],
            $data['precio'],
            $data['imagen_nombre'],
            $disponible,
            $destacado,
            $data['categoria_id'],
            $id
        );

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM placa WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}