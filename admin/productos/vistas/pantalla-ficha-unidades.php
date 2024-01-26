<input type="hidden" name="apartado" id="apartado" value="unidades" />
<input type="hidden" name="id_productos" value="<?php echo $id_url; ?>" />
<?php
$select_sys = "unidades";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");
/*
$id_productos_unidades[] = $valor_productos_unidades['id'];
$id_unidad_productos_unidades[] = $valor_productos_unidades['id_unidad'];
$id_producto_productos_unidades[] = $valor_productos_unidades['id_producto'];
$principal_productos_unidades[] = $valor_productos_unidades['principal'];
$conversion_principal_productos_unidades[] = $valor_productos_unidades['conversion_principal'];
$activo_productos_unidades[] = $valor_productos_unidades['activo'];
$fecha_alta_productos_unidades[] = $valor_productos_unidades['fecha_alta'];
$fecha_modificacion_productos_unidades[] = $valor_productos_unidades['fecha_modificacion'];

$id_unidades[] = $valor_unidades['id'];
$unidad_unidades[] = $valor_unidades['unidad'];
$abreviatura_unidades[] = $valor_unidades['abreviatura'];
*/

$existe_unidad_principal = false;
if(isset($id_productos_unidades)) {
    $contador_elementos = 1;
    foreach ($id_productos_unidades as $key_productos_unidades => $valor_productos_unidades) {
        if($id_unidad_productos_unidades[$key_productos_unidades] == 0) {
            ?>
            <div class="w-full">
                Sin unidad definida.
            </div>
            <?php
        }else {
            if($principal_productos_unidades[$key_productos_unidades] == 1) {
                $existe_unidad_principal = true;
                ?>
                <input type="hidden" name="id_productos_unidades_<?php echo $contador_elementos; ?>" id="id_productos_unidades_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_unidades[$key_productos_unidades]; ?>" />
                <div class="grid grid-cols-1 mt-3 items-center space-x-3">
                    <div class="text-center font-bold">
                        UNIDAD BASE
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                    <div>
                        <label for="id_unidades_<?php echo $contador_elementos; ?>">Unidad:</label><br>
                        <select id="id_unidades_<?php echo $contador_elementos; ?>" name="id_unidades_<?php echo $contador_elementos; ?>" class="w-full" required>
                            <?php
                            foreach ($id_unidades as $key_unidades => $valor_unidades) {
                                $selected = "";
                                if($id_unidad_productos_unidades[$key_productos_unidades] == $valor_unidades) {
                                    $selected = " selected";
                                    $unidad_principal = $unidad_unidades[$key_unidades]." (".$abreviatura_unidades[$key_unidades].")";
                                }
                                ?>
                                <option value="<?php echo$valor_unidades; ?>"<?php echo $selected; ?>><?php echo $unidad_unidades[$key_unidades]." (".$abreviatura_unidades[$key_unidades].")"; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="unidad_activo_<?php echo $contador_elementos; ?>" id="unidad_activo_<?php echo $contador_elementos; ?>" value="<?php echo $activo_productos_unidades[$key_productos_unidades]; ?>" />
                <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                    <div>
                        <div class="text-left">Fecha alta unidad:</div>
                        <div class="text-center"><?php echo $fecha_alta_productos_unidades[$key_productos_unidades]; ?></div>
                    </div>
                    <div>
                        <div class="text-left">Fecha última modificación unidad:</div>
                        <div class="text-center"><?php echo $fecha_modificacion_productos_unidades[$key_productos_unidades]; ?></div>
                    </div>
                </div>
                <?php
                $contador_elementos += 1;
            }
        }
    }
    ?>
    <div class="grid grid-cols-1 mt-3 items-center space-x-3">
        <div class="text-center font-bold">
            OTRAS UNIDADES
        </div>
    </div>
    <?php
    foreach ($id_productos_unidades as $key_productos_unidades => $valor_productos_unidades) {
        if($principal_productos_unidades[$key_productos_unidades] == 0) {
            ?>
            <input type="hidden" name="id_productos_unidades_<?php echo $contador_elementos; ?>" id="id_productos_unidades_<?php echo $contador_elementos; ?>" value="<?php echo $id_productos_unidades[$key_productos_unidades]; ?>" />

            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="id_unidades_<?php echo $contador_elementos; ?>">Unidad:</label><br>
                    <select id="id_unidades_<?php echo $contador_elementos; ?>" name="id_unidades_<?php echo $contador_elementos; ?>" class="w-full" required>
                        <?php
                        foreach ($id_unidades as $key_unidades => $valor_unidades) {
                            $selected = "";
                            if($id_unidad_productos_unidades[$key_productos_unidades] == $valor_unidades) {
                                $selected = " selected";
                            }
                            ?>
                            <option value="<?php echo$valor_unidades; ?>"<?php echo $selected; ?>><?php echo $unidad_unidades[$key_unidades]." (".$abreviatura_unidades[$key_unidades].")"; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="conversion">Equivalencia en <?php echo $unidad_principal; ?>:</label><br>
                    <input type="number" name="conversion_<?php echo $contador_elementos; ?>" id="conversion_<?php echo $contador_elementos; ?>" placeholder="Equivalencia en <?php echo $unidad_principal; ?>" value="<?php echo $conversion_principal_productos_unidades[$key_productos_unidades]; ?>" class="w-full" required />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label>Convertir en unidad base:</label><br>
                    <div class="flex flex-wrap">
                        <div onclick="activarElementoUnicoFicha('principal_<?php echo $contador_elementos; ?>_1', 'capa_principal_<?php echo $contador_elementos; ?>_1', 'capa_unicos_principal_<?php echo $contador_elementos; ?>')" id="capa_principal_<?php echo $contador_elementos; ?>_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_principal_<?php echo $contador_elementos; ?> poin">
                            <div class="font-bold text-left mr-2">
                                Si
                            </div>
                            <div id="contracheck_principal_<?php echo $contador_elementos; ?>_1" class="hidden w-6 h-6 contracheck_capa_unicos_principal_<?php echo $contador_elementos; ?>">
                                &nbsp;
                            </div>
                            <div id="check_principal_<?php echo $contador_elementos; ?>_1" class="hidden check_capa_unicos_principal_<?php echo $contador_elementos; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="principal_<?php echo $contador_elementos; ?>" id="principal_<?php echo $contador_elementos; ?>_1" value="1" class="hidden" />
                        </div>
                        <div onclick="activarElementoUnicoFicha('principal_<?php echo $contador_elementos; ?>_2', 'capa_principal_<?php echo $contador_elementos; ?>_2', 'capa_unicos_principal_<?php echo $contador_elementos; ?>')" id="capa_principal_<?php echo $contador_elementos; ?>_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_principal_<?php echo $contador_elementos; ?>">
                            <div class="font-bold text-left mr-2">
                                No
                            </div>
                            <div id="contracheck_principal_<?php echo $contador_elementos; ?>_2" class="hidden w-6 h-6 contracheck_capa_unicos_principal_<?php echo $contador_elementos; ?>">
                                &nbsp;
                            </div>
                            <div id="check_principal_<?php echo $contador_elementos; ?>_2" class="hidden check_capa_unicos_principal_<?php echo $contador_elementos; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="principal_<?php echo $contador_elementos; ?>" id="principal_<?php echo $contador_elementos; ?>_2" value="0" class="hidden" />
                            <script type="text/javascript">
                                activarElementoUnicoFicha('principal_<?php echo $contador_elementos; ?>_2', 'capa_principal_<?php echo $contador_elementos; ?>_2', "capa_unicos_principal_<?php echo $contador_elementos; ?>");
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="unidad_activo_<?php echo $contador_elementos; ?>" id="unidad_activo_<?php echo $contador_elementos; ?>" value="<?php echo $activo_productos_unidades[$key_productos_unidades]; ?>" />
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <div class="text-left">Fecha alta unidad:</div>
                    <div class="text-center"><?php echo $fecha_alta_productos_unidades[$key_productos_unidades]; ?></div>
                </div>
                <div>
                    <div class="text-left">Fecha última modificación unidad:</div>
                    <div class="text-center"><?php echo $fecha_modificacion_productos_unidades[$key_productos_unidades]; ?></div>
                </div>
            </div>
            <div id="capa_guardar_update_<?php echo $contador_elementos; ?>" class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div class="flex justify-end space-x-2">
                    <?php
                    if(!empty($id_url)) {
                        ?>
                        <button class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarUnidades('eliminar-unidades','<?php echo $contador_elementos; ?>');">Eliminar</button>
                        <?php
                    }
                    ?>
                    <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarUnidades('guardar-unidades','<?php echo $contador_elementos; ?>');">Guardar</button>
                </div>
            </div>
            <?php
            $contador_elementos += 1;
        }
    }
}
?>
<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <div class="text-center font-bold">
        NUEVA UNIDAD
    </div>
</div>
<input type="hidden" name="id_productos_unidades_0" id="id_productos_unidades_0" value="0" />
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="id_unidades_0">Unidad:</label><br>
        <select id="id_unidades_0" name="id_unidades_0" class="w-full" required>
            <option value="0" selected></option>
            <?php
            foreach ($id_unidades as $key_unidades => $valor_unidades) {
                ?>
                <option value="<?php echo$valor_unidades; ?>"><?php echo $unidad_unidades[$key_unidades]." (".$abreviatura_unidades[$key_unidades].")"; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <?php
    if(isset($unidad_principal)) {
        ?>
        <div>
            <label for="conversion_0">Equivalencia en <?php echo $unidad_principal; ?>:</label><br>
            <input type="number" name="conversion_0" id="conversion_0" placeholder="Equivalencia en <?php echo $unidad_principal; ?>" class="w-full" value="1" required />
        </div>
        <?php
    }
    ?>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <?php
        if($existe_unidad_principal == false) {
            ?>
            <label>Convertir en unidad base:</label><br>
            <div class="flex flex-wrap">
                <div onclick="activarElementoUnicoFicha('principal_0_1', 'capa_principal_0_1', 'capa_unicos_principal_0')" id="capa_principal_0_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_principal_0 poin">
                    <div class="font-bold text-left mr-2">
                        Si
                    </div>
                    <div id="contracheck_principal_0_1" class="hidden w-6 h-6 contracheck_capa_unicos_principal_0">
                        &nbsp;
                    </div>
                    <div id="check_principal_0_1" class="hidden check_capa_unicos_principal_0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="principal_0" id="principal_0_1" value="1" class="hidden" />
                    <script type="text/javascript">
                        activarElementoUnicoFicha('principal_0_1', 'capa_principal_0_1', "capa_unicos_principal_0");
                    </script>
                </div>
            </div>
            <?php
        }else {
            ?>
            <label>Convertir en unidad base:</label><br>
            <div class="flex flex-wrap">
                <div onclick="activarElementoUnicoFicha('principal_0_1', 'capa_principal_0_1', 'capa_unicos_principal_0')" id="capa_principal_0_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_principal_0 poin">
                    <div class="font-bold text-left mr-2">
                        Si
                    </div>
                    <div id="contracheck_principal_0_1" class="hidden w-6 h-6 contracheck_capa_unicos_principal_0">
                        &nbsp;
                    </div>
                    <div id="check_principal_0_1" class="hidden check_capa_unicos_principal_0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="principal_0" id="principal_0_1" value="1" class="hidden" />
                </div>
                <div onclick="activarElementoUnicoFicha('principal_0_2', 'capa_principal_0_2', 'capa_unicos_principal_0')" id="capa_principal_0_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_principal_0">
                    <div class="font-bold text-left mr-2">
                        No
                    </div>
                    <div id="contracheck_principal_0_2" class="hidden w-6 h-6 contracheck_capa_unicos_principal_0">
                        &nbsp;
                    </div>
                    <div id="check_principal_0_2" class="hidden check_capa_unicos_principal_0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="principal_0" id="principal_0_2" value="0" class="hidden" />
                    <script type="text/javascript">
                        activarElementoUnicoFicha('principal_0_2', 'capa_principal_0_2', "capa_unicos_principal_0");
                    </script>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<input type="hidden" name="unidad_activo_0" id="unidad_activo_0" value="1" />
<div id="capa_guardar_insert" class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="flex justify-end">
        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarUnidades('guardar-unidades','0');">Guardar</button>
    </div>
</div>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
