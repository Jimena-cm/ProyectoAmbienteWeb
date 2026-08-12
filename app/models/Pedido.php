<?php

require_once '../app/config/Database.php';

class Pedido
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    private function obtenerMaterialId($nombre)
    {
        $query = "SELECT id FROM material WHERE nombre = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();

        $result = $stmt->get_result();
        $material = $result->fetch_assoc();

        return $material ? $material['id'] : null;
    }

    private function obtenerTamanoId($dimensiones)
    {
        $query = "SELECT id FROM tamano WHERE dimensiones = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $dimensiones);
        $stmt->execute();

        $result = $stmt->get_result();
        $tamano = $result->fetch_assoc();

        return $tamano ? $tamano['id'] : null;
    }

    public function crear($userId, $carrito, $total)
    {
        $query = "INSERT INTO factura
                  (fecha, total, estado, user_id)
                  VALUES (CURDATE(), ?, 'pendiente', ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("di", $total, $userId);

        if (!$stmt->execute()) {
            return false;
        }

        $facturaId = $this->db->insert_id;

        foreach ($carrito as $producto) {

            $materialId = $this->obtenerMaterialId(
                $producto['material']
            );

            $tamanoId = $this->obtenerTamanoId(
                $producto['tamano']
            );

            if (!$materialId || !$tamanoId) {
                return false;
            }

            $queryVenta = "INSERT INTO venta
                (cantidad, precio, factura_id, placa_id, material_id, tamano_id)
                VALUES (?, ?, ?, ?, ?, ?)";

            $stmtVenta = $this->db->prepare($queryVenta);

            $stmtVenta->bind_param(
                "idiiii",
                $producto['cantidad'],
                $producto['precio'],
                $facturaId,
                $producto['id'],
                $materialId,
                $tamanoId
            );

            if (!$stmtVenta->execute()) {
                return false;
            }
        }

        return $facturaId;
    }

    public function obtenerPorUsuario($userId)
    {
        $query = "SELECT
                    f.id AS factura_id,
                    f.fecha,
                    f.total,
                    f.estado,
                    v.cantidad,
                    v.precio,
                    p.id AS placa_id,
                    p.nombre,
                    p.imagen_nombre
                  FROM factura f
                  LEFT JOIN venta v
                    ON f.id = v.factura_id
                  LEFT JOIN placa p
                    ON v.placa_id = p.id
                  WHERE f.user_id = ?
                  ORDER BY f.fecha_creacion DESC, f.id DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        $pedidos = [];

        while ($row = $result->fetch_assoc()) {

            $facturaId = $row['factura_id'];

            if (!isset($pedidos[$facturaId])) {

                $pedidos[$facturaId] = [
                    'id' => $facturaId,
                    'fecha' => $row['fecha'],
                    'total' => $row['total'],
                    'estado' => $row['estado'],
                    'productos' => []
                ];
            }

            if ($row['placa_id']) {

                $pedidos[$facturaId]['productos'][] = [
                    'id' => $row['placa_id'],
                    'nombre' => $row['nombre'],
                    'imagen_nombre' => $row['imagen_nombre'],
                    'cantidad' => $row['cantidad'],
                    'precio' => $row['precio']
                ];
            }
        }

        return array_values($pedidos);
    }
}