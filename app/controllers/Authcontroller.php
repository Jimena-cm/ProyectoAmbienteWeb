<?php
require_once '../app/core/Controller.php';

class AuthController extends Controller {
    public function __construct() {
        session_start();
    }

    public function index() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/user/index');
        }
        $this->view('auth/login');
    }

    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $userModel = $this->model('User');
        $user = $userModel->getByEmail($email);

        if ( $user && ( password_verify($password, $user['password']) || $password === $user['password'])) { 
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['user_name'] = $user['name'];
            $this->redirect('/../dashboard.php');
        } else {
            $this->view('auth/login', [
                'error' => 'Credenciales incorrectas'
            ]);
        }
    } else {
        $this->redirect('/auth/index');
    }
}

    public function logout() {
        session_destroy();
        $this->redirect('/auth/index');
    }
}
