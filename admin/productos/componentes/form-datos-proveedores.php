<?php
echo $descripcion_pack_datos;
$select_sys = "datos-proveedores";
require($_SERVER['DOCUMENT_ROOT']."/admin/documentos/gestion/datos-select-php.php");
/*
$id_librador[]
*/
if(!isset($id_librador)) {
    ?>
    <div class="grid-1">
        <div class="row text-center">
            Sin datos.
        </div>
    </div>
    <?php
}else {
    foreach ($id_librador as $key_id_librador => $valor_id_librador) {
        ?>
        <div class="grid-2">
            <?php
            $id_proveedor = $valor_id_librador;
            $select_sys = "nombre-proveedor";
            require($_SERVER['DOCUMENT_ROOT']."/admin/proveedores/gestion/datos-select-php.php");
            ?>
            <div class="row text-left">Proveedor:</div>
            <div class="row text-center"><?php echo $nombre_proveedor; ?></div>
        </div>
        <?php
    }
    unset($id_librador);
}