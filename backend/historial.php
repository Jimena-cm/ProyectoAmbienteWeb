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
        producto,
        fecha,
        estado
     FROM historial
     WHERE user_id = ?
     ORDER BY fecha DESC"
);


$stmt->execute([$userId]);


$historial = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode([
    "success" => true,
    "historial" => $historial
]);

?>