<input type="hidden" name="tipo_producto_productos" id="tipo_producto_productos" value="<?php echo $tipo_producto_productos; ?>" />
<?php
unset($matriz_grupo);
unset($matriz_descripcion_productos_relacionados);
unset($matriz_id_productos_relacionados);
unset($matriz_id_enlazado_productos_relacionados);
unset($matriz_id_multiples_productos_relacionados);
unset($matriz_id_packs_productos_relacionados);
unset($matriz_id_categoria_estadisticas_productos_relacionados);
unset($matriz_id_producto_relacionado_productos_relacionados);
unset($matriz_fijo_importe_productos_relacionados);
unset($matriz_cantidad_productos_relacionados);
unset($matriz_id_unidad_productos_relacionados);
unset($matriz_sumar_productos_relacionados);
unset($matriz_mostrar_productos_relacionados);

$select_sys = "detalles-ficha-elaborados";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/relacionados/gestion/datos-select-php.php");
if(isset($matriz_id_productos_relacionados)) {
    $contador_productos_relacionados = 0;
    foreach ($matriz_id_productos_relacionados as $key_id_productos_relacionados => $valor_id_productos_relacionados) {
        $contador_productos_relacionados += 1;

        unset($id_unidades);
        unset($unidad_unidades);
        unset($abreviatura_unidades);
        unset($id_productos_unidades);
        unset($id_unidad_productos_unidades);
        unset($id_producto_productos_unidades);
        unset($principal_productos_unidades);
        unset($conversion_principal_productos_unidades);
        unset($activo_productos_unidades);
        unset($fecha_alta_productos_unidades);
        unset($fecha_modificacion_productos_unidades);
        $id_url_memo = $id_url;
        $id_url = $matriz_id_producto_relacionado_productos_relacionados[$key_id_productos_relacionados];
        $select_sys = "unidades";
        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
        $id_url = $id_url_memo;

        $checked_fijo_si = "";
        $checked_fijo_no = " checked";
        $checked_mostrar_si = "";
        $checked_mostrar_no = " checked";
        if($matriz_fijo_importe_productos_relacionados[$key_id_productos_relacionados] == 1) {
            $checked_fijo_si = " checked";
            $checked_fijo_no = "";
        }
        if($matriz_mostrar_productos_relacionados[$key_id_productos_relacionados] == 1) {
            $checked_mostrar_si = " checked";
            $checked_mostrar_no = "";
        }
        ?>
        <input type="hidden" name="relacionados_modelo_productos_<?php echo $contador_productos_relacionados; ?>" id="relacionados_modelo_productos_<?php echo $contador_productos_relacionados; ?>" value="4" />
        <input type="hidden" name="id_producto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_producto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_producto_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_enlazado_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_enlazado_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_enlazado_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_multiple_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_multiple_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_packs_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_pack_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_pack_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $id_pack_productos_encontrados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_tabla_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_tabla_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $valor_id_productos_relacionados; ?>" />
        <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
            <div class="px-3 col-span-1 items-center">
                <a href="#" onclick="abrirFichaEnNuevaPestana(<?php echo $matriz_id_producto_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </a>
            </div>
            <div class="px-3 col-span-5 flex flex-wrap items-center">
                <?php
                $id_producto = $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados];
                $id_enlazado = $matriz_id_enlazado_productos_relacionados[$key_id_productos_relacionados];
                $id_multiple = $matriz_id_multiples_productos_relacionados[$key_id_productos_relacionados];
                $id_pack = $matriz_id_packs_productos_relacionados[$key_id_productos_relacionados];
                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/imagenes/componentes/mostrar-imagenes.php");

                $descripciones_productos_relacionados = $matriz_descripcion_productos_relacionados[$key_id_productos_relacionados];
                if(!empty($matriz_id_packs_productos_relacionados[$key_id_productos_relacionados])) {
                    $id_packs = $matriz_id_packs_productos_relacionados[$key_id_productos_relacionados];
                    $select_sys = "descripcion-pack";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/packs/gestion/datos-select-php.php");
                    $descripciones_productos_relacionados .= " ".$descripcion_pack;
                }
                if(!empty($matriz_id_enlazado_productos_relacionados[$key_id_productos_relacionados])) {
                    $id_productos_detalles_enlazado = $matriz_id_enlazado_productos_relacionados[$key_id_productos_relacionados];
                    $select_sys = "descripcion_enlazado";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                    $descripciones_productos_relacionados .= " (".$descripcion_productos_detalles_enlazado.")";
                }
                if(!empty($matriz_id_multiples_productos_relacionados[$key_id_productos_relacionados])) {
                    $id_productos_detalles_multiples = $matriz_id_multiples_productos_relacionados[$key_id_productos_relacionados];
                    $select_sys = "descripcion_multiple";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
                    $descripciones_productos_relacionados .= " (".$descripcion_productos_detalles_multiples.")";
                }
                echo "<strong>".$descripciones_productos_relacionados."</strong>";
                if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 0) {
                    echo " - Producto: normal (no mostrar)";
                }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 1) {
                    echo " - Producto: elaborado (no mostrar)";
                }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 2) {
                    echo " - Producto: compuesto (no mostrar)";
                }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 3 || $matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 4) {
                    echo " - Producto: combo (no mostrar)";
                }
                ?>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 col-span-4 items-center h-10 bg-white">
                <div>
                    <input type="number" class="cantidad_productos_relacionados w-full h-9" name="cantidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="cantidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" placeholder="Cantidad" value="<?php echo $matriz_cantidad_productos_relacionados[$key_id_productos_relacionados]; ?>" step="0.01" required />
                </div>
                <div class="ml-2">
                    <select id="id_unidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" class="w-full h-9">
                        <?php
                        foreach ($id_productos_unidades as $key_id_productos_unidad => $valor_id_productos_unidades) {
                            foreach ($id_unidades as $key_id_unidades => $valor_id_unidades) {
                                if ($id_unidad_productos_unidades[$key_id_productos_unidad] == $valor_id_unidades) {
                                    $selected = "";
                                    if($matriz_id_unidad_productos_relacionados[$key_id_productos_relacionados] == $valor_id_unidades) {
                                        $selected = " selected";
                                    }
                                    ?>
                                    <option value="<?php echo $valor_id_unidades; ?>"<?php echo $selected; ?>><?php echo $unidad_unidades[$key_id_unidades]." (".$abreviatura_unidades[$key_id_unidades].")"; ?></option>
                                    <?php
                                    $selected = "";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="fijo_productos_relacionados[<?php echo $contador_productos_relacionados; ?>]" id="fijo_no_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="0" />
            <input type="hidden" name="mostrar_productos_relacionados[<?php echo $contador_productos_relacionados; ?>]" id="mostrar_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_mostrar_productos_relacionados[$key_id_productos_relacionados]; ?>" />
            <div class="col-span-2 flex flex-wrap items-center justify-end" id="capa_guardar_relacionados_<?php echo $contador_productos_relacionados; ?>">
                <div>
                    <a href="#" onclick="guardarComposicion('relacionados','<?php echo $id_url; ?>','<?php echo $tipo_producto_productos; ?>','<?php echo $contador_productos_relacionados; ?>');" id="guardar_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </a>
                </div>
                <div class="ml-4 mr-3">
                    <a href="#" onclick="eliminarRelacionadoElaborados('<?php echo $matriz_id_productos_relacionados[$key_id_productos_relacionados]; ?>','<?php echo $id_url; ?>','<?php echo $contador_productos_relacionados; ?>');" id="eliminar_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <?php
        unset($id_unidades);
        unset($unidad_unidades);
        unset($abreviatura_unidades);

        unset($id_productos_unidades);
        unset($id_unidad_productos_unidades);
        unset($id_producto_productos_unidades);
        unset($principal_productos_unidades);
        unset($conversion_principal_productos_unidades);
        unset($activo_productos_unidades);
        unset($fecha_alta_productos_unidades);
        unset($fecha_modificacion_productos_unidades);
    }
    unset($matriz_grupo);
    unset($matriz_descripcion_productos_relacionados);
    unset($matriz_id_enlazado_productos_relacionados);
    unset($matriz_id_multiples_productos_relacionados);
    unset($matriz_id_packs_productos_relacionados);
    unset($matriz_id_productos_relacionados);
    unset($matriz_id_relacionado_productos_relacionados);
    unset($matriz_fijo_importe_productos_relacionados);
    unset($matriz_cantidad_productos_relacionados);
    unset($matriz_sumar_productos_relacionados);
    unset($matriz_mostrar_productos_relacionados);
}