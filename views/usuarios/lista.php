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
    <title>Gestión de usuarios</title>
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
                <h1 class="m-0 fs-3 fw-bold">Gestión de usuarios</h1>
                <div class="user-info d-flex align-items-center gap-3">
                    <span class="fw-semibold"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="../../backend/logout.php" class="btn btn-primary rounded-3 px-3 py-1">Salir</a>
                </div>
            </header>

            <div class="px-4 pb-5">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                    <div>
                        <h2 class="fs-4 mb-1">Lista de usuarios</h2>
                        <p class="text-muted mb-0">Datos de ejemplo para mostrar el diseño de la vista.</p>
                    </div>
                    <a href="crear.php" class="btn btn-primary align-self-start">+ Agregar usuario</a>
                </div>

                <div class="card-custom p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-8">
                            <input type="text" class="form-control" placeholder="Buscar por nombre o correo">
                        </div>
                        <div class="col-12 col-md-4">
                            <button type="button" class="btn btn-outline-primary w-100">Buscar</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Alejandro Martínez</td>
                                    <td>alejandro@correo.com</td>
                                    <td>Cliente</td>
                                    <td><span class="badge text-bg-success">Activo</span></td>
                                    <td class="text-center text-nowrap">
                                        <a href="ver.php" class="btn btn-sm btn-outline-secondary">Ver</a>
                                        <a href="editar.php" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-outline-warning">Desactivar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Carlos Mora</td>
                                    <td>carlos@correo.com</td>
                                    <td>Administrador</td>
                                    <td><span class="badge text-bg-success">Activo</span></td>
                                    <td class="text-center text-nowrap">
                                        <a href="ver.php" class="btn btn-sm btn-outline-secondary">Ver</a>
                                        <a href="editar.php" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-outline-warning">Desactivar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>María Rodríguez</td>
                                    <td>maria@correo.com</td>
                                    <td>Cliente</td>
                                    <td><span class="badge text-bg-secondary">Inactivo</span></td>
                                    <td class="text-center text-nowrap">
                                        <a href="ver.php" class="btn btn-sm btn-outline-secondary">Ver</a>
                                        <a href="editar.php" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-outline-success">Activar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
