<div class="grid-1">
    <div>
        <strong>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="color-black" title="Menú principal" target="_self">
                MENÚ PRINCIPAL
            </a> /
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestor" class="color-black" title="Menú principal" target="_self">
                GESTOR
            </a> / Proveedores
        </strong>
    </div>
</div>
<div class="grid-7">
    <div class="row">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestor" class="botones-menu-principal" title="Menú principal" target="_self">
            Atrás
        </a>
    </div>
    <?php
    if($proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=pro" class="botones-menu-principal" title="Proveedores">
                Proveedores
            </a>
        </div>
        <?php
    }else {
        ?>
        <div>
            &nbsp;
        </div>
        <?php
    }
    if($presupuestos_proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-menu-principal" title="Presupuestos proveedores">
                Presupuestos
            </a>
        </div>
        <?php
    }else {
        ?>
        <div>
            &nbsp;
        </div>
        <?php
    }
    if($pedidos_proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-menu-principal" title="Pedidos proveedores">
                Pedidos
            </a>
        </div>
        <?php
    }else {
        ?>
        <div>
            &nbsp;
        </div>
        <?php
    }
    if($albaranes_proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-menu-principal" title="Albaranes proveedores">
                Albaranes
            </a>
        </div>
        <?php
    }else {
        ?>
        <div>
            &nbsp;
        </div>
        <?php
    }
    if($facturas_proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-menu-principal" title="Facturas proveedores">
                Facturas
            </a>
        </div>
        <?php
    }else {
        ?>
        <div>
            &nbsp;
        </div>
        <?php
    }
    if($tiquets_proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-menu-principal" title="Tiquets proveedores">
                Tiquets
            </a>
        </div>
        <?php
    }else {
        ?>
        <div>
            &nbsp;
        </div>
        <?php
    }
    ?>
</div>