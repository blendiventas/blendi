<?php
$select_sys = "datos-web";
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

if(!isset($id_productos_web_datos)) {
    $id_productos_web_datos = 0;
}
if(!isset($id_productos_otros)) {
    $id_productos_otros = 0;
}
?>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3" id="linea_<?php echo $contador_elementos; ?>">
    <?php echo $descripcion_pack_datos_web; ?>
</div>
<input type="hidden" name="id_enlazado[<?php echo $contador_elementos; ?>]" id="id_enlazado_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_detalles_enlazado_productos_web; ?>" />
<input type="hidden" name="id_multiple[<?php echo $contador_elementos; ?>]" id="id_multiple_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_detalles_multiples_productos_web; ?>" />
<input type="hidden" name="id_pack[<?php echo $contador_elementos; ?>]" id="id_pack_<?php echo $contador_elementos; ?>" value="<?php echo $id_packs_productos_web; ?>" />
<input type="hidden" name="id_productos_web_datos[<?php echo $contador_elementos; ?>]" id="id_productos_web_datos_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_web_datos; ?>" />
<input type="hidden" name="id_productos_otros[<?php echo $contador_elementos; ?>]" id="id_productos_otros_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_otros; ?>" />
<div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
    <div>
        <label for="descripcion_larga_productos_<?php echo $contador_elementos; ?>">Descripción larga:</label><br>
        <input type="text" class="w-full" name="descripcion_larga_productos[<?php echo $contador_elementos; ?>]" id="descripcion_larga_productos_<?php echo $contador_elementos; ?>" placeholder="Descripción larga" maxlength="250" value="<?php echo $descripcion_larga_productos; ?>" />
    </div>
    <div>
        <label for="descripcion_url_productos_<?php echo $contador_elementos; ?>">Descripción URL:</label><br>
        <input type="text" class="w-full" name="descripcion_url_productos[<?php echo $contador_elementos; ?>]" id="descripcion_url_productos_<?php echo $contador_elementos; ?>" placeholder="Descripción URL" maxlength="100" value="<?php echo $descripcion_url_productos; ?>" required />
    </div>
</div>
<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <div>
        <label for="titulo_meta_productos_<?php echo $contador_elementos; ?>">Título meta:</label><br>
        <input type="text" class="w-full" name="titulo_meta_productos[<?php echo $contador_elementos; ?>]" id="titulo_meta_productos_<?php echo $contador_elementos; ?>" placeholder="Título meta" maxlength="60" value="<?php echo $titulo_meta_productos; ?>" required />
    </div>
