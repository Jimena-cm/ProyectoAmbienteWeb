<?php
class CarritoController extends Controller {

    private $carritoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->carritoModel = $this->model('Carrito');
    }


    public function index() {
        $this->view('carrito/index');
    }

    public function apiStore() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);


        $resultado = $this->carritoModel->create($data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Placa agregada al carrito correctamente' : 'Error al agregar la placa al carrito',
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);


        $resultado = $this->carritoModel->update($id, $data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Placa actualizada correctamente' : 'Error al actualizar la placa',
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');
        $resultado = $this->carritoModel->delete($id);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Placa eliminada correctamente' : 'Error al eliminar la placa',
        ]);
    }
}