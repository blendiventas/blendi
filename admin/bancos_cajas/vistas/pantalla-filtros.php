<div class="flex flex-wrap justify-center px-5">
    <div class="text-center pr-2 mt-2 grow flex">
        <button type="button" onclick="listadoBusqueda(document.getElementById('textoBuscar').value);" class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-white px-3 text-sm text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </button>
        <input type="text" id="textoBuscar" name="textoBuscar" placeholder="Buscar..." class="block grow flex-1 rounded-none rounded-r-md border-l-0 border-gray-300 focus:border-blendi-500 focus:ring-blendi-500 sm:text-sm">
        <button type="button" onclick="listadoBusqueda(document.getElementById('textoBuscar').value);" class="ml-4 rounded items-center inline-flex justify-center border border-transparent bg-gray-450 py-2 px-4 text-sm font-medium text-white shadow-sm">
            Buscar
        </button>
        <script type="text/javascript">
            let inputBuscar = document.getElementById('textoBuscar');
            inputBuscar.addEventListener('keyup', function(e) {
                var keycode = e.keyCode || e.which;
                if (keycode == 13) {
                    listadoBusqueda(document.getElementById('textoBuscar').value);
                }
            });
        </script>
    </div>
    <div class="pl-2 mt-2 text-center">
        <a href="#" class="items-center inline-flex justify-center border border-transparent bg-blendi-600 dark:bg-blendidark-600 py-2 px-4 text-sm font-medium text-white dark:text-black shadow-sm" onclick="abrirFicha(0)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Nueva banco o caja
        </a>
    </div>
</div>
<div class="flex flex-wrap justify-center px-5">
    <div class="pr-2 mt-2 grow flex flex-wrap" id="listadoFiltros">
        &nbsp;
    </div>
    <div class="pl-2 mt-2">
        <a href="#" class="items-center inline-flex justify-center border border-transparent bg-gray-250 dark:bg-graydark-250 py-2 px-4 text-sm font-medium text-gray-650 dark:text-graydark-650 shadow-sm" id="dropdownFiltros" data-dropdown-toggle="dropdownFiltrosMenu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
            </svg>
            &nbsp;Filtros
        </a>
        <div id="dropdownFiltrosMenu" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('habilitado', 1)" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_habilitado" id="filtro_habilitado_1">
                    Habilitado: Sí
                </a>
            </div>
            <div class="h-11 flex items-center">
                <a href="#" onclick="listadoFiltrar('habilitado', 0)" class="p-3">
                    <input type="checkbox" class="text-blendi-600 filtro_habilitado" id="filtro_habilitado_0">
                    Habilitado: No
                </a>
            </div>
        </div>
    </div>
</div>