<div class="grid-1" style="margin: 40px 0px 30px 0px;">
    <div>
        <strong>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="color-black" title="Menú principal" target="_self">
                MENÚ PRINCIPAL
            </a> / Gestor
        </strong>
    </div>
</div>
<div class="grid-3">
    <div class="row">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="botones-menu-principal" title="Menú principal" target="_self">
            Atrás
        </a>
    </div>
    <?php
    if($albaranes_proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/albaranes/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-menu-principal" title="Albaranes proveedores">
                Entrar albaranes
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
                Entrar facturas
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