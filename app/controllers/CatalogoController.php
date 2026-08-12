<?php
class CatalogoController extends Controller {
    private $placaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->placaModel = $this->model('Placa');
    }

    public function index() {
        $this->view('catalogo/index');
    }

    public function apiList() {
        header('Content-Type: application/json');
        $productos = $this->placaModel->getDisponibles();
        echo json_encode($productos);
    }

    public function apiDetalle($id) {
        header('Content-Type: application/json');
        $producto = $this->placaModel->getById($id);

        if ($producto && $producto['disponible']) {
            echo json_encode(['success' => true, 'data' => $producto]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
    }
}