document.addEventListener('DOMContentLoaded', () => {
    console.log('categoria.js cargado');

    loadCategorias();

    const btnNuevaCategoria = document.getElementById('btnNuevaCategoria');
    const modal = document.getElementById('categoriaModal');
    const closeModal = document.getElementById('closeModal');
    const categoriaForm = document.getElementById('categoriaForm');
    const modalTitle = document.getElementById('modalTitle');

    btnNuevaCategoria.addEventListener('click', () => {
        modalTitle.textContent = 'Nueva Categoría';
        categoriaForm.reset();
        document.getElementById('categoriaId').value = "";
        modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    categoriaForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('categoriaId').value;
        const nombre = document.getElementById('categoriasNombre').value;
        const descripcion = document.getElementById('categoriasDescripcion').value;

        const data = { nombre, descripcion };

        const url = id ? `${BASE_URL}categoria/apiUpdate/${id}` : `${BASE_URL}categoria/apiStore`;
        const btnSave = document.getElementById('btnSave');
        const originalText = btnSave.textContent;
        btnSave.textContent = 'Guardando...';
        btnSave.disabled = true;

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                modal.classList.remove('active');
                Swal.fire('Éxito', result.message, 'success');
                loadCategorias();
            } else {
                Swal.fire('Error', result.message, 'error');
            }

        } catch (error) {
            Swal.fire('Error', 'Ocurrió un error en la solicitud', 'error');
        } finally {
            btnSave.textContent = originalText;
            btnSave.disabled = false;
        }

    });

});

async function loadCategorias() {
    const loader = document.getElementById('tableLoader');
    const table = document.getElementById('categoriasTable');
    const tbody = document.getElementById('categoriasTBody');

    loader.classList.remove('d-none');
    table.classList.add('d-none');
    tbody.innerHTML = '';

    try {

        const response = await fetch(`${BASE_URL}categoria/apiList`);
        const categorias = await response.json();

        if (categorias.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">No hay categorías registradas</td></tr>';
        } else {
            categorias.forEach(categoria => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${categoria.id}</td>
                    <td>${categoria.nombre}</td>
                    <td>${categoria.descripcion ?? ''}</td>
                    <td class="cdp-admin-actions">
                        <button class="btn btn-sm btn-outline-secondary" onclick="editCategoria(${categoria.id})">Editar</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCategoria(${categoria.id})">Eliminar</button>
                    </td>
                `;

                tbody.appendChild(tr);

            });
        }

    } catch (error) {
        Swal.fire('Error', 'No se lograron cargar las categorías', 'error');

    } finally {
        loader.classList.add('d-none');
        table.classList.remove('d-none');
    }
}

async function editCategoria(id) {
    try {
        const response = await fetch(`${BASE_URL}categoria/apiShow/${id}`);
        const result = await response.json();

        if (result.success) {
            const categoria = result.data;
            document.getElementById('categoriaId').value = categoria.id;
            document.getElementById('categoriasNombre').value = categoria.nombre;
            document.getElementById('categoriasDescripcion').value = categoria.descripcion ?? '';

            document.getElementById('modalTitle').textContent = 'Editar Categoría';
            document.getElementById('categoriaModal').classList.add('active');
        } else {
            Swal.fire('Error', result.message, 'error');
        }
    } catch (error) {
        Swal.fire('Error', 'No se pudo cargar la categoría', 'error');
    }
}

function deleteCategoria(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${BASE_URL}categoria/apiDelete/${id}`, {
                    method: 'POST'
                });
                const resData = await response.json();

                if (resData.success) {
                    Swal.fire('¡Eliminado!', resData.message, 'success');
                    loadCategorias();
                } else {
                    Swal.fire('Error', resData.message, 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Ocurrió un error al eliminar la categoría', 'error');
            }
        }
    });
}