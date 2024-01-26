<?php
if(!empty($descripcion_productos)) {
    ?>
    <h5><?php echo $descripcion_productos; ?></h5>
    <?php
}
/*
$matriz_id_productos_images[]
$matriz_id_producto_productos_images[]
$matriz_imagen_productos_images[]
$matriz_update_productos_images[]
$matriz_alt_productos_images[]
$matriz_tittle_productos_images[]
$matriz_orden_productos_images[]
$matriz_activo_productos_images
*/
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/imagenes/gestion/datos-select-php.php");
/*
$matriz_id_productos_images[] = $valor['id'];
$matriz_imagen_productos_images[] = stripslashes($valor['imagen']);
$matriz_update_productos_images[] = stripslashes($valor['updated']);
$matriz_alt_productos_images[] = stripslashes($valor['alt']);
$matriz_tittle_productos_images[] = stripslashes($valor['tittle']);
$matriz_activo_productos_images[] = stripslashes($valor['activo']);
*/
if(isset($matriz_id_productos_images)) {
    foreach ($matriz_id_productos_images as $key_productos_images => $valor_productos_images) {
        $contador_lineas += 1;
        ?>
        <div class="grid-1" id="linea_<?php echo $contador_lineas; ?>">
            <div class="box text-center">
                <img src="/images/productos/<?php echo $id_panel_sys . "/" . $matriz_imagen_productos_images[$key_productos_images]."?updated=".$matriz_update_productos_images[$key_productos_images]; ?>" id="img-imagen_productos" class="mw-50p" alt="<?php echo $matriz_alt_productos_images[$key_productos_images]; ?>" title="<?php echo $matriz_tittle_productos_images[$key_productos_images]; ?>" />
            </div>
        </div>
        <div class="grid-1">
            <div class="box" id="capa_img_activo_<?php echo $valor_productos_images; ?>">
                <?php
                if ($matriz_activo_productos_images[$key_productos_images] == 1) {
                    $imagen_src = "/images/valid-20.png";
                    $alt_src = "Activo";
                } else {
                    $imagen_src = "/images/invalid-20.png";
                    $alt_src = "Inactivo";
                }
                ?>
                <img src="<?php echo $imagen_src; ?>" id="img_activo_<?php echo $valor_productos_images; ?>" class="w-20p" alt="<?php echo $alt_src; ?>" title="<?php echo $alt_src; ?>" onmouseover="this.style.cursor='pointer'" onclick="cambiarEstadoImagenes('<?php echo $valor_productos_images; ?>');" />
            </div>
        </div>
        <div class="grid-1 border-button">
            <div class="box text-center">
                <!-- <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-imagenes/id_productos=<?php echo $id_url; ?>/apartado=imagen/id_images=<?php echo $valor_productos_images; ?>/id_ancla=<?php echo $contador_lineas; ?>" class="botones-apartados" title="Otras imagenes"> -->
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-imagenes/id_productos=<?php echo $id_url; ?>/apartado=imagen/id_images=<?php echo $valor_productos_images; ?>/att_enl=<?php echo $id_productos_detalles_enlazado_url; ?>/att_mult=<?php echo $id_productos_detalles_multiples_url; ?>/id_pack=<?php echo $id_packs_url; ?>/id_ancla=<?php echo $contador_lineas; ?>" class="botones-apartados" title="Otras imagenes">
                    Editar
                </a>
            </div>
        </div>
        <?php
    }
    unset($matriz_id_productos_images);
    unset($matriz_imagen_productos_images);
    unset($matriz_update_productos_images);
    unset($matriz_alt_productos_images);
    unset($matriz_tittle_productos_images);
    unset($matriz_activo_productos_images);
}else {

    if(empty($id_productos_detalles_enlazado_url) && empty($id_productos_detalles_multiples_url) && empty($id_packs_url)) {
        ?>
        <div class="grid-1">
            <div class="box m-05 text-center">
                No existen otras imagenes para este producto.
            </div>
        </div>
        <?php
    }
}
?>
<div class="grid-1 border-button" id="linea_<?php echo $contador_lineas; ?>">
    <div class="box text-center">
        <button class="submit" type="button" onclick="window.location.href = '/admin/gestion-productos-imagenes/id_productos=<?php echo $id_url; ?>/apartado=imagen/id_images=0/att_enl=<?php echo $id_productos_detalles_enlazado_url; ?>/att_mult=<?php echo $id_productos_detalles_multiples_url; ?>/id_pack=<?php echo $id_packs_url; ?>/id_ancla=<?php echo $contador_lineas; ?>';">Subir imagen</button>
    </div>
</div>
<hr />