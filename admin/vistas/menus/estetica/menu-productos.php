<div class="grid-1">
    <div>
        <strong>
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin" class="color-black" title="Menú principal" target="_self">
                MENÚ PRINCIPAL
            </a> /
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestor" class="color-black" title="Menú principal" target="_self">
                GESTOR
            </a> / Productos
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
    if($productos) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos" class="botones-menu-principal" title="Productos">
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
    if($categorias) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias" class="botones-menu-principal" title="Categorías">
                Categorías
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
    if($categorias_elaborados) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias_elaborados" class="botones-menu-principal" title="Categorías elaborados">
                Categorías elaborados
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
    if($detalles_productos) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles" class="botones-menu-principal" title="Detalles productos">
                Detalles productos
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
    if($grupos) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-grupos" class="botones-menu-principal" title="Grupos">
                Grupos
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
    if($menu_listados) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-listados" class="botones-menu-principal" title="Listados" target="_self">
                Listados
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