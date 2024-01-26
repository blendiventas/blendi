<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/categorias_elaborados/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de categoría <span class="font-medium"><?php echo $descripcion_categorias_elaborados; ?></span>');
        setRutaSys('categorias_elaborados');
    </script>
    <?php
}

?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_categorias_elaborados" id="id_categorias_elaborados" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="descripcion_categorias_elaborados">Descripción:</label>
                <input type="text" name="descripcion_categorias_elaborados" id="descripcion_categorias_elaborados" placeholder="Descripción" class="w-full" value="<?php echo $descripcion_categorias_elaborados; ?>" required />
            </div>
        </div>
    </div>
</form>
