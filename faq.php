<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Preguntas Frecuentes | La Casa de la Placa</title>

    
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

  
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="faq-page">

        <section class="faq-container">

            
            <div class="faq-header">

                <img
                    src="./img/logo.jpg"
                    alt="Logo de La Casa de la Placa"
                    class="faq-logo"
                >

                <span class="faq-label">
                    CENTRO DE AYUDA
                </span>

                <h1>Preguntas frecuentes</h1>

                <p>
                    Encuentra respuestas rápidas sobre nuestros productos,
                    pedidos y servicios.
                </p>

            </div>

            <!-- Preguntas -->
            <div class="accordion faq-accordion" id="faqAccordion">

                <!-- Pregunta 1 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta1"
                        >
                            ¿Cuánto tarda la fabricación de una placa?
                        </button>

                    </h2>

                    <div
                        id="pregunta1"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#faqAccordion"
                    >

                        <div class="accordion-body">
                            El tiempo de fabricación depende del tipo de placa
                            y del nivel de personalización solicitado. Te
                            informaremos el tiempo estimado al confirmar tu pedido.
                        </div>

                    </div>

                </div>


                <!-- Pregunta 2 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta2"
                        >
                            ¿Puedo personalizar mi placa?
                        </button>

                    </h2>

                    <div
                        id="pregunta2"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion"
                    >

                        <div class="accordion-body">
                            Sí. Contamos con diferentes opciones de
                            personalización según el producto disponible.
                        </div>

                    </div>

                </div>


                <!-- Pregunta 3 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta3"
                        >
                            ¿Cómo puedo consultar el estado de mi pedido?
                        </button>

                    </h2>

                    <div
                        id="pregunta3"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion"
                    >

                        <div class="accordion-body">
                            Puedes consultar tus pedidos desde la sección
                            <strong>Mi Historial</strong> dentro de tu cuenta.
                        </div>

                    </div>

                </div>


                <!-- Pregunta 4 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta4"
                        >
                            ¿Realizan envíos?
                        </button>

                    </h2>

                    <div
                        id="pregunta4"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion"
                    >

                        <div class="accordion-body">
                            Sí. Las opciones de entrega pueden variar según
                            la ubicación del cliente.
                        </div>

                    </div>

                </div>


                <!-- Pregunta 5 -->
                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#pregunta5"
                        >
                            ¿Qué hago si necesito ayuda con mi pedido?
                        </button>

                    </h2>

                    <div
                        id="pregunta5"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion"
                    >

                        <div class="accordion-body">
                            Puedes comunicarte con nosotros mediante nuestro
                            formulario de contacto y nuestro equipo te ayudará.
                        </div>

                    </div>

                </div>

            </div>

            
            <div class="faq-help">

                <div>
                    <h3>¿No encontraste tu respuesta?</h3>

                    <p>
                        Nuestro equipo de atención al cliente está para ayudarte.
                    </p>
                </div>

                <a
                    href="contacto.php"
                    class="btn btn-primary"
                >
                    CONTACTARNOS
                </a>

            </div>

        
            <div class="text-center mt-4">

                <a
                    href="dashboard.php"
                    class="faq-back"
                >
                     Volver al panel
                </a>

            </div>

        </section>

    </main>


    
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>

</html>