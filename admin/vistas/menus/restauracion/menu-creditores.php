<div class="grid-1" style="margin: 40px 0px 30px 0px;">
    <div>
        <strong>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="color-black" title="Menú principal" target="_self">
                MENÚ PRINCIPAL
            </a> /
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestor" class="color-black" title="Menú principal" target="_self">
                GESTOR
            </a> / Creditores
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
    if($creditores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cre" class="botones-menu-principal" title="Creditores">
                Creditores
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
    if($presupuestos_creditores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/presupuestos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-menu-principal" title="Presupuestos creditores">
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
    if($pedidos_creditores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-menu-principal" title="Pedidos creditores">
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
    if($albaranes_creditores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-menu-principal" title="Albaranes creditores">
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
    if($facturas_creditores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/facturas/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-menu-principal" title="Facturas creditores">
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
    if($tiquets_creditores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/gastos-inicio" class="botones-menu-principal" title="Tiquets creditores">
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