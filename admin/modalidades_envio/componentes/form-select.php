<label for="<?php echo $id_select_sys; ?>">Modalidad de envío:</label><br>
<select id="<?php echo $id_select_sys; ?>" class="w-full" name="<?php echo $id_select_sys; ?>" required>
    <option value="-1">Modalidad de envío</option>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_envio/gestion/datos-select-php.php");
    /*
    $matriz_id_modalidades_envio[] = $valor['id'];
    $matriz_descripcion_modalidades_envio[] = $valor['descripcion'];
    $matriz_recargo_modalidades_envio[] = $valor['recargo'];
    $matriz_prioritario_modalidades_envio[] = $valor['prioritario'];
    $matriz_activo_modalidades_envio[] = $valor['activo'];
    */
    if(isset($matriz_id_modalidades_envio)) {
        foreach ($matriz_id_modalidades_envio as $key_modalidades_envio => $valor_modalidades_envio) {
            $selected = "";
            if($id_modalidades_envio_url == 0 && $key_modalidades_envio == 0) {
                $selected = " selected";
            }elseif ($valor_modalidades_envio == $id_modalidades_envio_url) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_modalidades_envio; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_modalidades_envio[$key_modalidades_envio]; ?></option>
            <?php
        }
        unset($matriz_id_modalidades_envio);
        unset($matriz_descripcion_modalidades_envio);
        unset($matriz_explicacion_modalidades_envio);
    }
    ?>
</select>