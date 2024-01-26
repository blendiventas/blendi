<?php
$select_sys = 'listado-titulos';
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
$select_sys = 'listado-titulos';
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
$select_sys = 'listado';
require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-select-php.php");
$contadorMasAlto = 0;
?>
<input type="hidden" name="apartado" id="apartado" value="personalizacion" />
<input type="hidden" name="titulo_descripcion_0" id="titulo_descripcion_0" class="titulo_descripcion" value="Título" />
<input type="hidden" name="titulo_orden_0" id="titulo_orden_0" class="titulo_orden" value="10" />
<input type="hidden" name="titulo_tipo_0" id="titulo_tipo_0" class="titulo_tipo" value="3" />
<div class="flex flex-wrap space-x-2 items-center justify-end px-5">
    <?php
    if (empty($titulos_id)) {
        ?>
        <div class="pl-2 mt-2 text-center">
            Si haces una personalización de producto no podrás hacer elaboraciones.
        </div>
        <?php
    }
    ?>
    <div class="pl-2 mt-2 text-center" id="capa_guardar_insert">
        <a href="#" class="items-center inline-flex justify-center border border-transparent bg-blendi-600 dark:bg-blendidark-600 py-2 px-4 text-sm font-medium text-white dark:text-black shadow-sm" onclick="guardarTitulo(0, <?php echo $id_url; ?>, <?php echo $tipo_producto_productos; ?>)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Nuevo título
        </a>
    </div>
