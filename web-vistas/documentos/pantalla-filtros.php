<?php
$labelLibrador = 'Cliente';
$labelLibradorPlural = 'Clientes';
if ($tipo_librador == 'pro') {
    $labelLibrador = 'Proveedor';
    $labelLibradorPlural = 'Proveedores';
} elseif ($tipo_librador == 'cre') {
    $labelLibrador = 'Creditor';
    $labelLibradorPlural = 'Creditores';
}
?>
<div class="flex">
    <div id="capa-fecha-hora-otros-documentos" class="grow p-4 grid grid-cols-12 items-center space-x-5">
        <div class="col-span-7 xl:col-span-5 flex flex-wrap space-x-1 items-center">
            <div>
                Desde
            </div>
            <input type="date" id="fecha-desde-otros-documento" value="<?php echo date('Y-m-d'); ?>" style="width: 130px; padding: 5px;" />
            <input type="time" id="hora-desde-otros-documento" value="00:00" style="width: 90px; padding: 5px;" />
            <div style="margin-left: 25px;">
                Hasta
            </div>
            <input type="date" id="fecha-hasta-otros-documento" value="<?php echo date('Y-m-d'); ?>" style="width: 130px; padding: 5px;" />
            <input type="time" id="hora-hasta-otros-documento" value="23:59" style="width: 90px; padding: 5px;" />
        </div>
        <div class="col-span-3 flex flex-wrap space-x-1 items-center">
            <select id="id-librador-otros-documento" name="id-librador-otros-documento" class="w-full" style="padding: 5px;">
                <option value="-1" selected>Todos los <?php echo $labelLibradorPlural; ?></option>
                <!-- <option value="-3">Nuevo take away</option> -->
                <?php
                $ultimoIdComedor = -1;
                foreach ($matriz_id_libradores_seleccionar as $key_id_libradores_seleccionar => $valor_id_libradores_seleccionar) {
                    if ($ultimoIdComedor != $matriz_id_comedores_libradores_seleccionar[$key_id_libradores_seleccionar])
                    {
                        if ($ultimoIdComedor != -1) {
                            ?>
                            </optgroup>
                            <?php
                        }
                        ?>
                        <optgroup label="<?php echo $matriz_descripcion_comedores_libradores_seleccionar[$key_id_libradores_seleccionar]; ?>">
                        <?php
                        $ultimoIdComedor = $matriz_id_comedores_libradores_seleccionar[$key_id_libradores_seleccionar];
                    }
                    ?>
                    <option value="<?php echo $valor_id_libradores_seleccionar; ?>"><?php echo $matriz_nombre_libradores_seleccionar[$key_id_libradores_seleccionar]; ?></option>
                    <?php
                }
                ?>
                </optgroup>
            </select>
        </div>
        <?php
        if(($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") && empty($numero_documento)) {
            $select_sys = "obtener_series";
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-documentos.php");
            if ($ids_serie) {
                ?>
                <div class="col-span-2 flex flex-wrap space-x-1 items-center">
                    <select id="serie-otros-documento" name="serie-otros-documento" class="w-full">
                        <option value="-2" selected>Todas las series</option>
                        <option value="-1">Sin serie</option>
                        <?php
                        foreach ($ids_serie as $key_serie => $id_serie) {
                            echo "<option value='".$series_serie[$key_serie]."'>".$series_serie[$key_serie]."</option>";
                        }
                        ?>
                    </select>
                </div>
                <?php
            }
        }
        ?>
        <div class="col-span-2 space-x-1 text-center">
            <a href="#" class="items-center inline-flex justify-center border border-transparent bg-gray-250 dark:bg-graydark-250 py-2 px-4 text-sm font-medium text-gray-650 dark:text-graydark-650 shadow-sm w-full" id="dropdownFiltros" data-dropdown-toggle="dropdownFiltrosMenu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"></path>
                </svg>
                &nbsp;Ver&nbsp;<span id="titulo-otros-documentos">&nbsp;</span>
            </a>
            <div id="dropdownFiltrosMenu" class="z-10 bg-white rounded divide-y divide-gray-100 shadow hidden" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1847px, 190px);">
                <div class="h-11 flex items-center">
                    <a href="#" onclick="actualizarOtrosDocumentos('capa-otros-documentos','global','fecha-hora','','últimos');" class="p-3">
                        <input type="checkbox" class="text-blendi-600 filtro_actualizar_documentos" id="pestana-titulo-fecha-hora-global-otros-documentos">
                        Últimos
                    </a>
                </div>
                <div class="h-11 flex items-center">
                    <a href="#" onclick="actualizarOtrosDocumentos('capa-otros-documentos','global','abiertos','','abiertos');" class="p-3">
                        <input type="checkbox" class="text-blendi-600 filtro_actualizar_documentos" id="pestana-titulo-abiertos-global-otros-documentos">
                        Abiertos
                    </a>
                </div>
                <div class="h-11 flex items-center">
                    <a href="#" onclick="actualizarOtrosDocumentos('capa-otros-documentos','global','fecha-hora-cierre-caja','', 'c. caja');" class="p-3">
                        <input type="checkbox" class="text-blendi-600 filtro_actualizar_documentos" id="pestana-titulo-fecha-hora-cierre-caja-global-otros-documentos">
                        Cierre caja
                    </a>
                </div>
                <?php
                if($id_librador_tak != 0) {
                    ?>
                    <div class="h-11 flex items-center">
                        <a href="#" onclick="actualizarOtrosDocumentos('capa-otros-documentos','recogidas','abiertos','','recogidas');" class="p-3">
                            <input type="checkbox" class="text-blendi-600 filtro_actualizar_documentos" id="pestana-titulo-abiertos-recogidas-otros-documentos">
                            Recogidas local
                        </a>
                    </div>
                    <?php
                }
                if($servicio_domicilio == 1) {
                    ?>
                    <div class="h-11 flex items-center">
                        <a href="#" onclick="actualizarOtrosDocumentos('capa-otros-documentos','entregas','abiertos','','entregas');" class="p-3">
                            <input type="checkbox" class="text-blendi-600 filtro_actualizar_documentos" id="pestana-titulo-abiertos-entregas-otros-documentos">
                            Entregas domicilio
                        </a>
                    </div>
                    <?php
                }
                if($existen_mesas) {
                    ?>
                    <div class="h-11 flex items-center">
                        <a href="#" onclick="actualizarOtrosDocumentos('capa-otros-documentos','local','abiertos','','local');" class="p-3">
                            <input type="checkbox" class="text-blendi-600 filtro_actualizar_documentos" id="pestana-titulo-abiertos-local-otros-documentos">
                            Local
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>