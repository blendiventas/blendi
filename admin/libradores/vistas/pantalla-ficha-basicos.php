<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center">
    <div>
        <label for="nombre_libradores">Código:</label><br>
        <input type="text" name="codigo_libradores" id="codigo_libradores" maxlength="20" placeholder="Código" class="w-full" value="<?php echo $codigo_librador_libradores; ?>" />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="nombre_libradores">Nombre:</label><br>
        <input type="text" name="nombre_libradores" id="nombre_libradores" maxlength="60" placeholder="Nombre" class="w-full" value="<?php echo $nombre_libradores; ?>" required />
    </div>
    <div>
        <label for="apellido_1_libradores">Apellido 1:</label><br>
        <input type="text" name="apellido_1_libradores" id="apellido_1_libradores" maxlength="60" placeholder="Apellido 1" class="w-full" value="<?php echo $apellido_1_libradores; ?>" required />
    </div>
    <div>
        <label for="apellido_2_libradores">Apellido 2:</label><br>
        <input type="text" name="apellido_2_libradores" id="apellido_2_libradores" maxlength="60" placeholder="Apellido 2" class="w-full" value="<?php echo $apellido_2_libradores; ?>" required />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="razon_social_libradores">Razón social:</label><br>
        <input type="text" name="razon_social_libradores" id="razon_social_libradores" maxlength="100" placeholder="Razón social" class="w-full" value="<?php echo $razon_social_libradores; ?>" required />
    </div>
    <div>
        <label for="razon_comercial_libradores">Razón comercial:</label><br>
        <input type="text" name="razon_comercial_libradores" id="razon_comercial_libradores" maxlength="75" placeholder="Razón comercial" class="w-full" value="<?php echo $razon_comercial_libradores; ?>" required />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center">
    <div>
        <label for="nif_libradores">NIF:</label><br>
        <input type="text" name="nif_libradores" id="nif_libradores" maxlength="20" placeholder="NIF" class="w-full" value="<?php echo $nif_libradores; ?>" />
    </div>
