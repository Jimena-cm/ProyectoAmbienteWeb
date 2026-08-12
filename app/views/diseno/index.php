<?php
$activePage = 'disenar';
$pageTitle = 'Diseñar | La Casa de la Placa';
require_once '../app/views/layouts/header.php';
?>

<section class="cdp-disenar">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="cdp-disenar-card">
                    <h3 class="titulo-disenar">Diseñe su Placa</h3>
                </div>

                <div class="cdp-disenar-card">
                    <div class="form-disenar">
                        <label class="categorias" for="categorias">Material</label>
                        <select id="categorias">
                            <option value="">---Seleccionar---</option>
                        </select>
                    </div>
                </div>

                <div class="cdp-disenar-card">
                    <div class="form-disenar">
                        <label class="tamano" for="tamano">Tamaño</label>
                        <select id="tamano">
                            <option value="">---Seleccionar---</option>
                        </select>
                    </div>
                </div>

                <div class="cdp-disenar-card">
                    <div class="form-disenar">
                        <label class="mensaje" for="mensajePlaca">Mensaje</label>
                        <textarea id="mensajePlaca" class="texto-placa" placeholder="Ingrese su mensaje." maxlength="180"></textarea>
                    </div>
                </div>

                <div class="cdp-disenar-card">
                    <div class="form-disenar">
                        <label class="imagen" for="inputImagenPlaca">Imagen</label>
                        <input class="file-disenar" type="file" id="inputImagenPlaca" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="col-md-1"></div>

            <div class="col-md-5">

                <div class="cdp-disenar-preview">
                    <div class="cdp-disenar-preview-imagen">
                        <img id="imgPreviewPlaca"
                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIHWwyVSogX0PYkNxSFNOWEWXY5E4GiVmwXQySHbq_ciJbt6FrTJaAwrqK&s=10"
                             alt="Vista previa de la placa">
                    </div>
                    <p id="previewMensaje" class="cdp-disenar-preview-mensaje cdp-disenar-placeholder">
                        Su mensaje aparecerá aquí.
                    </p>
                </div>

                <div class="cdp-disenar-resumen">
                    <h3>Resumen</h3>
                    <div class="precio-pagar">
                        <span>Material: </span>
                        <span id="resumenMaterial">Sin seleccionar</span>
                    </div>

                    <div class="precio-pagar">
                        <span>Tamaño: </span>
                        <span id="resumenTamano">Sin seleccionar</span>
                    </div>
                    <div class="precio-pagar">
                        <span>Subtotal:</span>
                        <span id="resumenSubtotal">₡0</span>
                    </div>
                    <div class="precio-pagar">
                        <span>Impuestos (13%):</span>
                        <span id="resumenImpuestos">₡0</span>
                    </div>
                    <div class="total-precio">
                        <span class="total">Total:</span>
                        <span class="total" id="resumenTotal">₡0</span>
                    </div>

                    <div class="container-btn">
                        <button class="btn-total" id="btnAgregarCarrito" disabled>Añadir al Carrito</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
    const ROOT_URL = "<?= ROOT_URL ?>";
</script>
<script src="<?= ROOT_URL ?>js/diseno.js"></script>

<?php require_once '../app/views/layouts/footer.php'; ?>