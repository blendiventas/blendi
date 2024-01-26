<label for="<?php echo $id_select_sys; ?>">Idioma:</label>
<select id="<?php echo $id_select_sys; ?>" name="<?php echo $id_select_sys; ?>">
    <?php
    $select_sys = "idioma";
    require($_SERVER['DOCUMENT_ROOT']."/admin/idiomas/gestion/datos-select-php.php");
    if(isset($matriz_id_idiomas)) {
        foreach ($matriz_id_idiomas as $key => $valor) {
            $selected_sys = "";
            if(!isset($id_idiomas_sys)) {
                if(!isset($id_idiomas_sys)) {
                    if ($matriz_principal_idiomas[$key] == 1) {
                        $selected_sys = " selected";
                    }
                }else {
                    if ($valor == $id_idiomas_sys) {
                        $selected_sys = " selected";
                    }
                }
            }else {
                if ($valor == $id_idiomas_sys) {
                    $selected_sys = " selected";
                }
            }
            ?>
            <option value="<?php echo $valor; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_idioma_idiomas[$key]; ?></option>
            <?php
        }
        unset($matriz_id_idiomas);
        unset($matriz_idioma_idiomas);
        unset($matriz_principal_idiomas);
    }
    ?>
</select>