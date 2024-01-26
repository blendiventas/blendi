<div class="grid-2" style="margin: 40px 0px 30px 0px;">
    <div><strong>MENÚ PRINCIPAL</strong></div>
    <div>
        <?php
        $select_sys = "listado-filtrado-activos";
        require($_SERVER['DOCUMENT_ROOT']."/admin/terminales/gestion/datos-select-php.php");
        if(isset($matriz_id_terminales) && count($matriz_id_terminales) > 1) {
            ?>
            <label for="id_terminal">Terminal acceso de <?php echo $usuario_sys; ?>:</label>
            <select id="id_terminal" name="id_terminal" onchange="establecerTerminal(this.value);" required>
                <?php
                foreach ($matriz_id_terminales as $key_id_terminales => $valor_id_terminales) {
                    $selected_sys = "";
                    if($valor_id_terminales == $id_terminal_sys) {
                        $selected_sys = " selected";
                    }
                    if($terminales_de_acceso == -1 || ($terminales_de_acceso != -1 && $selected_sys == " selected")) {
                        ?>
                        <option value="<?php echo $valor_id_terminales; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_descripcion_terminales[$key_id_terminales]; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php
            unset($matriz_id_terminales);
            unset($matriz_descripcion_terminales);
        }else {
            ?>
            <input type="hidden" name="id_terminal" id="id_terminal" value="1">
            <?php
        }
        ?>
    </div>
</div>
<div class="grid-5">
    <?php
    if($tiquets_clientes) {
        ?>
        <div class="row">

            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-menu-principal" title="Documentos">
            <!--<a href="#" class="botones-menu-principal" title="Documentos" onclick="FullScreenMode('<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio');">-->
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
    if($recepcion_pedidos) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/recepcion_pedidos/" class="botones-menu-principal" title="Cocina">
                Blendi-Cocina
                <p>
                COMPRAR
                </p>
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
    if($recepcion_pedidos) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/analitics/" class="botones-menu-principal" title="Analítics">
                Blendi-Analítics
                <p>
                    COMPRAR
                </p>
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
    if($clientes) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/tipo=cli" class="botones-menu-principal" title="Clientes">
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
    ?>
</div>
<div class="grid-5">
    <?php
    if($mesas) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-mesas" class="botones-menu-principal" title="Mesas" >
                Mesas
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
    ?>
</div>
<div class="grid-5">
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
<div class="grid-5">
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
    ?>
</div>
<div class="grid-3">
    <?php
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
    $select_sys = "registros";
    require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-select-php.php");
    if($registros_sys > 1) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/usuarios-inicio" class="botones-menu-principal" title="Categorías" target="_self">
                Cambio usuario
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