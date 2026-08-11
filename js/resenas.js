document.addEventListener('DOMContentLoaded', () => {
    console.log('resenas.js loaded');

    loadResenas();

    const frmResena = document.getElementById('frmResena');

    frmResena.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nombre = document.getElementById('nombre').value;
        const calificacion = document.getElementById('calificacion').value;
        const comentario = document.getElementById('comentario').value;

        const data = {
            nombre,
            calificacion,
            comentario
        };

        try {
            const response = await fetch(`${BASE_URL}resena/apiStore`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if(result.success){
                Swal.fire('Éxito', result.message, 'success');

                frmResena.reset();

                loadResenas();
            }else{
                Swal.fire('Error', result.message, 'error');
            }

        }catch(error){
            Swal.fire(
                'Error',
                'Ocurrió un error al publicar la reseña',
                'error'
            );
        }
    });
});


async function loadResenas() {
    const lista = document.getElementById('listaResenas');

    lista.innerHTML = '';

    try {
        const response = await fetch(`${BASE_URL}resena/apiList`);
        const resenas = await response.json();

        if(resenas.length === 0){
            lista.innerHTML = `
                <p class="text-muted">
                    No hay reseñas registradas
                </p>
            `;
            return;
        }

        resenas.forEach(resena => {

            const estrellas = '★'.repeat(resena.calificacion);

            const card = document.createElement('div');

            card.classList.add('review-card');

            card.innerHTML = `
                <div class="review-card-header">
                    <strong>${resena.nombre}</strong>
                    <span>${estrellas}</span>
                </div>

                <p>${resena.comentario}</p>
            `;

            lista.appendChild(card);
        });

    }catch(error){
        lista.innerHTML = `
            <p class="text-danger">
                No se pudieron cargar las reseñas
            </p>
        `;
    }
}