<?php

class VentaController extends Controller {
    private $ventaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->ventaModel = $this->model('Venta');
    }

    public function index() {
        $this->view('admin/ventas');
    }

    public function apiList() {
        header('Content-Type: application/json');

        echo json_encode(
            $this->ventaModel->getAll()
        );
    }

    public function apiShow($id) {
        header('Content-Type: application/json');

        $venta = $this->ventaModel->getById($id);

        if ($venta) {
            echo json_encode([
                'success' => true,
                'data' => $venta
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Venta no encontrada'
            ]);
        }
    }

    public function apiStore() {
        header('Content-Type: application/json');

        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        if (
            !isset($data['cantidad']) ||
            !isset($data['precio']) ||
            !isset($data['factura_id']) ||
            !isset($data['placa_id']) ||
            !isset($data['material_id']) ||
            !isset($data['tamano_id'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ]);

            return;
        }

        $resultado = $this->ventaModel->create($data);

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Venta creada correctamente'
                : 'Error al crear la venta',
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');

        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        if (
            !isset($data['cantidad']) ||
            !isset($data['precio']) ||
            !isset($data['factura_id']) ||
            !isset($data['placa_id']) ||
            !isset($data['material_id']) ||
            !isset($data['tamano_id'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ]);

            return;
        }

        $resultado = $this->ventaModel->update(
            $id,
            $data
        );

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Venta actualizada correctamente'
                : 'Error al actualizar la venta',
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');

        $resultado = $this->ventaModel->delete($id);

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Venta eliminada correctamente'
                : 'Error al eliminar la venta',
        ]);
    }
}