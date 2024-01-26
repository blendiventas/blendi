<input type="hidden" name="apartado" id="apartado" value="packs" />

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
if(isset($matriz_id_productos_packs)) {
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
        ?>
        <table id="tabla_packs_enlazados" style="text-align: center; border: #6c757d solid 1px; width: 100%;">
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
                        $checked = "";
                        $id_valor_id_productos_packs = 0;
                        foreach ($matriz_id_productos_packs as $key_id_productos_packs => $valor_id_productos_packs) {
                            if(!empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs])) {
                                if($matriz_id[$Key_vertical_datos][$Key_horizontal_datos] == $matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs]) {
                                    if(empty($checked)) {
                                        $checked = "1";
                                    }else {
                                        echo "<br />";
                                    }
                                    $descripcion_pack_datos = "PACK: ".$atributo_vertical.": ".$valor_vertical_datos." / ".$atributo_horizontal.": ".$valor_horizontal_datos." de ".$descripcion_productos;
                                    /*
                                    echo "1-".$descripcion_pack_datos."<br />";
                                    echo "2-".$valor_id_productos_packs."<br />";
                                    echo "3-".$matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."<br />";
                                    echo "4-".$matriz_activo_productos_packs[$key_id_productos_packs]."<br />";
                                    echo "5-".$matriz_orden_productos_packs[$key_id_productos_packs]."<br />";
                                    echo "6-".$matriz_fecha_alta_productos_packs[$key_id_productos_packs]."<br />";
                                    echo "7-".$matriz_fecha_modificacion_productos_packs[$key_id_productos_packs]."<br />";
                                    */
                                    ?>
                                        <!--
                                        descripcion,id,cantidad,activo,orden,alta,modificacion
                                        -->
                                    <button onclick="asignarDatosPack('<?php echo $descripcion_pack_datos; ?>','<?php echo $valor_id_productos_packs; ?>','<?php echo $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]; ?>','<?php echo $matriz_activo_productos_packs[$key_id_productos_packs]; ?>','<?php echo $matriz_orden_productos_packs[$key_id_productos_packs]; ?>','<?php echo $matriz_fecha_alta_productos_packs[$key_id_productos_packs]; ?>','<?php echo $matriz_fecha_modificacion_productos_packs[$key_id_productos_packs]; ?>'); return false;">
                                        <?php
                                        echo $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.";
                                        ?>
                                    </button>
                                    <?php
                                }
                            }
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
        /*
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
        */
    }
