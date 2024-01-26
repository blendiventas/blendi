<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_entrega/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de la modalidad de entrega <span class="font-medium"><?php echo (empty($descripcion_modalidades_entrega))? '' : $descripcion_modalidades_entrega; ?></span>');
        setRutaSys('modalidades_entrega');
    </script>
    <?php
}

?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_modalidades_entrega" id="id_modalidades_entrega" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="descripcion_modalidades_entrega">Descripción:</label><br>
                <input type="text" name="descripcion_modalidades_entrega" id="descripcion_modalidades_entrega" class="w-full" placeholder="Descripción" value="<?php echo $descripcion_modalidades_entrega; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="explicacion_modalidades_entrega">Explicación:</label><br>
                <textarea name="explicacion_modalidades_entrega" id="explicacion_modalidades_entrega" class="w-full" placeholder="Explicación" required><?php echo $explicacion_modalidades_entrega; ?></textarea>
            </div>
        </div>
    </div>
</form>
