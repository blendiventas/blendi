<?php
$select_sys = "unidades";
require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");
?>

<input type="hidden" id="id_productos_sku_stock" value="<?php echo $id_productos_sku; ?>" />
<input type="hidden" id="id_documento_1" value="" />
<input type="hidden" id="id_documento_2" value="" />
<input type="hidden" id="id_librador" value="" />
<input type="hidden" id="id_unidades" value="" />

<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="lote_">Lote:</label><br>
        <input type="text" class="w-full" id="lote" placeholder="Lote" value="" />
    </div>
    <div>
        <label for="caducidad_">Caducidad:</label><br>
        <input type="date" class="w-full" id="caducidad" />
    </div>
    <div>
        <label for="numero_serie_">Número serie:</label><br>
        <input type="text" class="w-full" id="numero_serie" placeholder="Número serie" value="" />
    </div>
    <div class="hidden">
        <label for="tipo_documento">Tipo:</label>
        <select id="tipo_documento">
            <option value="reg" selected>Regularización</option>
        </select>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="fecha_">Fecha:</label><br>
        <input type="date" class="w-full" id="fecha" value="<?php echo date("Y-m-d"); ?>" />
    </div>
    <div>
        <label for="cantidad_">Cantidad:</label><br>
        <input type="number" class="w-full" id="cantidad" placeholder="Cantidad" value="" onchange="mostrarOcultarTraspasarProducto()" />
    </div>
    <div>
        <label for="unidad">Unidad:</label><br>
        <select class="w-full" id="unidad">
            <?php
            foreach ($id_productos_unidades as $key_id_unidades => $valor_id_unidades) {
                $selected = "";
                if($principal_productos_unidades[$key_id_unidades] == 1) {
                    $selected = " selected";
                }
                ?>
                <option value="<?php echo $valor_id_unidades; ?>"<?php echo $selected; ?>><?php echo $unidad_unidades[$id_unidad_productos_unidades[$key_id_unidades]]." (".$abreviatura_unidades[$id_unidad_productos_unidades[$key_id_unidades]].")"; ?></option>
                <?php
                $selected = "";
            }
            ?>
        </select>
    </div>
</div>
<?php
unset($id_unidades);
unset($unidad_unidades);
unset($abreviatura_unidades);

$select_sys = "datos-stock";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
?>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div class="col-span-2">
        <div class="w-full flex items-center hidden" id="capa_producto_a_traspasar">
            <div>
                ¿Traspasar el stock a otro producto?
            </div>
            <div class="grow">
                <?php
                $titulo_id = 1;
                $titulo_relacionados_key = 1;
                ?>
                <input type="hidden" id="titulo_relacionado_producto_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>" class="titulo_relacionado_producto_<?php echo $titulo_id; ?>" value="" />
                <div id="titulo_relacionado_dropdown_descripcion_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>_trigger">
                    <input type="text" name="titulo_relacionado_descripcion[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 titulo_relacionado_descripcion_<?php echo $titulo_id; ?>" value="" onkeyup="descripcionBuscador(<?php echo $titulo_id; ?>, <?php echo $titulo_relacionados_key; ?>, <?php echo $id_url; ?>)" />
                </div>
                <div id="titulo_relacionado_dropdown_descripcion_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>" class="hidden bg-white border-2 rounded bg-white cursor-pointer titulo_relacionado_descripcion_buscador_<?php echo $titulo_id; ?>">
                    ...
                </div>
            </div>
            <script type="text/javascript">
                loadDropdownDescripcionBuscador(<?php echo $titulo_id; ?>, <?php echo $titulo_relacionados_key; ?>);
            </script>
        </div>
    </div>
    <div id="capa_guardar_update" class="text-right">
        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarStock('<?php echo $id_url; ?>','<?php echo $id_productos_otros; ?>','<?php echo $id_productos_sku; ?>','<?php echo $id_productos_detalles_enlazado; ?>','<?php echo $id_productos_detalles_multiples; ?>','<?php echo $id_packs; ?>');">Guardar</button>
    </div>
</div>
<?php