</div>
<?php
foreach ($titulos_id as $titulo_key => $titulo_id) {
    ?>
    <div class="bg-gray-50 dark:bg-white dark:border-2 dark:border-black p-3 mt-3 mx-5">
        <div>
            Título
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div class="col-span-2">
                <input type="hidden" name="titulo_orden_<?php echo $titulo_id; ?>" id="titulo_orden_<?php echo $titulo_id; ?>" class="titulo_orden" value="<?php echo $titulos_orden[$titulo_key]; ?>" />
                <input type="text" name="titulo_descripcion_<?php echo $titulo_id; ?>" id="titulo_descripcion_<?php echo $titulo_id; ?>" class="titulo_descripcion w-full" value="<?php echo $titulos_descripcion[$titulo_key]; ?>" />
            </div>
            <div>
                <input type="hidden" class="titulo_tipo" name="titulo_tipo_<?php echo $titulo_id; ?>" id="titulo_tipo_<?php echo $titulo_id; ?>" value="3" />
                <div id="titulo_button_dropdown_tipo_<?php echo $titulo_id; ?>" class="flex items-center px-3 border-2 rounded bg-white cursor-pointer h-12">
                    <div class="grow grid grid-cols-7 items-center space-x-2 h-12" id="titulo_button_text_dropdown_tipo_<?php echo $titulo_id; ?>">
                        <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-4 h-4">
                            <path d="M10,5 C7.2,5 5,7.2 5,10 C5,12.8 7.2,15 10,15 C12.8,15 15,12.8 15,10 C15,7.2 12.8,5 10,5 L10,5 Z M10,0 C4.5,0 0,4.5 0,10 C0,15.5 4.5,20 10,20 C15.5,20 20,15.5 20,10 C20,4.5 15.5,0 10,0 L10,0 Z M10,18 C5.6,18 2,14.4 2,10 C2,5.6 5.6,2 10,2 C14.4,2 18,5.6 18,10 C18,14.4 14.4,18 10,18 L10,18 Z" id="Shape"/>
                        </svg>
                        <div class="col-span-6">
                            Varias opciones
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div id="titulo_dropdown_tipo_<?php echo $titulo_id; ?>" class="hidden bg-white border-2 rounded bg-white cursor-pointer">
                    <div onclick="updateTipo(<?php echo $titulo_id; ?>, 3, [])" id="titulo_dropdown_tipo_<?php echo $titulo_id; ?>_opcion_3" class="grid grid-cols-7 items-center space-x-2 bg-blendi-50 h-12 px-3 hover:bg-gray-50 titulo_dropdown_tipo_<?php echo $titulo_id; ?>_opcion">
                        <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-4 h-4">
                            <path d="M10,5 C7.2,5 5,7.2 5,10 C5,12.8 7.2,15 10,15 C12.8,15 15,12.8 15,10 C15,7.2 12.8,5 10,5 L10,5 Z M10,0 C4.5,0 0,4.5 0,10 C0,15.5 4.5,20 10,20 C15.5,20 20,15.5 20,10 C20,4.5 15.5,0 10,0 L10,0 Z M10,18 C5.6,18 2,14.4 2,10 C2,5.6 5.6,2 10,2 C14.4,2 18,5.6 18,10 C18,14.4 14.4,18 10,18 L10,18 Z" id="Shape"/>
                        </svg>
                        <div class="col-span-6">
                            Varias opciones
                        </div>
                    </div>
                    <div onclick="updateTipo(<?php echo $titulo_id; ?>, 0, [])" id="titulo_dropdown_tipo_<?php echo $titulo_id; ?>_opcion_0" class="grid grid-cols-7 items-center space-x-2 h-12 px-3 hover:bg-gray-50 titulo_dropdown_tipo_<?php echo $titulo_id; ?>_opcion">
                        <svg viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-6 h-6">
                            <path d="M16,6H8c-3.3,0-6,2.7-6,6s2.7,6,6,6h8c3.3,0,6-2.7,6-6S19.3,6,16,6z M16,16H8c-2.2,0-4-1.8-4-4s1.8-4,4-4h8    c2.2,0,4,1.8,4,4S18.2,16,16,16z"/>
                            <path d="M16,9c-1.7,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S17.7,9,16,9z M16,13c-0.6,0-1-0.4-1-1s0.4-1,1-1s1,0.4,1,1S16.6,13,16,13z"/>
                        </svg>
                        <div class="col-span-6">
                            Casillas
                        </div>
                    </div>
                    <div onclick="updateTipo(<?php echo $titulo_id; ?>, 5, [])" id="titulo_dropdown_tipo_<?php echo $titulo_id; ?>_opcion_5" class="grid grid-cols-7 items-center space-x-2 h-12 px-3 hover:bg-gray-50 titulo_dropdown_tipo_<?php echo $titulo_id; ?>_opcion">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                        </svg>
                        <div class="col-span-6">
                            Texto
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $select_sys = 'listado-titulos-relacionados';
        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
        foreach ($titulos_relacionados_id as $titulo_relacionados_key => $titulo_relacionados_id) {
            ?>
            <div class="flex flex-wrap mt-3 items-center space-x-3">
                <label class="inline-flex relative items-center cursor-pointer titulo_relacionado_defecto_<?php echo $titulo_id; ?>">
                    &nbsp;
                </label>
                <div class="grow">
                    <input type="hidden" id="titulo_relacionado_producto_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>" class="titulo_relacionado_producto_<?php echo $titulo_id; ?>" value="<?php echo $titulos_relacionados_id_producto[$titulo_relacionados_key]; ?>" />
                    <div id="titulo_relacionado_dropdown_descripcion_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>_trigger">
                        <input type="text" name="titulo_relacionado_descripcion[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 titulo_relacionado_descripcion_<?php echo $titulo_id; ?>" value="<?php echo $titulos_relacionados_descripcion[$titulo_relacionados_key]; ?>" onkeyup="descripcionBuscador(<?php echo $titulo_id; ?>, <?php echo $titulo_relacionados_key; ?>, <?php echo $id_url; ?>)" />
                    </div>
                    <div id="titulo_relacionado_dropdown_descripcion_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>" class="hidden bg-white border-2 rounded bg-white cursor-pointer titulo_relacionado_descripcion_buscador_<?php echo $titulo_id; ?>">
                        ...
                    </div>
                </div>
                <div id="titulo_relacionado_incrementos_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>" class="<?php echo (empty($titulos_relacionados_id_producto[$titulo_relacionados_key]))? 'hidden' : ''; ?> titulo_relacionado_incrementos_<?php echo $titulo_id; ?>">
                    <a href="#" id="titulo_relacionado_incrementos_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>_trigger">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                        </svg>
                    </a>
                    <div id="titulo_relacionado_incrementos_<?php echo $titulo_id; ?>_<?php echo $titulo_relacionados_key; ?>_target" class="hidden bg-white border-2 rounded bg-white cursor-pointer">
                        <?php
                        if (isset($matriz_id_tarifas) && is_array($matriz_id_tarifas)) {
                            foreach ($matriz_id_tarifas as $key_tarifa => $id_tarifa) {
                                ?>
                                <div class="grid grid-cols-7 items-center space-x-2 h-12 px-3">
                                    <div class="col-span-3"><?php echo $matriz_descripcion_tarifas[$key_tarifa]; ?></div>
                                    <div class="col-span-4">
                                        <input type="hidden" name="titulo_relacionado_producto_tarifa_id[]" class="titulo_relacionado_producto_tarifa_id_<?php echo $titulo_id; ?>" value="<?php echo $id_tarifa; ?>" />
                                        <input type="number" name="titulo_relacionado_producto_tarifa_incremento[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 titulo_relacionado_producto_tarifa_incremento_<?php echo $titulo_id; ?>" value="<?php echo $matriz_incrementos_productos_relacionados[$id_tarifa][$titulos_relacionados_id_producto[$titulo_relacionados_key]]; ?>" />
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="titulo_relacionado_eliminar_<?php echo $titulo_id; ?>">
                    <a href="#" onclick="eliminarTituloRelacionado(this, <?php echo $titulo_id; ?>);">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
            </div>
            <script type="text/javascript">
                loadDropdownDescripcionBuscador(<?php echo $titulo_id; ?>, <?php echo $titulo_relacionados_key; ?>);
                loadDropdownIncrementos(<?php echo $titulo_id; ?>, <?php echo $titulo_relacionados_key; ?>);
            </script>
            <?php
        }
        $contadorMasAlto = ($titulo_relacionados_key + 2 > $contadorMasAlto)? $titulo_relacionados_key + 2 : $contadorMasAlto;
        ?>
        <div id="titulos_relacionados_nuevos_<?php echo $titulo_id; ?>">
        </div>
        <div class="mt-3 w-full text-gray-100 text-left cursor-pointer">
            <a href="#" onclick="anadirTituloRelacionado(<?php echo $titulo_id; ?>, <?php echo $id_url; ?>);">
                Añadir opción
            </a>
        </div>
        <div class="flex flex-wrap mt-3 items-center space-x-3 hidden" id="titulo_relacionado_nuevo_<?php echo $titulo_id; ?>">
            <label class="inline-flex relative items-center cursor-pointer titulo_relacionado_defecto_<?php echo $titulo_id; ?>">
                <input type="checkbox" name="titulo_relacionado_defecto[]" value="1" class="sr-only peer titulo_relacionado_defecto_input_<?php echo $titulo_id; ?>">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blendi-600"></div>
            </label>
            <div class="grow">
                <input type="hidden" id="titulo_relacionado_producto_<?php echo $titulo_id; ?>_aSustituirPorElContador" class="titulo_relacionado_producto_<?php echo $titulo_id; ?>" value="0" />
                <div id="titulo_relacionado_dropdown_descripcion_<?php echo $titulo_id; ?>_aSustituirPorElContador_trigger">
                    <input type="text" name="titulo_relacionado_descripcion[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 titulo_relacionado_descripcion_<?php echo $titulo_id; ?>" value="Producto" />
                </div>
                <div id="titulo_relacionado_dropdown_descripcion_<?php echo $titulo_id; ?>_aSustituirPorElContador" class="hidden bg-white border-2 rounded bg-white cursor-pointer titulo_relacionado_descripcion_buscador_<?php echo $titulo_id; ?>">
                    ...
                </div>
            </div>
            <div id="titulo_relacionado_incrementos_<?php echo $titulo_id; ?>_aSustituirPorElContador" class="hidden titulo_relacionado_incrementos_<?php echo $titulo_id; ?>">
                <a href="#" id="titulo_relacionado_incrementos_<?php echo $titulo_id; ?>_aSustituirPorElContador_trigger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                    </svg>
                </a>
                <div id="titulo_relacionado_incrementos_<?php echo $titulo_id; ?>_aSustituirPorElContador_target" class="hidden bg-white border-2 rounded bg-white cursor-pointer">
                    <?php
                    if (isset($matriz_id_tarifas) && is_array($matriz_id_tarifas)) {
                        foreach ($matriz_id_tarifas as $key_tarifa => $id_tarifa) {
                            ?>
                            <div class="grid grid-cols-7 items-center space-x-2 h-12 px-3">
                                <div class="col-span-3"><?php echo $matriz_descripcion_tarifas[$key_tarifa]; ?></div>
                                <div class="col-span-4">
                                    <input type="hidden" name="titulo_relacionado_producto_tarifa_id[]" class="titulo_relacionado_producto_tarifa_id_<?php echo $titulo_id; ?>" value="<?php echo $id_tarifa; ?>" />
                                    <input type="number" name="titulo_relacionado_producto_tarifa_incremento[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 titulo_relacionado_producto_tarifa_incremento_<?php echo $titulo_id; ?>" value="0" />
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="titulo_relacionado_eliminar_<?php echo $titulo_id; ?>">
                <a href="#" onclick="eliminarTituloRelacionado(this, <?php echo $titulo_id; ?>);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>
        <?php
        if (count($titulos_relacionados_id) <= 0) {
            ?>
            <script type="text/javascript">
                setDescripcionBuscadorContador(<?php echo $titulo_relacionados_key + 1; ?>);
                anadirTituloRelacionado(<?php echo $titulo_id; ?>, <?php echo $id_url; ?>);
            </script>
            <?php
        }
        ?>
        <script type="text/javascript">
            updateTipo(<?php echo $titulo_id; ?>, <?php echo $titulos_modelo[$titulo_key]; ?>, [<?php echo "'" . join("','", $titulos_relacionados_defecto) . "'"; ?>]);
            loadDropdownTipo(<?php echo $titulo_id; ?>);
            mostrarEliminarTituloRelacionado(<?php echo $titulo_id; ?>);
        </script>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div id="capa_guardar_update_<?php echo $titulo_id; ?>" class="flex space-x-2 justify-end">
                <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="eliminarTitulo(<?php echo $titulo_id; ?>, <?php echo $id_url; ?>);">Eliminar</button>
                <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarTitulo(<?php echo $titulo_id; ?>, <?php echo $id_url; ?>, <?php echo $tipo_producto_productos; ?>);">Guardar</button>
            </div>
        </div>
    </div>
    <?php
    unset($titulos_relacionados_id);
    unset($titulos_relacionados_id_producto);
    unset($titulos_relacionados_defecto);
    unset($titulos_relacionados_descripcion);
    unset($titulos_relacionados_orden);
}
?>
<script type="text/javascript">
    setDescripcionBuscadorContador(<?php echo $contadorMasAlto; ?>);
    desactivarBotonesPorDefectoFicha();
</script>
