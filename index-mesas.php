<style>
    .capa-mesa:hover {
        cursor: pointer;
    }
</style>
<script>
    (function() {
        let anchoScroll = '0';
        window.mostrarMesaLista = 'mesa';
    })();
</script>

<div class="bg-white text-black flex justify-center">
    <div class="px-0 mt-4 whitespace-nowrap overflow-x-auto flex grow space-x-3 items-center sm:justify-center">
        <?php
        $comedorActivo = null;
        foreach ($id_comedores as $key_comedores => $valor_comedores) {
            if ($principal_comedores[$key_comedores] == '1') {
                $comedorActivo = $valor_comedores;
            }
            ?>
            <div id="comedor_<?php echo $valor_comedores; ?>" class="titulo_comedor font-medium px-5 py-4 cursor-pointer <?php if ($principal_comedores[$key_comedores] == '1') { echo 'bg-blendi-35 '; } if ($key_comedores != 0) { echo 'ml-4'; } ?> mr-4" onclick="mostrarComedor('<?php echo $valor_comedores; ?>');"><?php echo $descripcion_comedores[$key_comedores]; ?></div>
            <?php
        }
        if($id_librador_tak != 0) {
            $valor_comedores += 1;
            ?>
            <div id="comedor_tak" class="titulo_comedor font-medium px-5 py-4 cursor-pointer mr-4" onclick="mostrarComedor('tak'); setCapaComedorListasHeight();">Recogida local</div>
            <?php
        }
        if($servicio_domicilio == 1) {
            $valor_comedores += 1;
            ?>
            <div id="comedor_del" class="titulo_comedor font-medium px-5 py-4 cursor-pointer mr-4" onclick="mostrarComedor('del'); setCapaComedorListasHeight();">Entrega domicilio</div>
            <?php
        }
        ?>
        <div class="grow">&nbsp;</div>
    </div>
</div>

<script type="application/javascript">
    (function () {
        if (typeof window.comedorActivo === 'undefined') {
            window.comedorActivo = 'comedor_<?php echo $comedorActivo; ?>';

            let elCapaComedor = document.getElementById('capa_comedor');
            let comedorActivoElemento = null;
            let comedorAActivar = null;
            swipedetect(elCapaComedor, function(swipedir){
                if (swipedir == 'left' || swipedir == 'right'){
                    comedorActivoElemento = document.getElementById(window.comedorActivo);
                    if (comedorActivoElemento) {
                        if (swipedir == 'left'){
                            comedorAActivar = comedorActivoElemento.nextElementSibling
                        }
                        if (swipedir == 'right'){
                            comedorAActivar = comedorActivoElemento.previousElementSibling
                        }
                        if (comedorAActivar) {
                            comedorAActivar.click();
                        }
                    }
                }
            })
        }
    })();
</script>

<div class="pt-4 pb-2 sm:px-6 lg:px-4 bg-blendi-35" id="capa-nuevos-tiquets">
    <div class="flex items-center mt-2">
        <div class="flex items-center grow">
            <?php
            if($interface == "tpv" && $id_usuario == 1) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-mesas" id="link_editar_distribucion_mesas" class="items-center inline-flex justify-center py-2 px-4 text-sm font-medium text-blendi-700 dark:text-black font-black" title="Editar distribución" target="_self">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    &nbsp;Editar distribución
                </a>
                <?php
            }
            ?>
            <button id="boton_nueva_recogida_local" class="hidden items-center inline-flex justify-center border border-transparent bg-blendi-600 dark:bg-blendidark-600 py-2 px-4 text-sm font-medium text-white dark:text-black shadow-sm hover:bg-blendi-700 dark:hover:bg-blendidark-700 focus:outline-none focus:ring-2 focus:ring-blendi-500 focus:ring-offset-2" onclick="takIni();">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                &nbsp;Recogida local
            </button>
            <button id="boton_nueva_entrega_domicilio" class="hidden items-center inline-flex justify-center border border-transparent bg-blendi-600 dark:bg-blendidark-600 py-2 px-4 text-sm font-medium text-white dark:text-black shadow-sm hover:bg-blendi-700 dark:hover:bg-blendidark-700 focus:outline-none focus:ring-2 focus:ring-blendi-500 focus:ring-offset-2" onclick="nuevaEntregaDomicilio();">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                &nbsp;Entrega domicilio
            </button>
        </div>
        <div class="flex items-center mr-4">
            <button id="boton_mapa" class="items-center inline-flex justify-center border border-2 border-gray-100 rounded-l bg-gray-50 py-2 px-4 text-sm font-bold text-black shadow-sm hover:bg-gray-200 dark:text-graydark-500" onclick="toogleMapaLista('mesa')">
                &nbsp;Mapa
            </button>
            <button id="boton_lista" class="items-center inline-flex justify-center border border-2 border-gray-100 rounded-r bg-white py-2 px-4 text-sm font-medium text-black shadow-sm hover:bg-gray-200 dark:text-graydark-500" onclick="toogleMapaLista('lista');">
                &nbsp;Lista
            </button>
        </div>
    </div>
