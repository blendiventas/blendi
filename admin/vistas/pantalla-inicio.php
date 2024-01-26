<div id="capa_filtros" class="capa-filtros bg-main hide"></div>
<div id="capa_lista" class="capa-main bg-main grid grid-cols-5 justify-items-center">
    <?php
    if(isset($clientes_usuarios_permisos) && ($clientes_usuarios_permisos || $presupuestos_clientes_usuarios_permisos || $pedidos_clientes_usuarios_permisos || $albaranes_clientes_usuarios_permisos || $facturas_clientes_usuarios_permisos || $tiquets_clientes_usuarios_permisos || $mesas_usuarios_permisos)) {
        ?>
        <div>
            <div class="grid grid-cols-1 justify-items-center items-center p-3 w-28 h-28 cursor-pointer" data-dropdown-toggle="dropdown_general_ventas">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                </svg>
                Ventas
            </div>
            <div id="dropdown_general_ventas" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                <div class="py-3 px-4 text-sm bg-blendi-600 text-white">
                    <div class="font-bold">Ventas</div>
                </div>
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
                    <?php
                    if($clientes_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cli" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Clientes">
                                Clientes
                            </a>
                        </li>
                        <?php
                    }
                    if($mesas_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-mesas" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Mesas" >
                                Mesas
                            </a>
                        </li>
                        <?php
                    }
                    if($presupuestos_clientes_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Presupuestos clientes">
                                Presupuestos
                            </a>
                        </li>
                        <?php
                    }
                    if($pedidos_clientes_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Pedidos clientes">
                                Pedidos
                            </a>
                        </li>
                        <?php
                    }
                    if($albaranes_clientes_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Albaranes clientes">
                                Albaranes
                            </a>
                        </li>
                        <?php
                    }
                    if($facturas_clientes_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Facturas clientes">
                                Facturas
                            </a>
                        </li>
                        <?php
                    }
                    if($tiquets_clientes_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Tiquets clientes">
                                <!-- <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Tiquets clientes" onclick="FullScreenMode('<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio')"> -->
                                <!--<a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Tiquets clientes" onclick="goFullscreen();">-->
                                Tiquets
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }
    if(isset($proveedores_usuarios_permisos) && ($proveedores_usuarios_permisos || $presupuestos_proveedores_usuarios_permisos || $pedidos_proveedores_usuarios_permisos || $albaranes_proveedores_usuarios_permisos || $facturas_proveedores_usuarios_permisos || $tiquets_proveedores_usuarios_permisos)) {
        ?>
        <div>
            <div class="grid grid-cols-1 justify-items-center items-center p-3 w-28 h-28 cursor-pointer" data-dropdown-toggle="dropdown_general_compras">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                Compras
            </div>
            <div id="dropdown_general_compras" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                <div class="py-3 px-4 text-sm bg-blendi-600 text-white">
                    <div class="font-bold">Compras</div>
                </div>
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
                    <?php
                    if($proveedores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=pro" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Proveedores">
                                Proveedores
                            </a>
                        </li>
                        <?php
                    }
                    if($presupuestos_proveedores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Presupuestos proveedores">
                                Presupuestos
                            </a>
                        </li>
                        <?php
                    }
                    if($pedidos_proveedores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Pedidos proveedores">
                                Pedidos
                            </a>
                        </li>
                        <?php
                    }
                    if($albaranes_proveedores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Albaranes proveedores">
                                Albaranes
                            </a>
                        </li>
                        <?php
                    }
                    if($facturas_proveedores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Facturas proveedores">
                                Facturas
                            </a>
                        </li>
                        <?php
                    }
                    if($tiquets_proveedores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Tiquets proveedores">
                                Tiquets
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }
    if(isset($creditores_usuarios_permisos) && ($creditores_usuarios_permisos || $presupuestos_creditores_usuarios_permisos || $pedidos_creditores_usuarios_permisos || $albaranes_creditores_usuarios_permisos || $facturas_creditores_usuarios_permisos || $tiquets_creditores_usuarios_permisos)) {
        ?>
        <div>
            <div class="grid grid-cols-1 justify-items-center items-center p-3 w-28 h-28 cursor-pointer" data-dropdown-toggle="dropdown_general_gastos">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>
                Gastos
            </div>
            <div id="dropdown_general_gastos" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                <div class="py-3 px-4 text-sm bg-blendi-600 text-white">
                    <div class="font-bold">Gastos</div>
                </div>
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
                    <?php
                    if($creditores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cre" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Creditores">
                                Creditores
                            </a>
                        </li>
                        <?php
                    }
                    if($presupuestos_creditores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Presupuestos creditores">
                                Presupuestos
                            </a>
                        </li>
                        <?php
                    }
                    if($pedidos_creditores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Pedidos creditores">
                                Pedidos
                            </a>
                        </li>
                        <?php
                    }
                    if($albaranes_creditores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Albaranes creditores">
                                Albaranes
                            </a>
                        </li>
                        <?php
                    }
                    if($facturas_creditores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Facturas creditores">
                                Facturas
                            </a>
                        </li>
                        <?php
                    }
                    if($tiquets_creditores_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Tiquets creditores">
                                Tiquets
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }
    if(isset($productos_usuarios_permisos) && ($productos_usuarios_permisos || $categorias_usuarios_permisos || $grupos_productos_usuarios_permisos || $categorias_elaborados_usuarios_permisos || $detalles_productos_usuarios_permisos || $mas_vendidos_listados_usuarios_permisos || $stocks_listados_usuarios_permisos || $tarifas_usuarios_permisos)) {
        ?>
        <div>
            <div class="grid grid-cols-1 justify-items-center items-center p-3 w-28 h-28 cursor-pointer" data-dropdown-toggle="dropdown_general_productos">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>
                Productos
            </div>
            <div id="dropdown_general_productos" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                <div class="py-3 px-4 text-sm bg-blendi-600 text-white">
                    <div class="font-bold">Productos</div>
                </div>
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
                    <?php
                    if($productos_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Productos">
                                Productos
                            </a>
                        </li>
                        <?php
                    }
                    if($categorias_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Categorías">
                                Categorías
                            </a>
                        </li>
                        <?php
                    }
                    if($grupos_productos_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-grupos" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Grupos">
                                Grupos
                            </a>
                        </li>
                        <?php
                    }
                    if($categorias_elaborados_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias_elaborados" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Categorías elaborados">
                                Categorías elaborados
                            </a>
                        </li>
                        <?php
                    }
                    if($detalles_productos_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Detalles productos">
                                Detalles productos
                            </a>
                        </li>
                        <?php
                    }
                    if($mas_vendidos_listados_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-mas-vendidos" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Más vendidos">
                                Más vendidos
                            </a>
                        </li>
                        <?php
                    }
                    if($stocks_listados_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-stocks" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Stocks">
                                Stocks
                            </a>
                        </li>
                        <?php
                    }
                    if($tarifas_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tarifas" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Tarifas">
                                Tarifas
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }
    if(isset($modalidades_pago_usuarios_permisos) && ($modalidades_pago_usuarios_permisos || $modalidades_pago_usuarios_permisos || $bancos_cajas_usuarios_permisos || $usuarios_usuarios_permisos || $datos_empresa_usuarios_permisos || $impresion_documentos_usuarios_permisos || $tipos_iva_usuarios_permisos || $tipos_irpf_usuarios_permisos || $zonas_usuarios_permisos || $modalidades_envio_usuarios_permisos || $modalidades_entrega_usuarios_permisos || $terminales_permisos)) {
        ?>
        <div>
            <div class="grid grid-cols-1 justify-items-center items-center p-3 w-28 h-28 cursor-pointer" data-dropdown-toggle="dropdown_general_configuraciones">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Ajustes
            </div>
            <div id="dropdown_general_configuraciones" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                <div class="py-3 px-4 text-sm bg-blendi-600 text-white">
                    <div class="font-bold">Configuraciones</div>
                </div>
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
                    <?php
                    if($modalidades_pago_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_pago" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Modalidades pago">
                                Modalidades pago
                            </a>
                        </li>
                        <?php
                    }
                    if($modalidades_pago_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-metodos_pago" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Métodos pago">
                                Métodos pago
                            </a>
                        </li>
                        <?php
                    }
                    if($bancos_cajas_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-bancos_cajas" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Bancos y cajas">
                                Bancos y cajas
                            </a>
                        </li>
                        <?php
                    }
                    if($usuarios_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-usuarios" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Usuarios">
                                Usuarios
                            </a>
                        </li>
                        <?php
                    }
                    if($datos_empresa_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-datos_empresa" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Datos empresa">
                                Datos empresa
                            </a>
                        </li>
                        <?php
                    }
                    if($impresion_documentos_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-impresion_documentos" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Impresión documentos">
                                Impresión documentos
                            </a>
                        </li>
                        <?php
                    }
                    if($tipos_iva_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-iva" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Tipos IVA">
                                Tipos de IVA
                            </a>
                        </li>
                        <?php
                    }
                    if($tipos_irpf_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-irpf" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Tipos IRPF">
                                Tipos de IRPF
                            </a>
                        </li>
                        <?php
                    }
                    if($zonas_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-zonas" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Zonas">
                                Zonas
                            </a>
                        </li>
                        <?php
                    }
                    if($modalidades_envio_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_envio" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Modalidades envío">
                                Modalidades envío
                            </a>
                        </li>
                        <?php
                    }
                    if($modalidades_entrega_usuarios_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_entrega" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Modalidades entrega">
                                Modalidades entrega
                            </a>
                        </li>
                        <?php
                    }
                    if($terminales_permisos) {
                        ?>
                        <li>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-datos_terminales" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" title="Terminales">
                                Terminales
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<div id="capa_ficha" class="capa-main inline-flex bg-main hide"></div>
<div id="info-main" class="text-center hide"></div>