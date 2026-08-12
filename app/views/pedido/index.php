<?php
$activePage = 'pedido';
$pageTitle = 'Mis pedidos | La Casa de la Placa';

require_once '../app/views/layouts/header.php';

$nombreUsuario = $_SESSION['user_name'] ?? 'Usuario';
?>

<section class="cdp-carrito">
</section>

<script>
    const ROOT_URL = "<?= ROOT_URL ?>";
    const NOMBRE_USUARIO = "<?= $nombreUsuario ?>";
</script>

<script src="<?= ROOT_URL ?>js/pedido.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>