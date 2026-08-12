<?php
// Este header se incluye DIRECTO desde cada vista con require_once, no lo llama el controller.
// La vista debe definir $activePage y $pageTitle ANTES de este require (opcional, tiene default).

// FIX: header.php usa la clase Database directamente (para la foto de perfil),
// pero no todos los controllers cargan un modelo antes de renderizar la vista
// (AdminController, por ejemplo, no tiene modelo). Por eso se carga aquí mismo,
// sin depender de que algo más lo haya hecho antes.
require_once __DIR__ . '/../../config/Database.php';

if (!isset($activePage)) {
    $activePage = '';
}
if (!isset($pageTitle)) {
    $pageTitle = 'La Casa de la Placa';
}

$conn = Database::getInstance()->getConnection();

$fotoPerfil = "";
$nombreUsuario = $_SESSION['user_name'] ?? '';

if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT profile_image FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuarioActual = $resultado->fetch_assoc();
    $fotoPerfil = $usuarioActual['profile_image'] ?? '';
}

if ($fotoPerfil === '' || $fotoPerfil === 'usuario.jpg') {
    $rutaFoto = BASE_URL . 'img/usuario.jpg';
} else {
    $rutaFoto = ROOT_URL . 'uploads/' . $fotoPerfil;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>

<body class="home-body">
    <nav class="navbar navbar-expand-lg navbar-casa">
        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= BASE_URL ?>dashboard">
                <img src="<?= BASE_URL ?>img/logo.jpg" alt="Logo de La Casa de la Placa" class="navbar-logo">
                <span>LA CASA DE LA PLACA</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link <?= $activePage === 'dashboard' ? 'active' : '' ?>" href="<?= BASE_URL ?>dashboard">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $activePage === 'catalogo' ? 'active' : '' ?>" href="<?= BASE_URL ?>catalogo">Catalogo</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $activePage === 'disenar' ? 'active' : '' ?>" href="<?= BASE_URL ?>diseno">Diseñar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $activePage === 'pedido' ? 'active' : '' ?>" href="<?= BASE_URL ?>pedido"> Mis pedidos </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Atención al cliente
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>pagina/faq">Preguntas frecuentes</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>contacto">Contacto</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>pagina/ubicacion">Ubicación</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>resena">Reseñas</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $activePage === 'carrito' ? 'active' : '' ?>" href="<?= BASE_URL ?>carrito">Carrito</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $activePage === 'admin' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin">
                            <i class="bi bi-gear-fill"></i> Admin
                        </a>
                    </li>

                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle cuenta-menu" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= htmlspecialchars($rutaFoto) ?>" alt="Foto del usuario" class="cuenta-imagen">
                            <span class="cuenta-info">
                                <small>Mi cuenta</small>
                                <strong><?= htmlspecialchars($nombreUsuario) ?></strong>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>perfil">Información de mi cuenta</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>contacto">Atención al cliente</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>auth/logout">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main class="cdp-page">