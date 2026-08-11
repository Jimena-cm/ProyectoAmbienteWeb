<?php
require_once '../app/core/Controller.php';

class CuentaController extends Controller {
    private $cuentaModel;

    public function __construct() {
        session_start();

        $this->cuentaModel = $this->model('Cuenta');
    }

    public function index() {
        $this->view('cuenta/index');
    }

    public function apiList() {
        header('Content-Type: application/json');

        $cuentas = $this->cuentaModel->getAll();

        echo json_encode($cuentas);
    }

    public function apiStore() {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if(
            empty($data['ubicacion']) ||
            empty($data['genero']) ||
            empty($data['user_id'])
        ){
            echo json_encode([
                'success' => false,
                'message' => 'Ubicación, género y usuario son requeridos'
            ]);
            return;
        }

        $result = $this->cuentaModel->create($data);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Cuenta creada correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al crear la cuenta'
            ]);
        }
    }

    public function apiShow($id) {
        header('Content-Type: application/json');

        $cuenta = $this->cuentaModel->getById($id);

        if($cuenta){
            echo json_encode([
                'success' => true,
                'data' => $cuenta
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Cuenta no encontrada'
            ]);
        }
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if(
            empty($data['ubicacion']) ||
            empty($data['genero']) ||
            empty($data['user_id'])
        ){
            echo json_encode([
                'success' => false,
                'message' => 'Ubicación, género y usuario son requeridos'
            ]);
            return;
        }

        $result = $this->cuentaModel->update($id, $data);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Cuenta actualizada correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar la cuenta'
            ]);
        }
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');

        $result = $this->cuentaModel->delete($id);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Cuenta eliminada correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al eliminar la cuenta'
            ]);
        }
    }
}