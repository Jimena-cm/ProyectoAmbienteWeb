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
            producto,
            fecha,
            estado
         FROM historial
         WHERE user_id = ?
         ORDER BY fecha DESC"
    );

    $stmt->execute([
        $_SESSION['user_id']
    ]);


    $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode([
        'success' => true,
        'historial' => $historial
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'No fue posible cargar el historial'
    ]);
}