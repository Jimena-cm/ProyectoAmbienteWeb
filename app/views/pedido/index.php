<?php
$activePage = 'pedido';
$pageTitle = 'Mis pedidos | La Casa de la Placa';

$pedidos = $data['pedidos'] ?? [];

require_once '../app/views/layouts/header.php';
?>

<section class="container py-5">

    <div class="mb-4">

        <h1 class="fw-bold">
            Mis pedidos
        </h1>

        <p class="text-muted">
            Consulta los pedidos que has realizado.
        </p>

    </div>


    <?php if (isset($_SESSION['pedido_mensaje'])): ?>

        <div class="alert alert-success">

            <?= $_SESSION['pedido_mensaje'] ?>

        </div>

        <?php unset($_SESSION['pedido_mensaje']); ?>

    <?php endif; ?>


    <?php if (empty($pedidos)): ?>

        <div class="card">

            <div class="card-body text-center py-5">

                <h4>
                    No tienes pedidos registrados
                </h4>

                <p class="text-muted">
                    Agrega productos al carrito y realiza tu pedido.
                </p>

                <a href="<?= BASE_URL ?>catalogo"
                   class="btn btn-primary">

                    Ir al catálogo

                </a>

            </div>

        </div>

    <?php else: ?>


        <?php foreach ($pedidos as $pedido): ?>

            <div class="card mb-4">

                <div class="card-body">


                    <div class="d-flex justify-content-between">

                        <div>

                            <h4>
                                Pedido #<?= $pedido['id'] ?>
                            </h4>

                            <p>
                                Fecha:
                                <?= $pedido['fecha'] ?>
                            </p>

                            <p>
                                Estado:
                                <?= $pedido['estado'] ?>
                            </p>

                        </div>


                        <form action="<?= BASE_URL ?>pedido/eliminar/<?= $pedido['id'] ?>"
                              method="POST">

                            <button type="submit"
                                    class="btn btn-outline-danger">

                                Eliminar

                            </button>

                        </form>

                    </div>


                    <hr>


                    <?php foreach ($pedido['productos'] as $producto): ?>

                        <div class="d-flex justify-content-between py-3">

                            <div>

                                <strong>
                                    <?= $producto['nombre'] ?>
                                </strong>

                                <div>
                                    Cantidad:
                                    <?= $producto['cantidad'] ?>
                                </div>

                            </div>


                            <div>

                                ₡<?= number_format(
                                    $producto['precio'],
                                    0,
                                    ',',
                                    '.'
                                ) ?>

                            </div>

                        </div>

                    <?php endforeach; ?>


                    <hr>


                    <div class="text-end">

                        <strong>
                            Total:
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