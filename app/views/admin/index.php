<?php
$activePage = 'admin';
$pageTitle = 'Panel de administración | La Casa de la Placa';
require_once '../app/views/layouts/header.php';

$adminSection = 'admin';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">
            <h1>Panel de administración</h1>
        </div>

        <?php require_once '../app/views/partials/admin_nav.php'; ?>

        <p class="text-muted">
            Selecciona una tabla arriba para ver, crear, editar o eliminar sus registros.
        </p>

    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>