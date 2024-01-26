<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/zonas/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de la zona <span class="font-medium"><?php echo (empty($zona_libradores_zonas))? '' : $zona_libradores_zonas; ?></span>');
        setRutaSys('zonas');
    </script>
    <?php
}
?>

<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_libradores_zonas" id="id_libradores_zonas" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 mt-3 items-center space-x-3">
            <div>
                <label for="zonas_productos_zonas">Zona:</label><br />
                <input type="text" class="w-full" name="zona_libradores_zonas" id="zona_libradores_zonas" placeholder="Zona" value="<?php echo $zona_libradores_zonas; ?>" required />
            </div>
        </div>
    </div>
</form>
<?php
