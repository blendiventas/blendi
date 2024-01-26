<label for="<?php echo $id_select_sys; ?>">Porcentaje IVA:</label><br>
<select id="<?php echo $id_select_sys; ?>" class="w-1/2" name="<?php echo $id_select_sys; ?>" required>
    <option value="-1">IVA de produtos</option>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/iva/gestion/datos-select-php.php");
    /*
    $matriz_id_productos_iva[] = $valor['id'];
    $matriz_iva_productos_iva[] = $valor['iva'];
    $matriz_recargo_productos_iva[] = $valor['recargo'];
    $matriz_prioritario_productos_iva[] = $valor['prioritario'];
    $matriz_activo_productos_iva[] = $valor['activo'];
    */
    if(isset($matriz_id_productos_iva)) {
        foreach ($matriz_id_productos_iva as $key_productos_iva => $valor_productos_iva) {
            $selected = "";
            if($id_iva_url == 0 && $matriz_prioritario_productos_iva[$key_productos_iva] == 1) {
                $selected = " selected";
            }elseif ($valor_productos_iva == $id_iva_url) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_productos_iva; ?>"<?php echo $selected; ?>><?php echo $matriz_iva_productos_iva[$key_productos_iva]; ?></option>
            <?php
        }
        unset($matriz_id_productos_iva);
        unset($matriz_iva_productos_iva);
        unset($matriz_recargo_productos_iva);
        unset($matriz_prioritario_productos_iva);
        unset($matriz_activo_productos_iva);
    }
    ?>
</select>