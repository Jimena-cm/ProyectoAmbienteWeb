<?php
class TamanoController extends Controller {
    private $tamanoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->tamanoModel = $this->model('Tamano');
    }

    public function index() {
        $this->view('admin/tamanos');
    }

    public function apiList() {
        header('Content-Type: application/json');
        echo json_encode($this->tamanoModel->getAll());
    }

    public function apiShow($id) {
        header('Content-Type: application/json');
        $tamano = $this->tamanoModel->getById($id);

        if ($tamano) {
            echo json_encode(['success' => true, 'data' => $tamano]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tamaño no encontrado']);
        }
    }

    public function apiStore() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['dimensiones']) || !isset($data['precio_adicional'])) {
            echo json_encode(['success' => false, 'message' => 'Dimensiones y precio adicional son requeridos']);
            return;
        }

        $resultado = $this->tamanoModel->create($data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Tamaño creado correctamente' : 'Error al crear el tamaño',
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['dimensiones']) || !isset($data['precio_adicional'])) {
            echo json_encode(['success' => false, 'message' => 'Dimensiones y precio adicional son requeridos']);
            return;
        }

        $resultado = $this->tamanoModel->update($id, $data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Tamaño actualizado correctamente' : 'Error al actualizar el tamaño',
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');
        $resultado = $this->tamanoModel->delete($id);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Tamaño eliminado correctamente' : 'Error al eliminar el tamaño',
        ]);
    }
}