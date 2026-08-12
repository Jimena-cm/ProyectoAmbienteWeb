<?php
require_once '../app/core/CarritoController.php';

class CarritoController extends Controller {
    private $carritoModel;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/index');
        }
        $this->carritoModel = $this->model('Carrito');
    }

    public function index() {
        //$users = $this->userModel->getAll();
        //$this->view('users/index', ['users' => $users]);
        $this->view('users/index');
    }

    public function apiList() {
        header('Content-Type: application/json');
        $users = $this->userModel->getAll();
        echo json_encode($users);
    }
    
    public function apiStore() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        
        if(empty ($data['name']) || empty ($data['email']) || empty ($data['password'])) {
            echo json_encode(["success" => false, "message" => 'Todos los campo sosn requeridos']);
            return;
        }

        $result = $this->carritoModel->create($data);
        if($result){
            echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error al agregar el producto al carrito']);
        }
    }

    public function apiShow($id) {
        header('Content-Type: application/json');
        $user = $this->carritoModel->getById($id);
        if($user){
            echo json_encode(['success' => true, 'data' => $user]);
        }else{
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if(empty($data['name']) || empty($data['email'])) {
            echo json_encode(['success' => false, 'message' => 'Nombre y email son requeridos']);
            return;
        }

        $result = $this->userModel->update($id, $data);
        if($result){
            echo json_encode(['success' => true, 'message' => 'Usuario actualizado']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario']);
        }

    }

    public function apiDelete($id) {
        header('Content-Type: application/json');
        $result = $this->userModel->delete($id);
        if($result){
            echo json_encode(['success' => true, 'message' => 'Usuario eliminado']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el usuario']);
        }
    }

}