</div>
<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <div>
        <label for="descripcion_meta_productos_<?php echo $contador_elementos; ?>">Descripción meta:</label><br>
        <input type="text" class="w-full" name="descripcion_meta_productos[<?php echo $contador_elementos; ?>]" id="descripcion_meta_productos_<?php echo $contador_elementos; ?>" placeholder="Descripción meta" maxlength="160" value="<?php echo $descripcion_meta_productos; ?>" required />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label>Mostrar en tienda online:</label><br>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('tienda_productos_<?php echo $contador_elementos; ?>_1', 'capa_tienda_productos_<?php echo $contador_elementos; ?>_1', 'capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>')" id="capa_tienda_productos_<?php echo $contador_elementos; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_tienda_productos_<?php echo $contador_elementos; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>">
                    &nbsp;
                </div>
                <div id="check_tienda_productos_<?php echo $contador_elementos; ?>_1" class="hidden check_capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="tienda_productos[<?php echo $contador_elementos; ?>]" id="tienda_productos_<?php echo $contador_elementos; ?>_1" value="1" class="hidden" />
                <?php
                if ($tienda_productos == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('tienda_productos_<?php echo $contador_elementos; ?>_1', 'capa_tienda_productos_<?php echo $contador_elementos; ?>_1', "capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('tienda_productos_<?php echo $contador_elementos; ?>_2', 'capa_tienda_productos_<?php echo $contador_elementos; ?>_2', 'capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>')" id="capa_tienda_productos_<?php echo $contador_elementos; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_tienda_productos_<?php echo $contador_elementos; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>">
                    &nbsp;
                </div>
                <div id="check_tienda_productos_<?php echo $contador_elementos; ?>_2" class="hidden check_capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="tienda_productos[<?php echo $contador_elementos; ?>]" id="tienda_productos_<?php echo $contador_elementos; ?>_2" value="0" class="hidden" />
                <?php
                if ($tienda_productos != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('tienda_productos_<?php echo $contador_elementos; ?>_2', 'capa_tienda_productos_<?php echo $contador_elementos; ?>_2', "capa_unicos_tienda_productos_<?php echo $contador_elementos; ?>");
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
        <label for="url_externa_productos_<?php echo $contador_elementos; ?>">URL externa:</label>
        <input type="text" name="url_externa_productos[<?php echo $contador_elementos; ?>]" id="url_externa_productos_<?php echo $contador_elementos; ?>" placeholder="URL externa" maxlength="200" value="<?php echo $url_externa_productos; ?>" />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="gastos_productos_<?php echo $contador_elementos; ?>">Gastos:</label><br>
        <input type="number" class="w-full" name="gastos_productos[<?php echo $contador_elementos; ?>]" id="gastos_productos_<?php echo $contador_elementos; ?>" placeholder="Gastos" value="<?php echo $gastos_productos; ?>" />
    </div>
    <div>
        <label>Envio gratis:</label><br>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('envio_gratis_productos_<?php echo $contador_elementos; ?>_1', 'capa_envio_gratis_productos_<?php echo $contador_elementos; ?>_1', 'capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>')" id="capa_envio_gratis_productos_<?php echo $contador_elementos; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_envio_gratis_productos_<?php echo $contador_elementos; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>">
                    &nbsp;
                </div>
                <div id="check_envio_gratis_productos_<?php echo $contador_elementos; ?>_1" class="hidden check_capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="envio_gratis_productos[<?php echo $contador_elementos; ?>]" id="envio_gratis_productos_<?php echo $contador_elementos; ?>_1" value="1" class="hidden" />
                <?php
                if ($envio_gratis_productos == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('envio_gratis_productos_<?php echo $contador_elementos; ?>_1', 'capa_envio_gratis_productos_<?php echo $contador_elementos; ?>_1', "capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('envio_gratis_productos_<?php echo $contador_elementos; ?>_2', 'capa_envio_gratis_productos_<?php echo $contador_elementos; ?>_2', 'capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>')" id="capa_envio_gratis_productos_<?php echo $contador_elementos; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_envio_gratis_productos_<?php echo $contador_elementos; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>">
                    &nbsp;
                </div>
                <div id="check_envio_gratis_productos_<?php echo $contador_elementos; ?>_2" class="hidden check_capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="envio_gratis_productos[<?php echo $contador_elementos; ?>]" id="envio_gratis_productos_<?php echo $contador_elementos; ?>_2" value="0" class="hidden" />
                <?php
                if ($envio_gratis_productos != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('envio_gratis_productos_<?php echo $contador_elementos; ?>_2', 'capa_envio_gratis_productos_<?php echo $contador_elementos; ?>_2', "capa_unicos_envio_gratis_productos_<?php echo $contador_elementos; ?>");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div>
        <label for="dias_entrega_productos_<?php echo $contador_elementos; ?>">Días entrega:</label><br>
        <input type="number" class="w-full" name="dias_entrega_productos[<?php echo $contador_elementos; ?>]" id="dias_entrega_productos_<?php echo $contador_elementos; ?>" placeholder="Días entrega" value="<?php echo $dias_entrega_productos; ?>" />
    </div>
</div>
    
<div id="capa_guardar_update_<?php echo $contador_elementos; ?>" class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="text-right">
        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarWeb('<?php echo $contador_elementos; ?>','<?php echo $id_url; ?>','<?php echo $id_productos_web_datos; ?>','<?php echo $id_productos_otros; ?>','<?php echo $id_productos_detalles_enlazado_productos_web; ?>','<?php echo $id_productos_detalles_multiples_productos_web; ?>','<?php echo $id_packs_productos_web; ?>');">Guardar</button>
    </div>
</div>
<?php
$contador_elementos += 1;
