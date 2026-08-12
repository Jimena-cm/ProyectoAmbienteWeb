<?php

class FacturaController extends Controller {
    private $facturaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->facturaModel = $this->model('Factura');
    }

    public function index() {
        $this->view('admin/facturas');
    }

    public function apiList() {
        header('Content-Type: application/json');

        echo json_encode(
            $this->facturaModel->getAll()
        );
    }

    public function apiShow($id) {
        header('Content-Type: application/json');

        $factura = $this->facturaModel->getById($id);

        if ($factura) {
            echo json_encode([
                'success' => true,
                'data' => $factura
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Factura no encontrada'
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
            empty($data['fecha']) ||
            !isset($data['total']) ||
            empty($data['estado']) ||
            !isset($data['user_id'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Fecha, total, estado y usuario son requeridos'
            ]);

            return;
        }

        $resultado = $this->facturaModel->create($data);

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Factura creada correctamente'
                : 'Error al crear la factura',
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');

        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        if (
            empty($data['fecha']) ||
            !isset($data['total']) ||
            empty($data['estado']) ||
            !isset($data['user_id'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Fecha, total, estado y usuario son requeridos'
            ]);

            return;
        }

        $resultado = $this->facturaModel->update(
            $id,
            $data
        );

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Factura actualizada correctamente'
                : 'Error al actualizar la factura',
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');

        $resultado = $this->facturaModel->delete($id);

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Factura eliminada correctamente'
                : 'Error al eliminar la factura',
        ]);
    }
}