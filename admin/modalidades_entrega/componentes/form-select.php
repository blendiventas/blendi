<label for="<?php echo $id_select_sys; ?>">Modalidad de envío:</label><br>
<select id="<?php echo $id_select_sys; ?>" class="w-full" name="<?php echo $id_select_sys; ?>" required>
    <option value="-1">Modalidad de envío</option>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_entrega/gestion/datos-select-php.php");
    /*
    $matriz_id_modalidades_entrega[] = $valor['id'];
    $matriz_descripcion_modalidades_entrega[] = $valor['descripcion'];
    $matriz_recargo_modalidades_entrega[] = $valor['recargo'];
    $matriz_prioritario_modalidades_entrega[] = $valor['prioritario'];
    $matriz_activo_modalidades_entrega[] = $valor['activo'];
    */
    if(isset($matriz_id_modalidades_entrega)) {
        foreach ($matriz_id_modalidades_entrega as $key_modalidades_entrega => $valor_modalidades_entrega) {
            $selected = "";
            if($id_modalidades_entrega_url == 0 && $key_modalidades_entrega == 0) {
                $selected = " selected";
            }elseif ($valor_modalidades_entrega == $id_modalidades_entrega_url) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_modalidades_entrega; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_modalidades_entrega[$key_modalidades_entrega]; ?></option>
            <?php
        }
        unset($matriz_id_modalidades_entrega);
        unset($matriz_descripcion_modalidades_entrega);
        unset($matriz_explicacion_modalidades_entrega);
    }
    ?>
</select>