<?php
echo $descripcion_pack_datos;
$select_sys = "datos-otros";
$id_producto_productos_otros = $id_url;
$id_productos_detalles_enlazado_productos_otros = 0;
$id_productos_detalles_multiples_productos_otros = 0;
$id_packs_productos_otros = 0;
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
$select_sys = "stock-elaboracion";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
$select_sys = "stock-listado-elaboracion";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");

?>
<input type="hidden" id="id_productos_sku_stock" value="<?php echo $id_productos_sku; ?>" />
<input type="hidden" id="id_documento_1" value="" />
<input type="hidden" id="id_documento_2" value="" />
<input type="hidden" id="id_librador" value="" />
<input type="hidden" id="id_unidades" value="" />
<div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
    <div>
        <label for="fecha_">Fecha:</label><br>
        <input type="date" id="fecha" value="<?php echo date("Y-m-d"); ?>" class="w-full" />
    </div>
    <div>
        <label for="cantidad_">Cantidad:</label><br>
        <?php
        if($mostrar_numero_serie) {
            ?>
            <input type="hidden" name="cantidad" id="cantidad" value="1" />
            Cantidad: 1
            <?php
        }else {
            ?>
            <input type="number" id="cantidad" placeholder="Cantidad" value="" class="w-full" />
            <?php
        }
        ?>
    </div>
    <input type="hidden" name="unidad" id="unidad" value="" />
</div>
<!--
$mostrar_lote = false;
$mostrar_caducidad = false;
$mostrar_numero_serie = false;
$mostrar_codigo_barras = false;
-->
<?php
if($mostrar_codigo_barras) {
    $columnas -= 1;
}
if($columnas == 0) {
    $columnas = 4;
    $mostrar_lote_inicio = true;
    $mostrar_caducidad_inicio = true;
    $mostrar_numero_serie_inicio = true;
    $mostrar_codigo_barras = true;
}else {
    $mostrar_lote_inicio = $mostrar_lote;
    $mostrar_caducidad_inicio = $mostrar_caducidad;
    $mostrar_numero_serie_inicio = $mostrar_numero_serie;
}
?>
<div class="grid grid-cols-1 sm:grid-cols-<?php echo $columnas; ?> mt-3 items-center space-x-3">
    <?php
    if($mostrar_lote_inicio) {
        ?>
        <div>
            <label for="lote_">Lote:</label><br>
            <input type="text" id="lote" placeholder="Lote" value="" class="w-full" />
        </div>
        <?php
    }else {
        ?>
        <input type="hidden" name="lote" id="lote" value="" />
        <?php
    }
    if($mostrar_caducidad_inicio) {
        ?>
        <div>
            <label for="caducidad_">Caducidad:</label><br>
            <input type="date" id="caducidad" class="w-full" />
        </div>
        <?php
    }else {
        ?>
        <input type="hidden" name="caducidad" id="caducidad" value="0000-00-00" />
        <?php
    }
    if($mostrar_numero_serie_inicio) {
        ?>
        <div>
            <label for="numero_serie_">Número serie:</label><br>
            <input type="text" id="numero_serie" placeholder="Número serie" value="" class="w-full" />
        </div>
        <?php
    }else {
        ?>
        <input type="hidden" name="numero_serie" id="numero_serie" value="" />
        <?php
    }
    ?>
    <input type="hidden" name="tipo_documento" id="tipo_documento" value="ela" />
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div id="capa_guardar_update" class="mb-2 flex justify-end">
        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarElaboracion('<?php echo $id_url; ?>','<?php echo $id_productos_otros_datos; ?>','<?php echo $id_productos_sku; ?>','<?php echo $id_productos_detalles_enlazado; ?>','<?php echo $id_productos_detalles_multiples; ?>','<?php echo $id_packs; ?>');">Guardar</button>
    </div>
</div>
&nbsp;
<div class="grid grid-cols-12 items-center h-10 bg-gray-50 dark:text-white mt-6">
    <div class="text-center px-2">
        &nbsp;
    </div>
    <?php
    if($mostrar_lote_inicio) {
        ?>
        <div class="px-2 col-span-2">
            Lote
        </div>
        <?php
    }
    if($mostrar_caducidad_inicio) {
        ?>
        <div class="px-2 col-span-2">
            Caducidad
        </div>
        <?php
    }
    if($mostrar_numero_serie_inicio) {
        ?>
        <div class="px-2 col-span-4">
            Nº de serie
        </div>
        <?php
    }
    ?>
    <div class="px-2 col-span-2">
        Fecha
    </div>
    <div class="px-2">
        Cantidad
    </div>
    <div class="px-2 col-span-3">
        Etiquetas
    </div>
    <div class="px-2">
        Tíquets
    </div>
