<div class="grid-1" style="margin: 40px 0px 30px 0px;">
    <div>
        <strong>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="color-black" title="Menú principal" target="_self">
                MENÚ PRINCIPAL
            </a> / Stock
        </strong>
    </div>
</div>
<div class="grid-4">
    <div class="row">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="botones-menu-principal" title="Menú principal" target="_self">
            Atrás
        </a>
    </div>
    <?php
    if($pedidos_proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/pedidos/<?php echo $id_sesion_sys; ?>/tpv/compras-inicio" class="botones-menu-principal" title="Pedidos proveedores">
                Pedidos a proveedores
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
    if($stocks_listados) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-stocks" class="botones-menu-principal" title="Stocks">
                Regularización
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
    $control_temperatura = 1;
    if($control_temperatura) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-temperaturas-agua" class="botones-menu-principal" title="Control de temperaturas y agua">
                Control de temperaturas y agua
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