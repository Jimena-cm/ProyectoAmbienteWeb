<?php
class PlacaController extends Controller {
    private $placaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->placaModel = $this->model('Placa');
    }

    public function index() {
        $this->view('admin/placas');
    }

    public function apiList() {
        header('Content-Type: application/json');
        echo json_encode($this->placaModel->getAll());
    }

    public function apiShow($id) {
        header('Content-Type: application/json');
        $placa = $this->placaModel->getById($id);

        if ($placa) {
            echo json_encode(['success' => true, 'data' => $placa]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Placa no encontrada']);
        }
    }

    public function apiStore() {
        header('Content-Type: application/json');
        $data = $_POST;

        $nombreImagen = '';
        if (!empty($_FILES['imagen']['name'])) {
            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombreImagen = 'placa_' . uniqid() . '.' . $extension;
            move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . '/../../uploads/' . $nombreImagen);
        }
        $data['imagen_nombre'] = $nombreImagen;

        $resultado = $this->placaModel->create($data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Placa creada correctamente' : 'Error al crear la placa',
        ]);
    }

    public function apiUpdate($id) {
        header('Content-Type: application/json');
        $data = $_POST;

        if (!empty($_FILES['imagen']['name'])) {
            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombreImagen = 'placa_' . uniqid() . '.' . $extension;
            move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . '/../../uploads/' . $nombreImagen);
            $data['imagen_nombre'] = $nombreImagen;
        } else {
            $placaActual = $this->placaModel->getById($id);
            $data['imagen_nombre'] = $placaActual['imagen_nombre'] ?? '';
        }

        $resultado = $this->placaModel->update($id, $data);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Placa actualizada correctamente' : 'Error al actualizar la placa',
        ]);
    }

    public function apiDelete($id) {
        header('Content-Type: application/json');
        $resultado = $this->placaModel->delete($id);
        echo json_encode([
            'success' => (bool) $resultado,
            'message' => $resultado ? 'Placa eliminada correctamente' : 'Error al eliminar la placa',
        ]);
    }
}