<?php

require_once "conexion.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email === "" || $password === "") {

        echo json_encode([
            "success" => false,
            "message" => "Todos los campos son obligatorios."
        ]);

        exit();
    }

    // Buscar si el usuario existe
    $stmt = $pdo->prepare(
        "SELECT id FROM users WHERE email = ?"
    );

    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {

        echo json_encode([
            "success" => false,
            "message" => "No existe una cuenta registrada con ese correo."
        ]);

        exit();
    }

    // Actualizar contraseña
    $stmt = $pdo->prepare(
        "UPDATE users
         SET password = ?
         WHERE email = ?"
    );

    $stmt->execute([
        $password,
        $email
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Contraseña actualizada correctamente."
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Método no permitido."
    ]);
}

?>