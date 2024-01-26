<label for="<?php echo $id_select_sys; ?>">Proveedor:</label>
<select id="<?php echo $id_select_sys; ?>" name="<?php echo $id_select_sys; ?>" required>
    <?php
    $selected_sys = "";
    if ($id_proveedores == 0) {
        $selected_sys = " selected";
    }
    ?>
    <option value="-1"<?php echo $selected_sys; ?>>Sin proveedor</option>
    <?php
    $select_sys = "proveedores";
    require($_SERVER['DOCUMENT_ROOT']."/admin/proveedores/gestion/datos-select-php.php");
    /*

    */
    if(isset($matriz_id_proveedores)) {
        foreach ($matriz_id_proveedores as $key => $valor) {
            $selected_sys = "";
            if ($valor == $id_proveedores) {
                $selected_sys = " selected";
            }
            ?>
            <option value="<?php echo $valor; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_descripcion_proveedores[$key]; ?></option>
            <?php
        }
        unset($matriz_id_proveedores);
        unset($matriz_descripcion_proveedores);
    }
    ?>
</select>