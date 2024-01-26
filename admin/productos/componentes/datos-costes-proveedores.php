<?php
echo $descripcion_pack_datos;
$select_sys = "datos-costes";
require($_SERVER['DOCUMENT_ROOT']."/admin/documentos/gestion/datos-select-php.php");
if(!isset($id_librador)) {
    ?>
    <div class="text-center">
        Sin datos de proveedores.
    </div>
    <?php
}else {
    ?>
    <div class="text-left mx-5 hidden">
        <div class="grid grid-cols-11 items-center h-10 bg-gray-50 mt-6">
            <div class="px-2 col-span-4">Proveedor</div>
            <div class="px-2">Documento</div>
            <div class="px-2">Fecha</div>
            <div class="px-2">Cantidad</div>
            <div class="px-2">Coste</div>
            <div class="px-2">Número de serie</div>
            <div class="px-2">Lote</div>
            <div class="px-2">Caducidad</div>
        </div>
    </div>
    <?php
    foreach ($id_librador as $key_id_librador => $valor_id_librador) {
        $id_proveedor = $valor_id_librador;
        $select_sys = "nombre-proveedor";
        require($_SERVER['DOCUMENT_ROOT']."/admin/proveedores/gestion/datos-select-php.php");
        ?>
        <div class="grid grid-cols-1 sm:grid-cols-11 items-center h-16 bg-white border-2 border-gray-50">
            <div class='px-2 col-span-4'><?php echo $nombre_proveedor; ?></div>
            <div class='px-2'><?php echo $tipo_documento[$key_id_librador]; ?></div>
            <div class='px-2'><?php echo $fecha[$key_id_librador]; ?></div>
            <div class='px-2'><?php echo $cantidad[$key_id_librador]; ?></div>
            <div class="px-2 text-right"><?php echo $importe[$key_id_librador]; ?> €</div>
            <div class='px-2'>
                <?php
                if(!empty($numero_serie[$key_id_librador])) {
                    echo $numero_serie[$key_id_librador];
                }else {
                    echo "&nbsp;";
                }
                ?>
            </div>
            <div class='px-2'>
                <?php
                if(!empty($lote[$key_id_librador])) {
                    echo $lote[$key_id_librador];
                }else {
                    echo "&nbsp;";
                }
                ?>
            </div>
            <div class='px-2'>
                <?php
                if(!empty($caducidad[$key_id_librador])) {
                    echo $caducidad[$key_id_librador];
                }else {
                    echo "&nbsp;";
                }
                ?>
            </div>
        </div>
        <?php
    }
    unset($id_librador);
    unset($cantidad);
    unset($importe);
    unset($numero_serie);
    unset($lote);
    unset($caducidad);
    unset($fecha);
}
