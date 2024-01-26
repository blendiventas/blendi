<?php

unset($matriz_id_modalidades_pago);
unset($matriz_descripcion_modalidades_pago);
unset($matriz_explicacion_modalidades_pago);
unset($matriz_defecto_modalidades_pago);
unset($matriz_id_iva_modalidades_pago);
unset($matriz_incremento_pvp_modalidades_pago);
unset($matriz_incremento_por_modalidades_pago);

$select_sys = "numero-efectos";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-recibos.php");

$select_sys = "metodos-pago";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-metodos-pago.php");

$select_sys = "bancos-cajas";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-bancos-cajas.php");

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-modalidades.php");
unset($conn);

$descripcionCobro = 'cobro';
$descripcionCobrar = 'Cobrar';
if (isset($tipo_librador) && ($tipo_librador == 'pro' || $tipo_librador == 'cre')) {
    $descripcionCobro = 'pago';
    $descripcionCobrar = 'Pagar';
}
$documento_tipo = 'tícket';
if (isset($tipo_documento)) {
    if ($tipo_documento == 'alb') {
        $documento_tipo = 'albarán';
    }
    if ($tipo_documento == 'fac') {
        $documento_tipo = 'factura';
    }
    if ($tipo_documento == 'ped') {
        $documento_tipo = 'pedido';
    }
    if ($tipo_documento == 'pre') {
        $documento_tipo = 'presupuesto';
    }
}

$columnas = count($id_metodos_pago) + 1;
?>
<div class="grid grid-cols-1 font-semibold pb-4 justify-start items-center">
    <?php echo $descripcionCobrar; ?>
