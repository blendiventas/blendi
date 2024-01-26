<?php
$disabled = " disabled";
if($id_url != 1) {
    $select_sys = "editar-ficha-permisos";
    require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-select-php.php");

    $disabled = "";
}else {
    $menu_clientes_usuarios_permisos = 1;
    $clientes_usuarios_permisos = 1;
    $presupuestos_clientes_usuarios_permisos = 1;
    $pedidos_clientes_usuarios_permisos = 1;
    $albaranes_clientes_usuarios_permisos = 1;
    $facturas_clientes_usuarios_permisos = 1;
    $tiquets_clientes_usuarios_permisos = 1;
    $mesas_usuarios_permisos = 1;
    $zonas_usuarios_permisos = 1;
    $modalidades_envio_usuarios_permisos = 1;
    $modalidades_entrega_usuarios_permisos = 1;
    $modalidades_pago_usuarios_permisos = 1;
    $menu_proveedores_usuarios_permisos = 1;
    $proveedores_usuarios_permisos = 1;
    $presupuestos_proveedores_usuarios_permisos = 1;
    $pedidos_proveedores_usuarios_permisos = 1;
    $albaranes_proveedores_usuarios_permisos = 1;
    $facturas_proveedores_usuarios_permisos = 1;
    $tiquets_proveedores_usuarios_permisos = 1;
    $menu_creditores_usuarios_permisos = 1;
    $creditores_usuarios_permisos = 1;
    $presupuestos_creditores_usuarios_permisos = 1;
    $pedidos_creditores_usuarios_permisos = 1;
    $albaranes_creditores_usuarios_permisos = 1;
    $facturas_creditores_usuarios_permisos = 1;
    $tiquets_creditores_usuarios_permisos = 1;
    $menu_productos_usuarios_permisos = 1;
    $productos_usuarios_permisos = 1;
    $categorias_usuarios_permisos = 1;
    $categorias_elaborados_usuarios_permisos = 1;
    $detalles_productos_usuarios_permisos = 1;
    $grupos_productos_usuarios_permisos = 1;
    $menu_listados_usuarios_permisos = 1;
    $stocks_listados_usuarios_permisos = 1;
    $mas_vendidos_listados_usuarios_permisos = 1;
    $recepcion_pedidos = 1;
    $menu_general_usuarios_permisos = 1;
    $tipos_iva_usuarios_permisos = 1;
    $tipos_irpf_usuarios_permisos = 1;
    $bancos_cajas_usuarios_permisos = 1;
    $tarifas_usuarios_permisos = 1;
    $usuarios_usuarios_permisos = 1;
    $idiomas_usuarios_permisos = 1;
    $datos_empresa_usuarios_permisos = 1;
    $impresion_documentos_usuarios_permisos = 1;
    $iconos_usuarios_permisos = 1;
    $gestor = 1;
}
if($menu_clientes_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="usuario_usuarios">Plantilla de permisos:</label><br>
        <select name="permisos_usuarios" id="permisos_usuarios" onchange="modificarPermisosPorCargo()">
            <option value="" selected>Seleccionar</option>
            <option value="1">Gerente</option>
            <option value="2">Barra</option>
            <option value="3">Camarero</option>
            <option value="4">Cocina</option>
        </select>
    </div>
</div>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">CLIENTES:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="menu_clientes" value="1" id="menu_clientes_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="menu_clientes" value="0" id="menu_clientes_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($clientes_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Fichas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="clientes" value="1" id="clientes_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="clientes" value="0" id="clientes_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($presupuestos_clientes_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Presupuestos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="presupuestos_clientes" value="1" id="presupuestos_clientes_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="presupuestos_clientes" value="0" id="presupuestos_clientes_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($pedidos_clientes_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Pedidos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="pedidos_clientes" value="1" id="pedidos_clientes_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="pedidos_clientes" value="0" id="pedidos_clientes_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($albaranes_clientes_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Albaranes:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="albaranes_clientes" value="1" id="albaranes_clientes_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="albaranes_clientes" value="0" id="albaranes_clientes_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($facturas_clientes_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Facturas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="facturas_clientes" value="1" id="facturas_clientes_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="facturas_clientes" value="0" id="facturas_clientes_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($tiquets_clientes_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Tiquets:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="tiquets_clientes" value="1" id="tiquets_clientes_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="tiquets_clientes" value="0" id="tiquets_clientes_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($mesas_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Mesas/Comedores:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="mesas" value="1" id="mesas_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="mesas" value="0" id="mesas_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($zonas_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Zonas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="zonas" value="1" id="zonas_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="zonas" value="0" id="zonas_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($modalidades_envio_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Modalidades envio:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="modalidades_envio" value="1" id="modalidades_envio_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="modalidades_envio" value="0" id="modalidades_envio_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($modalidades_entrega_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Modalidades entrega:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="modalidades_entrega" value="1" id="modalidades_entrega_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="modalidades_entrega" value="0" id="modalidades_entrega_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($modalidades_pago_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Modalidades pago:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="modalidades_pago" value="1" id="modalidades_pago_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="modalidades_pago" value="0" id="modalidades_pago_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<hr class='mt-3 mb-3' />
<?php
if($menu_proveedores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">PROVEEDORES:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="menu_proveedores" value="1" id="menu_proveedores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="menu_proveedores" value="0" id="menu_proveedores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($proveedores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Fichas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="proveedores" value="1" id="proveedores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="proveedores" value="0" id="proveedores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($presupuestos_proveedores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Presupuestos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="presupuestos_proveedores" value="1" id="presupuestos_proveedores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="presupuestos_proveedores" value="0" id="presupuestos_proveedores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($pedidos_proveedores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Pedidos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="pedidos_proveedores" value="1" id="pedidos_proveedores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="pedidos_proveedores" value="0" id="pedidos_proveedores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($albaranes_proveedores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Albaranes:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="albaranes_proveedores" value="1" id="albaranes_proveedores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="albaranes_proveedores" value="0" id="albaranes_proveedores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($facturas_proveedores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Facturas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="facturas_proveedores" value="1" id="facturas_proveedores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="facturas_proveedores" value="0" id="facturas_proveedores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($tiquets_proveedores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Tiquets:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="tiquets_proveedores" value="1" id="tiquets_proveedores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="tiquets_proveedores" value="0" id="tiquets_proveedores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<hr class='mt-3 mb-3' />
<?php
if($menu_creditores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">CREDITORES:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="menu_creditores" value="1" id="menu_creditores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="menu_creditores" value="0" id="menu_creditores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($creditores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Ficha:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="creditores" value="1" id="creditores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="creditores" value="0" id="creditores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($presupuestos_creditores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Presupuestos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="presupuestos_creditores" value="1" id="presupuestos_creditores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="presupuestos_creditores" value="0" id="presupuestos_creditores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($pedidos_creditores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Pedidos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="pedidos_creditores" value="1" id="pedidos_creditores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="pedidos_creditores" value="0" id="pedidos_creditores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($albaranes_creditores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Albaranes:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="albaranes_creditores" value="1" id="albaranes_creditores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="albaranes_creditores" value="0" id="albaranes_creditores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($facturas_creditores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Facturas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="facturas_creditores" value="1" id="facturas_creditores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="facturas_creditores" value="0" id="facturas_creditores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($tiquets_creditores_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Tiquets:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="tiquets_creditores" value="1" id="tiquets_creditores_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="tiquets_creditores" value="0" id="tiquets_creditores_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($menu_productos_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">PRODUCTOS:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="menu_productos" value="1" id="menu_productos_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="menu_productos" value="0" id="menu_productos_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($productos_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Fichas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="productos" value="1" id="productos_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="productos" value="0" id="productos_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($categorias_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Categorias:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="categorias" value="1" id="categorias_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="categorias" value="0" id="categorias_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($categorias_elaborados_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
    <div class="grid grid-cols-3 mt-3 items-center space-x-3">
        <div class="text-left">Categorias elaborados:</div>
        <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="categorias_elaborados" value="1" id="categorias_elaborados_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="categorias_elaborados" value="0" id="categorias_elaborados_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
    </div>
<?php
if($detalles_productos_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Detalles:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="detalles_productos" value="1" id="detalles_productos_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="detalles_productos" value="0" id="detalles_productos_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($grupos_productos_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
    <div class="grid grid-cols-3 mt-3 items-center space-x-3">
        <div class="text-left">Grupos:</div>
        <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="grupos" value="1" id="grupos_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="grupos" value="0" id="grupos_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
    </div>
<?php
if($menu_listados_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">LISTADOS:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="menu_listados" value="1" id="menu_listados_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="menu_listados" value="0" id="menu_listados_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($stocks_listados_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Stocks:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="stocks_listados" value="1" id="stocks_listados_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="stocks_listados" value="0" id="stocks_listados_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($mas_vendidos_listados_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Más vendidos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="mas_vendidos_listados" value="1" id="mas_vendidos_listados_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="mas_vendidos_listados" value="0" id="mas_vendidos_listados_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($recepcion_pedidos_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Recepción pedidos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="recepcion_pedidos" value="1" id="recepcion_pedidos_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="recepcion_pedidos" value="0" id="recepcion_pedidos_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<hr class='mt-3 mb-3' />
<?php
if($menu_general_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">GENERAL:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="menu_general" value="1" id="menu_general_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="menu_general" value="0" id="menu_general_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($tipos_iva_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Tipos IVA:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="tipos_iva" value="1" id="tipos_iva_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="tipos_iva" value="0" id="tipos_iva_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($tipos_irpf_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Tipos IRPF:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="tipos_irpf" value="1" id="tipos_irpf_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="tipos_irpf" value="0" id="tipos_irpf_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($bancos_cajas_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Bancos/Cajas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="bancos_cajas" value="1" id="bancos_cajas_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="bancos_cajas" value="0" id="bancos_cajas_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($tarifas_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Tarifas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="tarifas" value="1" id="tarifas_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="tarifas" value="0" id="tarifas_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($usuarios_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Usuarios:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="usuarios" value="1" id="usuarios_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="usuarios" value="0" id="usuarios_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php
if($idiomas_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<!--
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    
    <div class="text-left">Idiomas:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="idiomas" value="1" id="idiomas_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="idiomas" value="0" id="idiomas_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
-->
<input type="hidden" name="idiomas" value="0" id="idiomas_0" />
<?php
if($datos_empresa_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Datos empresa:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="datos_empresa" value="1" id="datos_empresa_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="datos_empresa" value="0" id="datos_empresa_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php

if($impresion_documentos_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
    <div class="grid grid-cols-3 mt-3 items-center space-x-3">
        <div class="text-left">Impresión documentos:</div>
        <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="impresion_documentos" value="1" id="impresion_documentos_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="impresion_documentos" value="0" id="impresion_documentos_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
    </div>
<?php

if($iconos_usuarios_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<!--
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    
    <div class="text-left">Iconos:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="iconos" value="1" id="iconos_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="iconos" value="0" id="iconos_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
-->
<input type="hidden" name="iconos" value="0" id="iconos_0" />
<hr class='mt-3 mb-3' />
<?php
if($gestor_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<!--
    <div class="grid grid-cols-3 mt-3 items-center space-x-3">
        <div class="text-left">Gestor:</div>
        <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="gestor" value="1" id="gestor_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="gestor" value="0" id="gestor_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
    </div>
-->
<input type="hidden" name="gestor" value="0" id="gestor_0" />
<?php

if($terminales_permisos == 1) { $checked_activo_sys = " checked"; $checked_inactivo_sys = ""; }else { $checked_activo_sys = ""; $checked_inactivo_sys = " checked"; }
?>
<div class="grid grid-cols-3 mt-3 items-center space-x-3">
    <div class="text-left">Terminales:</div>
    <div class="text-left col-span-2">
        <span class="label-input mr-3">SI</span><input type="radio" name="terminales" value="1" id="terminales_1"<?php echo $checked_activo_sys.$disabled; ?> />
        <span class="label-input ml-3 mr-3">NO</span><input type="radio" name="terminales" value="0" id="terminales_0"<?php echo $checked_inactivo_sys.$disabled; ?> />
    </div>
</div>
<?php

if($id_url != 1) {
    ?>
    <div id="capa_guardar_update" class="grid-2 mb-2">
        <div class="box">
            <button class="submit text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarPermisos('<?php echo $id_url; ?>');">
                Guardar
            </button>
        </div>
    </div>
    <?php
}
?>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
