<?php
if(!isset($titulo_bancos_cajas)) {
    $titulo_bancos_cajas = "Tarifa";
}
?>
<label for="<?php echo $id_select_sys; ?>"><?php echo $titulo_bancos_cajas; ?>:</label><br>
<select id="<?php echo $id_select_sys; ?>" class="w-full" name="<?php echo $id_select_sys; ?>" required>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/bancos_cajas/gestion/datos-select-php.php");
    if(isset($matriz_id_bancos_cajas)) {
        foreach ($matriz_id_bancos_cajas as $key_bancos_cajas => $valor_bancos_cajas) {
            $selected = "";
            if ($valor_bancos_cajas == $id_bancos_cajas_url) {
                $selected = " selected";
            }
            ?>
            <option value="<?php echo $valor_bancos_cajas; ?>" <?php echo $selected; ?>><?php echo $matriz_descripcion[$key_bancos_cajas]; ?></option>
            <?php
        }
        unset($matriz_id_bancos_cajas);
        unset($matriz_descripcion);
        unset($matriz_activo_bancos_cajas);
    }
    ?>
</select>