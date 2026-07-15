<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ../../index.php');
//     exit;
// }
?>
<!DOCTYPE html>
< lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario | La Casa de la Placa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="usuarios-body">

    <!-- Barra superior -->
    <header class="usuarios-topbar">
        <a href="../../../dashboard.php" class="usuarios-brand">
            <img src="../../../img/logo.jpg" alt="Logo"class="usuarios-logo">
            <span>La Casa de la Placa</span>
        </a>
        <a href="../../../backend/logout.php" class="usuarios-logout" title="Cerrar sesión">
            Salir
        </a>
    </header>
    <!-- Contenido de la página -->
    <main class="usuarios-main">
        <section class="usuarios-profile-header">
            <div class="usuarios-icon">
                ＋
            </div>
            <h1>Crear usuario</h1>
            <span class="usuarios-badge">
                Panel administrativo
            </span>
        </section>
        <section class="usuarios-card">
            <div class="usuarios-card-title">
                <h2>Datos del usuario</h2>
                <p>
                    Complete la información del nuevo usuario.
                </p>
            </div>
            <form action="#" method="post">
                <div class="mb-3">
                    <label
                        for="nombre"
                        class="form-label" >
                        Nombre completo
                    </label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">
                        Correo electrónico
                    </label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="usuario@correo.com" required>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="telefono" class="form-label">
                            Teléfono
                        </label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="8888-8888">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label">
                            Contraseña
                        </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="********" required >
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="rol" class="form-label">
                            Rol
                        </label>
                        <select class="form-select" id="rol" name="rol">
                            <option selected>Cliente</option>
                            <option>Administrador</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="estado" class="form-label">
                            Estado
                        </label>
                        <select class="form-select" id="estado" name="estado">
                            <option selected>Activo</option>
                            <option>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="usuarios-actions">
                    <a href="lista.php" class="btn usuarios-btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn usuarios-btn-primary">
                        Guardar usuario
                    </button>
                </div>
            </form>
        </section>
    </main>
    <!-- Menú inferior -->
    <nav class="usuarios-bottom-nav">
        <a href="../../../dashboard.php">
            <span></span>
            <small>Inicio</small>
        </a>
        <a href="lista.php">
            <span></span>
            <small>Usuarios</small>
        </a>
        <a href="crear.php" class="active">
            <span></span>
            <small>Crear</small>
        </a>
        <a href="../../../perfil.php">
            <span></span>
            <small>Perfil</small>
        </a>
    </nav>
</body>