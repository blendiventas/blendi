<?php
unset($select_sys);
unset($id_librador);
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-otros-documentos.php");

if ($select_sys == 'fecha-hora-cierre-caja') {
    foreach ($datos_cierre_terminales as $terminal) {
        if ($terminal->importe == '0') {
            continue;
        }
        ?>
        <div class="bg-white" style="border: 1px solid grey;
            border-radius: 8px;
            margin-left: 1%;
            margin-right: 1%;
            padding: 1%;
            margin-bottom: 5px;">
            <div style="position:relative;">
                <div style="position:relative; float: left; font-weight: bold;">
                    <?php echo $terminal->terminal; ?>
                </div>
                <div style="position:relative; float: right;">
                    <?php echo number_format($terminal->importe, 2, ',', '.'); ?> €
                </div>
                <div style="clear: both;"></div>
            </div>
            <?php
            foreach ($terminal->bancos as $banco) {
                foreach ($banco->modalidades as $modalidad) {
                    if ($modalidad->importe == '0') {
                        continue;
                    }
                    ?>
                    <hr />
                    <div style="position:relative;">
                        <div style="position:relative; float: left; font-weight: bold;">
                            <?php echo $banco->banco . ' / ' . $modalidad->modalidad; ?>
                        </div>
                        <div style="position:relative; float: right;">
                            <?php echo number_format($modalidad->importe, 2, ',', '.'); ?> €
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <?php
                    foreach ($modalidad->usuarios as $usuario) {
                        if ($usuario->importe == '0') {
                            continue;
                        }
                        foreach ($usuario->metodos as $metodo) {
                            if ($metodo->importe == '0') {
                                continue;
                            }
                            ?>
                            <div style="position:relative;">
                                <div style="position:relative; float: left;">
                                    <?php echo $usuario->usuario . ": " . $metodo->metodo; ?>
                                </div>
                                <div style="position:relative; float: right;">
                                    <?php echo number_format($metodo->importe, 2, ',', '.'); ?> €
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>
        <?php
    }
    ?>
    <div class="grid-1">
        <div class="text-center">
            <button type="button" class="botones-cesta" onClick="imprimirDatos();">Imprimir</button>
        </div>
    </div>
    <?php
} else {
    ?>
    <div id="capa-opciones-volcar-documentos" class="bg-white mx-4">
        <div class="flex justify-center items-center">
            <?php
            if($tipo_documento == "pre" || $tipo_documento == "ped" || $tipo_documento == "alb") {
                ?>
                <div class="grow text-center">
                    <button class="button-filtro hover:text-blendi-600 p-3" id="pestana-titulo-volcar-fecha-hora-otros-documentos" onclick="mostrarPestanaFechaHora('capa-volcar-facturas-documentos'); seleccionarPestanaFechaHoraOtrosDocumentos('volcar');">
                        <?php
                        if($tipo_documento == "pre") {
                            echo "Volcar presupuestos";
                        }else if($tipo_documento == "ped") {
                            echo "Volcar pedidos";
                        }else if($tipo_documento == "alb") {
                            echo "Volcar albaranes";
                        }
                        ?>
                    </button>
                </div>
                <?php
            }
            ?>
            <div class="grow text-center">
                <button class="button-filtro hover:text-blendi-600 p-3" id="pestana-titulo-imprimir-fecha-hora-otros-documentos" onclick="mostrarPestanaFechaHora('capa-imprimir-documentos'); seleccionarPestanaFechaHoraOtrosDocumentos('imprimir');">
                    Imprimir
                </button>
            </div>
            <div class="grow text-center">
                <button class="button-filtro hover:text-blendi-600 p-3" id="pestana-titulo-mail-fecha-hora-otros-documentos" onclick="mostrarPestanaFechaHora('capa-enviar-facturas-documentos'); seleccionarPestanaFechaHoraOtrosDocumentos('mail');">
                    Enviar por mail
                </button>
            </div>
            <div class="grow text-center">
                <button class="button-filtro hover:text-blendi-600 font-bold p-3" id="pestana-titulo-resultados-fecha-hora-otros-documentos" onclick="mostrarPestanaFechaHora('capa-titulos-listado-otros-documentos'); seleccionarPestanaFechaHoraOtrosDocumentos('resultados');">
                    Resultados
                </button>
            </div>
        </div>
    </div>
    <div id="capa-volcar-facturas-documentos" class="hidden p-4 pb-8 h-3/5 mx-4 bg-white overflow-y-auto">
        <?php
        if($tipo_documento == "pre" || $tipo_documento == "ped" || $tipo_documento == "alb") {
            ?>
            <div class="w-full text-left">
                <input type="checkbox" id="checkbox-volcar-enviar" onclick="marcarVolcar([<?php echo join(',', $id_documentos_1); ?>],[<?php echo join(',', $id_documentos_2_1); ?>]);" /> Marcar
            </div>
            <?php
            foreach ($id_documentos_1 as $key => $id_documento_1_volcar) {
                if($estado_documentos_1[$key] != "Volcado") {
                    ?>
                    <div class="w-full text-left">
                        <input type="checkbox" id="documento_volcar_<?php echo $key; ?>" name="documento_volcar_<?php echo $key; ?>" onclick="marcarLineasVolcar(<?php echo $key; ?>,<?php echo $id_documentos_1[$key]; ?>,[<?php echo join(',', $id_documentos_2_1); ?>]);" /> Documento: <?php echo $numero_documento_documentos_1[$key]; ?> - <?php echo $librador_documentos_1[$key]; ?>
                    </div>
                    <?php
                    foreach ($id_documentos_2_1 as $key2 => $id_documento_2_1) {
                        if ($id_documento_2_1 == $id_documentos_1[$key]) {
                            ?>
                            <div class="grid grid-cols-8">
                                <div>&nbsp;</div>
                                <div class="text-left" <?php if($estado_lineas[$key2] != 2) { echo 'style="margin-left: 70px;"'; } ?>>
                                    <?php
                                    if($estado_lineas[$key2] != 2) {
                                        ?>
                                        <input type="checkbox" id="linea_volcar_<?php echo $key2; ?>" name="linea_volcar_<?php echo $key2; ?>"  onclick="marcarDesmarcarPadreVolcar(<?php echo $key; ?>,<?php echo $id_documentos_1[$key]; ?>,[<?php echo join(',', $id_documentos_2_1); ?>);" value="<?php echo $id_documentos_2[$key2]; ?>" />
                                        <?php
                                    }
                                    echo $referencia_producto_2[$key2] . ' ' . $descripcion_producto_2[$key2] . ' ' . $detalles_producto_2[$key2];
                                    ?>
                                </div>
                                <div class="text-left"><?php echo $referencia_producto_2[$key2]; ?></div>
                                <div class="text-left">
                                    <?php
                                    if($estado_lineas[$key2] != 2) {
                                        $mostrarDetalleCantidades = "";
                                        $cantidadPendiente = $cantidad_2[$key2];
                                        if($estado_lineas[$key2] == 1) {
                                            if($tipo_documento != "fac" && $tipo_documento != "tiq") {
                                                $cantidadPendiente = $cantidad_2[$key2] - $cantidad_2_volcada[$key2];
                                                $mostrarDetalleCantidades = $cantidad_2[$key2] . ' - ' . $cantidad_2_volcada[$key2];
                                            }
                                        }
                                        ?>
                                        <input type="number" name="cantidad_<?php echo $key2; ?>" id="cantidad_<?php echo $key2; ?>" value="<?php echo $cantidadPendiente; ?>" class="w-full" style="text-align: right;" onchange="comprobarCantidad(<?php echo $key2; ?>,<?php echo $cantidadPendiente; ?>);" /> <?php echo $mostrarDetalleCantidades; ?>
                                        <?php
                                    } else {
                                        echo $cantidad_2[$key2];
                                    }
                                    ?>
                                </div>
                                <div class="text-left"><?php echo $unidad_2[$key2]; ?></div>

                                <div class="text-left col-span-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" onclick="collapseCapa('dropdown_datos_lotes_series_<?php echo $key2; ?>');">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                    </svg>
                                    <div id="dropdown_datos_lotes_series_<?php echo $key2; ?>" class="hidden z-10 w-44 rounded divide-y divide-gray-100 shadow">
                                        <?php
                                        if ($tipo_librador == 'pro' || $tipo_librador == 'cre') {
                                            ?>
                                            <label>Coste unidad</label>
                                            <input type="text" name="coste_<?php echo $key2; ?>" id="coste_<?php echo $key2; ?>" class="w-full" value="<?php echo $coste_2[$key2]; ?>" style="text-align: left;" />
                                            <input type="hidden" name="importe_<?php echo $key2; ?>" id="importe_<?php echo $key2; ?>" value="<?php echo $importe_2[$key2]; ?>" />
                                            <?php
                                        } else {
                                            ?>
                                            <label>Importe unidad</label>
                                            <input type="text" name="importe_<?php echo $key2; ?>" id="importe_<?php echo $key2; ?>" class="w-full" value="<?php echo $importe_2[$key2]; ?>" style="text-align: left;" />
                                            <input type="hidden" name="coste_<?php echo $key2; ?>" id="coste_<?php echo $key2; ?>" value="<?php echo $coste_2[$key2]; ?>" />
                                            <?php
                                        }
                                        ?>
                                        <label>Lote</label>
                                        <input type="text" name="lote_<?php echo $key2; ?>" id="lote_<?php echo $key2; ?>" class="w-full" value="<?php echo $lote_2[$key2]; ?>" style="text-align: left;" />
                                        <label>Caducidad</label>
                                        <input type="date" name="caducidad_<?php echo $key2; ?>" id="caducidad_<?php echo $key2; ?>" class="w-full" value="<?php echo $caducidad_2[$key2]; ?>" style="text-align: left;" />
                                        <label>Número de serie</label>
                                        <input type="text" name="numero_serie_<?php echo $key2; ?>" id="numero_serie_<?php echo $key2; ?>" class="w-full" value="<?php echo $numero_serie_2[$key2]; ?>" style="text-align: left;" />
                                    </div>
                                </div>

                                <?php
                                if($estado_lineas[$key2] != 2) {
                                    if ($tipo_librador == "cli") {
                                        ?>
                                        <div class="text-right pr-3"><?php echo number_format($pvp_unidad_2[$key2] * $cantidadPendiente, 2, ',', '.'); ?> €</div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="text-right pr-3"><?php echo number_format($coste_2[$key2] * $cantidadPendiente, 2, ',', '.'); ?> €</div>
                                        <?php
                                    }
                                } else {
                                    if ($tipo_librador == "cli") {
                                        ?>
                                        <div class="text-right pr-3"><?php echo number_format($pvp_unidad_2[$key2] * $cantidad_2[$key2], 2, ',', '.'); ?> €</div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="text-right pr-3"><?php echo number_format($coste_2[$key2] * $cantidad_2[$key2], 2, ',', '.'); ?> €</div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <hr />
                    <?php
                }
            }

            $fechaActual = new DateTime();
            ?>
            <div class="grid grid-cols-2">
                <div>
                    <label>Fecha del documento</label>
                    <input type="date" name="fecha_documento_volcado" id="fecha_documento_volcado" value="<?php echo $fechaActual->format('Y-m-d'); ?>" />
                </div>
                <div>
                    <?php
                    if ($tipo_librador == "cli") {
                        // Serie
                        ?>
                        <label>Serie del documento</label>
                        <select name="serie_volcado" id="serie_volcado">
                            <option value="-1" selected>Sin serie</option>
                            <?php
                            foreach ($id_series as $key_series => $id_serie) {
                                ?>
                                <option value="<?php echo $id_serie; ?>">(<?php echo $tipo_documento_series[$key_series]; ?>) <?php echo $descripcion_series[$key_series]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
                    } else {
                        // Mostrar input número
                        ?>
                        <label>Número del documento</label>
                        <input type="text" name="numero_documento_volcado" id="numero_documento_volcado" maxlength="25" value="" />
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            if ($tipo_documento == "pre") {
                $classGrid = 3;
            } else if ($tipo_documento == "ped") {
                $classGrid = 2;
            } else if ($tipo_documento == "alb") {
                $classGrid = 1;
            }
            ?>
            <div class="grid grid-cols-<?php echo $classGrid; ?>" id="boton_volcar_documento">
                <?php
                if($tipo_documento == "pre") {
                    ?>
                    <a class="p-3 hover:text-blendi-600" onClick="volcarDocumentos('<?php echo $tipo_documento; ?>','ped',[<?php echo join(',', $id_documentos_1); ?>],[<?php echo join(',', $id_documentos_2_1); ?>],[<?php echo join(',', $ejercicios_documentos_1); ?>]);">
                        Volcar a pedidos
                    </a>
                    <?php
                }
                if($tipo_documento == "pre" || $tipo_documento == "ped") {
                    ?>
                    <a class="p-3 hover:text-blendi-600" onClick="volcarDocumentos('<?php echo $tipo_documento; ?>','alb',[<?php echo join(',', $id_documentos_1); ?>],[<?php echo join(',', $id_documentos_2_1); ?>],[<?php echo join(',', $ejercicios_documentos_1); ?>]);">
                        Volcar a albaranes
                    </a>
                    <?php
                }
                if($tipo_documento == "pre" || $tipo_documento == "ped" || $tipo_documento == "alb") {
                    ?>
                    <a class="p-3 hover:text-blendi-600" onClick="volcarDocumentos('<?php echo $tipo_documento; ?>','fac',[<?php echo join(',', $id_documentos_1); ?>],[<?php echo join(',', $id_documentos_2_1); ?>],[<?php echo join(',', $ejercicios_documentos_1); ?>]);">
                        Volcar a facturas
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <div id="capa-imprimir-documentos" class="hidden p-4 pb-8 h-3/5 mx-4 bg-white overflow-y-auto">
        <div class="w-full text-left">
            <input type="checkbox" id="checkbox-marcar-imprimir" onclick="marcarImprimir('<?php echo count($id_documentos_1); ?>');" /> Marcar
        </div>
        <?php
        foreach ($id_documentos_1 as $key => $id_documento_1_imprimir) {
            ?>
            <input type="hidden" id="ejercicio_documento_imprimir_<?php echo $key; ?>" name="ejercicio_documento_imprimir_<?php echo $key; ?>" value="<?php echo $ejercicios_documentos_1[$key]; ?>" />
            <div class="w-full text-left">
                <input type="checkbox" id="documento_imprimir_<?php echo $key; ?>" name="documento_imprimir_<?php echo $key; ?>" /> Documento: <?php echo $serie_documento_documentos_1[$key] . $numero_documento_documentos_1[$key] . ' - ' . $librador_documentos_1[$key] . ' - ' . $fecha_documento_documentos_1[$key] . ' - ' . $total_documentos_1[$key]; ?>€
            </div>
            <?php
        }
        ?>

        <div class="w-full text-center" id="boton_imprimir">
            <button class="p-3 hover:text-blendi-600" id="boton-imprimir" onClick="imprimirDocumentos([<?php echo join(',', $id_documentos_1); ?>],[<?php echo join(',', $ejercicios_documentos_1); ?>]);">Imprimir </button>
            <div id="capa_imprimiendo">
            </div>
        </div>
    </div>
    <div id="capa-enviar-facturas-documentos" class="hidden p-4 pb-8 h-3/5 mx-4 bg-white overflow-y-auto">
        <div class="w-full text-left">
            <input type="checkbox" id="checkbox-marcar-enviar" onclick="marcarEnviar('<?php echo count($id_documentos_1); ?>');" /> Marcar
        </div>
        <?php
        foreach ($id_documentos_1 as $key => $id_documento_1_enviar) {
            ?>
            <input type="hidden" id="ejercicio_documento_enviar_<?php echo $key; ?>" name="ejercicio_documento_enviar_<?php echo $key; ?>" value="<?php echo $ejercicios_documentos_1[$key]; ?>" />
            <div class="grid grid-cols-3">
                <div class="text-left col-span-2">
                    <input type="checkbox" id="documento_enviar_<?php echo $key; ?>" name="documento_enviar_<?php echo $key; ?>" /> Documento: <?php echo $serie_documento_documentos_1[$key] . $numero_documento_documentos_1[$key] . ' - ' . $librador_documentos_1[$key] . ' - ' . $fecha_documento_documentos_1[$key] . ' - ' . $total_documentos_1[$key]; ?>€
                    </div>
                <div class="text-left">
                    <input type="text" id="email_documento_enviar_<?php echo $key; ?>" name="email_documento_enviar_<?php echo $key; ?>" value="<?php echo $email_librador[$key]; ?>" />
                </div>
            </div>
            <?php
        }
        ?>
        <div class="w-full text-center" id="boton_enviar_mail">
            <button class="p-3 hover:text-blendi-600" id="boton-enviar-mail" onClick="enviarDocumentos([<?php echo join(',', $id_documentos_1); ?>],[<?php echo join(',', $ejercicios_documentos_1); ?>]);">Enviar </button>
            <div id="capa_enviando_mail">
            </div>
        </div>
    </div>
    <div id="capa-titulos-listado-otros-documentos" class="mx-4">
        <?php
        $columnas = '8';
        if (($tipo_librador == 'pro' || $tipo_librador == 'cre') && $tipo_documento == 'fac') {
            $columnas = '9';
        }
        ?>
        <div class="grid grid-cols-<?php echo $columnas; ?> items-center h-10 bg-gray-50 dark:text-white">
            <?php
            if (($tipo_librador == 'pro' || $tipo_librador == 'cre') && $tipo_documento == 'fac') {
                ?>
                <div class="px-3 font-bold text-center">Registro</div>
                <?php
            }
            ?>
            <div class="px-3 font-bold text-center">Número</div>
            <div class="px-3 font-bold text-center col-span-2"><?php echo $titulo_tipo_librador; ?></div>
            <div class="px-3 font-bold text-center">Fecha</div>
            <div class="px-3 font-bold text-center">Hora</div>
            <div class="px-3 font-bold text-center">Total</div>
            <div class="px-3 font-bold text-center">Estado</div>
            <div class="px-3 flex items-center justify-center">
                <form class="hidden" method="post" target="_blank" id="actualizar-otros-documentos-csv" action="/">
                    <input type="hidden" name="id_sesion" id="actualizar-otros-documentos-csv-id_sesion" value="">
                    <input type="hidden" name="ip" id="actualizar-otros-documentos-csv-ip" value="">
                    <input type="hidden" name="so" id="actualizar-otros-documentos-csv-so" value="">
                    <input type="hidden" name="idioma" id="actualizar-otros-documentos-csv-idioma" value="">
                    <input type="hidden" name="id_idioma" id="actualizar-otros-documentos-csv-id_idioma" value="">
                    <input type="hidden" name="ejercicio" id="actualizar-otros-documentos-csv-ejercicio" value="">
                    <input type="hidden" name="interface_js" id="actualizar-otros-documentos-csv-interface_js" value="">
                    <input type="hidden" name="tipo_documento" id="actualizar-otros-documentos-csv-tipo_documento" value="">
                    <input type="hidden" name="tipo_librador" id="actualizar-otros-documentos-csv-tipo_librador" value="">
                    <input type="hidden" name="apartado" id="actualizar-otros-documentos-csv-apartado" value="">
                    <input type="hidden" name="id_librador_tak" id="actualizar-otros-documentos-csv-id_librador_tak" value="">
                    <input type="hidden" name="servicio_domicilio" id="actualizar-otros-documentos-csv-servicio_domicilio" value="">
                    <input type="hidden" name="opcion" id="actualizar-otros-documentos-csv-opcion" value="">
                    <input type="hidden" name="fecha_desde" id="actualizar-otros-documentos-csv-fecha_desde" value="">
                    <input type="hidden" name="fecha_hasta" id="actualizar-otros-documentos-csv-fecha_hasta" value="">
                    <input type="hidden" name="hora_desde" id="actualizar-otros-documentos-csv-hora_desde" value="">
                    <input type="hidden" name="hora_hasta" id="actualizar-otros-documentos-csv-hora_hasta" value="">
                    <input type="hidden" name="id_librador" id="actualizar-otros-documentos-csv-id_librador" value="">
                    <input type="hidden" name="serie" id="actualizar-otros-documentos-csv-serie" value="">
                    <input type="hidden" name="descarga_url" id="actualizar-otros-documentos-csv-descarga_url" value="">
                    <input type="hidden" name="ajax" id="actualizar-otros-documentos-csv-ajax" value="1">
                    <input type="hidden" name="ajax_documentos" id="actualizar-otros-documentos-csv-ajax_documentos" value="1">
                </form>
                <a href="#" onclick="actualizarOtrosDocumentosDownloadCsv(); document.getElementById('actualizar-otros-documentos-csv').submit()" class="text-blendi-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <?php

    if(isset($id_documentos_1)) {
        ?>
        <div id="capa_listado_resultados" class="overflow-y-auto bg-white h-3/5 mx-4 mb-4">
            <?php
            foreach ($id_documentos_1 as $key => $valor) {
                ?>
                <div class="grid grid-cols-<?php echo $columnas; ?> items-center h-14 bg-white border-2 border-gray-50" id="linea_<?php echo $valor; ?>">
                    <?php
                    if (($tipo_librador == 'pro' || $tipo_librador == 'cre') && $tipo_documento == 'fac') {
                        ?>
                        <div class="px-3 text-center"><?php echo $numero_registro_documentos_1[$key]; ?></div>
                        <?php
                    }
                    ?>
                    <div class="px-3 text-center">
                        <?php echo $numero_documento_documentos_1[$key]; ?>
                    </div>
                    <div class="px-3 col-span-2">
                        <?php echo $librador_documentos_1[$key]; ?>
                    </div>
                    <div class="px-3 text-center">
                        <?php echo $fecha_documento_documentos_1[$key]; ?>
                    </div>
                    <div class="px-3 text-center">
                        <?php echo $hora_documentos_1[$key]; ?>
                    </div>
                    <div class="px-3 text-center">
                        <?php echo $total_documentos_1[$key]; ?>€
                    </div>
                    <div class="px-3 text-center">
                        <?php echo $estado_documentos_1[$key]; ?>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="text-center h-4 w-4" onmouseover="this.style.cursor='pointer'" onclick="abrirDocumento('<?php echo $id_documentos_1[$key]; ?>', '<?php echo $ejercicios_documentos_1[$key]; ?>', '<?php echo $id_librador_documentos_1[$key]; ?>','<?php echo $bloqueado_documentos_1[$key]; ?>');">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                        </div>
                        <?php
                        if($estado_documentos_1[$key] != "Cobrado" && $estado_documentos_1[$key] != "Volcado" && ($tipo_librador == "pro" || $tipo_librador == "cre" || $tipo_librador == "pre" || $tipo_documento == "ped" || $tipo_documento == "alb")) {
                            ?>
                            <div class="text-center h-4 w-4" onmouseover="this.style.cursor='pointer'" onclick="eliminarDocumento('<?php echo $id_documentos_1[$key]; ?>', '<?php echo $ejercicios_documentos_1[$key]; ?>', '<?php echo $key; ?>');">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            unset($consulta0);
            unset($consulta1);
            unset($query);
            unset($resultados);
            unset($ejercicios_documentos_1);
            unset($id_documentos_1);
            unset($id_librador_documentos_1);
            unset($bloqueado_documentos_1);
            unset($librador_activo);
            unset($librador_documentos_1);
            unset($fecha_documento_documentos_1);
            unset($numero_registro_documentos_1);
            unset($numero_documento_documentos_1);
            unset($serie_documento_documentos_1);
            unset($total_documentos_1);
            unset($estado_documentos_1);
            unset($id_usuario_documentos_1);
            unset($hora_documentos_1);
            unset($observacion_documentos_1);
            unset($modalidad_pago_array);
            ?>
        </div>
        <?php
        require($_SERVER['DOCUMENT_ROOT'] . "/web-vistas/documentos/footer-lista.php");
    } else {
        ?>
        <div class="flex items-center justify-center h-10 bg-white mx-5">
            <div class="text-center grow px-3">
                No existen documentos para esta selección.
            </div>
        </div>
        <?php
    }
}
