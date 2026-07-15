document.addEventListener("DOMContentLoaded", function () {

    const listaResenas =
        document.querySelector("#listaResenas");

    const formResena =
        document.querySelector("#frmResena");

    const msgResena =
        document.querySelector("#msgResena");

    function cargarResenas() {

        fetch("./backend/resenas.php")
            .then(response => response.json())
            .then(resultado => {

                if (!resultado.success) {
                    listaResenas.innerHTML = `
                        <div class="alert alert-danger">
                            ${resultado.message}
                        </div>
                    `;
                    return;
                }

                const resenas = resultado.resenas;

                if (resenas.length === 0) {

                    listaResenas.innerHTML = `
                        <div class="reviews-empty">
                            <h3>Aún no hay reseñas</h3>
                            <p>
                                Sé la primera persona en compartir
                                tu experiencia.
                            </p>
                        </div>
                    `;
                    return;
                }

                let html = "";

                resenas.forEach(resena => {
                    const estrellas =
                        "★".repeat(resena.calificacion)
                        +
                        "☆".repeat(5 - resena.calificacion);

                    html += `

                        <article class="review-card">

                            <div class="review-card-top">

                                <div class="review-avatar">

                                    ${resena.nombre.charAt(0).toUpperCase()}

                                </div>
                                <div>
                                    <h3>
                                        ${resena.nombre}
                                    </h3>

                                    <div class="review-stars">
                                        ${estrellas}
                                    </div>
                                
                                </div>
                            </div>

                            <p class="review-comment">
                                ${resena.comentario}
                            </p>
                        </article>`;
                });


                listaResenas.innerHTML = html;

            })

            .catch(error => {

                console.log("Error:", error);

                listaResenas.innerHTML = `
                    <div class="alert alert-danger">
                        Error al cargar las reseñas.
                    </div>
                `;

            });

    }


    formResena.addEventListener(
        "submit",
        function (event) {

            event.preventDefault();


            const datos =
                new FormData(formResena);


            fetch("./backend/agregar_resena.php", {

                method: "POST",

                body: datos

            })

                .then(response => response.json())

                .then(resultado => {

                    msgResena.textContent =
                        resultado.message;


                    if (resultado.success) {

                        msgResena.className =
                            "alert alert-success";

                        formResena.reset();

                        cargarResenas();

                    } else {

                        msgResena.className =
                            "alert alert-danger";
                    }

                })

                .catch(error => {

                    console.log("Error:", error);


                    msgResena.textContent =
                        "Error al publicar la reseña.";


                    msgResena.className =
                        "alert alert-danger";

                });

        }
    );


    cargarResenas();

});