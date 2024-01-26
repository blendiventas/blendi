<label for="id_ofertas">Oferta:</label>
<select id="id_ofertas" name="id_ofertas" required>
    <?php
    $select_w = "ofertas";
    require($_SERVER['DOCUMENT_ROOT']."/admin/ofertas/gestion/datos-select-php.php");

    if(isset($matriz_id_ofertas)) {
        foreach ($matriz_id_ofertas as $key => $valor) {
            $selected_w = "";
            if($id_ofertas == $matriz_id_ofertas[$key]) {
                $selected_w = " selected";
            }
            ?>
            <option class="color-green" value="<?php echo $valor; ?>"<?php echo $selected_w; ?>><?php echo $matriz_descripcion_ofertas[$key]; ?></option>
            <?php
        }
        unset($matriz_id_ofertas);
        unset($matriz_descripcion_ofertas);
        unset($matriz_activo_ofertas);
    }
    ?>
</select>