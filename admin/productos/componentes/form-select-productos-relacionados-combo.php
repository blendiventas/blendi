<input type="hidden" name="tipo_producto_productos" id="tipo_producto_productos" value="<?php echo $tipo_producto_productos; ?>" />
<?php
unset($result_grupo);
unset($matriz_descripcion_productos_relacionados);
unset($matriz_id_productos_relacionados);
unset($matriz_id_enlazado_productos_relacionados);
unset($matriz_id_multiples_productos_relacionados);
unset($matriz_id_packs_productos_relacionados);
unset($matriz_id_relacionado_productos_relacionados);
unset($matriz_id_grupo_productos_relacionados);
unset($matriz_fijo_importe_productos_relacionados);
unset($matriz_cantidad_productos_relacionados);
unset($matriz_sumar_productos_relacionados);
unset($matriz_mostrar_productos_relacionados);
unset($matriz_activo_productos_relacionados);

$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-select-php.php");
?>
<input type="hidden" name="incrementos_tarifas" id="incrementos_tarifas" value="<?php echo count($matriz_id_tarifas); ?>" />
<?php

$select_sys = "detalles-ficha-combo";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/relacionados/gestion/datos-select-php.php");
if(isset($matriz_id_productos_relacionados)) {
    $contador_productos_relacionados = 0;
    foreach ($matriz_id_productos_relacionados as $key_id_productos_relacionados => $valor_id_productos_relacionados) {
        $contador_productos_relacionados += 1;

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
        <input type="hidden" name="relacionados_modelo_productos_<?php echo $contador_productos_relacionados; ?>" id="relacionados_modelo_productos_<?php echo $contador_productos_relacionados; ?>" value="5" />
        <input type="hidden" name="id_producto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_producto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_enlazado_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_enlazado_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_enlazado_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_multiple_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_multiple_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_packs_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_pack_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_pack_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $id_pack_productos_encontrados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_tabla_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_tabla_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $valor_id_productos_relacionados; ?>" />
        <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
            <div class="flex space-x-2 px-3 col-span-1 items-center">
                <?php
                $checked_activo = "";
                if($matriz_activo_productos_relacionados[$key_id_productos_relacionados] == 1) {
                    $checked_activo = " checked";
                }
                ?>
                <input type="checkbox" class="block w-7 h-7 mx-auto text-blendi-600" name="producto_activo_<?php echo $contador_productos_relacionados; ?>" id="producto_activo_<?php echo $contador_productos_relacionados; ?>" <?php echo $checked_activo; ?> onmouseover="this.style.cursor='pointer'" onclick="guardarComposicion('relacionados','<?php echo $id_url; ?>','<?php echo $tipo_producto_productos; ?>','<?php echo $contador_productos_relacionados; ?>',['<?php echo $matriz_id_tarifas; ?>']);" style="cursor: pointer;">
                <a href="#" onclick="abrirFichaEnNuevaPestana(<?php echo $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </a>
            </div>
            <?php
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
            ?>
            <div class="flex space-x-2 px-3 col-span-5 flex flex-wrap items-center">
                <?php
                $id_producto = $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados];
                $id_enlazado = $matriz_id_enlazado_productos_relacionados[$key_id_productos_relacionados];
                $id_multiple = $matriz_id_multiples_productos_relacionados[$key_id_productos_relacionados];
                $id_pack = $matriz_id_packs_productos_relacionados[$key_id_productos_relacionados];
                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/imagenes/componentes/mostrar-imagenes.php");
                ?>
                <div>
                    <?php
                    echo "<strong>" . $descripciones_productos_relacionados . "</strong>";
                    if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 0) {
                        echo "<br />Producto: normal";
                    }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 1) {
                        echo "<br />Producto: elaborado";
                    }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 2) {
                        echo "<br />Producto: compuesto";
                    }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 3 || $matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 4) {
                        echo "<br />Producto: combo";
                    }
                    ?>
                </div>
            </div>
            <?php
            $select_sys = "listado-grupos";
            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/grupos/gestion/datos-select-php.php");
            /*
            $matriz_id_productos_grupos
            $matriz_descripcion_productos_grupos
            */
            ?>
            <div class="grid grid-cols-1 col-span-4 items-center h-10 bg-white">
                <select id="id_grupo_productos_<?php echo $contador_productos_relacionados; ?>" name="id_grupo_productos" required>
                    <option value="0" selected>Sin grupo</option>
                    <?php
                    if(isset($matriz_id_productos_grupos)) {
                        foreach ($matriz_id_productos_grupos as $key_id_productos_grupos => $valor_id_productos_grupos) {
                            $selected = '';
                            if ($matriz_id_grupo_productos_relacionados[$key_id_productos_relacionados] == $valor_id_productos_grupos) {
                                $selected = ' selected';
                            }
                            ?>
                            <option value="<?php echo $valor_id_productos_grupos; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_productos_grupos[$key_id_productos_grupos]; ?></option>
                            <?php
                        }
                        unset($matriz_id_productos_grupos);
                        unset($matriz_descripcion_productos_grupos);
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="cantidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="cantidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" placeholder="Cantidad" value="<?php echo $matriz_cantidad_productos_relacionados[$key_id_productos_relacionados]; ?>" step="0.01" required />
            <div class="flex space-x-2 col-span-2 justify-end px-3" id="guardar_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>">
                <a href="#" id="producto_relacionado_incrementos_<?php echo $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>_trigger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                    </svg>
                </a>
                <a href="#" onclick="guardarComposicion('relacionados','<?php echo $id_url; ?>','<?php echo $tipo_producto_productos; ?>','<?php echo $contador_productos_relacionados; ?>',['<?php echo $matriz_id_tarifas; ?>']);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </a>
                <a href="#" onclick="eliminarRelacionadoCombo('<?php echo $id_url; ?>','<?php echo $matriz_id_productos_relacionados[$key_id_productos_relacionados]; ?>','<?php echo $contador_productos_relacionados; ?>','<?php echo $texto_buscar; ?>','<?php echo $buscar_por; ?>');">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </a>
            </div>
        </div>
        <div id="producto_relacionado_incrementos_<?php echo $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>_target" class="hidden bg-white border-2 rounded bg-white cursor-pointer">
            <?php
            $contador_incrementos_tarifas = 0;
            foreach ($matriz_id_tarifas as $key_tarifas => $valor_tarifas) {
                if(!isset($matriz_sumar_con_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados])) {
                    $matriz_sumar_con_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados] = 0;
                }
                ?>
                <div class="grid grid-cols-7 items-center space-x-2 h-12 px-3">
                    <div class="col-span-3"><?php echo $matriz_descripcion_tarifas[$key_tarifas]; ?></div>
                    <div class="col-span-4">
                        <input type="hidden" name="id_incrementos_tarifas_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="id_incrementos_tarifas_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" value="<?php echo $valor_tarifas; ?>" />
                        <input type="number" name="sumar_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="sumar_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" placeholder="Sumar" value="<?php echo $matriz_sumar_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados]; ?>" step="0.01" required />&nbsp;&euro;
                    </div>
                </div>
                <?php
                $contador_incrementos_tarifas += 1;
            }
            ?>
        </div>
        <script type="text/javascript">
            loadDropdownIncrementosMenu(<?php echo $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>);
        </script>
        <input type="hidden" name="fijo_productos_relacionados[<?php echo $contador_productos_relacionados; ?>]" id="fijo_no_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="0" />
        <input type="hidden" name="mostrar_productos_relacionados[<?php echo $contador_productos_relacionados; ?>]" id="mostrar_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_mostrar_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <?php
    }
    unset($matriz_grupo);
    unset($matriz_descripcion_productos_relacionados);
    unset($matriz_id_enlazado_productos_relacionados);
    unset($matriz_id_multiples_productos_relacionados);
    unset($matriz_id_packs_productos_relacionados);
    unset($matriz_id_productos_relacionados);
    unset($matriz_id_relacionado_productos_relacionados);
    unset($matriz_fijo_importe_productos_relacionados);
    unset($matriz_modelo_productos_relacionados);
    unset($matriz_cantidad_con_productos_relacionados);
    unset($matriz_cantidad_mitad_productos_relacionados);
    unset($matriz_cantidad_sin_productos_relacionados);
    unset($matriz_cantidad_doble_productos_relacionados);
    unset($matriz_sumar_con_productos_relacionados);
    unset($matriz_sumar_mitad_productos_relacionados);
    unset($matriz_sumar_sin_productos_relacionados);
    unset($matriz_sumar_doble_productos_relacionados);
    unset($matriz_por_defecto_productos_relacionados);
    unset($matriz_mostrar_productos_relacionados);
    unset($matriz_activo_productos_relacionados);
}
unset($matriz_id_tarifas);
unset($matriz_id_idioma_tarifas);
unset($matriz_descripcion_tarifas);
unset($matriz_prioritaria_tarifas);
unset($matriz_activa_tarifas);
unset($matriz_orden_tarifas);