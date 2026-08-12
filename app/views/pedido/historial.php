<?php
$activePage = 'historial';
$pageTitle = 'Mis pedidos | La Casa de la Placa';

$pedidos = $data['pedidos'] ?? [];

require_once '../app/views/layouts/header.php';
?>

<section class="container py-5">

    <div class="mb-4">
        <h1 class="fw-bold">
            Mi historial
        </h1>

        <p class="text-muted">
            Consulta los pedidos asociados a tu cuenta.
        </p>
    </div>

    <?php if (isset($_SESSION['pedido_mensaje'])): ?>

        <div class="alert alert-success">

            <?= htmlspecialchars($_SESSION['pedido_mensaje']) ?>

        </div>

        <?php unset($_SESSION['pedido_mensaje']); ?>

    <?php endif; ?>


    <?php if (empty($pedidos)): ?>

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-bag-x fs-1 text-muted"></i>

                <h4 class="mt-3">
                    Aún no tienes pedidos
                </h4>

                <p class="text-muted">
                    Cuando realices una compra aparecerá aquí.
                </p>

                <a
                    href="<?= BASE_URL ?>catalogo"
                    class="btn btn-dark">

                    Ver catálogo

                </a>

            </div>

        </div>

    <?php else: ?>

        <?php foreach ($pedidos as $pedido): ?>

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <div
                        class="d-flex justify-content-between
                               align-items-center flex-wrap gap-2">

                        <div>

                            <strong>
                                Pedido #<?= $pedido['id'] ?>
                            </strong>

                            <div class="text-muted small">
                                <?= htmlspecialchars($pedido['fecha']) ?>
                            </div>

                        </div>

                        <span class="badge bg-secondary">
                            <?= htmlspecialchars(
                                ucfirst($pedido['estado'])
                            ) ?>
                        </span>

                    </div>

                </div>


                <div class="card-body">

                    <?php foreach ($pedido['productos'] as $producto): ?>

                        <div
                            class="d-flex justify-content-between
                                   align-items-center border-bottom py-3">

                            <div>

                                <strong>
                                    <?= htmlspecialchars(
                                        $producto['nombre']
                                    ) ?>
                                </strong>

                                <div class="text-muted small">

                                    Cantidad:
                                    <?= $producto['cantidad'] ?>

                                </div>

                            </div>

                            <div class="text-end">

                                ₡<?= number_format(
                                    $producto['precio']
                                    * $producto['cantidad'],
                                    0,
                                    ',',
                                    '.'
                                ) ?>

                            </div>

                        </div>

                    <?php endforeach; ?>


                    <div
                        class="d-flex justify-content-between
                               align-items-center mt-4">

                        <strong>
                            Total del pedido
                        </strong>

                        <strong class="fs-5">

                            ₡<?= number_format(
                                $pedido['total'],
                                0,
                                ',',
                                '.'
                            ) ?>

                        </strong>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</section>

<?php require_once '../app/views/layouts/footer.php'; ?>