<?php

class AdminController extends Controller {
    private $resumenModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->resumenModel = $this->model('Resumen');
    }

    public function index() {
        $this->view('admin/resumen');
    }

    public function apiList() {
        header('Content-Type: application/json');

        echo json_encode(
            $this->resumenModel->getAll()
        );
    }
}