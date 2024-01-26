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
            <div class="p-3">
                Fecha inicio
                <input type="date" class="text-blendi-600 filtro_inicio" id="filtro_inicio_inicio" onkeyup="if (event.key == 'Enter') { listadoFiltrar('inicio', document.getElementById('filtro_inicio_inicio').value); }" />
                <a href="#" onclick="listadoFiltrar('inicio', document.getElementById('filtro_inicio_inicio').value)" class="p-3">Aplicar</a>
            </div>
            <div class="p-3">
                Fecha fin
                <input type="date" class="text-blendi-600 filtro_fin" id="filtro_fin_fin" onkeyup="if (event.key == 'Enter') { listadoFiltrar('fin', document.getElementById('filtro_fin_fin').value); }" />
                <a href="#" onclick="listadoFiltrar('fin', document.getElementById('filtro_fin_fin').value)" class="p-3">Aplicar</a>
            </div>
        </div>
    </div>
</div>