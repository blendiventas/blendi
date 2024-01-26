<label for="<?php echo $id_select_sys; ?>">Método pago:</label><br>
<select id="<?php echo $id_select_sys; ?>" class="w-full" name="<?php echo $id_select_sys; ?>" required>
    <option value="-1">Método de pago</option>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/metodos_pago/gestion/datos-select-php.php");
    /*
    $matriz_id_metodos_pago[] = $valor['id'];
    $matriz_descripcion_metodos_pago[] = $valor['descripcion'];
    $matriz_recargo_metodos_pago[] = $valor['recargo'];
    $matriz_prioritario_metodos_pago[] = $valor['prioritario'];
    $matriz_activo_metodos_pago[] = $valor['activo'];
    */
    if(isset($matriz_id_metodos_pago)) {
        foreach ($matriz_id_metodos_pago as $key_metodos_pago => $valor_metodos_pago) {
            $selected = "";
            if($id_metodos_pago_url == 0 && $matriz_prioritario_metodos_pago[$key_metodos_pago] == 1) {
                $selected = " selected";
            }elseif ($valor_metodos_pago == $id_metodos_pago_url) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_metodos_pago; ?>"<?php echo $selected; ?>><?php echo $matriz_descripcion_metodos_pago[$key_metodos_pago]; ?></option>
            <?php
        }
        unset($matriz_id_metodos_pago);
        unset($matriz_descripcion_metodos_pago);
        unset($matriz_explicacion_metodos_pago);
        unset($matriz_interface_metodos_pago);
        unset($matriz_prioritario_metodos_pago);
        unset($matriz_id_iva_metodos_pago);
        unset($matriz_incremento_pvp_metodos_pago);
        unset($matriz_incremento_por_metodos_pago);
        unset($matriz_ruta_metodos_pago);
        unset($matriz_sistema_metodos_pago);
        unset($matriz_imagen_metodos_pago);
        unset($matriz_orden_metodos_pago);
        unset($matriz_activo_metodos_pago);
    }
    ?>
</select>