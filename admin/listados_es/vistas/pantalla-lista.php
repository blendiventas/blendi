<?php
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/listados_es/gestion/datos-select-php.php");
?>
<div class="grid grid-cols-12 items-center bg-gray-50 sm:mx-5 mt-3 dark:text-white">
    <div class="text-center col-span-4 px-3">
        &nbsp;
    </div>
    <div class="text-center col-span-4 px-3">
        Entrada
    </div>
    <div class="text-center col-span-4 px-3">
        Salida
    </div>
</div>
<div class="grid grid-cols-12 items-center bg-gray-50 sm:mx-5 dark:text-white">
    <div class="text-center col-span-4 px-3">
        Descripción
    </div>
    <div class="text-center col-span-2 px-3">
        Cantidad
    </div>
    <div class="text-center col-span-2 px-3">
        Coste
    </div>
    <div class="text-center col-span-2 px-3">
        Cantidad
    </div>
    <div class="text-center col-span-2 px-3">
        Importe
    </div>
</div>
<hr />
<?php
if(isset($entradas_salidas['descripcion_producto'])) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($entradas_salidas['descripcion_producto'] as $id_producto => $valor) {
            ?>
            <div class="grid grid-cols-12 items-center bg-white border-2 border-gray-50" id="linea_<?php echo $id_producto; ?>">
                <div class="col-span-4 px-3">
                    <?php echo $valor; ?>
                </div>
                <div class="px-3 col-span-2 text-right"><?php echo number_format($entradas_salidas['cantidad_entrada'][$id_producto], 2, ',', '.'); ?></div>
                <div class="px-3 col-span-2 text-right"><?php echo number_format($entradas_salidas['coste_entrada'][$id_producto], 3, ',', '.'); ?>€</div>
                <div class="px-3 col-span-2 text-right"><?php echo number_format($entradas_salidas['cantidad_salida'][$id_producto], 2, ',', '.'); ?></div>
                <div class="px-3 col-span-2 text-right"><?php echo number_format($entradas_salidas['importe_salida'][$id_producto], 3, ',', '.'); ?>€</div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    unset($entradas_salidas);
    ?>
    <div class="hidden">
        <?php
        require($_SERVER['DOCUMENT_ROOT'] . "/admin/componentes/footer-listados.php");
        ?>
    </div>
    <?php
}else {
    ?>
    <div class="flex items-center justify-center h-10 bg-white mx-5">
        <div class="text-center grow px-3">
            No existen datos para este listado de Entradas / Salidas. Ajuste los filtros para mostrar resultados.
        </div>
    </div>
    <?php
}
?>