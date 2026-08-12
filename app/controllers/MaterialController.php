<?php
class MaterialController extends Controller {
    private $materialModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->materialModel = $this->model('Material');
    }
    public function index() {
        $this->view('admin/materiales');
    }

    public function apiList() {
        header('Content-Type: application/json');
        echo json_encode($this->materialModel->getAll());
    }

    public function apiShow($id) {
        header('Content-Type: application/json');
        $material = $this->materialModel->getById($id);

        if ($material) {
            echo json_encode(['success' => true, 'data' => $material]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Material no encontrado']);
        }
    }

    public function apiStore() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['nombre']) || !isset($data['precio'])) {
            echo json_encode(['success' => false, 'message' => 'Nombre y precio son requeridos']);
            return;
        }

        $resultado = $this->materialModel->create($data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Material creado correctamente' : 'Error al crear el material',
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['nombre']) || !isset($data['precio'])) {
            echo json_encode(['success' => false, 'message' => 'Nombre y precio son requeridos']);
            return;
        }

        $resultado = $this->materialModel->update($id, $data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Material actualizado correctamente' : 'Error al actualizar el material',
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');
        $resultado = $this->materialModel->delete($id);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Material eliminado correctamente' : 'Error al eliminar el material',
        ]);
    }
}