document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("#frmPerfil");
    const mensaje = document.querySelector("#msgPerfil");

    const profileInput =
        document.querySelector("#profile_image");

    const profilePreview =
        document.querySelector("#profilePreview");

    const profileMainImage =
        document.querySelector("#profileMainImage");


    function rutaFoto(profileImage) {

        if (
            !profileImage ||
            profileImage === "usuario.jpg"
        ) {

            return "./img/usuario.jpg";
        }

        return "./uploads/" + profileImage;
    }


    function cargarPerfil() {

        fetch("./backend/perfil.php")

            .then(response => {

                if (!response.ok) {
                    throw new Error("No autorizado");
                }

                return response.json();

            })

            .then(resultado => {

                if (!resultado.success) {
                    return;
                }


                const user = resultado.user;


                

                document.querySelector("#accountName")
                    .textContent = user.name;

                document.querySelector("#accountEmail")
                    .textContent = user.email;


                

                document.querySelector("#infoName")
                    .textContent = user.name;

                document.querySelector("#infoEmail")
                    .textContent = user.email;

                document.querySelector("#infoPhone")
                    .textContent = user.phone || "No registrado";

                document.querySelector("#infoAddress")
                    .textContent = user.address || "No registrada";


               

                document.querySelector("#totalPedidos")
                    .textContent = resultado.total_pedidos;


                const fecha =
                    new Date(user.created_at);


                document.querySelector("#fechaRegistro")
                    .textContent =
                    fecha.toLocaleDateString("es-CR");


                

                document.querySelector("#name")
                    .value = user.name || "";

                document.querySelector("#email")
                    .value = user.email || "";

                document.querySelector("#phone")
                    .value = user.phone || "";

                document.querySelector("#address")
                    .value = user.address || "";


                

                const foto =
                    rutaFoto(user.profile_image);


                profilePreview.src = foto;

                profileMainImage.src = foto;

            })

            .catch(error => {

                console.log("Error:", error);

                window.location.href = "index.php";

            });

    }


    

    profileInput.addEventListener(
        "change",
        function () {

            const file =
                profileInput.files[0];


            if (file) {

                const preview =
                    URL.createObjectURL(file);


                profilePreview.src = preview;

            }

        }
    );


    

    form.addEventListener(
        "submit",
        function (event) {

            event.preventDefault();


            const datos =
                new FormData(form);


            fetch(
                "./backend/editar_perfil.php",
                {

                    method: "POST",

                    body: datos

                }
            )

            .then(response => response.json())

            .then(resultado => {

                mensaje.textContent =
                    resultado.message;


                if (resultado.success) {

                    mensaje.className =
                        "alert alert-success mt-3";


                    cargarPerfil();

                } else {

                    mensaje.className =
                        "alert alert-danger mt-3";

                }

            })

            .catch(error => {

                console.log("Error:", error);


                mensaje.textContent =
                    "Error al actualizar el perfil.";


                mensaje.className =
                    "alert alert-danger mt-3";

            });

        }
    );


    cargarPerfil();

});