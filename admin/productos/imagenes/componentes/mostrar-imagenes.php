<?php
$select_sys = "imagen-producto-encontrado";
require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/imagenes/gestion/datos-select-php.php");

$foto_producto = false;
if(!empty($imagen_productos_images)) {
    $foto_producto = true;
    if(file_exists("/images/productos/" . $id_panel_sys . "/" . $imagen_productos_images)) {
        ?>
        <img src="/images/productos/<?php echo $id_panel_sys . "/" . $imagen_productos_images."?updated=".$update_productos_images; ?>" class="h-10" alt="<?php echo $alt_productos_images; ?>" title="<?php echo $tittle_productos_images; ?>" />
        <?php
    }
}
unset($imagen_productos_images);
unset($update_productos_images);
unset($alt_productos_images);
unset($tittle_productos_images);