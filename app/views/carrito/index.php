<?php
$activePage = 'carrito';
$pageTitle = 'Carrito | La Casa de la Placa';

$carrito = $data['carrito'] ?? [];
$total = $data['total'] ?? 0;

require_once '../app/views/layouts/header.php';
?>

<section class="container py-5">

    <div class="mb-4">
        <h1 class="fw-bold">Mi carrito</h1>
        <p class="text-muted">
            Revisa los productos antes de confirmar tu pedido.
        </p>
    </div>

    <?php if (empty($carrito)): ?>

        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">

                <i class="bi bi-cart-x fs-1 text-muted"></i>

                <h4 class="mt-3">
                    Tu carrito está vacío
                </h4>

                <p class="text-muted">
                    Agrega una placa desde nuestro catálogo.
                </p>

                <a href="<?= BASE_URL ?>catalogo"
                   class="btn btn-dark">
                    Ir al catálogo
                </a>

            </div>
        </div>

    <?php else: ?>

        <div class="row g-4">

            <div class="col-lg-8">

                <?php foreach ($carrito as $producto): ?>

                    <div class="card border-0 shadow-sm mb-3">

                        <div class="row g-0 align-items-center">

                            <div class="col-md-3">

                                <?php if (!empty($producto['imagen_nombre'])): ?>

                                    <img
                                        src="<?= ROOT_URL ?>uploads/<?= htmlspecialchars($producto['imagen_nombre']) ?>"
                                        class="img-fluid rounded-start"
                                        alt="<?= htmlspecialchars($producto['nombre']) ?>">

                                <?php endif; ?>

                            </div>

                            <div class="col-md-9">

                                <div class="card-body">

                                    <h5 class="card-title">
                                        <?= htmlspecialchars($producto['nombre']) ?>
                                    </h5>

                                    <p class="text-muted">
                                        <?= htmlspecialchars($producto['material']) ?>
                                        -
                                        <?= htmlspecialchars($producto['tamano']) ?>
                                    </p>

                                    <p class="fw-bold">
                                        ₡<?= number_format($producto['precio'], 0, ',', '.') ?>
                                    </p>

                                    <div class="d-flex align-items-center gap-2">

                                        <form
                                            action="<?= BASE_URL ?>carrito/disminuir/<?= $producto[''] ?>"
                                            method="POST">

                                            <button class="btn btn-outline-secondary">
                                                <i class="bi bi-dash"></i>
                                            </button>

                                        </form>

                                        <span class="fw-bold px-2">
                                            <?= $producto['cantidad'] ?>
                                        </span>

                                        <form
                                            action="<?= BASE_URL ?>carrito/aumentar/<?= $producto['id'] ?>"
                                            method="POST">

                                            <button class="btn btn-outline-secondary">
                                                <i class="bi bi-plus"></i>
                                            </button>

                                        </form>

                                        <form
                                            action="<?= BASE_URL ?>carrito/eliminar/<?= $producto['id'] ?>"
                                            method="POST"
                                            class="ms-auto">

                                            <button class="btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h4 class="mb-4">
                            Resumen del pedido
                        </h4>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Total</span>

                            <strong>
                                ₡<?= number_format($total, 0, ',', '.') ?>
                            </strong>
                        </div>

                        <form
                            action="<?= BASE_URL ?>pedido/confirmar"
                            method="POST">

                            <button
                                type="submit"
                                class="btn btn-dark w-100">

                                <i class="bi bi-bag-check me-2"></i>
                                Confirmar pedido

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>

</section>

<?php require_once '../app/views/layouts/footer.php'; ?>