</div>

<div class="mx-auto bg-blendi-35" style="overflow-x: auto; overflow-y: hidden;">
    <?php
    ?>
    <div class="display-block border border-2 border-blendi-600 dark:border-blendidark-600" id="capa-mesas-comedor" style="
            position: relative; width: 98%; left: 1%; height: <?php echo $alto_capa_mesas; ?>px; margin-top: 7px; padding: 1%;
            background-color: <?php echo ($darkMode)? '#686868' : '#FAFAFA'; ?>;
            background-size: 20px;
            ">
        <?php
        foreach ($matriz_id_mesas as $key_mesas => $valor_mesas) {
            $comensales_mesa = $matriz_comensales_mesas[$key_mesas];
            if($numero_comensales[$key_mesas] != -1) {
                $comensales_mesa = $numero_comensales[$key_mesas];
            }
            ?>
            <div id="capa-mesa<?php echo $key_mesas; ?>" data-id-comedor="<?php echo $matriz_id_comedores_mesas[$key_mesas]; ?>" class="capa-mesa" style="position: absolute; <?php if ($matriz_id_comedores_mesas[$key_mesas] != $comedorActivo) { echo 'display: none; '; } ?> top: <?php echo $matriz_alto_pos_mesas[$key_mesas]; ?>px; left: <?php echo $matriz_ancho_pos_mesas[$key_mesas]; ?>px; width: <?php echo $matriz_ancho_mesas[$key_mesas]; ?>px; height: <?php echo $matriz_alto_mesas[$key_mesas]; ?>px; min-height: 143px;" onclick="toggleModalMesas('<?php echo $valor_mesas; ?>','<?php echo $matriz_descripcion_mesas[$key_mesas]; ?>','<?php echo $comensales_mesa; ?>','<?php echo $id_documento_mesa[$key_mesas]; ?>', '<?php echo $ejercicio_documento_mesa[$key_mesas]; ?>', '<?php echo $id_librador_mesa[$key_mesas]; ?>', <?php echo $bloqueado_mesa[$key_mesas]; ?>)">
                <div class="bg-white shadow-md rounded-b text-gray-500" style="position: relative; display: inline-block; width: <?php echo $matriz_ancho_mesas[$key_mesas]; ?>px; height: <?php echo $matriz_alto_mesas[$key_mesas]; ?>px; min-height: 143px; <?php if ($matriz_radio_mesas[$key_mesas] == 50) {  echo 'border-top-left-radius: 50px; border-top-right-radius: 50px;'; } ?>">
                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-auto dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                        <?php echo $matriz_descripcion_mesas[$key_mesas]; ?>
                    </div>
                    <div class="text-center my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 10px; font-size: 18px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <?php echo $comensales_mesa; ?>
                    </div>
                    <div class="text-center my-2 mx-auto">
                        <?php
                        if ($color_mesa[$key_mesas] == '#FE0303') {
                            ?>
                            <div class="bg-cerise-200 text-center rounded-full p-1 mt-2 mx-auto text-cerise-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                Ocupada
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="bg-blendi-100 dark:bg-blendidark-100 text-center rounded-full p-1 mt-2 mx-auto text-blendi-500 dark:text-blendidark-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                Disponible
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="hidden sm:block"> &nbsp;-</span>
                    </div>
                    <?php
                    if ($color_mesa[$key_mesas] == '#FE0303') {
                        ?>
                        <div class="sm:flex border-t border-t-1">
                            <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                </svg>
                            </div>
                            <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="border-t border-t-1">
                            <div class="text-center mx-auto p-2 sm:grid sm:grid-cols-5 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                </svg>
                                <div class="col-span-4 hidden sm:block">
                                    Abrir
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        foreach ($matriz_id_lineas as $key_lineas => $valor_lineas) {
            ?>
            <div id="capa-linea<?php echo $key_lineas; ?>" class="capa-linea" data-id-comedor="<?php echo $matriz_id_comedores_lineas[$key_lineas]; ?>"  style="position: absolute; <?php if ($matriz_id_comedores_lineas[$key_lineas] != $comedorActivo) { echo 'display: none; '; } ?> <?php if ($matriz_alto_pos_lineas[$key_lineas] <= 0) { echo 'top: -2px;'; } else { echo 'top: ' . $matriz_alto_pos_lineas[$key_lineas] . 'px;'; } ?> left: <?php echo $matriz_ancho_pos_lineas[$key_lineas]; ?>px; width: <?php echo $matriz_ancho_lineas[$key_lineas]; ?>px; height: <?php echo $matriz_alto_lineas[$key_lineas]; ?>px;">
                <div class="bg-blendi-35 border border-2 border-blendi-600" style="position: relative; display: inline-block; width: <?php echo $matriz_ancho_lineas[$key_lineas]; ?>px; height: <?php echo $matriz_alto_lineas[$key_lineas]; ?>px; <?php if ($matriz_alto_pos_lineas[$key_lineas] <= 0) { echo 'border-top: 0;'; } ?>">
                    &nbsp;
                </div>
            </div>
            <?php
        }
        ?>
        <script type="text/javascript">
            <?php
            foreach ($matriz_id_mesas as $key_mesas => $valor_mesas) {
                ?>
                calcularMesaSegunAnchoPantalla('capa-mesa<?php echo $key_mesas; ?>', <?php echo $matriz_ancho_pos_mesas[$key_mesas]; ?>, <?php echo $matriz_ancho_mesas[$key_mesas]; ?>, <?php echo $ancho_capa_mesas; ?>);
                <?php
            }
            foreach ($matriz_id_lineas as $key_lineas => $valor_lineas) {
                ?>
                calcularMesaSegunAnchoPantalla('capa-linea<?php echo $key_lineas; ?>', <?php echo $matriz_ancho_pos_lineas[$key_lineas]; ?>, <?php echo $matriz_ancho_lineas[$key_lineas]; ?>, <?php echo $ancho_capa_mesas; ?>);
                <?php
            }
            ?>
        </script>
    </div>
    <!-- LISTA INICIO -->
    <div class="mx-5 mt-2 h-max hidden" id="capa-mesas-lista">
        <div class="block sm:grid sm:grid-cols-2 sm:gap-6">
            <div class="mb-3 bg-blendigreen-500 text-blendigreen-900 font-bold text-center hidden sm:block">
                Disponible
            </div>
            <div class="mb-3 bg-cerise-200 text-cerise-500 font-bold text-center hidden sm:block">
                Ocupada
            </div>
        </div>
        <div class="block sm:grid sm:grid-cols-2 sm:gap-6">
            <div class="mb-3 bg-blendigreen-500 text-blendigreen-900 font-bold text-center block sm:hidden">
                Disponible
            </div>
            <div class="mb-3 font-light text-gray-500 bg-blendigreen-500 overflow-y-auto capa-lista-grupo">
                <?php
                foreach ($matriz_id_mesas as $key_mesas => $valor_mesas) {
                    if ($color_mesa[$key_mesas] != '#FE0303') {
                        $comensales_mesa = $matriz_comensales_mesas[$key_mesas];
                        if($numero_comensales[$key_mesas] != -1) {
                            $comensales_mesa = $numero_comensales[$key_mesas];
                        }
                        ?>
                        <div id="capa-lista<?php echo $key_mesas; ?>" class="capa-lista py-2 px-4 w-full font-medium text-left text-white cursor-pointer" data-id-comedor="<?php echo $matriz_id_comedores_mesas[$key_mesas]; ?>" <?php if ($matriz_id_comedores_mesas[$key_mesas] != $comedorActivo) { echo 'style="display: none;"'; } ?> onclick="toggleModalMesas('<?php echo $valor_mesas; ?>','<?php echo $matriz_descripcion_mesas[$key_mesas]; ?>','<?php echo $comensales_mesa; ?>','<?php echo $id_documento_mesa[$key_mesas]; ?>', '<?php echo $ejercicio_documento_mesa[$key_mesas]; ?>', '<?php echo $id_librador_mesa[$key_mesas]; ?>', <?php echo $bloqueado_mesa[$key_mesas]; ?>)">
                            <div class="bg-white shadow-md rounded-b text-gray-500">
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                        <?php echo $matriz_descripcion_mesas[$key_mesas]; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 flex items-center font-black" style="width: fit-content; line-height: 10px; font-size: 18px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        <?php echo $comensales_mesa; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 grow">
                                        <div class="bg-blendi-100 dark:bg-blendidark-100 text-center rounded-full p-1 mt-2 mx-auto text-blendi-500 dark:text-blendidark-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                            Disponible
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="hidden sm:block"> &nbsp;-</span>
                                </div>
                                <div class="border-t border-t-1">
                                    <div class="text-center mx-auto p-2 sm:grid sm:grid-cols-5 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                        </svg>
                                        <div class="col-span-4 hidden sm:block">
                                            Abrir
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="mb-3 bg-cerise-200 text-cerise-500 font-bold text-center block sm:hidden">
                Ocupada
            </div>
            <div class="mb-3 font-light bg-cerise-200 text-gray-500 overflow-y-auto capa-lista-grupo">
                <?php
                foreach ($matriz_id_mesas as $key_mesas => $valor_mesas) {
                    if ($color_mesa[$key_mesas] == '#FE0303') {
                        $comensales_mesa = $matriz_comensales_mesas[$key_mesas];
                        if($numero_comensales[$key_mesas] != -1) {
                            $comensales_mesa = $numero_comensales[$key_mesas];
                        }
                        ?>
                        <div id="capa-lista<?php echo $key_mesas; ?>" class="capa-lista py-2 px-4 w-full font-medium text-left text-white cursor-pointer" data-id-comedor="<?php echo $matriz_id_comedores_mesas[$key_mesas]; ?>" <?php if ($matriz_id_comedores_mesas[$key_mesas] != $comedorActivo) { echo 'style="display: none;"'; } ?> onclick="toggleModalMesas('<?php echo $valor_mesas; ?>','<?php echo $matriz_descripcion_mesas[$key_mesas]; ?>','<?php echo $comensales_mesa; ?>','<?php echo $id_documento_mesa[$key_mesas]; ?>', '<?php echo $ejercicio_documento_mesa[$key_mesas]; ?>', '<?php echo $id_librador_mesa[$key_mesas]; ?>', <?php echo $bloqueado_mesa[$key_mesas]; ?>)">
                            <div class="bg-white shadow-md rounded-b text-gray-500">
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                        <?php echo $matriz_descripcion_mesas[$key_mesas]; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 flex items-center font-black" style="width: fit-content; line-height: 10px; font-size: 18px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        <?php echo $comensales_mesa; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 grow">
                                        <div class="bg-cerise-200 text-center rounded-full p-1 mt-2 mx-auto text-cerise-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                            Ocupada
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="hidden sm:block"> &nbsp;-</span>
                                </div>
                                <div class="sm:flex border-t border-t-1">
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                        </svg>
                                    </div>
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- LISTA FINAL -->
    <?php
    if($id_librador_tak != 0) {
        $apartado = 'recogidas';
        $select_sys = "abiertos";
        $fecha_desde = new DateTime();
        $fecha_desde->modify('-1 day');
        $fecha_desde = $fecha_desde->format('Y-m-d');
        require("web-gestion/datos-otros-documentos.php");
        ?>
        <!-- RECOGIDA LOCAL -->
        <div class="mx-5 mt-2 h-max hidden" id="capa-mesas-recogida-local">
            <div class="block sm:grid sm:grid-cols-<?php echo (isset($m_cocina) && !empty($m_cocina))? '4' : '3'; ?> sm:gap-6">
                <div class="mb-3 bg-blendirecibido-500 text-blendirecibido-900 font-bold text-center hidden sm:block">
                    Recibidos
                </div>
                <?php
                if (isset($m_cocina) && !empty($m_cocina)) {
                    ?>
                    <div class="mb-3 bg-cerise-200 text-cerise-500 font-bold text-center hidden sm:block">
                        Cocinándose
                    </div>
                    <?php
                }
                ?>
                <div class="mb-3 font-bold text-center hidden sm:block" style="background-color: #A4DBFF; color: #2F80ED;">
                    Preparado
                </div>
                <div class="mb-3 font-bold text-center hidden sm:block" style="background-color: #ACD988; color: #219653;">
                    Entregado
                </div>
            </div>
            <div class="block sm:grid sm:grid-cols-<?php echo (isset($m_cocina) && !empty($m_cocina))? '4' : '3'; ?> sm:gap-6">
                <div class="mb-3 bg-blendirecibido-500 text-blendirecibido-900 font-bold text-center block sm:hidden">
                    Recibidos
                </div>
                <div class="mb-3 font-light text-gray-500 bg-blendirecibido-500 overflow-y-auto capa-lista-grupo">
                    <?php
                    /*
                    'resultados' => $resultados,
                    'mostrar' => '',
                    'ejercicios_documentos_1' => $ejercicios_documentos_1,
                    'id_documento' => $id_documentos_1,
                    'id_librador' => $id_librador_documentos_1,
                    'librador_activo' => $librador_activo,
                    'librador' => $librador_documentos_1,
                    'fecha_documento' => $fecha_documento_documentos_1,
                    'numero_documento' => $numero_documento_documentos_1,
                    'serie_documento' => $serie_documento_documentos_1,
                    'total' => $total_documentos_1,
                    'estado' => $estado_documentos_1,
                    'id_usuario' => $id_usuario_documentos_1,
                    'hora' => $hora_documentos_1,
                    'observacion_documento' => $observacion_documentos_1

                    abrirDocumento('10575', '2022', '191');
                    abrirDocumento(id_documento[bucle], ejercicios_documentos_1[bucle], id_librador[bucle]);
                    */
                    foreach ($id_documentos_1 as $key_mesas => $valor_mesas) {
                        ?>
                        <div id="capa-recogida-local<?php echo $key_mesas; ?>" class="capa-recogida-local py-2 px-4 w-full font-medium text-left text-white bg-blendirecibido-500 cursor-pointer" onclick="abrirDocumento('<?php echo $valor_mesas; ?>', '<?php echo $ejercicios_documentos_1[$key_mesas]; ?>', '<?php echo $id_librador_documentos_1[$key_mesas]; ?>');">
                            <div class="bg-white shadow-md rounded-b text-gray-500">
                                <?php
                                /*
                                echo 'id_librador_documentos_1: '.$id_librador_documentos_1[$key_mesas].'<br />';
                                echo 'librador_activo: '.$librador_activo[$key_mesas].'<br />';
                                echo 'librador_documentos_1: '.$librador_documentos_1[$key_mesas].'<br />';
                                echo 'fecha_documento_documentos_1: '.$fecha_documento_documentos_1[$key_mesas].'<br />';
                                echo 'numero_documento_documentos_1: '.$numero_documento_documentos_1[$key_mesas].'<br />';
                                echo 'serie_documento_documentos_1: '.$serie_documento_documentos_1[$key_mesas].'<br />';
                                echo 'total_documentos_1: '.$total_documentos_1[$key_mesas].'<br />';
                                echo 'estado_documentos_1: '.$estado_documentos_1[$key_mesas].'<br />';
                                echo 'id_usuario_documentos_1: '.$id_usuario_documentos_1[$key_mesas].'<br />';
                                echo 'hora_documentos_1: '.$hora_documentos_1[$key_mesas].'<br />';
                                echo 'observacion_documentos_1: '.$observacion_documentos_1[$key_mesas].'<br />';
                                */
                                ?>
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                        <?php echo $librador_documentos_1[$key_mesas]; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 grow">
                                        <div class="bg-blendirecibido-200 text-center rounded-full p-1 mt-2 mx-auto text-blendirecibido-900" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                            Recibido
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="hidden sm:block"> &nbsp;-&nbsp;<?php echo $hora_documentos_1[$key_mesas]; ?></span>
                                </div>
                                <div class="sm:flex border-t border-t-1">
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                        </svg>
                                    </div>
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                if (isset($m_cocina) && !empty($m_cocina)) {
                    ?>
                    <div class="mb-3 bg-cerise-200 text-cerise-500 font-bold text-center block sm:hidden">
                        Cocinándose
                    </div>
                    <div class="mb-3 font-light text-gray-500 bg-cerise-200 overflow-y-auto capa-lista-grupo">
                        <?php
                        foreach ($id_documentos_1_cocinandose as $key_mesas => $valor_mesas) {
                            ?>
                            <div id="capa-recogida-local<?php echo $key_mesas; ?>" class="capa-recogida-local py-2 px-4 w-full font-medium text-left text-white bg-cerise-200 cursor-pointer" onclick="abrirDocumento('<?php echo $valor_mesas; ?>', '<?php echo $ejercicios_documentos_1_cocinandose[$key_mesas]; ?>', '<?php echo $id_librador_cocinandose[$key_mesas]; ?>');">
                                <div class="bg-white shadow-md rounded-b text-gray-500">
                                    <div class="flex items-center justify-center">
                                        <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                            <?php echo $librador_documentos_1_cocinandose[$key_mesas]; ?>
                                        </div>
                                        <div class="text-center my-2 mx-3 grow">
                                            <div class="bg-cerise-200 text-center rounded-full p-1 mt-2 mx-auto text-cerise-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                                Cocinándose
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="hidden sm:block"> &nbsp;-&nbsp;<?php echo $hora_documentos_1_cocinandose[$key_mesas]; ?></span>
                                    </div>
                                    <div class="sm:flex border-t border-t-1">
                                        <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                            </svg>
                                        </div>
                                        <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                            </svg>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="mb-3 text-cerise-500 font-bold text-center block sm:hidden" style="background-color: #A4DBFF; color: #2F80ED;">
                    Preparado
                </div>
                <div class="mb-3 font-light text-gray-500 overflow-y-auto capa-lista-grupo" style="background-color: #A4DBFF; color: #2F80ED;">
                    <?php
                    foreach ($id_documentos_1_pendiente_pago as $key_mesas => $valor_mesas) {
                        ?>
                        <div id="capa-recogida-local<?php echo $key_mesas; ?>" class="capa-recogida-local py-2 px-4 w-full font-medium text-left text-white bg-cerise-200 cursor-pointer" onclick="abrirDocumento('<?php echo $valor_mesas; ?>', '<?php echo $ejercicios_documentos_1_pendiente_pago[$key_mesas]; ?>', '<?php echo $id_librador_pendiente_pago[$key_mesas]; ?>');">
                            <div class="bg-white shadow-md rounded-b text-gray-500">
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                        <?php echo $librador_documentos_1_pendiente_pago[$key_mesas]; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 grow">
                                        <div class="text-center rounded-full p-1 mt-2 mx-auto text-cerise-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; background-color: #A4DBFF; color: #2F80ED;">
                                            Preparado
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="hidden sm:block"> &nbsp;-&nbsp;<?php echo $hora_documentos_1_pendiente_pago[$key_mesas]; ?></span>
                                </div>
                                <div class="sm:flex border-t border-t-1">
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                        </svg>
                                    </div>
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="mb-3 font-bold text-center block sm:hidden" style="background-color: #ACD988; color: #219653;">
                    Entregado
                </div>
                <div class="mb-3 font-light text-gray-500 overflow-y-auto capa-lista-grupo" style="background-color: #ACD988; color: #219653;">
                    <?php
                    foreach ($id_documentos_1_entregado as $key_mesas => $valor_mesas) {
                        ?>
                        <div id="capa-recogida-local<?php echo $key_mesas; ?>" class="capa-recogida-local py-2 px-4 w-full font-medium text-left text-white cursor-pointer" onclick="abrirDocumento('<?php echo $valor_mesas; ?>', '<?php echo $ejercicios_documentos_1_entregado[$key_mesas]; ?>', '<?php echo $id_librador_entregado[$key_mesas]; ?>');">
                            <div class="bg-white shadow-md rounded-b text-gray-500">
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                        <?php echo $librador_documentos_1_entregado[$key_mesas]; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 grow">
                                        <div class="text-center rounded-full p-1 mt-2 mx-auto text-cerise-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; background-color: #ACD988; color: #219653;">
                                            Entregado
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="hidden sm:block"> &nbsp;-&nbsp;<?php echo $hora_documentos_1_entregado[$key_mesas]; ?></span>
                                </div>
                                <div class="sm:flex border-t border-t-1">
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                        </svg>
                                    </div>
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        unset($resultados);
        unset($ejercicios_documentos_1);
        unset($id_documentos_1);
        unset($id_librador_documentos_1);
        unset($librador_activo);
        unset($librador_documentos_1);
        unset($fecha_documento_documentos_1);
        unset($numero_documento_documentos_1);
        unset($serie_documento_documentos_1);
        unset($total_documentos_1);
        unset($estado_documentos_1);
        unset($id_usuario_documentos_1);
        unset($hora_documentos_1);
        unset($observacion_documentos_1);
        unset($ejercicios_documentos_1_cocinandose);
        unset($id_documentos_1_cocinandose);
        unset($id_librador_documentos_1_cocinandose);
        unset($librador_activ_cocinandoseo);
        unset($librador_documentos_1_cocinandose);
        unset($fecha_documento_documentos_1_cocinandose);
        unset($numero_documento_documentos_1_cocinandose);
        unset($serie_documento_documentos_1_cocinandose);
        unset($total_documentos_1_cocinandose);
        unset($estado_documentos_1_cocinandose);
        unset($id_usuario_documentos_1_cocinandose);
        unset($hora_documentos_1_cocinandose);
        unset($observacion_documentos_1_cocinandose);
        unset($ejercicios_documentos_1_pendiente_pago);
        unset($id_documentos_1_pendiente_pago);
        unset($id_librador_documentos_1_pendiente_pago);
        unset($librador_activ_pendiente_pagoo);
        unset($librador_documentos_1_pendiente_pago);
        unset($fecha_documento_documentos_1_pendiente_pago);
        unset($numero_documento_documentos_1_pendiente_pago);
        unset($serie_documento_documentos_1_pendiente_pago);
        unset($total_documentos_1_pendiente_pago);
        unset($estado_documentos_1_pendiente_pago);
        unset($id_usuario_documentos_1_pendiente_pago);
        unset($hora_documentos_1_pendiente_pago);
        unset($observacion_documentos_1_pendiente_pago);
        unset($ejercicios_documentos_1_entregado);
        unset($id_documentos_1_entregado);
        unset($id_librador_documentos_1_entregado);
        unset($librador_activ_entregadoo);
        unset($librador_documentos_1_entregado);
        unset($fecha_documento_documentos_1_entregado);
        unset($numero_documento_documentos_1_entregado);
        unset($serie_documento_documentos_1_entregado);
        unset($total_documentos_1_entregado);
        unset($estado_documentos_1_entregado);
        unset($id_usuario_documentos_1_entregado);
        unset($hora_documentos_1_entregado);
        unset($observacion_documentos_1_entregado);
    }
    if($servicio_domicilio == 1) {
        $apartado = 'entregas';
        $select_sys = "abiertos";
        $fecha_desde = new DateTime();
        $fecha_desde->modify('-1 day');
        $fecha_desde = $fecha_desde->format('Y-m-d');
        require("web-gestion/datos-otros-documentos.php");
        ?>
        <!-- ENTREGA DOMICILIO -->
        <div class="mx-5 mt-2 h-max hidden" id="capa-mesas-entrega-domicilio">
            <div class="block sm:grid sm:grid-cols-<?php echo (isset($m_cocina) && !empty($m_cocina))? '4' : '3'; ?> sm:gap-6">
                <div class="mb-3 bg-blendirecibido-500 text-blendirecibido-900 font-bold text-center hidden sm:block">
                    Recibidos
                </div>
                <?php
                if (isset($m_cocina) && !empty($m_cocina)) {
                    ?>
                    <div class="mb-3 bg-cerise-200 text-cerise-500 font-bold text-center hidden sm:block">
                        Cocinándose
                    </div>
                    <?php
                }
                ?>
                <div class="mb-3 font-bold text-center hidden sm:block" style="background-color: #A4DBFF; color: #2F80ED;">
                    En reparto
                </div>
                <div class="mb-3 font-bold text-center hidden sm:block" style="background-color: #ACD988; color: #219653;">
                    Entregado
                </div>
            </div>
            <div class="block sm:grid sm:grid-cols-<?php echo (isset($m_cocina) && !empty($m_cocina))? '4' : '3'; ?> sm:gap-6">
                <div class="mb-3 bg-blendirecibido-500 text-blendirecibido-900 font-bold text-center block sm:hidden">
                    Recibidos
                </div>
                <div class="mb-3 font-light text-gray-500 bg-blendirecibido-500 overflow-y-auto capa-lista-grupo">
                    <?php
                    foreach ($id_documentos_1 as $key_mesas => $valor_mesas) {
                        ?>
                        <div id="capa-recogida-local<?php echo $key_mesas; ?>" class="capa-recogida-local py-2 px-4 w-full font-medium text-left text-white bg-blendirecibido-500 cursor-pointer" onclick="abrirDocumento('<?php echo $valor_mesas; ?>', '<?php echo $ejercicios_documentos_1[$key_mesas]; ?>', '<?php echo $id_librador[$key_mesas]; ?>');">
                            <div class="bg-white shadow-md rounded-b text-gray-500">
                                <?php
                                /*
                                echo 'id_librador_documentos_1: '.$id_librador_documentos_1[$key_mesas].'<br />';
                                echo 'librador_activo: '.$librador_activo[$key_mesas].'<br />';
                                echo 'librador_documentos_1: '.$librador_documentos_1[$key_mesas].'<br />';
                                echo 'fecha_documento_documentos_1: '.$fecha_documento_documentos_1[$key_mesas].'<br />';
                                echo 'numero_documento_documentos_1: '.$numero_documento_documentos_1[$key_mesas].'<br />';
                                echo 'serie_documento_documentos_1: '.$serie_documento_documentos_1[$key_mesas].'<br />';
                                echo 'total_documentos_1: '.$total_documentos_1[$key_mesas].'<br />';
                                echo 'estado_documentos_1: '.$estado_documentos_1[$key_mesas].'<br />';
                                echo 'id_usuario_documentos_1: '.$id_usuario_documentos_1[$key_mesas].'<br />';
                                echo 'hora_documentos_1: '.$hora_documentos_1[$key_mesas].'<br />';
                                echo 'observacion_documentos_1: '.$observacion_documentos_1[$key_mesas].'<br />';
                                */
                                ?>
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                        <?php echo $librador_documentos_1[$key_mesas]; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 grow">
                                        <div class="bg-blendirecibido-200 text-center rounded-full p-1 mt-2 mx-auto text-blendirecibido-900" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                            Recibido
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="hidden sm:block"> &nbsp;-&nbsp;<?php echo $hora_documentos_1[$key_mesas]; ?></span>
                                </div>
                                <div class="sm:flex border-t border-t-1">
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                        </svg>
                                    </div>
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                if (isset($m_cocina) && !empty($m_cocina)) {
                    ?>
                    <div class="mb-3 bg-cerise-200 text-cerise-500 font-bold text-center block sm:hidden">
                        Cocinándose
                    </div>
                    <div class="mb-3 font-light text-gray-500 bg-cerise-200 dark:text-gray-400 h-full overflow-y-auto capa-lista-grupo">
                        <?php
                        foreach ($id_documentos_1_cocinandose as $key_mesas => $valor_mesas) {
                            ?>
                            <div id="capa-recogida-local<?php echo $key_mesas; ?>" class="capa-recogida-local py-2 px-4 w-full font-medium text-left text-white bg-cerise-200 cursor-pointer" onclick="abrirDocumento('<?php echo $valor_mesas; ?>', '<?php echo $ejercicios_documentos_1_cocinandose[$key_mesas]; ?>', '<?php echo $id_librador_cocinandose[$key_mesas]; ?>');">
                                <div class="bg-white shadow-md rounded-b text-gray-500">
                                    <div class="flex items-center justify-center">
                                        <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                            <?php echo $librador_documentos_1_cocinandose[$key_mesas]; ?>
                                        </div>
                                        <div class="text-center my-2 mx-3 grow">
                                            <div class="bg-cerise-200 text-center rounded-full p-1 mt-2 mx-auto text-cerise-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                                Cocinándose
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="hidden sm:block"> &nbsp;-&nbsp;<?php echo $hora_documentos_1_cocinandose[$key_mesas]; ?></span>
                                    </div>
                                    <div class="sm:flex border-t border-t-1">
                                        <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                            </svg>
                                        </div>
                                        <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                            </svg>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="mb-3 text-cerise-500 font-bold text-center block sm:hidden" style="background-color: #A4DBFF; color: #2F80ED;">
                    En reparto
                </div>
                <div class="mb-3 font-light text-gray-500  overflow-y-auto capa-lista-grupo" style="background-color: #A4DBFF; color: #2F80ED;">
                    <?php
                    foreach ($id_documentos_1_pendiente_pago as $key_mesas => $valor_mesas) {
                        ?>
                        <div id="capa-recogida-local<?php echo $key_mesas; ?>" class="capa-recogida-local py-2 px-4 w-full font-medium text-left text-white cursor-pointer" onclick="abrirDocumento('<?php echo $valor_mesas; ?>', '<?php echo $ejercicios_documentos_1_pendiente_pago[$key_mesas]; ?>', '<?php echo $id_librador_pendiente_pago[$key_mesas]; ?>');">
                            <div class="bg-white shadow-md rounded-b text-gray-500">
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                        <?php echo $librador_documentos_1_pendiente_pago[$key_mesas]; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 grow">
                                        <div class="text-center rounded-full p-1 mt-2 mx-auto " style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; background-color: #A4DBFF; color: #2F80ED;">
                                            En reparto
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="hidden sm:block"> &nbsp;-&nbsp;<?php echo $hora_documentos_1_pendiente_pago[$key_mesas]; ?></span>
                                </div>
                                <div class="sm:flex border-t border-t-1">
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                        </svg>
                                    </div>
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="mb-3 font-bold text-center block sm:hidden" style="background-color: #ACD988; color: #219653;">
                    Entregado
                </div>
                <div class="mb-3 font-light text-gray-500 overflow-y-auto capa-lista-grupo" style="background-color: #ACD988; color: #219653;">
                    <?php
                    foreach ($id_documentos_1_entregado as $key_mesas => $valor_mesas) {
                        ?>
                        <div id="capa-recogida-local<?php echo $key_mesas; ?>" class="capa-recogida-local py-2 px-4 w-full font-medium text-left text-white cursor-pointer" onclick="abrirDocumento('<?php echo $valor_mesas; ?>', '<?php echo $ejercicios_documentos_1_entregado[$key_mesas]; ?>', '<?php echo $id_librador_entregado[$key_mesas]; ?>');">
                            <div class="bg-white shadow-md rounded-b text-gray-500">
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-3 h-7 dark:text-graydark-500" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                        <?php echo $librador_documentos_1_entregado[$key_mesas]; ?>
                                    </div>
                                    <div class="text-center my-2 mx-3 grow">
                                        <div class="text-center rounded-full p-1 mt-2 mx-auto text-cerise-500" style="width: 66%; left: 17%; line-height: 7px; font-size: 10px; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; background-color: #ACD988; color: #219653;">
                                            Entregado
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 7px; font-size: 10px; width: 55px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden sm:block w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="hidden sm:block"> &nbsp;-&nbsp;<?php echo $hora_documentos_1_entregado[$key_mesas]; ?></span>
                                </div>
                                <div class="sm:flex border-t border-t-1">
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                        </svg>
                                    </div>
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        unset($resultados);
        unset($ejercicios_documentos_1);
        unset($id_documentos_1);
        unset($id_librador_documentos_1);
        unset($librador_activo);
        unset($librador_documentos_1);
        unset($fecha_documento_documentos_1);
        unset($numero_documento_documentos_1);
        unset($serie_documento_documentos_1);
        unset($total_documentos_1);
        unset($estado_documentos_1);
        unset($id_usuario_documentos_1);
        unset($hora_documentos_1);
        unset($observacion_documentos_1);
        unset($ejercicios_documentos_1_cocinandose);
        unset($id_documentos_1_cocinandose);
        unset($id_librador_documentos_1_cocinandose);
        unset($librador_activ_cocinandoseo);
        unset($librador_documentos_1_cocinandose);
        unset($fecha_documento_documentos_1_cocinandose);
        unset($numero_documento_documentos_1_cocinandose);
        unset($serie_documento_documentos_1_cocinandose);
        unset($total_documentos_1_cocinandose);
        unset($estado_documentos_1_cocinandose);
        unset($id_usuario_documentos_1_cocinandose);
        unset($hora_documentos_1_cocinandose);
        unset($observacion_documentos_1_cocinandose);
        unset($ejercicios_documentos_1_pendiente_pago);
        unset($id_documentos_1_pendiente_pago);
        unset($id_librador_documentos_1_pendiente_pago);
        unset($librador_activ_pendiente_pagoo);
        unset($librador_documentos_1_pendiente_pago);
        unset($fecha_documento_documentos_1_pendiente_pago);
        unset($numero_documento_documentos_1_pendiente_pago);
        unset($serie_documento_documentos_1_pendiente_pago);
        unset($total_documentos_1_pendiente_pago);
        unset($estado_documentos_1_pendiente_pago);
        unset($id_usuario_documentos_1_pendiente_pago);
        unset($hora_documentos_1_pendiente_pago);
        unset($observacion_documentos_1_pendiente_pago);
        unset($ejercicios_documentos_1_entregado);
        unset($id_documentos_1_entregado);
        unset($id_librador_documentos_1_entregado);
        unset($librador_activ_entregadoo);
        unset($librador_documentos_1_entregado);
        unset($fecha_documento_documentos_1_entregado);
        unset($numero_documento_documentos_1_entregado);
        unset($serie_documento_documentos_1_entregado);
        unset($total_documentos_1_entregado);
        unset($estado_documentos_1_entregado);
        unset($id_usuario_documentos_1_entregado);
        unset($hora_documentos_1_entregado);
        unset($observacion_documentos_1_entregado);
    }
    ?>

</div>
<div class="mt-4">
    &nbsp;
</div>
