<nav class="bg-white shadow-gray-400 shadow-md fixed w-full z-40 top-0">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-3">
            <div class="flex justify-center items-center">
                <a href="<?php echo $host_url; ?>admin/<?php echo ($id_usuario == 1)? 'gestion-home' : ''; ?>" target="_self">
                    <img
                            src="<?php echo $host_images . 'datos_empresa/' . $logo_datos_empresa; ?>"
                            id="imagen-logo"
                            alt="<?php echo $nombre_comercial_datos_empresa; ?>"
                            title="<?php echo $nombre_comercial_datos_empresa; ?>"
                            onload="cargarImagen(this);"
                    />
                </a>
            </div>

            <button data-collapse-toggle="navbar-default" type="button" class="h-16 p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100" aria-controls="navbar-default" aria-expanded="false" id="boton-toggle-menu-header">
                <span class="sr-only">Abrir menú</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>

            <div class="hidden lg:block grow" id="navbar-default">
                <div class="w-full sm:w-auto sm:flex sm:items-center sm:space-x-4 sm:justify-right">
                    <?php
                    if (isset($ruta_sys) && $ruta_sys != 'usuarios/inicio/') {
                        if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca' || $sector == 'comercio') && $tiquets_clientes_usuarios_permisos) {
                            ?>
                            <div class="flex items-center h-16">
                                <a href="<?php echo (isset($categorias['descripcion_url'][0]) && !$mostrar_mas_vendidos)? $host_url.'tiquets/'.$id_sesion_sys.'/tpv/ventas/'.$categorias['descripcion_url'][0] : $host_url.'tiquets/'.$id_sesion_sys.'/tpv/ventas-inicio'; ?>" class="grow text-center text-gray px-3 py-2 text-xs font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white" id="boton-tpv" title="TPV">
                                    CARTA
                                </a>
                            </div>
                            <?php
                        }
                        if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca')) {
                            if(isset($existen_mesas) && $existen_mesas) {
                                ?>
                                <div class="flex items-center h-16">
                                    <a href="<?php echo $host_url; ?>tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas/comedor" class="grow text-center text-gray px-3 py-2 text-xs font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white" id="boton-mesas" title="Mesas">
                                        MI SERVICIO
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        if (isset($sector) && ($sector == 'restauracion' || $sector == 'discoteca' || $sector == 'comercio') && $tiquets_clientes_usuarios_permisos) {
                            ?>
                            <div class="flex items-center h-16">
                                <a href="<?php echo $host_url.'tiquets/'.$id_sesion_sys.'/tpv/ventas/documentos'; ?>" class="grow text-center text-gray px-3 py-2 text-xs font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white" id="boton-tickets" title="TICKETS">
                                    TICKETS
                                </a>
                            </div>
                            <?php
                        }
                        if (isset($sector) && ($sector == 'restauracion') && $recepcion_pedidos_permisos && isset($m_cocina) && !empty($m_cocina)) {
                            ?>
                            <div class="flex items-center h-16">
                                <a href="/recepcion_pedidos" class="grow text-center text-gray px-3 py-2 text-xs font-medium <?php echo ($ruta_sys == "recepcion_pedidos/")? 'border-y-2 border-b-blendi-700 border-t-white' : ''; ?> hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white" id="boton-cocina" title="Cocina">
                                    COCINA
                                </a>
                            </div>
                            <?php
                        }
                        if (isset($productos_usuarios_permisos) && $productos_usuarios_permisos) {
                            ?>
                            <div class="flex items-center h-16">
                                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" class="grow text-center text-gray px-3 py-2 text-xs font-medium <?php echo ($ruta_sys == "productos/")? 'border-y-2 border-b-blendi-700 border-t-white' : ''; ?> hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white" title="Productos">
                                    DESPENSA
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div id="capa-acciones-adicionales" class="grow">
                <div class="flex justify-end items-center space-x-2 h-16">
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
                            require("menu-perfil.php");
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
