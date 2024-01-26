<?php
$hiddenPorModalEnProductoComboClass = ($hiddenPorModalEnProductoCombo)?? '';
$output = <<<EOD
<div class="$class_hide mt-3 $hiddenPorModalEnProductoComboClass" id="capa_precio_comprar$anadidoModal">
    <div class="px-4">
        <a href="#" class="text-sm" id="aplicar-descuento-producto-link" style="display: block;">
            Aplicar descuento
        </a>
        <label class="inline-flex relative items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer" onchange="toggleDisplay('aplicar-descuento-producto');" />
            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blendi-600"></div>
        </label>
    </div>
    <div class="px-4 mt-3">
        <div class="hidden w-full flex items-center space-x-2" id="aplicar-descuento-producto">
            <div class="w-1/4">
                <div class="text-sm">
                    Descuento %
                </div>
                <div>
                    <input type="number" class="w-full order-gray-250 rounded" name="descuento_base" id="descuento_$contador_elementos$anadidoModal" value="$descuento_recuperado" onchange="modificarCantidades($contador_elementos, '$anadidoModal', true);">
                </div>
            </div>
            <div class="w-1/4">
                <div class="text-sm">
                    Descuento €
                </div>
                <div>
                    <input type="number" class="w-full border-gray-250 rounded" name="descuento_base_euro" id="descuento_euro_$contador_elementos$anadidoModal" value="$descuento_recuperado_euro" onchange="modificarCantidades($contador_elementos, '$anadidoModal', true);">
                </div>
            </div>
            <div class="grow">&nbsp;</div>
        </div>
    </div>
</div>
<div class="mt-3 mx-4 border-t border-t-1 border-gray-450"></div>
<div class="flex flex-wrap items-center">
    <div class="hidden">
EOD;

