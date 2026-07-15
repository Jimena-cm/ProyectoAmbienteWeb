const formRecuperar = document.querySelector("#frmRecuperar");

if (formRecuperar) {

    formRecuperar.addEventListener("submit", function (event) {

        event.preventDefault();

        const password =
            document.querySelector("#password").value;

        const confirmPassword =
            document.querySelector("#confirmPassword").value;

        const mensaje =
            document.querySelector("#msgRecuperar");

        mensaje.textContent = "";
        mensaje.className = "d-block mb-3";


        if (password !== confirmPassword) {

            mensaje.textContent =
                "Las contraseñas no coinciden.";

            mensaje.classList.add("text-danger");

            return;
        }

        const datos = new FormData(formRecuperar);

        fetch("./backend/recuperar.php", {

            method: "POST",

            body: datos

        })

            .then(response => response.json())

            .then(resultado => {

                if (resultado.success) {

                    mensaje.textContent =
                        resultado.message;

                    mensaje.classList.add("text-success");

                    setTimeout(() => {

                        window.location.href =
                            "index.php";

                    }, 1500);

                } else {

                    mensaje.textContent =
                        resultado.message;

                    mensaje.classList.add("text-danger");
                }

            })

            .catch(error => {

                console.log(
                    "Error:",
                    error
                );

                mensaje.textContent =
                    "Error al comunicarse con el servidor.";

                mensaje.classList.add("text-danger");
            });

    });

}