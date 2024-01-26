<div class="grid-1" style="margin: 40px 0px 30px 0px;">
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
<div class="grid-6">
    <div class="row">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestor" class="botones-menu-principal" title="Menú principal" target="_self">
            Atrás
        </a>
    </div>
    <?php
    if($tipos_iva) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-iva" class="botones-menu-principal" title="Tipos IVA">
                Tipos de IVA
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
    if($tipos_irpf) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tipos-irpf" class="botones-menu-principal" title="Tipos IRPF">
                Tipos de IRPF
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
    if($bancos_cajas) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-bancos_cajas" class="botones-menu-principal" title="Bancos y cajas">
                Bancos y cajas
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
    if($tarifas) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-tarifas" class="botones-menu-principal" title="Tarifas">
                Tarifas
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
    if($usuarios) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-usuarios" class="botones-menu-principal" title="Usuarios">
                Usuarios
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
<div class="grid-6">
    <?php
    if($datos_empresa) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-datos_empresa/id_datos_empresa=1" class="botones-menu-principal" title="Datos empresa">
                Datos empresa
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
    if($impresion_documentos) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-impresion_documentos" class="botones-menu-principal" title="Impresión documentos">
                Impresión documentos
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
    if($zonas) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-zonas" class="botones-menu-principal" title="Zonas">
                Zonas
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
    if($modalidades_envio) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_envio" class="botones-menu-principal" title="Modalidades envío">
                Modalidades envío
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
    if($modalidades_entrega) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_entrega" class="botones-menu-principal" title="Modalidades entrega">
                Modalidades entrega
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
    if($modalidades_pago) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-modalidades_pago" class="botones-menu-principal" title="Modalidades pago">
                Modalidades pago
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
<div class="grid-6">
    <?php
    if($datos_terminales) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-datos_terminales" class="botones-menu-principal" title="Terminales">
                Terminales
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
    <div>
        &nbsp;
    </div>
    <div>
        &nbsp;
    </div>
    <div>
        &nbsp;
    </div>
    <div>
        &nbsp;
    </div>
    <div>
        &nbsp;
    </div>
</div>
