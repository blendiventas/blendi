<label for="<?php echo $id_select_sys; ?>">Grupo:</label><br>
<select id="<?php echo $id_select_sys; ?>" name="<?php echo $id_select_sys; ?>" required class="w-full">
    <?php
    $selected_sys = "";
    if ($id_grupo_categorias == 0) {
        $selected_sys = " selected";
    }
    ?>
    <option value="0"<?php echo $selected_sys; ?>>Sin categoría</option>
    <?php
    $select_sys = "listado-grupos";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/grupos/gestion/datos-select-php.php");
    if(isset($matriz_id_productos_grupos)) {
        foreach ($matriz_id_productos_grupos as $key => $valor) {
            $selected_sys = "";
            if ($valor == $id_grupo_categorias) {
                $selected_sys = " selected";
            }
            ?>
            <option value="<?php echo $valor; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_descripcion_productos_grupos[$key]; ?></option>
            <?php
        }
        unset($matriz_id_productos_grupos);
        unset($matriz_descripcion_productos_grupos);
    }
    ?>
</select>