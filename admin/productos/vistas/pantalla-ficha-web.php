<input type="hidden" name="apartado" id="apartado" value="web" />
<?php
$contador_elementos = 0;
$id_producto_productos_web = $id_url;
$id_productos_detalles_enlazado_productos_web = 0;
$id_productos_detalles_multiples_productos_web = 0;
$id_packs_productos_web = 0;
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-web.php");

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
                    $web_base_mostrado = false;
                    foreach ($matriz_id_productos_packs as $key_id_productos_packs => $valor_id_productos_packs) {
                        ?>
                        <input type="hidden" name="id_productos_web[]" value="<?php echo $matriz_id[$Key_vertical_datos][$Key_horizontal_datos]; ?>" />
                        <?php
                        if (!empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs])) {
                            if ($matriz_id[$Key_vertical_datos][$Key_horizontal_datos] == $matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs]) {
                                $descripcion_pack_datos_web = "<strong>PACK: ".$matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;units.</strong><br />";
                                $id_productos_detalles_enlazado_url = $matriz_id[$Key_vertical_datos][$Key_horizontal_datos];
                                $id_packs_url = $valor_id_productos_packs;
                                $id_producto_productos_web = $id_url;
                                $id_productos_detalles_enlazado_productos_web = $id_productos_detalles_enlazado_url;
                                $id_productos_detalles_multiples_productos_web = 0;
                                $id_packs_productos_web = $id_packs_url;
                                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-web.php");
                                unset($descripcion_pack_datos_web);
                                unset($id_packs_url);
                            }else if($web_base_mostrado == false) {
                                $web_base_mostrado = true;
                                $id_productos_detalles_enlazado_url = $matriz_id[$Key_vertical_datos][$Key_horizontal_datos];
                                $id_producto_productos_web = $id_url;
                                $id_productos_detalles_enlazado_productos_web = $id_productos_detalles_enlazado_url;
                                $id_productos_detalles_multiples_productos_web = 0;
                                $id_packs_productos_web = 0;
                                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-web.php");
                            }
                        }else if($web_base_mostrado == false) {
                            $web_base_mostrado = true;
                            $id_productos_detalles_enlazado_url = $matriz_id[$Key_vertical_datos][$Key_horizontal_datos];
                            $id_producto_productos_web = $id_url;
                            $id_productos_detalles_enlazado_productos_web = $id_productos_detalles_enlazado_url;
                            $id_productos_detalles_multiples_productos_web = 0;
                            $id_packs_productos_web = 0;
                            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-web.php");
                        }
                    }
                    if($web_base_mostrado == false){
                        $id_productos_detalles_enlazado_url = $matriz_id[$Key_vertical_datos][$Key_horizontal_datos];
                        $id_producto_productos_web = $id_url;
                        $id_productos_detalles_enlazado_productos_web = $id_productos_detalles_enlazado_url;
                        $id_productos_detalles_multiples_productos_web = 0;
                        $id_packs_productos_web = 0;
                        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-web.php");
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
                $descripcion_pack_datos_web = "<strong>Pack de: " . $descripcion_pack."&nbsp;".$matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.</strong>";
            }else {
                $descripcion_pack_datos_web = "Pack de: " . $descripcion_pack."&nbsp;unid.";
            }
            $id_productos_detalles_multiples_url = $id_productos_detalles_multiples;
            $id_packs_url = $valor_id_productos_packs;
            $id_producto_productos_web = $id_url;
            $id_productos_detalles_enlazado_productos_web = 0;
            $id_productos_detalles_multiples_productos_web = $id_productos_detalles_multiples;
            $id_packs_productos_web = $id_packs_url;
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-web.php");
            unset($descripcion_pack_datos_web);
            unset($id_packs_url);
        }elseif(empty($matriz_id_productos_detalles_multiple_productos_packs[$key_id_productos_packs]) &&empty($matriz_id_productos_detalles_enlazado_productos_packs[$key_id_productos_packs])) {
            $tipo_pack = "";
            $descripcion_pack_datos = "";
            if($matriz_activo_productos_packs[$key_id_productos_packs] == 1) {
                $descripcion_pack_datos_web = "<strong>Pack de: " . $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.</strong>";
            }else {
                $descripcion_pack_datos_web = "Pack de: " . $matriz_cantidad_pack_productos_packs[$key_id_productos_packs]."&nbsp;unid.";
            }
            $id_packs_url = $valor_id_productos_packs;
            $id_producto_productos_web = $id_url;
            $id_productos_detalles_enlazado_productos_web = 0;
            $id_productos_detalles_multiples_productos_web = 0;
            $id_packs_productos_web = $id_packs_url;
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-web.php");
            unset($descripcion_pack_datos_web);
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
            $descripcion_pack_datos_web = $descripcion_productos_detalles_multiples;
            $id_producto_productos_web = $id_url;
            $id_productos_detalles_enlazado_productos_web = 0;
            $id_productos_detalles_multiples_url = $valor_productos_detalles_multiples_id;
            $id_productos_detalles_multiples_productos_web = $valor_productos_detalles_multiples_id;
            $id_packs_productos_web = 0;
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-web.php");
            unset($descripcion_pack_datos_web);
            ?>
            <hr />
            <?php
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
