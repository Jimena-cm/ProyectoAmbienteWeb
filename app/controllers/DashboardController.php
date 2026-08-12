<?php
class DashboardController extends Controller {
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
        $this->view('dashboard/index');
    }

    public function apiDestacados() {
        header('Content-Type: application/json');
        $destacados = $this->placaModel->getDestacadas(4);
        echo json_encode($destacados);
    }
}