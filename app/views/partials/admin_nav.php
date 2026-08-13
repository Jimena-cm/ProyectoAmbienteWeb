<?php

if (!isset($adminSection)) {
    $adminSection = '';
}

$seccionesAdmin = [
    'admin'        => 'Resumen',
    'usuario'      => 'Usuarios',
    'categoria'    => 'Categorías',
    'material'     => 'Materiales',
    'tamano'       => 'Tamaños',
    'placa'        => 'Placas',
    'factura'      => 'Facturas',
    'venta'        => 'Ventas',
    'historial'    => 'Historial',
    'resena'       => 'Reseñas',
    'estadistica'  => 'Estadísticas',
];
?>
<div class="d-flex flex-wrap gap-2 mb-4 cdp-admin-tabs">
    <?php foreach ($seccionesAdmin as $clave => $etiqueta): ?>
        <a href="<?= BASE_URL . $clave ?>"
           class="btn btn-sm rounded-pill cdp-filtro <?= $adminSection === $clave ? 'active' : '' ?>">
            <?= htmlspecialchars($etiqueta) ?>
        </a>
    <?php endforeach; ?>
</div>