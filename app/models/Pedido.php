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


    private function obtenerPlacaPersonalizadaId()
    {
        $query = "SELECT id FROM placa WHERE categoria_id = 3";

        $result = $this->db->query($query);
        $placa = $result->fetch_assoc();

        return $placa ? $placa['id'] : null;
    }


    public function crear($userId, $carrito, $total)
    {
        $query = "INSERT INTO factura
                  (fecha, total, estado, user_id)
                  VALUES (CURDATE(), ?, 'pendiente', ?)";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "di",
            $total,
            $userId
        );

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

            $placaId = $this->obtenerPlacaPersonalizadaId();


            if (!$materialId || !$tamanoId || !$placaId) {
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
                $placaId,
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

        $stmt->bind_param(
            "i",
            $userId
        );

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


    public function obtenerTodos()
    {
        $query = "SELECT
                    f.id AS factura_id,
                    f.fecha,
                    f.total,
                    f.estado,
                    f.user_id,
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
                  ORDER BY f.fecha_creacion DESC, f.id DESC";


        $result = $this->db->query($query);

        $pedidos = [];


        while ($row = $result->fetch_assoc()) {

            $facturaId = $row['factura_id'];


            if (!isset($pedidos[$facturaId])) {

                $pedidos[$facturaId] = [
                    'id' => $facturaId,
                    'fecha' => $row['fecha'],
                    'total' => $row['total'],
                    'estado' => $row['estado'],
                    'user_id' => $row['user_id'],
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
public function apiConfirmar()
{
    header('Content-Type: application/json');

    $data = json_decode(
        file_get_contents('php://input'),
        true
    );

    if (
        empty($data['carrito']) ||
        !isset($data['total'])
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'El carrito está vacío'
        ]);

        return;
    }

    $pedidoId = $this->pedidoModel->crear(
        $_SESSION['user_id'],
        $data['carrito'],
        $data['total']
    );

    if ($pedidoId) {

        echo json_encode([
            'success' => true,
            'message' => 'Pedido registrado correctamente'
        ]);

    } else {

        echo json_encode([
            'success' => false,
            'message' => 'No se pudo registrar el pedido'
        ]);
    }
}

    public function eliminar($id)
    {
        $query = "DELETE FROM factura WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param(
            "i",
            $id
        );

        return $stmt->execute();
    }
}