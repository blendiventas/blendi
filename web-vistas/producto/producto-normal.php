<?php
if(isset($descripcion_atributos_unicos_producto_sys)) {
    foreach ($descripcion_atributos_unicos_producto_sys as $key_unico_producto => $valor_unico_producto) {
        ?>
        <div class="grid-1 display-block">
            <input type="hidden" name="detalles_producto[]" value="<?php echo $valor_unico_producto; ?>" />
            <?php echo $valor_unico_producto; ?>
        </div>
        <?php
    }
}
$contador_elementos = 0;
$control_boton_comprar = 0;
$key = 0;
?>
<div class="<?php echo ($hiddenPorModalEnProductoCombo)?? ''; ?>">
    <div class="mr-2">
        <?php
        if($disponibilidad_producto_sys[$key] != 0) {
            $comprar_automatico = true;
            if ($packs_disponibles_sys || $id_enlazados_producto_sys[$key] || $id_multiples_producto_sys[$key]) {
                $comprar_automatico = false;
            }
            if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                $etiqueta_pvp = "PVP";
            }else {
                $etiqueta_pvp = "COSTE";
            }
            if($pvp_iva_incluido == 0) {
                $etiqueta_pvp = "Precio";
                $pvp_producto_sys[$key] = $pvp_producto_sys[$key] / (1 + (($iva_producto_sys + $recargo_producto_sys) / 100));
                $pvp_oferta_producto_sys[$key] = $pvp_oferta_producto_sys[$key] / (1 + (($iva_producto_sys + $recargo_producto_sys) / 100));
            }
            if(!empty($dias_entrega_producto_sys[$key])) {
                $dias_entrega_desde = $dias_entrega_producto_sys[$key] + 2;
                $dias_entrega_hasta = $dias_entrega_producto_sys[$key] + 4;
                $fecha_entrega_desde = date("Y-m-d") + $dias_entrega_desde;
                $fecha_entrega_hasta = date("Y-m-d") + $dias_entrega_hasta;
                $descripcion_plazo_entrega = "de " . $dias_entrega_desde[$key] . " a " . $dias_entrega_hasta[$key] . " días (Según sistema de envío que elija)";
            }else {
                $descripcion_plazo_entrega = "consultar.";
            }

            if ($tipo_librador == "tak" || $tipo_librador == "del") {
                $select_sys = "productos-embalajes";
                require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-productos.php");
                foreach ($id_productos_embalajes as $key_id_productos_embalajes => $valor_id_productos_embalajes) {
                    /*
                    if ($recargo == 1) {
                        $baseEmbalajes = $pvp_productos_embalajes[$key_id_productos_embalajes] / (1 + ($iva_producto_sys / 100));
                        $pvp_productos_embalajes[$key_id_productos_embalajes] = $baseEmbalajes + ($baseEmbalajes/100 * $recargo_producto_sys) + ($baseEmbalajes/100 * $iva_producto_sys);
                    }
                    */
                    ?>
                    <input type="hidden" name="embalaje_producto_<?php echo $contador_elementos; ?>[]"
                           class="embalaje_producto_<?php echo $contador_elementos; ?>"
                           data-price="<?php echo $pvp_productos_embalajes[$key_id_productos_embalajes]; ?>"
                           data-sumar="<?php echo $sumar_productos_embalajes[$key_id_productos_embalajes]; ?>"
                           data-cantidad="<?php echo $cantidad_productos_embalajes[$key_id_productos_embalajes]; ?>"
                           value="<?php echo $valor_id_productos_embalajes; ?>" />
                    <?php
                    if ($sumar_productos_embalajes[$key_id_productos_embalajes]) {
                        $totalEmbalajes = $cantidad_productos_embalajes[$key_id_productos_embalajes] * $pvp_productos_embalajes[$key_id_productos_embalajes];
                        $pvp_oferta_producto_sys[$key] += $totalEmbalajes;
                        $pvp_producto_sys[$key] += $totalEmbalajes;
                    }
                }
            }
            if (!isset($comprarConFormularioPorAjax)) {
                ?>
                <hr />
                <?php
            }
            ?>
            <input type="hidden" name="tipo_producto_<?php echo $contador_elementos; ?>" id="tipo_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $tipo_producto_sys; ?>" />
            <input type="hidden" name="imagen_producto_<?php echo $contador_elementos; ?>" id="imagen_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $imagen_producto_sys; ?>" />
            <input type="hidden" name="updated_producto_<?php echo $contador_elementos; ?>" id="updated_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $updated_producto_sys; ?>" />
            <input type="hidden" name="alt_producto_<?php echo $contador_elementos; ?>" id="alt_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $alt_producto_sys; ?>" />
            <input type="hidden" name="tittle_producto_<?php echo $contador_elementos; ?>" id="tittle_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $tittle_producto_sys; ?>" />
            <input type="hidden" name="id_iva_producto_<?php echo $contador_elementos; ?>" id="id_iva_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_iva_producto_sys; ?>" />
            <input type="hidden" name="iva_producto_<?php echo $contador_elementos; ?>" id="iva_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $iva_producto_sys; ?>" />
            <input type="hidden" name="recargo_producto_<?php echo $contador_elementos; ?>" id="recargo_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $recargo_producto_sys; ?>" />
            <input type="hidden" name="packs_disponibles_<?php echo $contador_elementos; ?>" id="packs_disponibles_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $packs_disponibles_sys; ?>" />
            <input type="hidden" name="fecha_entrega_desde_<?php echo $contador_elementos; ?>" id="fecha_entrega_desde_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $fecha_entrega_desde; ?>" />
            <input type="hidden" name="fecha_entrega_hasta_<?php echo $contador_elementos; ?>" id="fecha_entrega_hasta_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $fecha_entrega_hasta; ?>" />
            <input type="hidden" name="pvp_total_<?php echo $contador_elementos; ?>" id="pvp_total_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="0" />

            <div class="flex items-center text-lg font-bold text-center">
                <div class="grow">
                    <input type="text" name="descripcion_producto_<?php echo $contador_elementos; ?>" id="descripcion_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo (empty($descripcion_recuperado))? $descripcion_producto_sys : $descripcion_recuperado; ?>" class="w-full border-0 bg-blendimodal-background" />
                </div>
                <?php
                if(!empty($descripcion_atributos_producto_sys[$key])) {
                    ?>
                    <input type="hidden" name="descripcion_atributos_producto_<?php echo $contador_elementos; ?>" id="descripcion_atributos_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $descripcion_atributos_producto_sys[$key]; ?>" />
                    <?php
                    echo "&nbsp;".$descripcion_atributos_producto_sys[$key];
                }else {
                    ?>
                    <input type="hidden" name="descripcion_atributos_producto_<?php echo $contador_elementos; ?>" id="descripcion_atributos_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                    <?php
                }
                if($interface == "tpv" && $id_usuario == 1) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos/id_productos=<?php echo $id_producto_sys; ?>" class="text-decoration-none" style="vertical-align: middle; margin-left: 4px;" title="Abrir ficha" target="_self">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                    <?php
                }
                ?>
            </div>
            <div class="mt-3">
                <div class="mt-3 ml-3 <?php echo ($hiddenPorModalEnProductoCombo)?? ''; ?>">
                    <input type="hidden" name="cantidad_incremento_<?php echo $contador_elementos; ?>" id="cantidad_incremento_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="1" />
                    <input type="hidden" name="sumar_incremento_<?php echo $contador_elementos; ?>" id="sumar_incremento_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="0" />
                    <div class="text-left text-sm">
                        Cantidad
                    </div>
                    <div class="mt-2 flex flex-wrap items-center">
                        <?php
                        if(!isset($key_producto_relacionado)) {
                            $key_producto_relacionado = $contador_elementos;
                        }
                        $hide = '';
                        $class_hide = '';
                        if($tipo_producto_sys == 3 OR $tipo_producto_sys == 4) { // combo manual o combo automática
                            if($tipo_producto_sys == 4) { // combo automática
                                $hide = ' class="hidden"';
                                $class_hide = ' hidden';
                            }
                            ?>
                            <span class="titulos-productos" id="cantidad_span_combo_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>"></span>
                            <?php
                            if($tipo_producto_sys == 3) {
                                ?>
                                <div class="mt-1 mb-1 mr-1 w-6 h-6 rounded-full text-white bg-blendi-600 dark:bg-blendidark-600" id="restar_producto_relacionado_<?php echo (!isset($key_id_productos_relacionados))? '0' : $key_id_productos_relacionados; ?><?php echo $anadidoModal; ?>" onmouseover="this.style.cursor='pointer'" onclick="restarProductoCestaCombo('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>');">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 pt-1 m-auto text-white dark:text-black">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                    </svg>
                                </div>
                                <input type="text" class="text-center w-12 p-1 border-gray-250 rounded" name="cantidad_<?php echo $contador_elementos; ?>" id="cantidad_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" placeholder="Cantidad" onchange="modificarCantidades('<?php echo $contador_elementos; ?>', '<?php echo $anadidoModal; ?>', true);" onkeyup="if (event.key == 'Enter') { comprarProducto('<?php echo $contador_elementos; ?>','insertar-producto','<?php echo $id_enlazados_producto_sys[$key]; ?>','<?php echo $id_multiples_producto_sys[$key]; ?>','<?php echo $id_packs_producto_sys[$key]; ?>', '<?php echo $anadidoModal; ?>') } e.preventDefault();" value="<?php echo (isset($cantidad_buscar))? $cantidad_buscar : $cantidad_producto; ?>" />
                                <div class="mt-1 mb-1 ml-1 w-6 h-6 rounded-full text-white bg-blendi-600 dark:bg-blendidark-600" id="sumar_producto_relacionado_<?php echo (!isset($key_id_productos_relacionados))? '0' : $key_id_productos_relacionados; ?><?php echo $anadidoModal; ?>" onmouseover="this.style.cursor='pointer'" onclick="sumarProductoCestaCombo('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>');">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 pt-1 m-auto text-white dark:text-black">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </div>
                                <?php
                            } else {
                                ?>
                                <span<?php echo $hide; ?> id="cantidad_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>">1</span>
                                <?php
                            }
                        }else {
                            ?>
                            <div class="mt-1 mb-1 mr-1 w-6 h-6 rounded-full text-white dark:text-black bg-blendi-600 dark:bg-blendidark-600" id="restar_producto_relacionado_<?php echo (!isset($key_id_productos_relacionados))? '0' : $key_id_productos_relacionados; ?><?php echo $anadidoModal; ?>" onmouseover="this.style.cursor='pointer'" onclick="restarProductoCesta('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>');">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 pt-1 m-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                </svg>
                            </div>
                            <input type="text" class="text-center w-12 p-1 border-gray-250 rounded" name="cantidad_<?php echo $contador_elementos; ?>" id="cantidad_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" placeholder="Cantidad" onchange="modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" value="<?php echo (isset($cantidad_buscar))? $cantidad_buscar : $cantidad_producto; ?>" onkeyup="if (event.key == 'Enter') { comprarProducto('<?php echo $contador_elementos; ?>','insertar-producto','<?php echo $id_enlazados_producto_sys[$key]; ?>','<?php echo $id_multiples_producto_sys[$key]; ?>','<?php echo $id_packs_producto_sys[$key]; ?>', '<?php echo $anadidoModal; ?>') } e.preventDefault();" />
                            <div class="mt-1 mb-1 ml-1 w-6 h-6 rounded-full text-white dark:text-black bg-blendi-600 dark:bg-blendidark-600" id="sumar_producto_relacionado_<?php echo (!isset($key_id_productos_relacionados))? '0' : $key_id_productos_relacionados; ?><?php echo $anadidoModal; ?>" onmouseover="this.style.cursor='pointer'" onclick="sumarProductoCesta('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>');">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 pt-1 m-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                if (!isset($comprarConFormularioPorAjax)) {
                    if($interface == "tpv") {
                        $texto_boton = "AÑADIR";
                    }else {
                        $texto_boton = "COMPRAR";
                    }
                    if($tipo_producto_sys != 3 && $tipo_producto_sys != 4) {
                        ?>
                        <button type="button" class="mt-3 col-span-3 boton-comprar hover:text-blendi-600" id="boton_guardar_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" onclick="comprarProducto('<?php echo $contador_elementos; ?>','insertar-producto','<?php echo $id_enlazados_producto_sys[$key]; ?>','<?php echo $id_multiples_producto_sys[$key]; ?>','<?php echo $id_packs_producto_sys[$key]; ?>', '<?php echo $anadidoModal; ?>')"><?php echo $texto_boton; ?></button>
                        <?php
                    }
                }
                ?>
                <div class="mt-3 col-span-3 text-center" id="capa_boton_guardar_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>"></div>
                <?php
                if ($grupos_productos_relacionados_grupos && count($grupos_productos_relacionados_grupos) > 0) {
                    ?>
                    <div class="text-left font-bold text-sm mt-3 ml-4">
                        Orden
                    </div>
                    <?php
                }
                ?>
                <div class="w-full px-4">
                    <?php
                    if(isset($id_productos_relacionados_grupos) && $tipo_producto_sys != 3 && $tipo_producto_sys != 4) {
                        $orden = 0;
                        $selected_option_group = -1;
                        foreach ($grupos_productos_relacionados_grupos as $key_productos_select => $valor_productos_select) {
                            if ($valor_productos_select == $orden_producto) {
                                $selected_option_group = $key_productos_select;
                                $orden = 1;
                                break;
                            }
                        }
                        if ($selected_option_group == -1) {
                            foreach ($categorias['descripcion'] as $key_productos_select => $valor_productos_select) {
                                if ($valor_productos_select == $descripcion_categoria) {
                                    $selected_option_group = $categorias['id_grupo'][$key_productos_select];
                                    $orden = 2;
                                    break;
                                }
                            }
                        }

                        $selected = "";
                        if ($selected_option_group == -1 || ($selected_option_group == 0 && $orden == 2)) {
                            $comprar_automatico = false;
                            $selected = " selected";
                        }
                        ?>
                        <select id="orden<?php echo $anadidoModal; ?>" class="grupos_producto-grupos-opciones" name="orden" required>
                            <option value="" id="orden_0"<?php echo $selected; ?>>Por defecto</option>
                            <?php
                            foreach ($grupos_productos_relacionados_grupos as $key_productos_select => $valor_productos_select) {
                                $selected = "";
                                if($orden == 1) {
                                    if ($selected_option_group == $key_productos_select) {
                                        $selected = " selected";
                                    }
                                }else {
                                    if ($selected_option_group == $id_productos_relacionados_grupos[$key_productos_select]) {
                                        $selected = " selected";
                                    }
                                }
                                ?>
                                <option value="<?php echo $valor_productos_select; ?>" id="orden_<?php echo $id_productos_relacionados_grupos[$key_productos_select]; ?>"<?php echo $selected; ?>><?php echo $valor_productos_select; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
                    }
                    unset($id_productos_relacionados_grupos);
                    unset($grupos_productos_relacionados_grupos);
                    ?>
                </div>
            </div>




            <div class="flex text-center">
                <?php
                require("producto-atributos.php");
                ?>
            </div>
            <?php
            if(isset($referencia_producto_sys[$key])) {
                ?>
                <input type="hidden" name="id_productos_sku_<?php echo $contador_elementos; ?>" id="id_productos_sku_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_productos_sku_sys[$key]; ?>" />
                <input type="hidden" name="codigo_barras_producto_<?php echo $contador_elementos; ?>" id="codigo_barras_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $codigo_barras_producto_sys[$key]; ?>" />
                <input type="hidden" name="referencia_producto_<?php echo $contador_elementos; ?>" id="referencia_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $referencia_producto_sys[$key]; ?>" />
                <input type="hidden" name="coste_producto_<?php echo $contador_elementos; ?>" id="coste_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $coste_producto_principal_sys; ?>" />
                <input type="hidden" name="lote_producto_<?php echo $contador_elementos; ?>" id="lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $lote_recuperado; ?>" />
                <input type="hidden" name="cantidad_lote_producto_<?php echo $contador_elementos; ?>" id="cantidad_lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $cantidad_producto; ?>" />
                <input type="hidden" name="numero_serie_producto_<?php echo $contador_elementos; ?>" id="numero_serie_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $numero_serie_recuperado; ?>" />
                <input type="hidden" name="caducidad_producto_<?php echo $contador_elementos; ?>" id="caducidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $caducidad_recuperado; ?>" />
                <?php
                if(!empty($referencia_producto_sys[$key]) || !empty($codigo_barras_producto_sys[$key])) {
                    ?>
                    <div class="grid grid-cols-2 font-bold px-4">
                        <div class="text-left">
                            <?php
                            if(!empty($referencia_producto_sys[$key])) {
                                ?>
                                <span class="titulos-productos">Referencia:&nbsp;</span><?php echo $referencia_producto_sys[$key]; ?>
                                <?php
                            }else {
                                echo '&nbsp';
                            }
                            ?>
                        </div>
                        <div class="text-right">
                            <?php
                            if(!empty($codigo_barras_producto_sys[$key])) {
                                ?>
                                <span class="titulos-productos">Código de barras:&nbsp;</span><?php echo $codigo_barras_producto_sys[$key]; ?>
                                <?php
                            }else {
                                echo '&nbsp';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="px-4">
                    <?php
                    if($tipo_documento == "alb" || $tipo_documento == "fac" || $tipo_documento == "tiq") {
                        if($tipo_librador == "pro") {
                            ?>
                            <div class="grid grid-cols-3 space-x-2">
                                <div>
                                    <div>
                                        Lote:
                                    </div>
                                    <input type="text" class="w-full" maxlength="20" value="<?php echo $lote_recuperado; ?>" onchange="document.getElementById('lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value=this.value" />
                                </div>
                                <div>
                                    <div>
                                        Caducidad:
                                    </div>
                                    <input type="date" class="w-full" value="<?php echo $caducidad_recuperado; ?>" onchange="document.getElementById('caducidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value=this.value" />
                                </div>
                                <div>
                                    <div>
                                        Número de serie:
                                    </div>
                                    <input type="text" class="w-full" maxlength="20" value="<?php echo $numero_serie_recuperado; ?>" onchange="document.getElementById('numero_serie_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value=this.value" />
                                </div>
                            </div>
                            <?php
                        }else if($tipo_librador != "cre") {
                            $lote_producto_encontrado = false;
                            $checked = " checked";
                            foreach ($lote_producto_stock as $key_lote_producto_stock => $valor_lote_producto_stock) {
                                $comprar_automatico = false;
                                if($lote_recuperado == $valor_lote_producto_stock) {
                                    $lote_producto_encontrado = true;
                                    $checked = " checked";
                                }else if(isset($lote_encontrado_por_codigo_barras)) {
                                    if($lote_encontrado_por_codigo_barras == $valor_lote_producto_stock) {
                                        $lote_producto_encontrado = true;
                                        $checked = " checked";
                                    }
                                }
                                if($checked == " checked") {
                                    if(!isset($id_linea) || $id_linea == null) {
                                        ?>
                                        <script>
                                            (function() {
                                                document.getElementById('coste_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $coste_producto_stock[$key_lote_producto_stock]; ?>';
                                                document.getElementById('lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $valor_lote_producto_stock; ?>';
                                                document.getElementById('cantidad_lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $stock_producto_stock[$key_lote_producto_stock]; ?>';
                                                document.getElementById('caducidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $caducidad_producto_stock[$key_lote_producto_stock]; ?>';
                                            })();
                                        </script>
                                        <?php
                                    }else {
                                        ?>
                                        <script>
                                            (function() {
                                                document.getElementById('coste_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $coste_producto_stock[$key_lote_producto_stock]; ?>';
                                                document.getElementById('lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $valor_lote_producto_stock; ?>';
                                                document.getElementById('cantidad_lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $stock_producto_stock[$key_lote_producto_stock]; ?>';
                                                document.getElementById('caducidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $caducidad_producto_stock[$key_lote_producto_stock]; ?>';
                                            })();
                                        </script>
                                        <?php
                                    }
                                }
                                ?>
                                <div>
                                    <input type="radio" name="radio_lote"<?php echo $checked; ?> value="<?php echo ($checked)? ($cantidad_producto + $stock_producto_stock[$key_lote_producto_stock]) : $stock_producto_stock[$key_lote_producto_stock]; ?>" onclick="document.getElementById('coste_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value='<?php echo $coste_producto_stock[$key_lote_producto_stock]; ?>'; document.getElementById('lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value='<?php echo $valor_lote_producto_stock; ?>'; document.getElementById('cantidad_lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo ($checked)? ($cantidad_producto + $stock_producto_stock[$key_lote_producto_stock]) : $stock_producto_stock[$key_lote_producto_stock]; ?>'; document.getElementById('caducidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value='<?php echo $caducidad_producto_stock[$key_lote_producto_stock]; ?>';" />
                                    <span class="titulos-productos">Lote:&nbsp;</span><?php echo $lote_producto_stock[$key_lote_producto_stock]; ?>
                                    <span class="titulos-productos">Caducidad:&nbsp;</span><?php echo $caducidad_producto_stock[$key_lote_producto_stock]; ?>
                                    <span class="titulos-productos">Stock:&nbsp;</span><?php echo $stock_producto_stock[$key_lote_producto_stock]; ?>
                                </div>
                                <?php
                                $checked = "";
                            }
                            if($lote_producto_encontrado == false && !empty($lote_recuperado)) {
                                ?>
                                <div>
                                    <input type="radio" name="radio_lote" checked value="<?php echo $cantidad_producto; ?>" onclick="document.getElementById('coste_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value='<?php echo $coste_producto_principal_sys; ?>'; document.getElementById('lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value='<?php echo $lote_recuperado; ?>'; document.getElementById('cantidad_lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo ((isset($cantidad_buscar)) ? $cantidad_buscar : $cantidad_producto); ?>'; document.getElementById('caducidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value='<?php echo $caducidad_recuperado; ?>';" />
                                    <span class="titulos-productos">Lote:&nbsp;</span><?php echo $lote_recuperado; ?>
                                    <span class="titulos-productos">Caducidad:&nbsp;</span><?php echo $caducidad_recuperado; ?>
                                    <span class="titulos-productos">Stock:&nbsp;</span><?php echo $cantidad_producto; ?>
                                </div>
                                <script>
                                    (function() {
                                        document.getElementById('coste_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $coste_producto_principal_sys; ?>';
                                        document.getElementById('lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $lote_recuperado; ?>';
                                        document.getElementById('cantidad_lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo (isset($cantidad_buscar)) ? $cantidad_buscar : $cantidad_producto; ?>';
                                        document.getElementById('caducidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = '<?php echo $caducidad_recuperado; ?>';
                                    })();
                                </script>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <?php
            }else {
                ?>
                <input type="hidden" name="id_productos_sku_<?php echo $contador_elementos; ?>" id="id_productos_sku_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                <input type="hidden" name="codigo_barras_producto_<?php echo $contador_elementos; ?>" id="codigo_barras_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                <input type="hidden" name="referencia_producto_<?php echo $contador_elementos; ?>" id="referencia_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                <input type="hidden" name="coste_producto_<?php echo $contador_elementos; ?>" id="coste_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                <input type="hidden" name="lote_producto_<?php echo $contador_elementos; ?>" id="lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                <input type="hidden" name="cantidad_lote_producto_<?php echo $contador_elementos; ?>" id="cantidad_lote_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                <input type="hidden" name="numero_serie_producto_<?php echo $contador_elementos; ?>" id="numero_serie_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                <input type="hidden" name="caducidad_producto_<?php echo $contador_elementos; ?>" id="caducidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="" />
                <?php
            }
            ?>
            <input type="hidden" name="disponibilidad_producto_<?php echo $contador_elementos; ?>" id="disponibilidad_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $disponibilidad_producto_sys[$key]; ?>" />
            <input type="hidden" name="peso_producto_<?php echo $contador_elementos; ?>" id="peso_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $peso_producto_sys[$key]; ?>" />
            <input type="hidden" name="envio_gratis_producto_<?php echo $contador_elementos; ?>" id="envio_gratis_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $envio_gratis_producto_sys[$key]; ?>" />
            <?php
            require("productos-card-body.php");
            if(($tipo_producto_sys == 0 || $tipo_producto_sys == 1) && $mostra_nota_productos && $interface == "tpv") {
                ?>
                <div class="w-full mt-3 px-4">
                    <div class="text-left font-bold text-sm">
                        Notas
                    </div>
                    <textarea class="w-full mt-2 border-gray-250 rounded" name="observacion_<?php echo $contador_elementos; ?>" id="nota_producto_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" placeholder="Añadir anotación"><?php echo (isset($nota_linea_producto))? $nota_linea_producto : ''; ?></textarea>
                </div>
                <?php
            }
            if($interface == "web") {
                if(!empty($dias_entrega_producto_sys[$key]) && $plazo_entrega_productos == true) {
                    ?>
                    <div class="text-center color-red font-bold mt-8p">
                        Plazo de entrega aproximado: <?php echo $descripcion_plazo_entrega; ?>
                    </div>
                    <?php
                }else if($plazo_entrega_productos == false) {
                    $texto_plazo = "<hr />Plazo de entrega aproximado: ".$descripcion_plazo_entrega;
                }
            }
            if(!empty($observaciones_producto_sys[$key])) {
                ?>
                <div class="text-left m-10-40-10-40 font-normal p-4p titulos-productos">
                    <?php echo $observaciones_producto_sys[$key]; ?>
                </div>
                <?php
            }
            ?>
            <script type="application/javascript">
                (function() {
                    modificarCantidades('<?php echo $contador_elementos; ?>', '<?php echo $anadidoModal; ?>', false);
                    <?php
                    /* Detectar si te lots o numeros de serie abans de clicar añadir automaticament */
                    if(($tipo_producto_sys == 0 || $tipo_producto_sys == 1) && $tipo_librador != "pro" && $tipo_librador != "cre" && $interface == "tpv" && $comprar_automatico == true) {
                        if(!isset($id_linea) || $id_linea == null) {
                            ?>
                            comprarProducto('<?php echo $contador_elementos; ?>','insertar-producto','<?php echo $id_enlazados_producto_sys[$key]; ?>','<?php echo $id_multiples_producto_sys[$key]; ?>','<?php echo $id_packs_producto_sys[$key]; ?>', '<?php echo $anadidoModal; ?>');
                            <?php
                        }
                    }
                    if (isset($modificar_linea) && $modificar_linea != '' && empty($id_documento_producto_relacionado_combo_sys)) {
                        if($tipo_producto_sys == 3 || $tipo_producto_sys == 4) {
                            if ($modificar_linea == 'sumar') {
                                ?>
                                sumarProductoCestaCombo('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>');
                                <?php
                            }
                            if ($modificar_linea == 'restar') {
                                ?>
                                restarProductoCestaCombo('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>');
                                <?php
                            }
                        } else {
                            if ($modificar_linea == 'sumar') {
                                ?>
                                sumarProductoCesta('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>');
                                <?php
                            }
                            if ($modificar_linea == 'restar') {
                                ?>
                                restarProductoCesta('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>');
                                <?php
                            }
                        }
                    }
                    ?>
                })();
            </script>
            <?php
            $control_boton_comprar += 1;
        }
        ?>
    </div>
</div>