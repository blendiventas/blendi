<div class="flex flex-wrap items-center justify-center mx-5 h-16">
    <?php
    $paginaActual = $parametro_pagina + 1;
    ?>
    <div class="text-center text-gray-500 px-8 mt-2">
        <?php
        $resultadosTotales = $parametro_pagina * $parametro_resultados + $parametro_resultados;
        if ($resultsListadoFiltrado < $resultadosTotales) {
            $resultadosTotales = $resultsListadoFiltrado;
        }
        echo ($parametro_pagina * $parametro_resultados + 1) . ' a ' . (($paginaActual == $cantidadPaginas)? $resultsListadoFiltrado : $resultadosTotales) . ' de ' . $resultsListadoFiltrado . ' ítems';
        ?>
    </div>
    <div class="grow flex flex-wrap justify-center mt-2">
        <a href="#" onclick="listadoPagina(1)" class="rounded-full mx-1 <?php echo ($paginaActual != 1)? 'bg-white text-blendi-200' : 'bg-blendi-200 text-white'; ?> p-2 h-10 w-10 leading-6 text-center">1</a>
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
                <a href="#" onclick="listadoPagina(<?php echo $paginaBucleParte1; ?>)" class="rounded-full mx-1 <?php echo ($paginaActual != $paginaBucleParte1)? 'bg-white text-blendi-200' : 'bg-blendi-200 text-white'; ?> p-2 h-10 w-10 leading-6 text-center"><?php echo $paginaBucleParte1; ?></a>
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
                    <a href="#" onclick="listadoPagina(<?php echo $paginaBucleParte2; ?>)" class="rounded-full mx-1 <?php echo ($paginaActual != $paginaBucleParte2)? 'bg-white text-blendi-200' : 'bg-blendi-200 text-white'; ?> p-2 h-10 w-10 leading-6 text-center"><?php echo $paginaBucleParte2; ?></a>
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
            <a href="#" onclick="listadoPagina(<?php echo $cantidadPaginas; ?>)" class="rounded-full mx-1 <?php echo ($paginaActual != $cantidadPaginas)? 'bg-white text-blendi-200' : 'bg-blendi-200 text-white'; ?> p-2 h-10 w-10 leading-6 text-center"><?php echo $cantidadPaginas; ?></a>
            <?php
        }
        ?>
    </div>
    <div class="px-8 mt-2">
        <div class="flex items-center">
            <div>
                Mostrar&nbsp;
            </div>
            <div class="flex rounded-full bg-white p-2 h-10 leading-6 cursor-pointer" id="dropdownResultados">
                <div class="text-blendi-200">
                    <?php echo $parametro_resultados; ?> ítems&nbsp;
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </div>
    </div>
    <div id="dropdownResultadosMenu" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
        <div class="h-11 flex items-center"><a href="#" onclick="listadoMostrarResultados(10)" class="p-3">10 ítems</a></div>
        <div class="h-11 flex items-center"><a href="#" onclick="listadoMostrarResultados(15)" class="p-3">15 ítems</a></div>
        <div class="h-11 flex items-center"><a href="#" onclick="listadoMostrarResultados(30)" class="p-3">30 ítems</a></div>
    </div>
    <script type="text/javascript">
        loadDropdownResultadosListado();
        setCapaListadosHeight();
    </script>
</div>
