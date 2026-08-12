<?php
$activePage = 'dashboard';
$pageTitle = 'Dashboard | La Casa de la Placa';
require_once '../app/views/layouts/header.php';
?>

<section class="cdp-hero">
    <div class="container">
        <p class="cdp-hero-eyebrow">Fundición Jiménez · Desde 1990</p>
        <h1 class="cdp-hero-title">Placas que <span>conservan la memoria</span></h1>

        <div id="cdpCarruselPlacas" class="carousel slide cdp-carousel" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="cdp-plaque">
                        <span class="cdp-plaque-tag">Reconocimiento</span>
                        <div class="cdp-plaque-photo-placeholder"><i class="bi bi-person-fill"></i></div>
                        <p class="cdp-plaque-name">Ejemplo de Placa Conmemorativa</p>
                        <p class="cdp-plaque-dates">1950 - 2024</p>
                        <p class="cdp-plaque-epitaph">"Un espacio para honrar la memoria de quienes marcaron
                            nuestras vidas."</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="cdp-plaque">
                        <span class="cdp-plaque-tag">Empresarial</span>
                        <div class="cdp-plaque-photo-placeholder"><i class="bi bi-award-fill"></i></div>
                        <p class="cdp-plaque-name">Reconocimiento a Trayectoria</p>
                        <p class="cdp-plaque-dates">Entregado en el 2026</p>
                        <p class="cdp-plaque-epitaph">"Placas grabadas para logros, aniversarios y hitos
                            importantes."</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="cdp-plaque">
                        <span class="cdp-plaque-tag">Mascotas</span>
                        <div class="cdp-plaque-photo-placeholder"><i class="bi bi-heart-fill"></i></div>
                        <p class="cdp-plaque-name">Placa para Mascota</p>
                        <p class="cdp-plaque-dates">Siempre en casa</p>
                        <p class="cdp-plaque-epitaph">"Detalles personalizados para recordar a tu compañero
                            fiel."</p>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#cdpCarruselPlacas"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#cdpCarruselPlacas"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#cdpCarruselPlacas" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Placa 1"></button>
                <button type="button" data-bs-target="#cdpCarruselPlacas" data-bs-slide-to="1"
                    aria-label="Placa 2"></button>
                <button type="button" data-bs-target="#cdpCarruselPlacas" data-bs-slide-to="2"
                    aria-label="Placa 3"></button>
            </div>
        </div>
    </div>
</section>

<section class="cdp-servicios">
    <div class="container">
        <p class="cdp-section-eyebrow">Qué puedes hacer aquí</p>
        <h2 class="cdp-section-title">Tres formas de crear tu placa</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="cdp-servicio-card">
                    <div class="cdp-servicio-icono"><i class="bi bi-brush"></i></div>
                    <h3>Arma tu placa</h3>
                    <p>Personaliza completamente tu placa conmemorativa o de reconocimiento. Elige material,
                        tamaño, forma, tipografía, íconos y mensaje, visualizando cada cambio en tiempo real.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cdp-servicio-card">
                    <div class="cdp-servicio-icono"><i class="bi bi-award"></i></div>
                    <h3>Reconocimientos</h3>
                    <p>Crea placas destinadas a celebrar logros, méritos o agradecimientos. Selecciona modelos
                        predefinidos, personaliza mensajes y añade elementos decorativos.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cdp-servicio-card">
                    <div class="cdp-servicio-icono"><i class="bi bi-heart"></i></div>
                    <h3>Placas para mascotas</h3>
                    <p>Diseña placas identificativas o conmemorativas para tus animales. Elige forma, tamaño,
                        material y grabado, además de íconos relacionados con mascotas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cdp-destacados">
    <div class="container">
        <p class="cdp-section-eyebrow">Catálogo</p>
        <h2 class="cdp-section-title">Productos destacados</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4" id="cdpGridDestacados">
        </div>

        <p id="cdpDestacadosVacio" class="text-center text-muted mt-4 d-none">
            Todavía no hay placas destacadas para mostrar.
        </p>

        <div class="text-center mt-4">
            <a href="<?= BASE_URL ?>catalogo" class="btn btn-outline-light rounded-pill px-4">Ver catálogo completo</a>
        </div>
    </div>
</section>

<section class="cdp-historia">
    <div class="cdp-historia-inner">
        <div class="cdp-historia-marca">
            <span class="cdp-historia-quote"></span>
            <h2>Nuestra historia</h2>
            <p class="cdp-tagline">Concepción Arriba de Alajuelita, desde 1990</p>
        </div>
        <div class="cdp-historia-texto">
            <p>
                "Fundición Jiménez" y "La Casa de la Placa" son empresas familiares fundadas
                en los años 90 en Concepción Arriba de Alajuelita, por el señor Jorge Jiménez
                Jiménez, como necesidad para sobrevivir y solventar la necesidad de placas
                conmemorativas de la zona y reconocimientos empresariales y estudiantiles.
                "La Casa de la Placa" fue creada como solución a la alta demanda de placas
                conmemorativas en pandemia, ya que los dueños actuales se dieron cuenta de que
                no daban abasto recibiendo solicitudes y produciendo. Separando las ventas de
                la producción lograron establecer una línea de negocio continua y sin problemas
                para recibir solicitudes.
            </p>
        </div>
    </div>
</section>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
    const ROOT_URL = "<?= ROOT_URL ?>";
</script>
<script src="<?= ROOT_URL ?>js/inicio.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>