//----------------------------------------------------------------------------------------------------------------------
    // SOLO PARA LOS PACKS DEL PRODUCTO DIRECTO SIN ATRIBUTOS
    ?>
    <div id="capa_packs_multiples">
        <div class="grid grid-cols-12 items-center h-10 bg-gray-50 dark:text-white mt-6">
            <div class="px-3 col-span-10">
                Cantidad
            </div>
            <div class="text-center px-3 col-span-2">
                &nbsp;
            </div>
        </div>
        <div class="overflow-y-auto bg-white">
            <?php
            foreach ($matriz_id_productos_packs as $key_id_productos_packs => $valor_id_productos_packs) {
                ?>
                <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
                    <div class="px-3 col-span-10">
                        <?php
                        $descripcion_pack = "";
                        if(!empty($matriz_id_productos_detalles_multiple_productos_packs[$key_id_productos_packs])) {
                            $id_productos_detalles_multiples = $matriz_id_productos_detalles_multiple_productos_packs[$key_id_productos_packs];
                            $select_sys = "descripcion_multiple";
                            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
                            $descripcion_pack = $descripcion_productos_detalles_multiples;
                        }
                        if(!empty($descripcion_pack)) {
                            ?>
                            <button onclick="asignarDatosPackMultiple(
                                    '<?php echo $descripcion_productos; ?>',
                                    '<?php echo $valor_id_productos_packs; ?>',
                                    '<?php echo $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_activo_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_orden_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_fecha_alta_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_fecha_modificacion_productos_packs[$key_id_productos_packs]; ?>'); return false;">
                                <?php
                                if($matriz_activo_productos_packs[$key_id_productos_packs] == 1) {
                                    echo "<strong>" . $descripcion_pack."&nbsp;".$matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.</strong>";
                                }else {
                                    echo $descripcion_pack."&nbsp;unid.";
                                }
                                ?>
                            </button>
                            <?php
                        }elseif(empty($matriz_id_productos_detalles_multiple_productos_packs[$key_id_productos_packs]) &&empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs])) {
                            ?>
                            <button onclick="asignarDatos(
                                    '<?php echo $descripcion_productos; ?>',
                                    '<?php echo $valor_id_productos_packs; ?>',
                                    '<?php echo $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_activo_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_orden_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_fecha_alta_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_fecha_modificacion_productos_packs[$key_id_productos_packs]; ?>'); return false;">
                                <?php
                                if($matriz_activo_productos_packs[$key_id_productos_packs] == 1) {
                                    echo "<strong>" . $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.</strong>";
                                }else {
                                    echo $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.";
                                }
                                ?>
                            </button>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="text-center px-3 col-span-2">
                        <?php
                        if(!empty($descripcion_pack)) {
                            ?>
                            <button onclick="asignarDatosPackMultiple(
                                    '<?php echo $descripcion_productos; ?>',
                                    '<?php echo $valor_id_productos_packs; ?>',
                                    '<?php echo $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_activo_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_orden_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_fecha_alta_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_fecha_modificacion_productos_packs[$key_id_productos_packs]; ?>'); return false;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                            <?php
                        }elseif(empty($matriz_id_productos_detalles_multiple_productos_packs[$key_id_productos_packs]) &&empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs])) {
                            ?>
                            <button onclick="asignarDatos(
                                    '<?php echo $descripcion_productos; ?>',
                                    '<?php echo $valor_id_productos_packs; ?>',
                                    '<?php echo $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_activo_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_orden_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_fecha_alta_productos_packs[$key_id_productos_packs]; ?>',
                                    '<?php echo $matriz_fecha_modificacion_productos_packs[$key_id_productos_packs]; ?>'); return false;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
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
//----------------------------------------------------------------------------------------------------------------------
}
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
        }
    }
}
unset($matriz_productos_detalles_multiples_id);
unset($productos_detalles_multiples_id_atributo);
unset($matriz_productos_detalles_multiples_id_dato);
unset($matriz_productos_detalles_multiples_activo);
?>
<div id="capa_gestion_pack" class="mt-3">
    NUEVO PACK de <?php echo $descripcion_productos; ?>
