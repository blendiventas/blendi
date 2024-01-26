<?php
$parametros_volver = "";
if(isset($id_tipo_productos_relacionados)) {
    $parametros_volver = "/tipo_producto=".$id_tipo_productos_relacionados;
}

$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/datos_empresa/gestion/datos-select-php.php");

$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");

$result_configuracion = $conn->query("SELECT pvp_iva_incluido FROM configuracion");
$pvp_iva_incluido = 0;
if ($conn->registros() >= 1) {
    $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
}

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de producto <span class="font-medium"><?php echo $descripcion_productos; ?></span>');
        setRutaSys('productos');
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
        if($tipo_producto_productos != 3 && $tipo_producto_productos != 4) {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'personalizacion')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Personalización" onclick="cambiarApartadoFicha('personalizacion')">
                    Personalización
                </a>
            </div>
            <?php
        }
        if($sector != "restauracion") {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'unidades')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Unidades" onclick="cambiarApartadoFicha('unidades')">
                    Unidades
                </a>
            </div>
            <?php
        }
        if($tipo_producto_productos != 3 && $tipo_producto_productos != 4) {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'composicion')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Composición" onclick="cambiarApartadoFicha('composicion')">
                    Composición
                </a>
            </div>
            <?php
        }
        if($tipo_producto_productos == 3 || $tipo_producto_productos == 4) {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'menu')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Menú" onclick="cambiarApartadoFicha('menu')">
                    Menú
                </a>
            </div>
            <?php
        }
        if($tipo_producto_productos == 1) {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'elaboracion')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Elaboración" onclick="cambiarApartadoFicha('elaboracion')">
                    Elaboración
                </a>
            </div>
            <?php
        }
        ?>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'complementarios')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Embalajes" onclick="cambiarApartadoFicha('complementarios')">
                Embalajes
            </a>
        </div>
        <?php
        if($producto_venta_productos == 1) {
            ?>
            <!--<div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'propiedades')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Atributos" onclick="cambiarApartadoFicha('propiedades')">
                    Atributos
                </a>
            </div>-->
            <?php
            if($sector != "restauracion") {
                ?>
                <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'packs')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                    <a href="#" title="Packs" onclick="cambiarApartadoFicha('packs')">
                        Packs
                    </a>
                </div>
                <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'pvp')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                    <a href="#" title="PVP" onclick="cambiarApartadoFicha('pvp')">
                        <?php
                        if($pvp_iva_incluido == 0) {
                            ?>
                            Importe
                            <?php
                        } else {
                            ?>
                            PVP
                            <?php
                        }
                        ?>
                    </a>
                </div>
                <?php
            }
        }
        ?>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'referencias')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Referencias" onclick="cambiarApartadoFicha('referencias')">
                Referencias
            </a>
        </div>
        <?php
        if($producto_venta_productos == 1) {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'imagen')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Imagen" onclick="cambiarApartadoFicha('imagen')">
                    Imagen
                </a>
            </div>
            <?php
            if($sector != "restauracion") {
                ?>
                <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'web')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                    <a href="#" title="Web" onclick="cambiarApartadoFicha('web')">
                        Web
                    </a>
                </div>
                <?php
            }
        }
        if($sector != "restauracion") {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'proveedores')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Proveedores" onclick="cambiarApartadoFicha('proveedores')">
                    Proveedores
                </a>
            </div>
            <?php
        }
        ?>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'costes')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Costes" onclick="cambiarApartadoFicha('costes')">
                Costes
            </a>
        </div>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'stock')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Stock" onclick="cambiarApartadoFicha('stock')">
                Stock
            </a>
        </div>
        <?php
        if($sector != "restauracion") {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'trazabilidad')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Otros" onclick="cambiarApartadoFicha('trazabilidad')">
                    Trazabilidad
                </a>
            </div>
            <?php
        }
        ?>
        <?php
        if($sector != "restauracion") {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'otros')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Otros" onclick="cambiarApartadoFicha('otros')">
                    Otros
                </a>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
<form class="formulario" id="form_datos_post" name="form_datos_post" method="post" onsubmit="return false;">
    <input type="hidden" name="id_productos" id="id_productos" value="<?php echo $id_url; ?>" />
    <div class="capa_datos_productos capa_form_datos p-3">
        <?php
        if(!isset($apartado_url) OR $apartado_url == "null") {
            require("pantalla-ficha-basicos.php");
        }elseif($apartado_url == "menu") {
            require("pantalla-ficha-menu.php");
        }elseif($apartado_url == "personalizacion") {
            require("pantalla-ficha-personalizacion.php");
        }elseif($apartado_url == "unidades") {
            require("pantalla-ficha-unidades.php");
        }elseif($apartado_url == "composicion") {
            require("pantalla-ficha-composicion.php");
        }elseif($apartado_url == "elaboracion") {
            require("pantalla-ficha-elaboracion.php");
        }elseif($apartado_url == "complementarios") {
            require("pantalla-ficha-complementarios.php");
        }elseif($apartado_url == "elaborado") {
            require("pantalla-ficha-elaborado.php");
        }elseif($apartado_url == "compuesto") {
            require("pantalla-ficha-compuesto.php");
        }elseif($apartado_url == "combo") {
            require("pantalla-ficha-combo.php");
        }elseif($apartado_url == "propiedades") {
            require("pantalla-ficha-propiedades.php");
        }elseif($apartado_url == "packs") {
            require("pantalla-ficha-packs.php");
        }elseif($apartado_url == "pvp") {
            require("pantalla-ficha-pvp.php");
        }elseif($apartado_url == "referencias") {
            require("pantalla-ficha-referencias.php");
        }elseif ($apartado_url == "imagen") {
            require("pantalla-ficha-imagen.php");
        }elseif ($apartado_url == "web") {
            require("pantalla-ficha-web.php");
        }elseif ($apartado_url== "proveedores") {
            require("pantalla-ficha-proveedores.php");
        }elseif ($apartado_url== "costes") {
            require("pantalla-ficha-costes.php");
        }elseif ($apartado_url == "stock") {
            require("pantalla-ficha-stock.php");
        }elseif ($apartado_url == "trazabilidad") {
            require("pantalla-ficha-trazabilidad.php");
        }elseif ($apartado_url == "otros") {
            require("pantalla-ficha-otros.php");
        }
        ?>
    </div>
</form>
