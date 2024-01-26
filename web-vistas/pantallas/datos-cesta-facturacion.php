<?php
$select_sys = "bancos-cajas";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-bancos-cajas.php");
$id_banco_cobro_defecto = 0;
if (count($id_bancos_cajas) > 0) {
    $id_banco_cobro_defecto = $id_bancos_cajas[0];
}
?>

<input type="hidden" name="id_librador_cesta" id="id_librador_cesta" value="<?php echo $id_librador; ?>" />
<input type="hidden" name="tipo_librador" id="tipo_librador" value="<?php echo $tipo_librador; ?>" />
<input type="hidden" name="id_banco_cobro_defecto" id="id_banco_cobro_defecto" value="<?php echo $id_banco_cobro_defecto; ?>" />

<?php
unset($id_bancos_cajas);
unset($descripcion_bancos_cajas);
unset($iban_bancos_cajas);
?>

<div class="row-cesta">
    <?php
    $nombreLibradorAcutal = '';
    foreach ($matriz_id_libradores_seleccionar as $key_id_libradores_seleccionar => $valor_id_libradores_seleccionar) {
        if ($id_librador == $valor_id_libradores_seleccionar) {
            $nombreLibradorAcutal = $matriz_nombre_libradores_seleccionar[$key_id_libradores_seleccionar];
            break;
        }
    }

    ?>

    <!-- INICIO MODAL -->
    <div class="flex bg-gray-25 dark:bg-graydark-650">
        <?php

        if($lineas_documento > 0) {
            $eliminar = true;
            if ($tipo_librador == 'cli' && ($tipo_documento == 'fac' || $tipo_documento == 'tiq')) {
                $eliminar = false;
            }
            if (($tipo_librador == 'pro' || $tipo_librador == 'cre') && $tipo_documento == 'fac') {
                $eliminar = false;
            }
            ?>
            <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50" onclick="<?php if ($eliminar) { ?>if (confirm('Estás seguro de eliminar?')) { eliminarDocumento('<?php echo $id_documento; ?>', '<?php echo $ejercicio; ?>'); }<?php } else { ?>abonarDocumento('<?php echo $id_documento; ?>', '<?php echo $ejercicio; ?>'); <?php } ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </a>
            <?php
        } else {
            ?>
            <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </a>
            <?php
        }
        if(isset($librador_con_deuda) && $librador_con_deuda != $id_documento) {
            ?>
            <!-- Se debe revisar su funcionalidad
            <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50" onclick="actualizarOtrosDocumentos('capa-tpv','tpv','abiertos','mostrar');">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </a>-->
            <?php
        }

        ?>
        <a href="#" class="bg-gray-25 dark:bg-graydark-650 grow flex items-center justify-center font-medium text-sm text-center p-3 text-blendi-600 font-bold hover:text-blendidark-50" type="button" id="boton-modal-facturacion" onclick="modalFac.show()">
            <div>
                <?php
                if ($tipo_librador == 'mes') {
                    echo 'Mesa: ';
                } else if ($tipo_librador == 'cli') {
                    echo 'Cliente: ';
                } else if ($tipo_librador == 'pro') {
                    echo 'Proveedor: ';
                } else if ($tipo_librador == 'cre') {
                    echo 'Creditor: ';
                }
                echo $nombreLibradorAcutal;
                ?>
            </div>
            <!--<div class="pl-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </div>-->
        </a>
        <?php
        if($lineas_documento > 0) {
            if($tipo_documento == "tiq") {
                if($tipo_librador == "mes") {
                    ?>
                    <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50 flex space-x-2" onclick="modalFac.show();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <div>
                            <?php echo (isset($comensales))? $comensales : '0'; ?>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50" onclick="imprimirDocumento(idDocumento,ejercicio,'','');">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                    </svg>
                </a>
                <?php
            }else {
                $select_sys = "obtener_modelos";
                require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-documentos.php");
                if(count($id_modelos_impresion_1) > 0) {
                    if(count($id_modelos_impresion_1) > 1) {
                        ?>

                        <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50" onclick="document.getElementById('botonOpenModalImpresion').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                            </svg>
                        </a>
                        <?php
                    }else {
                        ?>
                        <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50" onclick="imprimirDocumentoPDF(idDocumento,ejercicio,'<?php echo $id_modelos_impresion_1[0]; ?>');">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                            </svg>
                        </a>
                        <?php
                    }
                    unset($id_modelos_impresion_1);
                    unset($descripcion_modelos_impresion_1);
                    unset($predeterminado_modelos_impresion_1);
                }
            }
        } else {
            ?>
            <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                </svg>
            </a>
            <?php
        }
        if($lineas_documento > 0) {
            ?>
            <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50" onclick="cerrarDocumento(false);">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <?php
        } else {
            ?>
            <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <?php
        }
        ?>
    </div>
    <div id="modal-facturacion" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Configuración del documento
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="modalFac.hide()">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6 modal-body overflow-y-auto">
                    <?php
                    if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                        ?>
                        <div class="col-span-2">
                            <div class="w-full flex items-center" id="capa_librador_cesta_test">
                                <div>
                                    <a href="#" class="items-center inline-flex justify-center border border-transparent bg-blendi-600 dark:bg-blendidark-600 py-2 px-4 text-sm font-medium text-white dark:text-black shadow-sm" onclick="datosFacturacionCesta('-1','cesta');">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                                        </svg>
                                        Nuevo Cliente
                                    </a>
                                </div>
                                <div class="grow ml-2">
                                    <?php
                                    $titulo_id = 1;
                                    $titulo_relacionados_key = 1;
                                    ?>
                                    <input type="hidden" id="titulo_relacionado_cliente_1" class="titulo_relacionado_cliente_1" value="" />
                                    <div id="titulo_relacionado_dropdown_descripcion_1_trigger">
                                        <input type="text" name="titulo_relacionado_descripcion[]" class="w-full bg-gray-70 border-0 border-b-2 border-gray-100 titulo_relacionado_descripcion_1" value="" onkeyup="buscadorClientes(1)" />
                                    </div>
                                    <div id="titulo_relacionado_dropdown_descripcion_1" class="hidden bg-white border-2 rounded bg-white cursor-pointer titulo_relacionado_descripcion_buscador_1">
                                        ...
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    loadDropdownDescripcionBuscador(1);
                                </script>
                            </div>
                        </div>

                        <div class="m1 flex items-center" id="capa_librador_cesta">
                            <select class="grow w-full" id="id_librador_cesta_cli" class="ancho_listado_clientes" name="id_librador_cesta_cli" onchange="datosFacturacionCesta(this.value,'cesta');">
                                <!-- <option value="-3">Nuevo take away</option> -->
                                <?php
                                $ultimoIdComedor = -1;
                                foreach ($matriz_id_libradores_seleccionar as $key_id_libradores_seleccionar => $valor_id_libradores_seleccionar) {
                                    if($matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "cli" || $matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "mes" || $matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "tak" || $matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "del") {
                                        $selected = '';
                                        if ($id_librador == $valor_id_libradores_seleccionar) {
                                            $selected = ' selected';
                                        }
                                        if ($ultimoIdComedor != $matriz_id_comedores_libradores_seleccionar[$key_id_libradores_seleccionar]) {
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
                                        <option value="<?php echo $valor_id_libradores_seleccionar; ?>"<?php echo $selected; ?>><?php echo $matriz_nombre_libradores_seleccionar[$key_id_libradores_seleccionar]; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                </optgroup>
                            </select>
                            <?php
                            if($interface == "tpv" && $id_usuario == 1) {
                                ?>
                                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cli" class="text-decoration-none text-blendi-600 ml-2" title="Clientes" target="_self">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }else if($tipo_librador == "pro") {
                        ?>
                        <div class="m1" id="capa_librador_cesta">
                            <select class="w-full" id="id_librador_cesta_pro" name="id_librador_cesta_pro" onchange="datosFacturacionCesta(this.value,'cesta')">
                                <option value="-1">Nuevo proveedor</option>
                                <?php
                                foreach ($matriz_id_libradores_seleccionar as $key_id_libradores_seleccionar => $valor_id_libradores_seleccionar) {
                                    if($matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "pro") {
                                        $selected = '';
                                        if ($id_librador == $valor_id_libradores_seleccionar) {
                                            $selected = ' selected';
                                        }
                                        ?>
                                        <option value="<?php echo $valor_id_libradores_seleccionar; ?>"<?php echo $selected; ?>><?php echo $matriz_nombre_libradores_seleccionar[$key_id_libradores_seleccionar]; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if($interface == "tpv" && $id_usuario == 1) {
                                ?>
                                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=pro" class="text-decoration-none" style="vertical-align: middle; margin-left: 4px;" title="Clientes" target="_self">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }else if($tipo_librador == "cre") {
                        ?>
                        <div class="m1" id="capa_librador_cesta">
                            <select class="w-full" id="id_librador_cesta_cre" name="id_librador_cesta_cre" onchange="datosFacturacionCesta(this.value,'cesta')">
                                <option value="-1">Nuevo creditor</option>
                                <?php
                                foreach ($matriz_id_libradores_seleccionar as $key_id_libradores_seleccionar => $valor_id_libradores_seleccionar) {
                                    if($matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "cre") {
                                        $selected = '';
                                        if ($id_librador == $valor_id_libradores_seleccionar) {
                                            $selected = ' selected';
                                        }
                                        ?>
                                        <option value="<?php echo $valor_id_libradores_seleccionar; ?>"<?php echo $selected; ?>><?php echo $matriz_nombre_libradores_seleccionar[$key_id_libradores_seleccionar]; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php
                            if($interface == "tpv" && $id_usuario == 1) {
                                ?>
                                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cre" class="text-decoration-none" style="vertical-align: middle; margin-left: 4px;" title="Clientes" target="_self">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $clase_comensales = " hidden";
                    if ($existen_mesas == true) {
                        $clase_comensales = "";
                    }
                    ?>
                    <div class="row-cesta<?php echo $clase_comensales; ?>">
                        <div id="capa_titulo_comensales" class="flex items-center space-x-2">
                            <div>
                                <strong>Comensales: </strong>
                            </div>

                            <div>
                                <input type="hidden" id="comensales_tiquet-guardar" value="<?php echo (isset($comensales))? $comensales : '0'; ?>" />
                                <select id="lista_comensales_tiquet_guardar" style="text-align: center; width: 120px; margin-left: auto; margin-right: auto;" onchange="controlListaComensales('_tiquet');">
                                    <?php
                                    for ($bucle = 0 ; $bucle <= 50 ; $bucle++) {
                                        echo "<option value='".$bucle."' " . ((isset($comensales) && $comensales == $bucle)? 'selected' : '') . ">".$bucle."</option>";
                                    }
                                    ?>
                                    <option value="-1">Otra cantidad</option>
                                </select>
                                <input type="number" class="mt-10p hidden" style="text-align: center; width: 120px; margin-left: auto; margin-right: auto;" id="numero_comensales_tiquet_guardar" value="" />
                                <div class="hidden color-red font-bold" id="aviso-comensales_tiquet">Introducir el número de comensales.</div>
                                <div class="mt-10p hidden" id="boton-capa-comensales_tiquet">
                                    <button class="button-documento" onclick="guardarComensales('_tiquet');">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") && empty($numero_documento)) {
                        $select_sys = "obtener_series";
                        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-documentos.php");
                        ?>
                        <div class="flex items-center space-x-2">
                            <div>
                                <strong>Serie: </strong>
                            </div>
                            <div>
                                <select id="serie_documento" name="serie_documento" style="text-align: center; width: 120px; margin-left: auto; margin-right: auto;">
                                    <option value="">Sin serie</option>
                                    <?php
                                    foreach ($ids_serie as $key_serie => $id_serie) {
                                        echo "<option value='".$series_serie[$key_serie]."' " . (($series_serie[$key_serie] == $serie_documento)? 'selected' : '') . ">".$series_serie[$key_serie]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="flex items-center p-3 bg-gray-50">
                        <button class="button-documento<?php echo $clase_botones_datos; ?> grow" id="capa-datos-facturacion-tpv" onclick="collapseMenu('capa-datos-cabecera-facturacion'); return false;">
                            Datos facturación
                        </button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" id="capa-datos-cabecera-facturacion-show" onclick="collapseMenu('capa-datos-cabecera-facturacion'); return false;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer hidden" id="capa-datos-cabecera-facturacion-hidden" onclick="collapseMenu('capa-datos-cabecera-facturacion'); return false;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <?php
                        if($interface == "tpv" && $id_usuario == 1 && $tipo_librador != "mes") {
                            ?>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/id_libradores=<?php echo $id_librador; ?>/tipo=<?php echo $tipo_librador; ?>" class="text-decoration-none text-blendi-600 ml-2" title="Abrir ficha" target="_self">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="hidden" id="capa-datos-cabecera-facturacion">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <!-- <div class="grid-2-cesta hidden" id="input-radio-embalajes-nuevo-cliente"> -->
                            <div class="hidden">
                                <div class="row text-left input-cesta">
                                    <strong>Usar embalajes en las ventas:</strong>
                                </div>
                                <div class="row text-left input-cesta">
                                    <span class="ml-25p">SI</span><input type="radio" name="tipo_librador_nuevo_cliente" id="tipo_librador_nuevo_cliente_tak" value="tak" checked />
                                    <span class="ml-25p">NO</span><input type="radio" name="tipo_librador_nuevo_cliente" id="tipo_librador_nuevo_cliente_cli" value="cli" />
                                </div>
                            </div>
                            <!-- <div class="grid-2-cesta"> -->
                            <div class="hidden">
                                <div class="row text-left input-cesta">
                                    <strong>Código:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="codigo_librador_documento" id="codigo_librador_documento" value="<?php echo $codigo_librador; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Nombre:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="nombre_documento" id="nombre_documento" value="<?php echo $librador_nombre; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Apellido 1:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="apellido_1_documento" id="apellido_1_documento" value="<?php echo $librador_apellido_1; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Apellido 2:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="apellido_2_documento" id="apellido_2_documento" value="<?php echo $librador_apellido_2; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Razón social:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="razon_social_documento" id="razon_social_documento" value="<?php echo $librador_social; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Nombre comercial:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="razon_comercial_documento" id="razon_comercial_documento" value="<?php echo $librador_comercial; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>NIF/DNI:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="nif_documento" id="nif_documento" value="<?php echo $nif; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Dirección:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="direccion_documento" id="direccion_documento" value="<?php echo $direccion; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Número:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="numero_direccion_documento" id="numero_direccion_documento" value="<?php echo $numero; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Escalera:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="escalera_direccion_documento" id="escalera_direccion_documento" value="<?php echo $escalera; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Piso:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="piso_direccion_documento" id="piso_direccion_documento" value="<?php echo $piso; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Puerta:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="puerta_direccion_documento" id="puerta_direccion_documento" value="<?php echo $puerta; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Localidad:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="localidad_documento" id="localidad_documento" value="<?php echo $localidad; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Código postal:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="codigo_postal_documento" id="codigo_postal_documento" value="<?php echo $codigo_postal; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Provincia:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="provincia_documento" id="provincia_documento" value="<?php echo $provincia; ?>" />
                                </div>
                            </div>

                            <!-- <div class="grid-2-cesta"> -->
                            <div class="hidden">
                                <div class="row text-left input-cesta">
                                    <strong>Teléfono 1:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="telefono_1_documento" id="telefono_1_documento" value="<?php echo $telefono_1; ?>" />
                                </div>
                            </div>
                            <!-- <div class="grid-2-cesta"> -->
                            <div class="hidden">
                                <div class="row text-left input-cesta">
                                    <strong>Teléfono 2:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="telefono_2_documento" id="telefono_2_documento" value="<?php echo $telefono_2; ?>" />
                                </div>
                            </div>
                            <!-- <div class="grid-2-cesta"> -->
                            <div class="hidden">
                                <div class="row text-left input-cesta">
                                    <strong>Fax:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="fax_documento" id="fax_documento" value="<?php echo $fax; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Móvil:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="mobil_documento" id="mobil_documento" value="<?php echo $mobil; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>email:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="email_documento" id="email_documento" value="<?php echo $email; ?>" />
                                </div>
                            </div>
                            <div class="grid-2-cesta">
                                <div class="row text-left input-cesta">
                                    <strong>Persona contacto:</strong>
                                </div>
                                <div class="row text-left">
                                    <input type="text" class="sin-borde input-cesta w-full" name="persona_contacto_documento" id="persona_contacto_documento" value="<?php echo $persona_contacto; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="grid-2-cesta grid grid-cols-2 gap-4 mt-5">
                            <div class="row text-left">
                                <input type="checkbox" name="check_guardar_datos_facturacion_cesta" id="check_guardar_datos_facturacion_cesta" /> Actualizar ficha.
                            </div>
                            <div class="row">
                                <button class="button-documento hover:text-blendi-600 hover:underline" onclick="event.preventDefault(); identificar('4');">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php
                    require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-enviar.php");
                    require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-documento.php");
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- FINAL MODAL -->

</div>

<script type="text/javascript">
    (function() {
        window.modalFac = new Modal(document.getElementById('modal-facturacion'));
    })();
</script>