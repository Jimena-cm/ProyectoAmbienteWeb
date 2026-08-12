document.addEventListener('DOMContentLoaded', () => {
    console.log('resumen.js cargado');

    loadResumen();
});


async function loadResumen() {

    const loader =
        document.getElementById('resumenLoader');

    const cards =
        document.getElementById('resumenCards');

    cards.innerHTML = '';

    try {

        const response = await fetch(
            `${BASE_URL}admin/apiList`
        );

        const resumen = await response.json();

        resumen.forEach(dato => {

            const div = document.createElement('div');

            div.className = 'col-md-4';

            div.innerHTML = `
                <div class="card shadow-sm h-100">
                    <div class="card-body">

                        <h5>
                            ${dato.description}
                        </h5>

                        <h2>
                            ${dato.value}
                        </h2>

                    </div>
                </div>
            `;

            cards.appendChild(div);
        });

    } catch (error) {

        Swal.fire(
            'Error',
            'No se logró cargar el resumen',
            'error'
        );

    } finally {

        loader.classList.add('d-none');
        cards.classList.remove('d-none');
    }
}