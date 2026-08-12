<?php

class HistorialController extends Controller {
    private $historialModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->historialModel = $this->model('Historial');
    }

    public function index() {
        $this->view('admin/historial');
    }

    public function apiList() {
        header('Content-Type: application/json');

        echo json_encode(
            $this->historialModel->getAll()
        );
    }

    public function apiShow($id) {
        header('Content-Type: application/json');

        $historial = $this->historialModel->getById($id);

        if ($historial) {
            echo json_encode([
                'success' => true,
                'data' => $historial
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Historial no encontrado'
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
            !isset($data['user_id']) ||
            empty($data['producto']) ||
            empty($data['fecha']) ||
            empty($data['estado'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ]);

            return;
        }

        $resultado = $this->historialModel->create($data);

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Historial creado correctamente'
                : 'Error al crear el historial',
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');

        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        if (
            !isset($data['user_id']) ||
            empty($data['producto']) ||
            empty($data['fecha']) ||
            empty($data['estado'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ]);

            return;
        }

        $resultado = $this->historialModel->update(
            $id,
            $data
        );

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Historial actualizado correctamente'
                : 'Error al actualizar el historial',
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');

        $resultado = $this->historialModel->delete($id);

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Historial eliminado correctamente'
                : 'Error al eliminar el historial',
        ]);
    }
}