<div class="grid-1">
    <div>
        <strong>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="color-black" title="Menú principal" target="_self">
                MENÚ PRINCIPAL
            </a> / Gestor
        </strong>
    </div>
</div>
<div class="grid-6">
    <div class="row">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="botones-menu-principal" title="Menú principal" target="_self">
            Atrás
        </a>
    </div>
    <?php
    if($menu_clientes) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-clientes" class="botones-menu-principal" title="Clientes" target="_self">
                Clientes
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
    if($menu_proveedores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-proveedores" class="botones-menu-principal" title="Proveedores" target="_self">
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
    if($menu_creditores) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-creditores" class="botones-menu-principal" title="Creditores" target="_self">
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
    if($menu_productos) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-productos" class="botones-menu-principal" title="Productos" target="_self">
                Productos
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
    if($menu_general) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-general" class="botones-menu-principal" title="Productos" target="_self">
                General
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