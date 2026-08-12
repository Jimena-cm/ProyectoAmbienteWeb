<?php
require_once '../app/core/Controller.php';

class PerfilController extends Controller {
    private $userModel;

    public function __construct() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/index');
        }

        $this->userModel = $this->model('User');
    }

    public function index() {
        $this->view('perfil/index');
    }

    public function apiShow() {
        header('Content-Type: application/json');

        $user = $this->userModel->getById($_SESSION['user_id']);

        if($user){
            unset($user['password']);

            echo json_encode([
                'success' => true,
                'data' => $user
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }
    }

    public function apiUpdate() {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if(empty($data['name']) || empty($data['email'])){
            echo json_encode([
                'success' => false,
                'message' => 'Nombre y email son requeridos'
            ]);
            return;
        }

        $existingUser = $this->userModel->getByEmail($data['email']);

        if($existingUser && $existingUser['id'] != $_SESSION['user_id']){
            echo json_encode([
                'success' => false,
                'message' => 'El email ya está en uso por otro usuario'
            ]);
            return;
        }

        $result = $this->userModel->update(
            $_SESSION['user_id'],
            $data
        );

        if($result){
            $_SESSION['user_name'] = $data['name'];

            echo json_encode([
                'success' => true,
                'message' => 'Perfil actualizado correctamente'
            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar el perfil'
            ]);
        }
    }



    public function apiImage() {
    header('Content-Type: application/json');

    if (!isset($_FILES['profile_image'])) {
        echo json_encode([
            'success' => false,
            'message' => 'No se seleccionó ninguna imagen'
        ]);
        return;
    }

    $file = $_FILES['profile_image'];

    if ($file['error'] != 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Error al subir la imagen'
        ]);
        return;
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode([
            'success' => false,
            'message' => 'Formato de imagen no permitido'
        ]);
        return;
    }

    if ($file['size'] > 2097152) {
        echo json_encode([
            'success' => false,
            'message' => 'La imagen no puede superar los 2 MB'
        ]);
        return;
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = 'usuario_' . $_SESSION['user_id'] . '_' . time() . '.' . $extension;

    $uploadPath = '../uploads/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        $result = $this->userModel->updateProfileImage(
            $_SESSION['user_id'],
            $fileName
        );

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Foto de perfil actualizada correctamente',
                'image' => $fileName
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al guardar la imagen'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se pudo subir la imagen'
        ]);
    }
}
}