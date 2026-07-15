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


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    echo json_encode([
        "success" => false,
        "message" => "Método no permitido."
    ]);

    exit();
}


$userId = $_SESSION["user_id"];

$name = trim($_POST["name"] ?? "");

$email = trim($_POST["email"] ?? "");

$phone = trim($_POST["phone"] ?? "");

$address = trim($_POST["address"] ?? "");


if ($name === "" || $email === "") {

    echo json_encode([
        "success" => false,
        "message" => "El nombre y el correo son obligatorios."
    ]);

    exit();
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo json_encode([
        "success" => false,
        "message" => "El correo electrónico no es válido."
    ]);

    exit();
}


try {

    $stmt = $pdo->prepare(
        "SELECT profile_image
         FROM users
         WHERE id = ?"
    );

    $stmt->execute([$userId]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    $profileImage =
        $user["profile_image"] ?? "usuario.jpg";


    // Revisar si el usuario subió una imagen
    if (
        isset($_FILES["profile_image"]) &&
        $_FILES["profile_image"]["error"] === UPLOAD_ERR_OK
    ) {

        $file = $_FILES["profile_image"];

        $allowedTypes = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/webp" => "webp"
        ];


        $fileType = mime_content_type(
            $file["tmp_name"]
        );


        if (!isset($allowedTypes[$fileType])) {

            echo json_encode([
                "success" => false,
                "message" => "La imagen debe ser JPG, PNG o WEBP."
            ]);

            exit();
        }


        if ($file["size"] > 2 * 1024 * 1024) {

            echo json_encode([
                "success" => false,
                "message" => "La imagen no puede superar los 2 MB."
            ]);

            exit();
        }


        $extension = $allowedTypes[$fileType];


        $profileImage =
            "usuario_" .
            $userId .
            "_" .
            time() .
            "." .
            $extension;


        $uploadPath =
            "../uploads/" .
            $profileImage;


        if (
            !move_uploaded_file(
                $file["tmp_name"],
                $uploadPath
            )
        ) {

            echo json_encode([
                "success" => false,
                "message" => "No se pudo guardar la imagen."
            ]);

            exit();
        }
    }


    $stmt = $pdo->prepare(
        "UPDATE users
         SET
            name = ?,
            email = ?,
            phone = ?,
            address = ?,
            profile_image = ?
         WHERE id = ?"
    );


    $stmt->execute([
        $name,
        $email,
        $phone,
        $address,
        $profileImage,
        $userId
    ]);


    $_SESSION["user_name"] = $name;

    $_SESSION["profile_image"] =
        $profileImage;


    echo json_encode([
        "success" => true,
        "message" => "Perfil actualizado correctamente.",
        "profile_image" => $profileImage
    ]);


} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "message" => "El correo ingresado ya está registrado."
    ]);
}

?>