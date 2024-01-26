<?php
require("form-datos.php");
if(isset($atributos_disponibles) && isset($datos_atributos_disponibles)) {
    $select_sys = "listado_atributos_multiples";
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
    if(!isset($productos_detalles_multiples_id_atributo)) {
        echo "<hr />";
        /* Encuentra atributos enlazados relacionados con el producto */
        require("atributos-enlazados.php");
    }
    ?>
    <hr />
    <?php
    if($datos_atributos_enlazados == false) {
        if(!isset($id_productos_detalles_multiples_url)) {
            /*
            $productos_detalles_multiples_id_atributo
            $matriz_productos_detalles_multiples_id_dato[]
            $matriz_productos_detalles_multiples_activo[]
            */
            if(isset($productos_detalles_multiples_id_atributo)) {
                /* Encuentra atributos multiples relacionados con el producto */
                ?>
                <input type="hidden" name="id_atributo_multiple" id="id_atributo_multiple" value="<?php echo $productos_detalles_multiples_id_atributo; ?>" />
                <div id="capa_atributo_multiple">
                    <div class="grid-1">
                        <div class="box text-center">
                            <strong>Atributo múltiple</strong><br />
                            <?php
                            echo $atributos_disponibles[$productos_detalles_multiples_id_atributo]."<br />";
                            foreach ($datos_atributos_disponibles[$productos_detalles_multiples_id_atributo] as $key_productos_detalles => $valor_productos_detalles) {
                                $checked = "";
                                foreach ($matriz_productos_detalles_multiples_id_dato as $Key_multiples_id_dato => $valor_multiples_id_dato) {
                                    if($key_productos_detalles == $valor_multiples_id_dato && $matriz_productos_detalles_multiples_activo[$Key_multiples_id_dato] == 1) {
                                        $checked = " checked";
                                        break;
                                    }
                                }
                                ?>
                                <div class="grid-2">
                                    <div class="box text-center">
                                        <input type="checkbox" name="atributos_multiples[<?php echo $key_productos_detalles; ?>]"<?php echo $checked; ?> value="<?php echo $key_productos_detalles; ?>" />
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
                    <div class="text-center" id="capa_guardar_atributo_multiple">
                        <button class="botones-apartados" type="button" onclick="guardarAtributoMultiple();">Guardar</button>
                    </div>
                </div>
                <?php
                unset($matriz_productos_detalles_multiples_id);
                unset($productos_detalles_multiples_id_atributo);
                unset($matriz_productos_detalles_multiples_id_dato);
                unset($matriz_productos_detalles_multiples_activo);
            }else {
                /* No encuentra atributos multiples relacionados con el producto */
                ?>
                <div class="grid-1">
                    <div class="box text-center">
                        <button class="submit" type="button" onclick="document.getElementById('capa_atributo_multiple').style.display = 'block';">Crear atributos multiples</button>
                    </div>
                </div>
                <div id="capa_atributo_multiple" style="display: none">
                    <div class="grid-2">
                        <div class="box text-center">
                            <strong>Atributos disponibles:</strong><br />
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
                    </div>
                    <div class="grid-2">
                        <div class="box text-center">
                            <button class="botones-apartados" type="button" onclick="continuarAtributoMultiple('<?php echo $id_url; ?>');">Continuar</button>
                        </div>
                        <div class="box text-center">
                            <button class="botones-apartados" type="button" onclick="document.getElementById('capa_atributo_multiple').style.display = 'none';">Ocultar</button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else {
            ?>
            <input type="hidden" name="id_atributo_multiple" id="id_atributo_multiple" value="<?php echo $id_productos_detalles_multiples_url; ?>" />
            <div id="capa_atributo_multiple">
                <div class="grid-2">
                    <div class="box text-center">
                        <?php
                        echo $atributos_disponibles[$id_productos_detalles_multiples_url]."<br />";
                        foreach ($datos_atributos_disponibles[$id_productos_detalles_multiples_url] as $key_datos_productos_detalles => $valor_datos_productos_detalles) {
                            ?>
                            <div class="grid-2">
                                <div class="box text-center">
                                    <input type="checkbox" name="atributos_multiples[<?php echo $key_datos_productos_detalles; ?>]" value="<?php echo $key_datos_productos_detalles; ?>" />
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
                <div class="grid-1" id="capa_guardar_atributo_multiple">
                    <div class="box text-center">
                        <button class="botones-apartados" type="button" onclick="guardarAtributoMultiple();">Guardar</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <hr />
        <?php
    }
    require("atributos_unicos.php");
}else{
    require("atributos_unicos.php");
}