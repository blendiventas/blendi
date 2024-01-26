<!--
<form action="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <div class="box text-center">
        <?php
        $selected_todos = " selected";
        $selected_normal_venta = "";
        $selected_normal_interno = "";
        $selected_elaborados_venta = "";
        $selected_elaborados_interno = "";
        $selected_compuestos = "";
        $selected_combos = "";
        $selected_combo_manual = "";
        $selected_combo_automatico = "";
        if(isset($id_tipo_productos_relacionados)) {
            if($id_tipo_productos_relacionados == "01") {
                $selected_todos = "";
                $selected_normal_venta = " selected";
            }else if($id_tipo_productos_relacionados == "00") {
                $selected_todos = "";
                $selected_normal_interno= " selected";
            }else if($id_tipo_productos_relacionados == "11") {
                $selected_todos = "";
                $selected_elaborados_venta= " selected";
            }else if($id_tipo_productos_relacionados == "10") {
                $selected_todos = "";
                $selected_elaborados_interno= " selected";
            }
            else if($id_tipo_productos_relacionados == 2) {
                $selected_todos = "";
                $selected_compuestos = " selected";
            }
            else if($id_tipo_productos_relacionados == 34) {
                $selected_todos = "";
                $selected_combos = " selected";
            }
            else if($id_tipo_productos_relacionados == 3) {
                $selected_todos = "";
                $selected_combo_manual = " selected";
            }
            else if($id_tipo_productos_relacionados == 4) {
                $selected_todos = "";
                $selected_combo_automatico = " selected";
            }
        }
        ?>
        <select id="id_tipo_productos_relacionados" name="id_tipo_productos_relacionados">
            <option value="-1"<?php echo $selected_todos; ?>>Todos</option>
            <option value="01"<?php echo $selected_normal_venta; ?>>Normal (venta)</option>
            <option value="00"<?php echo $selected_normal_interno; ?>>Normal (interno)</option>
            <option value="11"<?php echo $selected_elaborados_venta; ?>>Elaborados (venta)</option>
            <option value="10"<?php echo $selected_elaborados_interno; ?>>Elaborados (interno)</option>
            <option value="2"<?php echo $selected_compuestos; ?>>Compuestos</option>
            <option value="34"<?php echo $selected_combos; ?>>Combos</option>
            <option value="3"<?php echo $selected_combo_manual; ?>>Combo manual</option>
            <option value="4"<?php echo $selected_combo_automatico; ?>>Combo automático</option>
        </select>
        Categoria:
        Buscar:
    </div>
</form>
<div class="box text-center">
    <?php
    if(empty($apartado_url)) {
        ?>
        <button type="button" class="w-50" onclick="window.location.href='/admin/gestion-productos/tipo_producto='+document.getElementById('id_tipo_productos_relacionados').value;">
        <?php
    }else {
        ?>
        <button type="button" class="w-50" onclick="window.location.href='/admin/gestion-productos/apartado=<?php echo $apartado_url; ?>/tipo_producto='+document.getElementById('id_tipo_productos_relacionados').value;">
        <?php
    }
    ?>
        Mostrar resultados
    </button>
</div>-->
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
            Nuevo Producto
        </a>
    </div>
    <div class="pl-2 mt-2 text-center">
        <a href="#" class="items-center inline-flex justify-center border border-transparent bg-blendi-600 dark:bg-blendidark-600 py-2 px-4 text-sm font-medium text-white dark:text-black shadow-sm" onclick="nuevoMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Nuevo Menú
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
