<label for="id_zona_libradores">Zona:</label><br>
<select id="id_zona_libradores" class="w-full" name="id_zona_libradores" required>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/zonas/gestion/datos-select-php.php");
    if(isset($matriz_id_libradores_zonas)) {
        foreach ($matriz_id_libradores_zonas as $key_libradores_zona => $valor_libradores_zona) {
            $selected = "";
            if($id_zona_libradores == $valor_libradores_zona) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_libradores_zona; ?>"<?php echo $selected; ?>><?php echo $matriz_zona_libradores_zonas[$key_libradores_zona]; ?></option>
            <?php
        }
        unset($matriz_id_libradores_zonas);
        unset($matriz_zona_libradores_zonas);
    }
    ?>
</select>