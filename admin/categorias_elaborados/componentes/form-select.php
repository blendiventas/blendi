<label for="<?php echo $id_select_sys; ?>">Categoría del producto en análisis:</label><br>
<select id="<?php echo $id_select_sys; ?>" name="<?php echo $id_select_sys; ?>" class="w-full" required>
    <option value="0"<?php echo (empty($id_categorias_elaborados_url))? ' selected' : ''; ?>>Sin categoría</option>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/categorias_elaborados/gestion/datos-select-php.php");
    if(isset($matriz_id_categorias_elaborados)) {
        foreach ($matriz_id_categorias_elaborados as $key_categorias_elaborados => $valor_categorias_elaborados) {
            $selected = "";
            if ($valor_categorias_elaborados == $id_categorias_elaborados_url) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_categorias_elaborados; ?>" <?php echo $selected; ?>><?php echo $matriz_descripcion_categorias_elaborados[$key_categorias_elaborados]; ?></option>
            <?php
        }
        unset($matriz_id_categorias_elaborados);
        unset($matriz_descripcion_categorias_elaborados);
    }
    ?>
</select>