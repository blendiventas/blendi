<?php
/*
echo "1-Id productos: ".$id_url."<br />";
echo "1-Id images=0<br />";
echo "1-att enl: ".$id_productos_detalles_enlazado_url."<br />";
echo "1-att mult: ".$id_productos_detalles_multiples_url."<br />";
echo "1-Id pack: ".$id_pack_url."<br />";
*/
$select_sys = "descripcion-producto";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
$select_sys = "editar-imagen";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/imagenes/gestion/datos-select-php.php");
if(!empty($id_productos_detalles_enlazado_url)) {
    $id_productos_detalles_enlazado = $id_productos_detalles_enlazado_url;
    $select_sys = "descripcion_enlazado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
    if(!empty($descripcion_productos_detalles_enlazado)) {
        $descripcion_productos_detalles_enlazado = "&nbsp;".$descripcion_productos_detalles_enlazado;
    }
}
if(!empty($id_productos_detalles_multiples_url)) {
    $id_productos_detalles_multiples = $id_productos_detalles_multiples_url;
    $select_sys = "descripcion_multiple";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
    if(!empty($descripcion_productos_detalles_multiples)) {
        $descripcion_productos_detalles_multiples = "&nbsp;".$descripcion_productos_detalles_multiples;
    }
}
if(!empty($id_packs_url)) {
    $id_packs = $id_packs_url;
    $select_sys = "descripcion-pack";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/packs/gestion/datos-select-php.php");
    if(!empty($descripcion_pack)) {
        $descripcion_pack = "&nbsp;".$descripcion_pack;
    }
}
?>
<h1>Imagen del producto <span id="titulo"><?php echo $descripcion_productos.$descripcion_productos_detalles_enlazado.$descripcion_productos_detalles_multiples.$descripcion_pack; ?></span></h1>
<hr />
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_productos_images" id="id_productos_images" value="<?php echo $id_productos_images_url; ?>" />
    <div class="capa_form_datos">
        <ul>
            <input type="hidden" name="apartado" id="apartado" value="imagen" />

            <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $id_url; ?>" />
            <input type="hidden" name="att_enl" id="att_enl" value="<?php echo $id_productos_detalles_enlazado_url; ?>" />
            <input type="hidden" name="att_mult" id="att_mult" value="<?php echo $id_productos_detalles_multiples_url; ?>" />
            <input type="hidden" name="id_pack" id="id_pack" value="<?php echo $id_packs_url; ?>" />
            <input type="hidden" name="id_ancla" id="id_ancla" value="<?php echo $id_ancla_url; ?>" />

            <li id="capa_li_imagen">
                <?php
                /*
                echo "2-Id productos: ".$id_url."<br />";
                echo "2-Id images=0<br />";
                echo "2-att enl: ".$id_productos_detalles_enlazado_url."<br />";
                echo "2-att mult: ".$id_productos_detalles_multiples_url."<br />";
                echo "2-Id pack: ".$id_pack_url."<br />";
                */
                $id_images_sys = $id_productos_images_url;
                $sub_id_images_sys = $id_url;
                $imagen_sys = $imagen_productos_images;
                $updated_sys = $update_productos_images;
                $alt_sys = $alt_productos_images;
                $tittle_sys = $tittle_productos_images;
                $destino_sys = "productos";
                $modulo_renombrar = "productos-imagenes";
                $tabla = "productos_images";
                $id_renombrar = $id_productos_images_url;
                $etiqueta_id_retorno = "id_images";
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
                $nombre_imagen_sys = explode(".",$imagen_productos_images);
                require($_SERVER['DOCUMENT_ROOT']."/admin/componentes/form-images.php");
                ?>
            </li>
            <li>
                <label for="alt_productos_images">Alt imagen:</label>
                <input type="text" name="alt_productos_images" id="alt_productos_images" placeholder="Alt imagen" maxlength="60" value="<?php echo $alt_productos_images; ?>" />
            </li>
            <li>
                <label for="tittle_productos_images">Title imagen:</label>
                <input type="text" name="tittle_productos_images" id="tittle_productos_images" placeholder="Title imagen" maxlength="100" value="<?php echo $tittle_productos_images; ?>" />
            </li>
            <li>
                <?php
                if($activo_productos_images == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                }
                ?>
                <label>Activo:</label>
                <span class="label-input">SI</span><input type="radio" name="activo_productos_images" id="activo_productos_images" value="1"<?php echo $checked_activo_sys; ?> />
                <span class="label-input">NO</span><input type="radio" name="activo_productos_images" id="inactivo_productos_images" value="0"<?php echo $checked_inactivo_sys; ?> />
            </li>
            <li>
                <label for="orden_productos_images">Orden:</label>
                <input type="text" name="orden_productos_images" id="orden_productos_images" placeholder="Orden" maxlength="20" value="<?php echo $orden_productos_images; ?>" />
            </li>
        </ul>
    </div>
</form>
<?php
if(empty($id_productos_images_url)) {
    $classe_sys = "grid-2 mb-2";
}else {
    $classe_sys = "grid-3 mb-2";
}
?>
<div id="capa_guardar_update" class="grid-2 mb-2">
    <div class="box">
        <button class="submit" type="button" onclick="guardarFicha('guardar');">Guardar</button>
    </div>
    <div class="box">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos/id_productos=<?php echo $id_url; ?>/apartado=imagen/ancla=linea_<?php echo $id_ancla_url; ?>" class="botones-apartados" title="Productos">
        <!-- <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos/ancla=linea_<?php echo $id_url; ?>" class="botones-apartados" title="Productos"> -->
            Volver
        </a>
    </div>
</div>