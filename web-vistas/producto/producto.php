<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$anadidoModal = '';
if (isset($extraNombreFormularioProducto)) {
    $anadidoModal = $extraNombreFormularioProducto;
}
if (!isset($hiddenPorModalEnProductoCombo)) {
    $hiddenPorModalEnProductoCombo = '';
}

$tipo_producto_backup = $tipo_producto_sys;
if(!empty($id_producto_sys)) {
    ?>
    <div id="grid-ficha-producto" class="bg-blendimodal-background">
        <div id="capaCentral-producto<?php echo $anadidoModal; ?>">
            <form id="<?php echo 'formulario_producto' . $anadidoModal; ?>" method="post">

                <?php
                $cantidad_producto = 1;
                $orden_producto = "";
                $lote_recuperado = '';
                $caducidad_recuperado = '';
                $numero_serie_recuperado = '';
                $descuento_recuperado = 0;
                $slug = $path_components[$indice_componente] . '/' . $path_components[$indice_componente + 1];
                if ($id_linea) {
                    $select_sys = "producto_recuperado";
                    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");

                    $slug = $slug_recuperado;
                }
                $select_sys = "productos-relacionados-grupos";
                require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
                ?>

                <input type="hidden" name="descuento_pp" id="descuento_pp_librador<?php echo $anadidoModal; ?>" value="<?php echo $descuento_pp; ?>" />
                <input type="hidden" name="descuento_librador" id="descuento_librador_librador<?php echo $anadidoModal; ?>" value="<?php echo $descuento_librador; ?>" />
                <input type="hidden" name="iva_librador" id="iva_librador<?php echo $anadidoModal; ?>" value="<?php echo $iva_librador; ?>" />
                <input type="hidden" name="recargo" id="recargo<?php echo $anadidoModal; ?>" value="<?php echo $recargo; ?>" />
                <input type="hidden" name="recargo_librador" id="recargo_librador<?php echo $anadidoModal; ?>" value="<?php echo $recargo_librador; ?>" />
                <input type="hidden" name="irpf_librador" id="irpf_librador<?php echo $anadidoModal; ?>" value="<?php echo $id_irpf_librador; ?>" />

                <input type="hidden" name="slug" id="slug_producto<?php echo $anadidoModal; ?>" value="<?php echo $slug; ?>" />
                <input type="hidden" name="id_linea" id="id_linea<?php echo $anadidoModal; ?>" value="<?php echo $id_linea; ?>" />

                <input type="hidden" name="id_producto" id="id_producto<?php echo $anadidoModal; ?>" value="<?php echo $id_producto_sys; ?>" />
                <?php
                $fecha_actual = date("d-m-Y");
                $meses["01"] = "Enero";
                $meses["02"] = "Febrero";
                $meses["03"] = "Marzo";
                $meses["04"] = "Abril";
                $meses["05"] = "Mayo";
                $meses["06"] = "Junio";
                $meses["07"] = "Julio";
                $meses["08"] = "Agosto";
                $meses["09"] = "Septiembre";
                $meses["10"] = "Octubre";
                $meses["11"] = "Noviembre";
                $meses["12"] = "Diciembre";

                $productos = 0;
                if($tipo_producto_sys == 0) { // normal
                    require("producto-normal.php");
                    echo require("producto-normal-footer.php");
                }else if($tipo_producto_sys == 1) { // elaborado
                    require("producto-normal.php");
                    echo require("producto-normal-footer.php");
                }else if($tipo_producto_sys == 2) { // compuesto
                    require("producto-compuesto.php");
                }else if($tipo_producto_sys == 3 OR $tipo_producto_sys == 4) { // combo manual o combo automático
                    require("producto-combo.php");
                }

                unset($id_productos_relacionados_grupos);
                unset($grupos_productos_relacionados_grupos);

                if($plazo_entrega_productos == false) {
                    ?>
                    <div class="text-center color-red font-bold mt-8p">
                        <?php echo $texto_plazo; ?>
                    </div>
                    <?php
                }
                if($pvp_iva_incluido == "0") {
                    ?>
                    <div class="grid-1 text-center">
                        <div class="row">
                            Precios con IVA no incluido.
                        </div>
                    </div>
                    <hr />
                    <?php
                }
                if (isset($modificar_linea) && $modificar_linea != '') {
                    if ($tipo_producto_sys_original != 3 && $tipo_producto_sys_original != 4) {
                        ?>
                        <script type="text/javascript">
                            comprarProducto('0','insertar-producto','0','0','0', '<?php echo $anadidoModal; ?>');
                        </script>
                        <?php
                    }
                }
                ?>
            </form>
        </div>
        <?php
        if($interface == "web") {
            ?>
            <div style="clear: both;">
                <a href="javascript:void(0)" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u='+encodeURIComponent('<?php echo $host_idioma; ?>fundas/album-para-discos-12-lp/')); insertRedes('0','5','20','341','facebook');">
                    <img src="<?php echo $host; ?>images/facebook.png" style="width: 35px;" />
                </a>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}else {
    echo "No se ha encontrado el producto";
}
if(isset($conn)) {
    unset($conn);
}
if (!isset($comprarConFormularioPorAjax)) {
    require("producto-volver.php");
}
