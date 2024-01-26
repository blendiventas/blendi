<input type="hidden" name="apartado" id="apartado" value="stock" />

<?php
$result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");

$decimales_cantidades= $result_configuracion[0]['decimales_cantidades'];
$decimales_importes= $result_configuracion[0]['decimales_importes'];

$select_sys = "control-stock";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
if ($control_stock == 1) {
    $id_producto_productos = $id_url;
    $id_productos_detalles_enlazado_productos = 0;
    $id_productos_detalles_multiples_productos = 0;
    $id_packs_productos = 0;

    $ejercicio = date('Y');
    $select_sys = "stock-trazabilidad";
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");

    $select_sys = "stock-listado-trazabilidad";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");

    if(isset($matriz_stock_lote)) {
        $columnes = 3;
        $columnesDetalle = 10;
        if($stock_lotes) {
            $columnes += 3;
            $columnesDetalle += 2;
        }
        if(!$stock_lotes && $stock_numeros_serie) {
            $columnes += 3;
            $columnesDetalle += 1;
        }
        ?>
        <div class="grid grid-cols-1 sm:grid-cols-<?php echo $columnes; ?> items-center sm:h-10 bg-gray-50 mt-6">
            <div class="px-2">&nbsp;</div>
            <?php
            if($stock_lotes) {
                echo '<div class="px-2 text-left col-span-3">Lote</div>';
            }
            if(!$stock_lotes && $stock_numeros_serie) {
                echo '<div class="px-2 text-left col-span-3">Número serie</div>';
            }
            ?>
            <div class="px-2 text-left col-span-2">Stock</div>
        </div>
        <?php
        foreach ($matriz_stock_lote as $key_stock_lote => $valor_stock_lote) {
            echo '<div class="grid grid-cols-1 sm:grid-cols-' . $columnes . ' items-center sm:h-16 bg-white border-2 border-gray-50">';
            ?>
            <div>
                <div id="tabla_datos_stock_<?php echo $key_stock_lote; ?>-show" class="px-2 cursor-pointer" onclick="collapseCapa('tabla_datos_stock_<?php echo $key_stock_lote; ?>');">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div id="tabla_datos_stock_<?php echo $key_stock_lote; ?>-hidden" class="px-2 cursor-pointer hidden" onclick="collapseCapa('tabla_datos_stock_<?php echo $key_stock_lote; ?>');">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                </div>
            </div>
            <?php
            if ($stock_lotes) {
                echo '<div class="px-2 text-left col-span-3">' . $matriz_stock_lote[$key_stock_lote] . '</div>';
            }
            if(!$stock_lotes && $stock_numeros_serie) {
                echo '<div class="px-2 text-left col-span-3">' . $matriz_stock_numero_serie[$key_stock_lote] . '</div>';
            }
            echo '<div class="px-2 col-span-2">'.$matriz_stock_stock[$key_stock_lote].'</div>';
            echo '</div>';
            ?>
            <div id="tabla_datos_stock_<?php echo $key_stock_lote; ?>" class="hidden">
                <div class="grid grid-cols-1 sm:grid-cols-<?php echo $columnesDetalle; ?> items-center sm:h-10 bg-gray-50 mt-6">
                    <div class="col-span-3">Producto</div>
                    <?php
                    if($stock_lotes) {
                        echo '<div>Lote</div>';
                        echo '<div>Caducidad</div>';
                    }
                    if(!$stock_lotes && $stock_numeros_serie) {
                        echo '<div>N. S.</div>';
                    }
                    ?>
                    <div>Tipo</div>
                    <div>Fecha</div>
                    <div>T. Librador</div>
                    <div class="col-span-2">Librador</div>
                    <div>Qty</div>
                    <div>Importe</div>
                </div>
                <?php
                foreach ($trazabilidad->id_documentos_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
                    if((!empty($matriz_stock_lote[$key_stock_lote]) && $trazabilidad->lote_documentos_productos_sku_stock[$key_productos_sku_stock] == $matriz_stock_lote[$key_stock_lote]) ||
                        (!empty($matriz_stock_numero_serie[$key_stock_lote]) && $trazabilidad->numero_serie_documentos_productos_sku_stock[$key_productos_sku_stock] == $matriz_stock_numero_serie[$key_stock_lote]) ||
                        (empty($matriz_stock_lote[$key_stock_lote]) && empty($matriz_stock_numero_serie[$key_stock_lote]) && empty($trazabilidad->lote_documentos_productos_sku_stock[$key_productos_sku_stock]) && empty($trazabilidad->numero_serie_documentos_productos_sku_stock[$key_productos_sku_stock]))) {
                        ?>
                        <div class="grid grid-cols-1 text-xs sm:grid-cols-<?php echo $columnesDetalle; ?> items-center sm:h-16 bg-white border-2 border-gray-50">
                            <div class="flex items-center space-x-2 col-span-3">
                                <div>
                                    <?php echo $trazabilidad->descripcion_producto_productos_sku_stock[$key_productos_sku_stock]; ?>
                                </div>
                                <a href="#" onclick="abrirFichaEnNuevaPestana(<?php echo $trazabilidad->id_producto_productos_sku_stock[$key_productos_sku_stock]; ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </div>
                            <?php
                            if($stock_lotes) {
                                ?>
                                <div>
                                    <?php echo $trazabilidad->lote_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                                </div>
                                <div>
                                    <?php echo $trazabilidad->caducidad_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                                </div>
                                <?php
                            }
                            if(!$stock_lotes && $stock_numeros_serie) {
                                ?>
                                <div>
                                    <?php echo $trazabilidad->numero_serie_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="flex space-x-2">
                                <div>

                                    <?php
                                    $documentoAAbrir = '';
                                    if($trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "ela") {
                                        echo "Elaboración";
                                    }else if($trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "tra") {
                                        echo "Traspaso";
                                    }else if($trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "reg") {
                                        echo "Regularización";
                                    }else if($trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "pre") {
                                        echo "Presupuesto";
                                    }else if($trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "ped") {
                                        echo "Pedido";
                                    }else if($trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "alb") {
                                        $documentoAAbrir = 'albaranes';
                                        echo "Albarán";
                                    }else if($trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "fac") {
                                        $documentoAAbrir = 'facturas';
                                        echo "Factura";
                                    }else if($trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "tiq") {
                                        $documentoAAbrir = 'tiquets';
                                        echo "Tiquet";
                                    }
                                    ?>
                                </div>
                                <?php
                                if (
                                    $trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "alb" ||
                                    $trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "fac" ||
                                    $trazabilidad->tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "tiq"
                                ) {
                                    ?>
                                    <a href="#" onclick="window.open(window.location.origin + '/<?php echo $documentoAAbrir . '/' . $id_sesion_sys . '/tpv/ventas/documentos/' . $trazabilidad->id_documento_1_documentos_productos_sku_stock[$key_productos_sku_stock] . '-' . $ejercicio . '-' . $trazabilidad->id_librador_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>', '_blank').focus()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div>
                                <?php echo $trazabilidad->fecha_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                            </div>
                            <div>
                                <?php
                                if($trazabilidad->tipo_librador_documentos_productos_sku_stock[$key_productos_sku_stock] == "cli") {
                                    echo "Cliente";
                                }else if($trazabilidad->tipo_librador_documentos_productos_sku_stock[$key_productos_sku_stock] == "pro") {
                                    echo "Proveedor";
                                }else if($trazabilidad->tipo_librador_documentos_productos_sku_stock[$key_productos_sku_stock] == "cre") {
                                    echo "Creditor";
                                }
                                ?>
                            </div>
                            <div class="col-span-2 flex space-x-2">
                                <?php
                                if (empty($trazabilidad->librador_documentos_productos_sku_stock[$key_productos_sku_stock]) || $trazabilidad->librador_documentos_productos_sku_stock[$key_productos_sku_stock] == '0') {
                                    echo '&nbsp;';
                                } else {
                                    ?>
                                    <div>
                                        <?php echo $trazabilidad->librador_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                                    </div>
                                    <a href="#" onclick="abrirFichaEnNuevaPestana(<?php echo $trazabilidad->id_librador_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>, window.location.origin + '/admin/gestion-libradores/tipo=<?php echo $trazabilidad->tipo_librador_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div>
                                <?php echo number_format($trazabilidad->cantidad_documentos_productos_sku_stock[$key_productos_sku_stock], $decimales_cantidades, ',', '.'); ?>
                            </div>
                            <div class="text-right">
                                <?php echo number_format($trazabilidad->importe_documentos_productos_sku_stock[$key_productos_sku_stock], $decimales_importes, ',', '.')." €"; ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }
    }
}
?>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
