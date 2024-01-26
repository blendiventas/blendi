<input type="hidden" name="tipo_producto_productos" id="tipo_producto_productos" value="<?php echo $tipo_producto_productos; ?>" />
<?php
unset($matriz_grupo);
unset($matriz_descripcion_productos_relacionados);
unset($matriz_id_productos_relacionados);
unset($matriz_id_enlazado_productos_relacionados);
unset($matriz_id_multiples_productos_relacionados);
unset($matriz_id_packs_productos_relacionados);
unset($matriz_id_relacionado_productos_relacionados);
unset($matriz_id_grupo_productos_relacionados);
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

$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-select-php.php");
?>
<input type="hidden" name="incrementos_tarifas" id="incrementos_tarifas" value="<?php echo count($matriz_id_tarifas); ?>" />
<?php

$select_sys = "detalles-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/relacionados/gestion/datos-select-php.php");
if(isset($matriz_id_productos_relacionados)) {
    $contador_productos_relacionados = 0;
    /*
        $tipo_producto = 0 // normal
        $tipo_producto = 1 // elaborado
        $tipo_producto = 2 // compuesto
        $tipo_producto = 3 // combo manual
        $tipo_producto = 4 // combo automático

    CREATE TABLE `productos_relacionados` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `id_producto` INT(11) UNSIGNED NOT NULL DEFAULT '0',
        `id_productos_detalles_enlazado` INT(11) UNSIGNED NOT NULL DEFAULT '0',
        `id_productos_detalles_multiples` INT(11) UNSIGNED NOT NULL DEFAULT '0',
        `id_packs` INT(11) UNSIGNED NOT NULL DEFAULT '0',
        `id_relacionado` INT(11) UNSIGNED NOT NULL DEFAULT '0',
        `id_grupo` INT(11) UNSIGNED NOT NULL DEFAULT '0',
        `fijo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
        `modelo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 - Con / Sin\r\n1 - Normal / Mitad / Sin / Doble\r\n2 - Input cantidad\r\n3 - Unico',
        `cantidad_con` DOUBLE(15,5) UNSIGNED NOT NULL DEFAULT '0.00000',
        `cantidad_mitad` DOUBLE(15,5) UNSIGNED NOT NULL DEFAULT '0.00000',
        `cantidad_sin` DOUBLE(15,5) UNSIGNED NOT NULL DEFAULT '0.00000',
        `cantidad_doble` DOUBLE(15,5) UNSIGNED NOT NULL DEFAULT '0.00000',
        `sumar_con` DOUBLE(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
        `sumar_mitad` DOUBLE(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
        `sumar_sin` DOUBLE(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
        `sumar_doble` DOUBLE(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
        `por_defecto` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0-con\r\n1-mitad\r\n2-sin\r\n3-doble',
        `mostrar` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
        `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
    */
    foreach ($matriz_id_productos_relacionados as $key_id_productos_relacionados => $valor_id_productos_relacionados) {
        $contador_productos_relacionados += 1;
        if ($matriz_modelo_productos_relacionados[$key_id_productos_relacionados] != 4) {
            continue;
        }

        $selected_0 = " selected";
        $selected_1 = "";
        $selected_2 = "";
        $selected_3 = "";
        $selected_4 = "";
        $class_modelo_base = " class='row text-left hide'";
        $class_modelo_opciones = " class='row text-center'";
        $class_row_con = "";
        $class_row_mitad = " hide";
        $class_row_sin = "";
        $class_row_doble = " hide";
        $checked_fijo_si = "";
        $checked_fijo_no = " checked";
        $checked_mostrar_si = "";
        $checked_mostrar_no = " checked";
        if($matriz_fijo_importe_productos_relacionados[$key_id_productos_relacionados] == 1) {
            $checked_fijo_si = " checked";
            $checked_fijo_no = "";
        }
        if($matriz_modelo_productos_relacionados[$key_id_productos_relacionados] == 1) {
            $selected_1 = " selected";
            $class_modelo_base = " class='row text-left hide'";
            $class_modelo_opciones = " class='row text-center'";
            $class_row_con = "";
            $class_row_mitad = "";
            $class_row_sin = "";
            $class_row_doble = "";
        }else if($matriz_modelo_productos_relacionados[$key_id_productos_relacionados] == 2) {
            $selected_2 = " selected";
            $class_modelo_base = " class='row text-left'";
            $class_modelo_opciones = " class='row text-center hide'";
            $class_row_con = "hide";
            $class_row_mitad = "hide";
            $class_row_sin = "hide";
            $class_row_doble = "hide";
        }else if($matriz_modelo_productos_relacionados[$key_id_productos_relacionados] == 3) {
            $selected_3 = " selected";
            $class_modelo_base = " class='row text-left'";
            $class_modelo_opciones = " class='row text-center hide'";
            $class_row_con = "hide";
            $class_row_mitad = "hide";
            $class_row_sin = "hide";
            $class_row_doble = "hide";
        }else if($matriz_modelo_productos_relacionados[$key_id_productos_relacionados] == 4) {
            $selected_4 = " selected";
            $class_modelo_base = " class='row text-left'";
            $class_modelo_opciones = " class='row text-center hide'";
            $class_row_con = "hide";
            $class_row_mitad = "hide";
            $class_row_sin = "hide";
            $class_row_doble = "hide";
        }
        if($matriz_mostrar_productos_relacionados[$key_id_productos_relacionados] == 1) {
            $checked_mostrar_si = " checked";
            $checked_mostrar_no = "";
        }

        /* $matriz_por_defecto_productos_relacionados // 0-con, 1-mitad, 2-sin, 3-doble */
        if($matriz_por_defecto_productos_relacionados[$key_id_productos_relacionados] == 0) {
            // <option value="0">Con / Sin</option>
            $checked_por_defecto_con = " checked";
            $checked_por_defecto_mitad = "";
            $checked_por_defecto_sin = "";
            $checked_por_defecto_doble = "";
        }else if($matriz_por_defecto_productos_relacionados[$key_id_productos_relacionados] == 1) {
            // <option value="1" selected>Con / Mitad / Sin / Doble</option>
            $checked_por_defecto_con = "";
            $checked_por_defecto_mitad = " checked";
            $checked_por_defecto_sin = "";
            $checked_por_defecto_doble = "";
        }else if($matriz_por_defecto_productos_relacionados[$key_id_productos_relacionados] == 2) {
            // <option value="2">Por cantidad</option>
            $checked_por_defecto_con = "";
            $checked_por_defecto_mitad = "";
            $checked_por_defecto_sin = " checked";
            $checked_por_defecto_doble = "";
        }else if($matriz_por_defecto_productos_relacionados[$key_id_productos_relacionados] == 3) {
            // <option value="3">Único</option>
            $checked_por_defecto_con = "";
            $checked_por_defecto_mitad = "";
            $checked_por_defecto_sin = "";
            $checked_por_defecto_doble = " checked";
        }

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
        $id_url = $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados];
        $select_sys = "unidades";
        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
        $id_url = $id_url_memo;
        $descripcion_unidad_principal = '';
        foreach ($id_productos_unidades as $key_id_productos_unidad => $valor_id_productos_unidades) {
            foreach ($id_unidades as $key_id_unidades => $valor_id_unidades) {
                if ($id_unidad_productos_unidades[$key_id_productos_unidad] == $valor_id_unidades) {
                    if($principal_productos_unidades[$key_id_productos_unidad]) {
                        $descripcion_unidad_principal = $unidad_unidades[$key_id_unidades];
                    }
                }
            }
        }
        ?>
        <input type="hidden" name="id_producto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_producto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_enlazado_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_enlazado_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_enlazado_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_multiple_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_multiple_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_packs_productos_relacionados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_pack_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_pack_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $id_pack_productos_encontrados[$key_id_productos_relacionados]; ?>" />
        <input type="hidden" name="id_tabla_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_tabla_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $valor_id_productos_relacionados; ?>" />
        <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
            <div class="px-3 col-span-1 items-center">
                <a href="#" onclick="abrirFichaEnNuevaPestana(<?php echo $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados]; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </a>
            </div>
            <div class="px-3 col-span-5 flex flex-wrap items-center">
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

                $id_producto = $matriz_id_relacionado_productos_relacionados[$key_id_productos_relacionados];
                $id_enlazado = $matriz_id_enlazado_productos_relacionados[$key_id_productos_relacionados];
                $id_multiple = $matriz_id_multiples_productos_relacionados[$key_id_productos_relacionados];
                $id_pack = $matriz_id_packs_productos_relacionados[$key_id_productos_relacionados];
                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/imagenes/componentes/mostrar-imagenes.php");

                echo "<strong>".$descripciones_productos_relacionados."</strong>";
                /*
                modelo = 0 : Con / Sin
                modelo = 1 : Con / Mitad / Sin / Doble
                modelo = 2 : Por cantidad
                modelo = 3 : Único
                modelo = 4 : No mostrar
                modelo = 5 : Menú
                */
                if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 0) {
                    echo "Producto: normal";
                }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 1) {
                    echo "Producto: elaborado";
                }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 2) {
                    echo "Producto: compuesto";
                }else if($matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 3 || $matriz_tipo_producto_productos_relacionados[$key_id_productos_relacionados] == 4) {
                    echo "Producto: combo";
                }
                if(!empty($matriz_grupo[$key_id_productos_relacionados])) {
                    echo " (".$matriz_grupo[$key_id_productos_relacionados].")";
                }
                ?>
            </div>
            <input type="hidden" class="mw-95" id="relacionados_modelo_productos_<?php echo $contador_productos_relacionados; ?>" name="relacionados_modelo_productos_<?php echo $contador_productos_relacionados; ?>" value="4" />

            <div class="grid grid-cols-1 sm:grid-cols-2 col-span-4 items-center h-10 bg-white">
                <div id="relacionados_modelo_base_<?php echo $contador_productos_relacionados; ?>">
                    <input type="number" class="cantidad_productos_relacionados w-full h-9" name="cantidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="cantidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" placeholder="Cantidad" value="<?php echo $matriz_cantidad_con_productos_relacionados[$key_id_productos_relacionados]; ?>" step="0.01" required />
                </div>
            </div>

            <div class="hidden">
                <div id="row_sumar_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">
                    <?php
                    $contador_incrementos_tarifas = 0;
                    foreach ($matriz_id_tarifas as $key_tarifas => $valor_tarifas) {
                        if(!isset($matriz_sumar_con_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados])) {
                            $matriz_sumar_con_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados] = 0;
                        }
                        ?>
                        Incremento PVP <?php echo $matriz_descripcion_tarifas[$key_tarifas]; ?>
                        <input type="hidden" name="id_incrementos_tarifas_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="id_incrementos_tarifas_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" value="<?php echo $valor_tarifas; ?>" />
                        <input type="number" name="sumar_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="sumar_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" placeholder="Sumar" value="<?php echo $matriz_sumar_con_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados]; ?>" step="0.01" required />&nbsp;&euro;
                        <?php
                        $contador_incrementos_tarifas += 1;
                    }
                    ?>
                </div>
            </div>

            <div class="hidden">
                <div id="relacionados_modelo_opciones_cantidad_<?php echo $contador_productos_relacionados; ?>">
                    Cantidades (<?php echo $descripcion_unidad_principal; ?>)
                    <div class="<?php echo $class_row_con; ?>" id="relacionados_row-con_cantidad_<?php echo $contador_productos_relacionados; ?>">
                        <div id="label_cantidad_con_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">Con:</div>
                        <input type="number" name="cantidad_con_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="cantidad_con_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" placeholder="Cantidad" value="<?php echo $matriz_cantidad_con_productos_relacionados[$key_id_productos_relacionados]; ?>" step="0.01" required />
                    </div>
                    <div class="<?php echo $class_row_mitad; ?>" id="relacionados_row-mitad_cantidad_<?php echo $contador_productos_relacionados; ?>">
                        <div id="label_cantidad_mitad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">Mitad:</div>
                        <input type="number" name="cantidad_mitad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="cantidad_mitad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" placeholder="Cantidad" value="<?php echo $matriz_cantidad_mitad_productos_relacionados[$key_id_productos_relacionados]; ?>" step="0.01" required />
                    </div>
                    <div class="<?php echo $class_row_sin; ?>" id="relacionados_row-sin_cantidad_<?php echo $contador_productos_relacionados; ?>">
                        <div id="label_cantidad_sin_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">Sin:</div>
                        <input type="number" disabled name="cantidad_sin_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="cantidad_sin_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" placeholder="Cantidad" value="<?php echo $matriz_cantidad_sin_productos_relacionados[$key_id_productos_relacionados]; ?>" step="0.01" required />
                    </div>
                    <div class="<?php echo $class_row_doble; ?>" id="relacionados_row-doble_cantidad_<?php echo $contador_productos_relacionados; ?>">
                        <div id="label_cantidad_doble_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">Doble:</div>
                        <input type="number" name="cantidad_doble_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="cantidad_doble_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" placeholder="Cantidad" value="<?php echo $matriz_cantidad_doble_productos_relacionados[$key_id_productos_relacionados]; ?>" step="0.01" required />
                    </div>
                </div>
            </div>
            <div class="hidden">
                <div id="relacionados_modelo_opciones_incremento_<?php echo $contador_productos_relacionados; ?>">
                    <?php
                    $contador_incrementos_tarifas = 0;
                    foreach ($matriz_id_tarifas as $key_tarifas => $valor_tarifas) {
                        if(!isset($matriz_sumar_con_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados])) {
                            $matriz_sumar_con_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados] = 0;
                        }
                        ?>
                        <div<?php echo $class_modelo_opciones; ?>>
                            Incremento PVP <?php echo $matriz_descripcion_tarifas[$key_tarifas]; ?>
                        </div>
                        <input type="hidden" name="id_incrementos_tarifas_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="id_incrementos_tarifas_relacionados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" value="<?php echo $valor_tarifas; ?>" />
                        <div class="<?php echo $class_row_con; ?>" id="relacionados_row-con_sumar_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>">
                            <div id="label_sumar_con_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>">Con:</div>
                            <input type="number" name="sumar_con_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="sumar_con_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" placeholder="Sumar" value="<?php echo $matriz_sumar_con_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados]; ?>" step="0.01" required />&nbsp;&euro;
                        </div>
                        <div class="<?php echo $class_row_mitad; ?>" id="relacionados_row-mitad_sumar_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>">
                            <div id="label_sumar_mitad_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>">Mitad:</div>
                            <input type="number" name="sumar_mitad_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="sumar_mitad_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" placeholder="Sumar" value="<?php echo $matriz_sumar_mitad_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados]; ?>" step="0.01" required />&nbsp;&euro;
                        </div>
                        <div class="<?php echo $class_row_sin; ?>" id="relacionados_row-sin_sumar_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>">
                            <div id="label_sumar_sin_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>">Sin:</div>
                            <input type="number" disabled name="sumar_sin_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="sumar_sin_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" placeholder="Sumar" value="<?php echo $matriz_sumar_sin_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados]; ?>" step="0.01" required />&nbsp;&euro;
                        </div>
                        <div class="<?php echo $class_row_doble; ?>" id="relacionados_row-doble_sumar_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>">
                            <div id="label_sumar_doble_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>">Doble:</div>
                            <input type="number" name="sumar_doble_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" id="sumar_doble_productos_relacionados_<?php echo $contador_productos_relacionados."_".$contador_incrementos_tarifas; ?>" placeholder="Sumar" value="<?php echo $matriz_sumar_doble_productos_relacionados[$valor_tarifas][$valor_id_productos_relacionados]; ?>" step="0.01" required />&nbsp;&euro;
                        </div>
                        <?php
                        $contador_incrementos_tarifas += 1;
                    }
                    ?>
                </div>
            </div>

            <div class="hidden">
                <div id="relacionados_modelo_opciones_por_defecto_<?php echo $contador_productos_relacionados; ?>">
                    Por defecto
                    <div class="<?php echo $class_row_con; ?>" id="relacionados_row-con_por_defecto_<?php echo $contador_productos_relacionados; ?>">
                        <div id="label_por_defecto_con_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">Con:</div>
                        <input type="radio" name="por_defecto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="por_defecto_con_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="con"<?php echo $checked_por_defecto_con; ?> />
                    </div>
                    <div class="<?php echo $class_row_mitad; ?>" id="relacionados_row-mitad_por_defecto_<?php echo $contador_productos_relacionados; ?>">
                        <div id="label_por_defecto_mitad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">Mitad:</div>
                        <input type="radio" name="por_defecto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="por_defecto_mitad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="mitad"<?php echo $checked_por_defecto_mitad; ?> />
                    </div>
                    <div class="<?php echo $class_row_sin; ?>" id="relacionados_row-sin_por_defecto_<?php echo $contador_productos_relacionados; ?>">
                        <div id="label_por_defecto_sin_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">Sin:</div>
                        <input type="radio" name="por_defecto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="por_defecto_sin_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="sin"<?php echo $checked_por_defecto_sin; ?> />
                    </div>
                    <div class="<?php echo $class_row_doble; ?>" id="relacionados_row-doble_por_defecto_<?php echo $contador_productos_relacionados; ?>">
                        <div id="label_por_defecto_doble_productos_relacionados_<?php echo $contador_productos_relacionados; ?>">Doble:</div>
                        <input type="radio" name="por_defecto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="por_defecto_doble_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="doble"<?php echo $checked_por_defecto_doble; ?> />
                    </div>
                </div>
            </div>

            <div class="col-span-2 flex flex-wrap items-center justify-end" id="capa_guardar_relacionados_<?php echo $contador_productos_relacionados; ?>">
                <div>
                    <a href="#" onclick="guardarComposicion('relacionados','<?php echo $id_url; ?>','<?php echo $tipo_producto_productos; ?>','<?php echo $contador_productos_relacionados; ?>',['<?php echo $matriz_id_tarifas; ?>']);" id="guardar_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </a>
                </div>
                <div class="ml-4 mr-3">
                    <a href="#" onclick="eliminarRelacionado('<?php echo $id_url; ?>','<?php echo $matriz_id_productos_relacionados[$key_id_productos_relacionados]; ?>','<?php echo $contador_productos_relacionados; ?>');" id="eliminar_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <hr />
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
}
unset($matriz_id_tarifas);
unset($matriz_id_idioma_tarifas);
unset($matriz_descripcion_tarifas);
unset($matriz_prioritaria_tarifas);
unset($matriz_activa_tarifas);
unset($matriz_orden_tarifas);