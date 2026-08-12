<?php
require_once '../app/config/Database.php';

class Factura {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM factura ORDER BY fecha DESC";
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
        $query = "INSERT INTO factura (fecha, total, estado, user_id) VALUES (curdate(), ?, 'pagado', ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $data['total'], $data['user_id']);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function update($id, $data) {
        $query = "UPDATE venta SET factura_id = ? WHERE factura_id is null and user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $data['factura_id'], $data['user_id'], $id);
        return $stmt->execute();
    }

    public function traerVentas($id) {
    $query = "SELECT v.cantidad, v.precio, m.nombre AS material, t.dimensiones AS tamano
              FROM venta v
              JOIN material m ON v.material_id = m.id
              JOIN tamano t ON v.tamano_id = t.id
              WHERE v.factura_id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
    }

}