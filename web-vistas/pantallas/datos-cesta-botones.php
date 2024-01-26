<?php
if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") { $librador_tipo = "Cobrar"; }else
{ $librador_tipo = "Pagar"; }

if($tipo_documento == "pre") { $documento_tipo = "presupuesto"; }else
if($tipo_documento == "ped") { $documento_tipo = "pedido"; }else
if($tipo_documento == "alb") { $documento_tipo = "albarán"; }else
if($tipo_documento == "fac") { $documento_tipo = "factura"; }else
if($tipo_documento == "tiq") { $documento_tipo = "tiquet"; }
if($mostrar_cesta == "superior") {
    ?>
    <div class="grid grid-cols-4" id="capa_cabecera_botones_cesta">
        <div class="row-cesta borders-documentos flex space-x-4" id="capa-boton-cesta-cobrar">
            <?php
            if(($tipo_documento == "fac" || $tipo_documento == "tiq") && $lineas_documento > 0) {
                $select_sys = "metodos-pago";
                require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-metodos-pago.php");
                ?>
                <a href="#" data-modal-toggle="capa-cobrar-modal" onclick="cobrarModal()" class="botones-cesta-link" title="<?php echo $librador_tipo." ".$documento_tipo; ?>">
                    <?php echo $librador_tipo; ?>
                </a>
                <?php
                foreach ($id_metodos_pago as $key_metodo_pago => $id_metodo_pago) {
                    if ($directo_metodos_pago[$key_metodo_pago] == 1) {
                        ?>
                        <a href="#" onclick="cobrarDocumentoEjecutarDirecto(<?php echo $id_metodo_pago; ?>)" class="botones-cesta-link" title="<?php echo $librador_tipo." ".$documento_tipo; ?> directo">
                            <?php echo $descripcion_metodos_pago[$key_metodo_pago]; ?>
                        </a>
                        <?php
                    }
                }
                unset($id_metodos_pago);
                unset($descripcion_metodos_pago);
                unset($explicacion_metodos_pago);
                unset($prioritario_metodos_pago);
                unset($id_iva_metodos_pago);
                unset($incremento_pvp_metodos_pago);
                unset($incremento_por_metodos_pago);
                unset($ruta_metodos_pago);
                unset($sistema_metodos_pago);
                unset($imagen_metodos_pago);
                unset($updated_metodos_pago);
                unset($directo_metodos_pago);
            }else {
                echo "&nbsp;";
            }
            ?>
        </div>
        <div class="row-cesta borders-documentos">
            <?php
            if($tipo_documento == "ped" && $interface == "web" && $lineas_documento > 0) {
                ?>
                <a href="<?php echo $host_url.'enviar_pedido'; ?>" class="botones-cesta-link" title="<?php echo "Enviar"; ?>">
                    <?php echo "Enviar ".$documento_tipo; ?>
                </a>
                <?php
            }else {
                echo "&nbsp;";
            }
            ?>
        </div>
    </div>
    <?php
}else {
    $select_sys = "metodos-pago";
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-metodos-pago.php");

    $columnsToBasketButtons = 0;
    if ($sector == "restauracion" && isset($m_cocina) && !empty($m_cocina)) {
        $columnsToBasketButtons++;
        $columnsToBasketButtons++;
    }
    if($tipo_documento == "fac" || $tipo_documento == "tiq") {
        $columnsToBasketButtons++;
        $columnsToBasketButtons++;
    }
    if($tipo_librador == "pro" && ($tipo_documento == "alb" || $tipo_documento == "fac" || $tipo_documento == "tiq")) {
        $columnsToBasketButtons++;
        $columnsToBasketButtons++;
    }
    foreach ($id_metodos_pago as $key_metodo_pago => $id_metodo_pago) {
        if ($directo_metodos_pago[$key_metodo_pago] == 1) {
            $columnsToBasketButtons++;
            $columnsToBasketButtons++;
        }
    }
    ?>
    <div class="grid grid-cols-<?php echo $columnsToBasketButtons; ?> items-center">
        <div id="capa_cabecera_botones_inactividad" style="position: absolute; width: 100%; height: 100%; z-index: 1000;" <?php if($lineas_documento > 0) { ?>class="hidden"<?php } ?>>
            &nbsp;
        </div>
        <?php
        if ($sector == "restauracion" && isset($m_cocina) && !empty($m_cocina)) {
            if($tipo_documento == "fac" || $tipo_documento == "tiq") {
                ?>
                <div class="text-center mt-2 mx-1 col-span-2" id="capa_cabecera_botones_cesta_1">
                    <div class="row-cesta" id="capa-boton-cesta-cobrar">
                        <a href="#" data-modal-toggle="capa-cobrar-modal" onclick="cobrarModal()" class="botones-cesta-link block w-full text-gray-650 bg-white border border-gray-650 text-xs font-medium px-1 py-2.5" title="<?php echo $librador_tipo; ?>">
                            <?php echo $librador_tipo; ?>
                        </a>
                    </div>
                </div>
                <?php
                foreach ($id_metodos_pago as $key_metodo_pago => $id_metodo_pago) {
                    if ($directo_metodos_pago[$key_metodo_pago] == 1) {
                        ?>
                        <div class="text-center mt-2 mx-1 col-span-2 capa_cabecera_botones_cesta_directos">
                            <div class="row-cesta">
                                <a href="#" onclick="cobrarDocumentoEjecutarDirecto(<?php echo $id_metodo_pago; ?>)" class="botones-cesta block w-full text-white bg-gray-650 border border-gray-650 text-xs font-medium px-1 py-2.5 flex items-center space-x-2 text-center justify-center" title="<?php echo $librador_tipo; ?> directo">
                                    <div>
                                        <?php echo $descripcion_metodos_pago[$key_metodo_pago]; ?>
                                    </div>
                                    <?php
                                    if ($descripcion_metodos_pago[$key_metodo_pago] == 'Efectivo') {
                                        ?>
                                        <div class="font-bold text-xl" style="line-height: 10px;">
                                            €
                                        </div>
                                        <?php
                                    }
                                    if ($descripcion_metodos_pago[$key_metodo_pago] == 'Tarjeta' || $descripcion_metodos_pago[$key_metodo_pago] == 'Targeta') {
                                        ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                        <?php
                                    }
                                    ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            if($tipo_librador == "pro" && ($tipo_documento == "alb" || $tipo_documento == "fac" || $tipo_documento == "tiq")) {
                ?>
                <div class="text-center mt-2 mx-1 col-span-2" id="capa_cabecera_botones_cesta_3">
                    <div class="row-cesta">
                        <a href="#" class="botones-cesta block w-full text-gray-650 bg-white border border-gray-650 text-xs font-medium px-1 py-2.5 text-center" onclick="imprimirEtiquetaPDF(idDocumento,ejercicio);">Etiquetas</a>
                    </div>
                </div>
                <?php
            }
            if(($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") && $tipo_documento == "tiq") {
                $colorEnviar = (empty($darkMode))? '#ffffff' : '#4F4F4F';
                ?>
                <div class="text-center mt-2 mx-1 col-span-2" id="capa_cabecera_botones_cesta_4">
                    <div class="row-cesta">
                        <a href="#" class="botones-cesta block w-full text-white bg-gray-650 border border-gray-650 text-xs font-medium px-1 py-1.5  flex items-center space-x-2 text-center justify-center" onclick="cerrarDocumento(<?php echo ($sector == "restauracion" && isset($m_cocina) && !empty($m_cocina))? 'true' : 'false'; ?>)">
                            <div>
                                Enviar
                            </div>
                            <svg enable-background="new 0 0 85 85" height="24px" id="Layer_1" version="1.1" viewBox="0 0 85 85" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="text-white" style="line-height: 10px;">
                                <g><path d="   M52.305,42.506c1.85,1.08,4.002,1.699,6.297,1.699c6.906,0,12.504-5.597,12.504-12.503c0-6.903-5.598-12.502-12.504-12.502   c-1.521,0-3.134,0.226-4.485,0.724c-1.939-4.391-6.483-7.501-11.593-7.501c-5.178,0-9.702,3.034-11.599,7.523   c-1.35-0.498-3.005-0.746-4.528-0.746c-6.904,0-12.502,5.599-12.502,12.502c0,6.906,5.598,12.503,12.502,12.503   c2.295,0,4.447-0.619,6.297-1.699" fill="none" stroke="<?php echo $colorEnviar; ?>" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5"/><polyline fill="none" points="58.565,48.773 58.565,72.578    26.435,72.578 26.435,48.773  " stroke="<?php echo $colorEnviar; ?>" stroke-miterlimit="10" stroke-width="2.5"/><line fill="none" stroke="<?php echo $colorEnviar; ?>" stroke-miterlimit="10" stroke-width="2.5" x1="26.633" x2="58.367" y1="64.424" y2="64.424"/><g><line fill="none" stroke="<?php echo $colorEnviar; ?>" stroke-miterlimit="10" stroke-width="2.5" x1="35.598" x2="35.598" y1="64.326" y2="48.773"/><line fill="none" stroke="<?php echo $colorEnviar; ?>" stroke-miterlimit="10" stroke-width="2.5" x1="42.5" x2="42.5" y1="64.326" y2="48.773"/><line fill="none" stroke="<?php echo $colorEnviar; ?>" stroke-miterlimit="10" stroke-width="2.5" x1="49.402" x2="49.402" y1="64.326" y2="48.773"/></g></g>
                            </svg>
                        </a>
                    </div>
                </div>
                <?php
            }
        } else {
            if($tipo_documento == "fac" || $tipo_documento == "tiq") {
                ?>
                <div class="text-center mt-2 mx-1 col-span-2" id="capa_cabecera_botones_cesta_1">
                    <div class="row-cesta" id="capa-boton-cesta-cobrar">
                        <a href="#" data-modal-toggle="capa-cobrar-modal" onclick="cobrarModal()" class="botones-cesta-link block w-full text-white bg-gray-650 border border-gray-650 text-xs font-medium px-1 py-2.5" title="<?php echo $librador_tipo; ?>">
                            <?php echo $librador_tipo; ?>
                        </a>
                    </div>
                </div>
                <?php
                foreach ($id_metodos_pago as $key_metodo_pago => $id_metodo_pago) {
                    if ($directo_metodos_pago[$key_metodo_pago] == 1) {
                        ?>
                        <div class="text-center mt-2 mx-1 capa_cabecera_botones_cesta_directos">
                            <div class="row-cesta">
                                <a href="#" onclick="cobrarDocumentoEjecutarDirecto(<?php echo $id_metodo_pago; ?>)" class="botones-cesta block w-full text-white bg-gray-650 border border-gray-650 text-xs font-medium px-1 py-2.5 flex space-x-2 items-center text-center justify-center" title="<?php echo $librador_tipo; ?> directo">
                                    <div>
                                        <?php echo $descripcion_metodos_pago[$key_metodo_pago]; ?>
                                    </div>
                                    <?php
                                    if ($descripcion_metodos_pago[$key_metodo_pago] == 'Efectivo') {
                                        ?>
                                        <div class="font-bold text-xl" style="line-height: 10px;">
                                            €
                                        </div>
                                        <?php
                                    }
                                    if ($descripcion_metodos_pago[$key_metodo_pago] == 'Tarjeta' || $descripcion_metodos_pago[$key_metodo_pago] == 'Targeta') {
                                        ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                        </svg>
                                        <?php
                                    }
                                    ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            if($tipo_librador == "pro" && ($tipo_documento == "alb" || $tipo_documento == "fac" || $tipo_documento == "tiq")) {
                ?>
                <div class="text-center mt-2 mx-1 col-span-2" id="capa_cabecera_botones_cesta_3">
                    <div class="row-cesta">
                        <a href="#" class="botones-cesta block w-full text-gray-650 bg-white border border-gray-650 text-xs font-medium px-1 py-2.5" onclick="imprimirEtiquetaPDF(idDocumento,ejercicio);">Etiquetas</a>
                    </div>
                </div>
                <?php
            }
        }
        unset($id_metodos_pago);
        unset($descripcion_metodos_pago);
        unset($explicacion_metodos_pago);
        unset($prioritario_metodos_pago);
        unset($id_iva_metodos_pago);
        unset($incremento_pvp_metodos_pago);
        unset($incremento_por_metodos_pago);
        unset($ruta_metodos_pago);
        unset($sistema_metodos_pago);
        unset($imagen_metodos_pago);
        unset($updated_metodos_pago);
        unset($directo_metodos_pago);
        ?>
    </div>
    <?php
}