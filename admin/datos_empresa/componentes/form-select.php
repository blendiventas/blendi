<label for="<?php echo $id_select_sys; ?>"><?php echo $etiqueta_select_id_librador_configuracion; ?></label><br />
<select id="<?php echo $id_select_sys; ?>" name="<?php echo $id_select_sys; ?>" class="w-full" required>
    <?php
    if($id_select_sys == "id_librador_tak_configuracion") {
        $selected_sys = "";
        if($id_librador_buscar_configuracion == 0) {
            $selected_sys = " selected";
        }
        ?>
        <option value="0"<?php echo $selected_sys; ?>>Sin entregas en local</option>
        <?php
    }
    $tipo = "cli";
    $select_sys = "listado-filtrado-sin-paginas";
    require($_SERVER['DOCUMENT_ROOT']."/admin/libradores/gestion/datos-select-php.php");
    if(isset($matriz_id_libradores)) {
        foreach ($matriz_id_libradores as $key => $valor) {
            if($matriz_activo_libradores[$key] == 1) {
                $nombre_librador = "";
                if(!empty($matriz_razon_social_libradores[$key])) {
                    $nombre_librador = $matriz_razon_social_libradores[$key];
                }
                if(!empty($matriz_razon_comercial_libradores[$key])) {
                    $nombre_librador = $matriz_razon_comercial_libradores[$key];
                }
                if(empty($nombre_librador) && !empty($matriz_nombre_libradores[$key])) {
                    $nombre_librador = $matriz_nombre_libradores[$key]." ".$matriz_apellido_1_libradores[$key]." ".$matriz_apellido_2_libradores[$key];
                }
                $selected_sys = "";
                if ($valor == $id_librador_buscar_configuracion) {
                    $selected_sys = " selected";
                }
                ?>
                <option value="<?php echo $valor; ?>"<?php echo $selected_sys; ?>><?php echo $nombre_librador; ?></option>
                <?php
            }
        }
        unset($matriz_id_libradores);
        unset($matriz_codigo_librador_libradores);
        unset($matriz_razon_social_libradores);
        unset($matriz_razon_comercial_libradores);
        unset($matriz_nombre_libradores);
        unset($matriz_apellido_1_libradores);
        unset($matriz_apellido_2_libradores);
        unset($matriz_activo_libradores);
    }
    ?>
</select>