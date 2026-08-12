document.addEventListener('DOMContentLoaded', () => {
    console.log('perfil.js loaded');

    loadPerfil();

    const perfilForm = document.getElementById('perfilForm');

    perfilForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const name = document.getElementById('perfilName').value;
        const email = document.getElementById('perfilEmail').value;
        const phone = document.getElementById('perfilPhone').value;
        const address = document.getElementById('perfilAddress').value;
        const password = document.getElementById('perfilPassword').value;

        const data = {
            name,
            email,
            phone,
            address,
            password
        };

        try {
            const response = await fetch(`${BASE_URL}perfil/apiUpdate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if(result.success){
                Swal.fire('Éxito', result.message, 'success');
                loadPerfil();
            }else{
                Swal.fire('Error', result.message, 'error');
            }

        } catch(error) {
            console.error(error);
            Swal.fire('Error', 'Ocurrió un error al actualizar el perfil', 'error');
        }
    });
});


async function loadPerfil() {
    const loader = document.getElementById('perfilLoader');
    const form = document.getElementById('perfilForm');

    try {
        const response = await fetch(`${BASE_URL}perfil/apiShow`);
        const result = await response.json();

        if(result.success){
            const user = result.data;

            document.getElementById('perfilName').value = user.name ?? '';
            document.getElementById('perfilEmail').value = user.email ?? '';
            document.getElementById('perfilPhone').value = user.phone ?? '';
            document.getElementById('perfilAddress').value = user.address ?? '';
            document.getElementById('perfilPassword').value = '';

            document.getElementById('accountName').textContent = user.name ?? '';
            document.getElementById('accountEmail').textContent = user.email ?? '';

            document.getElementById('infoName').textContent = user.name ?? '--';
            document.getElementById('infoEmail').textContent = user.email ?? '--';
            document.getElementById('infoPhone').textContent = user.phone ?? '--';
            document.getElementById('infoAddress').textContent = user.address ?? '--';
            document.getElementById('fechaRegistro').textContent = user.created_at ?? '--';

        }else{
            Swal.fire('Error', result.message, 'error');
        }

    } catch(error) {
        console.error(error);
        Swal.fire('Error', 'No se pudo cargar el perfil', 'error');
    } finally {
        if(loader){
            loader.classList.add('hidden');
        }

        if(form){
            form.classList.remove('hidden');
        }
    }
}