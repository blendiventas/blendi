<?php
if(empty($dato_buscar)) {
    $url_paginador = $path_components[$indice_componente];
    $url_categoria_paginador = $path_components[$indice_componente];
}else {
    $url_paginador = "buscar-productos/".$dato_buscar;
    $url_categoria_paginador = "buscar-productos/".$dato_buscar;
}

?>
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
if($productos_total == 0) {
    require('web-vistas/modal/functions.php');
    view('web-vistas/modal/layout/start.modal.php');
    view('web-vistas/modal/carta/empty_state.modal.php', ['title' => 'Parece que aun no se ha creado ningun producto para esta categoría...!', 'description' => 'Haz click en el botón productos para empezar a definirlos!', 'button' => 'Productos', 'url' => $protocol . $_SERVER['HTTP_HOST'].'/admin/gestion-productos']);
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
if($interface == 'web' && $pvp_iva_incluido == "0") {
    ?>
    <div class="text-center w-full">
        Precios con IVA no incluido.
    </div>
    <?php
}
if($paginas > 1) {
    ?>
    <div class="grid grid-cols-2" id="capa_paginacion-1">
        <div class="capa-botones-pagination-scroll-horizontal hidden" id="capa_pagination_superior">
            <div class="botones-izquierdo-pagination">
                <img class="w-20p bg-white" src="<?php echo $host; ?>icons/System/arrow-left-s-line.svg" alt="<?php echo $familia; ?>" onmousedown="startScroll('capa_pagination_superior','-');" onmouseup="stopScroll();" />
            </div>
            <div class="botones-derecho-pagination">
                <img class="w-20p bg-white" src="<?php echo $host; ?>icons/System/arrow-right-s-line.svg" alt="<?php echo $familia; ?>" onmousedown="startScroll('capa_pagination_superior','+');" onmouseup="stopScroll();" />
            </div>
            <div class="capa-pagination-scroll">
                <?php
                $estilo_boton = " style='color: ".$color_letra_paginacion."; background-color: ".$color_fondo_paginacion.";'";
                ?>
                <a href="<?php echo $host_url.$url_paginador."/pag=".($pagina - 1)."_ord=".$orden_path; ?>" target="_self">
                    <div class="botones-pagination"<?php echo $estilo_boton; ?>>
                        &laquo;
                    </div>
                </a>
                <?php
                for($bucle = 1 ; $bucle <= $paginas ; $bucle++) {
                    $estilo_boton = " style='color: ".$color_letra_paginacion."; background-color: ".$color_fondo_paginacion.";'";
                    if($bucle == $pagina) {
                        $estilo_boton = " style='color: ".$color_fondo_paginacion."; background-color: ".$color_letra_paginacion.";'";
                    }
                    ?>
                    <a href="<?php echo $host_url.$url_paginador."/pag=".$bucle."_ord=".$orden_path; ?>" target="_self">
                        <div class="botones-pagination"<?php echo $estilo_boton; ?>>
                            <?php echo $bucle; ?>
                        </div>
                    </a>
                    <?php
                }
                if($pagina < $paginas) {
                    $estilo_boton = " style='color: ".$color_letra_paginacion."; background-color: ".$color_fondo_paginacion.";'";
                    ?>
                    <a href="<?php echo $host_url.$url_paginador."/pag=".($pagina + 1)."_ord=".$orden_path; ?>" target="_self">
                        <div class="botones-pagination"<?php echo $estilo_boton; ?>>
                            &raquo;
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="box flex hidden">
            <?php
            $posicion_filtro = "superior";
            require("productos_filtros.php");
            ?>
            <div class="box">
                <?php
                if($interface == "tpv" && $id_usuario == 1) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" class="text-decoration-none" style="vertical-align: middle; margin-left: 4px;" title="Abrir ficha" target="_self">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                    <?php
                }
                echo $productos_total . " productos, página " . $pagina . " de " . $paginas . "<br />";
                ?>
            </div>
        </div>
    </div>
    <?php
}else {
    if ($paginas > 0) {
        ?>
        <div class="grid grid-cols-3" id="capa_paginacion-1">
            <div class="text-left col-span-2">&nbsp;</div>
            <div class="text-left hidden">
                <?php echo $productos_total . " productos, página " . $pagina . " de " . $paginas . "<br />"; ?>
            </div>
            <div class="text-center hidden">
                <?php
                $posicion_filtro = "superior";
                require("productos_filtros.php");
                ?>
            </div>
            <div class="text-right">
                <?php
                if($interface == "tpv" && $id_usuario == 1) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" class="text-decoration-none text-blendi-600" style="vertical-align: middle; margin-right: 4px; float:right;" title="Abrir ficha" target="_self">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}
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