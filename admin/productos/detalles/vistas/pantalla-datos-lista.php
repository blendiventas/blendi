<div class="grid-1 text-center font-bold" id="linea_0">
    Añadir nueva propiedad de <?php echo $detalle_productos_detalles; ?>
</div>
<div class="grid-2">
    <div class="box text-center">
        <input type="text" name="detalle_productos_detalles_datos_0" id="detalle_productos_detalles_datos_0" placeholder="Nueva propiedad" maxlength="250" value="" required />
    </div>
    <div class="box text-center">
        <input type="text" name="orden_productos_detalles_datos_0" id="orden_productos_detalles_datos_0" placeholder="Orden" maxlength="20" value="" required />
    </div>
</div>
<div class="grid-1">
    <li style="border-bottom: none;">
        <label>Activo:</label>
        <span class="label-input">SI</span><input type="radio" name="activo_productos_detalles_datos_0" id="activo_productos_detalles_datos_0" value="1" checked />
        <span class="label-input">NO</span><input type="radio" name="activo_productos_detalles_datos_0" id="inactivo_productos_detalles_datos_0" value="0" />
    </li>
</div>
<div class="grid-1">
    <div id="capa_guardar_update_productos_detalles_datos_0" class="box text-center">
        <button class="submit" type="button" onclick="guardarPropiedad('guardar-datos','<?php echo $id_url; ?>','<?php echo $id_productos_detalles_url; ?>','0');">Guardar</button>
    </div>
</div>
<hr />
<?php
$select_sys = "listado-filtrado-datos";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
if(isset($matriz_id_productos_detalles_datos)) {
    ?>
    <div class="grid-4 font-bold border-button">
        <div class="box m-05 text-left">
            Propiedad
        </div>
        <div class="box m-05 text-left">
            Orden
        </div>
        <div class="box m-05">
            Activo
        </div>
        <div class="box m-05 text-left">
            <div class="box m-05 text-left">
                &nbsp;
            </div>
        </div>
    </div>
    <?php
    foreach ($matriz_id_productos_detalles_datos as $key_productos_detalles_datos => $valor_productos_detalles_datos) {
        ?>
        <div class="grid-4 border-button" id="linea_<?php echo $valor_productos_detalles_datos; ?>">
            <div class="box m-05 text-left">
                <input type="text" name="detalle_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>" id="detalle_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>" maxlength="250" value="<?php echo $matriz_detalle_productos_detalles_datos[$key_productos_detalles_datos]; ?>" placeholder="Propiedad" required />
            </div>
            <div class="box m-05 text-left">
                <input type="text" name="orden_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>" id="orden_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>" maxlength="20" value="<?php echo $matriz_orden_productos_detalles_datos[$key_productos_detalles_datos]; ?>" placeholder="Orden" />
            </div>
            <div class="box m-05" id="capa_img_activo_<?php echo $valor_productos_detalles_datos; ?>">
                <?php
                if ($matriz_activo_productos_detalles_datos[$key_productos_detalles_datos] == 1) {
                    $imagen_src = "/images/valid-20.png";
                    $alt_src = "Activo";
                    ?>
                    <input type="hidden" name="activo_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>" id="activo_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>" value="1" />
                    <?php
                } else {
                    $imagen_src = "/images/invalid-20.png";
                    $alt_src = "Inactivo";
                    ?>
                    <input type="hidden" name="inactivo_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>" id="inactivo_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>" value="1" />
                    <?php
                }
                ?>
                <img src="<?php echo $imagen_src; ?>" id="img_activo_<?php echo $valor_productos_detalles_datos; ?>" class="w-20p" alt="<?php echo $alt_src; ?>" title="<?php echo $alt_src; ?>" onmouseover="this.style.cursor='pointer'" onclick="cambiarEstadoDatos('<?php echo $valor_productos_detalles_datos; ?>');" />
            </div>
            <div class="box m-05 text-left" id="capa_guardar_update_productos_detalles_datos_<?php echo $valor_productos_detalles_datos; ?>">
                <div class="box m-05 text-left">
                    <button class="submit" type="button" onclick="guardarPropiedad('guardar-datos','<?php echo $id_url; ?>','<?php echo $id_productos_detalles_url; ?>','<?php echo $valor_productos_detalles_datos; ?>');">Guardar</button>
                </div>
                <div class="box m-05 text-left">
                    <button class="submit" type="button" onclick="guardarPropiedad('eliminar-datos','<?php echo $id_url; ?>','<?php echo $id_productos_detalles_url; ?>','<?php echo $valor_productos_detalles_datos; ?>');">Eliminar</button>
                </div>
            </div>
        </div>
        <?php
    }
    unset($matriz_id_productos_detalles_datos);
    unset($matriz_detalle_productos_detalles_datos);
    unset($matriz_orden_productos_detalles_datos);
    ?>
    <script>
        if(anclaLista != "linea_") {
            location.hash = "#" + anclaLista;
        }
    </script>
    <?php
}else {
    ?>
    <div class="grid-1">
        <div class="box m-05 text-center">
            No existen detalles de productos definidos.
        </div>
    </div>
    <?php
}
?>
<hr />