</div>
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
    <table id="tabla_nuevos_packs" style="text-align: center; border: #6c757d solid 1px; width: 100%;">
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
                    ?>
                    <input type="checkbox" name="pack_producto_enlazado[<?php echo $matriz_id[$Key_vertical_datos][$Key_horizontal_datos]; ?>]" value="<?php echo $matriz_id[$Key_vertical_datos][$Key_horizontal_datos]; ?>" />
                    <?php
                    /* echo "(".$Key_vertical_datos.")(".$Key_horizontal_datos.")"; */
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
$select_sys = "listado_atributos_multiples";
require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
/*
$matriz_productos_detalles_multiples_id[]
$productos_detalles_multiples_id_atributo
$matriz_productos_detalles_multiples_id_dato[]
$matriz_productos_detalles_multiples_activo[]
*/
if($datos_atributos_enlazados == false) {
    if(isset($productos_detalles_multiples_id_atributo)) {
        ?>
        <div id="capa_atributo_multiple">
            <div class="grid-1">
                <div class="box text-center">
                    <?php
                    echo $atributos_disponibles[$productos_detalles_multiples_id_atributo]."<br />";
                    foreach ($datos_atributos_disponibles[$productos_detalles_multiples_id_atributo] as $key_productos_detalles => $valor_productos_detalles) {
                        $checked = "";
                        foreach ($matriz_productos_detalles_multiples_id_dato as $Key_multiples_id_dato => $valor_multiples_id_dato) {
                            if($key_productos_detalles == $valor_multiples_id_dato && $matriz_productos_detalles_multiples_activo[$Key_multiples_id_dato] == 1) {
                                ?>
                                <div class="grid-2">
                                    <div class="box text-center">
                                        <input type="checkbox" name="pack_producto_multiple[<?php echo $key_productos_detalles; ?>]"<?php echo $checked; ?> value="<?php echo $matriz_productos_detalles_multiples_id[$Key_multiples_id_dato]; ?>" />
                                    </div>
                                    <div class="box text-left">
                                        <?php echo $valor_productos_detalles; ?>
                                    </div>
                                </div>
                                <?php
                                break;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <!--
            <div class="text-center" id="capa_guardar_atributo_multiple">
                <button class="botones-apartados" type="button" onclick="guardarAtributoMultiple();">Guardar</button>
            </div>
            -->
        </div>
        <?php
        unset($matriz_productos_detalles_multiples_id);
        unset($productos_detalles_multiples_id_atributo);
        unset($matriz_productos_detalles_multiples_id_dato);
        unset($matriz_productos_detalles_multiples_activo);
    }
    ?>
    <hr />
    <?php
}
?>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="cantidad_pack">Unidades del pack:</label><br>
        <input type="number" name="cantidad_pack" id="cantidad_pack" placeholder="Unidades del pack" value="" class="w-full" />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label>Activo:</label>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('activo_1', 'capa_activo_1', 'capa_unicos_activo')" id="capa_activo_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo poin">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_activo_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo">
                    &nbsp;
                </div>
                <div id="check_activo_1" class="hidden check_capa_unicos_activo">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo" id="activo_1" value="1" class="hidden" />
                <script type="text/javascript">
                    activarElementoUnicoFicha('activo_1', 'capa_activo_1', "capa_unicos_activo");
                </script>
            </div>
            <div onclick="activarElementoUnicoFicha('activo_2', 'capa_activo_2', 'capa_unicos_activo')" id="capa_activo_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_activo_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo">
                    &nbsp;
                </div>
                <div id="check_activo_2" class="hidden check_capa_unicos_activo">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo" id="activo_2" value="0" class="hidden" />
            </div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="orden_productos_packs">Orden:</label><br>
        <input type="text" name="orden_productos_packs" id="orden_productos_packs" placeholder="Orden" maxlength="20" value="" class="w-full" />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div class="grid-2">
        <div class="row text-left">Fecha alta pack:</div>
        <div class="row text-center" id="fecha_alta_productos_packs"></div>
    </div>
    <div class="grid-2">
        <div class="row text-left">Fecha última modificación pack:</div>
        <div class="row text-center" id="fecha_modificacion_productos_packs"></div>
    </div>
</div>

<div id="capa_guardar_insert" class="w-full">
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div class="flex justify-end">
            <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarFicha('guardar-pack');">Guardar</button>
        </div>
    </div>
</div>
<div id="capa_guardar_update" class="w-full">
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div class="flex justify-end">
            <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" id="boton-cancelar-enlazados" onclick="cancelarPack('<?php echo $descripcion_productos; ?>','enlazados');">Cancelar</button>
            <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" id="boton-cancelar-multiples" onclick="cancelarPack('<?php echo $descripcion_productos; ?>','multiples');">Cancelar</button>
            <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" id="boton-cancelar-normal" onclick="cancelarPack('<?php echo $descripcion_productos; ?>','');">Cancelar</button>
        </div>
        <div class="flex justify-end">
            <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarFicha('eliminar-pack');">Eliminar</button>
        </div>
        <div class="flex justify-end">
            <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarFicha('guardar-pack');">Guardar</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function() {
        document.getElementById("capa_guardar_update").style.display = "none";
    }, 50);
    desactivarBotonesPorDefectoFicha();
</script>
