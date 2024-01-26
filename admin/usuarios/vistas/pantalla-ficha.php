<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de usuario <span class="font-medium"><?php echo $usuario_usuarios; ?></span>');
        setRutaSys('usuarios');
    </script>
    <?php
}

if(!empty($id_url)) {
    ?>
    <div class="w-full flex flex-wrap bg-gray-70 dark:bg-blendi-35">
        <div class="p-3 <?php echo (empty($apartado_url))? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="<?php echo $definicion_tipo_librador; ?>" onclick="cambiarApartadoFicha('')">
                Datos básicos
            </a>
        </div>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'permisos')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos dirección" onclick="cambiarApartadoFicha('permisos')">
                Permisos
            </a>
        </div>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'accesos')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos dirección" onclick="cambiarApartadoFicha('accesos')">
                Accesos
            </a>
        </div>
    </div>
    <?php
}
?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_usuarios" id="id_usuarios" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <?php
        if(!isset($apartado_url) OR $apartado_url == "null") {
            require("pantalla-ficha-basicos.php");
        }elseif($apartado_url == "permisos") {
            require("pantalla-ficha-permisos.php");
        }elseif($apartado_url == "accesos") {
            require("pantalla-ficha-accesos.php");
        }
        ?>
    </div>
</form>