<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

foreach ($id_producto_mostrar as $key => $valor) {
    $etiqueta_pvp = "PVP";
    if($pvp_iva_incluido == "0" && ($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del")) {
        $etiqueta_pvp = "Precio";
        $pvp[$key] = $pvp[$key] / (1 + ($iva[$key] / 100));
        $pvp_oferta[$key] = $pvp_oferta[$key] / (1 + ($iva[$key] / 100));
    }
    if ($tipo_librador == "tak" || $tipo_librador == "del") {
        $select_sys = "productos-embalajes";
        $id_producto_sys = $valor;
        require($_SERVER['DOCUMENT_ROOT'] . "/web-gestion/datos-productos.php");
        foreach ($id_productos_embalajes as $key_id_productos_embalajes => $valor_id_productos_embalajes) {
            if ($sumar_productos_embalajes[$key_id_productos_embalajes]) {
                $totalEmbalajes = $cantidad_productos_embalajes[$key_id_productos_embalajes] * $pvp_productos_embalajes[$key_id_productos_embalajes];
                $pvp[$key] += $totalEmbalajes;
                $pvp_oferta[$key] += $totalEmbalajes;
            }
        }
        unset($id_productos_embalajes);
        unset($id_producto_relacionado_productos_embalajes);
        unset($cantidad_productos_embalajes);
        unset($sumar_productos_embalajes);
        unset($pvp_productos_embalajes);
        unset($id_producto_sys);
    }
    $clase_crad_grid_productos = "box card-grid-productos";
    if(empty($mostrar_precios_tpv)) {
        $clase_crad_grid_productos = "box card-grid-productos-sin-pvp";
    }
    ?>
    <div class="<?php echo $clase_crad_grid_productos; ?> bg-white rounded p-2 mx-1 mb-2 overflow-y-hidden font-bold text-sm drop-shadow-md">
        <?php
        $selected_option_group = -1;
        foreach ($categorias['descripcion'] as $key_productos_select => $valor_productos_select) {
            if ($valor_productos_select == $descripcion_categoria) {
                $selected_option_group = $categorias['id_grupo'][$key_productos_select];
                break;
            }
        }
        $pvpAComprar = null;
        if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
            if(!empty($descripcion_ofertas[$key])) {
                $pvpAComprar = $pvp_oferta[$key];
            }else {
                $pvpAComprar = $pvp[$key];
            }
        } else {
            $pvpAComprar = $coste[$key];
        }
        if(!empty($url_externa[$key])) {
            if (($tipo_producto_categorias[$key] == 0 || $tipo_producto_categorias[$key] == 1) && $numero_de_lotes_activos[$key] <= 0 && $tiene_enlazados[$key] <= 0 && $tiene_multiples[$key] <= 0 && $tiene_packs[$key] <= 0) {
                $descripcionAmigable = str_replace(['-', '_'], ' ', $url_externa[$key]);
                $descripcionAmigable = explode(' ', $descripcionAmigable);
                if (is_numeric($descripcionAmigable[count($descripcionAmigable) - 1])) {
                    unset($descripcionAmigable[count($descripcionAmigable) - 1]);
                }
                $descripcionAmigable = join(' ', $descripcionAmigable);
                $ordenToComprarProductoDesdeCategoria = is_array($id_productos_relacionados_grupos) ? $grupos_productos_relacionados_grupos[array_search($selected_option_group, $id_productos_relacionados_grupos)] : '';
                ?>
                <a href="#" onclick='comprarProductoDesdeCategoria(
                    <?php echo $id_producto_mostrar[$key]; ?>,
                    "<?php echo $descripcion_categoria_producto[$key]."/".$url_externa[$key]; ?>",
                    "<?php echo $descripcionAmigable; ?>",
                    "<?php echo (isset($iva[$key]))? $iva[$key] : ''; ?>",
                    "<?php echo (isset($recargo_sys[$key]) && $recargo)? $recargo_sys[$key] : ''; ?>",
                    "<?php echo $pvpAComprar; ?>",
                    "<?php echo $coste[$key]; ?>",
                    "<?php echo $ordenToComprarProductoDesdeCategoria; ?>",
                    "<?php echo $tipo_producto_categorias[$key]; ?>",
                    ""
                )' target="_self">
                <?php
            } else if ($tipo_producto_categorias[$key] == 3 || $tipo_producto_categorias[$key] == 4) {
                ?>
                <!-- <?php echo $host_url.$descripcion_categoria_producto[$key]."/".$url_externa[$key]; ?> -->
                <a href="#" onclick="cargarProducto('<?php echo $descripcion_categoria_producto[$key]."/".$url_externa[$key]; ?>')" target="_self">
                <?php
            } else {
                ?>
                <a href="#" target="_self" onclick="document.getElementById('botonOpenModalProducto').click(); detallesProductoModal('<?php echo addslashes($descripcion[$key]); ?>', '<?php echo $id_producto_mostrar[$key];?>', '', '<?php echo $tipo_producto_categorias[$key];?>', -1, false, '', '')">
                <?php
            }
        }else {
            if (($tipo_producto_categorias[$key] == 0 || $tipo_producto_categorias[$key] == 1) && $numero_de_lotes_activos[$key] <= 0 && $tiene_enlazados[$key] <= 0 && $tiene_multiples[$key] <= 0 && $tiene_packs[$key] <= 0) {
                $descripcionAmigable = str_replace(['-', '_'], ' ', $descripcion_url_mostrar[$key]);
                $descripcionAmigable = explode(' ', $descripcionAmigable);
                if (is_numeric($descripcionAmigable[count($descripcionAmigable) - 1])) {
                    unset($descripcionAmigable[count($descripcionAmigable) - 1]);
                }
                $descripcionAmigable = join(' ', $descripcionAmigable);
                $ordenToComprarProductoDesdeCategoria = is_array($id_productos_relacionados_grupos) ? $grupos_productos_relacionados_grupos[array_search($selected_option_group, $id_productos_relacionados_grupos)] : '';
                ?>
                <a href="#" onclick='comprarProductoDesdeCategoria(
                    <?php echo $id_producto_mostrar[$key]; ?>,
                    "<?php echo $descripcion_categoria_producto[$key]."/".$descripcion_url_mostrar[$key]; ?>",
                    "<?php echo $descripcionAmigable; ?>",
                    "<?php echo (isset($iva[$key]))? $iva[$key] : ''; ?>",
                    "<?php echo (isset($recargo_sys[$key]) && $recargo)? $recargo_sys[$key] : ''; ?>",
                    "<?php echo $pvpAComprar; ?>",
                    "<?php echo $coste[$key]; ?>",
                    "<?php echo $ordenToComprarProductoDesdeCategoria; ?>",
                    "<?php echo $tipo_producto_categorias[$key]; ?>",
                    ""
                )' target="_self">
                <?php
            } else if ($tipo_producto_categorias[$key] == 3 || $tipo_producto_categorias[$key] == 4) {
                ?>
                <!-- <?php echo $host_url.$descripcion_categoria_producto[$key]."/".$descripcion_url_mostrar[$key]; ?> -->
                <a href="#" onclick="cargarProducto('<?php echo $descripcion_categoria_producto[$key]."/".$descripcion_url_mostrar[$key]; ?>')" target="_self">
                <?php
            } else {
                ?>
                <a href="#" target="_self" onclick="document.getElementById('botonOpenModalProducto').click(); detallesProductoModal('<?php echo addslashes($descripcion[$key]); ?>' , '<?php echo $id_producto_mostrar[$key];?>', '', '<?php echo $tipo_producto_categorias[$key];?>', -1, false, '', '')">
                <?php
            }
        }
        ?>
        <div class="flex items-center card-producto">
            <?php
            $mostrar_imagen = false;
            if(!empty($imagen[$key])) {
                $mostrar_imagen = true;
                $file_headers = @get_headers($imagen[$key]);
                if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    $mostrar_imagen = false;
                }
            }
            if($mostrar_imagen == false) {
                if($interface == "tpv") {
                    ?>
                    <div class="card-body h-75 vertical-center-div overflow-x-auto grow w-full">
                        <div class="card-text card-inicio-titulo">
                            <?php
                            echo $descripcion[$key];
                            ?>
                        </div>
                        <?php
                        require("productos-card-price.php");
                        ?>
                    </div>
                    <?php
                }else {
                    ?>
                    <div class="card-header h-20 overflow-x-auto grow w-full">
                        <div class="card-text card-inicio-titulo">
                            <?php echo $descripcion[$key]; ?>
                        </div>
                    </div>
                    <div class="card-body h-52 overflow-x-auto grow w-full">
                        <div class="text-productos h-60">
                            <?php
                            echo $descripcion_larga[$key];
                            ?>
                        </div>
                        <?php
                        require("web-vistas/producto/productos-card-body.php");
                        require("productos-card-price.php");
                        ?>
                    </div>
                    <?php
                }
            }else {
                if(empty($alt[$key])) {
                    $alt[$key] = $descripcion[$key];
                }
                if(empty($tittle[$key])) {
                    $tittle[$key] = $descripcion[$key];
                }
                if(substr($imagen[$key],0,4) == "http") {
                    $ruta_imagen = $imagen[$key]."?ver=".$updated[$key];
                }else {
                    $ruta_imagen = "/images/productos/" . $id_panel . "/" . $imagen[$key]."?ver=".$updated[$key];
                }
                if($interface == "tpv") {
                    ?>
                    <div class="card-header">
                        <img src="<?php echo $ruta_imagen; ?>" class="img-productos"
                             alt="<?php echo $alt[$key]; ?>"
                             title="<?php echo $tittle[$key]; ?>">
                    </div>
                    <div class="card-body md:overflow-x-auto grow pl-1">
                        <div class="card-text card-inicio-titulo">
                            <?php echo $descripcion[$key]; ?>
                        </div>
                        <?php
                        require("productos-card-price.php");
                        ?>
                    </div>
                    <?php
                }else {
                    ?>
                    <div class="card-header">
                        <img src="<?php echo $ruta_imagen; ?>" class="img-productos"
                             alt="<?php echo $alt[$key]; ?>"
                             title="<?php echo $tittle[$key]; ?>">
                    </div>
                    <div class="card-body md:overflow-x-auto grow pl-1">
                        <div class="card-text card-inicio-titulo h-40">
                            <?php echo $descripcion[$key]; ?>
                        </div>
                        <?php
                        require("web-vistas/producto/productos-card-body.php");
                        require("productos-card-price.php");
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </a>
    </div>
    <?php
}
unset($conn);