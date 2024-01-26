<div class="grid-2">
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
<div class="grid-6">
    <?php
    if($tiquets_clientes) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" class="botones-menu-principal" title="Documentos">
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
    if($recepcion_pedidos) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/recepcion_pedidos/gestion-recepcion-pedidos" class="botones-menu-principal" title="Recepcion pedidos">
                Recepcion pedidos
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
    if($gestor) {
        ?>
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/menu-gestor" class="botones-menu-principal" title="Documentos" target="_self">
                Gestor
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