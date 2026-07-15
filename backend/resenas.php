<?php

require_once "conexion.php";

header("Content-Type: application/json");


try {

    $stmt = $pdo->query(
        "SELECT
            id,
            nombre,
            comentario,
            calificacion
         FROM resenas
         ORDER BY id DESC"
    );


    $resenas =
        $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode([
        "success" => true,
        "resenas" => $resenas
    ]);


} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "message" => "No se pudieron cargar las reseñas."
    ]);
}

?>