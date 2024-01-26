<?php
$select_sys = "listado_atributos_unicos";
require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
/*
$matriz_productos_detalles_unicos_id_atributo[]
$matriz_productos_detalles_unicos_id_dato[]
$matriz_productos_detalles_unicos_activo[]
*/
if(isset($matriz_productos_detalles_unicos_id_atributo)) {

    /* Encuentra atributos unicos relacionados con el producto */

    foreach ($matriz_productos_detalles_unicos_id_atributo as $key_productos_detalles_unicos_id_atributo => $valor_productos_detalles_unicos_id_atributo) {
        ?>
        <div id="capa_atributo_unico_<?php echo $key_productos_detalles_unicos_id_atributo; ?>">
            <div class="grid-1">
                <div class="box text-center">
                    <strong>Atributos únicos</strong><br />
                    <?php
                    echo $atributos_disponibles[$valor_productos_detalles_unicos_id_atributo]."<br />";
                    foreach ($datos_atributos_disponibles[$valor_productos_detalles_unicos_id_atributo] as $key_productos_detalles => $valor_productos_detalles) {
                        $checked = "";
                        foreach ($matriz_productos_detalles_unicos_id_dato as $Key_unicos_id_dato => $valor_unicos_id_dato) {
                            /*
                            echo "atributo_unico_".$valor_productos_detalles_unicos_id_atributo." = ".$valor_productos_detalles.": ".$key_productos_detalles." == ".$valor_unicos_id_dato."<br />";
                            */
                            if($key_productos_detalles == $valor_unicos_id_dato && $matriz_productos_detalles_unicos_activo[$Key_unicos_id_dato] == 1) {
                                $checked = " checked";
                                break;
                            }
                        }
                        ?>
                        <div class="grid-2">
                            <div class="box text-center">
                                <input type="radio" id="atributo_unico_<?php echo $key_productos_detalles; ?>" name="atributo_unico_<?php echo $valor_productos_detalles_unicos_id_atributo; ?>"<?php echo $checked; ?> value="<?php echo $key_productos_detalles; ?>" />
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
            <div class="grid-2" id="capa_guardar_atributo_unico">
                <div class="box text-center">
                    <button class="botones-apartados" type="button" onclick="guardarAtributoUnico('<?php echo $valor_productos_detalles_unicos_id_atributo; ?>');">Guardar</button>
                </div>
                <div class="box text-center">
                    <button class="botones-apartados" type="button" onclick="eliminarAtributoUnico('<?php echo $valor_productos_detalles_unicos_id_atributo; ?>');">Eliminar</button>
                </div>
            </div>
        </div>
        <hr />
        <?php
    }
    unset($matriz_productos_detalles_unicos_id_atributo);
    unset($matriz_productos_detalles_unicos_id_dato);
    unset($matriz_productos_detalles_unicos_activo);
}

if(!isset($id_atributo_unico)) {

    /* No encuentra atributos unicos relacionados con el producto */

    ?>
    <div class="grid-1 mt-2">
        <div class="box text-center">
            <button class="submit" type="button" onclick="document.getElementById('capa_atributo_unico').style.display = 'block';">Crear atributos únicos</button>
        </div>
    </div>
    <div id="capa_atributo_unico" style="display: none;">
        <div class="grid-2">
            <div class="box text-center">
                <strong>Atributos disponibles:</strong><br />
                <?php
                foreach ($atributos_disponibles as $key_productos_detalles => $valor_productos_detalles) {
                    ?>
                    <div class="grid-2">
                        <div class="box text-center">
                            <input type="radio" id="atributo_unico_<?php echo $key_productos_detalles; ?>" name="atributo_unico_<?php echo $id_url; ?>" value="<?php echo $key_productos_detalles; ?>" />
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
                <button class="botones-apartados display-inline-grid" type="button" onclick="continuarAtributoUnico('<?php echo $id_url; ?>');">Continuar</button>
            </div>
            <div class="box text-center">
                <button class="botones-apartados display-inline-grid" type="button" onclick="document.getElementById('capa_atributo_unico').style.display = 'none';">Ocultar</button>
            </div>
        </div>
    </div>
    <?php
}else {
    ?>
    <input type="hidden" name="id_atributo_unico" id="id_atributo_unico" value="<?php echo $id_atributo_unico; ?>" />
    <div id="capa_atributo_unico">
        <div class="grid-2">
            <div class="box text-center">
                <?php
                echo $atributos_disponibles[$id_atributo_unico]."<br />";
                foreach ($datos_atributos_disponibles[$id_atributo_unico] as $key_datos_productos_detalles => $valor_datos_productos_detalles) {
                    ?>
                    <div class="grid-2">
                        <div class="box text-center">
                            <input type="radio" id="atributo_unico_<?php echo $key_datos_productos_detalles; ?>" name="atributo_unico_<?php echo $id_atributo_unico; ?>" value="<?php echo $key_datos_productos_detalles; ?>" />
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
        <div class="grid-1" id="capa_guardar_atributo_unico">
            <div class="box text-center">
                <button class="botones-apartados" type="button" onclick="guardarAtributoUnico('<?php echo $id_atributo_unico; ?>');">Guardar</button>
            </div>
        </div>
    </div>
    <?php
}