document.addEventListener('DOMContentLoaded', () => {
    loadUsuarios();
});

async function loadUsuarios() {

    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('usuariosTable');
    const tbody = document.getElementById('usuariosTBody');

    try {

        const response = await fetch(
            `${BASE_URL}usuario/apiList`
        );

        const usuarios = await response.json();

        tbody.innerHTML = '';

        if (usuarios.length === 0) {

            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center">
                        No hay usuarios registrados
                    </td>
                </tr>
            `;

        } else {

            usuarios.forEach(usuario => {

                const fila = document.createElement('tr');

                fila.innerHTML = `
                    <td>${usuario.id}</td>
                    <td>${usuario.name}</td>
                    <td>${usuario.email}</td>
                    <td>${usuario.phone ?? ''}</td>
                    <td>${usuario.address ?? ''}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-secondary">
                            Editar
                        </button>

                        <button class="btn btn-sm btn-outline-danger">
                            Eliminar
                        </button>
                    </td>
                `;

                tbody.appendChild(fila);
            });
        }

    } catch (error) {

        console.error(error);

        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center text-danger">
                    Error al cargar los usuarios
                </td>
            </tr>
        `;

    } finally {

        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}