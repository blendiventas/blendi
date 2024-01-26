<div class="row-cesta">
    <?php
    $clase = " class='hidden mt-4'";
    if(($tipo_librador == "pro" || $tipo_librador == "cre") && empty($numero_documento)) {
        $clase = " class='mt-4'";
    }
    $clase_botones_datos = '';
    if($id_usuario != 1) {
        $clase_botones_datos = ' hidden';
    }
    ?>
    <div class="flex items-center p-3 bg-gray-50">
        <button class="button-documento<?php echo $clase_botones_datos; ?> grow" onclick="collapseMenu('capa-datos-cabecera-documento'); return false;">
            Datos del documento
        </button>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" id="capa-datos-cabecera-documento-show" onclick="collapseMenu('capa-datos-cabecera-documento'); return false;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer hidden" id="capa-datos-cabecera-documento-hidden" onclick="collapseMenu('capa-datos-cabecera-documento'); return false;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <?php
        if($interface == "tpv" && $id_usuario == 1 && $tipo_librador != "mes") {
            ?>
            <div class="w-4 ml-2">&nbsp;</div>
            <?php
        }
        ?>
    </div>
    <div<?php echo $clase; ?> id="capa-datos-cabecera-documento">
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            <?php
            if(($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") && empty($numero_documento)) {
                ?>
                <div class="grid-2-cesta">
                    <div class="row text-left input-cesta">
                        <strong>Serie:</strong>
                    </div>
                    <div class="row text-left">
                        <input type="text" class="sin-borde input-cesta w-full" disabled name="serie_documento_fijo" id="serie_documento_fijo" value="<?php echo $serie_documento; ?>" />
                    </div>
                </div>
                <?php
            }else {
                ?>
                <input type="hidden" name="serie_documento" id="serie_documento" value="<?php echo $serie_documento; ?>" />
                <?php
            }
            ?>
            <div class="grid-2-cesta">
                <div class="row text-left input-cesta">
                    <strong>Número:</strong>
                </div>
                <div class="row text-left">
                    <?php
                    if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                        ?>
                        <input type="text" class="sin-borde input-cesta w-full" disabled name="numero_documento_fijo" id="numero_documento_fijo" value="<?php echo $numero_documento; ?>" />
                        <input type="hidden" name="numero_documento" id="numero_documento" value="<?php echo $numero_documento; ?>" />
                        <?php
                    } else {
                        ?>
                        <input type="text" class="sin-borde input-cesta w-full" name="numero_documento" id="numero_documento" value="<?php echo $numero_documento; ?>" />
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="grid-1 color-red" id="numero_aviso" style="display: none;">
                <div class="row">
                    Introducir número de documento.
                </div>
            </div>
            <div class="grid-2-cesta">
                <div class="row text-left input-cesta">
                    <strong>Fecha <span id="span_fecha_tipo_documento"></span>:</strong>
                </div>
                <div class="row text-left">
                    <input type="date" class="sin-borde input-cesta w-full" name="fecha_documento" id="fecha_documento" value="<?php echo $fecha_documento; ?>" />
                </div>
            </div>
            <div class="grid-1 hidden color-red" id="fecha_aviso" style="display: none;">
                <div class="row">
                    Introducir fecha de documento.
                </div>
            </div>
            <?php
            if ($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") {
                ?>
                <div class="grid-2-cesta">
                    <input type="hidden" name="fecha_entrada" id="fecha_entrada" value="<?php echo $fecha_entrada; ?>" />
                </div>
                <?php
            } else {
                ?>
                <div class="grid-2-cesta">
                    <div class="row text-left input-cesta">
                        <strong>Fecha entrada:</strong>
                    </div>
                    <div class="row text-left">
                        <input type="date" class="sin-borde input-cesta w-full" name="fecha_entrada" id="fecha_entrada" value="<?php echo $fecha_entrada; ?>" />
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="grid-2-cesta">
                <div class="row text-left input-cesta">
                    <strong>Modalidad pago:</strong>
                </div>
                <div class="row text-left">
                    <!--<select class="w-96" id="id_modalidad_pago" name="id_modalidad_pago" onchange="identificar('5');" required> -->
                    <select class="w-full" id="id_modalidad_pago" name="id_modalidad_pago">
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
                            unset($matriz_id_modalidades_pago);
                            unset($matriz_descripcion_modalidades_pago);
                            unset($matriz_explicacion_modalidades_pago);
                            unset($matriz_defecto_modalidades_pago);
                            unset($matriz_id_iva_modalidades_pago);
                            unset($matriz_incremento_pvp_modalidades_pago);
                            unset($matriz_incremento_por_modalidades_pago);
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            if($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") {
                ?>
                <div class="grid-2-cesta">
                    <div class="row text-left input-cesta">
                        <strong>Modalidad envio:</strong>
                    </div>
                    <div class="row text-left">
                        <?php
                        $hiden_span = " hidden";
                        $hiden = "";
                        if($id_modalidades_entrega == 1) {
                            $hiden_span = "";
                            $hiden = " hidden";
                        }
                        ?>
                        <span class="<?php echo $hiden_span; ?>" id="id_modalidad_sin_envio">Sin envio</span>
                        <!--<select class="w-96<?php echo $hiden; ?>" id="id_modalidad_envio" name="id_modalidad_envio" onchange="identificar('5');"> -->
                        <select class="w-full <?php echo $hiden; ?>" id="id_modalidad_envio" name="id_modalidad_envio">
                            <?php
                            if(isset($matriz_id_modalidades_envio)) {
                                foreach ($matriz_id_modalidades_envio as $key_modalidades_envio => $valor_modalidades_envio) {
                                    $selected = "";
                                    if($id_modalidades_envio == $valor_modalidades_envio) {
                                        $selected = " selected";
                                    }
                                    ?>
                                    <option value="<?php echo $valor_modalidades_envio; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_modalidades_envio[$key_modalidades_envio]; ?></option>
                                    <?php
                                }
                                unset($matriz_id_modalidades_envio);
                                unset($matriz_descripcion_modalidades_envio);
                                unset($matriz_explicacion_modalidades_envio);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="grid-2-cesta">
                    <div class="row text-left input-cesta">
                        <strong>Modalidad entrega:</strong>
                    </div>
                    <div class="row text-left">
                        <!-- <select class="w-96" id="id_modalidad_entrega" name="id_modalidad_entrega" onchange="mostrarCapasEnvio(this.value); identificar('5');"> -->
                        <select class="w-full" id="id_modalidad_entrega" name="id_modalidad_entrega" onchange="mostrarCapasEnvio(this.value);">
                            <?php
                            if(isset($matriz_id_modalidades_entrega)) {
                                foreach ($matriz_id_modalidades_entrega as $key_modalidades_entrega => $valor_modalidades_entrega) {
                                    $selected = "";
                                    if($id_modalidades_entrega == $valor_modalidades_entrega) {
                                        $selected = " selected";
                                    }
                                    ?>
                                    <option value="<?php echo $valor_modalidades_entrega; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_modalidades_entrega[$key_modalidades_entrega]; ?></option>
                                    <?php
                                }
                                unset($matriz_id_modalidades_entrega);
                                unset($matriz_descripcion_modalidades_entrega);
                                unset($matriz_explicacion_modalidades_entrega);
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
            }else {
                ?>
                <span class="hidden" id="id_modalidad_sin_envio"></span>
                <input type="hidden" id="id_modalidad_envio" name="id_modalidad_envio" value="0" />
                <input type="hidden" id="id_modalidad_entrega" name="id_modalidad_entrega" value="0" />
                <?php
            }
            /*
            CREATE TABLE `libradores` (
                `id_iva` INT(11) NOT NULL DEFAULT '0',
                `recargo` TINYINT(1) NOT NULL DEFAULT '0',
                `id_irpf` INT(11) NOT NULL DEFAULT '0',
                `descuento_pp` DOUBLE(7,2) NULL DEFAULT '0.00',
                `descuento_librador` DOUBLE(7,2) NULL DEFAULT '0.00',
                `id_tarifa_web` INT(11) NULL DEFAULT '0',
                `id_tarifa_tpv` INT(11) NULL DEFAULT '0',
                `id_banco_cobro` INT(11) NOT NULL DEFAULT '0',
            */
            ?>
            <input type="hidden" name="check_recargo_documento_cesta" id="check_recargo_documento_cesta" value="<?php echo $recargo; ?>" />
            <input type="hidden" name="irpf_documento_cesta" id="irpf_documento_cesta" value="<?php echo $irpf_librador; ?>" />
            <input type="hidden" name="descuento_pp_documento_cesta" id="descuento_pp_documento_cesta" value="<?php echo $descuento_pp; ?>" />
            <input type="hidden" name="descuento_librador_documento_cesta" id="descuento_librador_documento_cesta" value="<?php echo $descuento_librador; ?>" />
        </div>
        <div class="grid-2-cesta grid grid-cols-2 gap-4 mt-5">
            <div class="row text-left">
                <input type="checkbox" name="check_guardar_datos_documento_cesta" id="check_guardar_datos_documento_cesta" checked disabled /> Actualizar ficha.
            </div>
            <div class="row">
                <button class="button-documento hover:text-blendi-600 hover:underline" onclick="identificar('5');">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>
