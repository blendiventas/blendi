<label for="tipo_producto_productos">Tipo de producto:</label>
<select id="tipo_producto_productos" name="tipo_producto_productos" required>
    <?php
    $matriz_tipos_disponibles[0] = "Normal";
    $matriz_tipos_disponibles[1] = "Elaborado";
    $matriz_tipos_disponibles[2] = "Compuesto";
    $matriz_tipos_disponibles[3] = "Combo manual";
    $matriz_tipos_disponibles[4] = "Combo automático";
    if(empty($id_url)) {
        $selected_sys = "";
        if ($tipo_producto_productos == 0) {
            $selected_sys = " selected";
        }
        ?>
        <option value="0"<?php echo $selected_sys; ?>>Normal</option>
        <?php
        $selected_sys = "";
        if ($tipo_producto_productos == 1) {
            $selected_sys = " selected";
        }
        ?>
        <option value="1"<?php echo $selected_sys; ?>>Elaborado</option>
        <?php
        $selected_sys = "";
        if ($tipo_producto_productos == 2) {
            $selected_sys = " selected";
        }
        ?>
        <option value="2"<?php echo $selected_sys; ?>>Compuesto</option>
        <?php
        $selected_sys = "";
        if ($tipo_producto_productos == 3) {
            $selected_sys = " selected";
        }
        ?>
        <option value="3"<?php echo $selected_sys; ?>>Combo manual</option>
        <?php
        $selected_sys = "";
        if ($tipo_producto_productos == 4) {
            $selected_sys = " selected";
        }
        ?>
        <option value="4"<?php echo $selected_sys; ?>>Combo automático</option>
        <?php
    }else if($tipo_producto_productos == 3 OR $tipo_producto_productos == 4) {
        $selected_sys = "";
        if ($tipo_producto_productos == 3) {
            $selected_sys = " selected";
        }
        ?>
        <option value="3"<?php echo $selected_sys; ?>>Combo manual</option>
        <?php
        $selected_sys = "";
        if ($tipo_producto_productos == 4) {
            $selected_sys = " selected";
        }
        ?>
        <option value="4"<?php echo $selected_sys; ?>>Combo automático</option>
        <?php
    }else {
        ?>
        <option value="<?php echo $tipo_producto_productos; ?>" selected><?php echo $matriz_tipos_disponibles[$tipo_producto_productos]; ?></option>
        <?php
    }
    ?>
</select>