<?php
$select_sys = 'listado-zonas';
require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_envio/gestion/datos-select-php.php");
$contadorMasAlto = 0;
?>
<input type="hidden" name="apartado" id="apartado" value="zonas" />
<input type="hidden" name="titulo_descripcion_0" id="titulo_descripcion_0" class="titulo_descripcion" value="Título" />
<input type="hidden" name="titulo_orden_0" id="titulo_orden_0" class="titulo_orden" value="10" />
<input type="hidden" name="titulo_tipo_0" id="titulo_tipo_0" class="titulo_tipo" value="3" />
<div class="flex flex-wrap space-x-2 items-center justify-end px-5">
    <?php
    if (empty($modalidades_envio_zonas_id)) {
        ?>
        <div class="pl-2 mt-2 text-center">
            Puedes determinar un precio por zona y marcar unos incrementos según el peso de los artículos comprados.
        </div>
        <?php
    }
    ?>
    <div class="pl-2 mt-2 text-center" id="capa_guardar_zona">
        <?php require($_SERVER['DOCUMENT_ROOT']."/admin/zonas/componentes/form-select.php"); ?>
    </div>
    <div class="pl-2 mt-7 text-center" id="capa_guardar_insert">
        <a href="#" class="items-center inline-flex justify-center border border-transparent bg-blendi-600 dark:bg-blendidark-600 py-2 px-4 text-sm font-medium text-white dark:text-black shadow-sm" onclick="guardarZona(0, <?php echo $id_url; ?>)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Nueva zona
        </a>
    </div>
