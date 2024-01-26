<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/metodos_pago_bans/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha del ban en método de pago <span class="font-medium"><?php echo (empty($correo_metodos_pago_bans))? '' : $correo_metodos_pago_bans; ?></span>');
        setRutaSys('metodos_pago_bans');
    </script>
    <?php
}

?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_metodos_pago_bans" id="id_metodos_pago_bans" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="correo_metodos_pago_bans">Correo:</label><br>
                <input type="text" name="correo_metodos_pago_bans" id="correo_metodos_pago_bans" class="w-full" placeholder="Correo" value="<?php echo $correo_metodos_pago_bans; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <?php
                $id_select_sys = "id_metodo_pago_metodos_pago_bans";
                $id_metodos_pago_url = $id_metodo_pago_metodos_pago_bans;
                require($_SERVER['DOCUMENT_ROOT']."/admin/metodos_pago/componentes/form-select.php");
                ?>
            </div>
        </div>
    </div>
</form>
