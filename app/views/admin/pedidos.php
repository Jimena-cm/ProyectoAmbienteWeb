<?php
$activePage = 'admin';
$pageTitle = 'Pedidos | Admin';
require_once '../app/views/layouts/header.php';

$adminSection = 'pedido';
?>

<section class="cdp-catalogo">
    <div class="container py-5">

        <div class="cdp-admin-header">
            <h1>Pedidos</h1>
        </div>

        <?php require_once '../app/views/partials/admin_nav.php'; ?>

        <div id="pedidosLoader"
             class="text-center py-5">

            <div class="spinner-border"
                 role="status">

                <span class="visually-hidden">
                    Cargando...
                </span>

            </div>

        </div>

        <div id="pedidosLista">
        </div>

    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
    const ROOT_URL = "<?= ROOT_URL ?>";
</script>

<script src="<?= ROOT_URL ?>js/pedido.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>