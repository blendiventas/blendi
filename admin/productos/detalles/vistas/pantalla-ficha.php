<?php
$apartado_sys = "null";
if(isset($id_url)) {
    $link_productos_sys = "/id_productos=".$id_url;
    if(isset($apartado_url)) {
        $link_productos_sys .= "/apartado=".$apartado_url;
        $apartado_sys = $apartado_url;
    }
}else {
    $id_url = "null";
    $link_productos_sys = "";
}
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
?>
<div class="grid-2">
    <div class="box">
        <h1>Datos del detalle de productos <span id="titulo"><?php echo $detalle_productos_detalles; ?></span></h1>
    </div>
    <div class="box">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles<?php echo $link_productos_sys; ?>/ancla=linea_<?php echo $id_productos_detalles_url; ?>" class="botones-apartados" title="Detalles de productos">
            Volver
        </a>
    </div>
</div>
<hr />
<div class="grid-1">
    <div class="row">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles<?php echo $link_productos_sys; ?>/id_productos_detalles=<?php echo $id_productos_detalles_url; ?>" class="botones-apartados" title="Detalles de productos">
            Datos básicos
        </a>
    </div>
</div>
<h4>DATOS BÁSICOS</h4>
<hr />
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <?php
    if(!empty($link_productos_sys)) {
        ?>
        <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $id_url; ?>" />
        <?php
    }else {
        ?>
        <input type="hidden" name="id_productos" id="id_productos" value="null" />
        <?php
    }
    ?>
    <input type="hidden" name="id_productos_detalles" id="id_productos_detalles" value="<?php echo $id_productos_detalles_url; ?>" />
    <div class="capa_form_datos">
        <ul>
            <input type="hidden" name="apartado" id="apartado" value="<?php echo $apartado_sys; ?>" />
            <li>
                <span class="required_notification">* Datos requeridos</span>
            </li>
            <li>
                <?php
                $id_select_sys = "id_idioma_productos_detalles";
                $id_idioma_sys = $id_idioma_productos_detalles;
                require($_SERVER['DOCUMENT_ROOT']."/admin/idiomas/componentes/form-select.php");
                ?>
            </li>
            <li>
                <label for="detalle_productos_detalles">Detalle:</label>
                <input type="text" name="detalle_productos_detalles" id="detalle_productos_detalles" placeholder="Detalle" maxlength="250" value="<?php echo $detalle_productos_detalles; ?>" required />
            </li>
            <li>
                <label for="orden_productos">Orden:</label>
                <input type="text" name="orden_productos_detalles" id="orden_productos_detalles" placeholder="Orden" maxlength="20" value="<?php echo $orden_productos_detalles; ?>" />
            </li>
            <li style="border-bottom: none;">
                <?php
                if($activo_productos_detalles == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                }
                ?>
                <label>Activo:</label>
                <span class="label-input">SI</span><input type="radio" name="activo_productos_detalles" id="activo_productos_detalles" value="1"<?php echo $checked_activo_sys; ?> />
                <span class="label-input">NO</span><input type="radio" name="activo_productos_detalles" id="inactivo_productos_detalles" value="0"<?php echo $checked_inactivo_sys; ?> />
            </li>

            <?php
            if(empty($id_productos_detalles_url)) {
                $classe_sys = "grid-1 mb-2";
            }else {
                $classe_sys = "grid-2 mb-2";
            }
            ?>
            <div id="capa_guardar_update" class="<?php echo $classe_sys; ?>">
                <div class="box">
                    <button class="submit" type="button" onclick="guardarFicha('guardar');">Guardar</button>
                </div>
                <?php
                if(!empty($id_productos_detalles_url)) {
                    ?>
                    <div class="box">
                        <button class="submit" type="button" onclick="guardarFicha('eliminar');">Eliminar</button>
                    </div>
                    <?php
                }
                ?>
            </div>
            <hr />
            <?php
            if(!empty($id_productos_detalles_url)) {
                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/vistas/pantalla-datos-lista.php");
            }
            ?>
        </ul>
    </div>
</form>

<div class="grid-1">
    <div class="box">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles<?php echo $link_productos_sys; ?>/ancla=linea_<?php echo $id_productos_detalles_url; ?>" class="botones-apartados" title="Detalles de productos">
            Volver
        </a>
    </div>
</div>