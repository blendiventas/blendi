<nav class="bg-white shadow-gray-400 shadow-md fixed w-full z-40">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-3">
            <div class="flex items-center h-16">
                <a href="<?php echo ($id_usuario == 1)? '/admin/gestion-home' : $host_url; ?>" target="_self" class="max-h-10 w-20">
                    <img src="<?php echo $host_images . 'datos_empresa/' . $logo_datos_empresa; ?>" id="imagen-logo"
                         class="max-h-10 w-20"
                         alt="<?php echo $nombre_comercial_datos_empresa; ?>"
                         title="<?php echo $nombre_comercial_datos_empresa; ?>" />
                </a>
            </div>

            <button data-collapse-toggle="navbar-default" type="button" class="h-16 p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100" aria-controls="navbar-default" aria-expanded="false" id="boton-toggle-menu-header" onclick="toggleDisplay('capa-cesta-buscador'); toggleDisplay('capa-acciones-adicionales');">
                <span class="sr-only">Abrir menú</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>

            <div class="hidden lg:block grow" id="navbar-default">
                <div class="w-full sm:w-auto sm:flex sm:items-center sm:space-x-4 sm:justify-right">
                    <div class="flex items-center h-16">
                        <a href="#" class="grow text-center text-gray px-3 py-2 text-xs font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white link_productos link_ficha_producto link_cobrar" id="boton-tpv" title="TPV" onclick="if (window.innerWidth < 640) { document.getElementById('boton-toggle-menu-header').click(); } zonaDisplay = 'productos'; gestionDeCapasGenerales(); setHeights();">
                            CARTA
                        </a>
                    </div>
                    <input type="hidden" name="id_librador_seleccionar" id="id_librador_seleccionar" value="<?php echo $id_librador; ?>" />
                    <?php
                    if(isset($existen_mesas) && $existen_mesas) {
                        ?>
                        <div class="flex items-center h-16">
                            <a href="#" class="grow text-center text-gray px-3 py-2 text-xs font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white link_comedor" id="boton-mesas" title="Mostrar mesas" onclick="let continuar = cerrarDocumento(); if (continuar) { if (window.innerWidth < 640) { document.getElementById('boton-toggle-menu-header').click(); } if (tipoLibrador == 'cli' && tipoDocumento == 'tiq') { zonaDisplay = 'comedor'; gestionDeCapasGenerales(); } else { window.location.href = '/tiquets/' + idSesion + '/tpv/ventas/comedor'; } }">
                                MI SERVICIO
                            </a>
                        </div>
                        <?php
                    }
                    if($tipo_documento == "pre") { $documento_tipo = "PRESUPUESTOS"; }
                    if($tipo_documento == "ped") { $documento_tipo = "PEDIDOS"; }
                    if($tipo_documento == "alb") { $documento_tipo = "ALBARANES"; }
                    if($tipo_documento == "fac") { $documento_tipo = "FACTURAS"; }
                    if($tipo_documento == "tiq") { $documento_tipo = "TICKETS"; }
                    ?>
                    <div id="capa_boton_otros_documentos" class="flex items-center h-16">
                        <a href="#" class="grow text-center text-gray px-3 py-2 text-xs font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white link_documentos" title="Documentos" onclick="if (window.innerWidth < 640) { document.getElementById('boton-toggle-menu-header').click(); } actualizarOtrosDocumentos('capa-otros-documentos','global','abiertos','mostrar');">
                            <?php echo $documento_tipo; ?>
                        </a>
                    </div>
                    <?php
                    if (isset($sector) && ($sector == 'restauracion') && isset($m_cocina) && !empty($m_cocina)) {
                        ?>
                        <div class="flex items-center h-16">
                            <a href="/recepcion_pedidos" class="grow text-center text-gray px-3 py-2 text-xs font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white" id="boton-cocina" title="Cocina">
                                COCINA
                            </a>
                        </div>
                        <?php
                    }
                    if (isset($productos_usuarios_permisos) && $productos_usuarios_permisos) {
                        ?>
                        <div class="flex items-center h-16">
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="grow text-center text-gray px-3 py-2 text-xs font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white" title="Productos">
                                DESPENSA
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div id="capa-cesta-buscador" class="flex items-center">
                <div class="flex items-center rounded-md shadow-sm px-3 w-full">
                    <div id="capa_boton_cesta" class="button-cesta mr-3 flex items-center sm:hidden" onclick="collapseCapa('capa-cesta-lateral');">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <div class="contador-cesta" id="contador-cesta">0</div>
                    </div>
                    <button type="button" onclick="buscar(document.getElementById('textoBuscar').value);" class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-white px-3 text-sm text-gray-500 h-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                    <input type="text" id="textoBuscar" name="textoBuscar" placeholder="Buscar productos..." class="block w-full flex-1 rounded-none rounded-r-md border-l-0 border-gray-300 h-10 focus:border-blendi-500 focus:ring-blendi-500 sm:text-sm">
                    <input type="hidden" id="cercar_poblacion" name="poblacion" value="">
                    <input type="hidden" id="cercar_provincia" name="provincia" value="">
                    <input type="hidden" id="cercar_sector" name="sector" value="">
                </div>
            </div>
            <div id="capa-acciones-adicionales" class="hidden sm:block grow">
                <div class="flex justify-end items-center space-x-2 h-16">
                    <div class="hidden sm:block cursor-pointer" onclick="goFullscreen(true)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="maximize_icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="minimize_icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25" />
                        </svg>
                    </div>

                    <div class="cursor-pointer" data-dropdown-toggle="dropdown_notificaciones" onclick="checkNotificaciones()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                    <div id="dropdown_notificaciones" class="hidden z-10 w-44 p-2 bg-white rounded divide-y divide-gray-100 shadow">
                        Notificaciones. En desarrollo.
                    </div>

                    <?php
                    $avatar = (empty($avatar_usuario))? null : $avatar_usuario;
                    if (!$avatar) {
                        $avatar = substr($id_usuario, strlen($id_usuario) - 1, 1);
                    }
                    if ($avatar == 0) {
                        $avatar = 1;
                    }
                    ?>
                    <img src="/avatars/avatar<?php echo $avatar; ?>.svg?ver=1" class="p-2 rounded-full max-w-[48px] cursor-pointer" id="multiLevelDropdownButton" data-dropdown-toggle="dropdown-avatar">

                    <div id="dropdown-avatar" class="hidden rounded-lg z-10 w-86 bg-white rounded shadow dark:bg-graydark-650">
                        <div class="rounded-t-lg py-3 px-4 h-16 text-sm bg-blendi-600 text-white">
                            <img src="/avatars/avatar<?php echo $avatar; ?>.svg?ver=1" class="mt-2 p-2 mx-auto rounded-full max-w-[80px] cursor-pointer">
                        </div>
                        <div class="mt-10 w-full text-center">
                            <span class="font-bold"><?php echo $nombre_usuario; ?></span>
                        </div>
                        <div class="overflow-auto my-3" style="max-height: 40vh">
                            <?php
                            require("admin/vistas/menu-perfil.php");
                            ?>
                        </div>
                        <?php
                        $dateTimeNow = new DateTime();
                        if ($dateTimeNow < $fecha_inicio_plan_datos_empresa) {
                            $tiempoRestante = $fecha_inicio_plan_datos_empresa->getTimestamp() - $dateTimeNow->getTimestamp();
                            $diasRestantes = date('d', $tiempoRestante) - 1;
                            $porcentajeRestante = intval(($diasRestantes / 15) * 100);
                            ?>
                            <div class="py-1 px-4 text-sm border-t border-1 cursor-pointer" onclick="window.location.href='<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-suscripcion';">
                                <div>
                                    Tu suscripción gratuita
                                </div>
                                <div class="progress my-2">
                                    <div class="progress-bar" style="width:<?php echo $porcentajeRestante; ?>%;">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div>
                                        Días restantes
                                    </div>
                                    <div class="grow text-right">
                                        <?php echo $diasRestantes; ?>/15
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="py-1 border-t border-1">
                            <ul>
                                <li>
                                    <a href="/admin/usuarios-inicio" class="block py-2 px-4">Cambiar usuario</a>
                                </li>
                                <li>
                                    <a href="#" class="block py-2 px-4" onclick="cerrarSesion();">Cerrar sesión</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<?php

if(empty ($categorias_mostrar) && ($tipo_librador == "pro" || $tipo_librador == "cre")) {
    ?>
    <div class="flex items-center hidden" id="capa_boton_otros_documentos">
        <div class="grow">
            <a class="hover:text-blendi-600" title="Documentos" onclick="actualizarOtrosDocumentos('capa-otros-documentos','global','abiertos','mostrar');">
                <?php echo ucfirst(strtolower($documento_tipo)); ?>
            </a>
        </div>
    </div>
    <hr />
    <?php
}