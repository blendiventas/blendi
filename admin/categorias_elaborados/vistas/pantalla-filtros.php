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
            Nueva categoría de elaborado
        </a>
    </div>
</div>