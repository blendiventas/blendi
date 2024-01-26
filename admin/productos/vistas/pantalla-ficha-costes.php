<?php
function print_complex_product_table($coste_elaborado, $nivel, $decimales_cantidades_configuracion, $decimales_importes_configuracion) {
    foreach ($coste_elaborado['matriz_simple_composicion'] as $key_simple => $valor_simple) {
        echo '<div class="grid grid-cols-1 sm:grid-cols-8 items-center sm:h-16 bg-white border-2 border-gray-50">';
        echo "<div class='tab-".$nivel." px-2 col-span-4'>" . $valor_simple."</div>";
        echo "<div class='tab-".$nivel." px-2 text-right'>" . number_format($coste_elaborado['matriz_coste_producto'][$key_simple], $decimales_importes_configuracion, ",", ".")."€</div>";
        echo "<div class='tab-".$nivel." px-2 text-right'>" . number_format($coste_elaborado['matriz_cantidad_producto'][$key_simple], $decimales_cantidades_configuracion, ",", ".")."</div>";
        echo "<div class='tab-".$nivel." px-2 text-right'>" . number_format($coste_elaborado['matriz_tiempo_producto'][$key_simple], 0, ",", ".")."</div>";
        if (!$nivel) {
            echo "<div class='tab- px-2 text-right'>" . number_format(($coste_elaborado['matriz_coste_producto'][$key_simple] * $coste_elaborado['matriz_cantidad_producto'][$key_simple]), $decimales_importes_configuracion, ",", ".")."€</div>";
        } else {
            echo "<div class='px-2'>&nbsp;</div>";
        }
        echo "</div>";
    }
    foreach ($coste_elaborado['matriz_complejo_composicion'] as $key_complejo => $valor_complejo) {
        echo '<div class="grid grid-cols-1 sm:grid-cols-8 items-center sm:h-16 bg-white border-2 border-gray-50">';
        echo "<div class='tab-".$nivel." px-2 col-span-4 font-bold'>" . $valor_complejo."</div>";
        echo "<div class='tab-".$nivel." px-2 text-right'>" . number_format($coste_elaborado['matriz_coste_kilo_composicion'][$key_complejo], $decimales_importes_configuracion, ",", ".")."€</div>";
        echo "<div class='tab-".$nivel." px-2 text-right'>" . number_format($coste_elaborado['matriz_cantidad_composicion'][$key_complejo], $decimales_cantidades_configuracion, ",", ".")."</div>";
        echo "<div class='tab-".$nivel." px-2 text-right'>" . number_format($coste_elaborado['matriz_tiempo_producto'][$key_complejo], 0, ",", ".")."</div>";
        if (!$nivel) {
            echo "<div class='tab- px-2 text-right'>" . number_format(($coste_elaborado['matriz_coste_kilo_composicion'][$key_complejo] * $coste_elaborado['matriz_cantidad_composicion'][$key_complejo]), $decimales_importes_configuracion, ",", ".")."€</div>";
        } else {
            echo "<div class='px-2'>&nbsp;</div>";
        }
        echo "</div>";
        print_complex_product_table($coste_elaborado['matriz_hijos'][$key_complejo], $nivel . 'x', $decimales_cantidades_configuracion, $decimales_importes_configuracion);
    }
}
?>

<input type="hidden" name="apartado" id="apartado" value="costes" />

