<?php

session_start();

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/conexion.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Usuario no autenticado'
    ]);

    exit;
}

try {

    $stmt = $pdo->prepare(
        "SELECT
            id,
            name,
            email,
            phone,
            address,
            created_at,
            profile_image
         FROM users
         WHERE id = ?"
    );

    $stmt->execute([
        $_SESSION['user_id']
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(404);

        echo json_encode([
            'success' => false,
            'message' => 'Usuario no encontrado'
        ]);

        exit;
    }

    $stmtHistorial = $pdo->prepare(
        "SELECT COUNT(*) AS total
         FROM historial
         WHERE user_id = ?"
    );

    $stmtHistorial->execute([
        $_SESSION['user_id']
    ]);

    $pedidos = $stmtHistorial->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'user' => $user,
        'pedidos' => (int) $pedidos['total']
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'No fue posible cargar el perfil'
    ]);
}