<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/impresion_documentos/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha del modelo <span class="font-medium"><?php echo $descripcion_modelos; ?></span>');
        setRutaSys('impresion_documentos');
    </script>
    <?php
}
?>

<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_modelos" id="id_modelos" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <ul>
            <?php
            require("pantalla-ficha-basicos.php");
            ?>
        </ul>
    </div>
</form>