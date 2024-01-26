<select id="id_productos_relacionados" name="id_productos_relacionados">
    <option value="0" selected>Sin producto relacionado</option>
    <?php
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/relacionados/gestion/datos-select-php.php");
    foreach ($matriz_id_productos_relacionados as $key_productos_relacionados => $valor_productos_relacionados) {
        $selected_sys = "";
        if($id_productos == $valor_productos_relacionados['id']) { $selected_sys = " selected"; }
        echo '<option id="option_id_producto_'.$valor_productos_relacionados['id'].'" value="'.$valor_productos_relacionados['id'].'"'.$selected_sys.'>'.stripslashes($valor_productos_relacionados['descripcion']).'</option>';
    }
    ?>
</select>