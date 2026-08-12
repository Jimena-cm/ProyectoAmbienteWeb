<?php
class CatalogoController extends Controller {
    private $productoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->productoModel = $this->model('Producto');
    }

    public function index() {
        $this->view('catalogo/index');
    }


    public function apiList() {
        header('Content-Type: application/json');
        $productos = $this->productoModel->obtenerDisponibles();
        echo json_encode($productos);
    }

    public function apiDetalle($id) {
        header('Content-Type: application/json');
        $producto = $this->productoModel->obtenerPorId($id);

        if ($producto) {
            echo json_encode(['success' => true, 'data' => $producto]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
    }
}