<div class="grid-6 font-bold" id="capa-nueva-mesa" style="margin: 1%; width: 95%; border-radius: 5px; border: solid 1px grey; padding: 1%;">
    <div class="row text-center">
        Comedor
    </div>
    <div class="row text-center">
        &nbsp;
    </div>
    <div class="row text-center">
        Principal
    </div>
    <div class="row text-center" style="cursor: pointer; text-align: center; margin-top: 7px;">
        Activo
    </div>
    <div class="row text-center" style="cursor: pointer; text-align: center; margin-top: 7px;">
        Fecha alta
    </div>
    <div class="row text-center" style="cursor: pointer; margin-top: 7px; padding: 1%; text-align: center;">
        Fecha modificación
    </div>
    <?php
    $select_sys = "comedores";
    require($_SERVER['DOCUMENT_ROOT']."/admin/mesas/gestion/datos-select-php.php");
    foreach ($id_comedores as $key_id_comedores => $valor_id_comedores) {
        $cusor_pointer = "";
        if($principal_comedores[$key_id_comedores] == 0) {
            $cusor_pointer = "cursor: pointer;";
        }
        ?>
        <div class="row text-center">
            <input type="text" id="descripcion_comedores_input_text_<?php echo $valor_id_comedores; ?>" value="<?php echo $descripcion_comedores[$key_id_comedores]; ?>" />
        </div>
        <div class="row text-center">
            <button onclick="guardarDescripcion('<?php echo $valor_id_comedores; ?>');">Guardar</button>
        </div>
        <div class="row text-center" id="principal_comedores_lista_<?php echo $valor_id_comedores; ?>" style="<?php echo $cusor_pointer; ?> text-align: center; margin-top: 7px;" onclick="guardarPrincipal('<?php echo $valor_id_comedores; ?>','<?php echo $principal_comedores[$key_id_comedores]; ?>')">
            <?php echo $principal_comedores[$key_id_comedores]; ?>
        </div>
        <div class="row text-center" id="activo_comedores_lista_<?php echo $valor_id_comedores; ?>" style="<?php echo $cusor_pointer; ?> text-align: center; margin-top: 7px;" onclick="guardarActivo('<?php echo $valor_id_comedores; ?>','<?php echo $activo_comedores[$key_id_comedores]; ?>')">
            <?php echo $activo_comedores[$key_id_comedores]; ?>
        </div>
        <div class="row text-center" id="fecha_alta_comedores_lista_<?php echo $valor_id_comedores; ?>" style="text-align: center; margin-top: 7px;">
            <?php echo $fecha_alta_comedores[$key_id_comedores]; ?>
        </div>
        <div class="row text-center" id="fecha_modificacion_comedores_lista_<?php echo $valor_id_comedores; ?>" style="margin-top: 7px; padding: 1%; text-align: center;">
            <?php echo $fecha_modificacion_comedores[$key_id_comedores]; ?>
        </div>
        <?php
    }
    ?>
</div>

<div class="grid-6 font-bold" id="capa-nueva-mesa" style="margin: 1%; width: 95%; border-radius: 5px; border: solid 1px grey; padding: 1%;">
    <div class="row text-center">
        Nuevo comedor
    </div>
    <div class="row text-center">
        &nbsp;
    </div>
    <div class="row text-center">
        <input type="text" id="descripcion_comedores_input_text_0" value="" />
    </div>
    <div class="row text-center">
        <button onclick="guardarDescripcion('0');">Añadir</button>
    </div>
</div>
