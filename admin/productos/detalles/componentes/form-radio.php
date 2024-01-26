<?php
$select_sys = "listado-filtrado-detalles";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
/*
$matriz_id_productos_detalles
$matriz_detalle_productos_detalles
*/
if(isset($matriz_id_productos_detalles)) {
    $checked = "";
    if($id_enlace_productos_detalles == 0) {
        $checked = " checked";
    }
    ?>
    <div class="grid-1">
        <div class="row grid-2">
            <div class="box">
                <input type="radio"<?php echo $checked; ?> id="id_enlace_productos_detalles_0" name="id_enlace_productos_detalles" value="0" />
            </div>
            <div class="box text-left">
                Sin atributo relacionado
            </div>
        </div>
    </div>
    <?php
    foreach ($matriz_id_productos_detalles as $key_id_productos_detalles => $valor_id_productos_detalles) {
        $checked = "";
        if($id_enlace_productos_detalles == $valor_id_productos_detalles) {
            $checked = " checked";
        }
        ?>
        <div class="grid-1">
            <div class="row grid-2">
                <div class="box">
                    <input type="radio"<?php echo $checked; ?> id="id_enlace_productos_detalles_<?php echo $valor_id_productos_detalles; ?>" name="id_enlace_productos_detalles" value="<?php echo $valor_id_productos_detalles; ?>" />
                </div>
                <div class="box text-left">
                    <?php echo $matriz_detalle_productos_detalles[$key_id_productos_detalles]; ?>
                </div>
            </div>
        </div>
        <?php
    }
    unset($matriz_id_productos_detalles);
    unset($matriz_id_enlace_productos_detalles);
    unset($matriz_detalle_productos_detalles);
    unset($matriz_activo_productos_detalles);
}else {
    echo "Sin atributos";
}