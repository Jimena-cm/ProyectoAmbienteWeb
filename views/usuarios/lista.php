<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ../../index.php');
//     exit;
// }
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
<body class="usuarios-body">
    <!-- Barra superior -->
    <header class="usuarios-topbar">
        <a href="../../../dashboard.php"class="usuarios-brand">
            <img src="../../../img/logo.jpg"alt="Logo de La Casa de la Placa"class="usuarios-logo">
            <span>La Casa de la Placa</span>
        </a>
        <div class="usuarios-topbar-user">
            <span>
                <?= htmlspecialchars($_SESSION['user_name'] ?? 'Administrador') ?>
            </span>
            <a href="../../../backend/logout.php"class="usuarios-logout">
                Salir
            </a>
        </div>
    </header>
    <!-- Contenido principal -->
    <main class="usuarios-main usuarios-list-main">
        <section class="usuarios-profile-header">
            <div class="usuarios-icon">
                ♙
            </div>
            <h1>Gestión de usuarios</h1>
            <span class="usuarios-badge">
                Panel administrativo
            </span>
        </section>
        <!-- Encabezado del listado -->
        <section class="usuarios-card usuarios-list-card">
            <div class="usuarios-list-header">
                <div>
                    <h2>Lista de usuarios</h2>
                    <p>
                        Consulte los usuarios registrados y las acciones
                        disponibles.
                    </p>
                </div>
                <a href="crear.php"class="btn usuarios-btn-primary">
                    + Agregar usuario
                </a>
            </div>
            <!-- Buscador visual -->
            <div class="usuarios-search">
                <input type="search"class="form-control"placeholder="Buscar por nombre o correo...">
                <button type="button"class="btn usuarios-search-button">
                    Buscar
                </button>
            </div>
            <!-- Tabla -->
            <div class="table-responsive usuarios-table-container">
                <table class="table usuarios-table align-middle">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Usuario 1 -->
                        <tr>
                            <td>
                                <div class="usuarios-user-info">
                                    <div class="usuarios-avatar">
                                        AM
                                    </div>
                                    <div>
                                        <strong>
                                            Alejandro Martínez
                                        </strong>
                                        <small>
                                            alejandro@correo.com
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="usuarios-role-badge">
                                    Cliente
                                </span>
                            </td>
                            <td>
                                <span class="usuarios-status active">
                                    Activo
                                </span>
                            </td>
                            <td>
                                <div class="usuarios-table-actions">
                                    <a href="ver.php"class="btn usuarios-action-view">
                                        Ver
                                    </a>
                                    <a href="editar.php"class="btn usuarios-action-edit">
                                        Editar
                                    </a>
                                    <button type="button"class="btn usuarios-action-disable">
                                        Desactivar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Usuario 2 -->
                        <tr>
                            <td>
                                <div class="usuarios-user-info">
                                    <div class="usuarios-avatar">
                                        CM
                                    </div>
                                    <div>
                                        <strong>
                                            Carlos Mora
                                        </strong>
                                        <small>
                                            carlos@correo.com
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="usuarios-role-badge admin">
                                    Administrador
                                </span>
                            </td>
                            <td>
                                <span class="usuarios-status active">
                                    Activo
                                </span>
                            </td>
                            <td>
                                <div class="usuarios-table-actions">
                                    <a href="ver.phpclass="btn usuarios-action-view">
                                        Ver
                                    </a>
                                    <a href="editar.php"class="btn usuarios-action-edit">
                                        Editar
                                    </a>
                                    <button type="button"class="btn usuarios-action-disable">
                                        Desactivar
                                    </button>
                               </div>
                            </td>
                        </tr>
                        <!-- Usuario 3 -->
                        <tr>
                            <td>
                                <div class="usuarios-user-info">
                                    <div class="usuarios-avatar">
                                        MR
                                    </div>
                                    <div>
                                        <strong>
                                            María Rodríguez
                                        </strong>
                                        <small>
                                            maria@correo.com
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="usuarios-role-badge">
                                    Cliente
                                </span>
                            </td>
                            <td>
                                <span class="usuarios-status inactive">
                                    Inactivo
                                </span>
                            </td>
                            <td>
                                <div class="usuarios-table-actions">
                                  <a href="ver.php"class="btn usuarios-action-view">
                                        Ver
                                    </a>
                                    <a href="editar.php"class="btn usuarios-action-edit">
                                        Editar
                                    </a>
                                    <button type="button"class="btn usuarios-action-activate">
                                        Activar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="usuarios-demo-note">
                Los datos mostrados son de ejemplo. Las acciones todavía no
                modifican la base de datos.
            </p>
        </section>
    </main>
    <!-- Barra inferior -->
    <nav class="usuarios-bottom-nav">
        <a href="../../../dashboard.php">
            <span></span>
            <small>Inicio</small>
        </a>
        <a href="lista.php"class="active">
            <span></span>
            <small>Usuarios</small>
        </a>
        <a href="crear.php">
            <span></span>
            <small>Crear</small>
        </a>
        <a href="../../../perfil.php">
            <span></span>
            <small>Perfil</small>
        </a>
    </nav>
</body>
</html>

