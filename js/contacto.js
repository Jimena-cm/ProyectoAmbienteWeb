const formContacto =
    document.querySelector("#frmContacto");


if (formContacto) {

    formContacto.addEventListener(
        "submit",
        function (event) {

            event.preventDefault();


            const mensaje =
                document.querySelector("#msgContacto");


            const datos =
                new FormData(formContacto);


            fetch("./backend/contacto.php", {

                method: "POST",

                body: datos

            })

            .then(response => response.json())

            .then(resultado => {

                mensaje.textContent =
                    resultado.message;


                if (resultado.success) {

                    mensaje.className =
                        "alert alert-success";

                    formContacto.reset();

                } else {

                    mensaje.className =
                        "alert alert-danger";
                }

            })

            .catch(error => {

                console.log("Error:", error);


                mensaje.textContent =
                    "Error al comunicarse con el servidor.";


                mensaje.className =
                    "alert alert-danger";

            });

        }
    );

}