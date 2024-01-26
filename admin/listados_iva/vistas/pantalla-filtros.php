<div class="flex flex-wrap justify-center px-5">
    <div class="pr-2 mt-2 grow flex flex-wrap" id="listadoFiltros">
        &nbsp;
    </div>
    <div class="pl-2 mt-2">
        <a href="#" class="items-center inline-flex justify-center border border-transparent bg-gray-250 dark:bg-graydark-250 py-2 px-4 text-sm font-medium text-gray-650 dark:text-graydark-650 shadow-sm" id="dropdownFiltros" data-dropdown-toggle="dropdownDescargasMenu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
            Descargar
        </a>
        <div id="dropdownDescargasMenu" class="hidden z-10 bg-white rounded divide-y divide-gray-100 shadow">
            <div class="h-11 flex items-center">
                <a href="#" onclick="descargarListado('csv')" class="p-3">
                    CSV
                </a>
            </div>
        </div>
    </div>
    <div class="pl-2 mt-2">
        <a href="#" class="items-center inline-flex justify-center border border-transparent bg-gray-250 dark:bg-graydark-250 py-2 px-4 text-sm font-medium text-gray-650 dark:text-graydark-650 shadow-sm" id="dropdownFiltros" data-dropdown-toggle="dropdownFiltrosMenu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
            </svg>
            &nbsp;Filtros
        </a>
        <div id="dropdownFiltrosMenu" class="hidden z-10 bg-white rounded divide-y divide-gray-100 shadow">
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('vista', 'ticket')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_vista" id="filtro_vista_ticket">
                    Vista: Por documento
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('vista', 'diaria')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_vista" id="filtro_vista_diaria">
                    Vista: Diaria
                </a>
            </div>
            <?php
            for ($i = 2022; $i <= date('Y'); $i++) {
                ?>
                <div class="h-11 flex items-center">
                    <a href="#" onclick="listadoFiltrar('ejercicio', <?php echo $i; ?>)" class="p-3">
                        <input type="checkbox" class="text-blendi-600 filtro_ejercicio" id="filtro_ejercicio_<?php echo $i; ?>">
                        Ejercicio: <?php echo $i; ?>
                    </a>
                </div>
                <?php
            }
            ?>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('tipo_documento', 'tiq')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_tipo_documento" id="filtro_tipo_documento_tiq">
                    Documentos: Tíckets
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('tipo_documento', 'fac')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_tipo_documento" id="filtro_tipo_documento_fac">
                    Documentos: Facturas
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-soportado-1t')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-soportado-1t">
                    IVA Soportado 1t
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-soportado-2t')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-soportado-2t">
                    IVA Soportado 2t
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-soportado-3t')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-soportado-3t">
                    IVA Soportado 3t
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-soportado-4t')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-soportado-4t">
                    IVA Soportado 4t
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-soportado-ej')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-soportado-ej">
                    IVA Soportado Ejercicio
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-repercutido-1t')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-repercutido-1t">
                    IVA Repercutido 1t
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-repercutido-2t')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-repercutido-2t">
                    IVA Repercutido 2t
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-repercutido-3t')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-repercutido-3t">
                    IVA Repercutido 3t
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-repercutido-4t')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-repercutido-4t">
                    IVA Repercutido 4t
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('mostrar', 'iva-repercutido-ej')" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_mostrar" id="filtro_mostrar_iva-repercutido-ej">
                    IVA Repercutido Ejercicio
                </a>
            </div>
        </div>
    </div>
</div>