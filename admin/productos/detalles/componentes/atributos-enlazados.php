<?php
$datos_atributos_enlazados = false;
if(!isset($id_atributo_principal) && !isset($id_productos_detalles_enlazado_url)) {
    $select_sys = "listado_relaciones_producto";
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
    if(isset($matriz_productos_detalles_relacion_id)) {

        /* Encuentra atributos enlazados relacionados con el producto */

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
        <strong>Atributo enlazado</strong><br />
        <table style="text-align: center; border: #6c757d solid 1px; width: 100%;">
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
                        $imagen_src = "/images/valid-20.png";
                        $alt_src = "Activo";
                    } else {
                        $imagen_src = "/images/invalid-20.png";
                        $alt_src = "Inactivo";
                    }
                    ?>
                    <img src="<?php echo $imagen_src; ?>" id="img_activo_<?php echo $matriz_id[$Key_vertical_datos][$Key_horizontal_datos]; ?>" class="w-20p" alt="<?php echo $alt_src; ?>" title="<?php echo $alt_src; ?>" onmouseover="this.style.cursor='pointer'" onclick="cambiarEstadoAtributoEnlazado('<?php echo $matriz_id[$Key_vertical_datos][$Key_horizontal_datos]; ?>');" />
                    <?php
                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>

        <input type="hidden" name="id_atributo_principal" id="id_atributo_principal" value="<?php echo $id_atributo_vertical; ?>" />
        <input type="hidden" name="id_atributo_enlazado" id="id_atributo_enlazado" value="<?php echo $id_atributo_horizontal; ?>" />
        <hr />
        <div id="capa_atributo_vertical">
            <div class="grid-1">
                <div class="box text-center">
                    <?php
                    $algun_dato = false;
                    foreach ($datos_atributos_disponibles[$id_atributo_vertical] as $key_productos_detalles => $valor_productos_detalles) {
                        $existe = false;
                        foreach ($matriz_vertical_datos as $Key_vertical_datos => $valor_vertical_datos) {
                            if($key_productos_detalles == $Key_vertical_datos) {
                                $existe = true;
                                break;
                            }
                        }
                        if($existe == false) {
                            $algun_dato = true;
                            ?>
                            <div class="grid-2">
                                <div class="box text-center">
                                    <input type="checkbox" name="atributos_principales[<?php echo $key_productos_detalles; ?>]" value="<?php echo $key_productos_detalles; ?>" />
                                </div>
                                <div class="box text-left">
                                    <?php echo $valor_productos_detalles; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    if($algun_dato == false) {
                        echo "El atributo ".$atributo_vertical." no dispone de más datos, si es necesario, añada más detalles productos.";
                    }
                    ?>
                </div>
            </div>
            <?php
            if($algun_dato == true) {
                ?>
                <div class="text-center" id="capa_guardar_atributo_vertical">
                    <button class="botones-apartados" type="button" onclick="guardarAtributoVertical();">Añadir <?php echo $atributo_vertical; ?></button>
                </div>
                <?php
            }
            ?>
        </div>
        <hr />
        <div id="capa_atributo_horizontal">
            <div class="grid-1">
                <div class="box text-center">
                    <?php
                    $algun_dato = false;
                    foreach ($datos_atributos_disponibles[$id_atributo_horizontal] as $key_productos_detalles => $valor_productos_detalles) {
                        $existe = false;
                        foreach ($matriz_horizontal_datos as $Key_horizontal_datos => $valor_horizontal_datos) {
                            if($key_productos_detalles == $Key_horizontal_datos) {
                                $existe = true;
                            }
                        }
                        if($existe == false) {
                            $algun_dato = true;
                            ?>
                            <div class="grid-2">
                                <div class="box text-center">
                                    <input type="checkbox" name="atributos_enlazados[<?php echo $key_productos_detalles; ?>]" value="<?php echo $key_productos_detalles; ?>" />
                                </div>
                                <div class="box text-left">
                                    <?php echo $valor_productos_detalles; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    if($algun_dato == false) {
                        echo "El atributo ".$atributo_horizontal." no dispone de más datos, si es necesario, añada más detalles productos.";
                    }
                    ?>
                </div>
            </div>
            <?php
            if($algun_dato == true) {
                ?>
                <div class="text-center" id="capa_guardar_atributo_horizontal">
                    <button class="botones-apartados" type="button" onclick="guardarAtributoHorizontal();">Añadir <?php echo $atributo_horizontal; ?></button>
                </div>
                <?php
            }
            ?>
        </div>
        <hr />
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

        /* No encuentra atributos enlazados relacionados con el producto */

        ?>
        <div class="grid-1">
            <div class="box text-center">
                <button class="submit" type="button" onclick="document.getElementById('capa_atributo_enlazado').style.display = 'block';">
                    Crear atributos enlazados
                </button>
            </div>
        </div>
        <div id="capa_atributo_enlazado" style="display: none;">
            <div class="grid-2">
                <div class="box text-center">
                    <strong>Atributo principal:</strong><br />
                    <?php
                    foreach ($atributos_disponibles as $key_productos_detalles => $valor_productos_detalles) {
                        ?>
                        <div class="grid-2">
                            <div class="box text-center">
                                <input type="radio" id="atributo_principal_<?php echo $key_productos_detalles; ?>" name="atributo_principal" value="<?php echo $key_productos_detalles; ?>" />
                            </div>
                            <div class="box text-left">
                                <?php echo $valor_productos_detalles; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="box text-center">
                    <strong>Atributo enlazado:</strong><br />
                    <?php
                    foreach ($atributos_disponibles as $key_productos_detalles => $valor_productos_detalles) {
                        ?>
                        <div class="grid-2">
                            <div class="box text-center">
                                <input type="radio" id="atributo_enlazado_<?php echo $key_productos_detalles; ?>" name="atributo_enlazado" value="<?php echo $key_productos_detalles; ?>" />
                            </div>
                            <div class="box text-left">
                                <?php echo $valor_productos_detalles; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="grid-2">
                <div class="box text-center">
                    <button class="botones-apartados" type="button" onclick="continuarAtributoEnlazado('<?php echo $id_url; ?>');">Continuar</button>
                </div>
                <div class="box text-center">
                    <button class="botones-apartados" type="button" onclick="document.getElementById('capa_atributo_enlazado').style.display = 'none';">Ocultar</button>
                </div>
            </div>
        </div>
        <?php
    }
}else {
    /* Muestra los datos de los atributos principal y enlazado para seleccionar y guardar */
    ?>
    <input type="hidden" name="id_atributo_principal" id="id_atributo_principal" value="<?php echo $id_atributo_principal; ?>" />
    <input type="hidden" name="id_atributo_enlazado" id="id_atributo_enlazado" value="<?php echo $id_productos_detalles_enlazado_url; ?>" />
    <div id="capa_atributo_enlazado">
        <div class="grid-2">
            <div class="box text-center">
                <?php
                echo $atributos_disponibles[$id_atributo_principal]."<br />";
                foreach ($datos_atributos_disponibles[$id_atributo_principal] as $key_datos_productos_detalles => $valor_datos_productos_detalles) {
                    ?>
                    <div class="grid-2">
                        <div class="box text-center">
                            <input type="checkbox" name="atributos_principales[<?php echo $key_datos_productos_detalles; ?>]" value="<?php echo $key_datos_productos_detalles; ?>" />
                        </div>
                        <div class="box text-left">
                            <?php echo $valor_datos_productos_detalles; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="box text-center">
                <?php
                echo $atributos_disponibles[$id_productos_detalles_enlazado_url]."<br />";
                foreach ($datos_atributos_disponibles[$id_productos_detalles_enlazado_url] as $key_datos_productos_detalles => $valor_datos_productos_detalles) {
                    ?>
                    <div class="grid-2">
                        <div class="box text-center">
                            <input type="checkbox" name="atributos_enlazados[<?php echo $key_datos_productos_detalles; ?>]" value="<?php echo $key_datos_productos_detalles; ?>" />
                        </div>
                        <div class="box text-left">
                            <?php echo $valor_datos_productos_detalles; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-1" id="capa_guardar_atributos">
            <div class="box text-center">
                <button class="botones-apartados" type="button" onclick="guardarAtributoEnlazado();">Guardar</button>
            </div>
        </div>
    </div>
    <?php
}