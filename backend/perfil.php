<?php

session_start();

require_once "conexion.php";

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {

    http_response_code(401);

    echo json_encode([
        "success" => false,
        "message" => "No autorizado."
    ]);

    exit();
}

$userId = $_SESSION["user_id"];

$stmt = $pdo->prepare(
    "SELECT
        id,
        name,
        email,
        phone,
        address,
        profile_image,
        created_at
     FROM users
     WHERE id = ?"
);

$stmt->execute([$userId]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {

    echo json_encode([
        "success" => false,
        "message" => "Usuario no encontrado."
    ]);

    exit();
}


/* Cantidad de pedidos */

$stmtPedidos = $pdo->prepare(
    "SELECT COUNT(*) AS total
     FROM historial
     WHERE user_id = ?"
);

$stmtPedidos->execute([$userId]);

$totalPedidos = $stmtPedidos->fetch(PDO::FETCH_ASSOC);


echo json_encode([
    "success" => true,
    "user" => $user,
    "total_pedidos" => $totalPedidos["total"]
]);

?>