<?php
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/listados_iva/gestion/datos-select-php.php");
if ($vista_url == 'ticket') {
    $colsList = '12';
    $colsFecha = '1';
    $colsDoc = '1';
} else {
    $colsList = '11';
    $colsDoc = '2';
    $colsFecha = '2';
}
?>
<div class="grid grid-cols-<?php echo $colsList; ?> items-center bg-gray-50 sm:mx-5 mt-3 dark:text-white">
    <div class="text-center col-span-<?php echo $colsDoc; ?> px-3">
        Doc.
    </div>
    <div class="px-3 col-span-<?php echo $colsFecha; ?>">
        Fecha
    </div>
    <?php
    if ($vista_url == 'ticket') {
        ?>
        <div class="px-3 col-span-2">
            Cliente
        </div>
        <div class="text-center hidden sm:block sm:col-span-1 px-3">
            NIF
        </div>
        <?php
    }
    if (!empty($iva) && is_array($iva)) {
        ?>
        <div class="text-center hidden sm:block sm:col-span-2 px-3">
            <?php
            foreach ($iva as $key_iva => $value_iva) {
                ?>
                Base <?php echo $value_iva; ?>%<br>
                <?php
            }
            ?>
        </div>
        <div class="text-center hidden sm:block sm:col-span-2 px-3">
            <?php
            foreach ($iva as $key_iva => $value_iva) {
                ?>
                IVA <?php echo $value_iva; ?>%<br>
                <?php
            }
            ?>
        </div>
        <div class="text-center hidden sm:block sm:col-span-1 px-3">
            <?php
            foreach ($iva as $key_iva => $value_iva) {
                ?>
                R.<?php echo $recargo[$key_iva]; ?>%<br>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
    <div class="text-center col-span-2 px-3">
        Total
    </div>
</div>
<hr />
<?php
if(isset($numero_documento_documentos_1)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($numero_documento_documentos_1 as $key => $valor) {
            ?>
            <div class="grid grid-cols-<?php echo $colsList; ?> items-center bg-white border-2 border-gray-50" id="linea_<?php echo $valor; ?>">
                <div class="col-span-<?php echo $colsDoc; ?> px-3" id="capa_img_activo_<?php echo $valor; ?>">
                    <?php echo $valor; ?>
                </div>
                <div class="px-3 col-span-<?php echo $colsFecha; ?>"><?php echo $fecha_documentos_1[$key]; ?></div>

                <?php
                if ($vista_url == 'ticket') {
                    ?>
                    <div class="px-3 col-span-2"><?php echo $nombre_documentos_1[$key]; ?></div>
                    <div class="text-center hidden sm:block sm:col-span-1 px-3">
                        <?php echo $nif_documentos_1[$key]; ?>
                    </div>
                    <?php
                }
                if (!empty($iva) && is_array($iva)) {
                    ?>
                    <div class="text-right hidden sm:block sm:col-span-2 px-3">
                        <?php
                        foreach ($iva as $key_iva => $value_iva) {
                            ?>
                            <?php echo $base_documentos_1[$key_iva][$key]; ?>€<br>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="text-right hidden sm:block sm:col-span-2 px-3">
                        <?php
                        foreach ($iva as $key_iva => $value_iva) {
                            ?>
                            <?php echo $iva_documentos_1[$key_iva][$key]; ?>€<br>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="text-right hidden sm:block sm:col-span-1 px-3">
                        <?php
                        foreach ($iva as $key_iva => $value_iva) {
                            ?>
                            <?php echo $recargo_documentos_1[$key_iva][$key]; ?>€<br>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="text-right px-3 col-span-2">
                    <?php echo $total_documentos_1[$key]; ?>€
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <hr>
    <div class="grid grid-cols-<?php echo $colsList; ?> items-center bg-gray-50 sm:mx-5 dark:text-white">
        <?php
        if ($vista_url == 'ticket') {
            ?>
            <div class="text-center font-medium col-span-3 sm:block sm:col-span-5 px-3">
                TOTAL
            </div>
            <?php
        } else {
            ?>
            <div class="text-center font-medium col-span-1 sm:block sm:col-span-4 px-3">
                TOTAL
            </div>
            <?php
        }
        if (!empty($iva) && is_array($iva)) {
            ?>
            <div class="text-right hidden sm:block sm:col-span-2 px-3">
                <?php
                foreach ($iva as $key_iva => $value_iva) {
                    ?>
                    <?php echo $base_total_documentos_1[$key_iva]; ?>€<br>
                    <?php
                }
                ?>
            </div>
            <div class="text-right hidden sm:block sm:col-span-2 px-3">
                <?php
                foreach ($iva as $key_iva => $value_iva) {
                    ?>
                    <?php echo $iva_total_documentos_1[$key_iva]; ?>€<br>
                    <?php
                }
                ?>
            </div>
            <div class="text-right hidden sm:block sm:col-span-1 px-3">
                <?php
                foreach ($iva as $key_iva => $value_iva) {
                    ?>
                    <?php echo $recargo_total_documentos_1[$key_iva]; ?>€<br>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        <div class="text-right col-span-2 px-3">
            <?php echo $total; ?>€
        </div>
    </div>
    <?php
    unset($numero_documento_documentos_1);
    unset($fecha_documentos_1);
    unset($nombre_documentos_1);
    unset($nif_documentos_1);
    unset($total_documentos_1);
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
            No existen datos para este listado de IVA. Ajuste los filtros para mostrar resultados.
        </div>
    </div>
    <?php
}
unset($base_iva);
unset($iva);
unset($importe_iva);
unset($recargo);
unset($importe_recargo);
unset($base_total_documentos_1);
unset($iva_total_documentos_1);
unset($recargo_total_documentos_1);
unset($recargo_total_documentos_1);
unset($total);
?>