<?php
class DashboardController extends Controller {
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
        $this->view('dashboard/index');
    }

    public function apiDestacados() {
        header('Content-Type: application/json');
        $destacados = $this->productoModel->obtenerDestacados(4);
        echo json_encode($destacados);
    }
}