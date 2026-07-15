<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar p-4">
            <h2 class="fs-4 mb-4 fw-bold">Sistema</h2>
            <ul class="list-unstyled m-0">
                <li class="rounded mb-2"><a class="sidebar-link" href="../../dashboard.php">Inicio</a></li>
                <li class="rounded mb-2 active"><a class="sidebar-link" href="index.php">Usuarios</a></li>
                <li class="rounded mb-2"><a class="sidebar-link" href="#">Productos</a></li>
                <li class="rounded mb-2"><a class="sidebar-link" href="#">Reportes</a></li>
                <li class="rounded mb-2"><a class="sidebar-link" href="#">Configuración</a></li>
            </ul>
        </aside>

        <main class="content d-flex flex-column">
            <header class="toolbar bg-white p-3 d-flex justify-content-between align-items-center mb-4">
                <h1 class="m-0 fs-3 fw-bold">Editar usuario</h1>
                <a href="../../backend/logout.php" class="btn btn-primary rounded-3 px-3 py-1">Salir</a>
            </header>

            <div class="px-4 pb-5">
                <div class="card-custom p-4 mx-auto form-card">
                    <p class="text-muted">Los datos son de ejemplo. Esta vista todavía no actualiza la base de datos.</p>

                    <form action="#" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="Alejandro Martínez" required>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label fw-semibold">Correo electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="alejandro@correo.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="8888-8888">
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="rol" class="form-label fw-semibold">Rol</label>
                                <select class="form-select" id="rol" name="rol">
                                    <option selected>Cliente</option>
                                    <option>Administrador</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="estado" class="form-label fw-semibold">Estado</label>
                                <select class="form-select" id="estado" name="estado">
                                    <option selected>Activo</option>
                                    <option>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
