<?php

session_start();
require_once('conexion.php');

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['password'] === $password) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        echo json_encode([
            'success' => true,
            'message' => 'Proceso exitoso',
            'user' => $user['name']
        ]);

    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Credenciales incorrectas.'
        ]);
    }

} else {

    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido.'
    ]);
}

?>