<?php
session_start();
require_once 'conexion.php';

//validar si la sesion existe
if(!isset($_SESSION['user_id'])){
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit;
}

//si si existe quiero que vaya a la bd
$stmt = $pdo->query("SELECT description, value FROM stats");
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($stats);


?>