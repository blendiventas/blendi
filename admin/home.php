<?php
require("vistas/cabecera.php");
?>
<main class="w-full h-full home">
    <div class="w-full pt-20 pb-12 bg-white">
        <div class="w-full px-10 mt-7 text-2xl font-bold text-left">
            <?php echo (isset($nombre_comercial_datos_empresa))? $nombre_comercial_datos_empresa : 'Blendi'; ?>
        </div>
    </div>
    <?php

    ?>
    <div class="h-full bg-blendimodal-background">
        <div class="grid md:grid-cols-12 md:space-x-7">
            <?php
            if (
                $porcentaje_carta_configuracion_inicial != 100 ||
                $porcentaje_usuarios_configuracion_inicial != 100 ||
                $porcentaje_datos_facturacion_configuracion_inicial != 100 ||
                $porcentaje_datos_personales_configuracion_inicial != 100
            ) {
                ?>
                <div class="hidden md:block md:col-span-1">&nbsp;</div>
                <div class="md:col-span-10">
                    <div class="w-full mt-12 text-xl font-bold text-left dark:text-white">
                        CONFIGURACIÓN DE TU NEGOCIO
                    </div>
                    <div class="w-full mt-3 p-5 rounded-lg border border-1 border-blendigray-50 bg-white">
                        <?php
                        if ($porcentaje_carta_configuracion_inicial != 100) {
                            ?>
                            <div class="grid md:grid-cols-7 p-2">
                                <div class="md:col-span-2">
                                    Productos y categorías
                                </div>
                                <div class="md:col-span-3 flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-blendi-600 h-2.5 rounded-full" style="width: <?php echo $porcentaje_carta_configuracion_inicial; ?>%"></div>
                                    </div>
                                </div>
                                <div class="text-blendigray-50 text-center">
                                    <?php echo $porcentaje_carta_configuracion_inicial; ?>%
                                </div>
                                <div class="text-center">
                                    <a href="/admin/gestion-categorias" class="py-1 px-2 border border-1 border-blendi-600 text-blendi-600">Editar</a>
                                </div>
                            </div>
                            <?php
                        }
                        if ($porcentaje_datos_facturacion_configuracion_inicial != 100) {
                            ?>
                            <div class="grid md:grid-cols-7 p-2">
                                <div class="md:col-span-2">
                                    Datos de facturación
                                </div>
                                <div class="md:col-span-3 flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-blendi-600 h-2.5 rounded-full" style="width: <?php echo $porcentaje_datos_facturacion_configuracion_inicial; ?>%"></div>
                                    </div>
                                </div>
                                <div class="text-blendigray-50 text-center">
                                    <?php echo $porcentaje_datos_facturacion_configuracion_inicial; ?>%
                                </div>
                                <div class="text-center">
                                    <a href="/admin/gestion-datos_empresa" class="py-1 px-2 border border-1 border-blendi-600 text-blendi-600">Editar</a>
                                </div>
                            </div>
                            <?php
                        }
                        if ($porcentaje_usuarios_configuracion_inicial != 100) {
                            ?>
                            <div class="grid md:grid-cols-7 p-2">
                                <div class="md:col-span-2">
                                    Usuarios y permisos
                                </div>
                                <div class="md:col-span-3 flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-blendi-600 h-2.5 rounded-full" style="width: <?php echo $porcentaje_usuarios_configuracion_inicial; ?>%"></div>
                                    </div>
                                </div>
                                <div class="text-blendigray-50 text-center">
                                    <?php echo $porcentaje_usuarios_configuracion_inicial; ?>%
                                </div>
                                <div class="text-center">
                                    <a href="/admin/gestion-usuarios" class="py-1 px-2 border border-1 border-blendi-600 text-blendi-600">Editar</a>
                                </div>
                            </div>
                            <?php
                        }
                        if ($porcentaje_datos_personales_configuracion_inicial != 100) {
                            ?>
                            <div class="grid md:grid-cols-7 p-2">
                                <div class="md:col-span-2">
                                    Datos personales
                                </div>
                                <div class="md:col-span-3 flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-blendi-600 h-2.5 rounded-full" style="width: <?php echo $porcentaje_datos_personales_configuracion_inicial; ?>%"></div>
                                    </div>
                                </div>
                                <div class="text-blendigray-50 text-center">
                                    <?php echo $porcentaje_datos_personales_configuracion_inicial; ?>%
                                </div>
                                <div class="text-center">
                                    <a href="/admin/gestion-datos_empresa" class="py-1 px-2 border border-1 border-blendi-600 text-blendi-600">Editar</a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="hidden md:block md:col-span-1">&nbsp;</div>
                <?php
            }
            if (
                $total_mesas_primer_comedor < 2 ||
                $porcentaje_carta_configuracion_inicial != 100
            ) {
                ?>
                <div class="hidden md:block md:col-span-1">&nbsp;</div>
                <?php
            }
            if (
                $total_mesas_primer_comedor < 2
            ) {
                ?>
                <div class="md:col-span-5">
                    <div class="w-full mt-12 text-xl font-bold text-left dark:text-white">
                        MI SALA
                    </div>
                    <div class="grid grid-cols-6 mt-3 p-8 rounded-lg border border-1 border-blendigray-50 text-blendimodal-letra_blue bg-blendimodal-background_blue">
                        <div class="col-span-6 font-bold">Parece que tu sala aún está vacía...</div>
                        <div class="flex items-end col-span-4">
                            <a href="/admin/gestion-mesas" class="mt-20 py-1 px-2 border border-1 rounded border-blendimodal-letra_blue text-blendimodal-letra_blue flex space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <div>Configurar sala</div>
                            </a>
                        </div>
                        <div class="col-span-2">
                            <img src="/avatars/avatar18_sinbg.svg" title="MI SALA" alt="MI SALA" />
                        </div>
                    </div>
                </div>
                <?php
            }
            if (
                $porcentaje_carta_configuracion_inicial != 100
            ) {
                ?>
                <div class="md:col-span-5">
                    <div class="w-full mt-12 text-xl font-bold text-left dark:text-white">
                        MI CARTA
                    </div>
                    <div class="grid grid-cols-6 mt-3 p-8 rounded-lg border border-1 border-blendigray-50 text-gray-650 bg-blendimodal-background_orange">
                        <div class="col-span-6 font-bold">Crea tus productos y añádelos a la carta</div>
                        <div class="flex items-end col-span-4">
                            <a href="/admin/gestion-productos" class="mt-20 py-1 px-2 border border-1 rounded border-gray-650 text-gray-650 flex space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <div>Crear mi carta</div>
                            </a>
                        </div>
                        <div class="col-span-2">
                            <img src="/avatars/avatar5_sinbg.svg" title="MI CARTA" alt="MI CARTA" />
                        </div>
                    </div>
                </div>
                <?php
            }
            if (
                $total_mesas_primer_comedor < 2 &&
                $porcentaje_carta_configuracion_inicial != 100
            ) {
                ?>
                <div class="hidden md:block md:col-span-1">&nbsp;</div>
                <?php
            }
            if (
                ($total_mesas_primer_comedor < 2 && $porcentaje_carta_configuracion_inicial != 100) ||
                !($total_mesas_primer_comedor < 2 || $porcentaje_carta_configuracion_inicial != 100)
            ) {
                ?>
                <div class="hidden md:block md:col-span-1">&nbsp;</div>
                <?php
            }

            if (
                count($productos_por_grupo_home) > 0
            ) {
                ?>
                <div class="md:col-span-5">
                    <div class="w-full mt-12 text-xl font-bold text-left dark:text-white">
                        MI DESPENSA
                    </div>
                    <div class="grid grid-cols-8 items-center mt-3 p-8 rounded-lg border border-1 border-blendigray-50 text-gray-650 bg-blendimodal-background_orange">
                        <div class="col-span-6 font-bold">Sigue añadiendo productos</div>
                        <div class="col-span-2 font-bold">
                            <a href="/admin/gestion-productos" class="py-1 px-2 border border-1 rounded border-gray-650 text-gray-650 flex space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <div>Editar</div>
                            </a>
                        </div>
                        <?php
                        foreach ($productos_por_grupo_home as $productos_grupo) {
                            ?>
                            <div class="flex items-end col-span-8 py-2 border-b border-gray-650">
                                <div class="grow">
                                    <?php echo $productos_grupo->grupo; ?>
                                </div>
                                <div class="bg-white rounded-full p-1 text-sm">
                                    <?php echo $productos_grupo->productos; ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="md:col-span-5">
                    <div class="w-full mt-12 text-xl font-bold text-left dark:text-white">
                        GRUPOS
                    </div>
                    <div class="grid grid-cols-6 mt-3 p-8 rounded-lg border border-1 border-blendigray-50 text-gray-650 bg-blendimodal-background_orange">
                        <div class="col-span-6 font-bold">Crea grupos y asígnalos a categorías</div>
                        <div class="flex items-end col-span-4">
                            <a href="/admin/gestion-productos-grupos" class="mt-20 py-1 px-2 border border-1 rounded border-gray-650 text-gray-650 flex space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <div>Crear un grupo</div>
                            </a>
                        </div>
                        <div class="col-span-2">
                            <img src="/avatars/avatar4_sinbg.svg" title="GRUPOS" alt="GRUPOS" />
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="hidden md:block md:col-span-1">&nbsp;</div>
        </div>
    </div>
</main>