if($tipo_librador == "pro") {
    $pvp_oferta_producto_sys[$key] = $coste_producto_principal_sys;
    $pvp_producto_sys[$key] = $coste_producto_principal_sys;
}
$outputPVP = '';
if(isset($descripcion_atributos_producto_sys[$key])) {
    if(isset($pvp_producto_sys[$key])) {
        if ($oferta_desde[$key] >= date("Y-m-d") && $oferta_hasta[$key] <= date("Y-m-d")) {
            $pvp_mostrar = $pvp_oferta_producto_sys[$key];
            $pvp_base_unidad = $pvp_mostrar;
            if (isset($descripcion_ofertas_producto_sys[$key])) {
                $outputPVP = <<<EOD
                <input type="hidden" name="descripcion_oferta_$contador_elementos" id="descripcion_oferta_$contador_elementos$anadidoModal" value="$descripcion_ofertas_producto_sys[$key]" />
                $descripcion_ofertas_producto_sys[$key]<br />
                EOD;
            }else {
                $outputPVP = <<<EOD
                <input type="hidden" name="descripcion_oferta_$contador_elementos" id="descripcion_oferta_$contador_elementos$anadidoModal" value="" />
                EOD;
            }
            if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                $outputPVP .= <<<EOD
                <input type="hidden" name="pvp_base_$contador_elementos" id="pvp_base_$contador_elementos$anadidoModal" value="$pvp_oferta_producto_sys[$key]" />
                <input type="hidden" name="pvp_linea_$contador_elementos" id="pvp_linea_$contador_elementos$anadidoModal" value="$pvp_oferta_producto_sys[$key]" />
                EOD;
            }else {
                $outputPVP .= <<<EOD
                <input type="hidden" name="pvp_base_$contador_elementos" id="pvp_base_$contador_elementos$anadidoModal" value="$coste_producto_principal_sys" />
                <input type="hidden" name="pvp_linea_$contador_elementos" id="pvp_linea_$contador_elementos$anadidoModal" value="$coste_producto_principal_sys" />
                EOD;
            }
            $pvp_oferta_producto_sysToPrint = number_format($pvp_oferta_producto_sys[$key], $decimales_importes, ",", ".");
            $outputPVP .= <<<EOD
            <input type="hidden" name="incremento_linea_$contador_elementos" id="incremento_linea_$contador_elementos$anadidoModal" value="0" />
            <span class='titulos-productos'>$etiqueta_pvp oferta:&nbsp;</span><span class='precio' id='precio$anadidoModal'>$pvp_oferta_producto_sysToPrint &euro;</span>
            <br />
            EOD;
        }else {
            $pvp_mostrar = $pvp_producto_sys[$key];
            $pvp_base_unidad = $pvp_mostrar;
            $outputPVP = <<<EOD
            <input type="hidden" name="descripcion_oferta_$contador_elementos" id="descripcion_oferta_$contador_elementos$anadidoModal" value="" />
            EOD;
            if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                $outputPVP .= <<<EOD
                <input type="hidden" name="pvp_base_$contador_elementos" id="pvp_base_$contador_elementos$anadidoModal" value="$pvp_producto_sys[$key]" />
                <input type="hidden" name="pvp_linea_$contador_elementos" id="pvp_linea_$contador_elementos$anadidoModal" value="$pvp_producto_sys[$key]" />
                EOD;
            }else {
                $outputPVP .= <<<EOD
                <input type="hidden" name="pvp_base_$contador_elementos" id="pvp_base_$contador_elementos$anadidoModal" value="$coste_producto_principal_sys" />
                <input type="hidden" name="pvp_linea_$contador_elementos" id="pvp_linea_$contador_elementos$anadidoModal" value="$coste_producto_principal_sys" />
                EOD;
            }
            $pvp_producto_sysToPrint = number_format($pvp_producto_sys[$key], $decimales_importes, ",", ".");
            $outputPVP .= <<<EOD
            <input type="hidden" name="incremento_linea_$contador_elementos" id="incremento_linea_$contador_elementos$anadidoModal" value="0" />
            <span class='titulos-productos'>$etiqueta_pvp:&nbsp;</span><span class='precio' id='precio$anadidoModal'>$pvp_producto_sysToPrint &euro;</span>
            <br />
            EOD;
        }
    }
}else {
    if ($oferta_desde[$key] >= date("Y-m-d") && $oferta_hasta[$key] <= date("Y-m-d")) {
        if (isset($descripcion_ofertas_producto_sys[$key])) {
            $outputPVP = <<<EOD
            <input type="hidden" name="descripcion_oferta_$contador_elementos" id="descripcion_oferta_$contador_elementos$anadidoModal" value="$descripcion_ofertas_producto_sys[$key]" />
            $descripcion_ofertas_producto_sys[$key]<br />
            EOD;
        }else {
            $pvp_mostrar = $pvp_oferta_producto_sys[$key];
            $pvp_base_unidad = $pvp_mostrar;
            $outputPVP = <<<EOD
            <input type="hidden" name="descripcion_oferta_$contador_elementos" id="descripcion_oferta_$contador_elementos$anadidoModal" value="" />
            EOD;
            if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                $outputPVP .= <<<EOD
                <input type="hidden" name="pvp_base_$contador_elementos" id="pvp_base_$contador_elementos$anadidoModal" value="$pvp_oferta_producto_sys[$key]" />
                <input type="hidden" name="pvp_linea_$contador_elementos" id="pvp_linea_$contador_elementos$anadidoModal" value="$pvp_oferta_producto_sys[$key]" />
                EOD;
            }else {
                $outputPVP .= <<<EOD
                <input type="hidden" name="pvp_base_$contador_elementos" id="pvp_base_$contador_elementos$anadidoModal" value="$coste_producto_principal_sys" />
                <input type="hidden" name="pvp_linea_$contador_elementos" id="pvp_linea_$contador_elementos$anadidoModal" value="$coste_producto_principal_sys" />
                EOD;
            }
            $outputPVP .= <<<EOD
            <input type="hidden" name="incremento_linea_$contador_elementos" id="incremento_linea_$contador_elementos$anadidoModal" value="0" />
            EOD;
        }
        $pvp_oferta_producto_sysToPrint = number_format($pvp_oferta_producto_sys[$key], $decimales_importes, ",", ".");
        $outputPVP .= <<<EOD
        <span class='titulos-productos'>$etiqueta_pvp oferta:&nbsp;</span><span class='precio' id='precio$anadidoModal'>$pvp_oferta_producto_sysToPrint &euro;</span>
        <br />
        EOD;
    }else {
        $pvp_mostrar = $pvp_producto_sys[$key];
        $pvp_base_unidad = $pvp_mostrar;
        $outputPVP = <<<EOD
        <input type="hidden" name="descripcion_oferta_$contador_elementos" id="descripcion_oferta_$contador_elementos$anadidoModal" value="" />
        EOD;
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            $outputPVP .= <<<EOD
            <input type="hidden" name="pvp_base_$contador_elementos" id="pvp_base_$contador_elementos$anadidoModal" value="$pvp_producto_sys[$key]" />
            <input type="hidden" name="pvp_linea_$contador_elementos" id="pvp_linea_$contador_elementos$anadidoModal" value="$pvp_producto_sys[$key]" />
            EOD;
        }else {
            $outputPVP .= <<<EOD
            <input type="hidden" name="pvp_base_$contador_elementos" id="pvp_base_$contador_elementos$anadidoModal" value="$coste_producto_principal_sys" />
            <input type="hidden" name="pvp_linea_$contador_elementos" id="pvp_linea_$contador_elementos$anadidoModal" value="$coste_producto_principal_sys" />
            EOD;
        }
        $pvpToPrint = number_format($pvp_producto_sys[$key], $decimales_importes, ",", ".");
        $outputPVP .= <<<EOD
        <input type="hidden" name="incremento_linea_$contador_elementos" id="incremento_linea_$contador_elementos$anadidoModal" value="0" />
        <span class='titulos-productos'>$etiqueta_pvp:&nbsp;</span><span class='precio' id='precio$anadidoModal'>$pvpToPrint &euro;</span>
        <br />
        EOD;
    }
}
$output .= $outputPVP;
$output .= <<<EOD
    </div>
    <div class="flex mt-3 ml-4 items-center">
        <span class="titulos-productos font-bold" id='titulo_span_combo_$contador_elementos$anadidoModal'>$etiqueta_pvp:&nbsp;</span>
