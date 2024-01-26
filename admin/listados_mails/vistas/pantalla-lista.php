<?php
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/listados_mails/gestion/datos-select-php.php");
?>
<div class="grid grid-cols-12 items-center bg-gray-50 sm:mx-5 dark:text-white">
    <div class="text-center col-span-4 px-3">
        Librador
    </div>
    <div class="text-center col-span-1 px-3">
        Tipo librador
    </div>
    <div class="text-center col-span-1 px-3">
        Tipo doc.
    </div>
    <div class="text-center col-span-1 px-3">
        Número doc.
    </div>
    <div class="text-center col-span-2 px-3">
        E-mail
    </div>
    <div class="text-center col-span-2 px-3">
        Fecha envío
    </div>
    <div class="text-center col-span-1 px-3">
        Abierto
    </div>
</div>
<hr />
<?php
if(isset($descripcion_librador)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($descripcion_librador as $key => $valor) {
            ?>
            <div class="grid grid-cols-12 items-center bg-white border-2 border-gray-50" id="linea_<?php echo $key; ?>">
                <div class="col-span-4 px-3">
                    <?php echo $valor; ?>
                </div>
                <div class="px-3 col-span-1 text-center">
                    <?php
                    if ($tipo_librador_mails[$key] == 'pro') {
                        echo 'Proveedor';
                    } else if ($tipo_librador_mails[$key] == 'cre') {
                        echo 'Creditor';
                    } else {
                        echo 'Cliente';
                    }
                    ?>
                </div>
                <div class="px-3 col-span-1 text-center">
                    <?php
                    if ($tipo_documento_mails[$key] == 'alb') {
                        echo 'Albarán';
                    } else if ($tipo_documento_mails[$key] == 'ped') {
                        echo 'Pedido';
                    } else if ($tipo_documento_mails[$key] == 'fac') {
                        echo 'Factura';
                    } else if ($tipo_documento_mails[$key] == 'pre') {
                        echo 'Presupuesto';
                    } else if ($tipo_documento_mails[$key] == 'tiq') {
                        echo 'Tícket';
                    } else if ($tipo_documento_mails[$key] == 'fac') {
                        echo 'Factura';
                    }
                    ?>
                </div>
                <div class="px-3 col-span-1 text-center"><?php echo $numero_documento_mails[$key]; ?></div>
                <div class="px-3 col-span-2 text-center"><?php echo $mail_mails[$key]; ?></div>
                <div class="px-3 col-span-2 text-center"><?php echo $fecha_envio_mails[$key]; ?></div>
                <div class="px-3 col-span-1 text-center"><?php echo $abierto_mails[$key]; ?></div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    unset($descripcion_librador);
    unset($tipo_librador_mails);
    unset($tipo_documento_mails);
    unset($numero_documento_mails);
    unset($abierto_mails);
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
            No existen datos para este listado de mails. Ajuste los filtros para mostrar resultados.
        </div>
    </div>
    <?php
}
?>