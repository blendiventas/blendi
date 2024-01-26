<div class="flex flex-wrap items-center justify-center mx-5 h-16">
    <div class="grow flex flex-wrap justify-center mt-2">
        <a href="<?php echo $host_links . '/' . $categoria; ?>?pagina=1&orden=<?php echo $ordenIndex; ?>&resultados=<?php echo $resultados; ?><?php echo $anadidoQueryURI; ?>" onclick="listadoPagina(1)" class="rounded-full mx-1 <?php echo ($paginaActual != 1)? 'bg-white text-blendi-200' : 'bg-blendi-200 text-white'; ?> p-2 h-10 w-10 leading-6 text-center">1</a>
        <?php
        if ($cantidadPaginas > 1) {
            $paginaBucleParte1Inicial = 2;
            $paginaBucleParte1Total = $cantidadPaginas -1;
            $paginaBucleParte2Inicial = null;
            $paginaBucleParte2Total = null;
            if ($cantidadPaginas > 10) {
                $paginaBucleParte2Inicial = $cantidadPaginas - 4;
                $paginaBucleParte2Total = $cantidadPaginas - 1;
                if ($paginaActual <= 3 || $paginaActual + 2 >= $cantidadPaginas) {
                    $paginaBucleParte1Inicial = 2;
                    $paginaBucleParte1Total = 5;
                } else if ($paginaActual + 6 >= $cantidadPaginas) {
                    $paginaBucleParte1Inicial = 2;
                    $paginaBucleParte1Total = 5;
                    $paginaBucleParte2Inicial = $paginaActual - 2;
                    $paginaBucleParte2Total = $paginaActual + 2;
                } else {
                    $paginaBucleParte1Inicial = $paginaActual - 2;
                    $paginaBucleParte1Total = $paginaActual + 2;
                }
            }
            if ($paginaBucleParte1Inicial - 1 > 1) {
                ?>
                <div class="rounded-full mx-1 bg-white text-blendi-200 p-2 h-10 w-10 leading-6 text-center">
                    ...
                </div>
                <?php
            }
            for ($paginaBucleParte1 = $paginaBucleParte1Inicial; $paginaBucleParte1 <= $paginaBucleParte1Total; $paginaBucleParte1++) {
                ?>
                <a href="<?php echo $host_links . '/' . $categoria; ?>?pagina=<?php echo $paginaBucleParte1; ?>&orden=<?php echo $ordenIndex; ?>&resultados=<?php echo $resultados; ?><?php echo $anadidoQueryURI; ?>" class="rounded-full mx-1 <?php echo ($paginaActual != $paginaBucleParte1)? 'bg-white text-blendi-200' : 'bg-blendi-200 text-white'; ?> p-2 h-10 w-10 leading-6 text-center"><?php echo $paginaBucleParte1; ?></a>
                <?php
            }
            if ($paginaBucleParte2Total) {
                if (!($cantidadPaginas <= 14 && $paginaActual <= 8) && $paginaActual + 2 != $cantidadPaginas - 5) {
                    ?>
                    <div class="rounded-full mx-1 bg-white text-blendi-200 p-2 h-10 w-10 leading-6 text-center">
                        ...
                    </div>
                    <?php
                }
                for ($paginaBucleParte2 = $paginaBucleParte2Inicial; $paginaBucleParte2 <= $paginaBucleParte2Total; $paginaBucleParte2++) {
                    ?>
                    <a href="<?php echo $host_links . '/' . $categoria; ?>?pagina=<?php echo $paginaBucleParte2; ?>&orden=<?php echo $ordenIndex; ?>&resultados=<?php echo $resultados; ?><?php echo $anadidoQueryURI; ?>" class="rounded-full mx-1 <?php echo ($paginaActual != $paginaBucleParte2)? 'bg-white text-blendi-200' : 'bg-blendi-200 text-white'; ?> p-2 h-10 w-10 leading-6 text-center"><?php echo $paginaBucleParte2; ?></a>
                    <?php
                }
            }
            if ($paginaBucleParte2Inicial && $paginaBucleParte2Inicial + 5 < $cantidadPaginas) {
                ?>
                <div class="rounded-full mx-1 bg-white text-blendi-200 p-2 h-10 w-10 leading-6 text-center">
                    ...
                </div>
                <?php
            }
            ?>
            <a href="<?php echo $host_links . '/' . $categoria; ?>?pagina=<?php echo $cantidadPaginas; ?>&orden=<?php echo $ordenIndex; ?>&resultados=<?php echo $resultados; ?><?php echo $anadidoQueryURI; ?>" class="rounded-full mx-1 <?php echo ($paginaActual != $cantidadPaginas)? 'bg-white text-blendi-200' : 'bg-blendi-200 text-white'; ?> p-2 h-10 w-10 leading-6 text-center"><?php echo $cantidadPaginas; ?></a>
            <?php
        }
        ?>
    </div>
</div>