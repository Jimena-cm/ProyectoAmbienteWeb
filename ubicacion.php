<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ubicación | La Casa de la Placa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="location-page">

        <section class="location-container">

          
            <div class="location-header">

                <img
                    src="./img/logo.jpg"
                    alt="Logo de La Casa de la Placa"
                    class="location-logo"
                >

                <span>NUESTRA UBICACIÓN</span>

                <h1>Visítanos</h1>

                <p>
                    Encuentra fácilmente nuestras instalaciones y conoce
                    nuestro horario de atención.
                </p>

            </div>


            
            <div class="location-grid">

              
                <div class="location-info">

                    <h2>La Casa de la Placa</h2>

                    <p class="location-description">
                        Estamos para atenderte y ayudarte con tus consultas,
                        pedidos y productos personalizados.
                    </p>


                    <div class="location-detail">

                        <strong>Ubicación</strong>

                        <span>
                            Costa Rica
                        </span>

                    </div>


                    <div class="location-detail">

                        <strong>Horario de atención</strong>

                        <span>
                            Lunes a sábado
                        </span>

                        <span>
                            8:00 a.m. - 6:00 p.m.
                        </span>

                    </div>


                    <div class="location-detail">

                        <strong>Teléfono</strong>

                        <span>
                            +506 8888-8888
                        </span>

                    </div>


                    <div class="location-detail">

                        <strong>Correo electrónico</strong>

                        <span>
                            lacasadelaplaca@correo.com
                        </span>

                    </div>


                    <a
                        href="contacto.php"
                        class="btn btn-primary location-contact-button"
                    >
                        CONTACTARNOS
                    </a>

                </div>


                <!-- Mapa  de google-->
                <div class="location-map">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.5370296247293!2d-84.0859919!3d9.889153099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0e39d5ec6795d%3A0x28e8a1dffcc8764e!2sLa%20Casa%20de%20las%20placas%2F%20Fundici%C3%B3n%20Jim%C3%A9nez!5e0!3m2!1ses-419!2scr!4v1784010692876!5m2!1ses-419!2scr"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>

                </div>

            </div>


            
            <div class="text-center mt-4">

                <a
                    href="dashboard.php"
                    class="location-back"
                >
                     Volver al panel
                </a>

            </div>

        </section>

    </main>

</body>

</html>