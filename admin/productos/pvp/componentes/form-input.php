<?php
$columnas_tarifas = 3;
if($mostrar_ofertas_sys == true) {
    $columnas_tarifas--;
}
if($mostrar_guardar == true) {
    $columnas_tarifas--;
}
?>
<div id="tarifas_pvp_inputs" class="grid grid-cols-1 sm:grid-cols-<?php echo $columnas_tarifas; ?> mt-3 items-end space-x-3">
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-select-php.php");

    foreach ($matriz_id_tarifas as $key_id_tarifas => $valor_id_tarifas) {
        $select_sys = "detalles-ficha-tarifa";
        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/pvp/gestion/datos-select-php.php");
        ?>
        <div>
            <div id="linea_<?php echo $contador_elementos; ?>" class="col-span-<?php echo $columnas_tarifas; ?>">
                <?php
                //echo "(-1-)";
                if(isset($descripcion_pack_datos_pvp)) {
                    echo $descripcion_pack_datos_pvp."<br />";
                }else if($mostrar_guardar == true && $select_sys_pvp == "detalles-enlazado-ficha-tarifa") {
                    echo "<strong>Unidad.</strong><br />";
                }
                echo "Tarifa ".$matriz_descripcion_tarifas[$key_id_tarifas];
                if($matriz_prioritaria_tarifas[$key_id_tarifas] == 1) {
                    echo " (tarifa prioritaria)";
                }
                ?>
            </div>
            <div>
                <?php
                if($mostrar_guardar == false) {
                    ?>
                    <input type="hidden" name="id_productos_pvp[]" id="id_productos_pvp_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_pvp; ?>" />
                    <input type="hidden" name="id_tarifas[]" id="id_tarifas_<?php echo $contador_elementos; ?>" value="<?php echo $valor_id_tarifas; ?>" />
                    <?php
                }
                if($mostrar_guardar == true && $select_sys_pvp == "detalles-enlazado-ficha-tarifa") {
                    $columnas_pvp_inputs = 1;
                }else if($mostrar_guardar == false) {
                    $columnas_pvp_inputs = 1;
                }else {
                    $columnas_pvp_inputs = 2;
                }
                ?>
                <div class="grid grid-cols-1 sm:grid-cols-<?php echo $columnas_pvp_inputs; ?> mt-3 items-center space-x-3">
                    <?php
                    if($mostrar_guardar == true) {
                        ?>
                        <div>
                            <?php
                            if($select_sys_pvp == "detalles-enlazado-ficha-tarifa") {
                                ?>
                                <label for="margen_productos_pvp_<?php echo $contador_elementos; ?>">% Margen:</label><br>
                                <?php
                            } else {
                                ?>
                                <label for="margen_productos_pvp_<?php echo $contador_elementos; ?>">% Margen sobre compras:</label><br>
                                <?php
                            }
                            ?>
                            <input type="number" name="margen_productos_pvp[]" id="margen_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="% Margen sobre compras" class="w-1/2" value="<?php echo $margen_productos_pvp; ?>" step="0.01" />
                        </div>
                        <?php
                    }
                    ?>
                    <div>
                        <label for="pvp_productos_pvp_<?php echo $contador_elementos; ?>">
                            <?php
                            if(isset($pvp_iva_incluido) && $pvp_iva_incluido == 0) {
                                ?>
                                Importe
                                <?php
                            } else {
                                ?>
                                PVP
                                <?php
                            }
                            ?>
                        </label><br>
                        <input type="number" name="pvp_productos_pvp[]" id="pvp_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="PVP" class="w-1/2" value="<?php echo $pvp_productos_pvp; ?>" step="0.01" required />
                    </div>
                </div>
            </div>
        </div>

        <?php
        if($mostrar_ofertas_sys == true) {
            $id_ofertas_productos_pvp = $matriz_id_ofertas_productos_pvp[$key];
            $select_sys = "oferta-de";
            require($_SERVER['DOCUMENT_ROOT']."/admin/ofertas/gestion/datos-select-php.php");
            ?>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <input type="hidden" name="id_ofertas_productos_pvp[]" value="<?php echo $id_ofertas_productos_pvp[$key]; ?>" />
                <div>
                    <label for="oferta_desde_productos_pvp_<?php echo $contador_elementos; ?>">Oferta desde:</label><br>
                    <input type="date" name="oferta_desde_productos_pvp[]" id="oferta_desde_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="Oferta desde" class="w-1/2" value="<?php echo $matriz_oferta_desde_productos_pvp[$key]; ?>" />
                </div>
                <div>
                    <label for="oferta_hasta_productos_pvp_<?php echo $contador_elementos; ?>">Oferta hasta:</label><br>
                    <input type="date" name="oferta_hasta_productos_pvp[]" id="oferta_hasta_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="Oferta hasta" class="w-1/2" value="<?php echo $matriz_oferta_hasta_productos_pvp[$key]; ?>" />
                </div>
                <div>
                    <label for="pvp_oferta_productos_pvp_<?php echo $contador_elementos; ?>">PVP:</label><br>
                    <input type="number" name="pvp_oferta_productos_pvp[]" id="pvp_oferta_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="PVP oferta" class="w-1/2" value="<?php echo $matriz_pvp_oferta_productos_pvp[$key]; ?>" step="0.01" required />
                </div>
            </div>
            <?php
            unset($descripcion_ofertas);
            unset($activo_ofertas);
        }

        if($mostrar_guardar == true) {
            ?>
            <div id="capa_guardar_update_<?php echo $contador_elementos; ?>" class="flex justify-end items-end">
                <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarPVP('<?php echo $contador_elementos; ?>','<?php echo $id_productos_pvp; ?>','<?php echo $id_producto_productos_pvp; ?>','<?php echo $id_productos_detalles_enlazado_productos_pvp; ?>','<?php echo $id_productos_detalles_multiples_productos_pvp; ?>','<?php echo $id_packs_productos_pvp; ?>','<?php echo $valor_id_tarifas; ?>','<?php echo $id_ofertas_productos_pvp; ?>');">Guardar</button>
            </div>
            <?php
        }

        unset($id_productos_pvp);
        unset($id_tarifa_productos_pvp);
        unset($margen_productos_pvp);
        unset($pvp_productos_pvp);
        unset($id_ofertas_productos_pvp);
        unset($oferta_desde_productos_pvp);
        unset($oferta_hasta_productos_pvp);
        unset($pvp_oferta_productos_pvp);

        $contador_elementos += 1;
        $descripcion_pack_datos_pvp = null;
    }
    unset($matriz_id_tarifas);
    unset($matriz_id_idioma_tarifas);
    unset($matriz_descripcion_tarifas);
    unset($matriz_prioritaria_tarifas);
    unset($matriz_activa_tarifas);
    unset($matriz_orden_tarifas);
    ?>
</div>
