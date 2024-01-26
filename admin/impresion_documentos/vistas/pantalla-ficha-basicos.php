<div class="grid grid-cols-1 sm:grid-cols-5 mt-3 items-center space-x-3">
    <div>
        <label for="descripcion_modelos">Descripcón modelo:</label><br />
        <input type="text" class="w-full" name="descripcion_modelos" id="descripcion_modelos" placeholder="Descripción modelo" value="<?php echo $descripcion_modelos; ?>" maxlength="50" required />
    </div>
    <div>
        <label for="ancho_modelos">Ancho:</label><br />
        <input type="number" class="w-full" name="ancho_modelos" id="ancho_modelos" min="60" max="297" placeholder="Ancho modelo" value="<?php echo $ancho_modelos; ?>" required /> mm.
    </div>
    <div>
        <label for="alto_modelos">Alto:</label><br />
        <input type="number" class="w-full" name="alto_modelos" id="alto_modelos" min="60" max="297" placeholder="Alto modelo" value="<?php echo $alto_modelos; ?>" required /> mm.
    </div>
    <div>
        <label for="interlineado_modelos">Interlineado:</label><br />
        <input type="number" class="w-full" name="interlineado_modelos" id="interlineado_modelos" min="5" max="25" placeholder="Interlineado modelo" value="<?php echo $interlineado_modelos; ?>" required /> mm.
    </div>
    <div>
        <label for="lineas_pagina_modelos">Lineas por página:</label><br />
        <input type="number" class="w-full" name="lineas_pagina_modelos" id="lineas_pagina_modelos" min="5" max="50" placeholder="Lineas por modelo" value="<?php echo $lineas_pagina_modelos; ?>" required /> mm.
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-5 mt-3 items-center space-x-3">
    <div>
        <label>Marcar lineas:</label><br />
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('marcar_lineas_modelos_1', 'capa_marcar_lineas_modelos_1', 'capa_unicos_marcar_lineas_modelos')" id="capa_marcar_lineas_modelos_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_marcar_lineas_modelos poin">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_marcar_lineas_modelos_1" class="hidden w-6 h-6 contracheck_capa_unicos_marcar_lineas_modelos">
                    &nbsp;
                </div>
                <div id="check_marcar_lineas_modelos_1" class="hidden check_capa_unicos_marcar_lineas_modelos">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="marcar_lineas_modelos" id="marcar_lineas_modelos_1" value="1" class="hidden" />
                <?php
                if ($marcar_lineas_modelos == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('marcar_lineas_modelos_1', 'capa_marcar_lineas_modelos_1', "capa_unicos_marcar_lineas_modelos");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('marcar_lineas_modelos_2', 'capa_marcar_lineas_modelos_2', 'capa_unicos_marcar_lineas_modelos')" id="capa_marcar_lineas_modelos_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_marcar_lineas_modelos">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_marcar_lineas_modelos_2" class="hidden w-6 h-6 contracheck_capa_unicos_marcar_lineas_modelos">
                    &nbsp;
                </div>
                <div id="check_marcar_lineas_modelos_2" class="hidden check_capa_unicos_marcar_lineas_modelos">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="marcar_lineas_modelos" id="marcar_lineas_modelos_2" value="0" class="hidden" />
                <?php
                if ($marcar_lineas_modelos != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('marcar_lineas_modelos_2', 'capa_marcar_lineas_modelos_2', "capa_unicos_marcar_lineas_modelos");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div>
        <?php
        $selected_pre = "";
        $selected_ped = "";
        $selected_alb = "";
        $selected_fac = "";
        if($tipo_documento_modelos == "pre"){
            $selected_pre = " selected";
        }else if($tipo_documento_modelos == "ped") {
            $selected_ped = " selected";
        }else if($tipo_documento_modelos == "alb") {
            $selected_alb = " selected";
        }else {
            $selected_fac = " selected";
        }
        ?>
        <label for="tipo_documento_modelos">Tipo documento:</label><br />
        <select name="tipo_documento_modelos" id="tipo_documento_modelos" class="w-full">
            <option value="pre"<?php echo $selected_pre; ?>>Presupuesto</option>
            <option value="ped"<?php echo $selected_ped; ?>>Pedido</option>
            <option value="alb"<?php echo $selected_alb; ?>>Albarán</option>
            <option value="fac"<?php echo $selected_fac; ?>>Factura</option>
        </select>
    </div>
    <div>
        <label for="serie_modelos">Serie documentos:</label><br />
        <select name="serie_modelos" id="serie_modelos" class="w-full">
            <?php
            $selected = "";
            if(empty($serie_modelos)){
                $selected = " selected";
            }
            ?>
            <option value=""<?php echo $selected; ?>>Sin serie</option>
            <?php
            if(isset($series)) {
                foreach ($series as $key_series => $valor_series) {
                    $selected = "";
                    if($serie_modelos == $valor_series){
                        $selected = " selected";
                    }
                    ?>
                    <option value="<?php echo $valor_series; ?>"<?php echo $selected; ?>><?php echo $valor_series; ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <div>
        <label>Activo:</label><br />
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('activo_modelos_1', 'capa_activo_modelos_1', 'capa_unicos_activo_modelos')" id="capa_activo_modelos_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_modelos poin">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_activo_modelos_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo_modelos">
                    &nbsp;
                </div>
                <div id="check_activo_modelos_1" class="hidden check_capa_unicos_activo_modelos">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo_modelos" id="activo_modelos_1" value="1" class="hidden" />
                <?php
                if ($activo_modelos == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('activo_modelos_1', 'capa_activo_modelos_1', "capa_unicos_activo_modelos");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('activo_modelos_2', 'capa_activo_modelos_2', 'capa_unicos_activo_modelos')" id="capa_activo_modelos_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_modelos">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_activo_modelos_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo_modelos">
                    &nbsp;
                </div>
                <div id="check_activo_modelos_2" class="hidden check_capa_unicos_activo_modelos">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo_modelos" id="activo_modelos_2" value="0" class="hidden" />
                <?php
                if ($activo_modelos != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('activo_modelos_2', 'capa_activo_modelos_2', "capa_unicos_activo_modelos");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div>
        <label>Perdeterminado:</label><br />
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('predeterminado_modelos_1', 'capa_predeterminado_modelos_1', 'capa_unicos_predeterminado_modelos')" id="capa_predeterminado_modelos_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_predeterminado_modelos poin">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_predeterminado_modelos_1" class="hidden w-6 h-6 contracheck_capa_unicos_predeterminado_modelos">
                    &nbsp;
                </div>
                <div id="check_predeterminado_modelos_1" class="hidden check_capa_unicos_predeterminado_modelos">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="predeterminado_modelos" id="predeterminado_modelos_1" value="1" class="hidden" />
                <?php
                if ($predeterminado_modelos == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('predeterminado_modelos_1', 'capa_predeterminado_modelos_1', "capa_unicos_predeterminado_modelos");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('predeterminado_modelos_2', 'capa_predeterminado_modelos_2', 'capa_unicos_predeterminado_modelos')" id="capa_predeterminado_modelos_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_predeterminado_modelos">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_predeterminado_modelos_2" class="hidden w-6 h-6 contracheck_capa_unicos_predeterminado_modelos">
                    &nbsp;
                </div>
                <div id="check_predeterminado_modelos_2" class="hidden check_capa_unicos_predeterminado_modelos">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="predeterminado_modelos" id="predeterminado_modelos_2" value="0" class="hidden" />
                <?php
                if ($predeterminado_modelos != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('predeterminado_modelos_2', 'capa_predeterminado_modelos_2', "capa_unicos_predeterminado_modelos");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
if(!empty($id_url)) {
    ?>
    <hr />
    <?php
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'nombre_librador';
    $matriz_titulo[] = 'Nombre';
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'nif_librador';
    $matriz_titulo[] = 'NIF';
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'direccion_librador';
    $matriz_titulo[] = 'Dirección';
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'codigo_postal_librador';
    $matriz_titulo[] = 'Código postal';
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'localidad_librador';
    $matriz_titulo[] = 'Localidad';
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'provincia_librador';
    $matriz_titulo[] = 'Provincia';
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'serie_documento';
    $matriz_titulo[] = 'Serie documento';
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'numero_documento';
    $matriz_titulo[] = 'Número documento';
    $matriz_zona[] = 'cabecera';
    $matriz_campo[] = 'fecha_documento';
    $matriz_titulo[] = 'Fecha documento';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'cantidad';
    $matriz_titulo[] = 'Cantidad';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'descripcion_producto';
    $matriz_titulo[] = 'Descripción producto';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'base_unidad';
    $matriz_titulo[] = 'Base unidad';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'iva_linea';
    $matriz_titulo[] = 'IVA linea';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'pvp_unidad';
    $matriz_titulo[] = 'PVP unidad';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'descuento_linea';
    $matriz_titulo[] = 'Descuento linea';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'total_despues_descuento';
    $matriz_titulo[] = 'Total después de descuento';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'referencia_producto';
    $matriz_titulo[] = 'Referencia producto';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'referencia_proveedor';
    $matriz_titulo[] = 'Referencia proveedor';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'lote_producto';
    $matriz_titulo[] = 'Lote producto';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'serie_producto';
    $matriz_titulo[] = 'Número serie producto';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'detalles_producto';
    $matriz_titulo[] = 'Detalles producto linea';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'descripcion_oferta';
    $matriz_titulo[] = 'Descripción oferta linea';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'nota_producto';
    $matriz_titulo[] = 'Nota linea';
    $matriz_zona[] = 'cuerpo';
    $matriz_campo[] = 'documento_anterior';
    $matriz_titulo[] = 'Documento anterior';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'iva';
    $matriz_titulo[] = 'IVA';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'recargo';
    $matriz_titulo[] = 'Recargo';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'base_iva';
    $matriz_titulo[] = 'Base IVA';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'importe_iva';
    $matriz_titulo[] = 'Importe IVA';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'importe_recargo';
    $matriz_titulo[] = 'Importe recargo';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'irpf';
    $matriz_titulo[] = 'IRPF';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'importe_irpf';
    $matriz_titulo[] = 'Importe IRPF';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'descuento_pp';
    $matriz_titulo[] = 'Descuento pp';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'importe_descuento_pp';
    $matriz_titulo[] = 'Importe descuento pp';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'descuento_librador';
    $matriz_titulo[] = 'Descuento';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'importe_descuento_librador';
    $matriz_titulo[] = 'Importe descuento';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'total';
    $matriz_titulo[] = 'Total';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'usuario_documento';
    $matriz_titulo[] = 'Usuario';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'comensales';
    $matriz_titulo[] = 'Comensales';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'modalidad_pago';
    $matriz_titulo[] = 'Modalidad pago';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'modalidad_envio';
    $matriz_titulo[] = 'Modalidad envio';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'modalidad_entrega';
    $matriz_titulo[] = 'Modalidad entrega';
    $matriz_zona[] = 'pie';
    $matriz_campo[] = 'nota_documento';
    $matriz_titulo[] = 'Nota';
    foreach ($matriz_zona as $key_zona => $valor_zona) {
        $existe_linea = false;
        foreach ($id_lineas_modelos as $key_lineas_modelos => $valor_lineas_modelos) {
            if($zona_lineas_modelos[$key_lineas_modelos] == $valor_zona && $campo_lineas_modelos[$key_lineas_modelos] == $matriz_campo[$key_zona]) {
                $existe_linea = true;
                ?>
                <input type="hidden" name="id_lineas_modelos_<?php echo $key_zona; ?>" id="id_lineas_modelos_<?php echo $key_zona; ?>" value="<?php echo $valor_lineas_modelos; ?>" />
                <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3" id="linea_<?php echo $key_zona."_".$valor_lineas_modelos; ?>">
                    <div class="font-bold">
                        <?php
                        echo strtoupper($valor_zona);
                        ?>
                    </div>
                    <div class="font-bold">
                        <?php
                        echo strtoupper($matriz_titulo[$key_zona]);
                        ?>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
                    <div>
                        <label for="inicio_ancho_lineas_modelos_<?php echo $key_zona; ?>">Posición ancho:</label><br />
                        <input type="number" class="w-full" name="inicio_ancho_lineas_modelos_<?php echo $key_zona; ?>" id="inicio_ancho_lineas_modelos_<?php echo $key_zona; ?>" min="0" max="295" placeholder="Posición ancho linea" value="<?php echo $inicio_ancho_lineas_modelos[$key_lineas_modelos]; ?>" required /> mm.
                    </div>
                    <div>
                        <label for="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>">Posición alto:</label><br />
                        <input type="number" class="w-full" name="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>" id="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>" min="0" max="295" placeholder="Posición alto linea" value="<?php echo $inicio_alto_lineas_modelos[$key_lineas_modelos]; ?>" required /> mm.
                    </div>
                    <div>
                        <label for="ancho_lineas_modelos<?php echo $key_zona; ?>">Ancho capa:</label><br />
                        <input type="number" class="w-full" name="ancho_lineas_modelos_<?php echo $key_zona; ?>" id="ancho_lineas_modelos_<?php echo $key_zona; ?>" min="5" max="290" placeholder="Ancho capa linea" value="<?php echo $ancho_lineas_modelos[$key_lineas_modelos]; ?>" required /> mm.
                    </div>
                    <div>
                        <label for="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>">Alto capa:</label><br />
                        <input type="number" class="w-full" name="alto_lineas_modelos_<?php echo $key_zona; ?>" id="alto_lineas_modelos_<?php echo $key_zona; ?>" min="5" max="290" placeholder="Alto capa linea" value="<?php echo $alto_lineas_modelos[$key_lineas_modelos]; ?>" required /> mm.
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                    <div>
                        <?php
                        $selected_sin = "";
                        $selected_con = "";
                        if($border_lineas_modelos[$key_lineas_modelos] == ""){
                            $selected_sin = " selected";
                        }else {
                            $selected_con = " selected";
                        }
                        ?>
                        <label for="border_lineas_modelos_<?php echo $key_zona; ?>">Borde capa:</label><br />
                        <select name="border_lineas_modelos_<?php echo $key_zona; ?>" class="w-full" id="border_lineas_modelos_<?php echo $key_zona; ?>">
                            <option value=""<?php echo $selected_sin; ?>>Sin borde</option>
                            <option value="LTRB"<?php echo $selected_con; ?>>Con borde</option>
                        </select>
                    </div>
                    <div>
                        <label for="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>">Grueso borde:</label><br />
                        <input type="number" name="grueso_borde_lineas_modelos_<?php echo $key_zona; ?>" class="w-full" id="grueso_borde_lineas_modelos_<?php echo $key_zona; ?>" min="1" max="5" placeholder="Grueso borde" value="<?php echo $grueso_borde_lineas_modelos[$key_lineas_modelos]; ?>" required /> mm.
                    </div>
                    <div>
                        <label for="color_borde_lineas_modelos_<?php echo $key_zona; ?>">Color borde:</label><br />
                        <input type="color" name="color_borde_lineas_modelos_<?php echo $key_zona; ?>" class="w-full" id="color_borde_lineas_modelos_<?php echo $key_zona; ?>" placeholder="Color borde" style="height: 35px;" value="" required />
                        <script>
                            document.getElementById("color_borde_lineas_modelos_<?php echo $key_zona; ?>").value = rgbToHex(<?php echo $col_r_borde_lineas_modelos[$key_lineas_modelos]; ?>, <?php echo $col_g_borde_lineas_modelos[$key_lineas_modelos]; ?>, <?php echo $col_b_borde_lineas_modelos[$key_lineas_modelos]; ?>);
                        </script>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-5 mt-3 items-center space-x-3">
                    <div>
                        <?php
                        if(empty($fuente_letra_lineas_modelos[$key_lineas_modelos])) {
                            $fuente_letra_lineas_modelos[$key_lineas_modelos] = "Arial";
                        }
                        ?>
                        <label for="fuente_letra_lineas_modelos_<?php echo $key_zona; ?>">Fuente letra:</label><br />
                        <input type="text" class="w-full" name="fuente_letra_lineas_modelos_<?php echo $key_zona; ?>" id="fuente_letra_lineas_modelos_<?php echo $key_zona; ?>" placeholder="Fuente letra" value="<?php echo $fuente_letra_lineas_modelos[$key_lineas_modelos]; ?>" maxlength="50" required />
                    </div>
                    <div>
                        <?php
                        $selected_regular = "";
                        $selected_negrita = "";
                        $selected_cursiva = "";
                        $selected_negrita_cursiva = "";
                        if($estilo_letra_lineas_modelos[$key_lineas_modelos] == "") {
                            $selected_regular = " selected";
                        }else if($estilo_letra_lineas_modelos[$key_lineas_modelos] == "B") {
                            $selected_negrita = " selected";
                        }else if($estilo_letra_lineas_modelos[$key_lineas_modelos] == "I") {
                            $selected_cursiva = " selected";
                        }else if($estilo_letra_lineas_modelos[$key_lineas_modelos] == "BI") {
                            $selected_negrita_cursiva = " selected";
                        }
                        ?>
                        <label for="estilo_letra_lineas_modelos_<?php echo $key_zona; ?>">Estilo letra:</label><br />
                        <select name="estilo_letra_lineas_modelos_<?php echo $key_zona; ?>" class="w-full" id="estilo_letra_lineas_modelos_<?php echo $key_zona; ?>">
                            <option value=""<?php echo $selected_regular; ?>>Normal</option>
                            <option value="B"<?php echo $selected_negrita; ?>>Negrita</option>
                            <option value="I"<?php echo $selected_cursiva; ?>>Cursiva</option>
                            <option value="BI"<?php echo $selected_negrita_cursiva; ?>>Negrita cursiva</option>
                        </select>
                    </div>
                    <div>
                        <label for="size_letra_lineas_modelos_<?php echo $key_zona; ?>">Tamaño letra:</label><br />
                        <input type="number" class="w-full" name="size_letra_lineas_modelos_<?php echo $key_zona; ?>" id="size_letra_lineas_modelos_<?php echo $key_zona; ?>" min="6" max="72" placeholder="Tamaño letra" value="<?php echo $size_letra_lineas_modelos[$key_lineas_modelos]; ?>" required /> pt.
                    </div>
                    <div>
                        <?php
                        $selected_izquierda = "";
                        $selected_centro = "";
                        $selected_derecha = "";
                        if($alineacion_lineas_modelos[$key_lineas_modelos] == "L") {
                            $selected_izquierda = " selected";
                        }else if($alineacion_lineas_modelos[$key_lineas_modelos] == "C") {
                            $selected_centro = " selected";
                        }else if($alineacion_lineas_modelos[$key_lineas_modelos] == "R") {
                            $selected_derecha = " selected";
                        }
                        ?>
                        <label for="alineacion_lineas_modelos_<?php echo $key_zona; ?>">Alineación letra:</label><br />
                        <select name="alineacion_lineas_modelos_<?php echo $key_zona; ?>" class="w-full" id="alineacion_lineas_modelos_<?php echo $key_zona; ?>">
                            <option value="L"<?php echo $selected_izquierda; ?>>Izquierda</option>
                            <option value="C"<?php echo $selected_centro; ?>>Centro</option>
                            <option value="R"<?php echo $selected_derecha; ?>>Derecha</option>
                        </select>
                    </div>
                    <div>
                        <label for="color_letra_lineas_modelos_<?php echo $key_zona; ?>">Color letra:</label><br />
                        <input type="color" class="w-full" name="color_letra_lineas_modelos_<?php echo $key_zona; ?>" id="color_letra_lineas_modelos_<?php echo $key_zona; ?>" placeholder="Color letra" style="height: 35px;" value="" required />
                        <script>
                            document.getElementById("color_letra_lineas_modelos_<?php echo $key_zona; ?>").value = rgbToHex(<?php echo $col_r_letra_lineas_modelos[$key_lineas_modelos]; ?>, <?php echo $col_g_letra_lineas_modelos[$key_lineas_modelos]; ?>, <?php echo $col_b_letra_lineas_modelos[$key_lineas_modelos]; ?>);
                        </script>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                    <div>
                        <label>Mostrar linea:</label><br />
                        <div class="flex flex-wrap">
                            <div onclick="activarElementoUnicoFicha('mostrar_lineas_modelos_<?php echo $key_zona; ?>_1', 'capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1', 'capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>')" id="capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?> poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                    &nbsp;
                                </div>
                                <div id="check_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1" class="hidden check_capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="mostrar_lineas_modelos_<?php echo $key_zona; ?>" id="mostrar_lineas_modelos_<?php echo $key_zona; ?>_1" value="1" class="hidden" />
                                <?php
                                if ($mostrar_lineas_modelos[$key_lineas_modelos] == 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('mostrar_lineas_modelos_<?php echo $key_zona; ?>_1', 'capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1', "capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                            <div onclick="activarElementoUnicoFicha('mostrar_lineas_modelos_<?php echo $key_zona; ?>_2', 'capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2', 'capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>')" id="capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                    &nbsp;
                                </div>
                                <div id="check_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2" class="hidden check_capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="mostrar_lineas_modelos_<?php echo $key_zona; ?>" id="mostrar_lineas_modelos_<?php echo $key_zona; ?>_2" value="0" class="hidden" />
                                <?php
                                if ($mostrar_lineas_modelos[$key_lineas_modelos] != 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('mostrar_lineas_modelos_<?php echo $key_zona; ?>_2', 'capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2', "capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="submit" type="button" onclick="guardarLinea('guardar-linea','<?php echo $key_zona; ?>','<?php echo $valor_lineas_modelos; ?>');">Guardar</button>
                    </div>
                    <div>
                        <button class="submit" type="button" onclick="guardarLinea('eliminar-linea','<?php echo $key_zona; ?>','<?php echo $valor_lineas_modelos; ?>');">Eliminar</button>
                    </div>
                </div>
                <?php
                break;
            }
        }
        if(!$existe_linea) {
            ?>
            <input type="hidden" name="id_lineas_modelos_<?php echo $key_zona; ?>" id="id_lineas_modelos_<?php echo $key_zona; ?>" value="0" />
            <input type="hidden" name="zona_modelos_<?php echo $key_zona; ?>" id="zona_modelos_<?php echo $key_zona; ?>" value="<?php echo $valor_zona; ?>" />
            <input type="hidden" name="campo_modelos_<?php echo $key_zona; ?>" id="campo_modelos_<?php echo $key_zona; ?>" value="<?php echo $matriz_campo[$key_zona]; ?>" />
            <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
                <div class="font-bold" id="linea_<?php echo $key_zona."_0"; ?>">
                    <?php
                    echo strtoupper($valor_zona);
                    ?>
                </div>
                <div class="font-bold">
                    <?php
                    echo strtoupper($matriz_titulo[$key_zona]);
                    ?>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
                <div>
                    <label for="inicio_ancho_lineas_modelos_<?php echo $key_zona; ?>">Posición ancho:</label><br />
                    <input type="number" class="w-full" name="inicio_ancho_lineas_modelos_<?php echo $key_zona; ?>" id="inicio_ancho_lineas_modelos_<?php echo $key_zona; ?>" min="0" max="295" placeholder="Posición ancho linea" value="10" required /> mm.
                </div>
                <div>
                    <label for="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>">Posición alto:</label><br />
                    <input type="number" class="w-full" name="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>" id="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>" min="0" max="295" placeholder="Posición alto linea" value="10" required /> mm.
                </div>
                <div>
                    <label for="ancho_lineas_modelos<?php echo $key_zona; ?>">Ancho capa:</label><br />
                    <input type="number" class="w-full" name="ancho_lineas_modelos_<?php echo $key_zona; ?>" id="ancho_lineas_modelos_<?php echo $key_zona; ?>" min="5" max="290" placeholder="Ancho capa linea" value="50" required /> mm.
                </div>
                <div>
                    <label for="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>">Posición alto:</label><br />
                    <input type="number" class="w-full" name="alto_lineas_modelos_<?php echo $key_zona; ?>" id="alto_lineas_modelos_<?php echo $key_zona; ?>" min="5" max="290" placeholder="Alto capa linea" value="5" required /> mm.
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
                <div>
                    <?php
                    $selected_sin = " selected";
                    $selected_con = "";
                    ?>
                    <label for="border_lineas_modelos_<?php echo $key_zona; ?>">Borde capa:</label><br />
                    <select name="border_lineas_modelos_<?php echo $key_zona; ?>" class="w-full" id="border_lineas_modelos_<?php echo $key_zona; ?>">
                        <option value=""<?php echo $selected_sin; ?>>Sin borde</option>
                        <option value="LTRB"<?php echo $selected_con; ?>>Con borde</option>
                    </select>
                </div>
                <div>
                    <label for="inicio_alto_lineas_modelos_<?php echo $key_zona; ?>">Grueso borde:</label><br />
                    <input type="number" class="w-full" name="grueso_borde_lineas_modelos_<?php echo $key_zona; ?>" id="grueso_borde_lineas_modelos_<?php echo $key_zona; ?>" min="1" max="5" placeholder="Grueso borde" value="1" required /> mm.
                </div>
                <div>
                    <label for="color_borde_lineas_modelos_<?php echo $key_zona; ?>">Color borde:</label><br />
                    <input type="color" class="w-full" name="color_borde_lineas_modelos_<?php echo $key_zona; ?>" id="color_borde_lineas_modelos_<?php echo $key_zona; ?>" placeholder="Color borde" style="height: 35px;" value="#000000" required />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-5 mt-3 items-center space-x-3">
                <div>
                    <?php
                    if(empty($fuente_letra_lineas_modelos[$key_lineas_modelos])) {
                        $fuente_letra_lineas_modelos[$key_lineas_modelos] = "Arial";
                    }
                    ?>
                    <label for="fuente_letra_lineas_modelos_<?php echo $key_zona; ?>">Fuente letra:</label><br />
                    <input type="text" class="w-full" name="fuente_letra_lineas_modelos_<?php echo $key_zona; ?>" id="fuente_letra_lineas_modelos_<?php echo $key_zona; ?>" placeholder="Fuente letra" value="Arial" maxlength="50" required />
                </div>
                <div>
                    <?php
                    $selected_regular = " selected";
                    $selected_negrita = "";
                    $selected_cursiva = "";
                    $selected_negrita_cursiva = "";
                    ?>
                    <label for="estilo_letra_lineas_modelos_<?php echo $key_zona; ?>">Estilo letra:</label><br />
                    <select name="estilo_letra_lineas_modelos_<?php echo $key_zona; ?>" class="w-full" id="estilo_letra_lineas_modelos_<?php echo $key_zona; ?>">
                        <option value=""<?php echo $selected_regular; ?>>Normal</option>
                        <option value="B"<?php echo $selected_negrita; ?>>Negrita</option>
                        <option value="I"<?php echo $selected_cursiva; ?>>Cursiva</option>
                        <option value="BI"<?php echo $selected_negrita_cursiva; ?>>Negrita cursiva</option>
                    </select>
                </div>
                <div>
                    <label for="size_letra_lineas_modelos_<?php echo $key_zona; ?>">Tamaño letra:</label><br />
                    <input type="number" class="w-full" name="size_letra_lineas_modelos_<?php echo $key_zona; ?>" id="size_letra_lineas_modelos_<?php echo $key_zona; ?>" min="6" max="72" placeholder="Tamaño letra" value="12" required /> pt.
                </div>
                <div>
                    <?php
                    $selected_izquierda = " selected";
                    $selected_centro = "";
                    $selected_derecha = "";
                    ?>
                    <label for="alineacion_lineas_modelos_<?php echo $key_zona; ?>">Alineación letra:</label><br />
                    <select name="alineacion_lineas_modelos_<?php echo $key_zona; ?>" class="w-full" id="alineacion_lineas_modelos_<?php echo $key_zona; ?>">
                        <option value="L"<?php echo $selected_izquierda; ?>>Izquierda</option>
                        <option value="C"<?php echo $selected_centro; ?>>Centro</option>
                        <option value="R"<?php echo $selected_derecha; ?>>Derecha</option>
                    </select>
                </div>
                <div>
                    <label for="color_letra_lineas_modelos_<?php echo $key_zona; ?>">Color letra:</label><br />
                    <input type="color" class="w-full" name="color_letra_lineas_modelos_<?php echo $key_zona; ?>" id="color_letra_lineas_modelos_<?php echo $key_zona; ?>" placeholder="Color letra" style="height: 35px;" value="#000000" required />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label>Mostrar linea:</label><br />
                    <div class="flex flex-wrap">
                        <div onclick="activarElementoUnicoFicha('mostrar_lineas_modelos_<?php echo $key_zona; ?>_1', 'capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1', 'capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>')" id="capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?> poin">
                            <div class="font-bold text-left mr-2">
                                Si
                            </div>
                            <div id="contracheck_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                &nbsp;
                            </div>
                            <div id="check_mostrar_lineas_modelos_<?php echo $key_zona; ?>_1" class="hidden check_capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="mostrar_lineas_modelos_<?php echo $key_zona; ?>" id="mostrar_lineas_modelos_<?php echo $key_zona; ?>_1" value="1" class="hidden" />
                        </div>
                        <div onclick="activarElementoUnicoFicha('mostrar_lineas_modelos_<?php echo $key_zona; ?>_2', 'capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2', 'capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>')" id="capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                            <div class="font-bold text-left mr-2">
                                No
                            </div>
                            <div id="contracheck_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                &nbsp;
                            </div>
                            <div id="check_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2" class="hidden check_capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="mostrar_lineas_modelos_<?php echo $key_zona; ?>" id="mostrar_lineas_modelos_<?php echo $key_zona; ?>_2" value="0" class="hidden" />
                            <script type="text/javascript">
                                activarElementoUnicoFicha('mostrar_lineas_modelos_<?php echo $key_zona; ?>_2', 'capa_mostrar_lineas_modelos_<?php echo $key_zona; ?>_2', "capa_unicos_mostrar_lineas_modelos_<?php echo $key_zona; ?>");
                            </script>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarLinea('guardar-linea','<?php echo $key_zona; ?>','0');">Guardar</button>
                </div>
                <div>
                    <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarLinea('eliminar-linea','<?php echo $key_zona; ?>','0');">Eliminar</button>
                </div>
            </div>
            <?php
        }
        echo "<hr />";
    }
}
?>