</div>
<div class="grid grid-cols-1 mt-3 items-center">
    <div>
        <?php
        if($tipo_librador_libradores == "cli" || $tipo_librador_libradores == "tak" || $tipo_librador_libradores == "del") {
            ?>
            <div>
                <label>Usar embalajes en las ventas:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('tipo_librador_1', 'capa_tipo_librador_1', 'capa_unicos_tipo_librador')" id="capa_tipo_librador_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_tipo_librador poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_tipo_librador_1" class="hidden w-6 h-6 contracheck_capa_unicos_tipo_librador">
                            &nbsp;
                        </div>
                        <div id="check_tipo_librador_1" class="hidden check_capa_unicos_tipo_librador">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="tipo_librador" id="tipo_librador_1" value="<?php echo (empty($tipo_librador_libradores) || $tipo_librador_libradores == 'cli')? 'tak' : $tipo_librador_libradores; ?>" class="hidden" />
                        <?php
                        if (!empty($tipo_librador_libradores) && $tipo_librador_libradores == 'tak' || $tipo_librador_libradores == "del") {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('tipo_librador_1', 'capa_tipo_librador_1', "capa_unicos_tipo_librador");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('tipo_librador_2', 'capa_tipo_librador_2', 'capa_unicos_tipo_librador')" id="capa_tipo_librador_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_tipo_librador">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_tipo_librador_2" class="hidden w-6 h-6 contracheck_capa_unicos_tipo_librador">
                            &nbsp;
                        </div>
                        <div id="check_tipo_librador_2" class="hidden check_capa_unicos_tipo_librador">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="tipo_librador" id="tipo_librador_2" value="cli" class="hidden" />
                        <?php
                        if (empty($tipo_librador_libradores) || $tipo_librador_libradores == 'cli') {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('tipo_librador_2', 'capa_tipo_librador_2', "capa_unicos_tipo_librador");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }else {
            ?>
            &nbsp;<input type="hidden" name="tipo_librador" id="tipo_librador" value="<?php echo $tipo_librador_libradores; ?>" />
            <?php
        }
        ?>
    </div>
</div>
<?php
if($activo_libradores == 1) {
    $checked_activo_sys = " checked";
    $checked_inactivo_sys = "";
}else {
    $checked_activo_sys = "";
    $checked_inactivo_sys = " checked";
}
?>
<div class="grid grid-cols-1 mt-3 items-center">
    <div>
        <label>Activo:</label><br>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('activo_libradores_1', 'capa_activo_libradores_1', 'capa_unicos_activo_libradores')" id="capa_activo_libradores_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_libradores poin">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_activo_libradores_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo_libradores">
                    &nbsp;
                </div>
                <div id="check_activo_libradores_1" class="hidden check_capa_unicos_activo_libradores">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo_libradores" id="activo_libradores_1" value="1" class="hidden" />
                <?php
                if ($activo_libradores == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('activo_libradores_1', 'capa_activo_libradores_1', "capa_unicos_activo_libradores");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('activo_libradores_2', 'capa_activo_libradores_2', 'capa_unicos_activo_libradores')" id="capa_activo_libradores_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_libradores">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_activo_libradores_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo_libradores">
                    &nbsp;
                </div>
                <div id="check_activo_libradores_2" class="hidden check_capa_unicos_activo_libradores">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo_libradores" id="activo_libradores_2" value="0" class="hidden" />
                <?php
                if ($activo_libradores != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('activo_libradores_2', 'capa_activo_libradores_2', "capa_unicos_activo_libradores");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="id_grupo_clientes_libradores" id="id_grupo_clientes_libradores" value="<?php echo $id_grupo_clientes_libradores; ?>" />
<input type="hidden" name="direccion_libradores" id="direccion_libradores" value="<?php echo $direccion_libradores; ?>" />
<input type="hidden" name="numero_libradores" id="numero_libradores" value="<?php echo $numero_libradores; ?>" />
<input type="hidden" name="escalera_libradores" id="escalera_libradores" value="<?php echo $escalera_libradores; ?>" />
<input type="hidden" name="piso_libradores" id="piso_libradores" value="<?php echo $piso_libradores; ?>" />
<input type="hidden" name="puerta_libradores" id="puerta_libradores" value="<?php echo $puerta_libradores; ?>" />
<input type="hidden" name="localidad_libradores" id="localidad_libradores" value="<?php echo $localidad_libradores; ?>" />
<input type="hidden" name="codigo_postal_libradores" id="codigo_postal_libradores" value="<?php echo $codigo_postal_libradores; ?>" />
<input type="hidden" name="provincia_libradores" id="provincia_libradores" value="<?php echo $provincia_libradores; ?>" />
<input type="hidden" name="id_zona_libradores" id="id_zona_libradores" value="<?php echo $id_zona_libradores; ?>" />
<input type="hidden" name="telefono_1_libradores" id="telefono_1_libradores" value="<?php echo $telefono_1_libradores; ?>" />
<input type="hidden" name="telefono_2_libradores" id="telefono_2_libradores" value="<?php echo $telefono_2_libradores; ?>" />
<input type="hidden" name="fax_libradores" id="fax_libradores" value="<?php echo $fax_libradores; ?>" />
<input type="hidden" name="mobil_libradores" id="mobil_libradores" value="<?php echo $mobil_libradores; ?>" />
<input type="hidden" name="email_libradores" id="email_libradores" value="<?php echo $email_libradores; ?>" />
<input type="hidden" name="password_acceso_libradores" id="password_acceso_libradores" value="<?php echo $password_acceso_libradores; ?>" />
<input type="hidden" name="id_categoria_sms_libradores" id="id_categoria_sms_libradores" value="<?php echo $id_categoria_sms_libradores; ?>" />
<input type="hidden" name="id_categoria_email_libradores" id="id_categoria_email_libradores" value="<?php echo $id_categoria_email_libradores; ?>" />
<input type="hidden" name="persona_contacto_libradores" id="persona_contacto_libradores" value="<?php echo $persona_contacto_libradores; ?>" />
<input type="hidden" name="banco_libradores" id="banco_libradores" value="<?php echo $banco_libradores; ?>" />
<input type="hidden" name="entidad_libradores" id="entidad_libradores" value="<?php echo $entidad_libradores; ?>" />
<input type="hidden" name="agencia_libradores" id="agencia_libradores" value="<?php echo $agencia_libradores; ?>" />
<input type="hidden" name="dc_libradores" id="dc_libradores" value="<?php echo $dc_libradores; ?>" />
<input type="hidden" name="cuenta_libradores" id="cuenta_libradores" value="<?php echo $cuenta_libradores; ?>" />
<input type="hidden" name="iban_libradores" id="iban_libradores" value="<?php echo $iban_libradores; ?>" />
<input type="hidden" name="sexo_libradores" id="sexo_libradores" value="<?php echo $sexo_libradores; ?>" />
<input type="hidden" name="fecha_nacimiento_libradores" id="fecha_nacimiento_libradores" value="<?php echo $fecha_nacimiento_libradores; ?>" />
<input type="hidden" name="observaciones_libradores" id="observaciones_libradores" value="<?php echo $observaciones_libradores; ?>" />
<input type="hidden" name="id_modalidades_envio_libradores" id="id_modalidades_envio_libradores" value="<?php echo $id_modalidades_envio_libradores; ?>" />
<input type="hidden" name="id_modalidades_entrega_libradores" id="id_modalidades_entrega_libradores" value="<?php echo $id_modalidades_entrega_libradores; ?>" />
<input type="hidden" name="id_modalidades_pago_libradores" id="id_modalidades_pago_libradores" value="<?php echo $id_modalidades_pago_libradores; ?>" />
<input type="hidden" name="plazo_entrega_libradores" id="plazo_entrega_libradores" value="<?php echo $plazo_entrega_libradores; ?>" />
<input type="hidden" name="id_iva_libradores" id="id_iva_libradores" value="<?php echo $id_iva_libradores; ?>" />
<input type="hidden" name="recargo_libradores" id="recargo_libradores" value="<?php echo $recargo_libradores; ?>" />
<input type="hidden" name="id_irpf_libradores" id="id_irpf_libradores" value="<?php echo $id_irpf_libradores; ?>" />
<input type="hidden" name="dia_pago_1_libradores" id="dia_pago_1_libradores" value="<?php echo $dia_pago_1_libradores; ?>" />
<input type="hidden" name="dia_pago_2_libradores" id="dia_pago_2_libradores" value="<?php echo $dia_pago_2_libradores; ?>" />
<input type="hidden" name="descuento_pp_libradores" id="descuento_pp_libradores" value="<?php echo $descuento_pp_libradores; ?>" />
<input type="hidden" name="descuento_librador_libradores" id="descuento_librador_libradores" value="<?php echo $descuento_librador_libradores; ?>" />
<input type="hidden" name="procedencia_libradores" id="procedencia_libradores" value="<?php echo $procedencia_libradores; ?>" />
<input type="hidden" name="id_cliente_origen_libradores" id="id_cliente_origen_libradores" value="<?php echo $id_cliente_origen_libradores; ?>" />
<input type="hidden" name="id_vendedor_libradores" id="id_vendedor_libradores" value="<?php echo $id_vendedor_libradores; ?>" />
<input type="hidden" name="id_nivel_comisiones_libradores" id="id_nivel_comisiones_libradores" value="<?php echo $id_nivel_comisiones_libradores; ?>" />

<?php
if($tipo_libradores_url == "cli") {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
        <div>
            <?php
            $titulo_tarifa = "Tarifa web";
            $id_select_sys = "id_tarifa_web_libradores";
            $id_tarifas = $id_tarifa_web_libradores;
            require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/componentes/form-select.php");
            ?>
        </div>
        <div>
            <?php
            $titulo_tarifa = "Tarifa TPV";
            $id_select_sys = "id_tarifa_tpv_libradores";
            $id_tarifas = $id_tarifa_tpv_libradores;
            require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/componentes/form-select.php");
            ?>
        </div>
    </div>
    <?php
}else {
    ?>
    <input type="hidden" name="id_tarifa_web_libradores" id="id_tarifa_web_libradores" value="<?php echo $id_tarifa_web_libradores; ?>" />
    <input type="hidden" name="id_tarifa_tpv_libradores" id="id_tarifa_tpv_libradores" value="<?php echo $id_tarifa_tpv_libradores; ?>" />
    <?php
}
?>

<input type="hidden" name="id_banco_cobro_libradores" id="id_banco_cobro_libradores" value="<?php echo $id_banco_cobro_libradores; ?>" />
<div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
    <div>
        <div class="text-left">Fecha alta:</div>
        <div class="text-center"><?php echo $fecha_alta_libradores; ?></div>
    </div>
    <div>
        <div class="text-left">Fecha última modificación:</div>
        <div class="text-center"><?php echo $fecha_modificacion_libradores; ?></div>
    </div>
</div>

<script type="text/javascript">
    activarBotonesPorDefectoFicha();
</script>
