<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_envio/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de la modalidad de envío <span class="font-medium"><?php echo (empty($descripcion_modalidades_envio))? '' : $descripcion_modalidades_envio; ?></span>');
        setRutaSys('modalidades_envio');
    </script>
    <?php
}

if(!empty($id_url)) {
    ?>
    <div class="w-full flex flex-wrap bg-gray-70 dark:bg-blendi-35">
        <div class="p-3 <?php echo (empty($apartado_url))? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos básicos" onclick="cambiarApartadoFicha('')">
                Datos básicos
            </a>
        </div>
        <?php
        if($sector != "restauracion") {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'zonas')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Unidades" onclick="cambiarApartadoFicha('zonas')">
                    Zonas
                </a>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}

?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_modalidades_envio" id="id_modalidades_envio" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <?php
        if(!isset($apartado_url) OR $apartado_url == "null") {
            require("pantalla-ficha-basicos.php");
        }elseif($apartado_url == "zonas") {
            require("pantalla-ficha-zonas.php");
        }
        ?>
    </div>
</form>
