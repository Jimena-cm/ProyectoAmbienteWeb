<?php
require_once '../app/core/Controller.php';

class ContactoController extends Controller {
    private $contactoModel;

    public function __construct() {
        session_start();

        $this->contactoModel = $this->model('Contacto');
    }

    public function index() {
        $this->view('contacto/index');
    }

    public function apiList() {
        header('Content-Type: application/json');

        $contactos = $this->contactoModel->getAll();

        echo json_encode($contactos);
    }

    public function apiStore() {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if(
            empty($data['nombre']) ||
            empty($data['email']) ||
            empty($data['mensaje'])
        ){
            echo json_encode([
                'success' => false,
                'message' => 'Nombre, email y mensaje son requeridos'
            ]);
            return;
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            echo json_encode([
                'success' => false,
                'message' => 'El correo electrónico no es válido'
            ]);
            return;
        }

        $result = $this->contactoModel->create($data);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Mensaje de contacto creado correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al crear el mensaje de contacto'
            ]);
        }
    }

    public function apiShow($id) {
        header('Content-Type: application/json');

        $contacto = $this->contactoModel->getById($id);

        if($contacto){
            echo json_encode([
                'success' => true,
                'data' => $contacto
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Mensaje de contacto no encontrado'
            ]);
        }
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if(
            empty($data['nombre']) ||
            empty($data['email']) ||
            empty($data['mensaje'])
        ){
            echo json_encode([
                'success' => false,
                'message' => 'Nombre, email y mensaje son requeridos'
            ]);
            return;
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            echo json_encode([
                'success' => false,
                'message' => 'El correo electrónico no es válido'
            ]);
            return;
        }

        $result = $this->contactoModel->update($id, $data);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Mensaje de contacto actualizado correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar el mensaje de contacto'
            ]);
        }
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');

        $result = $this->contactoModel->delete($id);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Mensaje de contacto eliminado correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al eliminar el mensaje de contacto'
            ]);
        }
    }
}