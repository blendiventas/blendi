<?php
if ($tipo_libradores_url === 'cli' || $tipo_libradores_url === 'tak' || $tipo_libradores_url === 'del') {
    $definicion_tipo_librador = "cliente";
} else if ($tipo_libradores_url === 'pro') {
    $definicion_tipo_librador = "proveedor";
} else if ($tipo_libradores_url === 'cre') {
    $definicion_tipo_librador = "creditor";
}
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT'] . "/admin/libradores/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha del <?php echo $definicion_tipo_librador; ?> <span class="font-medium"><?php echo (empty($nombre_libradores))? addslashes($razon_comercial_libradores) : addslashes($nombre_libradores); ?></span>');
        setRutaSys('libradores');
    </script>
    <?php
}

if(empty($id_url)) {
    ?>
    <div class="p-3 w-full">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/id_libradores=<?php echo $id_url; ?>/tipo=<?php echo $tipo_libradores_url; ?>" class="botones-apartados" title="<?php echo $definicion_tipo_librador; ?>">
            Datos básicos
        </a>
    </div>
    <?php
}else {
    ?>
    <div class="w-full flex flex-wrap bg-gray-70 dark:bg-blendi-35">
        <div class="p-3 <?php echo (empty($apartado_url))? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="<?php echo $definicion_tipo_librador; ?>" onclick="cambiarApartadoFicha('')">
                Datos básicos
            </a>
        </div>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'direccion')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos dirección" onclick="cambiarApartadoFicha('direccion')">
                Dirección
            </a>
        </div>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'contacto')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos contacto" onclick="cambiarApartadoFicha('contacto')">
                Contacto
            </a>
        </div>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'banco')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos banco" onclick="cambiarApartadoFicha('banco')">
                Banco
            </a>
        </div>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'otros')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos otros" onclick="cambiarApartadoFicha('otros')">
                Otros
            </a>
        </div>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'costes')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos costes" onclick="cambiarApartadoFicha('costes')">
                Costes
            </a>
        </div>
    </div>
    <?php
}
?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_libradores" id="id_libradores" value="<?php echo $id_url; ?>" />
    <input type="hidden" name="tipo" id="tipo" value="<?php echo (empty($tipo_librador_libradores))? $tipo_libradores_url : $tipo_librador_libradores; ?>" />
    <div class="capa_form_datos p-3">
        <?php
        if(!isset($apartado_url) OR $apartado_url == "null") {
            require("pantalla-ficha-basicos.php");
        }elseif($apartado_url == "direccion") {
            require("pantalla-ficha-direccion.php");
        }elseif($apartado_url == "contacto") {
            require("pantalla-ficha-contacto.php");
        }elseif($apartado_url == "banco") {
            require("pantalla-ficha-banco.php");
        }elseif($apartado_url == "otros") {
            require("pantalla-ficha-otros.php");
        }elseif($apartado_url == "costes") {
            require("pantalla-ficha-costes.php");
        }
        ?>
    </div>
</form>
