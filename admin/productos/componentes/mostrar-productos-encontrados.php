<input type="hidden" name="tipo_producto_productos" id="tipo_producto_productos" value="<?php echo $tipo_producto_productos; ?>" />

<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <button class="w-full rounded items-center inline-flex justify-center border border-transparent bg-gray-450 py-2 px-4 text-sm font-medium text-white shadow-sm" type="button" onclick="document.getElementById('capa_resultados_busqueda').style.display = 'none'; document.getElementById('capa_boton_ocultar_resultados').style.display = 'none';">Ocultar resultados</button>
    <div class="text-center">
        Coincidencias de <?php echo $texto_buscar; ?> en <?php echo $buscar_por; ?>.
    </div>
</div>
<?php

$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-select-php.php");
?>
<input type="hidden" name="incrementos_tarifas" id="incrementos_tarifas" value="<?php echo count($matriz_id_tarifas); ?>" />

<div class="grid grid-cols-12 items-center h-10 bg-gray-50 mt-3">
    <div class="px-3 col-span-6">
        Descripción
    </div>
    <div class="px-3 col-span-4">
        <?php
        if ($tipo_producto_productos == 3 || $tipo_producto_productos == 4){
            ?>
            Grupo
            <?php
        } else {
            ?>
            Cantidad y <?php echo (isset($embalajes))? 'sumar precio al PVP' : 'unidad'; ?>
            <?php
        }
        ?>
    </div>
    <div class="text-center px-3 col-span-2">
        &nbsp;
    </div>
