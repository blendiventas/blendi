<label for="<?php echo $id_select_sys; ?>">Porcentaje IRPF:</label><br>
<select id="<?php echo $id_select_sys; ?>" class="w-full" name="<?php echo $id_select_sys; ?>" required>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/irpf/gestion/datos-select-php.php");
    if(isset($matriz_id_productos_irpf)) {
        foreach ($matriz_id_productos_irpf as $key_productos_irpf => $valor_productos_irpf) {
            $selected = "";
            if ($valor_productos_irpf == $id_irpf_url) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_productos_irpf; ?>" <?php echo $selected; ?>><?php echo $matriz_irpf_productos_irpf[$key_productos_irpf]; ?></option>
            <?php
        }
        unset($matriz_id_productos_irpf);
        unset($matriz_irpf_productos_irpf);
        unset($matriz_activo_productos_irpf);
    }
    ?>
</select>