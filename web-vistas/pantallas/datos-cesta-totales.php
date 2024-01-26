<?php
// LOS DATOS DE ESTE ARCHIVO, SE ACTUALIZAR DESDE function actualizarCesta() que ejecuta documentpo_actualizar.php
if($mostrar_cesta == "superior") {
    ?>
    <div class="grid-4-cesta" id="capa_totales_cesta">
        <div class="row-cesta">
            <div class="text-center mt-15p" id="capa_dato_base"></div>
        </div>
        <div class="row-cesta">
            <div class="text-center">
                &nbsp;
                <button class="button-documento" onclick="collapseCapa('capa-datos-descuentos'); return false;">
                    Descuentos
                </button>
            </div>
            <div id="capa-datos-descuentos" class="hidden">
                <strong>Descuento pronto pago:</strong>
                <div class="grid-2-cesta-35-65">
                    <div class="row-cesta">
                        <div class="text-center">
                            <input type="text" class="w-80 text-right" name="descuento_pp" id="descuento_pp" value="" />&nbsp;%
                        </div>
                    </div>
                    <div class="row-cesta">
                        <div class="text-center" id="capa_dato_importe_descuento_pp"></div>
                    </div>
                </div>
                <strong>Descuento librador:</strong>
                <div class="grid-2-cesta-35-65">
                    <div class="row-cesta">
                        <div class="text-center">
                            <input type="text" class="w-80 text-right" name="descuento_librador" id="descuento_librador" value="" />&nbsp;%
                        </div>
                    </div>
                    <div class="row-cesta">
                        <div class="text-center" id="capa_dato_importe_descuento_librador"></div>
                    </div>
                </div>
                <div class="grid-2-cesta">
                    <div class="row text-left">
                        <input type="checkbox" name="check_guardar_datos_descuento_cesta" id="check_guardar_datos_descuento_cesta" /> Actualizar ficha.
                    </div>
                    <div class="row">
                        <button class="button-documento" onclick="identificar('8');">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="row-cesta">
            <strong class="ml-15">Base:</strong>
            <div class="text-center">
                <input type="number" class="w-95" name="base" id="base" value="" />&nbsp;€
            </div>
        </div>
        -->
        <div class="row-cesta">
            <div class="text-center">
                &nbsp;
                <button class="button-documento" onclick="collapseCapa('capa-datos-impuestos'); return false;">
                    Impuestos
                </button>
            </div>
            <div id="capa-datos-impuestos" class="hidden">
                <?php
                if (isset($matriz_iva_productos_iva)) {
                    ?>
                    <div class="grid-5">
                        <div class="row-cesta">
                            <div class="text-center">
                                <strong>Base:</strong>
                            </div>
                        </div>
                        <div class="row-cesta">
                            <div class="text-center">
                                <strong>IVA:</strong>
                            </div>
                        </div>
                        <div class="row-cesta">
                            <div class="text-center">
                                <strong>Importe:</strong>
                            </div>
                        </div>
                        <div class="row-cesta">
                            <div class="text-center">
                                <strong>Recargo Eq.:</strong>
                            </div>
                        </div>
                        <div class="row-cesta">
                            <div class="text-center">
                                <strong>Importe:</strong>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($matriz_iva_productos_iva as $key_productos_iva => $valor_productos_iva) {
                        /*
                         * VIENE DE documento_actualizar.php
                        $base_iva[intval($result_iva[0]['iva'])] += $result_iva[0]['base'];
                        $iva[intval($result_iva[0]['iva'])] += $result_iva[0]['iva'];
                        $importe_iva[intval($result_iva[0]['iva'])] += $result_iva[0]['importe_iva'];
                        $recargo[intval($result_iva[0]['iva'])] += $result_iva[0]['recargo'];
                        $importe_recargo[intval($result_iva[0]['iva'])] += $result_iva[0]['importe_recargo'];
                        */
                        ?>
                        <div class="grid-5">
                            <div class="row-cesta">
                                <div class="text-center" id="capa_dato_base_<?php echo $key_productos_iva; ?>"></div>
                            </div>
                            <div class="row-cesta">
                                <div class="text-center" id="capa_dato_iva_<?php echo $key_productos_iva; ?>"></div>
                            </div>
                            <div class="row-cesta">
                                <div class="text-center" id="capa_dato_importe_iva_<?php echo $key_productos_iva; ?>"></div>
                            </div>
                            <div class="row-cesta">
                                <div class="text-center" id="capa_dato_recargo_<?php echo $key_productos_iva; ?>"></div>
                            </div>
                            <div class="row-cesta">
                                <div class="text-center" id="capa_dato_importe_recargo_<?php echo $key_productos_iva; ?>"></div>
                            </div>
                        </div>
                        <?php
                    }
                }

                ?>
                <div class="grid-2">
                    <div class="row-cesta">
                        <div class="text-center">
                            <strong>IRPF:</strong>
                        </div>
                    </div>
                    <div class="row-cesta">
                        <div class="text-center">
                            <strong>Importe:</strong>
                        </div>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="row-cesta">
                        <div class="text-center">
                            <input type="text" class="w-80 text-right" name="irpf_totales_cesta" id="irpf_totales_cesta" value="<?php echo $irpf_librador; ?>" />&nbsp;%
                        </div>
                    </div>
                    <div class="row-cesta">
                        <div class="text-center" id="capa_dato_importe_irpf_totales_cesta"></div>
                    </div>
                </div>
                <div class="grid-2-cesta">
                    <div class="row text-left">
                        <input type="checkbox" name="check_guardar_datos_irpf_cesta" id="check_guardar_datos_irpf_cesta" /> Actualizar ficha.
                    </div>
                    <div class="row">
                        <button class="button-documento" onclick="identificar('9');">
                            Guardar
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <div class="row-cesta">
            <div class="text-center mt-15p size-18pt" id="capa_dato_total"></div>
        </div>
    </div>
    <?php
}else {
    ?>
    <div id="modal-otros-datos-documento" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-blendimodal-background dark:bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex justify-between items-start py-6 px-20 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Otros datos del documento
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-otros-datos-documento">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="px-20 modal-body overflow-y-auto">
                    <div id="capa_totales_cesta_1">
                        <div>
                            <div id="capa_dato_base"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 mb-6 space-x-3 text-left">
                        <?php
                        if (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) {
                            ?>
                            <div class="flex items-center space-x-3">
                                <?php
                                $checked = "";
                                if(isset($recargo) && $recargo == 1) {
                                    $checked = " checked";
                                }
                                ?>
                                <input type="checkbox" name="check_recargo_descuento_cesta" id="check_recargo_descuento_cesta"<?php echo $checked; ?> />
                                <div>
                                    Recargo eq.
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="check_recargo_descuento_cesta" id="check_recargo_descuento_cesta" value="<?php echo $recargo; ?>" />
                            <?php
                        }
                        if (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) {
                            ?>
                            <div>
                                <div>I.R.P.F.:</div>
                                <div class="text-left">
                                    <input type="number" class="w-full" name="irpf_descuento_cesta" id="irpf_descuento_cesta" value="<?php echo $irpf_librador; ?>" />
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="irpf_descuento_cesta" id="irpf_descuento_cesta" value="<?php echo $irpf_librador; ?>" />
                            <?php
                        }
                        if (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) {
                            ?>
                            <div>
                                <div>Desc. p.p. (%):</div>
                                <div class="text-left">
                                    <input type="text" class="w-full text-right" name="descuento_pp" id="descuento_pp" value="<?php echo $descuento_pp; ?>" />
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="descuento_pp" id="descuento_pp" value="<?php echo $descuento_pp; ?>" />
                            <?php
                        }
                        ?>
                    </div>
                    <div class="grid grid-cols-2 space-y-6 text-left" id="capa_totales_cesta_2">
                        <div>
                            <?php
                            if($tipo_librador == "cli") {
                                ?><div>Descuento cliente:</div><?php
                            }else if($tipo_librador == "mes") {
                                ?><div>Descuento mesa:</div><?php
                            }else if($tipo_librador == "tak") {
                                ?><div>Descuento take away:</div><?php
                            }else if($tipo_librador == "del") {
                                ?><div>Descuento delivery:</div><?php
                            }else if($tipo_librador == "pro") {
                                ?><div>Descuento proveedor:</div><?php
                            }else if($tipo_librador == "cre") {
                                ?><div>Descuento creditor:</div><?php
                            }
                            ?>
                            <div>
                                <div class="text-center flex">
                                    <div class="grow">
                                        <input type="number" class="text-center w-2/3" name="descuento_librador" id="descuento_librador" value="<?php echo number_format($descuento_librador, 2, '.', ''); ?>" />%
                                    </div>
                                    <div class="flex items-center">
                                        o
                                    </div>
                                    <div class="grow">
                                        <input type="number" class="text-center w-2/3" name="descuento_librador_euro" id="descuento_librador_euro" value="<?php echo number_format($descuento_librador_euro, 2, '.', ''); ?>">€
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-left flex space-x-3 items-center justify-end">
                            <input type="checkbox" name="check_guardar_datos_descuento_cesta" id="check_guardar_datos_descuento_cesta" />
                            <div>
                                Actualizar ficha.
                            </div>
                        </div>
                        <div class="col-span-2" id="<?php echo ($mostrar_cesta == "superior")? 'capa_otros_datos_cesta' : 'capa_otros_datos_textarea_cesta'; ?>">
                            <div>Notas</div>
                            <div class="text-center">
                                <textarea class="w-full" name="nota_documento" id="nota_documento"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="my-6" />
                    <div class="grid-1 text-right<?php echo $clase_botones_datos; ?>" id="capa_totales_cesta_3">
                        <div class="row-cesta">
                            <div>
                                <?php
                                if (isset($matriz_iva_productos_iva)) {
                                    ?>
                                    <div class="grid <?php echo (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) ? 'grid-cols-5' : 'grid-cols-3'; ?>">
                                        <div class="row-cesta">
                                            <div class="text-center">
                                                <strong>Base</strong>
                                            </div>
                                        </div>
                                        <div class="row-cesta">
                                            <div class="text-center">
                                                <strong>IVA</strong>
                                            </div>
                                        </div>
                                        <div class="row-cesta">
                                            <div class="text-center">
                                                <strong>Importe</strong>
                                            </div>
                                        </div>
                                        <?php
                                        if (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) {
                                            ?>
                                            <div class="row-cesta">
                                                <div class="text-center">
                                                    <strong>Recargo Eq.</strong>
                                                </div>
                                            </div>
                                            <div class="row-cesta">
                                                <div class="text-center">
                                                    <strong>Importe</strong>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    foreach ($matriz_iva_productos_iva as $key_productos_iva => $valor_productos_iva) {
                                        ?>
                                        <div class="grid <?php echo (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) ? 'grid-cols-5' : 'grid-cols-3'; ?>">
                                            <div class="row-cesta">
                                                <div class="text-center" id="capa_dato_base_<?php echo $key_productos_iva; ?>"></div>
                                            </div>
                                            <div class="row-cesta">
                                                <div class="text-center" id="capa_dato_iva_<?php echo $key_productos_iva; ?>"></div>
                                            </div>
                                            <div class="row-cesta">
                                                <div class="text-center" id="capa_dato_importe_iva_<?php echo $key_productos_iva; ?>"></div>
                                            </div>
                                            <div class="row-cesta <?php echo (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) ? '' : 'hidden'; ?>">
                                                <div class="text-center" id="capa_dato_recargo_<?php echo $key_productos_iva; ?>"></div>
                                            </div>
                                            <div class="row-cesta <?php echo (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) ? '' : 'hidden'; ?>">
                                                <div class="text-center" id="capa_dato_importe_recargo_<?php echo $key_productos_iva; ?>"></div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <div class="grid grid-cols-2 <?php echo (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) ? '' : 'hidden'; ?>">
                                    <div class="row-cesta">
                                        <div class="text-center">
                                            <strong>IRPF</strong>
                                        </div>
                                    </div>
                                    <div class="row-cesta">
                                        <div class="text-center">
                                            <strong>Importe</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 <?php echo (($tipo_librador != "cli" && $tipo_librador != "tak" && $tipo_librador != "del" && $tipo_librador != "mes") || (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca'))) ? '' : 'hidden'; ?>">
                                    <div class="row-cesta">
                                        <div class="text-center w-full">
                                            <?php echo $irpf_librador; ?>%
                                        </div>
                                    </div>
                                    <div class="row-cesta">
                                        <div class="text-center w-full" id="capa_dato_importe_irpf_totales_cesta"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-cesta">
                            <div>
                                <div class="grid grid-cols-2">
                                    <div class="row-cesta">
                                        <div class="text-center">
                                            <strong>Descuento</strong>
                                        </div>
                                    </div>
                                    <div class="row-cesta">
                                        <div class="text-center">
                                            <strong>Total</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="text-center" id="capa_dato_descuento">
                                        <?php echo number_format($descuento_librador_euro, 2, ',', '.'); ?> €
                                    </div>
                                    <div class="text-center" id="capa_dato_total">
                                        <?php echo number_format($total, 2, ',', '.'); ?> €
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-otros-datos.php");
                    ?>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="hidden text-right text-sm hover:text-blendi-600" type="button" data-modal-toggle="modal-otros-datos-documento" id="buttonModalOtrosDatosDocumento">
        <div class="pl-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 float-right mt-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </div>
    </a>
    <?php
}
?>
<input type="hidden" name="base" id="base" value="<?php echo $base; ?>" />
<input type="hidden" name="importe_descuento_pp" id="importe_descuento_pp" value="" />
<input type="hidden" name="importe_descuento_librador" id="importe_descuento_librador" value="" />
<?php
if (isset($matriz_iva_productos_iva)) {
    foreach ($matriz_iva_productos_iva as $key_productos_iva => $valor_productos_iva) {
        ?>
        <input type="hidden" name="base_<?php echo $key_productos_iva; ?>" id="base_<?php echo $key_productos_iva; ?>" value="<?php echo $base_iva[$key_productos_iva]; ?>" />
        <input type="hidden" name="iva_<?php echo $key_productos_iva; ?>" id="iva_<?php echo $key_productos_iva; ?>" value="<?php echo $valor_productos_iva; ?>" />
        <input type="hidden" name="importe_iva_<?php echo $key_productos_iva; ?>" id="importe_iva_<?php echo $key_productos_iva; ?>" value="<?php echo $importe_iva[$key_productos_iva]; ?>" />
        <input type="hidden" name="recargo_<?php echo $key_productos_iva; ?>" id="recargo_<?php echo $key_productos_iva; ?>" value="<?php echo $matriz_recargo_productos_iva[$key_productos_iva]; ?>" />
        <input type="hidden" name="importe_recargo_<?php echo $key_productos_iva; ?>" id="importe_recargo_<?php echo $key_productos_iva; ?>" value="<?php echo $importe_recargo[$key_productos_iva]; ?>" />
        <?php
    }
}
?>
<input type="hidden" name="importe_irpf_totales_cesta" id="importe_irpf_totales_cesta" value="" />
<input type="hidden" name="total" id="total" value="" />
