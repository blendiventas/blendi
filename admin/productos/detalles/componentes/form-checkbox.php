<?php
//echo "(" . $valor_atributos['nivel_atributo'] . ")-" . $valor_atributos['id_detalles'] . " - " . $valor_atributos['detalles'] . " - " . $valor_atributos['id_datos'] . " - " . $valor_atributos['datos']."<br />";
/*
echo "TOTAL NIVELES: ".$total_niveles."<br />";
echo "Lineas totales: ".count($atributos_json)."<br />";
echo "<hr />";
if(isset($atributos_json)) {
    $nivel_atributo_anterior = 0;
    $grid_iniciado = false;
    $row_iniciado = false;
    foreach ($atributos_json as $key_atributos => $valor_atributos) {
        if($nivel_atributo_anterior > $valor_atributos['nivel_atributo'] OR $valor_atributos['nivel_atributo'] == 0) {
            if($grid_iniciado == true) {
                ?>
                </div>
                </div>
                <?php
                $row_iniciado = false;
            }
            ?>
            <div class="grid-<?php echo $total_niveles + 1; ?>">
            <?php
            $grid_iniciado = true;
            for($bucle = 0 ; $bucle < $valor_atributos['nivel_atributo'] ; $bucle++) {
                ?>
                <div class="row">&nbsp;</div>
                <?php
            }
        }
        if($nivel_atributo_anterior != $valor_atributos['nivel_atributo'] OR $valor_atributos['nivel_atributo'] == 0) {
            if($row_iniciado == true) {
                ?>
                </div>
                <?php
            }
            ?>
            <div class="row">
            <?php
            $row_iniciado = true;
        }else {
            echo "<br />";
        }
        echo "(" . $valor_atributos['nivel_atributo'] . ")-" . $valor_atributos['id_detalles'] . " - " . $valor_atributos['detalles'] . " - " . $valor_atributos['id_datos'] . " - " . $valor_atributos['datos']."<br />";
        if($nivel_atributo_anterior != $valor_atributos['nivel_atributo']) {
            $nivel_atributo_anterior = $valor_atributos['nivel_atributo'];
        }
    }
    if($grid_iniciado == true) {
        ?>
        </div>
        </div>
        <?php
    }
}
*/
/*
<a class="botones-apartados" onclick="collapseCapa('capa-atributos_<?php echo $linea; ?>');">
    <img class="icon bg-white" id="icono-collapse-capa-atributos_<?php echo $linea; ?>" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
    ...
</a>

<div id="capa-atributos_<?php echo $linea; ?>" class="hide">
    <li>
        <?php
        //if($matriz_activo_productos_categorias[$valor_id_categorias] == 1) {
        $checked_activo_sys = " checked";
        $checked_inactivo_sys = "";
        //}else {
        //    $checked_activo_sys = "";
        //    $checked_inactivo_sys = " checked";
        //}
        ?>
        <label>
            <?php
            echo "(".$valor_atributos['nivel_atributo'].")-".$valor_atributos['id_detalles']." - ".$valor_atributos['detalles']." - ".$valor_atributos['id_datos']." - ". $valor_atributos['datos']."<br />";
            ?>
        </label>
        <span class="label-input">SI</span><input type="radio" name="activo_atributos[<?php echo $valor_atributos['id_detalles']; ?>]" id="activo_atributos_<?php echo $valor_atributos['id_detalles']; ?>" value="1"<?php echo $checked_activo_sys; ?> />
        <span class="label-input">NO</span><input type="radio" name="activo_atributos[<?php echo $valor_atributos['id_detalles']; ?>]" id="inactivo_atributos_<?php echo $valor_atributos['id_detalles']; ?>" value="0"<?php echo $checked_inactivo_sys; ?> />
    </li>
</div>
*/

