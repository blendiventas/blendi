<?php
if($tiquets_clientes_usuarios_permisos || $recepcion_pedidos_permisos) {
    if (empty($id_panel_sys) && !empty($id_panel)) {
        $id_panel_sys = $id_panel;
    }
    $select_sys = "listado-filtrado-activos";
    require($_SERVER['DOCUMENT_ROOT']."/admin/terminales/gestion/datos-select-php.php");
    if(isset($matriz_id_terminales) && count($matriz_id_terminales) > 1) {
        ?>
        <div class="flex items-center">
            <select id="id_terminal" name="id_terminal" onchange="establecerTerminal(this.value);" required style="margin: 0 auto;">
                <option value="0">Terminal por defecto</option>
                <?php
                foreach ($matriz_id_terminales as $key_id_terminales => $valor_id_terminales) {
                    $selected_sys = "";
                    if($valor_id_terminales == $id_terminal_sys) {
                        $selected_sys = " selected";
                    }
                    if($terminales_de_acceso == -1 || ($terminales_de_acceso != -1 && $selected_sys == " selected")) {
                        ?>
                        <option value="<?php echo $valor_id_terminales; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_descripcion_terminales[$key_id_terminales]; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <?php
        unset($matriz_id_terminales);
        unset($matriz_descripcion_terminales);
    }else {
        ?>
        <input type="hidden" name="id_terminal" id="id_terminal" value="1">
        <?php
    }
}
?>
<div class="flex items-center justify-center mt-3">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
    </svg>
    <label for="toggle_dark_mode" class="inline-flex relative items-center cursor-pointer">
        <input type="checkbox" name="dark_mode" value="1" id="toggle_dark_mode" <?php echo ($darkMode)? 'checked' : ''; ?> class="sr-only peer" onchange="toggleDarkMode()">
        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blendi-600"></div>
    </label>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
    </svg>
</div>
<?php
if(isset($clientes_usuarios_permisos) && ($clientes_usuarios_permisos || $presupuestos_clientes_usuarios_permisos || $pedidos_clientes_usuarios_permisos || $albaranes_clientes_usuarios_permisos || $facturas_clientes_usuarios_permisos || $tiquets_clientes_usuarios_permisos || $mesas_usuarios_permisos)) {
    ?>
    <div class="pt-3 px-4 text-sm flex cursor-pointer" onclick="collapseMenu('capa_menu_clientes')">
        <div class="font-bold grow">Clientes</div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="capa_menu_clientes-show">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="capa_menu_clientes-hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <ul class="py-1 ml-3 text-sm text-gray-700 dark:text-gray-200 hidden" id="capa_menu_clientes">
        <?php
        if($clientes_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cli" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Clientes">
                    Fichas de clientes
                </a>
            </li>
            <?php
        }
        if($mesas_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-mesas" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Mesas" >
                    Editor de mesas
                </a>
            </li>
            <?php
        }
        if($presupuestos_clientes_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Presupuestos clientes">
                    Presupuestos
                </a>
            </li>
            <?php
        }
        if($pedidos_clientes_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Pedidos clientes">
                    Pedidos
                </a>
            </li>
            <?php
        }
        if($albaranes_clientes_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Albaranes clientes">
                    Albaranes
                </a>
            </li>
            <?php
        }
        if($facturas_clientes_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Facturas clientes">
                    Facturas
                </a>
            </li>
            <?php
        }
        if($tiquets_clientes_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Tiquets clientes">
                    <!-- <a href="#" class="block py-2 px-4" title="Tiquets clientes" onclick="FullScreenMode('<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio')"> -->
                    <!--<a href="#" class="block py-2 px-4" title="Tiquets clientes" onclick="goFullscreen();">-->
                    Tiquets
                </a>
            </li>
            <?php
        }
        if($clientes_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-grupos_clientes" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Grupos de clientes">
                    Grupos de clientes
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
}
if(isset($proveedores_usuarios_permisos) && ($proveedores_usuarios_permisos || $presupuestos_proveedores_usuarios_permisos || $pedidos_proveedores_usuarios_permisos || $albaranes_proveedores_usuarios_permisos || $facturas_proveedores_usuarios_permisos || $tiquets_proveedores_usuarios_permisos)) {
    ?>
    <div class="pt-3 px-4 text-sm flex cursor-pointer" onclick="collapseMenu('capa_menu_compras')">
        <div class="font-bold grow">Compras</div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="capa_menu_compras-show">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="capa_menu_compras-hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <ul class="py-1 ml-3 text-sm text-gray-700 dark:text-gray-200 hidden" id="capa_menu_compras">
        <?php
        if($proveedores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=pro" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Proveedores">
                    Fichas de proveedores
                </a>
            </li>
            <?php
        }
        if($presupuestos_proveedores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Presupuestos proveedores">
                    Presupuestos
                </a>
            </li>
            <?php
        }
        if($pedidos_proveedores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Pedidos proveedores">
                    Pedidos
                </a>
            </li>
            <?php
        }
        if($albaranes_proveedores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Albaranes proveedores">
                    Albaranes
                </a>
            </li>
            <?php
        }
        if($facturas_proveedores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Facturas proveedores">
                    Facturas
                </a>
            </li>
            <?php
        }
        if($tiquets_proveedores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Tiquets proveedores">
                    Tiquets
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
}
if(isset($creditores_usuarios_permisos) && ($creditores_usuarios_permisos || $presupuestos_creditores_usuarios_permisos || $pedidos_creditores_usuarios_permisos || $albaranes_creditores_usuarios_permisos || $facturas_creditores_usuarios_permisos || $tiquets_creditores_usuarios_permisos)) {
    ?>
    <div class="pt-3 px-4 text-sm flex cursor-pointer" onclick="collapseMenu('capa_menu_gastos')">
        <div class="font-bold grow">Gastos</div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="capa_menu_gastos-show">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="capa_menu_gastos-hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <ul class="py-1 ml-3 text-sm text-gray-700 dark:text-gray-200 hidden" id="capa_menu_gastos">
        <?php
        if($creditores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cre" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Creditores">
                    Fichas de creditores
                </a>
            </li>
            <?php
        }
        if($presupuestos_creditores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Presupuestos creditores">
                    Presupuestos
                </a>
            </li>
            <?php
        }
        if($pedidos_creditores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Pedidos creditores">
                    Pedidos
                </a>
            </li>
            <?php
        }
        if($albaranes_creditores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Albaranes creditores">
                    Albaranes
                </a>
            </li>
            <?php
        }
        if($facturas_creditores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Facturas creditores">
                    Facturas
                </a>
            </li>
            <?php
        }
        if($tiquets_creditores_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Tiquets creditores">
                    Tiquets
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
}
if(isset($productos_usuarios_permisos) && ($productos_usuarios_permisos || $categorias_usuarios_permisos || $grupos_productos_usuarios_permisos || $categorias_elaborados_usuarios_permisos || $detalles_productos_usuarios_permisos || $mas_vendidos_listados_usuarios_permisos || $stocks_listados_usuarios_permisos || $tarifas_usuarios_permisos)) {
    ?>
    <div class="pt-3 px-4 text-sm flex cursor-pointer" onclick="collapseMenu('capa_menu_productos')">
        <div class="font-bold grow">Productos</div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="capa_menu_productos-show">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="capa_menu_productos-hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <ul class="py-1 ml-3 text-sm text-gray-700 dark:text-gray-200 hidden" id="capa_menu_productos">
        <?php
        if($productos_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Productos">
                    Productos
                </a>
            </li>
            <?php
        }
        if($categorias_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Categorías">
                    Categorías
                </a>
            </li>
            <?php
        }
        if($grupos_productos_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-grupos" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Grupos">
                    Grupos
                </a>
            </li>
            <?php
        }
        if($categorias_elaborados_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias_elaborados" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Categorías elaborados">
                    Categorías elaborados
                </a>
            </li>
            <?php
        }
        if($tarifas_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tarifas" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Tarifas">
                    Tarifas
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
}
if ($id_usuario == 1) {
    ?>
    <div class="pt-3 px-4 text-sm flex cursor-pointer" onclick="collapseMenu('capa_menu_contabilidad')">
        <div class="font-bold grow">Listados</div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="capa_menu_contabilidad-show">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="capa_menu_contabilidad-hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <ul class="py-1 ml-3 text-sm text-gray-700 dark:text-gray-200 hidden" id="capa_menu_contabilidad">
        <li>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-listados-iva" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="IVA">
                IVA
            </a>
        </li>
        <?php
        if (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca' && $sector != 'comercio')) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-listados-es" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Entradas / Salidas">
                    Entradas / Salidas
                </a>
            </li>
            <?php
        }
        ?>
        <li>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-listados-mails" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Mails">
                Mails
            </a>
        </li>
        <li>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-listados-notificaciones-stock" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Notificaciones Stock">
                Notificaciones Stock
            </a>
        </li>
    </ul>
    <?php
}
if(isset($modalidades_pago_usuarios_permisos) && ($modalidades_pago_usuarios_permisos || $modalidades_pago_usuarios_permisos || $bancos_cajas_usuarios_permisos || $usuarios_usuarios_permisos || $datos_empresa_usuarios_permisos || $impresion_documentos_usuarios_permisos || $tipos_iva_usuarios_permisos || $tipos_irpf_usuarios_permisos || $zonas_usuarios_permisos || $modalidades_envio_usuarios_permisos || $modalidades_entrega_usuarios_permisos || $terminales_permisos)) {
    ?>
    <div class="pt-3 px-4 text-sm flex cursor-pointer" onclick="collapseMenu('capa_menu_configuraciones')">
        <div class="font-bold grow">Settings</div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="capa_menu_configuraciones-show">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="capa_menu_configuraciones-hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <ul class="py-1 ml-3 text-sm text-gray-700 dark:text-gray-200 hidden" id="capa_menu_configuraciones">
        <?php
        if($id_usuario == 1 || $usuarios_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-suscripcion" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Suscripción">
                    Suscripción
                </a>
            </li>
            <?php
        }
        if($modalidades_pago_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_pago" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Modalidades pago">
                    Modalidades pago
                </a>
            </li>
            <?php
        }
        if($modalidades_pago_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-metodos_pago" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Métodos pago">
                    Métodos pago
                </a>
            </li>
            <?php
            if (isset($sector) && ($sector != 'restauracion' && $sector != 'discoteca' && $sector != 'comercio')) {
                ?>
                <li>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-metodos_pago_bans" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Métodos pago bans">
                        Métodos pago bans
                    </a>
                </li>
                <?php
            }
        }
        if($bancos_cajas_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-bancos_cajas" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Bancos y cajas">
                    Bancos y cajas
                </a>
            </li>
            <?php
        }
        if($usuarios_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-usuarios" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Usuarios">
                    Usuarios
                </a>
            </li>
            <?php
        }
        if($datos_empresa_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-datos_empresa" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Datos empresa">
                    Datos empresa
                </a>
            </li>
            <?php
        }
        if($impresion_documentos_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-impresion_documentos" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Impresión documentos">
                    Impresión documentos
                </a>
            </li>
            <?php
        }
        if($tipos_iva_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-iva" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Tipos IVA">
                    Tipos de IVA
                </a>
            </li>
            <?php
        }
        if($tipos_irpf_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-irpf" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Tipos IRPF">
                    Tipos de IRPF
                </a>
            </li>
            <?php
        }
        if($zonas_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-zonas" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Zonas">
                    Zonas
                </a>
            </li>
            <?php
        }
        if($modalidades_envio_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_envio" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Modalidades envío">
                    Modalidades envío
                </a>
            </li>
            <?php
        }
        if($modalidades_entrega_usuarios_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_entrega" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Modalidades entrega">
                    Modalidades entrega
                </a>
            </li>
            <?php
        }
        if($terminales_permisos) {
            ?>
            <li>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-datos_terminales" onclick="if (typeof idDocumento != 'undefined' && idDocumento > 0) { return cerrarDocumento(); } else { return true; }" class="block py-2 px-4" title="Terminales">
                    Terminales
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
}
