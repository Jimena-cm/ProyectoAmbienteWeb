<?php
session_start();

require_once "./backend/conexion.php";


$stmt = $pdo->prepare(
    "SELECT profile_image
     FROM users
     WHERE id = ?"
);

$stmt->execute([
    $_SESSION["user_id"]
]);

$usuarioActual = $stmt->fetch(PDO::FETCH_ASSOC);


$fotoPerfil = $usuarioActual["profile_image"] ?? "";


if ($fotoPerfil === "" || $fotoPerfil === "usuario.jpg") {

    $rutaFoto = "./img/usuario.jpg";
} else {

    $rutaFoto = "./uploads/" . $fotoPerfil;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProyectoAmbienteWeb/public/css/style.css">
</head>

<body class="login-body">

    <div class="login-container">

      
        <div class="login-logo-container">
            <img
                src="public/img/logo.jpg"
                alt="Logo de La Casa de la Placa"
                class="login-logo"
            >
        </div>

       
        <div class="login-header">
            <h1>LA CASA DE LA PLACA</h1>
            <h2>Recuperar contraseña</h2>
            <p>Ingresa tu correo y crea una nueva contraseña</p>
        </div>

        <form id="frmRecuperar">

            <div class="mb-3">
                <label for="email" class="form-label">
                    Correo electrónico
                </label>

                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="correo@ejemplo.com"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    Nueva contraseña
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Ingresa tu nueva contraseña"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">
                    Confirmar contraseña
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="confirmPassword"
                    name="confirmPassword"
                    placeholder="Confirma tu nueva contraseña"
                    required
                >
            </div>

            <small
                id="msgRecuperar"
                class="d-block mb-3"
            ></small>

            <button
                type="submit"
                class="btn btn-primary w-100 p-2"
            >
                CAMBIAR CONTRASEÑA
            </button>

            <div class="text-center mt-3">
                <a href="index.php">
                    Volver al inicio de sesión
                </a>
            </div>

        </form>

    </div>

    <script src="./js/recuperar.js"></script>

</body>

</html>