/*
echo "<hr />";
if(isset($atributos_json)) {
    $nivel_atributo_anterior = 0;
    $grid_iniciado = false;
    $row_iniciado = false;
    foreach ($atributos_json as $key_atributos => $valor_atributos) {

        $matriz_id_detalle[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['id_detalles'];
        $matriz_detalles[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['detalles'];
        $matriz_id_datos[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['id_datos'];
        $matriz_datos[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['datos'];
        $total_grids = count($matriz_id_detalle)
        for($bucle = 0 ; $bucle <= $total_niveles ; $bucle++) {
            ?>
            <div class="grid-<?php echo $total_niveles + 1; ?>">
            <?php
        }

        if($nivel_atributo_anterior > $valor_atributos['nivel_atributo'] OR $valor_atributos['nivel_atributo'] == 0) {
            if($grid_iniciado == true) {
                ?>
                </div>
                </div>
                <?php
                $row_iniciado = false;
            }
            ?>
            <div class="grid-<?php echo $total_niveles + 1; ?>">
            <?php
            $grid_iniciado = true;
            for($bucle = 0 ; $bucle < $valor_atributos['nivel_atributo'] ; $bucle++) {
                ?>
                <div class="row">&nbsp;</div>
                <?php
            }
        }
        if($nivel_atributo_anterior != $valor_atributos['nivel_atributo'] OR $valor_atributos['nivel_atributo'] == 0) {
            if($row_iniciado == true) {
                ?>
                </div>
                <?php
            }
            ?>
            <div class="row">
            <?php
            $row_iniciado = true;
        }else {
            echo "<br />";
        }
        echo "(" . $valor_atributos['nivel_atributo'] . ")-" . $valor_atributos['id_detalles'] . " - " . $valor_atributos['detalles'] . " - " . $valor_atributos['id_datos'] . " - " . $valor_atributos['datos']."<br />";
        if($nivel_atributo_anterior != $valor_atributos['nivel_atributo']) {
            $nivel_atributo_anterior = $valor_atributos['nivel_atributo'];
        }
    }
    if($grid_iniciado == true) {
        ?>
        </div>
        </div>
        <?php
    }
}
*/
if(isset($atributos_json)) {
    foreach ($atributos_json as $key_atributos => $valor_atributos) {
        if(!isset($matriz_niveles[$valor_atributos['nivel_atributo']])) {
            $matriz_niveles[$valor_atributos['nivel_atributo']] = 1;
        }else {
            $matriz_niveles[$valor_atributos['nivel_atributo']] += 1;
        }
        $matriz_enlace[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['enlace'];
        $matriz_id_detalle[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['id_detalles'];
        $matriz_detalles[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['detalles'];
        $matriz_id_datos[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['id_datos'];
        $matriz_datos[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $valor_atributos['datos'];
        $select_sys = "filtrado-relacion";
        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
        $matriz_marcados[$valor_atributos['nivel_atributo']][$valor_atributos['id_detalles']][$valor_atributos['id_datos']] = $marcado;
    }
    unset($atributos_json);

    function mostrar_columnas($capa_checked,$contador_atributos,$niveles,$id_detalle_anterior,$matriz_niveles,$matriz_enlace,$matriz_id_detalle,$matriz_detalles,$matriz_id_datos,$matriz_datos,$matriz_marcados,$host_base_sys) {
        $capa_visible = " hide";
        if($capa_checked == 1) {
            $capa_visible = "";
        }
        foreach ($matriz_id_detalle[$niveles] as $key_detalles => $valor_detalles) {
            ?>
            <div class="row<?php echo $capa_visible; ?> capa_atributos_<?php echo $contador_atributos; ?>">
                <?php
                foreach ($valor_detalles as $key_datos => $valor_datos) {
                    if($matriz_enlace[$niveles][$key_detalles][$key_datos] == $id_detalle_anterior) {
                        /*
                        echo $matriz_id_detalle[$niveles][$key_detalles][$key_datos];
                        echo $matriz_detalles[$niveles][$key_detalles][$key_datos];
                        echo $matriz_id_datos[$niveles][$key_detalles][$key_datos];
                        echo $matriz_datos[$niveles][$key_detalles][$key_datos];
                        echo "<br />";
                        */
                        $checked_atributos_sys = "";
                        if($matriz_marcados[$niveles][$key_detalles][$key_datos] == 1) {
                            $checked_atributos_sys = " checked";
                        }
                        ?>
                        <div class="grid-2">
                            <div class="box text-center">
                                <input type="hidden" name="id_detalle[<?php echo $contador_atributos; ?>]" value="<?php echo $matriz_id_detalle[$niveles][$key_detalles][$key_datos]; ?>" />
                                <input type="hidden" name="id_datos[<?php echo $contador_atributos; ?>]" value="<?php echo $matriz_id_datos[$niveles][$key_detalles][$key_datos]; ?>" />
                                <input type="checkbox" id="atributos[<?php echo $contador_atributos; ?>]" name="atributos[<?php echo $contador_atributos; ?>]"<?php echo $checked_atributos_sys; ?> />
                            </div>
                            <div class="box text-left">
                                <?php echo $matriz_detalles[$niveles][$key_detalles][$key_datos].": ".$matriz_datos[$niveles][$key_detalles][$key_datos]; ?>
                            </div>
                        </div>
                        <?php
                        $id_detalle = $matriz_id_detalle[$niveles][$key_detalles][$key_datos];
                    }else {
                        echo "&nbsp;";
                    }
                }
                ?>
            </div>
            <?php
            if(isset($matriz_niveles[$niveles + 1])) {
                $id_detalle_anterior = $id_detalle;
                mostrar_columnas($capa_checked,$contador_atributos,$niveles + 1,$id_detalle_anterior,$matriz_niveles,$matriz_enlace,$matriz_id_detalle,$matriz_detalles,$matriz_id_datos,$matriz_datos,$matriz_marcados,$host_base_sys);
            }
        }
    }

    $contador_atributos = 0;
    foreach ($matriz_id_detalle[0] as $key_detalles => $valor_detalles) {
        foreach ($valor_detalles as $key_datos => $valor_datos) {
            $contador_atributos += 1;
            ?>
            <div class="grid-<?php echo $total_niveles + 1; ?>">
                <div class="row">
                    <?php
                    /*
                    echo $matriz_id_detalle[0][$key_detalles][$key_datos];
                    echo $matriz_detalles[0][$key_detalles][$key_datos];
                    echo $matriz_id_datos[0][$key_detalles][$key_datos];
                    echo $matriz_datos[0][$key_detalles][$key_datos];
                    */
                    //---
                    $checked_atributos_sys = "";
                    $capa_checked = 0;
                    if($matriz_marcados[0][$key_detalles][$key_datos] == 1) {
                        $checked_atributos_sys = " checked";
                        $capa_checked = 1;
                    }
                    ?>
                    <div class="grid-2">
                        <div class="box text-center">
                            <input type="hidden" name="id_detalle[<?php echo $contador_atributos; ?>]" value="<?php echo $matriz_id_detalle[0][$key_detalles][$key_datos]; ?>" />
                            <input type="hidden" name="id_datos[<?php echo $contador_atributos; ?>]" value="<?php echo $matriz_id_datos[0][$key_detalles][$key_datos]; ?>" />
                            <input type="checkbox" id="atributos_<?php echo $contador_atributos; ?>" name="atributos[<?php echo $contador_atributos; ?>]"<?php echo $checked_atributos_sys; ?> onchange="mostra_atributos('<?php echo $contador_atributos; ?>','<?php echo $total_niveles; ?>')" />
                        </div>
                        <div class="box text-left">
                            <?php echo $matriz_detalles[0][$key_detalles][$key_datos].": ".$matriz_datos[0][$key_detalles][$key_datos]; ?>
                        </div>
                    </div>
                    <?php
                    //---
                    ?>
                </div>
                <?php
                if(isset($matriz_niveles[1])) {
                    $id_detalle_anterior = $matriz_id_detalle[0][$key_detalles][$key_datos];
                    mostrar_columnas($capa_checked,$contador_atributos,1,$id_detalle_anterior,$matriz_niveles,$matriz_enlace,$matriz_id_detalle,$matriz_detalles,$matriz_id_datos,$matriz_datos,$matriz_marcados,$host_base_sys);
                }
                ?>
            </div>
            <hr />
            <?php
        }
    }
}