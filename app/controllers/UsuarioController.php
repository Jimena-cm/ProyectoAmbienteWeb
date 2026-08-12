<?php


class UsuarioController extends Controller
{
    private $usuarioModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->usuarioModel = $this->model('Usuario');
    }

    public function index()
    {
        $this->view('admin/usuarios');
    }

    public function apiList()
    {
        header('Content-Type: application/json');

        $usuarios = $this->usuarioModel->getAll();

        echo json_encode($usuarios);
    }
}