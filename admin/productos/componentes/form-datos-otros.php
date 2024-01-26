<?php
$select_sys = "datos-otros";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
if(empty($descripcion_larga_productos)) {
    $descripcion_larga_productos = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_productos);
}
if(empty($descripcion_url_productos)) {
    $descripcion_url_productos = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_productos);
}
if(empty($titulo_meta_productos)) {
    $titulo_meta_productos = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_productos);
}
if(empty($descripcion_meta_productos)) {
    $descripcion_meta_productos = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_productos);
}

if(!isset($id_productos_otros_datos)) {
    $id_productos_otros_datos = 0;
}
/*
if(!isset($id_productos_otros)) {
    $id_productos_otros = 0;
}
*/
echo $descripcion_pack_datos_otros."<br />";
?>
<input type="hidden" name="id_enlazado[<?php echo $contador_elementos; ?>]" id="id_enlazado_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_detalles_enlazado_productos_otros; ?>" />
<input type="hidden" name="id_multiple[<?php echo $contador_elementos; ?>]" id="id_multiple_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_detalles_multiples_productos_otros; ?>" />
<input type="hidden" name="id_pack[<?php echo $contador_elementos; ?>]" id="id_pack_<?php echo $contador_elementos; ?>" value="<?php echo $id_packs_productos_otros; ?>" />
<input type="hidden" name="id_productos_otros_datos[<?php echo $contador_elementos; ?>]" id="id_productos_otros_datos_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_otros_datos; ?>" />
<?php
if($producto_venta_productos == 1) {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <label for="disponibilidad_productos_<?php echo $contador_elementos; ?>">Disponibilidad:</label>
            <select id="disponibilidad_productos_<?php echo $contador_elementos; ?>" class="w-full" name="disponibilidad_productos[<?php echo $contador_elementos; ?>]" required>
                <?php
                $selected_sys = "";
                if ($disponibilidad_productos == 0) {
                    $selected_sys = " selected";
                }
                ?>
                <option value="0"<?php echo $selected_sys; ?>>Inactivo</option>
                <?php
                $selected_sys = "";
                if ($disponibilidad_productos == 1) {
                    $selected_sys = " selected";
                }
                ?>
                <option value="1"<?php echo $selected_sys; ?>>En stock</option>
                <?php
                $selected_sys = "";
                if ($disponibilidad_productos == 2) {
                    $selected_sys = " selected";
                }
                ?>
                <option value="2"<?php echo $selected_sys; ?>>Consultar</option>
                <?php
                $selected_sys = "";
                if ($disponibilidad_productos == 3) {
                    $selected_sys = " selected";
                }
                ?>
                <option value="3"<?php echo $selected_sys; ?>>No disponible</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <?php
            $select_sys = "listado-filtrado";
            require($_SERVER['DOCUMENT_ROOT']."/admin/terminales/gestion/datos-select-php.php");
            ?>
            <label for="enviar_productos_<?php echo $contador_elementos; ?>">Enviar a:</label>
            <select id="enviar_productos_<?php echo $contador_elementos; ?>" name="enviar_productos_<?php echo $contador_elementos; ?>" required>
                <?php
                $selected_sys = "";
                if ($enviar_productos == 0) {
                    $selected_sys = " selected";
                }
                ?>
                <option value="0"<?php echo $selected_sys; ?>>No enviar</option>
                <?php
                foreach ($matriz_id_terminales as $key_id_terminales => $valor_id_terminales) {
                    if($matriz_activo_terminales[$key_id_terminales] == 1) {
                        $selected_sys = "";
                        if ($enviar_productos == $valor_id_terminales) {
                            $selected_sys = " selected";
                        }
                        ?>
                        <option value="<?php echo $valor_id_terminales; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_descripcion_terminales[$key_id_terminales]; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <?php
}else {
    // inputs hidden de los datos a transferir
    ?>
    <input type="hidden" name="disponibilidad_productos_<?php echo $contador_elementos; ?>" id="disponibilidad_productos_<?php echo $contador_elementos; ?>" value="1" />
    <input type="hidden" name="enviar_productos[<?php echo $contador_elementos; ?>]" id="enviar_productos_<?php echo $contador_elementos; ?>" value="0" />
    <?php
}
?>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label>Bloquear actualización por lotes:</label>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('manual_productos_<?php echo $contador_elementos; ?>_1', 'capa_manual_productos_<?php echo $contador_elementos; ?>_1', 'capa_unicos_manual_productos_<?php echo $contador_elementos; ?>')" id="capa_manual_productos_<?php echo $contador_elementos; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_manual_productos_<?php echo $contador_elementos; ?>">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_manual_productos_<?php echo $contador_elementos; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_manual_productos_<?php echo $contador_elementos; ?>">
                    &nbsp;
                </div>
                <div id="check_manual_productos_<?php echo $contador_elementos; ?>_1" class="hidden check_capa_unicos_manual_productos_<?php echo $contador_elementos; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="manual_productos[<?php echo $contador_elementos; ?>]" id="manual_productos_<?php echo $contador_elementos; ?>_1" value="1" class="hidden" />
                <?php
                if ($manual_productos == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('manual_productos_<?php echo $contador_elementos; ?>_1', 'capa_manual_productos_<?php echo $contador_elementos; ?>_1', "capa_unicos_manual_productos_<?php echo $contador_elementos; ?>");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('manual_productos_<?php echo $contador_elementos; ?>_2', 'capa_manual_productos_<?php echo $contador_elementos; ?>_2', 'capa_unicos_manual_productos_<?php echo $contador_elementos; ?>')" id="capa_manual_productos_<?php echo $contador_elementos; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_manual_productos_<?php echo $contador_elementos; ?>">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_manual_productos_<?php echo $contador_elementos; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_manual_productos_<?php echo $contador_elementos; ?>">
                    &nbsp;
                </div>
                <div id="check_manual_productos_<?php echo $contador_elementos; ?>_2" class="hidden check_capa_unicos_manual_productos_<?php echo $contador_elementos; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="manual_productos[<?php echo $contador_elementos; ?>]" id="manual_productos_<?php echo $contador_elementos; ?>_2" value="0" class="hidden" />
                <?php
                if ($manual_productos != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('manual_productos_<?php echo $contador_elementos; ?>_2', 'capa_manual_productos_<?php echo $contador_elementos; ?>_2', "capa_unicos_manual_productos_<?php echo $contador_elementos; ?>");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
if($producto_venta_productos == 1) {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <label>Exclusivo para profesionales:</label>
            <div class="flex flex-wrap">
                <div onclick="activarElementoUnicoFicha('profesionales_productos_<?php echo $contador_elementos; ?>_1', 'capa_profesionales_productos_<?php echo $contador_elementos; ?>_1', 'capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>')" id="capa_profesionales_productos_<?php echo $contador_elementos; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>">
                    <div class="font-bold text-left mr-2">
                        Si
                    </div>
                    <div id="contracheck_profesionales_productos_<?php echo $contador_elementos; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>">
                        &nbsp;
                    </div>
                    <div id="check_profesionales_productos_<?php echo $contador_elementos; ?>_1" class="hidden check_capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="profesionales_productos[<?php echo $contador_elementos; ?>]" id="profesionales_productos_<?php echo $contador_elementos; ?>_1" value="1" class="hidden" />
                    <?php
                    if ($profesionales_productos == 1) {
                        ?>
                        <script type="text/javascript">
                            activarElementoUnicoFicha('profesionales_productos_<?php echo $contador_elementos; ?>_1', 'capa_profesionales_productos_<?php echo $contador_elementos; ?>_1', "capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>");
                        </script>
                        <?php
                    }
                    ?>
                </div>
                <div onclick="activarElementoUnicoFicha('profesionales_productos_<?php echo $contador_elementos; ?>_2', 'capa_profesionales_productos_<?php echo $contador_elementos; ?>_2', 'capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>')" id="capa_profesionales_productos_<?php echo $contador_elementos; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>">
                    <div class="font-bold text-left mr-2">
                        No
                    </div>
                    <div id="contracheck_profesionales_productos_<?php echo $contador_elementos; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>">
                        &nbsp;
                    </div>
                    <div id="check_profesionales_productos_<?php echo $contador_elementos; ?>_2" class="hidden check_capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="profesionales_productos[<?php echo $contador_elementos; ?>]" id="profesionales_productos_<?php echo $contador_elementos; ?>_2" value="0" class="hidden" />
                    <?php
                    if ($profesionales_productos != 1) {
                        ?>
                        <script type="text/javascript">
                            activarElementoUnicoFicha('profesionales_productos_<?php echo $contador_elementos; ?>_2', 'capa_profesionales_productos_<?php echo $contador_elementos; ?>_2', "capa_unicos_profesionales_productos_<?php echo $contador_elementos; ?>");
                        </script>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <label for="peso_productos">Peso:</label>
            <input type="number" class="w-full" name="peso_productos[<?php echo $contador_elementos; ?>]" id="peso_productos_<?php echo $contador_elementos; ?>" placeholder="Peso" value="<?php echo $peso_productos; ?>" />
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <label for="bultos_productos">Bultos:</label>
            <input type="number" class="w-full" name="bultos_productos[<?php echo $contador_elementos; ?>]" id="bultos_productos_<?php echo $contador_elementos; ?>" placeholder="Bultos" value="<?php echo $bultos_productos; ?>" />
        </div>
    </div>
    <?php
    if($aplicar_descuento_productos == 1) {
        $checked_activa_sys = " checked";
        $checked_inactiva_sys = "";
    }else {
        $checked_activa_sys = "";
        $checked_inactiva_sys = " checked";
    }
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <label>Aplicar descuentos:</label>
            <div class="flex flex-wrap">
                <div onclick="activarElementoUnicoFicha('aplicar_descuento_productos_<?php echo $contador_elementos; ?>_1', 'capa_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_1', 'capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>')" id="capa_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>">
                    <div class="font-bold text-left mr-2">
                        Si
                    </div>
                    <div id="contracheck_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>">
                        &nbsp;
                    </div>
                    <div id="check_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_1" class="hidden check_capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="aplicar_descuento_productos[<?php echo $contador_elementos; ?>]" id="aplicar_descuento_productos_<?php echo $contador_elementos; ?>_1" value="1" class="hidden" />
                    <?php
                    if ($aplicar_descuento_productos == 1) {
                        ?>
                        <script type="text/javascript">
                            activarElementoUnicoFicha('aplicar_descuento_productos_<?php echo $contador_elementos; ?>_1', 'capa_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_1', "capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>");
                        </script>
                        <?php
                    }
                    ?>
                </div>
                <div onclick="activarElementoUnicoFicha('aplicar_descuento_productos_<?php echo $contador_elementos; ?>_2', 'capa_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_2', 'capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>')" id="capa_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>">
                    <div class="font-bold text-left mr-2">
                        No
                    </div>
                    <div id="contracheck_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>">
                        &nbsp;
                    </div>
                    <div id="check_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_2" class="hidden check_capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="aplicar_descuento_productos[<?php echo $contador_elementos; ?>]" id="aplicar_descuento_productos_<?php echo $contador_elementos; ?>_2" value="0" class="hidden" />
                    <?php
                    if ($aplicar_descuento_productos != 1) {
                        ?>
                        <script type="text/javascript">
                            activarElementoUnicoFicha('aplicar_descuento_productos_<?php echo $contador_elementos; ?>_2', 'capa_aplicar_descuento_productos_<?php echo $contador_elementos; ?>_2', "capa_unicos_aplicar_descuento_productos_<?php echo $contador_elementos; ?>");
                        </script>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 mt-3 items-center space-x-3">
        <div>
            <label for="descuento_maximo_productos">Descuento máximo:</label>
            <input type="number" class="w-full" name="descuento_maximo_productos[<?php echo $contador_elementos; ?>]" id="descuento_maximo_productos_<?php echo $contador_elementos; ?>" placeholder="Descuento máximo" value="<?php echo $descuento_maximo_productos; ?>" />
        </div>
    </div>
    <?php
}else {
    // inputs hidden de los datos a transferir
    ?>
    <input type="hidden" name="profesionales_productos[<?php echo $contador_elementos; ?>]" id="profesionales_productos_<?php echo $contador_elementos; ?>" value="<?php echo $profesionales_productos; ?>" />
    <input type="hidden" name="peso_productos[<?php echo $contador_elementos; ?>]" id="peso_productos_<?php echo $contador_elementos; ?>" value="<?php echo $peso_productos; ?>" />
    <input type="hidden" name="bultos_productos[<?php echo $contador_elementos; ?>]" id="bultos_productos_<?php echo $contador_elementos; ?>" value="<?php echo $bultos_productos; ?>" />
    <input type="hidden" name="aplicar_descuento_productos[<?php echo $contador_elementos; ?>]" id="aplicar_descuento_productos_<?php echo $contador_elementos; ?>" value="<?php echo $aplicar_descuento_productos; ?>" />
    <input type="hidden" name="descuento_maximo_productos[<?php echo $contador_elementos; ?>]" id="descuento_maximo_productos_<?php echo $contador_elementos; ?>" value="<?php echo $descuento_maximo_productos; ?>" />
    <?php
}
?>
<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <input type="hidden" name="id_observaciones_productos[<?php echo $contador_elementos; ?>]" id="id_observaciones_productos_<?php echo $contador_elementos; ?>" value="<?php echo $id_observaciones_productos; ?>" />
    <div>
        <label>Observaciones:</label>
        <textarea name="observacion_productos[<?php echo $contador_elementos; ?>]" class="w-full" id="observacion_productos_<?php echo $contador_elementos; ?>"><?php echo $observacion_productos; ?></textarea>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
    <div class="text-left">Fecha modificación:</div>
    <div class="text-center"><?php echo $fecha_modificacion_productos; ?></div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div id="capa_guardar_update_<?php echo $contador_elementos; ?>" class="text-right">
        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarOtros('<?php echo $contador_elementos; ?>','<?php echo $id_url; ?>','<?php echo $id_productos_otros_datos; ?>','<?php echo $id_productos_detalles_enlazado_productos_otros; ?>','<?php echo $id_productos_detalles_multiples_productos_otros; ?>','<?php echo $id_packs_productos_otros; ?>');">Guardar</button>
    </div>
</div>

<?php
$contador_elementos += 1;