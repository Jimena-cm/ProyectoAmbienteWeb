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
    <title>Detalle del usuario</title>
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
                <h1 class="m-0 fs-3 fw-bold">Detalle del usuario</h1>
                <a href="../../backend/logout.php" class="btn btn-primary rounded-3 px-3 py-1">Salir</a>
            </header>

            <div class="px-4 pb-5">
                <div class="card-custom p-4 mx-auto form-card">
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <p class="text-muted mb-1">Nombre completo</p>
                            <p class="fw-semibold">Alejandro Martínez</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="text-muted mb-1">Correo electrónico</p>
                            <p class="fw-semibold">ana@correo.com</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="text-muted mb-1">Teléfono</p>
                            <p class="fw-semibold">8888-8888</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="text-muted mb-1">Rol</p>
                            <p class="fw-semibold">Cliente</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="text-muted mb-1">Estado</p>
                            <span class="badge text-bg-success">Activo</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="index.php" class="btn btn-outline-secondary">Volver</a>
                        <a href="editar.php" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
