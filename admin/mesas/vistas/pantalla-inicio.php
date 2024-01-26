<style>
    .capa-mesa {
        touch-action: none;

        /* This makes things *much* easier */
        box-sizing: border-box;
    }
    .capa-linea {
        touch-action: none;

        /* This makes things *much* easier */
        box-sizing: border-box;
    }
</style>

<?php
$select_sys = "comedores";
require($_SERVER['DOCUMENT_ROOT']."/admin/mesas/gestion/datos-select-php.php");
if(!isset($id_comedor)) {
    foreach ($id_comedores as $key_id_comedores => $valor_id_comedores) {
        if($principal_comedores[$key_id_comedores] == 1) {
            $id_comedor = $valor_id_comedores;
            break;
        }
    }
}
$select_sys = "mostrar-mesas";
require($_SERVER['DOCUMENT_ROOT']."/admin/mesas/gestion/datos-select-php.php");
$select_sys = "mostrar-lineas";
require($_SERVER['DOCUMENT_ROOT']."/admin/mesas/gestion/datos-select-php.php");
?>
<script>
    let anchoScroll = '<?php echo 50 + ($ancho_capa_mesas / 4); ?>';
</script>
<div id="capa_total_mesas" style="margin-right: auto; margin-left: auto;">
    <div class="w-full" id="capa-nueva-mesa">
        <div class="ml-5 flex flex-wrap space-x-2">
            <?php
            foreach ($id_comedores as $key_id_comedores => $valor_id_comedores) {
                $selected_comedor = "bg-white";
                if($valor_id_comedores == $id_comedor) {
                    $selected_comedor = "bg-blendi-35 font-bold";
                }
                ?>
                <div class="cursor-pointer flex items-center text-gray-650 <?php echo $selected_comedor; ?>">
                    <div class="cursor-pointer py-4 pl-4 pr-2" onclick="window.location.href = '/admin/gestion-mesas/id_comedor=<?php echo $valor_id_comedores; ?>'">
                        <?php echo $descripcion_comedores[$key_id_comedores]; ?>
                    </div>
                    <div onclick="editarComedor(<?php echo $valor_id_comedores; ?>)" class="py-4 pr-4 pl-2 cursor-pointer text-gray-650">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </div>
                </div>
                <?php
            }
            ?>
            <div onclick="editarComedor(-1)" class="p-4 cursor-pointer text-gray-650">
                + Añadir espacio
            </div>
        </div>
        <div class="w-full bg-blendi-35 p-3">
            <a href="#" class="items-center inline-flex justify-center border border-transparent bg-blendi-600 dark:bg-blendidark-600 py-2 px-4 text-sm font-medium text-white dark:text-black shadow-sm" onclick="document.getElementById('botonOpenModalEditarSala').click()" id="enlace_opciones_sala">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
                &nbsp;&nbsp;Opciones sala
            </a>
        </div>
    </div>
    <div class="w-full bg-blendi-35 pb-3" id="capa-scroll-comedor" style="overflow-x: auto; overflow-y: hidden;">
        <div id="capa-comedor" class="border border-2 border-blendi-600" style="
                position: relative; width: <?php echo intval($ancho_capa_mesas); ?>px; min-width: 970px; left: 1%; height: <?php echo $alto_capa_mesas; ?>px; min-height: 450px; margin-top: 7px; padding: 1%;
                background-color: #FAFAFA;
                background-size: 20px;
        ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-blendi-600 cursor-pointer" style="position: absolute; top: 13px; right: 13px" onclick="alert('Puedes arrastrar los bordes para ampliar o reducir el tamaño del comedor.')">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-blendi-600" style="position: absolute; top: -13px; left: -13px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-blendi-600" style="position: absolute; top: -13px; right: -13px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-blendi-600" style="position: absolute; bottom: -13px; left: -13px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-blendi-600" style="position: absolute; bottom: -13px; right: -13px">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
            </svg>
            <?php
            foreach ($matriz_id_mesas as $key_mesas => $valor_mesas) {
                if($matriz_activo_mesas[$key_mesas] == 1) {
                    ?>
                    <div class="capa-mesa" data-id-librador="<?php echo $valor_mesas; ?>" style="position: absolute; top: <?php echo $matriz_alto_pos_mesas[$key_mesas]; ?>px; left: <?php echo $matriz_ancho_pos_mesas[$key_mesas]; ?>px; width: <?php echo $matriz_ancho_mesas[$key_mesas] + 4; ?>px; height: <?php echo $matriz_alto_mesas[$key_mesas] + 4; ?>px; min-height: 143px;" onclick="cargarDatosMesa('<?php echo $valor_mesas; ?>');">
                        <?php
                        if(empty($matriz_image_mesa_mesas[$key_mesas])) {
                            $comensales_mesa = $matriz_comensales_mesas[$key_mesas];
                            if($numero_comensales[$key_mesas] != -1) {
                                $comensales_mesa = $numero_comensales[$key_mesas];
                            }
                            ?>
                            <div class="bg-white shadow-md rounded-b text-gray-500" style="width: <?php echo $matriz_ancho_mesas[$key_mesas]; ?>px; height: <?php echo $matriz_alto_mesas[$key_mesas]; ?>px; text-align: center; padding-top:1px; <?php if ($matriz_radio_mesas[$key_mesas] == 50) {  echo 'border-top-left-radius: 50px; border-top-right-radius: 50px;'; } ?>">
                                <div class="bg-gray-200 text-center rounded-full p-2 mt-2 mx-auto" style="width: fit-content; line-height: 7px; font-size: 10px;">
                                    <?php echo $matriz_descripcion_mesas[$key_mesas]; ?>
                                </div>
                                <div class="text-center my-2 mx-auto flex items-center font-black" style="width: fit-content; line-height: 10px; font-size: 18px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                    <?php echo $comensales_mesa; ?>
                                </div>
                                <div class="sm:flex">
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full cursor-pointer" style="line-height: 7px; font-size: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="mx-auto w-4 h-4 text-blendi-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </div>
                                    <div class="text-center mx-auto p-1 sm:p-2 items-center w-full cursor-pointer" style="line-height: 7px; font-size: 10px;" onclick="cargarDatosMesa('<?php echo $valor_mesas; ?>', true)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="mx-auto w-4 h-4 text-blendi-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }else {
                            ?>
                            <div style="width: <?php echo $matriz_ancho_mesas[$key_mesas]; ?>px; height: <?php echo $matriz_alto_mesas[$key_mesas]; ?>px; color: white; border-radius: <?php echo $matriz_radio_mesas[$key_mesas]; ?>%;">
                                <img src="/images/mesas/<?php echo $matriz_image_mesa_mesas[$key_mesas]; ?>" />
                                <?php echo $matriz_descripcion_mesas[$key_mesas]; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            }
            foreach ($matriz_id_lineas as $key_lineas => $valor_lineas) {
                ?>
                <div class="capa-linea" data-id-linea="<?php echo $valor_lineas; ?>" style="position: absolute; top: <?php echo $matriz_alto_pos_lineas[$key_lineas]; ?>px; left: <?php echo $matriz_ancho_pos_lineas[$key_lineas]; ?>px; width: <?php echo $matriz_ancho_lineas[$key_lineas]; ?>px; height: <?php echo $matriz_alto_lineas[$key_lineas]; ?>px;" onclick="cargarDatosLinea('<?php echo $valor_lineas; ?>');">
                    <div class="bg-blendi-35 border border-2 border-blendi-600" style="width: <?php echo $matriz_ancho_lineas[$key_lineas]; ?>px; height: <?php echo $matriz_alto_lineas[$key_lineas]; ?>px; <?php if ($matriz_alto_pos_lineas[$key_lineas] <= 0) { echo 'border-top: 0;'; } ?>;">
                        &nbsp;
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <button id="botonOpenModalEditarSala" class="hidden" type="button" onclick="toggleEditarSala();">
        Toggle modal
    </button>
    <div id="capa_editar_sala" class="hidden overflow-y-hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full sm:w-2/5 justify-center items-center">
        <div class="relative p-4 w-full h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-gray-70 shadow">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4">
                    <h3 class="text-xl font-semibold" id="titulo-ficha-modal">
                        Editar sala
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="document.getElementById('botonOpenModalEditarSala').click()">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Cerrar pantalla</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="w-full overflow-y-auto bg-white py-3" id="body-editar-sala-modal">
                    <div class="flex space-x-2 w-full p-4 cursor-pointer bg-gray-70 font-bold" style="text-align: center; margin-top: 7px;" onclick="guardarLinea('insertar-linea')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        &nbsp;&nbsp;Añadir estructura
                    </div>
                    <button id="botonOpenModalFichaLinea" class="hidden" type="button" onclick="toggleFichaLinea()">
                        Toggle modal
                    </button>
                    <div id="capa_ficha_linea" class="hidden px-3">
                        <input type="hidden" name="id_linea" id="id_linea" value="">
                        <input type="hidden" name="ancho_pos_linea" id="ancho_pos_linea" value="100">
                        <input type="hidden" name="alto_pos_linea" id="alto_pos_linea" value="100">
                        <input type="hidden" name="ancho_linea" id="ancho_linea" value="10">
                        <input type="hidden" name="alto_linea" id="alto_linea" value="100">
                        <div id="capa_guardar_ficha_linea_update" class="flex space-x-2 justify-end p-6">
                            <div class="box">
                                <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="document.getElementById('botonOpenModalFichaLinea').click(); document.getElementById('botonOpenModalEditarSala').click();">Volver al comedor</button>
                            </div>
                            <div class="hidden" id="capa-boton-eliminar-linea">
                                <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarLinea('eliminar-linea');">Eliminar</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-2 w-full p-4 cursor-pointer bg-gray-70 font-bold" style="text-align: center; margin-top: 7px;" onclick="guardarMesa('insertar');">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        &nbsp;&nbsp;Añadir mesa
                    </div>
                    <button id="botonOpenModalFichaMesa" class="hidden" type="button" onclick="toggleFichaMesa();">
                        Toggle modal
                    </button>
                    <div id="capa_ficha_mesa" class="hidden px-3">
                        <input type="hidden" name="id_mesa" id="id_mesa" value="">
                        <input type="hidden" name="imagen_mesa" id="imagen_mesa" value="">
                        <input type="hidden" name="imagen_mesa_ocupada" id="imagen_mesa_ocupada" value="">
                        <input type="hidden" name="ancho_pos_mesa" id="ancho_pos_mesa" value="100">
                        <input type="hidden" name="alto_pos_mesa" id="alto_pos_mesa" value="100">
                        <input type="hidden" name="ancho_mesa" id="ancho_mesa" value="100">
                        <input type="hidden" name="alto_mesa" id="alto_mesa" value="100">

                        <div class="bg-white p-3" id="body-ficha-mesa-modal">
                            <div class="grid grid-cols-1">
                                <div class="hidden">
                                    <label for="id_comedor">Comedor:</label><br>
                                    <select name="id_comedor" id="id_comedor" class="w-full">
                                        <?php
                                        foreach ($id_comedores as $key_id_comedores => $valor_id_comedores) {
                                            $selected_comedor = "";
                                            if($valor_id_comedores == $id_comedor) {
                                                $selected_comedor = " selected";
                                            }
                                            ?>
                                            <option value="<?php echo $valor_id_comedores; ?>"<?php echo $selected_comedor; ?>><?php echo $descripcion_comedores[$key_id_comedores]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <?php
                                    if($radio_mesas == 1) {
                                        $checked_activo_sys = " checked";
                                        $checked_inactivo_sys = "";
                                    }else {
                                        $checked_activo_sys = "";
                                        $checked_inactivo_sys = " checked";
                                    }
                                    ?>
                                    <label>Forma:</label><br>
                                    <div class="flex flex-wrap">
                                        <div onclick="activarElementoUnicoFicha('radio_mesas_1', 'capa_radio_mesas_1', 'capa_unicos_radio_mesas')" id="capa_radio_mesas_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_radio_mesas poin">
                                            <div class="font-bold text-left mr-2">
                                                Cuadrada
                                            </div>
                                            <div id="contracheck_radio_mesas_1" class="hidden w-6 h-6 contracheck_capa_unicos_radio_mesas">
                                                &nbsp;
                                            </div>
                                            <div id="check_radio_mesas_1" class="hidden check_capa_unicos_radio_mesas">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <input type="radio" name="radio_mesas" id="radio_mesas_1" value="10" class="hidden" />
                                        </div>
                                        <div onclick="activarElementoUnicoFicha('radio_mesas_2', 'capa_radio_mesas_2', 'capa_unicos_radio_mesas')" id="capa_radio_mesas_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_radio_mesas">
                                            <div class="font-bold text-left mr-2">
                                                Redonda
                                            </div>
                                            <div id="contracheck_radio_mesas_2" class="hidden w-6 h-6 contracheck_capa_unicos_radio_mesas">
                                                &nbsp;
                                            </div>
                                            <div id="check_radio_mesas_2" class="hidden check_capa_unicos_radio_mesas">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <input type="radio" name="radio_mesas" id="radio_mesas_2" value="50" class="hidden" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="nombre_libradores">Nombre:</label><br>
                                    <input type="text" name="nombre_libradores" id="nombre_libradores" class="w-full" maxlength="60" placeholder="Nombre" value="<?php echo $nombre_libradores; ?>" required />
                                </div>
                                <div>
                                    <label for="comensales_mesas">Comensales:</label><br>
                                    <input type="number" name="comensales_mesas" id="comensales_mesas" class="w-full" min="1" value="" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1">
                                <div>
                                    <?php require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_pago/componentes/form-select.php"); ?>
                                </div>
                                <div>
                                    <?php
                                    $titulo_tarifa = "Tarifa TPV";
                                    $id_select_sys = "id_tarifa_tpv_libradores";
                                    $id_tarifas = $id_tarifa_tpv_libradores;
                                    require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/componentes/form-select.php");
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    $titulo_bancos_cajas = "Banco / Caja cobro";
                                    $id_select_sys = "id_banco_cobro_libradores";
                                    $id_bancos_cajas_url = $id_banco_cobro_libradores;
                                    require($_SERVER['DOCUMENT_ROOT']."/admin/bancos_cajas/componentes/form-select.php");
                                    ?>
                                </div>
                            </div>
                            <div class="grid grid-cols-1">
                                <div>
                                    <span class="label-input">Mostrar </span><input type="radio" name="activo_libradores" id="activo_libradores" value="1"<?php echo $checked_activo_sys; ?> /><br>
                                    <span class="label-input">Almacén </span><input type="radio" name="activo_libradores" id="inactivo_libradores" value="0"<?php echo $checked_inactivo_sys; ?> />
                                </div>
                            </div>
                        </div>
                        <div id="capa_guardar_ficha_mesa_update" class="flex space-x-2 justify-end p-6 bg-white">
                            <div class="box">
                                <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="document.getElementById('botonOpenModalFichaMesa').click();  document.getElementById('botonOpenModalEditarSala').click();">Volver al comedor</button>
                            </div>
                            <div class="hidden" id="capa-boton-eliminar-mesa">
                                <!--<button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarMesa('eliminar-eliminar');">Eliminar</button>-->
                            </div>
                            <div class="box">
                                <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarMesa('guardar');">Guardar</button>
                            </div>
                        </div>
                        <div id="capa_guardar_ficha_mesa_duplicate" class="flex space-x-2 justify-end p-6 bg-white">
                            <div class="box">
                                <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="duplicarMesa();">Duplicar</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($ancho_pos_minimo_iniciado > 10) {
                        ?>
                        <div class="flex space-x-2 w-full p-4 cursor-pointer bg-gray-70 font-bold" style="text-align: center; margin-top: 7px;" onclick="eliminarMargenIzquierdo('<?php echo $ancho_pos_minimo_iniciado; ?>')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            &nbsp;&nbsp;Eliminar margen izq. (-<?php echo $ancho_pos_minimo_iniciado; ?>px)
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- Modal footer -->
                <div id="capa_guardar_editar_sala_update" class="flex items-center justify-end p-6 space-x-2 bg-white">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
    <button id="botonOpenModalEditarComedor" class="hidden" type="button" onclick="toggleEditarComedor();">
        Toggle modal
    </button>
    <div id="capa_editar_comedor" class="hidden overflow-y-hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full sm:w-2/5 justify-center items-center">
        <div class="relative p-4 w-full h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-gray-70 shadow">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4">
                    <h3 class="text-xl font-semibold" id="titulo-comedor-modal">
                        Editar comedor
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="document.getElementById('botonOpenModalEditarComedor').click()">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Cerrar pantalla</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="w-full overflow-y-auto bg-white p-3" id="body-editar-comedor-modal">
                    <input type="hidden" name="id_comedor_edicion" id="id_comedor_edicion" value="">

                    <div class="bg-white p-3" id="body-ficha-comedor-modal">
                        <div class="grid grid-cols-1">
                            <div>
                                <?php
                                $checked_activo_sys = " checked";
                                $checked_inactivo_sys = "";
                                ?>
                                <label>Activo:</label><br>
                                <div class="flex flex-wrap">
                                    <div onclick="activarElementoUnicoFicha('radio_comedor_activo_1', 'capa_radio_comedor_activo_1', 'capa_unicos_radio_comedor_activo')" id="capa_radio_comedor_activo_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_radio_comedor_activo poin">
                                        <div class="font-bold text-left mr-2">
                                            Si
                                        </div>
                                        <div id="contracheck_radio_comedor_activo_1" class="hidden w-6 h-6 contracheck_capa_unicos_radio_comedor_activo">
                                            &nbsp;
                                        </div>
                                        <div id="check_radio_comedor_activo_1" class="hidden check_capa_unicos_radio_comedor_activo">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input type="radio" name="radio_comedor_activo" id="radio_comedor_activo_1" value="1" class="hidden" />
                                    </div>
                                    <div onclick="activarElementoUnicoFicha('radio_comedor_activo_2', 'capa_radio_comedor_activo_2', 'capa_unicos_radio_comedor_activo')" id="capa_radio_comedor_activo_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_radio_comedor_activo">
                                        <div class="font-bold text-left mr-2">
                                            No
                                        </div>
                                        <div id="contracheck_radio_comedor_activo_2" class="hidden w-6 h-6 contracheck_capa_unicos_radio_comedor_activo">
                                            &nbsp;
                                        </div>
                                        <div id="check_radio_comedor_activo_2" class="hidden check_capa_unicos_radio_comedor_activo">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input type="radio" name="radio_comedor_activo" id="radio_comedor_activo_2" value="0" class="hidden" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <?php
                                $checked_activo_sys = " checked";
                                $checked_inactivo_sys = "";
                                ?>
                                <label>Principal:</label><br>
                                <div class="flex flex-wrap">
                                    <div onclick="activarElementoUnicoFicha('radio_comedor_principal_1', 'capa_radio_comedor_principal_1', 'capa_unicos_radio_comedor_principal')" id="capa_radio_comedor_principal_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_radio_comedor_principal poin">
                                        <div class="font-bold text-left mr-2">
                                            Si
                                        </div>
                                        <div id="contracheck_radio_comedor_principal_1" class="hidden w-6 h-6 contracheck_capa_unicos_radio_comedor_principal">
                                            &nbsp;
                                        </div>
                                        <div id="check_radio_comedor_principal_1" class="hidden check_capa_unicos_radio_comedor_principal">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input type="radio" name="radio_comedor_principal" id="radio_comedor_principal_1" value="1" class="hidden" />
                                    </div>
                                    <div onclick="activarElementoUnicoFicha('radio_comedor_principal_2', 'capa_radio_comedor_principal_2', 'capa_unicos_radio_comedor_principal')" id="capa_radio_comedor_principal_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_radio_comedor_principal">
                                        <div class="font-bold text-left mr-2">
                                            No
                                        </div>
                                        <div id="contracheck_radio_comedor_principal_2" class="hidden w-6 h-6 contracheck_capa_unicos_radio_comedor_principal">
                                            &nbsp;
                                        </div>
                                        <div id="check_radio_comedor_principal_2" class="hidden check_capa_unicos_radio_comedor_principal">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input type="radio" name="radio_comedor_principal" id="radio_comedor_principal_2" value="0" class="hidden" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="descripcion_comedor">Descripcion:</label><br>
                                <input type="text" name="descripcion_comedor" id="descripcion_comedor" class="w-full" maxlength="60" placeholder="Descripcion" value="" required />
                            </div>
                            <div>
                                <label for="orden_comedor">Orden:</label><br>
                                <input type="text" name="orden_comedor" id="orden_comedor" class="w-full" maxlength="50" placeholder="Orden" value="" required />
                            </div>
                        </div>
                    </div>
                    <div id="capa_guardar_ficha_comedor_update" class="flex space-x-2 justify-end p-6 bg-white">
                        <div class="box">
                            <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="document.getElementById('botonOpenModalEditarComedor').click();">Volver</button>
                        </div>
                        <div class="box">
                            <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarComedor('eliminar');">Eliminar</button>
                        </div>
                        <div class="box">
                            <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarComedor();">Guardar</button>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div id="capa_guardar_editar_comedor_update" class="flex items-center justify-end p-6 space-x-2 bg-white">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-blendi-35 py-3">
        <div class="pb-3" id="capa-eliminar-mesa" style="margin: 1%; width: 95%; border-radius: 5px; border: solid 1px grey; padding: 1%; background-color: #FAFAFA;">
            <div class="row text-center font-bold text-gray-650">
                Almacén
            </div>
            <?php
            foreach ($matriz_id_mesas as $key_mesas => $valor_mesas) {
                if($matriz_activo_mesas[$key_mesas] == 0) {
                    ?>
                    <hr class="w-full" />
                    <div data-id-librador="<?php echo $valor_mesas; ?>">
                        <div class="grid grid-cols-2 items-center py-2">
                            <div class="text-left">
                                Nombre mesa: <?php echo $matriz_descripcion_mesas[$key_mesas]; ?>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="document.getElementById('id_mesa').value=<?php echo $valor_mesas; ?>; guardarMesa('estado');">Retornar al comedor</button>
                                <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="document.getElementById('id_mesa').value=<?php echo $valor_mesas; ?>; guardarMesa('eliminar');">Eliminar</button>
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