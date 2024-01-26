<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/grupos/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de grupo <span class="font-medium"><?php echo $descripcion_productos_grupos; ?></span>');
        setRutaSys('productos/grupos');
    </script>
    <?php
}

?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_productos_grupos" id="id_productos_grupos" value="<?php echo $id_url; ?>" />
    <input type="hidden" name="apartado" id="apartado" value="<?php echo $apartado_sys; ?>" />
    <input type="hidden" name="id_idioma_productos_grupos" id="id_idioma_productos_grupos" value="<?php echo $id_idioma_productos_grupos; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="descripcion_productos_grupos">Descripción:</label>
                <input type="text" name="descripcion_productos_grupos" id="descripcion_productos_grupos" placeholder="Descripción" maxlength="250" class="w-full" value="<?php echo $descripcion_productos_grupos; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="orden_productos">Orden:</label>
                <input type="text" name="orden_productos_grupos" id="orden_productos_grupos" placeholder="Orden" maxlength="20" class="w-full" value="<?php echo $orden_productos_grupos; ?>" />
            </div>
        </div>
    </div>
</form>
