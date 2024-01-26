<div class="grid-5 font-bold">
    <div class="box m-05 text-left">
        Idioma
    </div>
    <div class="box m-05 text-left">
        Bandera
    </div>
    <div class="box m-05">
        Activo
    </div>
    <div class="box m-05">
        Principal
    </div>
    <div class="box m-05 text-left">
        &nbsp;
    </div>
</div>
<hr />
<?php
$select_sys = "total";
require($_SERVER['DOCUMENT_ROOT']."/admin/idiomas/gestion/datos-select-php.php");
if(isset($matriz_id_idiomas)) {
    foreach ($matriz_id_idiomas as $key => $valor) {
        ?>
        <div class="grid-5 border-button" id="linea_<?php echo $valor; ?>">
            <div class="box m-05 text-left"><?php echo $matriz_idioma_idiomas[$key]; ?></div>
            <div class="box m-05">
                <?php
                if(!empty($matriz_bandera_idiomas[$key])) {
                    ?>
                    <img src="/images/idiomas/<?php echo $matriz_bandera_idiomas[$key]."?updated=".$matriz_updated_idiomas[$key]; ?>" id="img_imagen_idiomas_<?php echo $valor; ?>" class="mw-50p" alt="<?php echo $matriz_idioma_idiomas[$key]; ?>" title="<?php echo $matriz_idioma_idiomas[$key]; ?>" />
                    <?php
                }else {
                    echo "&nbsp;";
                }
                ?>
            </div>
            <div class="box m-05" id="capa_img_activo_<?php echo $valor; ?>">
                <?php
                if ($matriz_activo_idiomas[$key] == 1) {
                    $imagen_src_sys = "../../images/valid-20.png";
                    $alt_src_sys = "Activo";
                } else {
                    $imagen_src_sys = "../../images/invalid-20.png";
                    $alt_src_sys = "Inactivo";
                }
                if ($matriz_principal_idiomas[$key] == 0) {
                    ?>
                    <img src="<?php echo $imagen_src_sys; ?>" id="img_activo_<?php echo $valor; ?>" class="w-20p" alt="<?php echo $alt_src_sys; ?>" title="<?php echo $alt_src_sys; ?>" onmouseover="this.style.cursor='pointer'" onclick="cambiarEstado('<?php echo $valor; ?>');" />
                    <?php
                }else {
                    ?>
                    <img src="<?php echo $imagen_src_sys; ?>" id="img_activo_<?php echo $valor; ?>" class="w-20p" alt="<?php echo $alt_src_sys; ?>" title="<?php echo $alt_src_sys; ?>" />
                    <?php
                }
                ?>
            </div>
            <div class="box m-05" id="capa_img_activo_<?php echo $valor; ?>">
                <?php
                if ($matriz_principal_idiomas[$key] == 1) {
                    $imagen_src_sys = "../../images/valid-20.png";
                    $alt_src_sys = "Principal";
                    ?>
                    <img src="<?php echo $imagen_src_sys; ?>" id="img_activo_<?php echo $valor; ?>" class="w-20p" alt="<?php echo $alt_src_sys; ?>" title="<?php echo $alt_src_sys; ?>" />
                    <?php
                } else {
                    echo "&nbsp;";
                }
                ?>
            </div>
            <div class="box m-05 text-left">
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-idiomas/id_idiomas=<?php echo $valor; ?>" class="botones-apartados" title="Idiomas">
                    Editar
                </a>
            </div>
        </div>
        <?php
    }
    unset($matriz_id_idiomas);
    unset($matriz_descripcion_idiomas);
    unset($matriz_imagen_idiomas);
    unset($matriz_updated_idiomas);
    unset($matriz_de_idiomas);
    unset($matriz_activa_idiomas);
    unset($matriz_orden_idiomas);
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
            No existen idiomas definidos.
        </div>
    </div>
    <?php
}
?>
<hr />