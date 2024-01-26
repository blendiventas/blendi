<?php
/*
if ($tipo_producto_productos == 0) Normal
if ($tipo_producto_productos == 1) Elaborado
if ($tipo_producto_productos == 2) Compuesto
if ($tipo_producto_productos == 3) Combo manual
if ($tipo_producto_productos == 4) Combo automático
*/
if(isset($descripcion_atributos_unicos_producto_sys)) {
    foreach ($descripcion_atributos_unicos_producto_sys as $key_atributos_unicos => $valor_atributos_unicos) {
        ?>
        <div class="grid-1 display-block">
            <?php echo $valor_atributos_unicos; ?>
        </div>
        <?php
    }
}

require("producto-normal.php");
echo require("producto-normal-footer.php");

$select_sys = "productos-grupos";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
$id_producto_pral = $id_producto_sys;
$contador_elementos = 0;
$contador_grupos_mostrados = 0;
$totalGrupos = 0;
?>
<input type="hidden" name="producto_grupos_tipo" id="producto_grupos_tipo<?php echo $anadidoModal; ?>" value="<?php echo $tipo_producto_sys; ?>" />
<input type="hidden" name="total_productos_anadidos" id="total_productos_anadidos<?php echo $anadidoModal; ?>" value="0" />
<div class="overflow-y-auto <?php echo ($hiddenPorModalEnProductoCombo)?? ''; ?>" id="capa-grid-producto-combo<?php echo $anadidoModal; ?>">
    <?php
    $relacion_contador_grupos_mostrados_id_producto = [];
    $relacion_contador_productos_por_grupo_id_producto = [];
    foreach ($grupos_productos_relacionados_grupos as $key_grupos_productos_relacionados_grupos => $valor_grupos_productos_relacionados_grupos) {
        $select_sys = "productos-grupo";
        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
        if(isset($id_producto_grupos)) {
            $totalGrupos += 1;
            ?>
            <hr />
            <div class="grid-1">
                <div class="row text-center font-bold">
                    <span class="titulos-productos" id="cantidad_span_grupo_combo_<?php echo $contador_grupos_mostrados; ?><?php echo $anadidoModal; ?>"></span>
                    <input type="hidden" name="cantidad_input_grupo_combo_<?php echo $contador_grupos_mostrados; ?>" id="cantidad_input_grupo_combo_<?php echo $contador_grupos_mostrados; ?><?php echo $anadidoModal; ?>" value="0" />
                    <?php echo strtoupper($valor_grupos_productos_relacionados_grupos); ?>
                </div>
            </div>
            <input type="hidden" name="producto_grupos_input_grupo_combo_<?php echo $contador_grupos_mostrados; ?>" id="producto_grupos_input_grupo_combo_<?php echo $contador_grupos_mostrados; ?><?php echo $anadidoModal; ?>" value="<?php echo count($id_producto_grupos[$contador_grupos_mostrados]); ?>" />
            <div id="capa-grid-productos" class="grid grid-cols-1 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 overflow-y-auto">
                <?php
                foreach ($id_producto_grupos[$contador_grupos_mostrados] as $key_producto_grupos => $valor_producto_grupos) {
                    $id_producto_sys = $id_relacionado_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos];
                    $relacion_contador_grupos_mostrados_id_producto[$id_producto_sys] = $contador_grupos_mostrados;
                    $relacion_contador_productos_por_grupo_id_producto[$id_producto_sys] = $key_producto_grupos;
                    $indice_adicional = '-grupos-opciones_' . $contador_grupos_mostrados . '_' . $key_producto_grupos;

                    if($pvp_iva_incluido == 0) {
                        if ($sumar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos]) {
                            $sumar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos] = $sumar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos] / (1 + ($iva_producto_sys / 100));
                        }
                    }

                    $select_sys = "producto";
                    require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-productos.php");
                    $packs_disponibles_sys = $packs_disponibles;
                    ?>
                    <input type="hidden" name="descripcion_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="descripcion_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="<?php echo $descripcion_producto; ?>" />
                    <input type="hidden" name="id_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="id_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos]; ?>" />
                    <input type="hidden" name="id_relacionado_producto_grupos-<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="id_relacionado_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_relacionado_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos]; ?>" />
                    <input type="hidden" name="id_grupo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="id_grupo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_grupo_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos]; ?>" />
                    <input type="hidden" name="fijo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="fijo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="<?php echo $fijo_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos]; ?>" />
                    <input type="hidden" name="modelo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="modelo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="<?php echo $modelo_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos]; ?>" />
                    <input type="hidden" name="mostrar_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="mostrar_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="<?php echo $mostrar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos]; ?>" />

                    <div id="producto_grupo_<?php echo $contador_grupos_mostrados . '_' . $key_producto_grupos; ?>" class="bg-white rounded p-2 mx-1 mb-2 overflow-y-hidden font-bold text-sm drop-shadow-md" onmouseover="this.style.cursor='pointer'" onclick="anadirProductoCombo('<?php echo $contador_grupos_mostrados; ?>', '<?php echo $key_producto_grupos; ?>','<?php echo $anadidoModal; ?>', true, false, 1, '');">
                        <div class="flex items-center producto_grupo" data-price="<?php echo ($sumar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos])?? '0'; ?>">
                            <input type="hidden" name="id_relacionado_combo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="id_relacionado_combo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos]; ?>" />
                            <input type="hidden" name="cantidad_relacionado_combo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="cantidad_relacionado_combo_producto_grupos_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="1" class="cantidad_relacionado_combo_producto_grupos" />
                            <input type="hidden" name="id_documentos_combo_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="id_documentos_combo_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="" />
                            <input type="hidden" name="modificado_documentos_combo_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" id="modificado_documentos_combo_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" value="" class="modificado_documentos_combo" />
                            <div id="cantidad-grupos_producto-grupos-opciones_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" class="hidden row text-center font-bold flex items-center">&nbsp;</div>
                            <div class="text-center font-bold flex items-center hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 hidden" id="boton_desplazar_<?php echo $contador_grupos_mostrados; ?>_<?php echo $key_producto_grupos; ?><?php echo $anadidoModal; ?>" onmouseover="this.style.cursor='pointer'" onclick="document.location.href = '#productos_anadidos<?php echo $anadidoModal; ?>';">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3"></path>
                                </svg>
                            </div>
                            <?php
                            if(!empty($imagen_producto)) {
                                ?>
                                <div class="card-header">
                                    <img src="/images/productos/<?php echo $id_panel . "/" . $imagen_producto; ?>?ver=<?php echo $updated_producto; ?>" class="img-productos"
                                         alt="<?php echo $alt_producto; ?>"
                                         title="<?php echo $tittle_producto; ?>" onclick="document.getElementById('imagen-original').src = '/images/productos/<?php echo $id_panel . "/" . $imagen_producto; ?>?ver=<?php echo $updated_producto; ?>';" />
                                </div>
                                <div class="card-body md:overflow-x-auto grow pl-1">
                                    <div>
                                        <?php
                                        echo $descripcion_producto;
                                        ?>
                                    </div>
                                    <div class="flex">
                                        <div class="card-footer font-normal grow mt-1">
                                            <?php
                                            if($sumar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos] != 0.00) {
                                                echo "+&nbsp;".number_format($sumar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos], $decimales_importes, ',', '.')."&nbsp;€";
                                            }else {
                                                echo "&nbsp;";
                                            }
                                            ?>
                                        </div>

                                        <div class="bg-blendi-600 dark:bg-blendidark-600 rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white dark:text-black">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="card-body h-75 vertical-center-div overflow-x-auto grow w-full">
                                    <div>
                                        <?php echo $descripcion_producto; ?>
                                    </div>
                                    <div class="flex">
                                        <div class="card-footer font-normal grow mt-1">
                                            <?php
                                            if($sumar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos] != 0.00) {
                                                echo "+&nbsp;".number_format($sumar_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos], $decimales_importes, ',', '.')."&nbsp;€";
                                            }else {
                                                echo "&nbsp;";
                                            }
                                            ?>
                                        </div>

                                        <div class="bg-blendi-600 dark:bg-blendidark-600 rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white dark:text-black">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="col-span-2">
                                <div class="h-full flex items-center justify-center">
                                    <a class="boton-nota hidden" onclick="collapseCapa('capa-contenido-grupos-opciones_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>');" id="capa-grupos-opciones_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>">
                                        Opciones
                                    </a>
                                </div>
                            </div>

                            <div class="grow text-center hidden">
                                <select id="grupos_producto-grupos-opciones_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>" class="w-full grupos_producto-grupos-opciones" name="grupos_producto-grupos-opciones_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?>" required>
                                    <?php
                                    foreach ($grupos_productos_relacionados_grupos as $key_productos_select => $valor_productos_select) {
                                        $selected = "";
                                        if($key_productos_select == $contador_grupos_mostrados) {
                                            $selected = " selected";
                                        }
                                        ?>
                                        <option value="<?php echo $id_productos_relacionados_grupos[$key_productos_select]; ?>" id="<?php echo $id_productos_relacionados_grupos[$key_productos_select]; ?>-option_producto-grupos-opciones_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>"<?php echo $selected; ?>><?php echo $valor_productos_select; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row text-center flex justify-center items-center hidden">
                                <div class="mt-1 mb-1 w-8 h-8 rounded-full text-white bg-blendi-600" id="boton_anadir_<?php echo $contador_grupos_mostrados; ?>_<?php echo $key_producto_grupos; ?><?php echo $anadidoModal; ?>" onmouseover="this.style.cursor='pointer'" onclick="anadirProductoCombo('<?php echo $contador_grupos_mostrados; ?>', '<?php echo $key_producto_grupos; ?>','<?php echo $anadidoModal; ?>', true, false, 1, '');">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 pt-1 m-auto text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
                                    </svg>
                                </div>
                            </div>
                            <?php
                            $descripcion_producto_sys = $descripcion_producto;
                            $tipo_producto_sys = $tipo_producto;
                            $imagen_producto_sys = $imagen_producto;
                            $updated_producto_sys = $updated_producto;
                            $alt_producto_sys = $alt_producto;
                            $tittle_producto_sys = $tittle_producto;
                            $iva_producto_sys = $iva_producto;
                            $recargo_producto_sys = $recargo_producto;
                            foreach ($id_unidades as $key_id_unidades => $valor_id_unidades) {
                                $unidad_producto_sys[] = $unidad_producto[$key_id_unidades];
                                $unidad_principal_producto_sys[] = $unidad_principal_producto[$key_id_unidades];
                                $conversion_unidad_producto_sys[] = $conversion_unidad_producto[$key_id_unidades];
                            }
                            foreach ($descripcion_atributos_unicos_producto as $key_descripcion_atributos_unicos_producto => $valor_descripcion_atributos_unicos_producto) {
                                $descripcion_atributos_unicos_producto_sys[] = $valor;
                            }
                            $contador = 0;
                            foreach ($id_enlazados_producto as $key_id_enlazados_producto => $valor_id_enlazados_producto) {
                                $id_enlazados_producto_sys[$contador] = $id_enlazados_producto[$key_id_enlazados_producto];
                                $id_multiples_producto_sys[$contador] = $id_multiples_producto[$key_id_enlazados_producto];
                                $id_packs_producto_sys[$contador] = $id_packs_producto[$key_id_enlazados_producto];
                                if (isset($descripcion_atributos_producto[$key_id_enlazados_producto])) {
                                    $descripcion_atributos_producto_sys[$contador] = $descripcion_atributos_producto[$key_id_enlazados_producto];
                                }
                                if (isset($cantidad_packs_producto[$key_id_enlazados_producto])) {
                                    $cantidad_packs_producto_sys[$contador] = $cantidad_packs_producto[$key_id_enlazados_producto];
                                }
                                $control_stock_producto_sys[$contador] = $control_stock_producto[$key_id_enlazados_producto];
                                $disponibilidad_producto_sys[$contador] = $disponibilidad_producto[$key_id_enlazados_producto];
                                $profesionales_producto_sys[$contador] = $profesionales_producto[$key_id_enlazados_producto];
                                $peso_producto_sys[$contador] = $peso_producto[$key_id_enlazados_producto];
                                $bultos_producto_sys[$contador] = $bultos_producto[$key_id_enlazados_producto];
                                $gastos_producto_sys[$contador] = $gastos_producto[$key_id_enlazados_producto];
                                $envio_gratis_producto_sys[$contador] = $envio_gratis_producto[$key_id_enlazados_producto];
                                $dias_entrega_producto_sys[$contador] = $dias_entrega_producto[$key_id_enlazados_producto];
                                $aplicar_descuento_producto_sys[$contador] = $aplicar_descuento_producto[$key_id_enlazados_producto];
                                $descuento_maximo_producto_sys[$contador] = $descuento_maximo_producto[$key_id_enlazados_producto];
                                foreach ($id_productos_sku_sys[$key_id_enlazados_producto] as $key_sku => $valor_sku) {
                                    $id_productos_sku_sys[$contador][] = $id_productos_sku[$key_id_enlazados_producto];
                                    $codigo_barras_producto_sys[$contador][] = $codigo_barras_producto[$key_id_enlazados_producto];
                                    $referencia_producto_sys[$contador][] = $referencia_producto[$key_id_enlazados_producto];
                                    $lote_producto_sys[$contador][] = $lote_producto[$key_id_enlazados_producto];
                                    $caducidad_producto_sys[$contador][] = $caducidad_producto[$key_id_enlazados_producto];
                                    $numero_serie_producto_sys[$contador][] = $numero_serie_producto[$key_id_enlazados_producto];
                                    $stock_producto_sys[$contador][] = $stock_producto[$key_id_enlazados_producto];
                                }
                                $pvp_producto_sys[$contador] = $pvp_producto[$key_id_enlazados_producto];
                                if (isset($id_ofertas_producto[$key_id_enlazados_producto])) {
                                    $id_ofertas_producto_sys[$contador] = $id_ofertas_producto[$key_id_enlazados_producto];
                                    $oferta_desde_producto_sys[$contador] = $oferta_desde_producto[$key_id_enlazados_producto];
                                    $oferta_hasta_producto_sys[$contador] = $oferta_hasta_producto[$key_id_enlazados_producto];
                                    $pvp_oferta_producto_sys[$contador] = $pvp_oferta_producto[$key_id_enlazados_producto];
                                    $descripcion_ofertas_producto_sys[$contador] = $descripcion_ofertas_producto[$key_id_enlazados_producto];
                                }
                                if (isset($images_producto[$key_id_enlazados_producto])) {
                                    $images_producto_sys[$contador] = $images_producto[$key_id_enlazados_producto];
                                    $images_updated_producto_sys[$contador] = $images_updated_producto[$key_id_enlazados_producto];
                                    $images_alt_producto_sys[$contador] = $images_alt_producto[$key_id_enlazados_producto];
                                    $images_tittle_producto_sys[$contador] = $images_tittle_producto[$key_id_enlazados_producto];
                                }
                                if (isset($images_producto[$key_id_enlazados_producto])) {
                                    $observaciones_producto_sys[$contador] = $observaciones_producto[$key_id_enlazados_producto];
                                }
                                $contador += 1;
                            }
                            unset($id_producto);
                            unset($descripcion_producto);
                            unset($tipo_producto);
                            unset($imagen_producto);
                            unset($updated_producto);
                            unset($alt_producto);
                            unset($tittle_producto);
                            unset($id_unidades);
                            unset($id_unidad_productos);
                            unset($unidad_producto);
                            unset($unidad_principal_producto);
                            unset($conversion_unidad_producto);
                            unset($iva_producto);
                            unset($recargo_producto);
                            unset($descripcion_atributos_unicos_producto);
                            unset($packs_disponibles);
                            unset($cantidad_packs_producto);
                            unset($descripcion_atributos_producto);
                            unset($id_enlazados_producto);
                            unset($id_multiples_producto);
                            unset($id_packs_producto);
                            unset($control_stock_producto);
                            unset($disponibilidad_producto);
                            unset($profesionales_producto);
                            unset($peso_producto);
                            unset($bultos_producto);
                            unset($gastos_producto);
                            unset($envio_gratis_producto);
                            unset($dias_entrega_producto);
                            unset($aplicar_descuento_producto);
                            unset($descuento_maximo_producto);
                            unset($id_productos_sku);
                            unset($codigo_barras_producto);
                            unset($referencia_producto);
                            unset($lote_producto);
                            unset($caducidad_producto);
                            unset($numero_serie_producto);
                            unset($stock_producto);
                            unset($pvp_producto);
                            unset($id_ofertas_producto);
                            unset($oferta_desde_producto);
                            unset($oferta_hasta_producto);
                            unset($pvp_oferta_producto);
                            unset($descripcion_ofertas_producto);
                            unset($images_producto);
                            unset($images_updated_producto);
                            unset($images_alt_producto);
                            unset($images_tittle_producto);
                            unset($observaciones_producto);
                            ?>
                        </div>
                    </div>
                    <div id="producto_opciones_<?php echo $contador_grupos_mostrados . '_' . $key_producto_grupos; ?>" class="hidden">
                        <?php
                        foreach ($id_enlazados_producto_sys as $key_id_enlazados_producto_sys => $valor_id_enlazados_producto_sys) {
                            //$id_grupo_relacionado_sys = $id_productos_relacionados_grupos[$contador_grupos_mostrados];
                            $id_grupo_relacionado_sys = 0;
                            //$id_producto_relacionado_sys = $id_relacionado_producto_grupos[$contador_grupos_mostrados][$key_producto_grupos];
                            $id_producto_relacionado_sys = $id_producto_sys;
                            $id_enlazados_producto_relacionado_sys = $id_enlazados_producto_sys[$key_id_enlazados_producto_sys];
                            $id_multiples_producto_relacionado_sys = $id_multiples_producto_sys[$key_id_enlazados_producto_sys];
                            $id_packs_producto_relacionado_sys = $id_packs_producto_sys[$key_id_enlazados_producto_sys];

                            $select_sys = "productos-relacionados";
                            $id_linea_sys = null;
                            require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-productos.php");
                            ?>
                            <div class="hidden" id="capa-contenido-grupos-opciones_<?php echo $contador_grupos_mostrados."_".$key_producto_grupos; ?><?php echo $anadidoModal; ?>">
                                <div class="flex flex-wrap text-xs">
                                    <?php
                                    $modelo_relacionado_anterior = (isset($modelo_producto_relacionado[0]))? $modelo_producto_relacionado[0] : 0;
                                    foreach ($id_relacionado_producto_relacionado as $key_producto_relacionado => $valor_producto_relacionado) {
                                        $id_producto_sys = $id_relacionado_producto_relacionado[$key_producto_relacionado];
                                        // ELIMINAR
                                        // echo"descripcion_producto_relacionado_".$key_producto_relacionado.$indice_adicional.": ".$descripcion_producto."<br />";
                                        // echo"id_producto_relacionado_".$key_producto_relacionado . $indice_adicional.": ".$id_producto_relacionado[$key_producto_relacionado]."<br />";
                                        // echo"id_relacionado_producto_relacionado-".$key_producto_relacionado . $indice_adicional.": ".$id_relacionado_producto_relacionado[$key_producto_relacionado]."<br />";
                                        // echo"id_grupo_producto_relacionado_".$key_producto_relacionado . $indice_adicional.": ".$id_grupo_producto_relacionado[$key_producto_relacionado]."<br />";
                                        // echo"fijo_producto_relacionado_".$key_producto_relacionado . $indice_adicional.": ".$fijo_producto_relacionado[$key_producto_relacionado]."<br />";
                                        // echo"modelo_producto_relacionado_".$key_producto_relacionado . $indice_adicional.": ".$modelo_producto_relacionado[$key_producto_relacionado]."<br />";
                                        // echo"mostrar_producto_relacionado_".$key_producto_relacionado . $indice_adicional.": ".$mostrar_producto_relacionado[$key_producto_relacionado]."<br />";
                                        // ELIMINAR FINAL
                                        ?>
                                        <input type="hidden" name="descripcion_producto_relacionado_<?php echo $key_producto_relacionado.$indice_adicional; ?>" id="descripcion_producto_grupos_<?php echo $key_producto_relacionado.$indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $descripcion_producto; ?>" />
                                        <input type="hidden" name="id_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="id_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_producto_relacionado[$key_producto_relacionado]; ?>" />
                                        <input type="hidden" name="id_relacionado_producto_relacionado-<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="id_relacionado_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_relacionado_producto_relacionado[$key_producto_relacionado]; ?>" />
                                        <input type="hidden" name="id_grupo_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="id_grupo_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_grupo_producto_relacionado[$key_producto_relacionado]; ?>" />
                                        <!--
                                        $cantidad_con_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['cantidad_con'];
                                        $cantidad_mitad_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['cantidad_mitad'];
                                        $cantidad_sin_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['cantidad_sin'];
                                        $cantidad_doble_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['cantidad_doble'];
                                        $sumar_con_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['sumar_con'];
                                        $sumar_mitad_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['sumar_mitad'];
                                        $sumar_sin_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['sumar_sin'];
                                        $sumar_doble_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['sumar_doble'];
                                        $por_defecto_producto_grupos[$contador_grupos_mostrados][] = $valor_productos_grupos['por_defecto'];
                                        -->
                                        <input type="hidden" name="fijo_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="fijo_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $fijo_producto_relacionado[$key_producto_relacionado]; ?>" />
                                        <input type="hidden" name="modelo_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="modelo_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>" />
                                        <input type="hidden" name="mostrar_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="mostrar_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $mostrar_producto_relacionado[$key_producto_relacionado]; ?>" />
                                        <?php

                                        unset($unidad_producto_sys);
                                        unset($unidad_principal_producto_sys);
                                        unset($conversion_unidad_producto_sys);
                                        unset($descripcion_atributos_unicos_producto_sys);
                                        unset($id_enlazados_producto_sys);
                                        unset($id_multiples_producto_sys);
                                        unset($id_packs_producto_sys);
                                        unset($descripcion_atributos_producto_sys);
                                        unset($cantidad_packs_producto_sys);
                                        unset($control_stock_producto_sys);
                                        unset($disponibilidad_producto_sys);
                                        unset($profesionales_producto_sys);
                                        unset($peso_producto_sys);
                                        unset($bultos_producto_sys);
                                        unset($gastos_producto_sys);
                                        unset($envio_gratis_producto_sys);
                                        unset($dias_entrega_producto_sys);
                                        unset($aplicar_descuento_producto_sys);
                                        unset($descuento_maximo_producto_sys);
                                        unset($id_productos_sku_sys);
                                        unset($codigo_barras_producto_sys);
                                        unset($referencia_producto_sys);
                                        unset($lote_producto_sys);
                                        unset($caducidad_producto_sys);
                                        unset($numero_serie_producto_sys);
                                        unset($stock_producto_sys);
                                        unset($pvp_producto_sys);
                                        unset($id_ofertas_producto_sys);
                                        unset($oferta_desde_producto_sys);
                                        unset($oferta_hasta_producto_sys);
                                        unset($pvp_oferta_producto_sys);
                                        unset($descripcion_ofertas_producto_sys);
                                        unset($images_producto_sys);
                                        unset($images_updated_producto_sys);
                                        unset($images_alt_producto_sys);
                                        unset($images_tittle_producto_sys);
                                        unset($observaciones_producto_sys);

                                        $select_sys = "producto";
                                        require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-productos.php");

                                        $packs_disponibles_sys = $packs_disponibles;

                                        $descripcion_producto_sys = $descripcion_producto;
                                        $tipo_producto_sys = $tipo_producto;
                                        $imagen_producto_sys = $imagen_producto;
                                        $updated_producto_sys = $updated_producto;
                                        $alt_producto_sys = $alt_producto;
                                        $tittle_producto_sys = $tittle_producto;
                                        $iva_producto_sys = $iva_producto;
                                        $recargo_producto_sys = $recargo_producto;
                                        foreach ($id_unidades as $key_id_unidades => $valor_id_unidades) {
                                            $unidad_producto_sys[] = $unidad_producto[$key_id_unidades];
                                            $unidad_principal_producto_sys[] = $unidad_principal_producto[$key_id_unidades];
                                            $conversion_unidad_producto_sys[] = $conversion_unidad_producto[$key_id_unidades];
                                        }
                                        foreach ($descripcion_atributos_unicos_producto as $key_descripcion_atributos_unicos_producto => $valor_descripcion_atributos_unicos_producto) {
                                            $descripcion_atributos_unicos_producto_sys[] = $valor;
                                        }
                                        $contador = 0;
                                        foreach ($id_enlazados_producto as $key_id_enlazados_producto => $valor_id_enlazados_producto) {
                                            $id_enlazados_producto_sys[$contador] = $id_enlazados_producto[$key_id_enlazados_producto];
                                            $id_multiples_producto_sys[$contador] = $id_multiples_producto[$key_id_enlazados_producto];
                                            $id_packs_producto_sys[$contador] = $id_packs_producto[$key_id_enlazados_producto];
                                            if (isset($descripcion_atributos_producto[$key_id_enlazados_producto])) {
                                                $descripcion_atributos_producto_sys[$contador] = $descripcion_atributos_producto[$key_id_enlazados_producto];
                                            }
                                            if (isset($cantidad_packs_producto[$key_id_enlazados_producto])) {
                                                $cantidad_packs_producto_sys[$contador] = $cantidad_packs_producto[$key_id_enlazados_producto];
                                            }
                                            $control_stock_producto_sys[$contador] = $control_stock_producto[$key_id_enlazados_producto];
                                            $disponibilidad_producto_sys[$contador] = $disponibilidad_producto[$key_id_enlazados_producto];
                                            $profesionales_producto_sys[$contador] = $profesionales_producto[$key_id_enlazados_producto];
                                            $peso_producto_sys[$contador] = $peso_producto[$key_id_enlazados_producto];
                                            $bultos_producto_sys[$contador] = $bultos_producto[$key_id_enlazados_producto];
                                            $gastos_producto_sys[$contador] = $gastos_producto[$key_id_enlazados_producto];
                                            $envio_gratis_producto_sys[$contador] = $envio_gratis_producto[$key_id_enlazados_producto];
                                            $dias_entrega_producto_sys[$contador] = $dias_entrega_producto[$key_id_enlazados_producto];
                                            $aplicar_descuento_producto_sys[$contador] = $aplicar_descuento_producto[$key_id_enlazados_producto];
                                            $descuento_maximo_producto_sys[$contador] = $descuento_maximo_producto[$key_id_enlazados_producto];
                                            foreach ($id_productos_sku_sys[$key_id_enlazados_producto] as $key_sku => $valor_sku) {
                                                $id_productos_sku_sys[$contador][] = $id_productos_sku[$key_id_enlazados_producto];
                                                $codigo_barras_producto_sys[$contador][] = $codigo_barras_producto[$key_id_enlazados_producto];
                                                $referencia_producto_sys[$contador][] = $referencia_producto[$key_id_enlazados_producto];
                                                $lote_producto_sys[$contador][] = $lote_producto[$key_id_enlazados_producto];
                                                $caducidad_producto_sys[$contador][] = $caducidad_producto[$key_id_enlazados_producto];
                                                $numero_serie_producto_sys[$contador][] = $numero_serie_producto[$key_id_enlazados_producto];
                                                $stock_producto_sys[$contador][] = $stock_producto[$key_id_enlazados_producto];
                                            }
                                            $pvp_producto_sys[$contador] = $pvp_producto[$key_id_enlazados_producto];
                                            if (isset($id_ofertas_producto[$key_id_enlazados_producto])) {
                                                $id_ofertas_producto_sys[$contador] = $id_ofertas_producto[$key_id_enlazados_producto];
                                                $oferta_desde_producto_sys[$contador] = $oferta_desde_producto[$key_id_enlazados_producto];
                                                $oferta_hasta_producto_sys[$contador] = $oferta_hasta_producto[$key_id_enlazados_producto];
                                                $pvp_oferta_producto_sys[$contador] = $pvp_oferta_producto[$key_id_enlazados_producto];
                                                $descripcion_ofertas_producto_sys[$contador] = $descripcion_ofertas_producto[$key_id_enlazados_producto];
                                            }
                                            if (isset($images_producto[$key_id_enlazados_producto])) {
                                                $images_producto_sys[$contador] = $images_producto[$key_id_enlazados_producto];
                                                $images_updated_producto_sys[$contador] = $images_updated_producto[$key_id_enlazados_producto];
                                                $images_alt_producto_sys[$contador] = $images_alt_producto[$key_id_enlazados_producto];
                                                $images_tittle_producto_sys[$contador] = $images_tittle_producto[$key_id_enlazados_producto];
                                            }
                                            if (isset($images_producto[$key_id_enlazados_producto])) {
                                                $observaciones_producto_sys[$contador] = $observaciones_producto[$key_id_enlazados_producto];
                                            }
                                            $contador += 1;
                                        }
                                        unset($id_producto);
                                        unset($descripcion_producto);
                                        unset($tipo_producto);
                                        unset($imagen_producto);
                                        unset($updated_producto);
                                        unset($alt_producto);
                                        unset($tittle_producto);
                                        unset($id_unidades);
                                        unset($id_unidad_productos);
                                        unset($unidad_producto);
                                        unset($unidad_principal_producto);
                                        unset($conversion_unidad_producto);
                                        unset($iva_producto);
                                        unset($recargo_producto);
                                        unset($descripcion_atributos_unicos_producto);
                                        unset($packs_disponibles);
                                        unset($cantidad_packs_producto);
                                        unset($descripcion_atributos_producto);
                                        unset($id_enlazados_producto);
                                        unset($id_multiples_producto);
                                        unset($id_packs_producto);
                                        unset($control_stock_producto);
                                        unset($disponibilidad_producto);
                                        unset($profesionales_producto);
                                        unset($peso_producto);
                                        unset($bultos_producto);
                                        unset($gastos_producto);
                                        unset($envio_gratis_producto);
                                        unset($dias_entrega_producto);
                                        unset($aplicar_descuento_producto);
                                        unset($descuento_maximo_producto);
                                        unset($id_productos_sku);
                                        unset($codigo_barras_producto);
                                        unset($referencia_producto);
                                        unset($lote_producto);
                                        unset($caducidad_producto);
                                        unset($numero_serie_producto);
                                        unset($stock_producto);
                                        unset($pvp_producto);
                                        unset($id_ofertas_producto);
                                        unset($oferta_desde_producto);
                                        unset($oferta_hasta_producto);
                                        unset($pvp_oferta_producto);
                                        unset($descripcion_ofertas_producto);
                                        unset($images_producto);
                                        unset($images_updated_producto);
                                        unset($images_alt_producto);
                                        unset($images_tittle_producto);
                                        unset($observaciones_producto);

                                        $origenCombo = true;
                                        require("productos-relacionados.php");
                                    }
                                    ?>
                                </div>

                                <hr class="my-5" />
                                <div class="w-2/3 mx-auto" id="capa-nota-linea-<?php echo $contador_grupos_mostrados . '_' . $key_producto_grupos; ?><?php echo $anadidoModal; ?>">
                                    <div class="text-left font-bold text-sm">
                                        Notas
                                    </div>
                                    <textarea class="w-full mt-2" name="nota-linea-<?php echo $contador_grupos_mostrados . '_' . $key_producto_grupos; ?>" id="nota-linea-<?php echo $contador_grupos_mostrados . '_' . $key_producto_grupos; ?><?php echo $anadidoModal; ?>" placeholder="Añadir anotación"></textarea>
                                </div>
                            </div>
                            <?php
                        }
                        unset($unidad_producto_sys);
                        unset($unidad_principal_producto_sys);
                        unset($conversion_unidad_producto_sys);
                        unset($descripcion_atributos_unicos_producto_sys);
                        unset($id_enlazados_producto_sys);
                        unset($id_multiples_producto_sys);
                        unset($id_packs_producto_sys);
                        unset($descripcion_atributos_producto_sys);
                        unset($cantidad_packs_producto_sys);
                        unset($control_stock_producto_sys);
                        unset($disponibilidad_producto_sys);
                        unset($profesionales_producto_sys);
                        unset($peso_producto_sys);
                        unset($bultos_producto_sys);
                        unset($gastos_producto_sys);
                        unset($envio_gratis_producto_sys);
                        unset($dias_entrega_producto_sys);
                        unset($aplicar_descuento_producto_sys);
                        unset($descuento_maximo_producto_sys);
                        unset($id_productos_sku_sys);
                        unset($codigo_barras_producto_sys);
                        unset($referencia_producto_sys);
                        unset($lote_producto_sys);
                        unset($caducidad_producto_sys);
                        unset($numero_serie_producto_sys);
                        unset($stock_producto_sys);
                        unset($pvp_producto_sys);
                        unset($id_ofertas_producto_sys);
                        unset($oferta_desde_producto_sys);
                        unset($oferta_hasta_producto_sys);
                        unset($pvp_oferta_producto_sys);
                        unset($descripcion_ofertas_producto_sys);
                        unset($images_producto_sys);
                        unset($images_updated_producto_sys);
                        unset($images_alt_producto_sys);
                        unset($images_tittle_producto_sys);
                        unset($observaciones_producto_sys);

                        unset($id_producto_relacionado);
                        unset($id_relacionado_producto_relacionado);
                        unset($descripcion_producto_relacionado);
                        unset($id_grupo_producto_relacionado);
                        unset($cantidad_con_producto_relacionado);
                        unset($cantidad_mitad_producto_relacionado);
                        unset($cantidad_sin_producto_relacionado);
                        unset($cantidad_doble_producto_relacionado);
                        unset($sumar_con_producto_relacionado);
                        unset($sumar_mitad_producto_relacionado);
                        unset($sumar_sin_producto_relacionado);
                        unset($sumar_doble_producto_relacionado);
                        unset($por_defecto_producto_relacionado);
                        unset($fijo_producto_relacionado);
                        unset($modelo_producto_relacionado);
                        unset($mostrar_producto_relacionado);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php

            unset($id_producto_grupos);
            unset($id_relacionado_producto_grupos);
            unset($id_grupo_producto_grupos);
            unset($cantidad_con_producto_grupos);
            unset($cantidad_mitad_producto_grupos);
            unset($cantidad_sin_producto_grupos);
            unset($cantidad_doble_producto_grupos);
            unset($sumar_con_producto_grupos);
            unset($sumar_mitad_producto_grupos);
            unset($sumar_sin_producto_grupos);
            unset($sumar_doble_producto_grupos);
            unset($por_defecto_producto_grupos);
            unset($fijo_producto_grupos);
            unset($modelo_producto_grupos);
            unset($mostrar_producto_grupos);

            $contador_grupos_mostrados += 1;
        }
        $contador_elementos += 1;
    }
    ?>
    <input type="hidden" name="grupos_input_grupo_combo" id="grupos_input_grupo_combo<?php echo $anadidoModal; ?>" value="<?php echo $totalGrupos; ?>" />
