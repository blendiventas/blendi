<input type="hidden" name="tipo_producto_productos" id="tipo_producto_productos" value="<?php echo $tipo_producto_productos; ?>" />

<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <button class="w-full rounded items-center inline-flex justify-center border border-transparent bg-gray-450 py-2 px-4 text-sm font-medium text-white shadow-sm" type="button" onclick="document.getElementById('capa_resultados_busqueda').style.display = 'none'; document.getElementById('capa_boton_ocultar_resultados').style.display = 'none';">Ocultar resultados</button>
    <div class="text-center">
        Coincidencias de <?php echo $texto_buscar; ?> en <?php echo $buscar_por; ?>.
    </div>
</div>

<div class="grid grid-cols-12 items-center h-10 bg-gray-50 mt-3">
    <div class="px-3 col-span-6">
        Descripción
    </div>
    <div class="px-3 col-span-4">
        <?php
        echo $detalle_mostrar;
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
        $encontrado_existente = false;
        foreach ($matriz_id_producto_libradores_productos as $key_id_producto_libradores_productos => $id_producto_libradores_productos) {
            if ($valor_id_productos_encontrados == $id_producto_libradores_productos) {
                $encontrado_existente = true;
                break;
            }
        }
        if($encontrado_existente == false) {
            $contador_productos_encontrados += 1;
            ?>
            <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
                <div class="px-3 col-span-6 flex flex-wrap items-center">
                    <?php
                    $id_producto = $id_producto_productos_encontrados[$key_id_productos_encontrados];
                    $id_enlazado = 0;
                    $id_multiple = 0;
                    $id_pack = 0;
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/imagenes/componentes/mostrar-imagenes.php");
                    ?>
                    <div class="text-center font-bold ml-2">
                        <?php echo $descripciones_productos_encontrados[$key_id_productos_encontrados];
                        ?>
                    </div>
                </div>
                <div class="px-3 col-span-4">
                    <div class="items-center h-10 bg-white" id="encontrados_modelo_base_<?php echo $contador_productos_encontrados; ?>">
                        <input type="number" name="coste_importe_encontrados_<?php echo $contador_productos_encontrados; ?>" class="w-full h-9" id="coste_importe_encontrados_<?php echo $contador_productos_encontrados; ?>" placeholder="<?php echo $detalle_mostrar; ?>" value="" step="0.01" required />
                    </div>
                </div>
                <div id="capa_guardar_encontrados_<?php echo $contador_productos_encontrados; ?>" class="text-center px-3 col-span-2">
                    <button class="w-full rounded items-center inline-flex justify-center border border-transparent bg-gray-450 py-2 px-4 text-sm font-medium text-white shadow-sm" type="button" onclick="guardarCostesImportes('0','<?php echo $id_url; ?>','<?php echo $valor_id_productos_encontrados; ?>','coste_importe_encontrados_','<?php echo $contador_productos_encontrados; ?>');" id="guardar_coste_importe_encontrados_<?php echo $contador_productos_encontrados; ?>">Añadir</button><br />
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
