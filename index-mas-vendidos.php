<form id="formulario_producto" class="m-0">
    <input type="hidden" name="descuento_pp" id="descuento_pp_librador" value="<?php echo $descuento_pp; ?>">
    <input type="hidden" name="descuento_librador" id="descuento_librador_librador" value="<?php echo $descuento_librador; ?>">
    <input type="hidden" name="iva_librador" id="iva_librador" value="<?php echo $iva_librador; ?>">
    <input type="hidden" name="recargo" id="recargo" value="0">
    <input type="hidden" name="recargo_librador" id="recargo_librador" value="0">
    <input type="hidden" name="irpf_librador" id="irpf_librador" value="<?php echo $id_irpf_librador; ?>">
    <input type="hidden" name="slug" id="slug_producto" value=""> <!-- porc-iberic/canal-extra-llom-cebo -->
    <input type="hidden" name="id_linea" id="id_linea" value="">
    <input type="hidden" name="id_producto" id="id_producto" value=""> <!-- 542 -->
    <input type="hidden" name="descripcion_producto_0" id="descripcion_producto_0" value=""> <!-- CANAL EXTRA LLOM CEBO -->
    <input type="hidden" name="tipo_producto_0" id="tipo_producto_0" value="0">
    <input type="hidden" name="imagen_producto_0" id="imagen_producto_0" value="">
    <input type="hidden" name="updated_producto_0" id="updated_producto_0" value="000000000000">
    <input type="hidden" name="alt_producto_0" id="alt_producto_0" value=""> <!-- CANAL EXTRA LLOM CEBO -->
    <input type="hidden" name="tittle_producto_0" id="tittle_producto_0" value=""> <!-- CANAL EXTRA LLOM CEBO -->
    <input type="hidden" name="id_iva_producto_0" id="id_iva_producto_0" value="">
    <input type="hidden" name="iva_producto_0" id="iva_producto_0" value=""> <!-- 21.00 -->
    <input type="hidden" name="recargo_producto_0" id="recargo_producto_0" value="0">
    <input type="hidden" name="packs_disponibles_0" id="packs_disponibles_0" value="">
    <input type="hidden" name="fecha_entrega_desde_0" id="fecha_entrega_desde_0" value="">
    <input type="hidden" name="fecha_entrega_hasta_0" id="fecha_entrega_hasta_0" value="">
    <input type="hidden" name="descripcion_atributos_producto_0" id="descripcion_atributos_producto_0" value="">
    <input type="hidden" name="descripcion_oferta_0" id="descripcion_oferta_0" value="">
    <input type="hidden" name="pvp_base_0" id="pvp_base_0" value=""> <!-- 4.46 -->
    <input type="hidden" name="pvp_linea_0" id="pvp_linea_0" value=""> <!-- 4.46 -->
    <input type="hidden" name="incremento_linea_0" id="incremento_linea_0" value="0.00">
    <input type="hidden" name="id_productos_sku_0" id="id_productos_sku_0" value="0">
    <input type="hidden" name="codigo_barras_producto_0" id="codigo_barras_producto_0" value="">
    <input type="hidden" name="referencia_producto_0" id="referencia_producto_0" value="">
    <input type="hidden" name="coste_producto_0" id="coste_producto_0" value=""> <!-- 1.75 -->
    <input type="hidden" name="lote_producto_0" id="lote_producto_0" value="">
    <input type="hidden" name="numero_serie_producto_0" id="numero_serie_producto_0" value="">
    <input type="hidden" name="caducidad_producto_0" id="caducidad_producto_0" value="">
    <input type="hidden" name="disponibilidad_producto_0" id="disponibilidad_producto_0" value="1">
    <input type="hidden" name="peso_producto_0" id="peso_producto_0" value="0.00000">
    <input type="hidden" name="envio_gratis_producto_0" id="envio_gratis_producto_0" value="0">
    <input type="hidden" name="cantidad_incremento_0" id="cantidad_incremento_0" value="1">
    <input type="hidden" name="sumar_incremento_0" id="sumar_incremento_0" value="0">
    <input type="hidden" name="cantidad_0" id="cantidad_0" value="1">
    <input type="hidden" name="precio" id="pvp_span_combo_0" value="0">
    <input type="hidden" name="orden" id="orden" value="">
    <input type="hidden" name="pvp_total_0" id="pvp_total_0" value="0" />
    <input type="hidden" name="observacion_0" id="nota_producto_0">
</form>
<?php
if (!isset($conn)) {
    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");
}
$select_sys = "productos-mas-vendidos";
require("web-gestion/datos-productos.php");
unset($conn);
if($productos_total == 0) {
    require('web-vistas/modal/functions.php');
    view('web-vistas/modal/layout/start.modal.php');
    view('web-vistas/modal/carta/empty_state.modal.php', ['title' => 'Parece que aun no se ha creado ninguna categoría ni producto...!', 'description' => 'Haz click en el botón categorías para empezar a definirlas!', 'button' => 'Categorías', 'url' => $protocol . $_SERVER['HTTP_HOST'].'/admin/gestion-categorias']);
    view('web-vistas/modal/layout/end.modal.php');
}
?>
<div id="capa-grid-productos" class="grid grid-cols-1 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 overflow-y-auto">
    <?php

    if($interface == "tpv") {
        require("productos-ficha-clasica.php");
    }else {
        if($tipo_fichas_productos == "clasica") {
            require("productos-ficha-clasica.php");
        }else if($tipo_fichas_productos == "flotante") {
            require("productos-ficha-flotante.php");
        }
    }
    ?>
</div>
<?php
if (isset($id_producto_mostrar)) {
    unset($id_producto_mostrar);
    unset($descripcion);
    unset($imagen);
    unset($updated);
    unset($alt);
    unset($tittle);
}
if (isset($url_externa)) {
    unset($url_externa);
    unset($descripcion_categoria_producto);
    unset($disponibilidad);
    unset($profesionales);
    unset($envio_gratis);
}
if (isset($packs_disponibles_mostrar)) {
    unset($packs_disponibles_mostrar);
}
if (isset($pvp)) {
    unset($pvp);
    unset($id_ofertas);
    unset($oferta_desde);
    unset($oferta_hasta);
    unset($pvp_oferta);
    unset($descripcion_ofertas);
}
if (isset($descripcion_larga)) {
    unset($descripcion_larga);
    unset($descripcion_url_mostrar);
}