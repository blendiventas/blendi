<label for="<?php echo $id_select_sys; ?>">Categoría:</label><br>
<select id="<?php echo $id_select_sys; ?>" name="<?php echo $id_select_sys; ?>" required class="w-full">
    <?php
    if ($withRaiz) {
        $selected_sys = "";
        if ($de_categorias == 0) {
            $selected_sys = " selected";
        }
        ?>
        <option value="0"<?php echo $selected_sys; ?>>Raíz</option>
        <?php
    }
    $select_sys = "categorias";
    require($_SERVER['DOCUMENT_ROOT']."/admin/categorias/gestion/datos-select-php.php");
    if(isset($matriz_id_categorias)) {
        foreach ($matriz_id_categorias as $key => $valor) {
            $selected_sys = "";
            if ($valor == $de_categorias) {
                $selected_sys = " selected";
            }
            ?>
            <option value="<?php echo $valor; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_descripcion_categorias[$key]; ?></option>
            <?php
        }
        unset($matriz_id_categorias);
        unset($matriz_descripcion_categorias);
    }
    ?>
</select>