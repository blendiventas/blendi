<?php
if(!isset($titulo_tarifa)) {
    $titulo_tarifa = "Tarifa";
}
?>
<label for="<?php echo $id_select_sys; ?>"><?php echo $titulo_tarifa; ?>:</label><br>
<select id="<?php echo $id_select_sys; ?>" name="<?php echo $id_select_sys; ?>" class="w-full" required>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-select-php.php");
    if(isset($matriz_id_tarifas)) {
        foreach ($matriz_id_tarifas as $key => $valor) {
            $selected_sys = "";
            if($matriz_id_tarifas == 0 && $matriz_prioritaria_tarifas[$key] == 1) {
                $selected_sys = " selected";
            }elseif ($valor == $id_tarifas) {
                $selected_sys = " selected";
            }
            ?>
            <option value="<?php echo $valor; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_descripcion_tarifas[$key]; ?></option>
            <?php
        }
        unset($matriz_id_tarifas);
        unset($matriz_id_idioma_tarifas);
        unset($matriz_descripcion_tarifas);
        unset($matriz_prioritaria_tarifas);
        unset($matriz_activa_tarifas);
        unset($matriz_orden_tarifas);
    }
    ?>
</select>