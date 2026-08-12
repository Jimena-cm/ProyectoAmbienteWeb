<?php
class FacturaController extends Controller
{

    private $facturaModel;
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->facturaModel = $this->model('Factura');
    }


    public function index()
    {
        $this->view('factura/index');
    }

    public function apiList() {
        header('Content-Type: application/json');
        echo json_encode($this->facturaModel->traerVentas($_SESSION['user_id']));
    }

    public function apiShow($id) {
        header('Content-Type: application/json');
        $factura = $this->facturaModel->getById($id);

        if ($factura) {
            echo json_encode(['success' => true, 'data' => $factura]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Factura no encontrada']);
        }
    }

    public function apiUpdate($id)
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);


        $resultado = $this->facturaModel->update($id, $data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Factura actualizada correctamente' : 'Error al actualizar la factura',
        ]);
    }
}
