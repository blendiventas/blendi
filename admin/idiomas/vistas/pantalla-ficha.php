<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/idiomas/gestion/datos-select-php.php");
?>
<h1>Datos del idioma <span id="titulo"><?php echo $idioma_idiomas; ?></span></h1>
<hr />
<div class="grid-1">
    <div class="row">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-idiomas/id_idiomas=<?php echo $id_idiomas_url; ?>" class="botones-apartados" title="Categorías">
            Datos básicos
        </a>
    </div>
</div>
<h4>DATOS BÁSICOS</h4>
<hr />
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_idiomas" id="id_idiomas" value="<?php echo $id_idiomas_url; ?>" />
    <div class="capa_form_datos">
        <ul>
            <li>
                <span class="required_notification">* Datos requeridos</span>
            </li>
            <li>
                <label for="descripcion_idiomas">Idioma:</label>
                <input type="text" name="idioma_idiomas" id="idioma_idiomas" placeholder="Idioma" maxlength="50" value="<?php echo $idioma_idiomas; ?>" required />
            </li>
            <li>
                <label for="lang_idiomas">Lang:</label>
                <input type="text" name="lang_idiomas" id="lang_idiomas" placeholder="Lang" maxlength="2" value="<?php echo $lang_idiomas; ?>" />
            </li>
            <li>
                <label for="locale_idiomas">Locale:</label>
                <input type="text" name="locale_idiomas" id="locale_idiomas" placeholder="Locale" maxlength="5" value="<?php echo $locale_idiomas; ?>" />
            </li>
            <li>
                <?php
                if($activo_idiomas == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                }
                ?>
                <label>Activo:</label>
                <span class="label-input">SI</span><input type="radio" name="activo_idiomas" id="activo_idiomas" value="1"<?php echo $checked_activo_sys; ?> />
                <span class="label-input">NO</span><input type="radio" name="activo_idiomas" id="inactivo_idiomas" value="0"<?php echo $checked_inactivo_sys; ?> />
            </li>
            <li>
                <?php
                if($principal_idiomas == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                    $disabled = " disabled";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                    $disabled = "";
                }
                ?>
                <label>Idioma principal:</label>
                <span class="label-input">SI</span><input type="radio" name="principal_idiomas" id="principal_si_idiomas" value="1"<?php echo $checked_activo_sys; ?> />
                <span class="label-input">NO</span><input type="radio" name="principal_idiomas" id="principal_no_idiomas" value="0"<?php echo $checked_inactivo_sys.$disabled; ?> />
            </li>
            <li id="capa_li_imagen">
                <?php
                $id_images_sys = $id_idiomas_url;
                $sub_id_images_sys = 0;
                $imagen_sys = $bandera_idiomas;
                $updated_sys = $updated_idiomas;
                $alt_sys = $idioma_idiomas;
                $tittle_sys = $idioma_idiomas;
                $destino_sys = "idiomas";
                $modulo_renombrar = "idiomas";
                $tabla = "idiomas";
                $id_renombrar = $id_idiomas_url;
                $etiqueta_id_retorno = "id_idiomas";
                $link_otros = "";
                $nombre_imagen_sys = explode(".",$bandera_idiomas);
                require($_SERVER['DOCUMENT_ROOT']."/admin/componentes/form-images.php");
                ?>
            </li>
        </ul>
    </div>
</form>
<?php
if(empty($id_idiomas_url)) {
    $classe_sys = "grid-2 mb-2";
}else {
    $classe_sys = "grid-3 mb-2";
}
?>
<div id="capa_guardar_update" class="<?php echo $classe_sys; ?>">
    <div class="box">
        <button class="submit" type="button" onclick="guardarFicha('guardar');">Guardar</button>
    </div>
    <?php
    if(!empty($id_idiomas_url)) {
        ?>
        <div class="box">
            <button class="submit" type="button" onclick="guardarFicha('eliminar');">Eliminar</button>
        </div>
        <?php
    }
    ?>
    <div class="box">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-idiomas/ancla=linea_<?php echo $id_idiomas_url; ?>" class="botones-apartados" title="Categorías">
            Volver
        </a>
    </div>
</div>