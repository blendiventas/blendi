<input type="hidden" name="tipo_producto_productos" id="tipo_producto_productos" value="<?php echo $tipo_producto_productos; ?>" />
<?php
if(isset($matriz_id_productos_embalajes)) {
    $contador_productos_relacionados = 0;
    /*
    $matriz_id_productos_embalajes[] = $valor_productos_embalajes['id'];
    $matriz_id_relacionado_productos_embalajes[] = $valor_productos_embalajes['id_producto_relacionado'];
    $matriz_cantidad_productos_embalajes[] = $valor_productos_embalajes['cantidad'];
    $matriz_sumar_productos_embalajes[] = $valor_productos_embalajes['sumar'];
    */
    foreach ($matriz_id_productos_embalajes as $key_id_productos_embalajes => $valor_id_productos_embalajes) {
        $contador_productos_relacionados += 1;
        ?>
        <input type="hidden" name="id_producto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_producto_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $matriz_id_relacionado_productos_embalajes[$key_id_productos_embalajes]; ?>" />
        <input type="hidden" name="id_tabla_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>" id="id_tabla_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>" value="<?php echo $valor_id_productos_embalajes; ?>" />
        <?php
        $id_producto = $matriz_id_relacionado_productos_embalajes[$key_id_productos_embalajes];
        $id_enlazado = 0;
        $id_multiple = 0;
        $id_pack = 0;
        require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/imagenes/componentes/mostrar-imagenes.php");

        $descripcion_productos_original = $descripcion_productos;
        $id_url_copia = $id_url;
        $id_url = $matriz_id_relacionado_productos_embalajes[$key_id_productos_embalajes];
        $select_sys = "editar-ficha";
        require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");
        $id_url = $id_url_copia;

        ?>
        <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
            <div class="px-3 col-span-1 items-center">
                <a href="#" onclick="abrirFichaEnNuevaPestana(<?php echo $matriz_id_relacionado_productos_embalajes[$key_id_productos_embalajes]; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </a>
            </div>
            <div class="px-3 col-span-5 flex flex-wrap items-center">
                <?php
                echo "<strong>".$descripcion_productos."</strong>";
                ?>
            </div>
            <?php
    
            $columnsToEmbalajes = "3";
            $checked_si = " checked";
            $checked_no = "";
            if($producto_venta_productos == 0) {
                $columnsToEmbalajes = "1";
            }
            if ($matriz_sumar_productos_embalajes[$key_id_productos_embalajes] == 0) {
                $checked_si = "";
                $checked_no = " checked";
            }
            ?>
            <div class="col-span-4" id="relacionados_modelo_base_<?php echo $contador_productos_relacionados; ?>">
                <div class="grid grid-cols-<?php echo $columnsToEmbalajes; ?> items-center h-10 bg-white">
                    <div>
                        <input type="number" class="w-full h-9" name="cantidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" id="cantidad_productos_relacionados_<?php echo $contador_productos_relacionados; ?>" placeholder="Cantidad" value="<?php echo $matriz_cantidad_productos_embalajes[$key_id_productos_embalajes]; ?>" step="1" required />
                    </div>
                    <?php
                    if($producto_venta_productos == 1) {
                        ?>
                        <div class="flex flex-wrap col-span-2">
                            <div onclick="activarElementoUnicoFicha('sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_1', 'capa_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_1', 'capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>')" id="capa_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?> poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>">
                                    &nbsp;
                                </div>
                                <div id="check_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_1" class="hidden check_capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>" id="sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_1" value="1" class="hidden" />
                                <?php
                                if ($checked_si) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_1', 'capa_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_1', "capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                            <div onclick="activarElementoUnicoFicha('sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_2', 'capa_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_2', 'capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>')" id="capa_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>">
                                    &nbsp;
                                </div>
                                <div id="check_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_2" class="hidden check_capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>" id="sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_2" value="0" class="hidden" />
                                <?php
                                if ($checked_no) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_2', 'capa_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>_2', "capa_unicos_sumar_embalaje_relacionados_<?php echo $contador_productos_relacionados; ?>");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-span-2 flex flex-wrap items-center justify-end" id="capa_guardar_relacionados_<?php echo $contador_productos_relacionados; ?>">
                <div>
                    <a href="#" onclick="guardarEmbalaje('relacionados','<?php echo $id_url; ?>','<?php echo $tipo_producto_productos; ?>','<?php echo $contador_productos_relacionados; ?>');" id="guardar_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </a>
                </div>
                <div class="ml-4 mr-3">
                    <a href="#" onclick="eliminarEmbalaje('<?php echo $id_url; ?>','<?php echo $matriz_id_productos_relacionados[$key_id_productos_relacionados]; ?>','<?php echo $contador_productos_relacionados; ?>');" id="eliminar_relacionado_relacionados_<?php echo $contador_productos_relacionados; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    unset($matriz_id_productos_embalajes);
    unset($matriz_id_relacionado_productos_embalajes);
    unset($matriz_cantidad_productos_embalajes);
    unset($matriz_sumar_productos_embalajes);
}