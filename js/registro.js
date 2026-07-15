const form = document.querySelector("#frmRegistro");

if (form) {

    form.addEventListener("submit", function (e) {

        e.preventDefault();
        const datos = new FormData(form);

        fetch("./backend/registro.php", {

            method: "POST",
            body: datos

        })
            .then(response => response.json())
            .then(resultado => {
                const mensaje = document.querySelector("#msgRegistro");

                if (resultado.success) {

                    alert(resultado.message);
                    window.location.href = "index.php";

                } else {
                    mensaje.textContent = resultado.message;

                }
            })
            .catch(error => {
                console.log(error);

            });
    });
}