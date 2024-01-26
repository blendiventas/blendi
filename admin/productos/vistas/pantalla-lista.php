<div class="grid grid-cols-12 items-center h-10 bg-gray-50 sm:mx-5 mt-3 dark:text-white">
    <div class="text-center hidden sm:block sm:col-span-1 px-3">
        Activo
    </div>
    <div class="px-3 col-span-10 sm:col-span-6">
        Producto
    </div>
    <div class="px-3 hidden sm:block sm:col-span-2">
        Categoría
    </div>
    <div class="px-3 hidden sm:block sm:col-span-2">
        Tipo de producto
    </div>
    <div class="text-center px-3 col-span-1">
        Ficha
    </div>
</div>
<hr />

<?php
$parametros_volver = "";
if(isset($id_tipo_productos_relacionados)) {
    $parametros_volver = "/tipo_producto=".$id_tipo_productos_relacionados;
}

$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");

if(isset($matriz_id_producto_productos)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($matriz_id_producto_productos as $key_productos => $valor_productos) {
            ?>
            <div class="grid grid-cols-12 items-center h-14 bg-white border-2 border-gray-50" id="linea_<?php echo $valor_productos; ?>">
                <div class="text-center hidden sm:block sm:col-span-1 px-3" id="capa_img_activo_<?php echo $valor_productos; ?>">
                    <input type="checkbox" class="block w-7 h-7 mx-auto text-blendi-600" id="habilitar_<?php echo $valor; ?>"
                        <?php echo ($matriz_activo_productos[$key_productos] == 1)? ' checked ' : ''; ?>
                        onmouseover="this.style.cursor='pointer'" onclick="toogleHabilitar('<?php echo $valor_productos; ?>', 'productos');">
                </div>
                <div class="px-3 col-span-10 sm:col-span-6 flex flex-wrap items-center">
                    <?php
                    if(!empty($matriz_imagen_productos[$key_productos])) {
                        if(strpos($matriz_imagen_productos[$key_productos], "www.")) {
                            $url_imagen = $matriz_imagen_productos[$key_productos];
                        }else {
                            $url_imagen = "/images/productos/" . $id_panel_sys . "/" . $matriz_imagen_productos[$key_productos];
                        }
                        ?>
                        <img src="<?php echo $url_imagen."?updated=".$matriz_updated_productos[$key_productos]; ?>" id="img_imagen_<?php echo $valor_productos; ?>" class="w-10 h-10" alt="<?php echo $matriz_descripcion_productos[$key_productos]; ?>" title="<?php echo $matriz_descripcion_productos[$key_productos]; ?>" />
                        <?php
                    }else {
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <?php
                    }
                    ?>
                    <div class="ml-2">
                        <?php
                        if (strlen($matriz_descripcion_productos[$key_productos]) > 50) {
                            echo substr($matriz_descripcion_productos[$key_productos], 0, 21) . '...';
                        } else {
                            echo $matriz_descripcion_productos[$key_productos];
                        }
                        ?>
                    </div>
                </div>
                <div class="px-3 hidden sm:block sm:col-span-2">
                    <?php
                    $categorias_producto = "";
                    foreach ($matriz_id_categoria_productos_categorias[$key_productos] as $key_id_categoria_productos_categorias => $valor_id_categoria_productos_categorias) {
                        if(!empty($categorias_producto)) {
                            $categorias_producto .= " - ";
                        }
                        if ($valor_id_categoria_productos_categorias == 0) {
                            echo "Raiz";
                            $categorias_producto .= "Raiz";
                        } else {
                            $de_sys = $valor_id_categoria_productos_categorias;
                            $select_sys = "categoria-de";
                            require($_SERVER['DOCUMENT_ROOT'] . "/admin/categorias/gestion/datos-select-php.php");
                            $categorias_producto .= $categoria_de_categorias;
                        }
                    }
                    if(empty($categorias_producto)) {
                        $categorias_producto = "Sin categoría";
                    }
                    if (strlen($categorias_producto) > 17) {
                        echo substr($categorias_producto, 0, 17) . '...';
                    } else {
                        echo $categorias_producto;
                    }
                    ?>
                </div>
                <div class="px-3 hidden sm:block sm:col-span-2">
                    <?php
                    $producto_venta = " (Venta)";
                    if($matriz_producto_venta[$key_productos] == 0) {
                        $producto_venta = " (Interno)";
                    }
                    /*
                    tipo_producto = 0 // normal
                    tipo_producto = 1 // elaborado
                    tipo_producto = 2 // compuesto
                    tipo_producto = 3 // combo manual
                    tipo_producto = 4 // combo automático
                    */
                    if($matriz_tipo_productos[$key_productos] == 0) {
                        echo "Normal".$producto_venta;
                    }else if($matriz_tipo_productos[$key_productos] == 1) {
                        echo "Elaborado".$producto_venta;
                    }else if($matriz_tipo_productos[$key_productos] == 2) {
                        echo "Compuesto".$producto_venta;
                    }else if($matriz_tipo_productos[$key_productos] == 3) {
                        echo "Combo manual".$producto_venta;
                    }else if($matriz_tipo_productos[$key_productos] == 4) {
                        echo "Combo automático".$producto_venta;
                    }
                    ?>
                </div>
                <div class="text-center px-3 col-span-1">
                    <a href="#" class="botones-apartados" title="IRPF" onclick="abrirFicha(<?php echo $valor_productos; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    unset($matriz_id_producto_productos);
    unset($matriz_descripcion_productos);
    unset($matriz_imagen_productos);
    unset($matriz_updated_productos);
    unset($matriz_id_categoria_productos_categorias);
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/componentes/footer-listados.php");
}else {
    ?>
    <div class="flex items-center justify-center h-10 bg-white mx-5">
        <div class="text-center grow px-3">
            No existen productos definidos.
        </div>
    </div>
    <?php
}
