<div class="grid-5">
    <div class="box text-center">
        <h1>Terminal Punto Venta</h1>
    </div>
    <div class="box text-center">
        <?php
        $seleted_cli = " selected";
        $seleted_pro = "";
        $seleted_cre = "";
        if(isset($librado_url)) {
            if ($librado_url == "pro") {
                $seleted_cli = "";
                $seleted_pro = " selected";
            } else if ($librado_url == "cre") {
                $seleted_cli = "";
                $seleted_cre = " selected";
            }
        }
        ?>
        <label for="librado">Librado:</label><br />
        <select id="librado" name="librado">
            <option value="cli"<?php echo $seleted_cli; ?>>Clientes</option>
            <option value="pro"<?php echo $seleted_pro; ?>>Proveedores</option>
            <option value="cre"<?php echo $seleted_cre; ?>>Creditores</option>
        </select>
    </div>
    <div class="box text-center">
        <?php
        $seleted_pre = "";
        $seleted_ped = "";
        $seleted_alb = "";
        $seleted_fac = "";
        $seleted_tiq = " selected";
        if(isset($documento_url)) {
            if ($documento_url == "pre") {
                $seleted_tiq = "";
                $seleted_pre = " selected";
            } else if ($documento_url == "ped") {
                $seleted_tiq = "";
                $seleted_ped = " selected";
            } else if ($documento_url == "alb") {
                $seleted_tiq = "";
                $seleted_alb = " selected";
            } else if ($documento_url == "fac") {
                $seleted_tiq = "";
                $seleted_fac = " selected";
            }
        }
        ?>
        <label for="documento">Documento:</label><br />
        <select id="documento" name="documento">
            <option value="pre"<?php echo $seleted_pre; ?>>Presupuestos</option>
            <option value="ped"<?php echo $seleted_ped; ?>>Pedidos</option>
            <option value="alb"<?php echo $seleted_alb; ?>>Albaranes</option>
            <option value="fac"<?php echo $seleted_fac; ?>>Facturas</option>
            <option value="tiq"<?php echo $seleted_tiq; ?>>Tiquets</option>
        </select>
    </div>
    <div class="box text-center">
        <button type="button" class="botones-apartados" onclick="window.location.href='/admin/gestion-documentos/accion=consultar/librado='+document.getElementById('librado').value+'/documento='+document.getElementById('documento').value;">
            Consultar
        </button>
    </div>
    <div class="box text-center">
        <button type="button" class="botones-apartados" onclick="window.location.href='/admin/gestion-documentos/accion=crear/librado='+document.getElementById('librado').value+'/documento='+document.getElementById('documento').value;">
            Crear
        </button>
    </div>
</div>
<hr />
<?php
echo "<br /><br />Acción: ".$accion_url."<br />";