EOD;
if($interface == "web") {
    $pvpToPrint = number_format($pvp_mostrar, $decimales_importes, ",", ".");
    $output .= <<<EOD
    <span class='precio w-80' id='pvp_span_combo_$contador_elementos$anadidoModal'>$pvpToPrint&nbsp;€</span>
    EOD;
}else {
    if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
        $pvpToPrint = number_format($pvp_mostrar, $decimales_importes, ".", "");
    }else {
        $pvpToPrint = number_format($coste_producto_principal_sys, $decimales_importes, ".", "");
    }

    if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
        $output .= <<<EOD
        <input type="number" class="text-center w-1/3 border-0 bg-blendimodal-background" name="precio" id="pvp_span_combo_$contador_elementos$anadidoModal" value="$pvpToPrint" onchange="document.getElementById('pvp_base_$contador_elementos$anadidoModal').value=this.value; document.getElementById('pvp_linea_$contador_elementos$anadidoModal').value=this.value; modificarCantidades('$contador_elementos','$anadidoModal', true);" />&nbsp;€
        EOD;
    }else {
        $output .= <<<EOD
        <input type="number" class="text-center w-1/3 border-0 bg-blendimodal-background" name="precio" id="pvp_span_combo_$contador_elementos$anadidoModal" value="$pvpToPrint" onchange="document.getElementById('coste_producto_$contador_elementos$anadidoModal').value=this.value; document.getElementById('pvp_base_$contador_elementos$anadidoModal').value=this.value; document.getElementById('pvp_linea_$contador_elementos$anadidoModal').value=this.value; modificarCantidades($contador_elementos, '$anadidoModal', true);" />&nbsp;€
        EOD;
    }
    if($tipo_librador == "pro" || $tipo_librador == "cre") {
        $output .= <<<EOD
        <span id="precio_total_pro_cre$anadidoModal">&nbsp;</span>
        EOD;
    }

}
?>
<?php
if(isset($unidad_principal_producto_sys) && count($unidad_principal_producto_sys) > 1) {
    $output .= <<<EOD
    <select name="unidad_producto_$contador_elementos" id="unidad_producto_$contador_elementos$anadidoModal">
    EOD;
    foreach ($unidad_principal_producto_sys as $key_unidad_principal_producto_sys => $valor_unidad_principal_producto_sys) {
        $selected = "";
        if($valor_unidad_principal_producto_sys == 1) {
            $selected = " selected";
        }
        $output .= <<<EOD
        <option value="$id_unidades_sys[$key_unidad_principal_producto_sys]"$selected>$unidad_producto_sys[$key_unidad_principal_producto_sys]</option>
        EOD;
    }
    $output .= <<<EOD
    </select>
    EOD;
}else {
    if(isset($unidad_principal_producto_sys)) {
        $output .= <<<EOD
        <input type="hidden" name="unidad_producto_$contador_elementos" id="unidad_producto_$contador_elementos$anadidoModal" value="$id_unidades_sys[0]" />
        EOD;
    }else {
        $output .= <<<EOD
        &nbsp;
        EOD;
    }
}
$classHidden = ($tipo_producto_sys == 3 || $tipo_producto_sys == 4)? 'hidden' : '';
$output .= <<<EOD
    </div>
    <div class="px-4 flex grow mt-3 items-center sm:justify-end $classHidden">
        <span class="font-bold">Total:&nbsp;<span id="pvp_total_info_$contador_elementos$anadidoModal">0</span> &euro;</span>
    </div>
</div>
EOD;

return $output;
