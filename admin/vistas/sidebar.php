<div class="sidebar" id="sidebar">
    <div id="cerrarSidebar" class="bg-white">
        <img class="icono" src="<?php echo $host_base_sys; ?>icons/System/close-circle-line.svg" alt="My Happy SVG" onclick="sideBar('');" />
    </div>
    <div style="margin: 8px 18px 8px;">
        <strong>MENÚ PRINCIPAL</strong>
    </div>
    <?php
    if(!empty($id_usuario_sys)) {
        if($menu_clientes) {
            ?>
            <hr style="margin-left: 16px; margin-right: 16px;" />
            <a class="botones-apartados" onclick="collapseCapa('capa-clientes'); document.getElementById('capa_procesando').style.display = 'block';">
                <img class="icon bg-white" id="icono-collapse-capa-clientes" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
                Clientes
            </a>
            <div id="capa-clientes" class="capa-apartados">
                <?php
                if($clientes) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cli" class="botones-subapartados" title="Clientes" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Clientes
                    </a>
                    <?php
                }
                if($presupuestos_clientes) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Presupuestos
                    </a>
                    <?php
                }
                if($pedidos_clientes) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Pedidos
                    </a>
                    <?php
                }
                if($albaranes_clientes) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Albaranes
                    </a>
                    <?php
                }
                if($facturas_clientes) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Facturas
                    </a>
                    <?php
                }
                if($tiquets_clientes) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Tiquets
                    </a>
                    <?php
                }
                if($mesas) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-mesas" class="botones-subapartados" title="Mesas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Mesas
                    </a>
                    <?php
                }
                if($zonas) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-zonas" class="botones-subapartados" title="Zonas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Zonas
                    </a>
                    <?php
                }
                if($modalidades_envio) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_envio" class="botones-subapartados" title="Modalidades envío" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Modalidades envío
                    </a>
                    <?php
                }
                if($modalidades_entrega) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_entrega" class="botones-subapartados" title="Modalidades entrega" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Modalidades entrega
                    </a>
                    <?php
                }
                if($modalidades_pago) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_pago" class="botones-subapartados" title="Modalidades pago" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Modalidades pago
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }else {
            if($clientes) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cli" class="botones-subapartados" title="Clientes" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Clientes
                </a>
                <?php
            }
            if($presupuestos_clientes) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Presupuestos
                </a>
                <?php
            }
            if($pedidos_clientes) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Pedidos
                </a>
                <?php
            }
            if($albaranes_clientes) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Albaranes
                </a>
                <?php
            }
            if($facturas_clientes) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Facturas
                </a>
                <?php
            }
            if($tiquets_clientes) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Tiquets
                </a>
                <?php
            }
            if($mesas) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-mesas" class="botones-subapartados" title="Mesas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Mesas
                </a>
                <?php
            }
            if($zonas) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-zonas" class="botones-subapartados" title="Zonas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Zonas
                </a>
                <?php
            }
            if($modalidades_envio) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_envio" class="botones-subapartados" title="Modalidades envío" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Modalidades envío
                </a>
                <?php
            }
            if($modalidades_entrega) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_entrega" class="botones-subapartados" title="Modalidades entrega" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Modalidades entrega
                </a>
                <?php
            }
            if($modalidades_pago) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_pago" class="botones-subapartados" title="Modalidades pago" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Modalidades pago
                </a>
                <?php
            }
        }
        if($menu_proveedores) {
            ?>
            <hr style="margin-left: 16px; margin-right: 16px;" />
            <a class="botones-apartados" onclick="collapseCapa('capa-proveedores'); document.getElementById('capa_procesando').style.display = 'block';">
                <img class="icon bg-white" id="icono-collapse-capa-proveedores" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
                Proveedores
            </a>
            <div id="capa-proveedores" class="capa-apartados">
                <?php
                if($proveedores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=pro" class="botones-subapartados" title="Proveedores" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Proveedores
                    </a>
                    <?php
                }
                if($presupuestos_proveedores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Presupuestos proveedores" target="_blank">
                        Presupuestos
                    </a>
                    <?php
                }
                if($pedidos_proveedores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Pedidos
                    </a>
                    <?php
                }
                if($albaranes_proveedores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Albaranes
                    </a>
                    <?php
                }
                if($facturas_proveedores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Facturas
                    </a>
                    <?php
                }
                if($tiquets_proveedores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Tiquets
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }else {
            if($proveedores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=pro" class="botones-subapartados" title="Proveedores" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Proveedores
                </a>
                <?php
            }
            if($presupuestos_proveedores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Presupuestos
                </a>
                <?php
            }
            if($pedidos_proveedores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Pedidos
                </a>
                <?php
            }
            if($albaranes_proveedores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Albaranes
                </a>
                <?php
            }
            if($facturas_proveedores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Facturas
                </a>
                <?php
            }
            if($tiquets_proveedores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Tiquets
                </a>
                <?php
            }
        }
        if($menu_creditores) {
            ?>
            <hr style="margin-left: 16px; margin-right: 16px;" />
            <a class="botones-apartados" onclick="collapseCapa('capa-creditores'); document.getElementById('capa_procesando').style.display = 'block';">
                <img class="icon bg-white" id="icono-collapse-capa-creditores" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
                Creditores
            </a>
            <div id="capa-creditores" class="capa-apartados">
                <?php
                if($creditores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cre" class="botones-subapartados" title="Creditores" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Creditores
                    </a>
                    <?php
                }
                if($presupuestos_creditores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Presupuestos
                    </a>
                    <?php
                }
                if($pedidos_creditores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Pedidos
                    </a>
                    <?php
                }
                if($albaranes_creditores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Albaranes
                    </a>
                    <?php
                }
                if($facturas_creditores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Facturas
                    </a>
                    <?php
                }
                if($tiquets_creditores) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                        Tiquets
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }else {
            if($creditores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cre" class="botones-subapartados" title="Creditores" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Creditores
                </a>
                <?php
            }
            if($presupuestos_creditores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Presupuestos
                </a>
                <?php
            }
            if($pedidos_creditores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Pedidos
                </a>
                <?php
            }
            if($albaranes_creditores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Albaranes
                </a>
                <?php
            }
            if($facturas_creditores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Facturas
                </a>
                <?php
            }
            if($tiquets_creditores) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-subapartados" title="Documentos" target="_blank">
                    Tiquets
                </a>
                <?php
            }
        }
        if($menu_productos) {
            ?>
            <hr style="margin-left: 16px; margin-right: 16px;" />
            <a class="botones-apartados" onclick="collapseCapa('capa-productos'); document.getElementById('capa_procesando').style.display = 'block';">
                <img class="icon bg-white" id="icono-collapse-capa-productos" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
                Productos
            </a>
            <div id="capa-productos" class="capa-apartados">
                <?php
                if($productos) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" class="botones-subapartados" title="Productos" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Productos
                    </a>
                    <?php
                }
                if($categorias) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias" class="botones-subapartados" title="Categorías" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Categorías
                    </a>
                    <?php
                }
                if($categorias_elaborados) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias_elaborados" class="botones-subapartados" title="Categorías elaborados" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Categorías elaborados
                    </a>
                    <?php
                }
                if($detalles_productos) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles" class="botones-subapartados" title="Tarifas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Detalles productos
                    </a>
                    <?php
                }
                if($grupos) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-grupos" class="botones-subapartados" title="Grupos" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Grupos
                    </a>
                    <?php
                }
                if($menu_listados) {
                    ?>
                    <a class="botones-apartados" onclick="collapseCapa('capa-productos-listados');" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        <img class="icon bg-white" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
                        Listados
                    </a>
                    <div id="capa-productos-listados" class="capa-apartados">
                        <?php
                        if($stocks_listados) {
                            ?>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-stocks" class="botones-subapartados" title="Idiomas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                                Stocks
                            </a>
                            <?php
                        }
                        if($mas_vendidos_listados) {
                            ?>
                            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-mas-vendidos" class="botones-subapartados" title="Diccionario" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                                Más vendidos
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }else {
            if($productos) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" class="botones-subapartados" title="Productos" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Productos
                </a>
                <?php
            }
            if($categorias) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias" class="botones-subapartados" title="Categorías" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Categorías
                </a>
                <?php
            }
            if($categorias_elaborados) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias_elaborados" class="botones-subapartados" title="Categorías elaborados" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Categorías elaborados
                </a>
                <?php
            }
            if($detalles_productos) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles" class="botones-subapartados" title="Tarifas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Detalles productos
                </a>
                <?php
            }
            if($grupos) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-grupos" class="botones-subapartados" title="Grupos" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Grupos
                </a>
                <?php
            }
            if($menu_listados) {
                ?>
                <a class="botones-apartados" onclick="collapseCapa('capa-productos-listados');" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    <img class="icon bg-white" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
                    Listados
                </a>
                <div id="capa-productos-listados" class="capa-apartados">
                    <?php
                    if($stocks_listados) {
                        ?>
                        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-stocks" class="botones-subapartados" title="Idiomas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                            Stocks
                        </a>
                        <?php
                    }
                    if($mas_vendidos_listados) {
                        ?>
                        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-mas-vendidos" class="botones-subapartados" title="Diccionario" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                            Más vendidos
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
        }
        if($menu_general) {
            ?>
            <hr style="margin-left: 16px; margin-right: 16px;" />
            <a class="botones-apartados" onclick="collapseCapa('capa-general');" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                <img id="icono-collapse-capa-general" class="icon bg-white" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
                General
            </a>
            <div id="capa-general" class="capa-apartados">
                <?php
                if($tipos_iva) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-iva" class="botones-subapartados" title="Tipos IVA" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Tipos de IVA
                    </a>
                    <?php
                }
                if($tipos_irpf) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-irpf" class="botones-subapartados" title="Tipos IRPF" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Tipos de IRPF
                    </a>
                    <?php
                }
                if($bancos_cajas) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-bancos_cajas" class="botones-subapartados" title="Bancos y cajas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Bancos y cajas
                    </a>
                    <?php
                }
                if($tarifas) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tarifas" class="botones-subapartados" title="Tarifas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Tarifas
                    </a>
                    <?php
                }
                if($usuarios) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-usuarios" class="botones-subapartados" title="Idiomas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Usuarios
                    </a>
                    <?php
                }
                if($idiomas) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-idiomas" class="botones-subapartados" title="Idiomas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Idiomas
                    </a>
                    <?php
                }
                if($datos_empresa) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-datos_empresa/id_datos_empresa=1" class="botones-subapartados" title="Datos empresa" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Datos empresa
                    </a>
                    <?php
                }
                if($impresion_documentos) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-impresion_documentos" class="botones-subapartados" title="Impresión documentos" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Impresión documentos
                    </a>
                    <?php
                }
                if($iconos) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-iconos" class="botones-subapartados" title="Iconos" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                        Iconos
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }else {
            if($categorias) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias" class="botones-subapartados" title="Categorías" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Categorías
                </a>
                <?php
            }
            if($detalles_productos) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles" class="botones-subapartados" title="Tarifas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Detalles productos
                </a>
                <?php
            }
            if($tipos_iva) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-iva" class="botones-subapartados" title="Tipos IVA" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Tipos de IVA
                </a>
                <?php
            }
            if($tipos_irpf) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-irpf" class="botones-subapartados" title="Tipos IRPF" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Tipos de IRPF
                </a>
                <?php
            }
            if($bancos_cajas) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-bancos_cajas" class="botones-subapartados" title="Bancos y cajas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Bancos y cajas
                </a>
                <?php
            }
            if($tarifas) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tarifas" class="botones-subapartados" title="Tarifas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Tarifas
                </a>
                <?php
            }
            if($usuarios) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-usuarios" class="botones-subapartados" title="Idiomas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Usuarios
                </a>
                <?php
            }
            if($idiomas) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-idiomas" class="botones-subapartados" title="Idiomas" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Idiomas
                </a>
                <?php
            }
            if($datos_empresa) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-datos_empresa/id_datos_empresa=1" class="botones-subapartados" title="Datos empresa" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Datos empresa
                </a>
                <?php
            }
            if($impresion_documentos) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-impresion_documentos" class="botones-subapartados" title="Impresión documentos" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Impresión documentos
                </a>
                <?php
            }
            if($iconos) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-iconos" class="botones-subapartados" title="Iconos" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                    Iconos
                </a>
                <?php
            }
        }
        ?>
        <hr style="margin-left: 16px; margin-right: 16px;" />
        <?php
        $select_sys = "registros";
        require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-select-php.php");
        if($registros_sys > 1) {
            ?>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/usuarios-inicio" class="botones-apartados" title="Categorías" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
                Cambio usuario
            </a>
            <hr style="margin-left: 16px; margin-right: 16px;" />
            <?php
        }
    }
    ?>

    <a class="botones-apartados" onclick="cerrarSesion();" onclick="document.getElementById('main').style.display = 'none'; document.getElementById('capa_procesando').style.display = 'block';">
        Cerrar sesión
    </a>
    <hr style="margin-left: 16px; margin-right: 16px;" />
</div>