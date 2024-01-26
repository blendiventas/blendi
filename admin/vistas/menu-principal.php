<?php
if(!empty($id_usuario_sys)) {
echo "******************************************************************************************************************";
    $menu_nivel = "raiz";
    if($path_url_sys[0] == "menu-gestor") {
        $menu_nivel = "menu-gestor";
    }else if($path_url_sys[0] == "menu-clientes") {
        $menu_nivel = "menu-clientes";
    }else if($path_url_sys[0] == "menu-proveedores") {
        $menu_nivel = "menu-proveedores";
    }else if($path_url_sys[0] == "menu-creditores") {
        $menu_nivel = "menu-creditores";
    }else if($path_url_sys[0] == "menu-productos") {
        $menu_nivel = "menu-productos";
    }else if($path_url_sys[0] == "menu-stock") {
        $menu_nivel = "menu-stock";
    }else if($path_url_sys[0] == "menu-listados") {
        $menu_nivel = "menu-listados";
    }else if($path_url_sys[0] == "menu-general") {
        $menu_nivel = "menu-general";
    }else if($path_url_sys[0] == "menu-pendientes") {
        $menu_nivel = "menu-pendientes";
    }

    if($menu_nivel == "raiz") {
        require("menus/".$sector."/menu-raiz.php");
    }else if($menu_nivel == "menu-gestor") {
        require("menus/".$sector."/menu-gestor.php");
    }else if($menu_nivel == "menu-clientes") {
        require("menus/".$sector."/menu-clientes.php");
    }else if($menu_nivel == "menu-proveedores") {
        require("menus/".$sector."/menu-proveedores.php");
    }else if($menu_nivel == "menu-creditores") {
        require("menus/".$sector."/menu-creditores.php");
    }else if($menu_nivel == "menu-productos") {
        require("menus/".$sector."/menu-productos.php");
    }else if($menu_nivel == "menu-stock") {
        require("menus/".$sector."/menu-stock.php");
    }else if($menu_nivel == "menu-listados") {
        require("menus/".$sector."/menu-listados.php");
    }else if($menu_nivel == "menu-general") {
        require("menus/".$sector."/menu-general.php");
    }else if($menu_nivel == "menu-pendientes") {
        require("menus/".$sector."/menu-pendientes.php");
    }
    /*
    Clientes	Clientes
                Presupuestos
                Pedidos
                Albaranes
                Facturas
                Tiquets
                Mesas
                Zonas
                Modalidades envio
                Modalidades entrega
                Modalidades pago
    Proveedores	Proveedores
                Presupuestos
                Pedidos
                Albaranes
                Facturas
                Tiquets
    Creditores	Creditores
                Presupuestos
                Pedidos
                Albaranes
                Facturas
                Tiquets
    Productos	Productos
                Categorias
                Categorias elaborados
                Detalles productos
                Grupos
                Listados	Stocks
                            Mas vendidos
    General	    Tipos de IVA
                Tipos de IRPF
                Bancos y cajas
                Tarifas
                Usuarios
                Idiomas
                Datos empresa
                Impresion documentos
                Iconos
    Cerrar sesion
    */
}
?>
<div style="bottom: 10%;
    position: absolute;
    margin-left: 40%;
    width: 20%;">
    <a class="botones-apartados" onclick="cerrarSesion();">
        Cerrar sesión
    </a>
</div>