</div>
<div class="w-full text-xs">
    <input type="hidden" name="total_fraccionar" id="total_fraccionar" value="" />
    <div class="grid grid-cols-1 sm:grid-cols-5">
        <div class="px-2 col-span-2 overflow-y-auto <?php echo ($numero_recibos > 1)? 'hidden' : ''; ?>" style="max-height: 50vh; height: 50vh;">
            <!-- Selección de productos -->
            <div class="flex flex-wrap">
                <input type="checkbox" checked onclick="marcarProductosCobrar(this)" />
                <div class="ml-2">Todo</div>
            </div>
            <div id="capa-cobrar-por-producto">
                &nbsp;
            </div>
            <div class="flex">
                <div class="font-medium">
                    Importe a cobrar
                </div>
                <div class="text-right grow font-bold" id="capa_cobrar_dato_total"></div>
            </div>
        </div>
        <div class="px-2 sm:px-16 col-span-<?php echo ($numero_recibos > 1)? '5' : '3'; ?> overflow-y-auto" style="max-height: 50vh; height: 50vh;">
            <div class="flex flex-wrap items-center justify-center">

                <div class="items-center hidden" id="capa-cancelar-cobro-por-productos_0">
                    <div class="flex flex-wrap items-center rounded-lg border border-2 border-blendi-600 p-1">
                        <div class="grow font-bold">
                            Dividir entre comensales
                        </div>
                        <a href="#" id="sumar_dividir_cobro" class="mt-1 mb-1 mr-1 w-8 h-8 rounded-full text-white dark:text-black bg-blendi-600 dark:bg-blendidark-600" onclick="sumarDividirCobro('dividir_cobro_2');">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 pt-1 m-auto">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </a>
                        <input type="number" class="capa-img-producto-mini text-center" name="dividir_cobro_2" id="dividir_cobro_2" value="<?php echo (isset($comensales) && $comensales > 2 && $comensales < 101)? $comensales : '2'; ?>" min="2" max="100" />
                        <a href="#" id="restar_dividir_cobro" class="mt-1 mb-1 ml-1 w-8 h-8 rounded-full text-white dark:text-black bg-blendi-600 dark:bg-blendidark-600" onclick="restarDividirCobro('dividir_cobro_2');">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 pt-1 m-auto">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                            </svg>
                        </a>
                        <div class="text-left grow">
                            <?php
                            if($numero_recibos == 1) {
                                ?>
                                <button type="button" class="w-full hover:text-blendi-600 p-2" onclick="dividirCobro();">Dividir cobro</button>
                                <?php
                            }else{
                                ?>
                                <button type="button" class="w-full hover:text-blendi-600 p-2" onclick="unificarCobro();">Unificar cobro</button>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="text-center grow">
                            <a href="<?php echo $host_url.'cobrar'; ?>" class="w-full hover:text-blendi-600 p-2" title="<?php echo $librador_tipo." ".$documento_tipo; ?>">
                                Cancelar cobro por productos
                            </a>
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <div class="text-left" id="capa-boton-por_producto_cobro">
                        <?php
                        if($numero_recibos == 1) {
                            ?>
                            <button type="button" class="text-gray-650 bg-white border border-gray-650 font-medium px-5 py-2.5" onclick="porProductoCobro();">Cobrar por productos</button>
                            <?php
                        }else{
                            echo "&nbsp;";
                        }
                        ?>
                    </div>
                </div>
                <div class="text-right p-2 hidden">
                    <select class="w-full" id="id_modalidad_pago_cobrar" name="id_modalidad_pago_cobrar" onchange="identificar('6');" required>
                        <?php
                        if(isset($matriz_id_modalidades_pago)) {
                            foreach ($matriz_id_modalidades_pago as $key_modalidades_pago => $valor_modalidades_pago) {
                                $selected = "";
                                if($id_modalidades_pago == $valor_modalidades_pago) {
                                    $selected = " selected";
                                }
                                ?>
                                <option value="<?php echo $valor_modalidades_pago; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_modalidades_pago[$key_modalidades_pago]; ?></option>
                                <?php
                            }
                        }
                        unset($matriz_id_modalidades_pago);
                        unset($matriz_descripcion_modalidades_pago);
                        unset($matriz_explicacion_modalidades_pago);
                        unset($matriz_defecto_modalidades_pago);
                        unset($matriz_id_iva_modalidades_pago);
                        unset($matriz_incremento_pvp_modalidades_pago);
                        unset($matriz_incremento_por_modalidades_pago);
                        ?>
                    </select>
                </div>
                <div class="flex flex-wrap items-center rounded-lg border border-2 border-blendi-600 p-1">
                    <div class="grow w-full font-bold">
                        Dividir entre comensales
                    </div>
                    <?php
                    if($numero_recibos == 1) {
                        ?>
                        <div class="text-center" id="capa-dividir_cobro">
                            <div class="flex">
                                <a href="#" id="restar_dividir_cobro" class="mt-1 mb-1 mr-1 w-8 h-8 rounded-full text-white dark:text-black bg-blendi-600 dark:bg-blendidark-600" onclick="restarDividirCobro('dividir_cobro');">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 pt-1 m-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                    </svg>
                                </a>
                                <input type="number" class="capa-img-producto-mini border-0 bg-transparent w-10 p-0 text-center" name="dividir_cobro" id="dividir_cobro" value="<?php echo (isset($comensales) && $comensales > 2 && $comensales < 101)? $comensales : '2'; ?>" min="2" max="100" />
                                <a href="#" id="sumar_dividir_cobro" class="mt-1 mb-1 ml-1 w-8 h-8 rounded-full text-white dark:text-black bg-blendi-600 dark:bg-blendidark-600" onclick="sumarDividirCobro('dividir_cobro');">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 pt-1 m-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="text-center" id="capa-dividir_cobro">&nbsp;</div>
                        <?php
                    }
                    ?>
                    <div class="text-left ml-2 grow" id="capa-boton-dividir_cobro">
                        <?php
                        if($numero_recibos == 1) {
                            ?>
                            <button type="button" class="w-full text-white bg-gray-650 border border-gray-650 font-medium px-5 py-2.5" onclick="dividirCobro();">Crear recibos</button>
                            <?php
                        }else{
                            ?>
                            <button type="button" class="w-full text-white bg-gray-650 border border-gray-650 font-medium px-5 py-2.5" onclick="unificarCobro();">Unificar recibos</button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Opciones de cobro -->
            <input type="hidden" name="proximo_recibo_a_pagar" id="proximo_recibo_a_pagar" value="-1" />
            <?php
            for($bucle_recibos = 0 ; $bucle_recibos < $numero_recibos ; $bucle_recibos++) {
                ?>
                <input type="hidden" name="importe-cobrar_1_<?php echo $bucle_recibos; ?>" id="importe-cobrar_1_<?php echo $bucle_recibos; ?>" value="0.00" />
                <span id="capa-importe-cobrar_1_<?php echo $bucle_recibos; ?>" class="hidden">0.00</span>
                <input type="hidden" name="importe-cobrar_<?php echo $bucle_recibos; ?>" id="importe-cobrar_<?php echo $bucle_recibos; ?>" value="" />
                <span id="capa-importe-cobrar_<?php echo $bucle_recibos; ?>" class="hidden"></span>
                <div class="w-full" id="capa-datos-pago_realizado_<?php echo $bucle_recibos; ?>">
                    <div class="flex flex-wrap items-center justify-center">
                        <div class="p-2" id="capa-importe_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-vencimiento_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-efecto_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-documento_bancario_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-vencimiento_documento_bancario_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-nota_pagado_<?php echo $bucle_recibos; ?>"></div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="p-2" id="capa-fecha_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-banco_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-metodo_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-usuario_pagado_<?php echo $bucle_recibos; ?>"></div>
                        <div class="p-2" id="capa-impreso_pagado_<?php echo $bucle_recibos; ?>"></div>
                    </div>
                </div>

                <div class="mt-4 border-t-4 border-blendi-600" id="capa-documentos_pago_<?php echo $bucle_recibos; ?>">
                    <div class="hidden grow grid grid-cols-2 gap-2" id="capa-documentos_pago_1_<?php echo $bucle_recibos; ?>">
                        <div class="col-span-2 pt-3 flex flex-wrap space-x-2 justify-center ">
                            <?php
                            foreach ($id_metodos_pago as $key_metodos_pago => $valor_metodos_pago) {
                                ?>
                                <div class="p-2 rounded-lg border-2 <?php echo (empty($key_metodos_pago))? ((empty($darkMode))? 'border-blendi-600' : 'border-gray-300') : ((empty($darkMode))? 'border-gray-300' : 'border-blendi-600'); ?> bg-white flex items-center cursor-pointer metodo_pago_1_<?php echo $bucle_recibos; ?>" onclick="seleccionarMetodoDePago(this, 'metodo_pago_1_<?php echo $bucle_recibos; ?>');">
                                    <input type="radio" <?php echo (empty($key_metodos_pago))? 'checked' : ''; ?> name="id_metodo_pago_1_<?php echo $bucle_recibos; ?>" value="<?php echo $valor_metodos_pago; ?>">
                                    <div class="<?php echo (empty($key_metodos_pago))? '' : 'mr-10'; ?> descripcion_metodo_pago_1_<?php echo $bucle_recibos; ?>">
                                        <?php echo $descripcion_metodos_pago[$key_metodos_pago]; ?>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 <?php echo (empty($darkMode))? 'text-blendi-600' : 'text-gray-300'; ?> ml-3 check_metodo_pago_1_<?php echo $bucle_recibos; ?> <?php echo (empty($key_metodos_pago))? '' : 'hidden'; ?>">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div id="capa-datos-realizar_pago_1_<?php echo $bucle_recibos; ?>">
                            <div>
                                <div class="py-2">
                                    <label for="importe-entregado_1_<?php echo $bucle_recibos; ?>">Importe entregado</label>
                                </div>
                                <input type="number" class="text-center w-full" name="importe-entregado_1_<?php echo $bucle_recibos; ?>" id="importe-entregado_1_<?php echo $bucle_recibos; ?>" placeholder="Importe entregado" value="0.00" onchange="mostrarCambio_1('<?php echo $bucle_recibos; ?>');" onkeyup="mostrarCambio_1('<?php echo $bucle_recibos; ?>');" />
                            </div>
                            <div id="importe-cambio_1_<?php echo $bucle_recibos; ?>"></div>
                        </div>

                        <div>
                            <div>
                                <div class="py-2">
                                    <label>Cambio a devolver</label>
                                </div>
                                <div class="mt-2">
                                    x €
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="text-left font-medium py-2">
                                Imprimir <?php echo $documento_tipo; ?>
                            </div>
                            <div class="ml-2 text-left mt-2">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="imprimir_al_cobrar_1_<?php echo $bucle_recibos; ?>" id="imprimir_al_cobrar_1_<?php echo $bucle_recibos; ?>_si" value="1" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blendi-600 dark:peer-focus:ring-blendi-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blendi-600"></div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <div class="text-left font-medium py-2">
                                Enviar <?php echo $documento_tipo; ?>
                            </div>
                            <div class="ml-2 text-left mt-2">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="enviar_al_cobrar_1_<?php echo $bucle_recibos; ?>" id="enviar_al_cobrar_1_<?php echo $bucle_recibos; ?>_si" value="1" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blendi-600 dark:peer-focus:ring-blendi-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blendi-600"></div>
                                </label>
                            </div>
                            <div class="mt-2">
                                <input type="text" class="text-center w-full hidden" name="enviar_al_cobrar_mail_1_<?php echo $bucle_recibos; ?>" id="enviar_al_cobrar_mail_1_<?php echo $bucle_recibos; ?>" placeholder="Email" value="<?php echo $email; ?>" />
                            </div>
                        </div>

                        <div id="capa-documento_bancario_1_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca')) {
                                    ?>
                                    <input type="hidden" name="documento_bancario_1_<?php echo $bucle_recibos; ?>" id="documento_bancario_1_<?php echo $bucle_recibos; ?>" value="" />
                                    <?php
                                } else {
                                    ?>
                                    <div class="py-2">
                                        <label for="documento_bancario_1_<?php echo $bucle_recibos; ?>">Documento bancario</label>
                                    </div>
                                    <input type="text" name="documento_bancario_1_<?php echo $bucle_recibos; ?>" id="documento_bancario_1_<?php echo $bucle_recibos; ?>" class="w-full" value="" />
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="capa-vencimiento_documento_bancario_1_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca')) {
                                    ?>
                                    <input type="hidden" name="vencimiento_documento_bancario_1_<?php echo $bucle_recibos; ?>" id="vencimiento_documento_bancario_1_<?php echo $bucle_recibos; ?>" value="" />
                                    <?php
                                } else {
                                    ?>
                                    <div class="py-2">
                                        <label for="vencimiento_documento_bancario_1_<?php echo $bucle_recibos; ?>">Vencimiento d. bancario</label>
                                    </div>
                                    <input type="date" name="vencimiento_documento_bancario_1_<?php echo $bucle_recibos; ?>" id="vencimiento_documento_bancario_1_<?php echo $bucle_recibos; ?>" class="w-full" value="" />
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="capa-fecha_pago_1_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if ((isset($tipo_documento) && $tipo_documento == 'fac') || (isset($tipo_documento) && isset($tipo_librador) && $tipo_documento == 'tiq' && ($tipo_librador == 'pro' || $tipo_librador == 'cre'))) {
                                    $tipoFecha = 'cobro';
                                    if (isset($tipo_librador) && ($tipo_librador == 'pro' || $tipo_librador == 'cre')) {
                                        $tipoFecha = 'pago';
                                    }
                                    ?>
                                    <div class="py-2">
                                        <label for="fecha_pago_1_<?php echo $bucle_recibos; ?>">Fecha de <?php echo $tipoFecha; ?></label>
                                    </div>
                                    <input type="date" name="fecha_pago_1_<?php echo $bucle_recibos; ?>" id="fecha_pago_1_<?php echo $bucle_recibos; ?>" class="w-full" value="" />
                                    <?php
                                } else {
                                    ?>
                                    <input type="hidden" name="fecha_pago_1_<?php echo $bucle_recibos; ?>" id="fecha_pago_1_<?php echo $bucle_recibos; ?>" value="" />
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="capa-nota_1_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca')) {
                                    ?>
                                    <input type="hidden" name="nota_1_<?php echo $bucle_recibos; ?>" id="nota_1_<?php echo $bucle_recibos; ?>" value="" />
                                    <?php
                                } else {
                                    ?>
                                    <div class="py-2">
                                        <label for="nota_1_<?php echo $bucle_recibos; ?>">Nota</label>
                                    </div>
                                    <textarea name="nota_1_<?php echo $bucle_recibos; ?>" id="nota_1_<?php echo $bucle_recibos; ?>"></textarea>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="capa-banco_pago_1_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if (count($id_bancos_cajas) === 1) {
                                    ?>
                                    <input type="hidden" name="id_banco_cobro_1_<?php echo $bucle_recibos; ?>" id="id_banco_cobro_1_<?php echo $bucle_recibos; ?>" value="<?php echo $id_bancos_cajas[0]; ?>" />
                                    <?php
                                } else {
                                    ?>
                                    <div class="py-2">
                                        <label for="id_banco_cobro_1_<?php echo $bucle_recibos; ?>">Caja</label>
                                    </div>
                                    <select class="w-full" name="id_banco_cobro_1_<?php echo $bucle_recibos; ?>" id="id_banco_cobro_1_<?php echo $bucle_recibos; ?>">
                                        <?php
                                        foreach ($id_bancos_cajas as $key_bancos_cajas => $valor_bancos_cajas) {
                                            $selected = "";
                                            if($valor_bancos_cajas == $id_banco_cobro) {
                                                $selected = " selected";
                                            }
                                            $iban = "";
                                            if(!empty($iban_bancos_cajas[$key_bancos_cajas])) {
                                                $iban = " (IBAN: ".$iban_bancos_cajas[$key_bancos_cajas].")";
                                            }
                                            ?>
                                            <option value="<?php echo $valor_bancos_cajas; ?>"<?php echo $selected; ?>><?php echo $descripcion_bancos_cajas[$key_bancos_cajas].$iban; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-center" id="capa_productos_cobro_1_<?php echo $bucle_recibos; ?>"></div>
                        <!--
                        FIN Capas replicadas para cobro por productos
                        -->
                        <div class="flex flex-wrap items-center justify-center" id="capaImprimirCrear_1_<?php echo $bucle_recibos; ?>"></div>
                    </div>

                    <div class="grow grid grid-cols-2 gap-2">
                        <!--
                        Capas a replicar para cobro por productos
                        -->
                        <div class="col-span-2 pt-3 flex flex-wrap space-x-2 justify-center " id="capa-botones-metodos_pago_ejecutar_<?php echo $bucle_recibos; ?>">
                            <?php
                            foreach ($id_metodos_pago as $key_metodos_pago => $valor_metodos_pago) {
                                ?>
                                <div class="p-2 rounded-lg border-2 <?php echo (empty($key_metodos_pago))? ((empty($darkMode))? 'border-blendi-600' : 'border-gray-300') : ((empty($darkMode))? 'border-gray-300' : 'border-blendi-600'); ?> bg-white flex items-center cursor-pointer metodo_pago_<?php echo $bucle_recibos; ?>" onclick="seleccionarMetodoDePago(this, 'metodo_pago_<?php echo $bucle_recibos; ?>');">
                                    <input type="radio" <?php echo (empty($key_metodos_pago))? 'checked' : ''; ?> name="id_metodo_pago_<?php echo $bucle_recibos; ?>" value="<?php echo $valor_metodos_pago; ?>" class="hidden">
                                    <div class="<?php echo (empty($key_metodos_pago))? '' : 'mr-10'; ?> descripcion_metodo_pago_<?php echo $bucle_recibos; ?>">
                                        <?php echo $descripcion_metodos_pago[$key_metodos_pago]; ?>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 <?php echo (empty($darkMode))? 'text-blendi-600' : 'text-gray-300'; ?> ml-3 check_metodo_pago_<?php echo $bucle_recibos; ?> <?php echo (empty($key_metodos_pago))? '' : 'hidden'; ?>">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="w-full" id="capa-datos-realizar_pago_<?php echo $bucle_recibos; ?>">
                            <div>
                                <div class="py-2">
                                    <label for="importe-entregado_<?php echo $bucle_recibos; ?>">Importe entregado</label>
                                </div>
                                <input type="number" class="text-center w-full" name="importe-entregado_<?php echo $bucle_recibos; ?>" id="importe-entregado_<?php echo $bucle_recibos; ?>" placeholder="Importe entregado" value="" onchange="mostrarCambio('<?php echo $bucle_recibos; ?>');" onkeyup="mostrarCambio('<?php echo $bucle_recibos; ?>');" />
                            </div>
                        </div>

                        <div id="capa-botones-cambio_a_devolver_<?php echo $bucle_recibos; ?>">
                            <div>
                                <div class="py-2">
                                    <label>Cambio a devolver</label>
                                </div>
                                <div class="mt-2" id="importe-cambio_<?php echo $bucle_recibos; ?>"></div>
                            </div>
                        </div>

                        <div id="capa-botones-imprimir_pago_<?php echo $bucle_recibos; ?>">
                            <div class="text-left font-medium py-2">
                                Imprimir <?php echo $documento_tipo; ?>
                            </div>
                            <div class="text-left mt-2">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="imprimir_al_cobrar_<?php echo $bucle_recibos; ?>" id="imprimir_al_cobrar_si_<?php echo $bucle_recibos; ?>" value="1" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blendi-600 dark:peer-focus:ring-blendi-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blendi-600"></div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <div class="text-left font-medium py-2">
                                Enviar <?php echo $documento_tipo; ?>
                            </div>
                            <div class="text-left mt-2">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="enviar_al_cobrar_<?php echo $bucle_recibos; ?>" id="enviar_al_cobrar_si_<?php echo $bucle_recibos; ?>" value="1" onchange="collapseMenu('enviar_al_cobrar_mail_<?php echo $bucle_recibos; ?>');" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blendi-600 dark:peer-focus:ring-blendi-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blendi-600"></div>
                                </label>
                            </div>
                            <div class="mt-2">
                                <input type="text" class="text-center w-full hidden" name="enviar_al_cobrar_mail_<?php echo $bucle_recibos; ?>" id="enviar_al_cobrar_mail_<?php echo $bucle_recibos; ?>" placeholder="Email" value="<?php echo $email; ?>" />
                            </div>
                        </div>

                        <div id="capa-documento_bancario_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca')) {
                                    ?>
                                    <input type="hidden" name="documento_bancario_<?php echo $bucle_recibos; ?>" id="documento_bancario_<?php echo $bucle_recibos; ?>" value="" />
                                    <?php
                                } else {
                                    ?>
                                    <div class="py-2">
                                        <label for="documento_bancario_<?php echo $bucle_recibos; ?>">Documento bancario</label>
                                    </div>
                                    <input type="text" name="documento_bancario_<?php echo $bucle_recibos; ?>" id="documento_bancario_<?php echo $bucle_recibos; ?>" class="w-full" value="" />
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="capa-vencimiento_documento_bancario_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca')) {
                                    ?>
                                    <input type="hidden" name="vencimiento_documento_bancario_<?php echo $bucle_recibos; ?>" id="vencimiento_documento_bancario_<?php echo $bucle_recibos; ?>" value="" />
                                    <?php
                                } else {
                                    ?>
                                    <div class="py-2">
                                        <label for="vencimiento_documento_bancario_<?php echo $bucle_recibos; ?>">Vencimiento d. bancario</label>
                                    </div>
                                    <input type="date" name="vencimiento_documento_bancario_<?php echo $bucle_recibos; ?>" id="vencimiento_documento_bancario_<?php echo $bucle_recibos; ?>" class="w-full" value="" />
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="capa-fecha_pago_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if ((isset($tipo_documento) && $tipo_documento == 'fac') || (isset($tipo_documento) && isset($tipo_librador) && $tipo_documento == 'tiq' && ($tipo_librador == 'pro' || $tipo_librador == 'cre'))) {
                                    $tipoFecha = 'cobro';
                                    if (isset($tipo_librador) && ($tipo_librador == 'pro' || $tipo_librador == 'cre')) {
                                        $tipoFecha = 'pago';
                                    }
                                    ?>
                                    <div class="py-2">
                                        <label for="fecha_pago_<?php echo $bucle_recibos; ?>">Fecha de <?php echo $tipoFecha; ?></label>
                                    </div>
                                    <input type="date" name="fecha_pago_<?php echo $bucle_recibos; ?>" id="fecha_pago_<?php echo $bucle_recibos; ?>" class="w-full" value="" />
                                    <?php
                                } else {
                                    ?>
                                    <input type="hidden" name="fecha_pago_<?php echo $bucle_recibos; ?>" id="fecha_pago_<?php echo $bucle_recibos; ?>" value="" />
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="capa-nota_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca')) {
                                    ?>
                                    <input type="hidden" name="nota_<?php echo $bucle_recibos; ?>" id="nota_<?php echo $bucle_recibos; ?>" value="" />
                                    <?php
                                } else {
                                    ?>
                                    <div class="py-2">
                                        <label for="nota_<?php echo $bucle_recibos; ?>">Nota</label>
                                    </div>
                                    <textarea name="nota_<?php echo $bucle_recibos; ?>" id="nota_<?php echo $bucle_recibos; ?>" class="w-full"></textarea>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div id="capa-banco_pago_<?php echo $bucle_recibos; ?>">
                            <div>
                                <?php
                                if (count($id_bancos_cajas) === 1) {
                                    ?>
                                    <input type="hidden" name="id_banco_cobro_<?php echo $bucle_recibos; ?>" id="id_banco_cobro_<?php echo $bucle_recibos; ?>" value="<?php echo $id_bancos_cajas[0]; ?>" />
                                    <?php
                                } else {
                                    ?>
                                    <div class="py-2">
                                        <label for="id_banco_cobro_<?php echo $bucle_recibos; ?>">Caja</label>
                                    </div>
                                    <select class="w-full" name="id_banco_cobro_<?php echo $bucle_recibos; ?>" id="id_banco_cobro_<?php echo $bucle_recibos; ?>">
                                        <?php
                                        foreach ($id_bancos_cajas as $key_bancos_cajas => $valor_bancos_cajas) {
                                            $selected = "";
                                            if($valor_bancos_cajas == $id_banco_cobro) {
                                                $selected = " selected";
                                            }
                                            $iban = "";
                                            if(!empty($iban_bancos_cajas[$key_bancos_cajas])) {
                                                $iban = " (IBAN: ".$iban_bancos_cajas[$key_bancos_cajas].")";
                                            }
                                            ?>
                                            <option value="<?php echo $valor_bancos_cajas; ?>"<?php echo $selected; ?>><?php echo $descripcion_bancos_cajas[$key_bancos_cajas].$iban; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="text-right grow" id="capa_productos_cobro_<?php echo $bucle_recibos; ?>"></div>
                        <!--
                        FIN Capas a replicar para cobro por productos
                        -->
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTituloCobrarModal('<?php echo (empty($librador_comercial))? $librador_nombre : $librador_comercial; ?>');
    productosCobro();
</script>