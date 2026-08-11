<?php
$pageTitle = 'Reseñas | La Casa de la Placa';
$activePage = 'resena';

require_once '../app/views/layouts/header.php';
?>

<div class="reviews-page">

    <section class="reviews-container">

        <div class="reviews-header">

            <img
                src="<?= BASE_URL ?>img/logo.jpg"
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


            <aside class="review-form-card">

                <h2>Comparte tu experiencia</h2>

                <p>
                    Tu opinión nos ayuda a seguir mejorando.
                </p>

                <form id="frmResena">

                    <div class="mb-3">

                        <label for="nombre" class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label for="calificacion" class="form-label">
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

                            <option value="5">★★★★★ Excelente</option>
                            <option value="4">★★★★☆ Muy buena</option>
                            <option value="3">★★★☆☆ Buena</option>
                            <option value="2">★★☆☆☆ Regular</option>
                            <option value="1">★☆☆☆☆ Mala</option>

                        </select>

                    </div>


                    <div class="mb-3">

                        <label for="comentario" class="form-label">
                            Comentario
                        </label>

                        <textarea
                            class="form-control"
                            id="comentario"
                            name="comentario"
                            rows="5"
                            required
                        ></textarea>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary w-100 p-2"
                    >
                        PUBLICAR RESEÑA
                    </button>

                </form>

            </aside>

        </div>

    </section>

</div>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= ROOT_URL ?>js/resenas.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>