</div>
<?php
foreach ($modalidades_envio_zonas_id as $modalidad_envio_zona_key => $modalidad_envio_zona_id) {
    ?>
    <div class="bg-gray-50 dark:bg-white dark:border-2 dark:border-black p-3 mt-3 mx-5">
        <div>
            Zona <?php echo $modalidades_envio_zonas_zona[$modalidad_envio_zona_key]; ?>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="incremento_pvp_<?php echo $modalidad_envio_zona_id; ?>">Incremento pvp:</label><br>
                <input type="text" name="modalidades_envio_zonas_incremento_pvp_<?php echo $modalidad_envio_zona_id; ?>" id="incremento_pvp_<?php echo $modalidad_envio_zona_id; ?>" class="modalidades_envio_zonas_incremento_pvp w-full" value="<?php echo $modalidades_envio_zonas_incremento_pvp[$modalidad_envio_zona_key]; ?>" />
            </div>
            <div>
                <label for="incremento_por_kilo_<?php echo $modalidad_envio_zona_id; ?>">Incremento por kilo:</label><br>
                <input type="text" name="modalidades_envio_zonas_incremento_por_kilo_<?php echo $modalidad_envio_zona_id; ?>" id="incremento_por_kilo_<?php echo $modalidad_envio_zona_id; ?>" class="modalidades_envio_zonas_incremento_por_kilo w-full" value="<?php echo $modalidades_envio_zonas_incremento_por_kilo[$modalidad_envio_zona_key]; ?>" />
            </div>
            <div>
                <label for="volumen_maximo_bulto_<?php echo $modalidad_envio_zona_id; ?>">Peso máximo bulto:</label><br>
                <input type="text" name="modalidades_envio_zonas_volumen_maximo_bulto_<?php echo $modalidad_envio_zona_id; ?>" id="volumen_maximo_bulto_<?php echo $modalidad_envio_zona_id; ?>" class="modalidades_envio_zonas_volumen_maximo_bulto w-full" value="<?php echo $modalidades_envio_zonas_volumen_maximo_bulto[$modalidad_envio_zona_key]; ?>" />
            </div>
        </div>
        <?php
        $select_sys = 'listado-zonas-franjas';
        require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_envio/gestion/datos-select-php.php");
        foreach ($modalidades_envio_zonas_franjas_id as $modalidades_envio_zonas_franja_key => $modalidades_envio_zonas_franja_id) {
            ?>
            <div class="flex flex-wrap mt-3 items-center space-x-3">
                <div class="grow">
                    <label>Incremento pvp:</label><br>
                    <input type="text" name="modalidades_envio_zonas_franja_incremento_pvp[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 modalidades_envio_zonas_franja_incremento_pvp_<?php echo $modalidad_envio_zona_id; ?>" value="<?php echo $modalidades_envio_zonas_franjas_incremento_pvp[$modalidades_envio_zonas_franja_key]; ?>" />
                </div>
                <div>
                    <label>Peso desde:</label><br>
                    <input type="text" name="modalidades_envio_zonas_franja_volumen_desde[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 modalidades_envio_zonas_franja_volumen_desde_<?php echo $modalidad_envio_zona_id; ?>" value="<?php echo $modalidades_envio_zonas_franjas_volumen_desde[$modalidades_envio_zonas_franja_key]; ?>" />
                </div>
                <div>
                    <label>Peso hasta:</label><br>
                    <input type="text" name="modalidades_envio_zonas_franja_volumen_hasta[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 modalidades_envio_zonas_franja_volumen_hasta_<?php echo $modalidad_envio_zona_id; ?>" value="<?php echo $modalidades_envio_zonas_franjas_volumen_hasta[$modalidades_envio_zonas_franja_key]; ?>" />
                </div>
                <div class="modalidades_envio_zonas_franja_eliminar_<?php echo $modalidad_envio_zona_id; ?>">
                    <a href="#" onclick="eliminarModalidadesEnvioZonasFranja(this, <?php echo $modalidad_envio_zona_id; ?>);">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php
        }
        $contadorMasAlto = ($modalidades_envio_zonas_franja_key + 2 > $contadorMasAlto)? $modalidades_envio_zonas_franja_key + 2 : $contadorMasAlto;
        ?>
        <div id="modalidades_envio_zonas_franja_nuevos_<?php echo $modalidad_envio_zona_id; ?>">
        </div>
        <div class="mt-3 w-full text-gray-100 text-left cursor-pointer">
            <a href="#" onclick="anadirModalidadesEnvioZonasFranja(<?php echo $modalidad_envio_zona_id; ?>, <?php echo $id_url; ?>);">
                Añadir opción
            </a>
        </div>
        <div class="flex flex-wrap mt-3 items-center space-x-3 hidden" id="titulo_relacionado_nuevo_<?php echo $modalidad_envio_zona_id; ?>">
            <div class="grow">
                <label>Incremento pvp:</label><br>
                <input type="text" name="modalidades_envio_zonas_franja_incremento_pvp[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 modalidades_envio_zonas_franja_incremento_pvp_<?php echo $modalidad_envio_zona_id; ?>" value="0" />
            </div>
            <div>
                <label>Peso desde:</label><br>
                <input type="text" name="modalidades_envio_zonas_franja_volumen_desde[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 modalidades_envio_zonas_franja_volumen_desde_<?php echo $modalidad_envio_zona_id; ?>" value="0" />
            </div>
            <div>
                <label>Peso hasta:</label><br>
                <input type="text" name="modalidades_envio_zonas_franja_volumen_hasta[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 modalidades_envio_zonas_franja_volumen_hasta_<?php echo $modalidad_envio_zona_id; ?>" value="0" />
            </div>
            <div class="modalidades_envio_zonas_franja_eliminar_<?php echo $modalidad_envio_zona_id; ?>">
                <a href="#" onclick="eliminarModalidadesEnvioZonasFranja(this, <?php echo $modalidad_envio_zona_id; ?>);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>
        <?php
        if (count($modalidades_envio_zonas_franjas_id) <= 0) {
            ?>
            <script type="text/javascript">
                anadirModalidadesEnvioZonasFranja(<?php echo $modalidad_envio_zona_id; ?>, <?php echo $id_url; ?>);
            </script>
            <?php
        }
        ?>
        <script type="text/javascript">
            mostrarEliminarModalidadesEnvioZonasFranja(<?php echo $modalidad_envio_zona_id; ?>);
        </script>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div id="capa_guardar_update_<?php echo $modalidad_envio_zona_id; ?>" class="flex space-x-2 justify-end">
                <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="eliminarModalidadEnvioZona(<?php echo $modalidad_envio_zona_id; ?>, <?php echo $id_url; ?>);">Eliminar</button>
                <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarZona(<?php echo $modalidad_envio_zona_id; ?>, <?php echo $id_url; ?>, <?php echo $modalidades_envio_zonas_id_zona[$modalidad_envio_zona_key]; ?>);">Guardar</button>
            </div>
        </div>
    </div>
    <?php
    unset($modalidades_envio_zonas_franjas_id);
    unset($modalidades_envio_zonas_franjas_id_modalidad_envio_zona);
    unset($modalidades_envio_zonas_franjas_incremento_pvp);
    unset($modalidades_envio_zonas_franjas_volumen_desde);
    unset($modalidades_envio_zonas_franjas_volumen_hasta);
}
unset($modalidades_envio_zonas_id);
unset($modalidades_envio_zonas_id_zona);
unset($modalidades_envio_zonas_zona);
unset($modalidades_envio_zonas_incremento_pvp);
unset($modalidades_envio_zonas_incremento_por_kilo);
unset($modalidades_envio_zonas_volumen_maximo_bulto);
?>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
