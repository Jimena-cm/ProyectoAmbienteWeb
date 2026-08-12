<?php
require_once '../app/core/Controller.php';

class AuthController extends Controller {
    public function __construct() {
        session_start();
    }

    public function index() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }
        $this->view('auth/login');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');
            $user = $userModel->getByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                $this->redirect('dashboard');
            } else {
                $this->view('auth/login', ['error' => 'Credenciales incorrectas']);
            }
        } else {
            $this->redirect('auth/index');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? ''
            ];

            $userModel = $this->model('User');

            if (!empty($data['name']) && !empty($data['email']) && !empty($data['password'])) {

                if ($userModel->getByEmail($data['email'])) {
                    $this->view('auth/registro', ['error' => 'El email ya está registrado']);
                    return;
                }

                $result = $userModel->create($data);

                if ($result) {
                    $this->redirect('auth/index');
                } else {
                    $this->view('auth/registro', ['error' => 'Error al registrar el usuario']);
                }

            } else {
                $this->view('auth/registro', ['error' => 'Nombre, email y contraseña son obligatorios']);
            }

        } else {
            $this->view('auth/registro');
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('auth/index');
    }
}