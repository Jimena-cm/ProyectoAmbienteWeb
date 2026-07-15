<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mi Historial | La Casa de la Placa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div class="history-page">

        <div class="history-container">

            <!-- Logo -->
            <!-- <div class="history-logo">
                <img
                    src="./img/logo.jpg"
                    alt="Logo de La Casa de la Placa"
                >
            </div> -->

            <div class="history-header">
                <h1>Mi Historial</h1>

                <p>
                    Consulta los pedidos asociados a tu cuenta
                </p>
            </div>

           
            <div id="historialContenido">

                <div class="text-center py-4">
                    <p class="text-muted">
                        Cargando historial...
                    </p>
                </div>

            </div>

           
            <div class="text-center mt-4">
                <a href="dashboard.php">
                     Volver al panel
                </a>
            </div>

        </div>

    </div>

    <script src="./js/historial.js"></script>

</body>

</html>