<input type="hidden" id="id_productos_elaborados" name="id_productos_elaborados" value="<?php echo $id_productos_elaborados; ?>" />
<input type="hidden" id="tipo_producto" name="tipo_producto" value="<?php echo $tipo_producto_productos; ?>" />
<?php
$select_sys = "unidades";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
$id_unidades_base = 0;
$descripcion_unidades_base = "";
foreach ($id_unidades as $key_unidades => $valor_unidades) {
    foreach ($principal_productos_unidades as $key_principal_productos_unidades => $valor_principal_productos_unidades) {
        if ($id_unidad_productos_unidades[$key_principal_productos_unidades] == $valor_unidades && $valor_principal_productos_unidades == 1) {
            $id_unidades_base = $valor_unidades;
            $descripcion_unidades_base = $unidad_unidades[$key_unidades];
            break;
        }
    }
}
?>
<input type="hidden" id="id_unidades_base_productos_elaborados" name="id_unidades_base_productos_elaborados" value="<?php echo $id_unidades_base; ?>" />
<?php
$columnas = 1;
if(($tipo_producto_productos == 1 || $tipo_producto_productos == 2 || $tipo_producto_productos == 3 || $tipo_producto_productos == 4) && $producto_venta_productos == 0) {
    $columnas = 2;
}
?>
<div class="grid grid-cols-1 sm:grid-cols-<?php echo $columnas; ?> mt-3 items-center space-x-3">
    <?php
    if(($tipo_producto_productos == 1 || $tipo_producto_productos == 2 || $tipo_producto_productos == 3 || $tipo_producto_productos == 4) && $producto_venta_productos == 0) {
        ?>
        <div>
            <label for="cantidad_base_productos_elaborados">Total elaboración peso final en <?php echo $descripcion_unidades_base; ?>:</label><br>
            <input type="number" class="w-full" name="cantidad_base_productos_elaborados" id="cantidad_base_productos_elaborados" placeholder="Cantidad" value="<?php echo $cantidad_base_productos_elaborados; ?>" step="0.01" required onchange="avisoRentabilidad();" />
        </div>
        <?php
    }
    /*
    363544
    minutos = 6059
    horas = 100
    minutos = 59
    */
    $minutos_tiempo_productos_elaborados = intdiv($tiempo_productos_elaborados, 60);
    $horas_tiempo_productos_elaborados = intdiv($minutos_tiempo_productos_elaborados, 60);
    $tiempo_productos_elaborados = $tiempo_productos_elaborados - ($horas_tiempo_productos_elaborados * 60 * 60);
    $minutos_tiempo_productos_elaborados = intdiv($tiempo_productos_elaborados, 60);
    $segundos_tiempo_productos_elaborados = $tiempo_productos_elaborados - ($minutos_tiempo_productos_elaborados * 60);
    ?>
    <div class="grid grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <label for="horas_tiempo_base_productos_elaborados">Horas:</label><br>
            <select name="horas_tiempo_base_productos_elaborados" class="w-full" id="horas_tiempo_base_productos_elaborados">
                <?php
                for ($bucle_tiempo = 0 ; $bucle_tiempo <= 100 ; $bucle_tiempo++) {
                    $selected = '';
                    if($bucle_tiempo == $horas_tiempo_productos_elaborados) {
                        $selected = ' selected';
                    }
                    ?>
                    <option value="<?php echo $bucle_tiempo; ?>"<?php echo $selected; ?>><?php echo sprintf('%02d', $bucle_tiempo); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label for="minutos_tiempo_base_productos_elaborados">Minutos:</label><br>
            <select name="minutos_tiempo_base_productos_elaborados" class="w-full" id="minutos_tiempo_base_productos_elaborados">
                <?php
                for ($bucle_tiempo = 0 ; $bucle_tiempo <= 59 ; $bucle_tiempo++) {
                    $selected = '';
                    if($bucle_tiempo == $minutos_tiempo_productos_elaborados) {
                        $selected = ' selected';
                    }
                    ?>
                    <option value="<?php echo $bucle_tiempo; ?>"<?php echo $selected; ?>><?php echo sprintf('%02d', $bucle_tiempo); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label for="segundos_tiempo_base_productos_elaborados">Segundos:</label><br>
            <select name="segundos_tiempo_base_productos_elaborados" class="w-full" id="segundos_tiempo_base_productos_elaborados">
                <?php
                for ($bucle_tiempo = 0 ; $bucle_tiempo <= 59 ; $bucle_tiempo++) {
                    $selected = '';
                    if($bucle_tiempo == $segundos_tiempo_productos_elaborados) {
                        $selected = ' selected';
                    }
                    ?>
                    <option value="<?php echo $bucle_tiempo; ?>"<?php echo $selected; ?>><?php echo sprintf('%02d', $bucle_tiempo); ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <?php
    if($tipo_producto_productos != 0) {
        if($tipo_producto_productos == 1) {
            $etiqueta_coste = "elaborado";
        }else if($tipo_producto_productos == 2) {
            $etiqueta_coste = "compuesto";
        }else if($tipo_producto_productos == 3 || $tipo_producto_productos == 4) {
            $etiqueta_coste = "combo";
        }
        ?>
        <div>
            <?php
            $select_sys = "calculo-costes";
            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");
            ?>
            <div id="tabla_datos_detalles_costes_totales-show" class="flex cursor-pointer"
                 onclick="collapseCapa('tabla_datos_detalles_costes_totales');">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
                &nbsp;Detalles coste total
            </div>
            <div id="tabla_datos_detalles_costes_totales-hidden" class="flex cursor-pointer hidden"
                 onclick="collapseCapa('tabla_datos_detalles_costes_totales');">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
                &nbsp;Detalles coste total
            </div>
            <div id="tabla_datos_detalles_costes_totales" class="text-left mx-5 hidden">
                <div class="grid grid-cols-1 sm:grid-cols-8 items-center sm:h-10 bg-gray-50 mt-6">
                    <div class="px-2 col-span-4">Descripción</div>
                    <div class="px-2">Coste/Kg</div>
                    <div class="px-2">Cantidad</div>
                    <div class="px-2">Minutos</div>
                    <div class="px-2">Total</div>
                </div>
                <?php
                print_complex_product_table($coste_elaborado, '', 3, $decimales_importes_configuracion);
                ?>
            </div>
            <?php
            echo "Coste ".$etiqueta_coste." TOTAL: ".number_format($coste_elaborado['coste_elaborado'], $decimales_importes_configuracion, ",", ".")." €<br />";
            if($producto_venta_productos == 0) {
                $select_sys = "calculo-costes-kgr";
                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");
                echo "Coste ".$etiqueta_coste." KG.: " . number_format($coste_elaborado, $decimales_importes_configuracion, ",", ".") . " €<br />";
            }
            if($tipo_producto_productos == 1 && $producto_venta_productos == 0) {
                ?>
                Rentabilidad elaboración: <span id="rentabilidad_del_elaborado"><?php echo number_format($rentabilidad_productos_elaborados, 2, ",", "."); ?></span>%<br />
                <?php
            }
            ?>

            <?php
            $select_sys = "calculo-costes-personal";
            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");
            //echo "Coste personal TOTAL: ".number_format($coste_personal, $decimales_importes_configuracion, ",", ".")." €<br />";
            ?>
        </div>
        <?php
    }
    ?>
</div>
<?php
if($tipo_producto_productos == 0 || $tipo_producto_productos == 2) {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <label for="importe">Coste (Coste neto: <?php echo $coste_neto; ?>):</label><br>
            <input type="number" name="coste" class="w-full" id="coste" placeholder="coste" value="<?php echo $coste_productos; ?>" />
        </div>
        <div>
            <label for="importe">Peso bruto en <?php echo $descripcion_unidades_base; ?>:</label><br>
            <input type="number" name="peso_bruto" class="w-full" id="peso_bruto" placeholder="peso bruto" value="<?php echo $peso_bruto_productos; ?>" />
        </div>
        <div>
            <label for="importe">Peso neto en <?php echo $descripcion_unidades_base; ?>:</label><br>
            <input type="number" name="peso_neto" class="w-full" id="peso_neto" placeholder="peso neto" value="<?php echo $peso_neto_productos; ?>" />
        </div>
    </div>
    <?php
}
?>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 justify-end items-center space-x-3" id="capa-guardar-elaborado">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div id="capa_guardar_update_<?php echo $contador_elementos; ?>" class="flex justify-end">
        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarCoste(<?php echo $id_url; ?>,'<?php echo $apartado_url; ?>');">Guardar</button>
    </div>
</div>
<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <strong>Datos costes base</strong>
</div>
<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <?php

    $id_producto_productos = $id_url;
    $id_productos_detalles_enlazado_productos = 0;
    $id_productos_detalles_multiples_productos = 0;
    $id_packs_productos = 0;

    $id_producto_productos_otros = $id_url;
    $id_productos_detalles_enlazado_productos_otros = 0;
    $id_productos_detalles_multiples_productos_otros = 0;
    $id_packs_productos_otros = 0;
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/datos-costes-proveedores.php");
    ?>
</div>
<?php
$select_sys = "packs";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/packs/gestion/datos-select-php.php");
/*
$matriz_id_productos_packs[] = $valor_productos_packs['id'];
$matriz_id_productos_detalles_enlazado_productos_packs[] = $valor_productos_packs['id_productos_detalles_enlazado'];
$matriz_id_productos_detalles_multiple_productos_packs[] = $valor_productos_packs['id_productos_detalles_multiple'];
$matriz_cantidad_pack_productos_packs[] = $valor_productos_packs['cantidad_pack'];
$matriz_activo_productos_packs[] = $valor_productos_packs['activo'];
$matriz_orden_productos_packs[] = $valor_productos_packs['orden'];
$matriz_fecha_alta_productos_packs[] = $valor_productos_packs['fecha_alta'];
$matriz_fecha_modificacion_productos_packs[] = $valor_productos_packs['fecha_modificacion'];
*/
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/componentes/form-datos.php");
$select_sys = "listado_relaciones_producto";
require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
/*
$matriz_productos_detalles_relacion_id
$matriz_productos_detalles_relacion_id_atributo_principal
$matriz_productos_detalles_relacion_id_dato_principal
$matriz_productos_detalles_relacion_id_atributo_enlazado
$matriz_productos_detalles_relacion_id_dato_enlazado
$matriz_productos_detalles_relacion_activo
*/
if(isset($matriz_productos_detalles_relacion_id)) {
    $datos_atributos_enlazados = true;
    foreach ($matriz_productos_detalles_relacion_id as $Key_productos_detalles_relacion_id => $valor_productos_detalles_relacion_id) {
        $matriz_id[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $valor_productos_detalles_relacion_id;
        $id_atributo_vertical = $matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id];
        $atributo_vertical = $atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id]];
        $matriz_vertical_datos[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]] = $datos_atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]];
        $id_atributo_horizontal = $matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id];
        $atributo_horizontal = $atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id]];
        $matriz_horizontal_datos[$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $datos_atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]];
        $matriz_activo[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $matriz_productos_detalles_relacion_activo[$Key_productos_detalles_relacion_id];
    }
}
?>
<input type="hidden" name="pack_producto" value="<?php echo $id_url; ?>" />
<input type="hidden" id="id_productos_packs" name="id_productos_packs" value="" />
<?php
$select_sys = "listado_relaciones_producto";
require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
/*
$matriz_productos_detalles_relacion_id
$matriz_productos_detalles_relacion_id_atributo_principal
$matriz_productos_detalles_relacion_id_dato_principal
$matriz_productos_detalles_relacion_id_atributo_enlazado
$matriz_productos_detalles_relacion_id_dato_enlazado
$matriz_productos_detalles_relacion_activo
*/
if(isset($matriz_productos_detalles_relacion_id)) {
    $datos_atributos_enlazados = true;
    foreach ($matriz_productos_detalles_relacion_id as $Key_productos_detalles_relacion_id => $valor_productos_detalles_relacion_id) {
        $matriz_id[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $valor_productos_detalles_relacion_id;
        $id_atributo_vertical = $matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id];
        $atributo_vertical = $atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id]];
        $matriz_vertical_datos[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]] = $datos_atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]];
        $id_atributo_horizontal = $matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id];
        $atributo_horizontal = $atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id]];
        $matriz_horizontal_datos[$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $datos_atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_enlazado[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]];
        $matriz_activo[$matriz_productos_detalles_relacion_id_dato_principal[$Key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$Key_productos_detalles_relacion_id]] = $matriz_productos_detalles_relacion_activo[$Key_productos_detalles_relacion_id];
    }
    ?>
    <table id="tabla_nuevos_packs" class="hidden" style="text-align: center; border: #6c757d solid 1px; width: 100%;">
        <tr>
            <td rowspan="2"><?php echo $atributo_vertical; ?></td>
            <td colspan="<?php echo count($matriz_horizontal_datos); ?>"><?php echo $atributo_horizontal; ?></td>
        </tr>
        <tr>
            <?php
            foreach ($matriz_horizontal_datos as $Key_horizontal_datos => $valor_horizontal_datos) {
                echo "<td style='border: #6c757d solid 1px;'>".$valor_horizontal_datos."</td>";
            }
            ?>
        </tr>
        <?php
        foreach ($matriz_vertical_datos as $Key_vertical_datos => $valor_vertical_datos) {
            echo "<tr>";
            echo "<td style='border: #6c757d solid 1px;'>".$valor_vertical_datos."</td>";
            foreach ($matriz_horizontal_datos as $Key_horizontal_datos => $valor_horizontal_datos) {
                echo "<td style='border: #6c757d solid 1px;' id='capa_img_activo_".$matriz_id[$Key_vertical_datos][$Key_horizontal_datos]."'>";
                if($matriz_activo[$Key_vertical_datos][$Key_horizontal_datos] == 1) {
                    $otros_base_mostrado = false;
                    foreach ($matriz_id_productos_packs as $key_id_productos_packs => $valor_id_productos_packs) {
                        ?>
                        <input type="hidden" name="id_productos[]" value="<?php echo $matriz_id[$Key_vertical_datos][$Key_horizontal_datos]; ?>" />
                        <?php
                        if (!empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs])) {
                            if ($matriz_id[$Key_vertical_datos][$Key_horizontal_datos] == $matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs]) {
                                $descripcion_pack_datos = "<strong>PACK: ".$matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;units.</strong><br />";

                                $id_productos_detalles_enlazado_url = $matriz_id[$Key_vertical_datos][$Key_horizontal_datos];
                                $id_packs_url = $valor_id_productos_packs;
                                $id_producto_productos = $id_url;
                                $id_productos_detalles_enlazado_productos = $id_productos_detalles_enlazado_url;
                                $id_productos_detalles_multiples_productos = 0;
                                $id_packs_productos = $id_packs_url;

                                $id_producto_productos_otros = $id_url;
                                $id_productos_detalles_enlazado_productos_otros = $id_productos_detalles_enlazado_url;
                                $id_productos_detalles_multiples_productos_otros = 0;
                                $id_packs_productos_otros = $id_packs_url;
                                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/datos-costes-proveedores.php");
                                unset($descripcion_pack_datos);
                                unset($id_packs_url);
                            }else if($otros_base_mostrado == false) {
                                $otros_base_mostrado = true;

                                $id_productos_detalles_enlazado_url = $matriz_id[$Key_vertical_datos][$Key_horizontal_datos];
                                $id_producto_productos = $id_url;
                                $id_productos_detalles_enlazado_productos = $id_productos_detalles_enlazado_url;
                                $id_productos_detalles_multiples_productos = 0;
                                $id_packs_productos = 0;

                                $id_producto_productos_otros = $id_url;
                                $id_productos_detalles_enlazado_productos_otros = $id_productos_detalles_enlazado_url;
                                $id_productos_detalles_multiples_productos_otros = 0;
                                $id_packs_productos_otros = 0;
                                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/datos-costes-proveedores.php");
                            }
                        }else if($otros_base_mostrado == false) {

                            $otros_base_mostrado = true;
                            $id_productos_detalles_enlazado_url = $matriz_id[$Key_vertical_datos][$Key_horizontal_datos];
                            $id_producto_productos = $id_url;
                            $id_productos_detalles_enlazado_productos = $id_productos_detalles_enlazado_url;
                            $id_productos_detalles_multiples_productos = 0;
                            $id_packs_productos = 0;

                            $id_producto_productos_otros = $id_url;
                            $id_productos_detalles_enlazado_productos_otros = $id_productos_detalles_enlazado_url;
                            $id_productos_detalles_multiples_productos_otros = 0;
                            $id_packs_productos_otros = 0;
                            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/datos-costes-proveedores.php");
                        }
                    }
                    if($otros_base_mostrado == false){

                        $id_productos_detalles_enlazado_url = $matriz_id[$Key_vertical_datos][$Key_horizontal_datos];
                        $id_producto_productos = $id_url;
                        $id_productos_detalles_enlazado_productos = $id_productos_detalles_enlazado_url;
                        $id_productos_detalles_multiples_productos = 0;
                        $id_packs_productos = 0;

                        $id_producto_productos_otros = $id_url;
                        $id_productos_detalles_enlazado_productos_otros = $id_productos_detalles_enlazado_url;
                        $id_productos_detalles_multiples_productos_otros = 0;
                        $id_packs_productos_otros = 0;
                        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/datos-costes-proveedores.php");
                    }
                } else {
                    echo "&nbsp;";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
    <?php
    unset($matriz_productos_detalles_relacion_id);
    unset($matriz_productos_detalles_relacion_id_atributo_principal);
    unset($matriz_productos_detalles_relacion_id_dato_principal);
    unset($matriz_productos_detalles_relacion_id_atributo_enlazado);
    unset($matriz_productos_detalles_relacion_id_dato_enlazado);
    unset($matriz_productos_detalles_relacion_activo);
    unset($matriz_id);
    unset($id_atributo_vertical);
    unset($atributo_vertical);
    unset($matriz_vertical_datos);
    unset($id_atributo_horizontal);
    unset($atributo_horizontal);
    unset($matriz_horizontal_datos);
    unset($matriz_activo);
}
?>
<div id="capa_packs_multiples" class="hidden">
    <?php
    foreach ($matriz_id_productos_packs as $key_id_productos_packs => $valor_id_productos_packs) {
        $descripcion_pack = "";
        if(!empty($matriz_id_productos_detalles_multiple_productos_packs[$key_id_productos_packs])) {
            $id_productos_detalles_multiples = $matriz_id_productos_detalles_multiple_productos_packs[$key_id_productos_packs];
            $select_sys = "descripcion_multiple";
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
            $descripcion_pack = $descripcion_productos_detalles_multiples;
        }
        if(!empty($descripcion_pack)) {
            $tipo_pack = "multiples";
            $descripcion_pack_datos = "PACK: ".$descripcion_productos_detalles_multiples." de ".$descripcion_productos;
            if($matriz_activo_productos_packs[$key_id_productos_packs] == 1) {
                $descripcion_pack_datos = "<strong>Pack de: " . $descripcion_pack."&nbsp;".$matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.</strong>";
            }else {
                $descripcion_pack_datos = "Pack de: " . $descripcion_pack."&nbsp;unid.";
            }

            $id_productos_detalles_multiples_url = $id_productos_detalles_multiples;
            $id_packs_url = $valor_id_productos_packs;
            $id_producto_productos = $id_url;
            $id_productos_detalles_enlazado_productos = 0;
            $id_productos_detalles_multiples_productos = $id_productos_detalles_multiples;
            $id_packs_productos = $id_packs_url;

            $id_producto_productos_otros = $id_url;
            $id_productos_detalles_enlazado_productos_otros = 0;
            $id_productos_detalles_multiples_productos_otros = $id_productos_detalles_multiples;
            $id_packs_productos_otros = $id_packs_url;
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/datos-costes-proveedores.php");
            unset($descripcion_pack_datos);
            unset($id_packs_url);
            ?>
            <hr />
            <?php
        }elseif(empty($matriz_id_productos_detalles_multiple_productos_packs[$key_id_productos_packs]) &&empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs])) {
            $tipo_pack = "";
            $descripcion_pack_datos = "";
            if($matriz_activo_productos_packs[$key_id_productos_packs] == 1) {
                $descripcion_pack_datos = "<strong>Pack de: " . $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.</strong>";
            }else {
                $descripcion_pack_datos = "Pack de: " . $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.";
            }

            $id_packs_url = $valor_id_productos_packs;
            $id_producto_productos = $id_url;
            $id_productos_detalles_enlazado_productos = 0;
            $id_productos_detalles_multiples_productos = 0;
            $id_packs_productos = $id_packs_url;

            $id_producto_productos_otros = $id_url;
            $id_productos_detalles_enlazado_productos_otros = 0;
            $id_productos_detalles_multiples_productos_otros = 0;
            $id_packs_productos_otros = $id_packs_url;
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/datos-costes-proveedores.php");
            unset($descripcion_pack_datos);
            unset($id_packs_url);
        }
    }
    ?>