</div>
<div class="overflow-y-auto bg-white">
    <?php
    $contador_productos_encontrados = 0;
    $id_tabla_relacionado_encontrados = '0';
    foreach ($id_producto_productos_encontrados as $key_id_productos_encontrados => $valor_id_productos_encontrados) {
        $contador_productos_encontrados += 1;
        ?>
        <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
            <input type="hidden" name="id_producto_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="id_producto_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" value="<?php echo $id_producto_productos_encontrados[$key_id_productos_encontrados]; ?>" />
            <input type="hidden" name="id_enlazado_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="id_enlazado_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" value="<?php echo $id_enlazado_productos_encontrados[$key_id_productos_encontrados]; ?>" />
            <input type="hidden" name="id_multiple_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="id_multiple_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" value="<?php echo $id_multiple_productos_encontrados[$key_id_productos_encontrados]; ?>" />
            <input type="hidden" name="id_pack_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="id_pack_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" value="<?php echo $id_pack_productos_encontrados[$key_id_productos_encontrados]; ?>" />
            <input type="hidden" name="id_tabla_relacionado_encontrados_<?php echo $contador_productos_encontrados; ?>" id="id_tabla_relacionado_encontrados_<?php echo $contador_productos_encontrados; ?>" value="<?php echo $id_tabla_relacionado_encontrados; ?>" />
            <div class="px-3 col-span-6 flex flex-wrap items-center">
                <?php
                $id_producto = $id_producto_productos_encontrados[$key_id_productos_encontrados];
                $id_enlazado = $id_enlazado_productos_encontrados[$key_id_productos_encontrados];
                $id_multiple = $id_multiple_productos_encontrados[$key_id_productos_encontrados];
                $id_pack = $id_pack_productos_encontrados[$key_id_productos_encontrados];
                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/imagenes/componentes/mostrar-imagenes.php");
                ?>
                <div class="box text-center font-bold ml-2">
                    <?php echo $descripciones_productos_encontrados[$key_id_productos_encontrados];
                    ?>
                </div>
            </div>
            <div class="px-3 col-span-4">
                <?php
                if(!isset($embalajes)) {
                    ?>
                    <div class="box text-center font-bold hidden">
                        <label for="encontrados_modelo_productos_<?php echo $contador_productos_encontrados; ?>">Modelo:</label>
                        <select id="encontrados_modelo_productos_<?php echo $contador_productos_encontrados; ?>" name="encontrados_modelo_productos[<?php echo $contador_productos_encontrados; ?>]" onchange="mostrar_opciones_modelo('encontrados','<?php echo $contador_productos_encontrados; ?>');" required>
                            <?php
                            switch($tipo_producto_productos) {
                                case '1':
                                case '2':
                                    ?>
                                    <option value="0">Con / Sin</option>
                                    <option value="1">Con / Mitad / Sin / Doble</option>
                                    <option value="2">Por cantidad</option>
                                    <option value="3">Único</option>
                                    <option value="4" selected>No mostrar</option>
                                    <?php
                                    break;
                                case '3':
                                case '4':
                                    ?>
                                    <option value="5">Menú</option>
                                    <?php
                                    break;
                                case '0':
                                default:
                                    ?>
                                    <option value="0">Con / Sin</option>
                                    <option value="1">Con / Mitad / Sin / Doble</option>
                                    <option value="2">Por cantidad</option>
                                    <option value="3">Único</option>
                                    <option value="4" selected>No mostrar</option>
                                    <option value="5">Menú</option>
                                    <?php
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }else {
                    ?>
                    <input type="hidden" id="encontrados_modelo_productos_<?php echo $contador_productos_encontrados; ?>" name="encontrados_modelo_productos[<?php echo $contador_productos_encontrados; ?>]" value="2" />
                    <?php
                }
                $columns = 2;
                if(isset($embalajes)) {
                    $columns++;
                }
                if($tipo_producto_productos == 3 || $tipo_producto_productos == 4) {
                    $columns--;
                }
                ?>
                <div class="grid grid-cols-1 sm:grid-cols-<?php echo $columns; ?> items-center h-10 bg-white" id="encontrados_modelo_base_<?php echo $contador_productos_encontrados; ?>">
                    <div class="<?php echo ($tipo_producto_productos == 3 || $tipo_producto_productos == 4)? 'hidden' : ''; ?>">
                        <?php
                        if(isset($embalajes)) {
                            ?>
                            <input type="number" name="cantidad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full h-9" id="cantidad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" placeholder="Cantidad" value="1" step="1" required />
                            <?php
                        }else {
                            ?>
                            <input type="number" name="cantidad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full h-9" id="cantidad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" placeholder="Cantidad" value="1" step="0.01" required />
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if(!isset($embalajes)) {
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
                        $id_url = $id_producto_productos_encontrados[$key_id_productos_encontrados];
                        $select_sys = "unidades";
                        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
                        $id_url = $id_url_memo;
                        $descripcion_unidad_principal = '';
                        ?>
                        <div class="<?php echo ($tipo_producto_productos == 1 || !$tipo_producto_productos)? '' : 'hidden'; ?> ml-2" id="encontrados_row-unidades_<?php echo $contador_productos_encontrados; ?>">
                            <select id="id_unidad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full h-9">
                                <?php
                                foreach ($id_productos_unidades as $key_id_productos_unidad => $valor_id_productos_unidades) {
                                    foreach ($id_unidades as $key_id_unidades => $valor_id_unidades) {
                                        if ($id_unidad_productos_unidades[$key_id_productos_unidad] == $valor_id_unidades) {
                                            $selected = "";
                                            if($principal_productos_unidades[$key_id_productos_unidad]) {
                                                $selected = " selected";
                                                $descripcion_unidad_principal = $unidad_unidades[$key_id_unidades];
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
                        <?php
                    }
                    if (isset($embalajes) && $producto_venta_productos_encontrados[$key_id_productos_encontrados] == 1) {
                        ?>
                        <div class="flex flex-wrap col-span-2">
                            <div onclick="activarElementoUnicoFicha('sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_1', 'capa_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_1', 'capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>')" id="capa_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?> poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>">
                                    &nbsp;
                                </div>
                                <div id="check_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_1" class="hidden check_capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>" id="sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_1" value="1" class="hidden" />
                                <script type="text/javascript">
                                    activarElementoUnicoFicha('sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_1', 'capa_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_1', "capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>");
                                </script>
                            </div>
                            <div onclick="activarElementoUnicoFicha('sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_2', 'capa_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_2', 'capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>')" id="capa_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>">
                                    &nbsp;
                                </div>
                                <div id="check_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_2" class="hidden check_capa_unicos_sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>" id="sumar_embalaje_encontrados_<?php echo $contador_productos_encontrados; ?>_2" value="0" class="hidden" />
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="hidden" id="encontrados_row-incremento_<?php echo $contador_productos_encontrados; ?>">
                        <?php
                        $contador_incrementos_tarifas = 0;
                        foreach ($matriz_id_tarifas as $key_tarifas => $valor_tarifas) {
                            ?>
                            Incremento PVP <?php echo $matriz_descripcion_tarifas[$key_tarifas]; ?>
                            <input type="hidden" name="id_incrementos_tarifas_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" id="id_incrementos_tarifas_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" value="<?php echo $valor_tarifas; ?>" />
                            <input type="number" name="sumar_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" id="sumar_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" placeholder="Sumar" value="0" step="0.01" required />&nbsp;&euro;
                            <?php
                            $contador_incrementos_tarifas += 1;
                        }
                        ?>
                    </div>
                    <?php
                    $select_sys = "listado-grupos";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/grupos/gestion/datos-select-php.php");
                    ?>
                    <div class="<?php echo ($tipo_producto_productos == 3 || $tipo_producto_productos == 4)? '' : 'hidden'; ?>" id="encontrados_row-select_grupos_<?php echo $contador_productos_encontrados; ?>">
                        <select id="id_grupo_productos_<?php echo $contador_productos_encontrados; ?>" name="id_grupo_productos" required class="w-full">
                            <?php
                            if(isset($matriz_id_productos_grupos)) {
                                foreach ($matriz_id_productos_grupos as $key_id_productos_grupos => $valor_id_productos_grupos) {
                                    ?>
                                    <option value="<?php echo $valor_id_productos_grupos; ?>"><?php echo $matriz_descripcion_productos_grupos[$key_id_productos_grupos]; ?></option>
                                    <?php
                                }
                                unset($matriz_id_productos_grupos);
                                unset($matriz_descripcion_productos_grupos);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="hidden" id="encontrados_modelo_opciones_<?php echo $contador_productos_encontrados; ?>">
                    <label>Cantidades (<?php echo $descripcion_unidad_principal; ?>)</label><br>
                    <div class="grid grid-cols-1 sm:grid-cols-4 items-center h-10 bg-white sm:mx-5 mt-3">
                        <div id="encontrados_row-con_cantidad_<?php echo $contador_productos_encontrados; ?>">
                            <label id="label_cantidad_con_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" for="cantidad_con_productos_encontrados_<?php echo $contador_productos_encontrados; ?>">Con:</label><br>
                            <input type="number" name="cantidad_con_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="cantidad_con_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full" placeholder="Cantidad" value="1" step="0.01" required />
                        </div>
                        <div id="encontrados_row-mitad_cantidad_<?php echo $contador_productos_encontrados; ?>">
                            <label id="label_cantidad_mitad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" for="cantidad_mitad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>">Mitad:</label><br>
                            <input type="number" name="cantidad_mitad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="cantidad_mitad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full" placeholder="Cantidad" value="0.5" step="0.01" required />
                        </div>
                        <div id="encontrados_row-sin_cantidad_<?php echo $contador_productos_encontrados; ?>">
                            <label id="label_cantidad_sin_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" for="cantidad_sin_productos_encontrados_<?php echo $contador_productos_encontrados; ?>">Sin:</label><br>
                            <input type="number" disabled name="cantidad_sin_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="cantidad_sin_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full" placeholder="Cantidad" value="0" step="0.01" required />
                        </div>
                        <div id="encontrados_row-doble_cantidad_<?php echo $contador_productos_encontrados; ?>">
                            <label id="label_cantidad_doble_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" for="cantidad_doble_productos_encontrados_<?php echo $contador_productos_encontrados; ?>">Doble:</label><br>
                            <input type="number" name="cantidad_doble_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="cantidad_doble_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full" placeholder="Cantidad" value="2" step="0.01" required />
                        </div>
                    </div>

                    <?php
                    $contador_incrementos_tarifas = 0;
                    foreach ($matriz_id_tarifas as $key_tarifas => $valor_tarifas) {
                        ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 items-center h-10 bg-white sm:mx-5 mt-3">
                            <div>
                                Incremento PVP <?php echo $matriz_descripcion_tarifas[$key_tarifas]; ?>
                            </div>
                        </div>
                        <input type="hidden" name="id_incrementos_tarifas_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" id="id_incrementos_tarifas_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" value="<?php echo $valor_tarifas; ?>" /><br>
                        <div class="grid grid-cols-1 sm:grid-cols-4 items-center h-10 bg-white sm:mx-5 mt-3">
                            <div id="encontrados_row-con_sumar_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>">
                                <label id="label_sumar_con_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" for="sumar_con_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>">Con:</label><br>
                                <input type="number" name="sumar_con_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" id="sumar_con_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" class="w-full" placeholder="Sumar" value="0" step="0.01" required />&nbsp;&euro;
                            </div>
                            <div id="encontrados_row-mitad_sumar_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>">
                                <label id="label_sumar_mitad_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" for="sumar_mitad_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>">Mitad:</label><br>
                                <input type="number" name="sumar_mitad_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" id="sumar_mitad_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" class="w-full" placeholder="Sumar" value="0" step="0.01" required />&nbsp;&euro;
                            </div>
                            <div id="encontrados_row-sin_sumar_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>">
                                <label id="label_sumar_sin_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" for="sumar_sin_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>">Sin:</label><br>
                                <input type="number" disabled name="sumar_sin_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" id="sumar_sin_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" class="w-full" placeholder="Sumar" value="0" step="0.01" required />&nbsp;&euro;
                            </div>
                            <div id="encontrados_row-doble_sumar_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>">
                                <label id="label_sumar_doble_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" for="sumar_doble_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>">Doble:</label><br>
                                <input type="number" name="sumar_doble_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" id="sumar_doble_productos_encontrados_<?php echo $contador_productos_encontrados."_".$contador_incrementos_tarifas; ?>" class="w-full" placeholder="Sumar" value="0" step="0.01" required />&nbsp;&euro;
                            </div>
                        </div>
                        <?php
                        $contador_incrementos_tarifas += 1;
                    }
                    ?>

                    <div class="grid grid-cols-1 sm:grid-cols-4 items-center h-10 bg-white sm:mx-5 mt-3">
                        <div>
                            Por defecto
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 items-center h-10 bg-white sm:mx-5 mt-3">
                        <div id="encontrados_row-con_por_defecto_<?php echo $contador_productos_encontrados; ?>">
                            <label id="label_por_defecto_con_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" for="por_defecto_con_productos_encontrados_<?php echo $contador_productos_encontrados; ?>">Con:</label><br>
                            <input type="radio" name="por_defecto_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="por_defecto_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full" id="por_defecto_con_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" value="con" checked />
                        </div>
                        <div id="encontrados_row-mitad_por_defecto_<?php echo $contador_productos_encontrados; ?>">
                            <label id="label_por_defecto_mitad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" for="por_defecto_mitad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>">Mitad:</label><br>
                            <input type="radio" name="por_defecto_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="por_defecto_mitad_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full" value="mitad" />
                        </div>
                        <div id="encontrados_row-sin_por_defecto_<?php echo $contador_productos_encontrados; ?>">
                            <label id="label_por_defecto_sin_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" for="por_defecto_sin_productos_encontrados_<?php echo $contador_productos_encontrados; ?>">Sin:</label><br>
                            <input type="radio" name="por_defecto_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="por_defecto_sin_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full" value="sin" />
                        </div>
                        <div id="encontrados_row-doble_por_defecto_<?php echo $contador_productos_encontrados; ?>">
                            <label id="label_por_defecto_doble_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" for="por_defecto_doble_productos_encontrados_<?php echo $contador_productos_encontrados; ?>">Doble:</label><br>
                            <input type="radio" name="por_defecto_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" id="por_defecto_doble_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full" value="doble" />
                        </div>
                    </div>
                </div>
            </div>
            <div id="capa_guardar_encontrados_<?php echo $contador_productos_encontrados; ?>" class="text-center px-3 col-span-2">
                <?php
                if(isset($embalajes)) {
                    ?>
                    <button class="w-full rounded items-center inline-flex justify-center border border-transparent bg-gray-450 py-2 px-4 text-sm font-medium text-white shadow-sm" type="button" onclick="guardarEmbalaje('encontrados','<?php echo $id_url; ?>','<?php echo $tipo_producto_productos; ?>','<?php echo $contador_productos_encontrados; ?>');" id="guardar_relacionado_encontrados_<?php echo $contador_productos_encontrados; ?>">Añadir</button><br />
                    <?php
                }else {
                    ?>
                    <button class="w-full rounded items-center inline-flex justify-center border border-transparent bg-gray-450 py-2 px-4 text-sm font-medium text-white shadow-sm" type="button" onclick="guardarComposicion('encontrados','<?php echo $id_url; ?>','<?php echo $tipo_producto_productos; ?>','<?php echo $contador_productos_encontrados; ?>',['<?php echo $matriz_id_tarifas; ?>']);" id="guardar_relacionado_encontrados_<?php echo $contador_productos_encontrados; ?>">Añadir</button><br />
                    <?php
                }
                ?>
            </div>
            <input type="hidden" name="fijo_productos_encontrados[<?php echo $contador_productos_encontrados; ?>]" id="fijo_no_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" value="0" />
            <input type="hidden" name="mostrar_productos_encontrados[<?php echo $contador_productos_encontrados; ?>]" id="mostrar_productos_encontrados_<?php echo $contador_productos_encontrados; ?>" value="1" />
        </div>
        <?php
    }
    unset($matriz_id_tarifas);
    unset($matriz_id_idioma_tarifas);
    unset($matriz_descripcion_tarifas);
    unset($matriz_prioritaria_tarifas);
    unset($matriz_activa_tarifas);
    unset($matriz_orden_tarifas);
    ?>
</div>
