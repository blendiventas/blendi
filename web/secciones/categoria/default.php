<section class="py-20 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap -mx-4 mb-20 items-center justify-between">
            <div class="w-full lg:w-auto px-4 mb-12 xl:mb-0">
                <h2 class="text-lg font-bold font-heading">
                    <span>De <?php echo ($pagina * $resultados + 1) . ' a ' . (($paginaActual == $cantidadPaginas)? $productosEnLaCategoria : $resultadosTotales) . ' de ' . $productosEnLaCategoria; ?> resultados para</span>
                    <a class="relative text-blue-300 underline" href="#"><?php echo $descripcion_categoria; ?></a>
                </h2>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full lg:hidden px-3">
                <div class="flex flex-wrap -mx-2">
                    <?php
                    if (count($subcategorias)) {
                        ?>
                        <div class="w-1/2 md:w-1/3 px-2 mb-4">
                            <div class="py-6 px-2 text-center bg-gray-50">
                                <a class="font-bold font-heading" href="#" onclick="toggleCapa('filtrosCategoria')">Secciones</a>
                                <ul class="hidden text-left mt-6" id="filtrosCategoria">
                                    <?php
                                    foreach ($subcategorias as $keySubcategoria) {
                                        ?>
                                        <li class="mb-4"><a href="<?php echo $host_links . '/' . $categorias['descripcion_url'][$keySubcategoria]; ?>"><?php echo $categorias['descripcion'][$keySubcategoria]; ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <div class="py-6 px-2 text-center bg-gray-50">
                            <a class="font-bold font-heading" href="#" onclick="toggleCapa('filtrosAtajos')">Atajos</a>
                            <div class="hidden mt-6 flex flex-wrap" id="filtrosAtajos">
                                <div class="w-full sm:w-auto mb-4 mr-5">
                                    <select class="pl-8 py-4 bg-white text-lg border border-gray-200 w-full focus:ring-blue-300 focus:border-blue-300 rounded-md" onchange="window.location.href = '<?php echo $host_links . '/' . $categoria; ?>?pagina=<?php echo $paginaActual; ?>&orden=' + this.value + '&resultados=<?php echo $resultados; ?><?php echo $anadidoQueryURI; ?>'">
                                        <option value="1" <?php echo ($orden == 'productos.descripcion')? 'selected' : ''; ?>>Ordenar por descripción</option>
                                        <option value="2" <?php echo ($orden == 'productos_pvp.pvp')? 'selected' : ''; ?>>Ordenar por precio</option>
                                    </select>
                                </div>
                                <div class="w-full sm:w-auto mb-4 mr-5">
                                    <select class="pl-8 py-4 bg-white text-lg border border-gray-200 w-full focus:ring-blue-300 focus:border-blue-300 rounded-md" onchange="window.location.href = '<?php echo $host_links . '/' . $categoria; ?>?pagina=1>&orden=<?php echo $ordenIndex; ?>&resultados=' + this.value + '<?php echo $anadidoQueryURI; ?>'">
                                        <option value="30" <?php echo ($resultados == 30)? 'selected' : ''; ?>>30 resultados</option>
                                        <option value="50" <?php echo ($resultados == 50)? 'selected' : ''; ?>>50 resultados</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block w-1/4 px-3">
                <?php
                if (count($subcategorias)) {
                    ?>
                    <div class="mb-6 py-10 px-12 bg-gray-50">
                        <h3 class="mb-8 text-lg font-bold font-heading">Secciones</h3>
                        <a class="font-bold font-heading" href="#">Secciones</a>
                        <ul>
                            <?php
                            foreach ($subcategorias as $keySubcategoria) {
                                ?>
                                <li class="mb-4"><a class="text-lg" href="<?php echo $host_links . '/' . $categorias['descripcion_url'][$keySubcategoria]; ?>"><?php echo $categorias['descripcion'][$keySubcategoria]; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
                <div class="mb-6 py-10 px-12 bg-gray-50">
                    <h3 class="mb-8 text-lg font-bold font-heading">Atajos</h3>
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-auto mb-4 mr-5">
                            <select class="pl-8 py-4 bg-white text-lg border border-gray-200 w-full focus:ring-blue-300 focus:border-blue-300 rounded-md" onchange="window.location.href = '<?php echo $host_links . '/' . $categoria; ?>?pagina=<?php echo $paginaActual; ?>&orden=' + this.value + '&resultados=<?php echo $resultados; ?><?php echo $anadidoQueryURI; ?>'">
                                <option value="1" <?php echo ($orden == 'productos.descripcion')? 'selected' : ''; ?>>Ordenar por descripción</option>
                                <option value="2" <?php echo ($orden == 'productos_pvp.pvp')? 'selected' : ''; ?>>Ordenar por precio</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-auto mb-4 mr-5">
                            <select class="pl-8 py-4 bg-white text-lg border border-gray-200 w-full focus:ring-blue-300 focus:border-blue-300 rounded-md" onchange="window.location.href = '<?php echo $host_links . '/' . $categoria; ?>?pagina=1&orden=<?php echo $ordenIndex; ?>&resultados=' + this.value + '<?php echo $anadidoQueryURI; ?>'">
                                <option value="30" <?php echo ($resultados == 30)? 'selected' : ''; ?>>30 resultados</option>
                                <option value="50" <?php echo ($resultados == 50)? 'selected' : ''; ?>>50 resultados</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-3/4 px-3">
                <?php
                require($_SERVER['DOCUMENT_ROOT']."/web/secciones/categoria/paginacion-default.php");
                $iterator = 0;
                foreach ($descripcion as $keyProducto => $descripcionProducto) {
                    if($pvp_iva_incluido == 0 && isset($iva[$keyProducto])) {
                        $pvp[$keyProducto] = $pvp[$keyProducto] / (1 + ($iva[$keyProducto] / 100));
                        $pvp_oferta[$keyProducto] = $pvp_oferta[$keyProducto] / (1 + ($iva[$keyProducto] / 100));
                    }
                    $pvp_mostrar = $pvp[$keyProducto];
                    $esOferta = false;
                    if ($oferta_desde[$keyProducto] >= date("Y-m-d") && $oferta_hasta[$keyProducto] <= date("Y-m-d") && $pvp[$keyProducto] > $pvp_oferta[$keyProducto]) {
                        $esOferta = true;
                        $pvp_mostrar = $pvp_oferta[$keyProducto];

                        $porcentajeOferta = ($pvp_mostrar / $pvp[$keyProducto] - 1) * 100;
                    }
                    ?>
                    <div class="relative mb-6 bg-gray-50">
                        <?php
                        if ($esOferta) {
                            ?>
                            <span class="absolute top-0 left-0 ml-6 mt-6 px-2 py-1 text-xs font-bold font-heading bg-white border-2 border-red-500 rounded-full text-red-500">
                                <?php echo number_format($porcentajeOferta, 0, ",", "."); ?>%
                            </span>
                            <?php
                        }
                        ?>
                        <div class="flex flex-wrap items-center -mx-4 px-8 md:px-20 py-12">
                            <div class="w-full md:w-1/4 px-4 mb-4 md:mb-0">
                                <a href="<?php echo $host_links . '/' . $categoria . '/' . $descripcion_url_mostrar[$keyProducto]; ?>">
                                    <img class="mx-auto md:mx-0 w-40 h-52 object-contain" src="<?php echo $imagen[$keyProducto]; ?>" alt="">
                                </a>
                            </div>
                            <div class="w-full md:w-3/4 px-4">
                                <a class="block mb-8" href="<?php echo $host_links . '/' . $categoria . '/' . $descripcion_url_mostrar[$keyProducto]; ?>">
                                    <h3 class="mb-2 text-lg font-bold font-heading"><?php echo $descripcionProducto; ?></h3>
                                    <?php
                                    if ($mostrar_precio || $producto_stock[$keyProducto] > 0) {
                                        ?>
                                        <p class="mb-6 text-lg font-bold font-heading text-blue-500">
                                            <span>
                                                <?php
                                                if ($numero_packs[$keyProducto] > 1) {
                                                    echo 'Desde ';
                                                }
                                                ?>
                                                <?php echo number_format($pvp_mostrar, 2, ",", "."); ?>€
                                            </span>
                                            <?php
                                            if ($esOferta) {
                                                ?>
                                                <span class="text-xs text-gray-500 font-semibold font-heading line-through">
                                                    <?php echo number_format($pvp[$keyProducto], 2, ",", "."); ?>€
                                                </span>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                        <?php
                                    } else {
                                        ?>
                                        <p class="mb-6 text-lg font-bold font-heading text-blue-500">
                                            Precio a consultar.
                                        </p>
                                        <?php
                                    }
                                    ?>
                                    <p class="max-w-md text-gray-500">Más información</p>
                                </a>
                                <?php
                                if ($producto_stock[$keyProducto] > 0) {
                                    ?>
                                    <div class="flex flex-wrap items-center justify-between">
                                        <a class="inline-block w-full md:w-auto mb-4 md:mb-0 md:mr-4 text-center bg-orange-300 hover:bg-orange-400 text-white font-bold font-heading py-4 px-8 rounded-md uppercase" href="#" onclick="anadirAlCarrito('<?php echo $descripcion_url_mostrar[$keyProducto]; ?>', <?php echo $id_producto_mostrar[$keyProducto]; ?>, 1, '');">Añadir al carrito</a>
                                    </div>
                                    <?php
                                } else {
                                    include($_SERVER['DOCUMENT_ROOT'] . "/web/secciones/common/form_listado_notificaciones_stock.php");
                                 } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $iterator++;
                }
                require($_SERVER['DOCUMENT_ROOT'] . "/web/secciones/categoria/paginacion-default.php");
                ?>
            </div>
        </div>
    </div>
</section>