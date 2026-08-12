<?php
$pageTitle = 'Factura | La Casa de la Placa';
require_once '../app/views/layouts/header.php';
?>

<div class="container mt-5 mb-5" id="finalizarPago" method="post">

    <div class="d-flex justify-content-between mb-3 d-print-none">
        <button onclick="window.print()" class="btn btn-primary shadow">
            <i class="fas fa-print"></i> Imprimir Factura
        </button>
    </div>

    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white p-4">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h2 class="mb-0 fw-bold">La Casa de la Placa</h2>
                    <p class="mb-0 text-light small">San José, Costa Rica</p>
                </div>
                <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
                    <h4 class="mb-1 text-uppercase text-light">Factura Electrónica</h4>
                    <p class="mb-0"><strong>Nro:</strong> <span id="factura-id">5</span></p>
                    <p class="mb-0"><strong>Fecha:</strong> <span id="factura-fecha">08/12/2026</span></p>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-md-5">

            <div class="row mb-4">
                <div class="col-md-7 mb-4 mb-md-0">
                    <h6 class="mb-3 text-muted text-uppercase fw-bold">Detalle de facturación:</h6>
                    <div class="p-4 bg-white border rounded shadow-sm">
                        <p class="mb-0 fs-5">Descripción de la compra</p>
                    </div>

                    <div class="mt-4 row" id="facturaDetalle">
                        <div class="col-6">
                            <span class="text-muted small d-block"></span>
                            <strong>Placa Personalizada - 1</strong>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="bg-light p-4 rounded border">
                        <table class="table table-borderless table-sm text-end mb-0">
                            <tr>
                                <td class="text-muted text-start">Subtotal:</td>
                                <td id="subtotal">₡56 500</td>
                            </tr>
                            <tr>
                                <td class="text-muted text-start">Impuestos:</td>
                                <td id="impuestos">₡7 345</td>
                            </tr>
                            <tr class="fw-bold fs-4 text-primary border-top border-dark">
                                <td class="text-start pt-3">Total a Pagar:</td>
                                <td class="pt-3" id="total">₡63 845</td>
                            </tr>
                        </table>
                    </div>

                    <div class="text-end mt-3">
                        <span class="badge bg-success fs-6 px-3 py-2">PAGADO</span>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="text-center text-muted small">
                <p class="mb-1">¡Gracias por preferir nuestros servicios!</p>
                <p class="mb-0">Si tienes alguna consulta sobre este comprobante, contáctanos.</p>
            </div>

        </div>
    </div>
</div>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
    const ROOT_URL = "<?= ROOT_URL ?>";
</script>
<script src="<?= ROOT_URL ?>js/factura.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once '../app/views/layouts/footer.php'; ?>