<?php
if(isset($id_url)) {
    $link_productos_sys = "/id_productos=".$id_url;
    $grid_sys = "grid-5";
    if(isset($apartado_url)) {
        $link_productos_sys .= "/apartado=".$apartado_url;
    }
}else {
    $link_productos_sys = "";
    $grid_sys = "grid-4";
}
?>
<div class="<?php echo $grid_sys; ?>">
    <div class="box text-center">
        <h1>DETALLES PRODUCTOS</h1>
    </div>
    <form action="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles" class="formulario" id="form_datos_post" name="form_datos_post" method="post">
        <div class="box text-center">
            <form id="form_datos_post" name="form_datos_post" method="post">
                <div class="grid-2-75-25">
                    <div class="box text-right">
                        <?php
                        $id_select_sys = "id_idioma";
                        require($_SERVER['DOCUMENT_ROOT']."/admin/idiomas/componentes/form-select.php");
                        ?>
                    </div>
                    <div class="box text-left">
                        <img class="icon-18 bg-white" src="<?php echo $host_base_sys; ?>icons/System/refresh-fill.svg" alt="My Happy SVG" onclick="selectReset(document.getElementById('id_idioma')); selectCompletar('id_idioma','idiomas');" />
                    </div>
                </div>
            </form>
        </div>
    </form>
    <div class="box text-center">
        <button type="button" class="w-50" onclick="document.getElementById('form_datos_post').submit();">
            Mostrar resultados
        </button>
    </div>
    <div class="box text-center">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles<?php echo $link_productos_sys; ?>/id_productos_detalles=0" class="botones-apartados" title="Detalles de productos">
            Crear nuevo detalle de producto
        </a>
    </div>
    <?php
    if(isset($id_url)) {
        ?>
        <div class="box text-center">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos<?php echo $link_productos_sys; ?>" class="botones-apartados" title="Productos">
                Volver
            </a>
        </div>
        <?php
    }
    ?>
</div>
<hr />