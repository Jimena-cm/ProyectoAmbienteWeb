<?php
class CategoriaController extends Controller {
    private $categoriaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->categoriaModel = $this->model('Categoria');
    }

    public function index() {
        $this->view('admin/categorias');
    }

    public function apiList() {
        header('Content-Type: application/json');
        echo json_encode($this->categoriaModel->getAll());
    }

    public function apiShow($id) {
        header('Content-Type: application/json');
        $categoria = $this->categoriaModel->getById($id);

        if ($categoria) {
            echo json_encode(['success' => true, 'data' => $categoria]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Categoría no encontrada']);
        }
    }

    public function apiStore() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['nombre'])) {
            echo json_encode(['success' => false, 'message' => 'El nombre es requerido']);
            return;
        }

        $resultado = $this->categoriaModel->create($data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Categoría creada correctamente' : 'Error al crear la categoría',
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['nombre'])) {
            echo json_encode(['success' => false, 'message' => 'El nombre es requerido']);
            return;
        }

        $resultado = $this->categoriaModel->update($id, $data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Categoría actualizada correctamente' : 'Error al actualizar la categoría',
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');
        $resultado = $this->categoriaModel->delete($id);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Categoría eliminada correctamente' : 'Error al eliminar la categoría',
        ]);
    }
}