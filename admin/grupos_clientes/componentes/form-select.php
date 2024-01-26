<label for="<?php echo $id_select_sys; ?>">Grupo de clientes:</label><br>
<select id="<?php echo $id_select_sys; ?>" class="w-full" name="<?php echo $id_select_sys; ?>" required>
    <option value="-1">Sin grupo de clientes</option>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/grupos_clientes/gestion/datos-select-php.php");
    /*
    $matriz_id_grupos_clientes[] = $valor['id'];
    $matriz_descripcion_grupos_clientes[] = $valor['grupos_clientes'];
    $matriz_prioritario_grupos_clientes[] = $valor['prioritario'];
    $matriz_activo_grupos_clientes[] = $valor['activo'];
    */
    if(isset($matriz_id_grupos_clientes)) {
        foreach ($matriz_id_grupos_clientes as $key_grupos_clientes => $valor_grupos_clientes) {
            $selected = "";
            if($id_grupos_clientes_url == 0 && $matriz_prioritario_grupos_clientes[$key_grupos_clientes] == 1) {
                $selected = " selected";
            }elseif ($valor_grupos_clientes == $id_grupos_clientes_url) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_grupos_clientes; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_grupos_clientes[$key_grupos_clientes]; ?></option>
            <?php
        }
        unset($matriz_id_grupos_clientes);
        unset($matriz_descripcion_grupos_clientes);
        unset($matriz_prioritario_grupos_clientes);
        unset($matriz_activo_grupos_clientes);
    }
    ?>
</select>