<label for="id_modalidades_pago_libradores">Modalidad pago:</label><br>
<select id="id_modalidades_pago_libradores" class="w-full" name="id_modalidades_pago_libradores" required>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_pago/gestion/datos-select-php.php");
    if(isset($matriz_id_libradores_modalidades_pago)) {
        foreach ($matriz_id_libradores_modalidades_pago as $key_libradores_modalidad_pago => $valor_libradores_modalidad_pago) {
            $selected = "";
            if($id_modalidades_pago_libradores == $valor_libradores_modalidad_pago) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_libradores_modalidad_pago; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_libradores_modalidades_pago[$key_libradores_modalidad_pago]; ?></option>
            <?php
        }
        unset($matriz_id_libradores_modalidades_pago);
        unset($matriz_descripcion_libradores_modalidades_pago);
    }
    ?>
</select>