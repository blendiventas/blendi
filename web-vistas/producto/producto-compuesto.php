<?php

if(isset($descripcion_atributos_unicos_producto_sys)) {
    foreach ($descripcion_atributos_unicos_producto_sys as $key_atributos_unicos => $valor_atributos_unicos) {
        ?>
        <div class="grid-1 display-block">
            <?php echo $valor_atributos_unicos; ?>
        </div>
        <?php
    }
}

require("producto-normal.php");
$outputProductoNormalFooter = require("producto-normal-footer.php");
$contador_elementos = 0;
foreach ($disponibilidad_producto_sys as $key => $valor) {
    $id_grupo_relacionado_sys = 0;
    $id_producto_relacionado_sys = $id_producto_sys;
    $id_enlazados_producto_relacionado_sys = $id_enlazados_producto_sys[$key];
    $id_multiples_producto_relacionado_sys = $id_multiples_producto_sys[$key];
    $id_packs_producto_relacionado_sys = $id_packs_producto_sys[$key];
    $select_sys = "productos-relacionados";
    $id_linea_sys = (isset($id_linea))? $id_linea : null;
    require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-productos.php");
    ?>
    <div class="flex flex-wrap text-xs">
        <?php
        $modelo_relacionado_anterior = (isset($modelo_producto_relacionado[0]))? $modelo_producto_relacionado[0] : 0;
        foreach ($id_producto_relacionado as $key_producto_relacionado => $valor_producto_relacionado) {
            $id_producto_sys = $id_relacionado_producto_relacionado[$key_producto_relacionado];
            $select_sys = "producto";
            require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-productos.php");

            $packs_disponibles_sys = $packs_disponibles;

            $descripcion_producto_sys = $descripcion_producto;
            $tipo_producto_sys = $tipo_producto;
            $imagen_producto_sys = $imagen_producto;
            $updated_producto_sys = $updated_producto;
            $alt_producto_sys = $alt_producto;
            $tittle_producto_sys = $tittle_producto;
            $iva_producto_sys = $iva_producto;
            $recargo_producto_sys = $recargo_producto;
            foreach ($id_unidades as $key_id_unidades => $valor_id_unidades) {
                $unidad_producto_sys[] = $unidad_producto[$key_id_unidades];
                $unidad_principal_producto_sys[] = $unidad_principal_producto[$key_id_unidades];
                $conversion_unidad_producto_sys[] = $conversion_unidad_producto[$key_id_unidades];
            }
            foreach ($descripcion_atributos_unicos_producto as $key_descripcion_atributos_unicos_producto => $valor_descripcion_atributos_unicos_producto) {
                $descripcion_atributos_unicos_producto_sys[] = $valor_descripcion_atributos_unicos_producto;
            }
            $contador = 0;
            foreach ($disponibilidad_producto as $key_disponibilidad_producto => $valor_disponibilidad_producto) {
                $id_enlazados_producto_sys[$contador] = $id_enlazados_producto[$key_disponibilidad_producto];
                $id_multiples_producto_sys[$contador] = $id_multiples_producto[$key_disponibilidad_producto];
                $id_packs_producto_sys[$contador] = $id_packs_producto[$key_disponibilidad_producto];
                if (isset($descripcion_atributos_producto[$key_disponibilidad_producto])) {
                    $descripcion_atributos_producto_sys[$contador] = $descripcion_atributos_producto[$key_disponibilidad_producto];
                }
                if (isset($cantidad_packs_producto[$key_disponibilidad_producto])) {
                    $cantidad_packs_producto_sys[$contador] = $cantidad_packs_producto[$key_disponibilidad_producto];
                }
                $control_stock_producto_sys[$contador] = $control_stock_producto[$key_disponibilidad_producto];
                $disponibilidad_producto_sys[$contador] = $disponibilidad_producto[$key_disponibilidad_producto];
                $profesionales_producto_sys[$contador] = $profesionales_producto[$key_disponibilidad_producto];
                $peso_producto_sys[$contador] = $peso_producto[$key_disponibilidad_producto];
                $bultos_producto_sys[$contador] = $bultos_producto[$key_disponibilidad_producto];
                $gastos_producto_sys[$contador] = $gastos_producto[$key_disponibilidad_producto];
                $envio_gratis_producto_sys[$contador] = $envio_gratis_producto[$key_disponibilidad_producto];
                $dias_entrega_producto_sys[$contador] = $dias_entrega_producto[$key_disponibilidad_producto];
                $aplicar_descuento_producto_sys[$contador] = $aplicar_descuento_producto[$key_disponibilidad_producto];
                $descuento_maximo_producto_sys[$contador] = $descuento_maximo_producto[$key_disponibilidad_producto];
                foreach ($id_productos_sku_sys[$key_disponibilidad_producto] as $key_sku => $valor_sku) {
                    $id_productos_sku_sys[$contador][] = $id_productos_sku[$key_disponibilidad_producto];
                    $codigo_barras_producto_sys[$contador][] = $codigo_barras_producto[$key_disponibilidad_producto];
                    $referencia_producto_sys[$contador][] = $referencia_producto[$key_disponibilidad_producto];
                    $lote_producto_sys[$contador][] = $lote_producto[$key_disponibilidad_producto];
                    $caducidad_producto_sys[$contador][] = $caducidad_producto[$key_disponibilidad_producto];
                    $numero_serie_producto_sys[$contador][] = $numero_serie_producto[$key_disponibilidad_producto];
                    $stock_producto_sys[$contador][] = $stock_producto[$key_disponibilidad_producto];
                }
                $pvp_producto_sys[$contador] = $pvp_producto[$key_disponibilidad_producto];
                if (isset($id_ofertas_producto[$key_disponibilidad_producto])) {
                    $id_ofertas_producto_sys[$contador] = $id_ofertas_producto[$key_disponibilidad_producto];
                    $oferta_desde_producto_sys[$contador] = $oferta_desde_producto[$key_disponibilidad_producto];
                    $oferta_hasta_producto_sys[$contador] = $oferta_hasta_producto[$key_disponibilidad_producto];
                    $pvp_oferta_producto_sys[$contador] = $pvp_oferta_producto[$key_disponibilidad_producto];
                    $descripcion_ofertas_producto_sys[$contador] = $descripcion_ofertas_producto[$key_disponibilidad_producto];
                }
                if (isset($images_producto[$key_disponibilidad_producto])) {
                    $images_producto_sys[$contador] = $images_producto[$key_disponibilidad_producto];
                    $images_updated_producto_sys[$contador] = $images_updated_producto[$key_disponibilidad_producto];
                    $images_alt_producto_sys[$contador] = $images_alt_producto[$key_disponibilidad_producto];
                    $images_tittle_producto_sys[$contador] = $images_tittle_producto[$key_disponibilidad_producto];
                }
                if (isset($images_producto[$key_disponibilidad_producto])) {
                    $observaciones_producto_sys[$contador] = $observaciones_producto[$key_disponibilidad_producto];
                }
                $contador += 1;
            }
            unset($id_producto);
            unset($descripcion_producto);
            unset($tipo_producto);
            unset($imagen_producto);
            unset($updated_producto);
            unset($alt_producto);
            unset($tittle_producto);
            unset($id_unidades);
            unset($id_unidad_productos);
            unset($unidad_producto);
            unset($unidad_principal_producto);
            unset($conversion_unidad_producto);
            unset($iva_producto);
            unset($recargo_producto);
            unset($descripcion_atributos_unicos_producto);
            unset($packs_disponibles);
            unset($cantidad_packs_producto);
            unset($descripcion_atributos_producto);
            unset($id_enlazados_producto);
            unset($id_multiples_producto);
            unset($id_packs_producto);
            unset($control_stock_producto);
            unset($disponibilidad_producto);
            unset($profesionales_producto);
            unset($peso_producto);
            unset($bultos_producto);
            unset($gastos_producto);
            unset($envio_gratis_producto);
            unset($dias_entrega_producto);
            unset($aplicar_descuento_producto);
            unset($descuento_maximo_producto);
            unset($id_productos_sku);
            unset($codigo_barras_producto);
            unset($referencia_producto);
            unset($lote_producto);
            unset($caducidad_producto);
            unset($numero_serie_producto);
            unset($stock_producto);
            unset($pvp_producto);
            unset($id_ofertas_producto);
            unset($oferta_desde_producto);
            unset($oferta_hasta_producto);
            unset($pvp_oferta_producto);
            unset($descripcion_ofertas_producto);
            unset($images_producto);
            unset($images_updated_producto);
            unset($images_alt_producto);
            unset($images_tittle_producto);
            unset($observaciones_producto);

            require("productos-relacionados.php");
        }
        ?>
    </div>
    <script type="application/javascript">
        (function() {
            checkUniqueEmpty('<?php if (empty($key_id_enlazados_producto_sys)) {
                echo '0';
            } else {
                echo $key_id_enlazados_producto_sys;
            } ?>opcionRelacionadaTipo3Input');
            modificarCantidades('<?php echo $contador_elementos; ?>', '<?php echo $anadidoModal; ?>', true);
        })();
    </script>
    <?php
    $contador_elementos += 1;
}
?>
<div class="px-4 mt-4" id="capa-nota-linea">
    <div class="text-left font-bold text-sm">
        Notas
    </div>
    <textarea class="w-full mt-2 border-gray-250 rounded" name="nota_linea" id="nota_linea<?php echo $anadidoModal; ?>" placeholder="Añadir anotación"><?php echo (isset($nota_linea_producto))? $nota_linea_producto : ''; ?></textarea>
</div>
<?php

echo $outputProductoNormalFooter;
