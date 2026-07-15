<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reseñas | La Casa de la Placa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="reviews-page">

        <section class="reviews-container">

           
            <div class="reviews-header">

                <img
                    src="./img/logo.jpg"
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

</body>

</html>