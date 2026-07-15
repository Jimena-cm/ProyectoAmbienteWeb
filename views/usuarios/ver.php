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
<body class="usuarios-body">
    <!-- Barra superior -->
    <header class="usuarios-topbar">
        <a href="../../../dashboard.php"class="usuarios-brand">
            <img src="../../../img/logo.jpg"alt="Logo de La Casa de la Placa"class="usuarios-logo">
            <span>La Casa de la Placa</span>
        </a>
        <a href="../../../backend/logout.php"class="usuarios-logout"title="Cerrar sesión">
            Salir
        </a>
    </header>
    <!-- Contenido principal -->
    <main class="usuarios-main">
        <section class="usuarios-profile-header">
            <div class="usuarios-icon">
                👤
            </div>
            <h1>Detalle del usuario</h1>
            <span class="usuarios-badge">
                Panel administrativo
            </span>
        </section>
        <section class="usuarios-card">
            <!-- Presentación del usuario -->
            <div class="usuario-detalle-header">
                <div class="usuario-detalle-avatar">
                    AM
                </div>
                <div class="usuario-detalle-presentacion">
                    <h2>Alejandro Martínez</h2>
                    <p>alejandro@correo.com</p>
                    <span class="usuarios-status active">
                        Activo
                    </span>
                </div>
            </div>
            <!-- Información -->
            <div class="usuario-detalle-grid">
                <div class="usuario-detalle-item">
                    <span class="usuario-detalle-label">
                        Nombre completo
                    </span>
                    <strong>
                        Alejandro Martínez
                    </strong>
                </div>
                <div class="usuario-detalle-item">
                    <span class="usuario-detalle-label">
                        Correo electrónico
                    </span>
                    <strong>
                        alejandro@correo.com
                    </strong>
                </div>
                <div class="usuario-detalle-item">
                    <span class="usuario-detalle-label">
                        Teléfono
                    </span>
                    <strong>
                        8888-8888
                    </strong>
                </div>
                <div class="usuario-detalle-item">
                    <span class="usuario-detalle-label">
                        Rol
                    </span>
                    <span class="usuarios-role-badge">
                        Cliente
                    </span
                </div>
                <div class="usuario-detalle-item">
                    <span class="usuario-detalle-label">
                        Estado de la cuenta
                    </span>
                    <span class="usuarios-status active">
                        Activo
                    </span>
                </div>
            </div>
            <div class="usuarios-demo-note usuario-detalle-nota">
                Los datos mostrados son de ejemplo. Esta vista todavía no
                obtiene información de la base de datos.
            </div>
            <!-- Botones -->
            <div class="usuarios-actions">
                <a href="lista.php"class="btn usuarios-btn-secondary">
                    Volver
                </a>
                <a href="editar.php"class="btn usuarios-btn-primary">
                    Editar usuario
                </a>
            </div>
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