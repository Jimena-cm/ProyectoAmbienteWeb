<?php

class EstadisticaController extends Controller {
    private $estadisticaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->estadisticaModel = $this->model('Estadistica');
    }

    public function index() {
        $this->view('admin/estadisticas');
    }

    public function apiList() {
        header('Content-Type: application/json');

        echo json_encode(
            $this->estadisticaModel->getAll()
        );
    }

    public function apiShow($id) {
        header('Content-Type: application/json');

        $estadistica = $this->estadisticaModel->getById($id);

        if ($estadistica) {
            echo json_encode([
                'success' => true,
                'data' => $estadistica
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Estadística no encontrada'
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
            empty($data['description']) ||
            empty($data['value'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Descripción y valor son requeridos'
            ]);

            return;
        }

        $resultado = $this->estadisticaModel->create($data);

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Estadística creada correctamente'
                : 'Error al crear la estadística'
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');

        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        if (
            empty($data['description']) ||
            empty($data['value'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Descripción y valor son requeridos'
            ]);

            return;
        }

        $resultado = $this->estadisticaModel->update(
            $id,
            $data
        );

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Estadística actualizada correctamente'
                : 'Error al actualizar la estadística'
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');

        $resultado = $this->estadisticaModel->delete($id);

        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado
                ? 'Estadística eliminada correctamente'
                : 'Error al eliminar la estadística'
        ]);
    }
}