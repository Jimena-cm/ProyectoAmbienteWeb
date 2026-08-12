<?php
$activePage = 'carrito';
$pageTitle = 'Carrito | La Casa de la Placa';
require_once '../app/views/layouts/header.php';
?>
 
<section class="cdp-carrito"></section>
 
 
<section class="cpd-pago">
    <div class="cdp-total">
        <div class="card mb-3" id="card-total">
            <div class="row g-0">
                <div class="card-body">
                    <div class="precio-pagar">
                        <span>Subtotal:</span>
                        <span id="spnSubtotal"></span>
                    </div>
                    <div class="precio-pagar">
                        <span>Impuestos:</span>
                        <span id="spnImpuestos"></span>
                    </div>
                    <div class="total-precio">
                        <span class="total">Total:</span>
                        <span class="total" id="spnTotal"></span>
                    </div>
                    <div class="container-btn">
                        <button class="btn-total" data-bs-toggle="modal" data-bs-target="#modalPagar">PAGAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
<div class="modal fade" id="modalPagar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formPagar">
                <div class="modal-header">
                    <h5 class="modal-title">Pagar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Número de Tarjeta</label>
                        <input type="text" class="form-control" maxlength="16" minlength="16" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Vencimiento</label>
                        <div class="mb-3" id="fechaVencimiento">
                            <input type="text" class="form-control" maxlength="2" placeholder="MM"required>
                            <span>/</span>
                            <input type="text" class="form-control" maxlength="2" placeholder="YY" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CVV</label>
                        <input type="text" class="form-control" maxlength="3" minlength="3" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-total" data-bs-target="#finalizarPago">Finalizar Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
 
 
<script>
    const BASE_URL = "<?= BASE_URL ?>";
    const ROOT_URL = "<?= ROOT_URL ?>";
</script>
<script src="<?= ROOT_URL ?>js/carrito.js"></script>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php require_once '../app/views/layouts/footer.php'; ?>