</div>
<?php

unset($matriz_id_productos_packs);
unset($matriz_id_productos_detalles_enlazado_productos_packs);
unset($matriz_id_productos_detalles_multiple_productos_packs);
unset($matriz_cantidad_pack_productos_packs);
unset($matriz_activo_productos_packs);
unset($matriz_orden_productos_packs);
unset($matriz_fecha_alta_productos_packs);
unset($matriz_fecha_modificacion_productos_packs);

require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/componentes/form-datos.php");
$select_sys = "listado_relaciones_producto";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
if(isset($matriz_productos_detalles_relacion_id)) {
    foreach ($matriz_productos_detalles_relacion_id as $key_productos_detalles_relacion_id => $valor_productos_detalles_relacion_id) {
        $productos_enlazados[$valor_productos_detalles_relacion_id] = $atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$key_productos_detalles_relacion_id]].": ".$datos_atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_principal[$key_productos_detalles_relacion_id]]." / ".$atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_enlazado[$key_productos_detalles_relacion_id]].": ".$datos_atributos_disponibles[$matriz_productos_detalles_relacion_id_atributo_principal[$key_productos_detalles_relacion_id]][$matriz_productos_detalles_relacion_id_dato_enlazado[$key_productos_detalles_relacion_id]];
    }
}
unset($matriz_productos_detalles_relacion_id);
unset($matriz_productos_detalles_relacion_id_atributo_principal);
unset($matriz_productos_detalles_relacion_id_dato_principal);
unset($matriz_productos_detalles_relacion_id_atributo_enlazado);
unset($matriz_productos_detalles_relacion_id_dato_enlazado);
unset($matriz_productos_detalles_relacion_activo);
$select_sys = "listado_atributos_multiples";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
if(isset($productos_detalles_multiples_id_atributo)) {
    foreach ($matriz_productos_detalles_multiples_id as $key_productos_detalles_multiples_id => $valor_productos_detalles_multiples_id) {
        if($matriz_productos_detalles_multiples_activo[$key_productos_detalles_multiples_id] == 1) {
            $productos_multiples[$valor_productos_detalles_multiples_id] = $atributos_disponibles[$productos_detalles_multiples_id_atributo].": ".$datos_atributos_disponibles[$productos_detalles_multiples_id_atributo][$matriz_productos_detalles_multiples_id_dato[$key_productos_detalles_multiples_id]];
            $tipo_pack = "";
            $descripcion_pack_datos = "";
            $id_productos_detalles_multiples = $valor_productos_detalles_multiples_id;
            $select_sys = "descripcion_multiple";
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
            $descripcion_pack_datos = $descripcion_productos_detalles_multiples;

            $id_producto_productos = $id_url;
            $id_productos_detalles_enlazado_productos = 0;
            $id_productos_detalles_multiples_url = $valor_productos_detalles_multiples_id;
            $id_productos_detalles_multiples_productos = $valor_productos_detalles_multiples_id;
            $id_packs_productos = 0;

            $id_producto_productos_otros = $id_url;
            $id_productos_detalles_enlazado_productos_otros = 0;
            $id_productos_detalles_multiples_productos_otros = $valor_productos_detalles_multiples_id;
            $id_packs_productos_otros = 0;
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/datos-costes-proveedores.php");
            unset($descripcion_pack_datos);
        }
    }
}
unset($matriz_productos_detalles_multiples_id);
unset($productos_detalles_multiples_id_atributo);
unset($matriz_productos_detalles_multiples_id_dato);
unset($matriz_productos_detalles_multiples_activo);
?>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
