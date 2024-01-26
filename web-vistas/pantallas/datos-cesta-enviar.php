<?php
$hiden = "";
if($id_modalidades_entrega == 1 || empty($id_modalidades_entrega)) {
    $hiden = " hidden";
}
?>
<div class="row-cesta<?php echo $hiden; ?>" id="capa_envio_cesta">
    <div class="m1">
        <label for="id_envio_cesta">
            ENVIAR A
            <?php
            $indice_id_envio_librador_nombre = 0;
            foreach ($id_envio_librador_nombre as $key_id_envio_librador_nombre => $valor_id_envio_librador_nombre) {
                if($id_envio_librador_nombre[$key_id_envio_librador_nombre] == $id_documento) {
                    $indice_id_envio_librador_nombre = $key_id_envio_librador_nombre;
                    ?>
                    <input type="hidden" id="id_envio_cesta" name="id_envio_cesta" value="<?php echo $valor_id_envio_librador_nombre; ?>" />
                    <?php
                    if(isset($envio_direccion)) {
                        echo $envio_direccion[$indice_id_envio_librador_nombre];
                    } else {
                        echo $direccion;
                    }
                }
            }
            ?>
        </label>
    </div>
    <button class="button-documento" onclick="collapseCapa('capa-datos-cabecera-envio'); return false;">
        Datos de envio
    </button>
    <div class="hidden" id="capa-datos-cabecera-envio">
        <?php
        $datos_facturacion_copiar = false;
        if(isset($envio_direccion)) {
            if(empty($envio_direccion[$indice_id_envio_librador_nombre])) {
                $datos_facturacion_copiar = true;
            }
        }else {
            $datos_facturacion_copiar = true;
        }
        if($datos_facturacion_copiar == true) {
            ?>
            <div class="grid-1">
                <div class="row">
                    <button class="button-documento" onclick="copiarDatosFacturacion(document.getElementById('id_envio_cesta').value,'<?php echo $id_librador; ?>');">
                        Guardar los mismos datos de facturación
                    </button>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Nombre:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_librador_nombre)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="nombre_envio_documento" id="nombre_envio_documento" value="<?php echo $envio_librador_nombre[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="nombre_envio_documento" id="nombre_envio_documento" value="<?php echo $librador_nombre; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Apellido 1:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_librador_apellido_1)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="apellido_1_envio" id="apellido_1_envio" value="<?php echo $envio_librador_apellido_1[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="apellido_1_envio" id="apellido_1_envio" value="<?php echo $librador_apellido_1; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Apellido 2:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_librador_apellido_2)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="apellido_2_envio" id="apellido_2_envio" value="<?php echo $envio_librador_apellido_2[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="apellido_2_envio" id="apellido_2_envio" value="<?php echo $librador_apellido_2; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Razón social:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_librador_social)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="razon_social_envio_documento" id="razon_social_envio_documento" value="<?php echo $envio_librador_social[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="razon_social_envio_documento" id="razon_social_envio_documento" value="<?php echo $librador_social; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Nombre comercial:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_librador_comercial)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="razon_comercial_envio_documento" id="razon_comercial_envio_documento" value="<?php echo $envio_librador_comercial[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="razon_comercial_envio_documento" id="razon_comercial_envio_documento" value="<?php echo $librador_comercial; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Dirección:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_direccion)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="direccion_envio_documento" id="direccion_envio_documento" value="<?php echo $envio_direccion[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="direccion_envio_documento" id="direccion_envio_documento" value="<?php echo $direccion; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Número:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_numero)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="numero_direccion_envio_documento" id="numero_direccion_envio_documento" value="<?php echo $envio_numero[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="numero_direccion_envio_documento" id="numero_direccion_envio_documento" value="<?php echo $numero; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Escalera:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_escalera)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="escalera_direccion_envio_documento" id="escalera_direccion_envio_documento" value="<?php echo $envio_escalera[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="escalera_direccion_envio_documento" id="escalera_direccion_envio_documento" value="<?php echo $escalera; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Piso:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_piso)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="piso_direccion_envio_documento" id="piso_direccion_envio_documento" value="<?php echo $envio_piso[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="piso_direccion_envio_documento" id="piso_direccion_envio_documento" value="<?php echo $piso; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Puerta:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_puerta)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="puerta_direccion_envio_documento" id="puerta_direccion_envio_documento" value="<?php echo $envio_puerta[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="puerta_direccion_envio_documento" id="puerta_direccion_envio_documento" value="<?php echo $puerta; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Localidad:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_localidad)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="localidad_envio_documento" id="localidad_envio_documento" value="<?php echo $envio_localidad[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="localidad_envio_documento" id="localidad_envio_documento" value="<?php echo $localidad; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Código postal:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_codigo_postal)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="codigo_postal_envio_documento" id="codigo_postal_envio_documento" value="<?php echo $envio_codigo_postal[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="codigo_postal_envio_documento" id="codigo_postal_envio_documento" value="<?php echo $codigo_postal; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Provincia:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_provincia)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="provincia_envio_documento" id="provincia_envio_documento" value="<?php echo $envio_provincia[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="provincia_envio_documento" id="provincia_envio_documento" value="<?php echo $provincia; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Zona:</strong>
            </div>
            <div class="row text-left">
                <select class="w-96" id="id_zona_envio" name="id_zona_envio" required>
                    <?php
                    if(isset($matriz_id_libradores_zonas)) {
                        foreach ($matriz_id_libradores_zonas as $key_libradores_zona => $valor_libradores_zona) {
                            $selected = "";
                            if(isset($envio_id_zona)) {
                                if ($envio_id_zona[$indice_id_envio_librador_nombre] == $valor_libradores_zona) {
                                    $selected = " selected";
                                }
                            }else {
                                if($id_zona == $valor_libradores_zona) {
                                    $selected = " selected";
                                }
                            }
                            ?>
                            <option value="<?php echo $valor_libradores_zona; ?>"<?php echo $selected; ?>><?php echo $matriz_zona_libradores_zonas[$key_libradores_zona]; ?></option>
                            <?php
                        }
                        unset($matriz_id_libradores_zonas);
                        unset($matriz_zona_libradores_zonas);
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Teléfono 1:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_telefono_1)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="telefono_1_envio_documento" id="telefono_1_envio_documento" value="<?php echo $envio_telefono_1[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="telefono_1_envio_documento" id="telefono_1_envio_documento" value="<?php echo $telefono_1; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Teléfono 2:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_telefono_2)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="telefono_2_envio_documento" id="telefono_2_envio_documento" value="<?php echo $envio_telefono_2[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="telefono_2_envio_documento" id="telefono_2_envio_documento" value="<?php echo $telefono_2; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Móvil:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_mobil)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="mobil_envio_documento" id="mobil_envio_documento" value="<?php echo $envio_mobil[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="mobil_envio_documento" id="mobil_envio_documento" value="<?php echo $mobil; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Persona contacto:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_persona_contacto)) {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="persona_contacto_envio_documento" id="persona_contacto_envio_documento" value="<?php echo $envio_persona_contacto[$indice_id_envio_librador_nombre]; ?>" />
                    <?php
                }else {
                    ?>
                    <input type="text" class="sin-borde input-cesta" name="persona_contacto_envio_documento" id="persona_contacto_envio_documento" value="<?php echo $persona_contacto; ?>" />
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left input-cesta">
                <strong>Observaciones:</strong>
            </div>
            <div class="row text-left">
                <?php
                if(isset($envio_observaciones)) {
                    ?>
                    <textarea class="w-96" name="observaciones_envio_documento" id="observaciones_envio_documento"><?php echo $envio_observaciones[$indice_id_envio_librador_nombre]; ?></textarea>
                    <?php
                }else {
                    ?>
                    <textarea class="w-96" name="observaciones_envio_documento" id="observaciones_envio_documento"></textarea>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="grid-2-cesta">
            <div class="row text-left">
                <input type="checkbox" name="check_guardar_datos_envio_cesta" id="check_guardar_datos_envio_cesta" /> Actualizar ficha.
            </div>
            <div class="row">
                <button class="button-documento" onclick="datosEnvioCesta(document.getElementById('id_envio_cesta').value,'<?php echo $id_librador; ?>','guardar-envio');">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>