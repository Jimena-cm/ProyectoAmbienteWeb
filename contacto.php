<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contacto | La Casa de la Placa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="contact-page">

        <section class="contact-container">

            
            <div class="contact-header">
                <img
                    src="./img/logo.jpg"
                    alt="Logo de La Casa de la Placa"
                    class="contact-logo"
                >

                <span>ATENCIÓN AL CLIENTE</span>

                <h1>Estamos para ayudarte</h1>

                <p>
                    Envíanos tu consulta y nuestro equipo se pondrá
                    en contacto contigo.
                </p>
            </div>


            <div class="contact-grid">

                
                <div class="contact-info">

                    <h2>Información de contacto</h2>

                    <p class="contact-description">
                        ¿Tienes alguna consulta sobre nuestros productos
                        o pedidos? Comunícate con nosotros.
                    </p>

                    <div class="contact-detail">
                        <strong>Correo electrónico</strong>
                        <span>lacasadelaplaca@correo.com</span>
                    </div>

                    <div class="contact-detail">
                        <strong>Teléfono</strong>
                        <span>+506 8888-8888</span>
                    </div>

                    <div class="contact-detail">
                        <strong>Horario de atención</strong>
                        <span>Lunes a sábado</span>
                        <span>8:00 a.m. - 6:00 p.m.</span>
                    </div>

                    <div class="contact-detail">
                        <strong>Ubicación</strong>

                        <a href="ubicacion.php">
                            Ver nuestra ubicación →
                        </a>
                    </div>


                    <!-- Redes sociales PENDIENTE-->
                    <div class="social-section">

                        <h3>Síguenos</h3>

                        <div class="social-links">

                            <a href="#" class="social-link">
                                Facebook
                            </a>

                            <a href="#" class="social-link">
                                Instagram
                            </a>

                            <a href="#" class="social-link">
                                WhatsApp
                            </a>

                        </div>

                    </div>

                </div>


               
                <div class="contact-form-card">

                    <h2>Envíanos un mensaje</h2>

                    <p>
                        Completa el formulario y atenderemos tu consulta.
                    </p>

                    <form id="frmContacto">

                        <div class="mb-3">

                            <label
                                for="nombre"
                                class="form-label"
                            >
                                Nombre completo
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
                                for="email"
                                class="form-label"
                            >
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

                            <label
                                for="mensaje"
                                class="form-label"
                            >
                                Mensaje
                            </label>

                            <textarea
                                class="form-control"
                                id="mensaje"
                                name="mensaje"
                                rows="6"
                                placeholder="¿Cómo podemos ayudarte?"
                                required
                            ></textarea>

                        </div>


                        <div
                            id="msgContacto"
                            class="mb-3"
                        ></div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100 p-2"
                        >
                            ENVIAR MENSAJE
                        </button>

                    </form>

                </div>

            </div>


            <div class="text-center mt-4">

                <a
                    href="dashboard.php"
                    class="contact-back"
                >
                     Volver al panel
                </a>

            </div>

        </section>

    </main>


    <script src="./js/contacto.js"></script>

</body>

</html>