if($control_stock == 1) {
    $ejercicio = date('Y');
    $select_sys = "stock";
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");

    $select_sys = "stock-listado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");

    if(isset($matriz_stock_lote)) {
        $columnes = 3;
        if($stock_lotes) {
            $columnes += 3;
        }
        if($stock_numeros_serie) {
            $columnes += 3;
        }
        ?>
        <div class="grid grid-cols-1 sm:grid-cols-<?php echo $columnes; ?> items-center sm:h-10 bg-gray-50 mt-6">
            <div class="px-2">&nbsp;</div>
            <?php
            if($stock_lotes) {
                echo '<div class="px-2 text-left col-span-3">Lote</div>';
            }
            if($stock_numeros_serie) {
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
            if($stock_numeros_serie) {
                echo '<div class="px-2 text-left col-span-3">' . $matriz_stock_numero_serie[$key_stock_lote] . '</div>';
            }
            echo '<div class="px-2 col-span-2">'.$matriz_stock_stock[$key_stock_lote].'</div>';
            echo '</div>';
            ?>
            <div id="tabla_datos_stock_<?php echo $key_stock_lote; ?>" class="hidden">
                <div class="grid grid-cols-1 sm:grid-cols-10 items-center sm:h-10 bg-gray-50 mt-6">
                    <div>Lote</div>
                    <div>Caducidad</div>
                    <div>Número serie</div>
                    <div>Tipo</div>
                    <div>Fecha</div>
                    <div class="col-span-2">Tipo librador</div>
                    <div>Librador</div>
                    <div>Cantidad</div>
                    <div>Importe</div>
                </div>
                <?php
                foreach ($id_documentos_productos_sku_stock as $key_productos_sku_stock => $valor_productos_sku_stock) {
                    if((!empty($matriz_stock_lote[$key_stock_lote]) && $lote_documentos_productos_sku_stock[$key_productos_sku_stock] == $matriz_stock_lote[$key_stock_lote]) ||
                        (!empty($matriz_stock_numero_serie[$key_stock_lote]) && $numero_serie_documentos_productos_sku_stock[$key_productos_sku_stock] == $matriz_stock_numero_serie[$key_stock_lote]) ||
                        (empty($matriz_stock_lote[$key_stock_lote]) && empty($matriz_stock_numero_serie[$key_stock_lote]) && empty($lote_documentos_productos_sku_stock[$key_productos_sku_stock]) && empty($numero_serie_documentos_productos_sku_stock[$key_productos_sku_stock]))) {
                        ?>
                        <div class="grid grid-cols-1 sm:grid-cols-10 items-center sm:h-16 bg-white border-2 border-gray-50">
                            <div>
                                <?php echo $lote_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                            </div>
                            <div>
                                <?php echo $caducidad_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                            </div>
                            <div>
                                <?php echo $numero_serie_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                            </div>
                            <div class="flex space-x-2">
                                <div>
                                    <?php
                                    $documentoAAbrir = '';
                                    if($tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "ela") {
                                        echo "Elaboración";
                                    }else if($tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "tra") {
                                        echo "Traspaso";
                                    }else if($tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "reg") {
                                        echo "Regularización";
                                    }else if($tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "pre") {
                                        echo "Presupuesto";
                                    }else if($tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "ped") {
                                        echo "Pedido";
                                    }else if($tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "alb") {
                                        $documentoAAbrir = 'albaranes';
                                        echo "Albarán";
                                    }else if($tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "fac") {
                                        $documentoAAbrir = 'facturas';
                                        echo "Factura";
                                    }else if($tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "tiq") {
                                        $documentoAAbrir = 'tiquets';
                                        echo "Tiquet";
                                    }
                                    ?>
                                </div>
                                <?php
                                if (
                                    $tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "alb" ||
                                    $tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "fac" ||
                                    $tipo_documento_documentos_productos_sku_stock[$key_productos_sku_stock] == "tiq"
                                ) {
                                    ?>
                                    <a href="#" onclick="window.open(window.location.origin + '/<?php echo $documentoAAbrir . '/' . $id_sesion_sys . '/tpv/ventas/documentos/' . $id_documento_1_documentos_productos_sku_stock[$key_productos_sku_stock] . '-' . $ejercicio . '-' . $id_librador_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>', '_blank').focus()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div>
                                <?php echo $fecha_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                            </div>
                            <div>
                                <?php
                                if($tipo_librador_documentos_productos_sku_stock[$key_productos_sku_stock] == "cli") {
                                    echo "Cliente";
                                }else if($tipo_librador_documentos_productos_sku_stock[$key_productos_sku_stock] == "pro") {
                                    echo "Proveedor";
                                }else if($tipo_librador_documentos_productos_sku_stock[$key_productos_sku_stock] == "cre") {
                                    echo "Creditor";
                                }
                                ?>
                            </div>
                            <div class="col-span-2 flex space-x-2">
                                <?php
                                if (empty($librador_documentos_productos_sku_stock[$key_productos_sku_stock]) || $librador_documentos_productos_sku_stock[$key_productos_sku_stock] == '0') {
                                    echo '&nbsp;';
                                } else {
                                    ?>
                                    <div>
                                        <?php echo $librador_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                                    </div>
                                    <a href="#" onclick="abrirFichaEnNuevaPestana(<?php echo $id_librador_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>, window.location.origin + '/admin/gestion-libradores/tipo=<?php echo $tipo_librador_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div>
                                <?php echo $cantidad_documentos_productos_sku_stock[$key_productos_sku_stock]; ?>
                            </div>
                            <div class="text-right">
                                <?php echo $importe_documentos_productos_sku_stock[$key_productos_sku_stock]." €"; ?>
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
