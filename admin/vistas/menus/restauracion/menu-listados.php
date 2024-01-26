<div class="grid-1" style="margin: 40px 0px 30px 0px;">
    <div>
        <strong>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="color-black" title="Menú principal" target="_self">
                MENÚ PRINCIPAL
            </a> /
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestor" class="color-black" title="Menú principal" target="_self">
                GESTOR
            </a> /
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-productos" class="color-black" title="Menú principal" target="_self">
                PRODUCTOS
            </a> / Listados
        </strong>
    </div>
</div>
<div class="grid-3">
    <div class="row">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-productos" class="botones-menu-principal" title="Menú principal" target="_self">
            Atrás
        </a>
    </div>
    <?php
    if($stocks_listados) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-stocks" class="botones-menu-principal" title="Stocks">
                Stocks
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
    if($mas_vendidos_listados) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-listados-mas-vendidos" class="botones-menu-principal" title="Más vendidos">
                Más vendidos
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