<?php
require_once '../app/core/Controller.php';

class ResenaController extends Controller {
    private $resenaModel;

    public function __construct() {
        session_start();
        $this->resenaModel = $this->model('Resena');
    }

    public function index() {
        $this->view('resena/index');
    }

    public function apiList() {
        header('Content-Type: application/json');

        $resenas = $this->resenaModel->getAll();

        echo json_encode($resenas);
    }

    public function apiStore() {
        header('Content-Type: application/json');

        if (!isset($_SESSION['user_id'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Debes iniciar sesión para publicar una reseña'
            ]);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (
            empty($data['nombre']) ||
            empty($data['comentario']) ||
            empty($data['calificacion'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ]);
            return;
        }

       
        $result = $this->resenaModel->create($data);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Reseña publicada correctamente'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al publicar la reseña'
            ]);
        }
    }
}