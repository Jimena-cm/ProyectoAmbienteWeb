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
    <title>Reseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/ProyectoAmbienteWeb/public/css/style.css">
</head>

<body class="home-body">
    <nav class="navbar navbar-expand-lg navbar-casa">

        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center gap-2" href="dashboard.php">
                <img src="public/img/logo.jpg" alt="Logo de La Casa de la Placa" class="navbar-logo">
                <span>
                    LA CASA DE LA PLACA
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            Inicio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="catalogo.php">
                            Catalogo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="disenar.php">
                            Diseñar
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="historial.php">
                            Mi historial
                        </a>
                    </li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Atención al cliente
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item" href="faq.php">
                                    Preguntas frecuentes
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="contacto.php">
                                    Contacto
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="ubicacion.php">
                                    Ubicación
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="resenas.php">
                                    Reseñas
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php">
                            Carrito
                        </a>
                    </li>

                    <!-- Mi cuenta -->
                    <li class="nav-item dropdown ms-lg-3">

                        <a class="nav-link dropdown-toggle cuenta-menu" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <img src="public/img/usuario.jpg" alt="Foto del usuario" class="cuenta-imagen">

                            <span class="cuenta-info">
                                <small>
                                    Mi cuenta
                                </small>
                                <strong>
                                    <?= htmlspecialchars($_SESSION["user_name"]) ?>
                                </strong>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="perfil.php">
                                    Información de mi cuenta
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="contacto.php">
                                    Atención al cliente
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="backend/logout.php">
                                    Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main class="reviews-page">

        <section class="reviews-container">

           
            <div class="reviews-header">

                <img
                    src="public/img/logo.jpg"
                    alt="Logo de La Casa de la Placa"
                    class="reviews-logo"
                >

                <span>OPINIONES DE NUESTROS CLIENTES</span>

                <h1>Reseñas</h1>

                <p>
                    Conoce la experiencia de nuestros clientes
                    y comparte también tu opinión.
                </p>

            </div>


            <div class="reviews-grid">

                
                <section class="reviews-list-section">

                    <div class="reviews-title">
                        <h2>Lo que dicen nuestros clientes</h2>
                    </div>

                    <div id="listaResenas">

                        <p class="text-muted">
                            Cargando reseñas...
                        </p>

                    </div>

                </section>


                <!-- forms -->
                <aside class="review-form-card">

                    <h2>Comparte tu experiencia</h2>

                    <p>
                        Tu opinión nos ayuda a seguir mejorando.
                    </p>

                    <form id="frmResena">

                        <div class="mb-3">

                            <label
                                for="nombre"
                                class="form-label"
                            >
                                Nombre
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nombre"
                                name="nombre"
                                placeholder="Tu nombre"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label
                                for="calificacion"
                                class="form-label"
                            >
                                Calificación
                            </label>

                            <select
                                class="form-select"
                                id="calificacion"
                                name="calificacion"
                                required
                            >

                                <option value="">
                                    Selecciona una calificación
                                </option>

                                <option value="5">
                                    ★★★★★ Excelente
                                </option>

                                <option value="4">
                                    ★★★★☆ Muy buena
                                </option>

                                <option value="3">
                                    ★★★☆☆ Buena
                                </option>

                                <option value="2">
                                    ★★☆☆☆ Regular
                                </option>

                                <option value="1">
                                    ★☆☆☆☆ Mala
                                </option>

                            </select>

                        </div>


                        <div class="mb-3">

                            <label
                                for="comentario"
                                class="form-label"
                            >
                                Comentario
                            </label>

                            <textarea
                                class="form-control"
                                id="comentario"
                                name="comentario"
                                rows="5"
                                placeholder="Cuéntanos sobre tu experiencia"
                                required
                            ></textarea>

                        </div>


                        <div
                            id="msgResena"
                            class="mb-3"
                        ></div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100 p-2"
                        >
                            PUBLICAR RESEÑA
                        </button>

                    </form>

                </aside>

            </div>


            <div class="text-center mt-4">

                <a
                    href="dashboard.php"
                    class="reviews-back"
                >
                     Volver al panel
                </a>

            </div>

        </section>

    </main>


    <script src="./js/resenas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>