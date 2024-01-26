<label for="<?php echo $id_select_sys; ?>">Recargo equivalencia:</label><br>
<select id="<?php echo $id_select_sys; ?>" class="w-full" name="<?php echo $id_select_sys; ?>" required>
    <?php
    $selected = "";
    if($recargo_libradores == 0) {
        $selected = " selected";
    }
    ?>
    <option value="0"<?php echo $selected; ?>>NO</option>
    <?php
    $selected = "";
    if($recargo_libradores == 1) {
        $selected = " selected";
    }
    ?>
    <option value="1"<?php echo $selected; ?>>SI</option>
</select>