<input type="hidden" name="apartado" id="apartado" value="null" />
<input type="hidden" name="id_idioma_productos" id="id_idioma_productos" value="<?php echo $id_idioma_productos; ?>" />
<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <div>
        <label for="descripcion_productos">Descripción:</label><br>
        <input type="text" name="descripcion_productos" id="descripcion_productos" placeholder="Descripción" maxlength="100"  class="w-full" value="<?php echo $descripcion_productos; ?>" required />
    </div>
    <?php
    if (!empty($id_url)) {
        ?>
        <div>
            <input type="hidden" class="w-full" name="descripcion_url_productos" id="descripcion_url_productos" placeholder="Descripción URL" maxlength="100" value="<?php echo $descripcion_url_productos; ?>" required />
        </div>
        <?php
    }
    ?>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <?php
    $select_sys = "control-stock";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
    ?>
    <input type="hidden" name="control_stock" id="control_stock" value="<?php echo $control_stock; ?>" />
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label>Activo:</label><br>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('activo_1', 'capa_activo_1', 'capa_unicos_activo')" id="capa_activo_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo poin">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_activo_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo">
                    &nbsp;
                </div>
                <div id="check_activo_1" class="hidden check_capa_unicos_activo">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo" id="activo_1" value="1" class="hidden" />
                <?php
                if ($activo == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('activo_1', 'capa_activo_1', "capa_unicos_activo");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('activo_2', 'capa_activo_2', 'capa_unicos_activo')" id="capa_activo_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_activo_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo">
                    &nbsp;
                </div>
                <div id="check_activo_2" class="hidden check_capa_unicos_activo">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo" id="activo_2" value="0" class="hidden" />
                <?php
                if ($activo != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('activo_2', 'capa_activo_2', "capa_unicos_activo");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($id_productos_unidades)) {
    foreach ($id_productos_unidades as $key_productos_unidades => $valor_productos_unidades) {
        if($principal_productos_unidades[$key_productos_unidades] == 1) {
            ?>
            <input type = "hidden" name = "id_productos_unidades" id = "id_productos_unidades" value = "<?php echo $id_productos_unidades[$key_productos_unidades]; ?>" />
            <?php
        }
    }
}else {
    ?>
    <input type = "hidden" name = "id_productos_unidades" id = "id_productos_unidades" value = "0" />
    <?php
}
?>
<input type="hidden" name="tipo_producto_productos" id="tipo_producto_productos"  value="<?php echo $tipo_producto_productos; ?>" />
<input type="hidden" name="producto_venta_productos" id="producto_venta_productos"  value="<?php echo $producto_venta_productos; ?>" />
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div class="col-span-3">
        <?php
        if(empty($id_url)) {
            $producto_venta = '';
            $producto_interno = ' class="hidden"';
        }else {
            if($producto_venta_productos == 1) {
                $producto_venta = '';
                $producto_interno = ' class="hidden"';
            }else {
                $producto_venta = ' class="hidden"';
                $producto_interno = '';
            }
        }
        ?>
        <label>Tipo de producto:</label><br>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('venta_interno_1', 'capa_venta_interno_1', 'capa_unicos_venta_interno'); mostrarVentaInterno();" id="capa_venta_interno_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_venta_interno poin">
                <div class="font-bold text-left mr-2">
                    En venta
                </div>
                <div id="contracheck_venta_interno_1" class="hidden w-6 h-6 contracheck_capa_unicos_venta_interno">
                    &nbsp;
                </div>
                <div id="check_venta_interno_1" class="hidden check_capa_unicos_venta_interno">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="venta_interno" id="venta_interno_1" value="1" class="hidden" />
                <?php
                if ($producto_venta_productos == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('venta_interno_1', 'capa_venta_interno_1', "capa_unicos_venta_interno");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('venta_interno_2', 'capa_venta_interno_2', 'capa_unicos_venta_interno'); mostrarVentaInterno();" id="capa_venta_interno_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_venta_interno">
                <div class="font-bold text-left mr-2">
                    Consumo interno
                </div>
                <div id="contracheck_venta_interno_2" class="hidden w-6 h-6 contracheck_capa_unicos_venta_interno">
                    &nbsp;
                </div>
                <div id="check_venta_interno_2" class="hidden check_capa_unicos_venta_interno">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="venta_interno" id="venta_interno_2" value="0" class="hidden" />
                <?php
                if ($producto_venta_productos != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('venta_interno_2', 'capa_venta_interno_2', "capa_unicos_venta_interno");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- opciones de producto en venta INICIO -->
<div id="capa_producto_venta"<?php echo $producto_venta; ?>>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <?php
            $id_select_sys = "id_iva_productos";
            $id_iva_url = $id_iva_productos;
            require($_SERVER['DOCUMENT_ROOT']."/admin/iva/componentes/form-select.php");
            ?>
        </div>
    </div>
    <?php
    $id_producto_productos_pvp = $id_url;
    $id_productos_detalles_enlazado_productos_pvp = 0;
    $id_productos_detalles_multiples_productos_pvp = 0;
    $id_packs_productos_pvp = 0;
    $contador_elementos = 0;
    $select_sys_pvp = "detalles-ficha-tarifa";
    $mostrar_guardar = false;
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/pvp/componentes/form-input.php");
    ?>
    <div class="mt-3">
        <label>Categoría(s) de producto (puedes seleccionar más de una opción)</label>
    </div>
    <a href="#" class="flex flex-wrap items-center mt-3" onclick="collapseCapa('capa-categorias');">
        <div class="flex flex-wrap items-center p-2 border-2">
            <div>
                Categoría del producto en la TPV
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2" id="capa-categorias-hidden">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2 hidden" id="capa-categorias-show">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
            </svg>
        </div>
    </a>
    <div id="capa-categorias" class="hidden">
        <?php
        $select_sys = "categorias";
        require($_SERVER['DOCUMENT_ROOT']."/admin/categorias/gestion/datos-select-php.php");
        if(isset($matriz_id_categorias)) {
            foreach ($matriz_id_categorias as $key_id_categorias => $valor_id_categorias) {
                foreach ($matriz_id_categoria_productos_categorias as $key_id_categoria_productos_categorias => $valor_id_categoria_productos_categorias) {
                    if ($valor_id_categoria_productos_categorias == 0) {
                        $checked_categoria_sys[0] = " checked";
                        break;
                    }elseif ($valor_id_categorias == $valor_id_categoria_productos_categorias) {
                        $checked_categoria_sys[$valor_id_categorias] = " checked";
                        break;
                    }else {
                        $checked_categoria_sys[$valor_id_categorias] = "";
                    }
                }
                ?>
                <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                    <div class="flex flex-wrap">
                        <input type="checkbox" id="id_categoria_productos_categorias_<?php echo $valor_id_categorias; ?>" name="id_categoria_productos_categorias[<?php echo $valor_id_categorias; ?>]"  class="text-blendi-600" value="<?php echo $valor_id_categorias; ?>"<?php echo $checked_categoria_sys[$valor_id_categorias]; ?>>
                        <div class="ml-2">
                            <?php echo $matriz_descripcion_categorias[$key_id_categorias]; ?>
                        </div>
                    </div>
                    <div class="hidden">
                        <a class="botones-apartados" onclick="collapseCapa('capa-categorias_<?php echo $valor_id_categorias; ?>');">
                            ...
                        </a>
                    </div>
                </div>
                <div id="capa-categorias_<?php echo $valor_id_categorias; ?>" class="hidden grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                    <div>
                        <label for="orden_productos_categorias_<?php echo $valor_id_categorias; ?>">Orden:</label><br>
                        <input type="text" name="orden_productos_categorias[<?php echo $valor_id_categorias; ?>]" id="orden_productos_categorias_<?php echo $valor_id_categorias; ?>" placeholder="Orden" maxlength="20" class="w-full" value="<?php echo $matriz_orden_productos_categorias[$valor_id_categorias]; ?>" />
                    </div>
                    <?php
                    if(!empty($matriz_fecha_alta_productos_categorias[$valor_id_categorias])) {
                        ?>
                        <div>
                            <div>Fecha alta producto:</div>
                            <div><?php echo $matriz_fecha_alta_productos_categorias[$valor_id_categorias]; ?></div>
                        </div>
                        <?php
                    }
                    if(!empty($matriz_fecha_alta_productos_categorias[$valor_id_categorias])) {
                        ?>
                        <div>
                            <div>Fecha modificación producto:</div>
                            <div><?php echo $matriz_fecha_modificacion_productos_categorias[$valor_id_categorias]; ?></div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            unset($matriz_id_categorias);
            unset($matriz_descripcion_categorias);

            unset($id_productos);
            unset($id_idioma_productos);
            unset($descripcion_productos);
            unset($tipo_producto_productos);
            unset($producto_venta_productos);
            unset($id_iva_productos);
            unset($activo);
            unset($matriz_id_categoria_productos_categorias);
            unset($matriz_orden_productos_categorias);
            unset($matriz_fecha_alta_productos_categorias);
            unset($matriz_fecha_modificacion_productos_categorias);
        }else {
            echo "No se han encontrado categorías definidas";
        }
        ?>
    </div>
</div>

<div id="capa_producto_interno"<?php echo $producto_interno; ?>>
    <div class="w-full">
        Producto de consumo interno, no disponible para su venta.
    </div>
</div>
<!-- opciones de producto interno FINAL -->
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3 hidden">
    <div>
        <?php
        // $id_productos_elaborados = 0;
        // $id_categoria_elaborados_productos_elaborados = 0;
        $id_select_sys = "id_categoria_elaborados_productos_elaborados";
        $id_categorias_elaborados_url = $id_categoria_elaborados_productos_elaborados;
        require($_SERVER['DOCUMENT_ROOT']."/admin/categorias_elaborados/componentes/form-select.php");
        ?>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <div>Fecha alta producto:</div>
        <div><?php echo $fecha_alta_productos; ?></div>
    </div>
    <div>
        <div>Fecha última modificación producto:</div>
        <div><?php echo $fecha_modificacion_productos; ?></div>
    </div>
</div>
<script type="text/javascript">
    activarBotonesPorDefectoFicha();
</script>
<?php
unset($fecha_alta_productos);
unset($fecha_modificacion_productos);
