<?php
$indice_atributos = $id_producto_sys.$id_enlazados_producto_sys[$key].$id_multiples_producto_sys[$key].$id_packs_producto_sys[$key];

$select_sys = "datos-enlazados";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
if(isset($matriz_productos_detalles_relacion_id)) {
    ?>
    <table style="text-align: center; width: 60%;">
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
            $select_sys = "datos-enlazados-pvp";
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
            echo "<tr>";
            echo "<td style='border: #6c757d solid 1px;'>".$valor_vertical_datos."</td>";
            foreach ($matriz_horizontal_datos as $Key_horizontal_datos => $valor_horizontal_datos) {
                echo "<td style='border: #6c757d solid 1px;' id='capa_img_activo_".$matriz_id[$Key_vertical_datos][$Key_horizontal_datos]."'>";
                if($matriz_activo[$Key_vertical_datos][$Key_horizontal_datos] == 1) {
                    if(!isset($pvp_atributos[$indice_atributos])) {
                        $pvp_atributos[$indice_atributos] = $pvp_base_unidad;
                    }
                    ?>
                    <input type="radio" name="radio_atributo_<?php echo $indice_atributos; ?>" onclick="document.getElementById('pvp_linea_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = <?php echo $pvp_atributos[$indice_atributos]; ?>; modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" />
                    <?php
                } else {
                    $imagen_src = "/images/invalid-20.png";
                    $alt_src = "Inactivo";
                    ?>
                    <img src="<?php echo $imagen_src; ?>" id="img_activo_<?php echo $matriz_id[$Key_vertical_datos][$Key_horizontal_datos]; ?><?php echo $anadidoModal; ?>" class="w-20p" alt="<?php echo $alt_src; ?>" title="<?php echo $alt_src; ?>" />
                    <?php
                }
                if($pvp_base_unidad != $pvp_atributos[$indice_atributos]) {
                    echo "<span style='text-align: right;'>";
                    echo $etiqueta_pvp . ": " .number_format( $pvp_atributos[$indice_atributos],2,",","");
                    echo "</span>";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <input type="hidden" name="id_atributo_principal_<?php echo $contador_elementos; ?>" id="id_atributo_principal_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_atributo_vertical; ?>" />
    <input type="hidden" name="id_atributo_enlazado_<?php echo $contador_elementos; ?>" id="id_atributo_enlazado_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>" value="<?php echo $id_atributo_horizontal; ?>" />

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
}else {
    $select_sys = "datos-multiples";
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
    if(isset($matriz_productos_detalles_multiples_id)) {
        ?>
        <input type="hidden" name="id_atributo_multiple_<?php echo $indice_atributos; ?>" id="id_atributo_multiple_<?php echo $indice_atributos; ?><?php echo $anadidoModal; ?>" value="<?php echo $productos_detalles_multiples_id_atributo; ?>" />
        <div id="capa_atributo_multiple<?php echo $anadidoModal; ?>">
            <div class="grid-1">
                <div class="box text-center">
                    <?php
                    $contador_id_productos_detalles_multiples = 0;
                    echo $atributos_disponibles[$productos_detalles_multiples_id_atributo];
                    ?>
                </div>
            </div>
            <table style="text-align: center; width: 60%;">
                <?php
                foreach ($datos_atributos_disponibles[$productos_detalles_multiples_id_atributo] as $key_productos_detalles => $valor_productos_detalles) {
                    $mostrar_producto = false;
                    foreach ($matriz_productos_detalles_multiples_id_dato as $Key_multiples_id_dato => $valor_multiples_id_dato) {
                        if($key_productos_detalles == $valor_multiples_id_dato && $matriz_productos_detalles_multiples_activo[$Key_multiples_id_dato] == 1) {
                            $mostrar_producto = true;
                            break;
                        }
                    }
                    if($mostrar_producto) {
                        $select_sys = "datos-multiples-pvp";
                        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-atributos.php");
                        if(!isset($pvp_atributos[$indice_atributos])) {
                            $pvp_atributos[$indice_atributos] = $pvp_base_unidad;
                        }
                        ?>
                        <tr>
                            <td style="border: solid black 1px;">
                                <input type="radio" name="radio_atributo_<?php echo $indice_atributos; ?>" onclick="document.getElementById('pvp_linea_<?php echo $contador_elementos; ?><?php echo $anadidoModal; ?>').value = <?php echo $pvp_atributos[$indice_atributos]; ?>; modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" />
                            </td>
                            <td style="border: solid black 1px;">
                                <?php echo $valor_productos_detalles; ?>
                            </td>
                            <td style="border: solid black 1px;">
                                <?php
                                if($pvp_base_unidad != $pvp_atributos[$indice_atributos]) {
                                    echo $etiqueta_pvp . ": " . $pvp_atributos[$indice_atributos]." €";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    $contador_id_productos_detalles_multiples += 1;
                }
                ?>
            </table>
        </div>
        <?php
        unset($matriz_productos_detalles_multiples_id);
        unset($productos_detalles_multiples_id_atributo);
        unset($matriz_productos_detalles_multiples_id_dato);
        unset($matriz_productos_detalles_multiples_activo);
    }
}