</div>
<div class="overflow-y-auto bg-white">
    <?php
    foreach ($elaboraciones as $datos_elaboraciones) {
        $total_campos = 9;
        $sumar_anchos = 0;
        $ancho_descripcion = 16;
        $ancho_lote = 12;
        $ancho_caducidad = 12;
        $ancho_numero_serie = 12;
        $ancho_codigo_barras = 12;
        $ancho_fecha = 12;
        $ancho_cantidad = 6;
        $ancho_boton_imprimir_etiquetas = 12;
        $ancho_boton_imprimir_tiquets = 6;
        if(!isset($datos_elaboraciones->lote)) {
            $total_campos -= 1;
            $sumar_anchos += $ancho_lote;
        }
        if(!isset($datos_elaboraciones->caducidad)) {
            $total_campos -= 1;
            $sumar_anchos += $ancho_caducidad;
        }
        if(!isset($datos_elaboraciones->numero_serie)) {
            $total_campos -= 1;
            $sumar_anchos += $ancho_numero_serie;
        }
        if(!isset($datos_elaboraciones->codigo_barras)) {
            $total_campos -= 1;
            $sumar_anchos += $ancho_codigo_barras;
        }
        $sumar_anchos = $sumar_anchos / $total_campos;
        ?>
        <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
            <input type="hidden" name="id-elaboracion<?php echo $datos_elaboraciones->id; ?>" id="id-elaboracion<?php echo $datos_elaboraciones->id; ?>" value="<?php echo $datos_elaboraciones->id; ?>" />
            <div class="px-2 cursor-pointer">
                <div id="tabla_datos_elaboracion_<?php echo $datos_elaboraciones->id; ?>-show"
                     onclick="collapseCapa('tabla_datos_elaboracion_<?php echo $datos_elaboraciones->id; ?>');">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                <div id="tabla_datos_elaboracion_<?php echo $datos_elaboraciones->id; ?>-hidden" class="hidden"
                     onclick="collapseCapa('tabla_datos_elaboracion_<?php echo $datos_elaboraciones->id; ?>');">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                </div>
            </div>
            <?php
            if(isset($datos_elaboraciones->lote)) {
                ?>
                <div class="px-2 col-span-2">
                    <?php echo $datos_elaboraciones->lote; ?>
                </div>
                <?php
            }
            if(isset($datos_elaboraciones->caducidad)) {
                ?>
                <div class="px-2 col-span-2">
                    <?php echo $datos_elaboraciones->caducidad; ?>
                </div>
                <?php
            }
            if(isset($datos_elaboraciones->numero_serie)) {
                ?>
                <div class="px-2 col-span-4">
                    <?php echo $datos_elaboraciones->numero_serie; ?>
                </div>
                <?php
            }
            ?>
            <div class="px-2 col-span-2">
                <?php echo $datos_elaboraciones->fecha; ?>
            </div>
            <div class="px-2 text-right">
                <?php echo number_format($datos_elaboraciones->cantidad, $decimales_cantidades, ",", "."); ?>
            </div>
            <div class="px-2 col-span-3 grid grid-cols-2 space-x-2 items-center">
                <div>
                    <input type="text" id="cantidad_imprimir_etiqueta_<?php echo (isset($datos_elaboraciones->id))? $datos_elaboraciones->id : ''; ?>" value="<?php echo $datos_elaboraciones->cantidad; ?>" class="w-full" />
                </div>
                <div>
                    <button onclick="imprimirEtiquetas({
                            'id': '<?php echo (isset($datos_elaboraciones->id))? $datos_elaboraciones->id : ''; ?>',
                            'descripcion_producto': '<?php echo (isset($datos_elaboraciones->descripcion))? addslashes($datos_elaboraciones->descripcion) : ''; ?>',
                            'lote': '<?php echo (isset($datos_elaboraciones->lote))? addslashes($datos_elaboraciones->lote) : ''; ?>',
                            'caducidad': '<?php echo (isset($datos_elaboraciones->caducidad))? addslashes($datos_elaboraciones->caducidad) : ''; ?>',
                            'numero_serie': '<?php echo (isset($datos_elaboraciones->numero_serie))? addslashes($datos_elaboraciones->numero_serie) : ''; ?>',
                            'codigo_barras': '<?php echo (isset($datos_elaboraciones->codigo_barras))? addslashes($datos_elaboraciones->codigo_barras) : ''; ?>',
                            }); return false;">Etiqueta</button>
                </div>
            </div>
            <div class="px-2">
                <button onclick="imprimirTiquets({
                        'descripcion_producto': '<?php echo (isset($datos_elaboraciones->descripcion)) ? addslashes($datos_elaboraciones->descripcion) : ''; ?>',
                        'lote': '<?php echo (isset($datos_elaboraciones->lote)) ? addslashes($datos_elaboraciones->lote) : ''; ?>',
                        'caducidad': '<?php echo (isset($datos_elaboraciones->caducidad)) ? addslashes($datos_elaboraciones->caducidad) : ''; ?>',
                        'numero_serie': '<?php echo (isset($datos_elaboraciones->numero_serie)) ? addslashes($datos_elaboraciones->numero_serie) : ''; ?>',
                        'codigo_barras': '<?php echo (isset($datos_elaboraciones->codigo_barras)) ? addslashes($datos_elaboraciones->codigo_barras) : ''; ?>',
                        },
                        lineas_datos_cantidad<?php echo $datos_elaboraciones->id; ?>,
                        lineas_datos_descripciones<?php echo $datos_elaboraciones->id; ?>,
                        lineas_datos_lotes<?php echo $datos_elaboraciones->id; ?>,
                        lineas_datos_caducidades<?php echo $datos_elaboraciones->id; ?>,
                        lineas_datos_numeros_serie<?php echo $datos_elaboraciones->id; ?>); return false;">Tiquet</button>
            </div>
        </div>
        <script>
            setTimeout(function() {
                <?php
                $datos_cantidades = '';
                $datos_descripciones = '';
                $datos_lotes = '';
                $datos_caducidades = '';
                $datos_numeros_serie = '';
                foreach ($datos_elaboraciones->lineasDatos as $lineasElaboraciones) {
                    if(empty($datos_cantidades)) {
                        $datos_cantidades = "window.lineas_datos_cantidad".$datos_elaboraciones->id." = [";
                        $datos_descripciones = "window.lineas_datos_descripciones".$datos_elaboraciones->id." = [";
                        $datos_lotes = "window.lineas_datos_lotes".$datos_elaboraciones->id." = [";
                        $datos_caducidades = "window.lineas_datos_caducidades".$datos_elaboraciones->id." = [";
                        $datos_numeros_serie = "window.lineas_datos_numeros_serie".$datos_elaboraciones->id." = [";
                    }else {
                        $datos_cantidades .= ",";
                        $datos_descripciones .= ",";
                        $datos_lotes .= ",";
                        $datos_caducidades .= ",";
                        $datos_numeros_serie .= ",";
                    }
                    $datos_cantidades .= '"'.number_format($lineasElaboraciones->cantidad_linea, $decimales_cantidades, ",", ".").'"';
                    $datos_descripciones .= '"'.$lineasElaboraciones->descripcion_linea.'"';
                    $datos_lotes .= '"'.$lineasElaboraciones->lote_linea.'"';
                    $datos_caducidades .= '"'.$lineasElaboraciones->caducidad_linea.'"';
                    $datos_numeros_serie .= '"'.$lineasElaboraciones->numero_serie_linea.'"';
                }
                $datos_cantidades .= "];";
                $datos_descripciones .= "];";
                $datos_lotes .= "];";
                $datos_caducidades .= "];";
                $datos_numeros_serie .= "];";
                echo $datos_cantidades;
                echo $datos_descripciones;
                echo $datos_lotes;
                echo $datos_caducidades;
                echo $datos_numeros_serie;
                ?>
            }, 50);
        </script>

        <?php
        foreach ($datos_elaboraciones->lineasDatos as $lineasElaboraciones) {
            $total_campos = 8;
            $sumar_anchos = 0;
            $ancho_descripcion = 23;
            $ancho_lote = 11;
            $ancho_caducidad = 11;
            $ancho_numero_serie = 11;
            $ancho_codigo_barras = 11;
            $ancho_fecha = 11;
            $ancho_cantidad = 11;
            $ancho_boton_guardar = 11;
            if(!isset($lineasElaboraciones->lote_linea)) {
                $total_campos -= 1;
                $sumar_anchos += $ancho_lote;
            }
            if(!isset($lineasElaboraciones->caducidad_linea)) {
                $total_campos -= 1;
                $sumar_anchos += $ancho_caducidad;
            }
            if(!isset($lineasElaboraciones->numero_serie_linea)) {
                $total_campos -= 1;
                $sumar_anchos += $ancho_numero_serie;
            }
            if(!isset($lineasElaboraciones->codigo_barras_linea)) {
                $total_campos -= 1;
                $sumar_anchos += $ancho_codigo_barras;
            }
            $sumar_anchos = $sumar_anchos / $total_campos;
            break;
        }
        ?>
        <div id="tabla_datos_elaboracion_<?php echo $datos_elaboraciones->id; ?>" class="hidden">
            <div class="grid grid-cols-12 items-center h-10 bg-gray-50 dark:text-white mt-6">
                <div class="px-2 col-span-5">
                    Producto
                </div>
                <?php
                if(isset($lineasElaboraciones->lote_linea)) {
                    ?>
                    <div class="px-2 col-span-2">
                        Lote
                    </div>
                    <?php
                }
                if(isset($lineasElaboraciones->caducidad_linea)) {
                    ?>
                    <div class="px-2 col-span-2">
                        Caducidad
                    </div>
                    <?php
                }
                if(isset($lineasElaboraciones->numero_serie_linea)) {
                    ?>
                    <div class="px-2 col-span-4">
                        Nº de serie
                    </div>
                    <?php
                }
                ?>
                <div class="px-2">
                    Cantidad
                </div>
                <div class="px-2 col-span-2">
                    &nbsp;
                </div>
            </div>
            <?php
            foreach ($datos_elaboraciones->lineasDatos as $lineasElaboraciones) {
                ?>
                <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
                    <input type="hidden" name="id-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" id="id-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" value="<?php echo $lineasElaboraciones->id_linea; ?>" />
                    <div class="px-2 col-span-5">
                        <?php echo $lineasElaboraciones->descripcion_linea; ?>
                    </div>
                    <?php
                    /*
                    Lote, caducidad y numero de serie deberian ser desplegables con lotes/numeros de serie disponibles.
                    Pueden haber mas de una linea en caso de lotes que no tengan suficiente cantidad.
                    */
                    if(isset($lineasElaboraciones->lote_linea)) {
                        ?>
                        <div class="px-2 col-span-2" id="lote-linea-elaboracion_<?php echo $lineasElaboraciones->id_linea; ?>_trigger">
                            <input type="text" style="width: 100%;" maxlength="20" name="lote-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" id="lote-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" value="<?php echo $lineasElaboraciones->lote_linea; ?>" onkeyup="loteBuscador(<?php echo $lineasElaboraciones->id_linea; ?>)" />
                        </div>
                        <div id="lote-linea-elaboracion_<?php echo $lineasElaboraciones->id_linea; ?>_target" class="hidden bg-white border-2 rounded bg-white cursor-pointer">
                            ...
                        </div>
                        <script type="text/javascript">
                            loadDropdownLoteBuscador(<?php echo $lineasElaboraciones->id_linea; ?>);
                        </script>
                        <?php
                    }
                    if(isset($lineasElaboraciones->caducidad_linea)) {
                        ?>
                        <div class="px-2 col-span-2">
                            <input type="date" style="width: 100%;" name="caducidad-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" id="caducidad-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" value="<?php echo $lineasElaboraciones->caducidad_linea; ?>" />
                        </div>
                        <?php
                    }
                    if(isset($lineasElaboraciones->numero_serie_linea)) {
                        ?>
                        <div class="px-2 col-span-4" id="numero_serie-linea-elaboracion_<?php echo $lineasElaboraciones->id_linea; ?>_trigger">
                            <input type="text" style="width: 100%;" maxlength="20" name="numero_serie-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" id="numero_serie-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" value="<?php echo $lineasElaboraciones->numero_serie_linea; ?>" />
                        </div>
                        <div id="numero_serie-linea-elaboracion_<?php echo $lineasElaboraciones->id_linea; ?>_target" class="hidden bg-white border-2 rounded bg-white cursor-pointer">
                            ...
                        </div>
                        <script type="text/javascript">
                            loadDropdownNumeroSerieBuscador(<?php echo $lineasElaboraciones->id_linea; ?>);
                        </script>
                        <?php
                    }
                    ?>
                    <div class="px-2 text-right">
                        <input type="hidden" name="total_cantidad-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" id="total_cantidad-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" value="<?php echo number_format($lineasElaboraciones->cantidad_linea, $decimales_cantidades, ".", ""); ?>" />
                        <input type="number" style="width: 100%;" maxlength="20" name="cantidad-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" id="cantidad-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" value="<?php echo number_format($lineasElaboraciones->cantidad_linea, $decimales_cantidades, ".", ""); ?>" />
                    </div>
                    <div class="px-2 col-span-2 flex flex-wrap items-center justify-end">
                        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="guardarLoteElaboracion('<?php echo $datos_elaboraciones->id; ?>','<?php echo $lineasElaboraciones->id_linea; ?>'); return false;">Guardar</button>
                        <div id="check-linea-elaboracion<?php echo $lineasElaboraciones->id_linea; ?>" class="hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 25px; height: 25px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    unset($elaboraciones);
    ?>
</div>
