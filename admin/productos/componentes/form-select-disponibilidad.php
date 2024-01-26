<label for="disponibilidad_productos">Disponibilidad:</label>
<select id="disponibilidad_productos" name="disponibilidad_productos" required>
    <?php
    $selected_sys = "";
    if ($disponibilidad_productos == 0) {
        $selected_sys = " selected";
    }
    ?>
    <option value="0"<?php echo $selected_sys; ?>>Inactivo</option>
    <?php
    $selected_sys = "";
    if ($disponibilidad_productos == 1) {
        $selected_sys = " selected";
    }
    ?>
    <option value="1"<?php echo $selected_sys; ?>>En stock</option>
    <?php
    $selected_sys = "";
    if ($disponibilidad_productos == 2) {
        $selected_sys = " selected";
    }
    ?>
    <option value="2"<?php echo $selected_sys; ?>>Consultar</option>
    <?php
    $selected_sys = "";
    if ($disponibilidad_productos == 3) {
        $selected_sys = " selected";
    }
    ?>
    <option value="3"<?php echo $selected_sys; ?>>No disponible</option>
</select>