</div>
<div id="productos_anadidos<?php echo $anadidoModal; ?>" class="mt-3 <?php echo (!$hiddenPorModalEnProductoCombo)? 'hidden' : ''; ?>"></div>
<script type="text/javascript">
    setCapaProductoComboHeight('<?php echo $anadidoModal; ?>');
</script>
<script type="application/javascript">
reiniciarProductoComboContador();
<?php
if ($id_linea) {
    $select_sys = 'recuperar-productos-combo';
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
    $productoComboContador = 0;
    $productoComboContadorSiSeNecesitaBorrar = 0;
    $idGrupoSiSeNecesitaBorrar = 0;
    $idProductoPorGrupoSiSeNecesitaBorrar = 0;
    foreach ($id_recuperar_productos_combo as $key_id_recuperar_producto_combo => $id_recuperar_producto_combo) {
        $productoComboContador++;
        $id_documentos_combo = $id_recuperar_productos_combo[$key_id_recuperar_producto_combo];
        $select_sys = 'recuperar-productos-relacionados-combo';
        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");

        $select_sys = "productos-relacionados";
        $id_producto_relacionado_sys = $id_relacionado_recuperar_productos_combo[$key_id_recuperar_producto_combo];
        $id_linea_sys = null;
        require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-productos.php");

        if (isset($id_documento_producto_relacionado_combo_sys) && $id_documentos_combo == $id_documento_producto_relacionado_combo_sys) {
            $productoComboContadorSiSeNecesitaBorrar = $productoComboContador;
            $idGrupoSiSeNecesitaBorrar = $relacion_contador_grupos_mostrados_id_producto[$id_relacionado_recuperar_productos_combo[$key_id_recuperar_producto_combo]];
            $idProductoPorGrupoSiSeNecesitaBorrar = $relacion_contador_productos_por_grupo_id_producto[$id_relacionado_recuperar_productos_combo[$key_id_recuperar_producto_combo]];
        }

        $anidacion = $relacion_contador_grupos_mostrados_id_producto[$id_relacionado_recuperar_productos_combo[$key_id_recuperar_producto_combo]] . '_' .
            $relacion_contador_productos_por_grupo_id_producto[$id_relacionado_recuperar_productos_combo[$key_id_recuperar_producto_combo]] .
            $anadidoModal .'_' .
            ($key_id_recuperar_producto_combo + 1);

        if (isset($id_documento_producto_relacionado_combo_sys) && isset($modificar_linea) && $id_documento_producto_relacionado_combo_sys == $id_recuperar_productos_combo[$key_id_recuperar_producto_combo]) {
            if ($modificar_linea == 'sumar') {
                $cantidad_recuperar_productos_combo[$key_id_recuperar_producto_combo] += 1;
            }
            if ($modificar_linea == 'restar') {
                $cantidad_recuperar_productos_combo[$key_id_recuperar_producto_combo] -= 1;
            }
        }

        ?>
        anadirProductoCombo(
            '<?php echo $relacion_contador_grupos_mostrados_id_producto[$id_relacionado_recuperar_productos_combo[$key_id_recuperar_producto_combo]]; ?>',
            '<?php echo $relacion_contador_productos_por_grupo_id_producto[$id_relacionado_recuperar_productos_combo[$key_id_recuperar_producto_combo]]; ?>',
            '<?php echo $anadidoModal; ?>',
            false,
            <?php echo (isset($id_documento_producto_relacionado_combo_sys) && $id_documentos_combo == $id_documento_producto_relacionado_combo_sys)? 'true' : 'false'; ?>,
            <?php echo $cantidad_recuperar_productos_combo[$key_id_recuperar_producto_combo]; ?>,
            <?php echo $id_documentos_combo; ?>
        );
        modificarGrupoAnadido('<?php echo $anidacion; ?>', '<?php echo $id_grupo_recuperar_productos_combo[$key_id_recuperar_producto_combo]; ?>');
        modificarObservacionAnadido('<?php echo $anidacion; ?>',<?php echo (isset($observacion_recuperar_productos_combo[$key_id_recuperar_producto_combo]))? json_encode($observacion_recuperar_productos_combo[$key_id_recuperar_producto_combo]) : "''"; ?>);
        <?php
        foreach ($id_producto_relacionado as $key_id_producto_relacionado => $value_id_producto_relacionado) {
            $es_un_producto_sin = true;
            foreach ($id_productos_relacionados_combo as $key_id_productos_relacionados_combo => $value_id_productos_relacionados_combo) {
                if ((!empty($id_productos_relacionados_productos_relacionados_combo[$key_id_productos_relacionados_combo]) && $id_producto_relacionado[$key_id_producto_relacionado] == $id_productos_relacionados_productos_relacionados_combo[$key_id_productos_relacionados_combo] && $mostrar_productos_relacionados_combo[$key_id_productos_relacionados_combo]) ||
                    (!empty($id_titulo_relacionado_productos_relacionados_combo[$key_id_productos_relacionados_combo]) && $id_titulo_relacionado_productos_relacionados_combo[$key_id_productos_relacionados_combo] == $id_titulo_relacionado_producto_relacionado[$key_id_producto_relacionado])) {
                    $es_un_producto_sin = false;
                    if ($modelo_productos_relacionados_combo[$key_id_productos_relacionados_combo] == '3') {
                        ?>
                        modificarUnicoAnadido('<?php echo $anidacion; ?>', '<?php echo (!empty($id_productos_relacionados_productos_relacionados_combo[$key_id_productos_relacionados_combo]))? $id_productos_relacionados_productos_relacionados_combo[$key_id_productos_relacionados_combo] : $id_titulo_relacionado_producto_relacionado[$key_id_producto_relacionado]; ?>');
                        <?php
                    } else if ($modelo_productos_relacionados_combo[$key_id_productos_relacionados_combo] == '2') {
                        $seleccion = 2;
                        ?>
                        modificarCantidadAnadido('<?php echo $anidacion; ?>', '<?php echo $key_id_producto_relacionado; ?>', '<?php echo $modelo_productos_relacionados_combo[$key_id_productos_relacionados_combo]; ?>', '<?php echo $cantidad_con_productos_relacionados_combo[$key_id_productos_relacionados_combo]; ?>');
                        <?php
                    } else if ($modelo_productos_relacionados_combo[$key_id_productos_relacionados_combo] == '0') {
                        $seleccion = null;
                        switch ($por_defecto_productos_relacionados_combo[$key_id_productos_relacionados_combo]) {
                            case '0':
                                $seleccion = 'con';
                                break;
                            case '2':
                                $seleccion = 'sin';
                                break;
                            default:
                                break;
                        }
                        ?>
                        modificarAnadidoToogle('<?php echo $anidacion; ?>', '<?php echo $key_id_producto_relacionado; ?>', '<?php echo $modelo_productos_relacionados_combo[$key_id_productos_relacionados_combo]; ?>', '<?php echo $seleccion; ?>');
                        <?php
                    } else if ($modelo_productos_relacionados_combo[$key_id_productos_relacionados_combo] == '5') {
                        ?>
                        modificarAnadidoTexto('<?php echo $anidacion; ?>', '<?php echo $key_id_producto_relacionado; ?>', '<?php echo $modelo_productos_relacionados_combo[$key_id_productos_relacionados_combo]; ?>', '<?php echo $observaciones_productos_relacionados_combo[$key_id_productos_relacionados_combo]; ?>');
                        <?php
                    } else {
                        $seleccion = null;
                        switch ($por_defecto_productos_relacionados_combo[$key_id_productos_relacionados_combo]) {
                            case '0':
                                $seleccion = 'con';
                                break;
                            case '1':
                                $seleccion = 'mitad';
                                break;
                            case '2':
                                $seleccion = 'sin';
                                break;
                            case '3':
                                $seleccion = 'doble';
                                break;
                            default:
                                break;
                        }
                        ?>
                        modificarAnadido('<?php echo $anidacion; ?>', '<?php echo $key_id_producto_relacionado; ?>', '<?php echo $modelo_productos_relacionados_combo[$key_id_productos_relacionados_combo]; ?>', '<?php echo $seleccion; ?>');
                        <?php
                    }
                }
            }
            if ($es_un_producto_sin) {
                if ($modelo_producto_relacionado[$key_id_producto_relacionado] ==  '0') {
                    ?>
                    modificarAnadidoToogle('<?php echo $anidacion; ?>', '<?php echo $key_id_producto_relacionado; ?>', '<?php echo $modelo_producto_relacionado[$key_id_productos_relacionados_combo]; ?>', 'sin');
                    <?php
                } else {
                    ?>
                    modificarAnadido('<?php echo $anidacion; ?>', '<?php echo $key_id_producto_relacionado; ?>', '<?php echo $modelo_producto_relacionado[$key_id_producto_relacionado]; ?>', 'sin');
                    <?php
                }
            }
        }
        unset($id_productos_relacionados_combo);
        unset($id_productos_relacionados_productos_relacionados_combo);
        unset($id_productos_detalles_enlazado_productos_relacionados_combo);
        unset($id_productos_detalles_multiples_productos_relacionados_combo);
        unset($id_packs_productos_relacionados_combo);
        unset($id_relacionado_productos_relacionados_combo);
        unset($id_grupo_productos_relacionados_combo);
        unset($fijo_productos_relacionados_combo);
        unset($modelo_productos_relacionados_combo);
        unset($cantidad_con_productos_relacionados_combo);
        unset($cantidad_mitad_productos_relacionados_combo);
        unset($cantidad_sin_productos_relacionados_combo);
        unset($cantidad_doble_productos_relacionados_combo);
        unset($sumar_con_productos_relacionados_combo);
        unset($sumar_mitad_productos_relacionados_combo);
        unset($sumar_sin_productos_relacionados_combo);
        unset($sumar_doble_productos_relacionados_combo);
        unset($por_defecto_productos_relacionados_combo);
        unset($mostrar_productos_relacionados_combo);
        unset($orden_productos_relacionados_combo);

        unset($id_producto_relacionado);
        unset($id_relacionado_producto_relacionado);
        unset($id_titulo_relacionado_producto_relacionado);
        unset($descripcion_producto_relacionado);
        unset($titulo_descripcion_producto_relacionado);
        unset($id_grupo_producto_relacionado);
        unset($fijo_producto_relacionado);
        unset($modelo_producto_relacionado);
        unset($cantidad_con_producto_relacionado);
        unset($cantidad_mitad_producto_relacionado);
        unset($cantidad_sin_producto_relacionado);
        unset($cantidad_doble_producto_relacionado);
        unset($sumar_con_producto_relacionado);
        unset($sumar_mitad_producto_relacionado);
        unset($sumar_sin_producto_relacionado);
        unset($sumar_doble_producto_relacionado);
        unset($por_defecto_producto_relacionado);
        unset($mostrar_producto_relacionado);
        unset($checked_unico_producto_relacionado);
    }

    if (isset($borrar_linea) && $borrar_linea) {
        ?>
        eliminarProductoCombo(<?php echo $productoComboContadorSiSeNecesitaBorrar; ?>, <?php echo $idGrupoSiSeNecesitaBorrar; ?>, <?php echo $idProductoPorGrupoSiSeNecesitaBorrar; ?>, '<?php echo $anadidoModal; ?>');
        <?php
    }
    unset($id_recuperar_productos_combo);
    unset($id_productos_detalles_enlazado_recuperar_productos_combo);
    unset($id_productos_detalles_multiples_recuperar_productos_combo);
    unset($id_packs_recuperar_productos_combo);
    unset($id_relacionado_recuperar_productos_combo);
    unset($id_grupo_recuperar_productos_combo);
    unset($fijo_recuperar_productos_combo);
    unset($cantidad_recuperar_productos_combo);
    unset($sumar_recuperar_productos_combo);
    unset($mostrar_recuperar_productos_combo);
    unset($observacion_recuperar_productos_combo);

    if (isset($modificar_linea) && $modificar_linea != '') {
        ?>
        comprarProducto('0','insertar-producto','0','0','0', '<?php echo $anadidoModal; ?>');
        <?php
    }
}
?>
</script>
