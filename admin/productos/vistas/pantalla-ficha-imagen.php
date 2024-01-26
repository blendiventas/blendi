<input type="hidden" name="apartado" id="apartado" value="imagen" />
<div id="capa_li_imagen">
    <?php
    $id_images_sys = $id_url;
    $sub_id_images_sys = 0;
    $imagen_sys = $imagen_productos;
    $updated_sys = $updated_productos;
    $alt_sys = $alt_productos;
    $tittle_sys = $tittle_productos;
    $destino_sys = "productos/" . $id_panel_sys;
    $modulo_renombrar = "productos";
    $tabla = "productos";
    $id_renombrar = $id_url;
    $etiqueta_id_retorno = "id_productos";
    $link_otros = "id_productos=".$id_url;
    if(isset($id_productos_detalles_enlazado_url)) {
        $link_otros .= "/att_enl=".$id_productos_detalles_enlazado_url;
    }
    if(isset($id_productos_detalles_multiples_url)) {
        $link_otros .= "/att_mult=".$id_productos_detalles_multiples_url;
    }
    if(isset($id_packs_url)) {
        $link_otros .= "/id_pack=".$id_packs_url;
    }
    if(isset($ancla_url)) {
        $link_otros .= "/id_ancla=".$ancla_url;
    }
    $nombre_imagen_sys = explode(".",$imagen_productos);
    require($_SERVER['DOCUMENT_ROOT']."/admin/componentes/form-images.php");
    ?>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="alt_productos">Alt imagen:</label><br>
        <input type="text" name="alt_productos" class="w-full" id="alt_productos" placeholder="Alt imagen" maxlength="60" value="<?php echo $alt_productos; ?>" />
    </div>
    <div>
        <label for="tittle_productos">Title imagen:</label><br>
        <input type="text" name="tittle_productos" class="w-full" id="tittle_productos" placeholder="Title imagen" maxlength="100" value="<?php echo $tittle_productos; ?>" />
    </div>
</div>

<div id="capa_guardar_update" class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="flex justify-end space-x-2">
        <?php
        if (!empty($imagen_sys)) {
            if (isset($eliminar_imagen_disabled) && $eliminar_imagen_disabled) {
                echo '&nbsp;';
            } else {
                ?>
                <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarFicha('eliminar-imagen');">Eliminar imagen</button>
                <?php
            }
        }
        ?>
        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarFicha('guardar');">Guardar</button>
    </div>
</div>
<?php
// pendiente de desarrollo
if(false && !empty($imagen_productos)) {
    $contador_lineas = 0;
    ?>
    <div>
        <?php
        $descripcion_productos = "Otras imágenes de ".$descripcion_productos;
        $id_productos_detalles_enlazado_url = 0;
        $id_productos_detalles_multiples_url = 0;
        $id_packs_url = 0;
        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/imagenes/vistas/pantalla-lista.php");
        ?>
    </div>
    <div>
        <?php
        require($_SERVER['DOCUMENT_ROOT']."/admin/productos/imagenes/vistas/pantalla-lista-otras.php");
        ?>
    </div>
    <?php
}
?>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
