<?php
$select_sys = "datos-referencias";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
if(empty($descripcion_larga_productos)) {
    $descripcion_larga_productos = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_productos);
}
if(empty($descripcion_url_productos)) {
    $descripcion_url_productos = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_productos);
}
if(empty($titulo_meta_productos)) {
    $titulo_meta_productos = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_productos);
}
if(empty($descripcion_meta_productos)) {
    $descripcion_meta_productos = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_productos);
}

if(!isset($id_productos_referencias_datos)) {
    $id_productos_referencias_datos = 0;
}
if(!isset($id_productos_otros)) {
    $id_productos_otros = 0;
}
echo $descripcion_pack_datos_referencias."<br />";
?>
<input type="hidden" name="id_enlazado[<?php echo $contador_elementos; ?>]" id="id_enlazado_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_detalles_enlazado_productos_referencias; ?>" />
<input type="hidden" name="id_multiple[<?php echo $contador_elementos; ?>]" id="id_multiple_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_detalles_multiples_productos_referencias; ?>" />
<input type="hidden" name="id_pack[<?php echo $contador_elementos; ?>]" id="id_pack_<?php echo $contador_elementos; ?>" value="<?php echo $id_packs_productos_referencias; ?>" />
<input type="hidden" name="id_productos_referencias_datos[<?php echo $contador_elementos; ?>]" id="id_productos_referencias_datos_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_referencias_datos; ?>" />
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="codigo_barras_<?php echo $contador_elementos; ?>">Código de barras:</label><br>
        <input type="text" name="codigo_barras[<?php echo $contador_elementos; ?>]" id="codigo_barras_<?php echo $contador_elementos; ?>" placeholder="Código de barras" maxlength="20" value="<?php echo $codigo_barras; ?>" />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="referencia_<?php echo $contador_elementos; ?>">Referencia:</label><br>
        <input type="text" name="referencia[<?php echo $contador_elementos; ?>]" id="referencia_<?php echo $contador_elementos; ?>" placeholder="Referencia" maxlength="20" value="<?php echo $referencia; ?>" required />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        Fecha alta:<br><?php echo $fecha_alta; ?>
    </div>
    <div>
        Fecha modificación:<br><?php echo $fecha_modificacion; ?>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 justify-end items-center space-x-3">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div id="capa_guardar_update_<?php echo $contador_elementos; ?>" class="flex justify-end">
        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarReferencias('<?php echo $contador_elementos; ?>','<?php echo $id_url; ?>','<?php echo $id_productos_referencias_datos; ?>','<?php echo $id_productos_detalles_enlazado_productos_referencias; ?>','<?php echo $id_productos_detalles_multiples_productos_referencias; ?>','<?php echo $id_packs_productos_referencias; ?>');">Guardar</button>
    </div>
</div>
<?php
$contador_elementos += 1;