<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_usuarios = filter_input(INPUT_POST, 'id_usuarios', FILTER_SANITIZE_NUMBER_INT);

if($select_sys == "guardar-permisos") {
    $menu_clientes_usuarios_permisos = filter_input(INPUT_POST, 'menu_clientes', FILTER_SANITIZE_NUMBER_INT);
    $clientes_usuarios_permisos = filter_input(INPUT_POST, 'clientes', FILTER_SANITIZE_NUMBER_INT);
    $presupuestos_clientes_usuarios_permisos = filter_input(INPUT_POST, 'presupuestos_clientes', FILTER_SANITIZE_NUMBER_INT);
    $pedidos_clientes_usuarios_permisos = filter_input(INPUT_POST, 'pedidos_clientes', FILTER_SANITIZE_NUMBER_INT);
    $albaranes_clientes_usuarios_permisos = filter_input(INPUT_POST, 'albaranes_clientes', FILTER_SANITIZE_NUMBER_INT);
    $facturas_clientes_usuarios_permisos = filter_input(INPUT_POST, 'facturas_clientes', FILTER_SANITIZE_NUMBER_INT);
    $tiquets_clientes_usuarios_permisos = filter_input(INPUT_POST, 'tiquets_clientes', FILTER_SANITIZE_NUMBER_INT);
    $mesas_usuarios_permisos = filter_input(INPUT_POST, 'mesas', FILTER_SANITIZE_NUMBER_INT);
    $zonas_usuarios_permisos = filter_input(INPUT_POST, 'zonas', FILTER_SANITIZE_NUMBER_INT);
    $modalidades_envio_usuarios_permisos = filter_input(INPUT_POST, 'modalidades_envio', FILTER_SANITIZE_NUMBER_INT);
    $modalidades_entrega_usuarios_permisos = filter_input(INPUT_POST, 'modalidades_entrega', FILTER_SANITIZE_NUMBER_INT);
    $modalidades_pago_usuarios_permisos = filter_input(INPUT_POST, 'modalidades_pago', FILTER_SANITIZE_NUMBER_INT);
    $menu_proveedores_usuarios_permisos = filter_input(INPUT_POST, 'menu_proveedores', FILTER_SANITIZE_NUMBER_INT);
    $proveedores_usuarios_permisos = filter_input(INPUT_POST, 'proveedores', FILTER_SANITIZE_NUMBER_INT);
    $presupuestos_proveedores_usuarios_permisos = filter_input(INPUT_POST, 'presupuestos_proveedores', FILTER_SANITIZE_NUMBER_INT);
    $pedidos_proveedores_usuarios_permisos = filter_input(INPUT_POST, 'pedidos_proveedores', FILTER_SANITIZE_NUMBER_INT);
    $albaranes_proveedores_usuarios_permisos = filter_input(INPUT_POST, 'albaranes_proveedores', FILTER_SANITIZE_NUMBER_INT);
    $facturas_proveedores_usuarios_permisos = filter_input(INPUT_POST, 'facturas_proveedores', FILTER_SANITIZE_NUMBER_INT);
    $tiquets_proveedores_usuarios_permisos = filter_input(INPUT_POST, 'tiquets_proveedores', FILTER_SANITIZE_NUMBER_INT);
    $menu_creditores_usuarios_permisos = filter_input(INPUT_POST, 'menu_creditores', FILTER_SANITIZE_NUMBER_INT);
    $creditores_usuarios_permisos = filter_input(INPUT_POST, 'creditores', FILTER_SANITIZE_NUMBER_INT);
    $presupuestos_creditores_usuarios_permisos = filter_input(INPUT_POST, 'presupuestos_creditores', FILTER_SANITIZE_NUMBER_INT);
    $pedidos_creditores_usuarios_permisos = filter_input(INPUT_POST, 'pedidos_creditores', FILTER_SANITIZE_NUMBER_INT);
    $albaranes_creditores_usuarios_permisos = filter_input(INPUT_POST, 'albaranes_creditores', FILTER_SANITIZE_NUMBER_INT);
    $facturas_creditores_usuarios_permisos = filter_input(INPUT_POST, 'facturas_creditores', FILTER_SANITIZE_NUMBER_INT);
    $tiquets_creditores_usuarios_permisos = filter_input(INPUT_POST, 'tiquets_creditores', FILTER_SANITIZE_NUMBER_INT);
    $menu_productos_usuarios_permisos = filter_input(INPUT_POST, 'menu_productos', FILTER_SANITIZE_NUMBER_INT);
    $productos_usuarios_permisos = filter_input(INPUT_POST, 'productos', FILTER_SANITIZE_NUMBER_INT);
    $categorias_usuarios_permisos = filter_input(INPUT_POST, 'categorias', FILTER_SANITIZE_NUMBER_INT);
    $detalles_productos_usuarios_permisos = filter_input(INPUT_POST, 'detalles_productos', FILTER_SANITIZE_NUMBER_INT);
    $categorias_elaborados_usuarios_permisos = filter_input(INPUT_POST, 'categorias_elaborados', FILTER_SANITIZE_NUMBER_INT);
    $grupos_usuarios_permisos = filter_input(INPUT_POST, 'grupos', FILTER_SANITIZE_NUMBER_INT);
    $menu_listados_usuarios_permisos = filter_input(INPUT_POST, 'menu_listados', FILTER_SANITIZE_NUMBER_INT);
    $stocks_listados_usuarios_permisos = filter_input(INPUT_POST, 'stocks_listados', FILTER_SANITIZE_NUMBER_INT);
    $mas_vendidos_listados_usuarios_permisos = filter_input(INPUT_POST, 'mas_vendidos_listados', FILTER_SANITIZE_NUMBER_INT);
    $recepcion_pedidos_permisos = filter_input(INPUT_POST, 'recepcion_pedidos', FILTER_SANITIZE_NUMBER_INT);
    $menu_general_usuarios_permisos = filter_input(INPUT_POST, 'menu_general', FILTER_SANITIZE_NUMBER_INT);
    $tipos_iva_usuarios_permisos = filter_input(INPUT_POST, 'tipos_iva', FILTER_SANITIZE_NUMBER_INT);
    $tipos_irpf_usuarios_permisos = filter_input(INPUT_POST, 'tipos_irpf', FILTER_SANITIZE_NUMBER_INT);
    $bancos_cajas_usuarios_permisos = filter_input(INPUT_POST, 'bancos_cajas', FILTER_SANITIZE_NUMBER_INT);
    $tarifas_usuarios_permisos = filter_input(INPUT_POST, 'tarifas', FILTER_SANITIZE_NUMBER_INT);
    $usuarios_usuarios_permisos = filter_input(INPUT_POST, 'usuarios', FILTER_SANITIZE_NUMBER_INT);
    $idiomas_usuarios_permisos = filter_input(INPUT_POST, 'idiomas', FILTER_SANITIZE_NUMBER_INT);
    $datos_empresa_usuarios_permisos = filter_input(INPUT_POST, 'datos_empresa', FILTER_SANITIZE_NUMBER_INT);
    $impresion_documentos_usuarios_permisos = filter_input(INPUT_POST, 'datos_empresa', FILTER_SANITIZE_NUMBER_INT);
    $iconos_usuarios_permisos = filter_input(INPUT_POST, 'iconos', FILTER_SANITIZE_NUMBER_INT);
    $gestor_permisos = filter_input(INPUT_POST, 'gestor', FILTER_SANITIZE_NUMBER_INT);
    $terminales_permisos = filter_input(INPUT_POST, 'terminales', FILTER_SANITIZE_NUMBER_INT);
}else if($select_sys == "guardar-dark-mode") {
    $dark_usuarios = $_POST['dark_mode'];
}else {
    $id_idioma_usuarios = filter_input(INPUT_POST, 'id_idioma_usuarios', FILTER_SANITIZE_NUMBER_INT);
    if (empty($id_idioma_usuarios)) {
        $id_idioma_usuarios = 4;
    }
    $usuario_usuarios = filter_input(INPUT_POST, 'usuario_usuarios', FILTER_SANITIZE_STRING);
    $password_usuarios = filter_input(INPUT_POST, 'password_usuarios', FILTER_SANITIZE_STRING);
    $permisos_usuarios = filter_input(INPUT_POST, 'permisos_usuarios', FILTER_SANITIZE_STRING);
    $id_terminal_usuarios = filter_input(INPUT_POST, 'id_terminal_usuarios', FILTER_SANITIZE_NUMBER_INT);
    $id_empresa_usuarios = filter_input(INPUT_POST, 'id_empresa_usuarios', FILTER_SANITIZE_NUMBER_INT);
    if (empty($id_empresa_usuarios)) {
        $id_empresa_usuarios = -1;
    }
    $id_comercial_usuarios = filter_input(INPUT_POST, 'id_comercial_usuarios', FILTER_SANITIZE_NUMBER_INT);
    $bloqueo_usuarios = filter_input(INPUT_POST, 'activo_usuarios', FILTER_SANITIZE_NUMBER_INT);
    $dark_usuarios = filter_input(INPUT_POST, 'dark_usuarios', FILTER_SANITIZE_NUMBER_INT);
    $avatar_usuarios = filter_input(INPUT_POST, 'avatar_usuarios', FILTER_SANITIZE_NUMBER_INT);
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-update-php.php");