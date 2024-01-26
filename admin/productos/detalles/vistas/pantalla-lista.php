<?php
if(isset($id_url)) {
    $link_productos_sys = "/id_productos=".$id_url;
    if(isset($apartado_url)) {
        $link_productos_sys .= "/apartado=".$apartado_url;
    }
}else {
    $link_productos_sys = "";
}
?>
<div class="grid-3 font-bold">
    <div class="box m-05 text-left">
        Detalle
    </div>
    <div class="box m-05">
        Activo
    </div>
    <div class="box m-05 text-left">
        &nbsp;
    </div>
</div>
<hr />
<?php
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
if(isset($matriz_id_productos_detalles)) {
    foreach ($matriz_id_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
        ?>
        <div class="grid-3 border-button" id="linea_<?php echo $valor_productos_detalles; ?>">
            <div class="box m-05 text-left"><?php echo $matriz_detalle_productos_detalles[$key_productos_detalles]; ?></div>
            <div class="box m-05" id="capa_img_activo_<?php echo $valor_productos_detalles; ?>">
                <?php
                if ($matriz_activo_productos_detalles[$key_productos_detalles] == 1) {
                    $imagen_src = "../../../../images/valid-20.png";
                    $alt_src = "Activo";
                } else {
                    $imagen_src = "../../../../images/invalid-20.png";
                    $alt_src = "Inactivo";
                }
                ?>
                <img src="<?php echo $imagen_src; ?>" id="img_activo_<?php echo $valor_productos_detalles; ?>" class="w-20p" alt="<?php echo $alt_src; ?>" title="<?php echo $alt_src; ?>" onmouseover="this.style.cursor='pointer'" onclick="cambiarEstado('<?php echo $valor_productos_detalles; ?>');" />
            </div>
            <div class="box m-05 text-left">
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles<?php echo $link_productos_sys; ?>/id_productos_detalles=<?php echo $valor_productos_detalles; ?>" class="botones-apartados" title="Detalles de productos">
                    Editar
                </a>
            </div>
        </div>
        <?php
    }
    unset($matriz_id_productos_detalles);
    unset($matriz_detalle_productos_detalles);
    unset($matriz_activo_productos_detalles);
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