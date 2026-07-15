<?php

require_once "conexion.php";

header("Content-Type: application/json");


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    echo json_encode([
        "success" => false,
        "message" => "Método no permitido."
    ]);

    exit();
}


$nombre =
    trim($_POST["nombre"] ?? "");


$comentario =
    trim($_POST["comentario"] ?? "");


$calificacion =
    intval($_POST["calificacion"] ?? 0);


if (
    $nombre === "" ||
    $comentario === "" ||
    $calificacion < 1 ||
    $calificacion > 5
) {

    echo json_encode([
        "success" => false,
        "message" => "Completa correctamente todos los campos."
    ]);

    exit();
}


try {

    $stmt = $pdo->prepare(
        "INSERT INTO resenas
        (nombre, comentario, calificacion)
        VALUES (?, ?, ?)"
    );


    $stmt->execute([
        $nombre,
        $comentario,
        $calificacion
    ]);


    echo json_encode([
        "success" => true,
        "message" => "Tu reseña fue publicada correctamente."
    ]);


} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "message" => "No se pudo publicar la reseña."
    ]);
}

?>