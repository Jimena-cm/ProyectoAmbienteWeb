<?php
require_once '../app/core/Controller.php';

class SoporteController extends Controller {
    private $soporteModel;

    public function __construct() {
        session_start();

        $this->soporteModel = $this->model('Soporte');
    }

    public function index() {
        $this->view('soporte/index');
    }

    public function apiList() {
        header('Content-Type: application/json');

        $soportes = $this->soporteModel->getAll();

        echo json_encode($soportes);
    }

    public function apiStore() {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if(
            empty($data['nombre_completo']) ||
            empty($data['correo']) ||
            empty($data['mensaje_soporte'])
        ){
            echo json_encode([
                'success' => false,
                'message' => 'Nombre, correo y mensaje son requeridos'
            ]);
            return;
        }

        $result = $this->soporteModel->create($data);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Solicitud de soporte creada correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al crear la solicitud de soporte'
            ]);
        }
    }

    public function apiShow($id) {
        header('Content-Type: application/json');

        $soporte = $this->soporteModel->getById($id);

        if($soporte){
            echo json_encode([
                'success' => true,
                'data' => $soporte
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Solicitud de soporte no encontrada'
            ]);
        }
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if(
            empty($data['nombre_completo']) ||
            empty($data['correo']) ||
            empty($data['mensaje_soporte'])
        ){
            echo json_encode([
                'success' => false,
                'message' => 'Nombre, correo y mensaje son requeridos'
            ]);
            return;
        }

        $result = $this->soporteModel->update($id, $data);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Solicitud de soporte actualizada correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar la solicitud de soporte'
            ]);
        }
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');

        $result = $this->soporteModel->delete($id);

        if($result){
            echo json_encode([
                'success' => true,
                'message' => 'Solicitud de soporte eliminada correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al eliminar la solicitud de soporte'
            ]);
        }
    }
}