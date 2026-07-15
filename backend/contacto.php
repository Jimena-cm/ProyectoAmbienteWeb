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


$nombre = trim($_POST["nombre"] ?? "");
$email = trim($_POST["email"] ?? "");
$mensaje = trim($_POST["mensaje"] ?? "");


if ($nombre === "" || $email === "" || $mensaje === "") {

    echo json_encode([
        "success" => false,
        "message" => "Todos los campos son obligatorios."
    ]);

    exit();
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo json_encode([
        "success" => false,
        "message" => "Ingresa un correo electrónico válido."
    ]);

    exit();
}


try {

    $stmt = $pdo->prepare(
        "INSERT INTO contacto
        (nombre, email, mensaje)
        VALUES (?, ?, ?)"
    );


    $stmt->execute([
        $nombre,
        $email,
        $mensaje
    ]);


    echo json_encode([
        "success" => true,
        "message" => "Tu mensaje fue enviado correctamente."
    ]);


} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "message" => "No se pudo enviar el mensaje."
    ]);
}

?>