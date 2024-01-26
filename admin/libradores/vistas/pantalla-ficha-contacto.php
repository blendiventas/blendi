<input type="hidden" name="id_grupo_clientes_libradores" id="id_grupo_clientes_libradores" value="<?php echo $id_grupo_clientes_libradores; ?>" />
<input type="hidden" name="codigo_libradores" id="codigo_libradores" value="<?php echo $codigo_librador_libradores; ?>" />
<input type="hidden" name="nombre_libradores" id="nombre_libradores" value="<?php echo $nombre_libradores; ?>" />
<input type="hidden" name="apellido_1_libradores" id="apellido_1_libradores" value="<?php echo $apellido_1_libradores; ?>" />
<input type="hidden" name="apellido_2_libradores" id="apellido_2_libradores" value="<?php echo $apellido_2_libradores; ?>" />
<input type="hidden" name="razon_social_libradores" id="razon_social_libradores" value="<?php echo $razon_social_libradores; ?>" />
<input type="hidden" name="razon_comercial_libradores" id="razon_comercial_libradores" value="<?php echo $razon_comercial_libradores; ?>" />
<input type="hidden" name="nif_libradores" id="nif_libradores" value="<?php echo $nif_libradores; ?>" />
<input type="hidden" name="direccion_libradores" id="direccion_libradores" value="<?php echo $direccion_libradores; ?>" />
<input type="hidden" name="numero_libradores" id="numero_libradores" value="<?php echo $numero_libradores; ?>" />
<input type="hidden" name="escalera_libradores" id="escalera_libradores" value="<?php echo $escalera_libradores; ?>" />
<input type="hidden" name="piso_libradores" id="piso_libradores" value="<?php echo $piso_libradores; ?>" />
<input type="hidden" name="puerta_libradores" id="puerta_libradores" value="<?php echo $puerta_libradores; ?>" />
<input type="hidden" name="localidad_libradores" id="localidad_libradores" value="<?php echo $localidad_libradores; ?>" />
<input type="hidden" name="codigo_postal_libradores" id="codigo_postal_libradores" value="<?php echo $codigo_postal_libradores; ?>" />
<input type="hidden" name="provincia_libradores" id="provincia_libradores" value="<?php echo $provincia_libradores; ?>" />
<input type="hidden" name="id_zona" id="id_zona" value="<?php echo $id_zona; ?>" />
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="mobil_libradores">Móvil:</label><br>
        <input type="tel" name="mobil_libradores" id="mobil_libradores" class="w-full" maxlength="11" placeholder="Móvil" value="<?php echo $mobil_libradores; ?>" />
    </div>
    <div>
        <label for="telefono_1_libradores">Teléfono 1:</label><br>
        <input type="tel" name="telefono_1_libradores" id="telefono_1_libradores" class="w-full" maxlength="12" placeholder="Teléfono 1" value="<?php echo $telefono_1_libradores; ?>" />
    </div>
    <div>
        <label for="telefono_2_libradores">Teléfono 2:</label><br>
        <input type="tel" name="telefono_2_libradores" id="telefono_2_libradores" class="w-full" maxlength="12" placeholder="Teléfono 2" value="<?php echo $telefono_2_libradores; ?>" />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="email_libradores">Email:</label><br>
        <input type="email" name="email_libradores" id="email_libradores" class="w-full" maxlength="50" placeholder="Email" value="<?php echo $email_libradores; ?>" />
    </div>
    <div>
        <label for="persona_contacto_libradores">Persona de contacto:</label><br>
        <input type="text" name="persona_contacto_libradores" id="persona_contacto_libradores" class="w-full" maxlength="20" placeholder="Persona de contacto" value="<?php echo $persona_contacto_libradores; ?>" />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="fax_libradores">FAX:</label><br>
        <input type="tel" name="fax_libradores" id="fax_libradores" class="w-full" maxlength="12" placeholder="FAX" value="<?php echo $fax_libradores; ?>" />
    </div>
</div>
<?php
if($tipo_libradores_url == "cli") {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
        <div>
            <label for="password_acceso_libradores">Contraseña acceso web:</label><br>
            <input type="text" name="password_acceso_libradores" id="password_acceso_libradores" class="w-full" maxlength="10" placeholder="Contraseña acceso web" value="<?php echo $password_acceso_libradores; ?>" />
        </div>
    </div>
    <?php
}else {
    ?>
    <input type="hidden" name="password_acceso_libradores" id="password_acceso_libradores" value="<?php echo $password_acceso_libradores; ?>" />
    <?php
}
?>
<input type="hidden" name="id_categoria_sms_libradores" id="id_categoria_sms_libradores" value="<?php echo $id_categoria_sms_libradores; ?>" />
<input type="hidden" name="id_categoria_email_libradores" id="id_categoria_email_libradores" value="<?php echo $id_categoria_email_libradores; ?>" />
<input type="hidden" name="banco_libradores" id="banco_libradores" value="<?php echo $banco_libradores; ?>" />
<input type="hidden" name="entidad_libradores" id="entidad_libradores" value="<?php echo $entidad_libradores; ?>" />
<input type="hidden" name="agencia_libradores" id="agencia_libradores" value="<?php echo $agencia_libradores; ?>" />
<input type="hidden" name="dc_libradores" id="dc_libradores" value="<?php echo $dc_libradores; ?>" />
<input type="hidden" name="cuenta_libradores" id="cuenta_libradores" value="<?php echo $cuenta_libradores; ?>" />
<input type="hidden" name="iban_libradores" id="iban_libradores" value="<?php echo $iban_libradores; ?>" />
<input type="hidden" name="sexo_libradores" id="sexo_libradores" value="<?php echo $sexo_libradores; ?>" />
<input type="hidden" name="fecha_nacimiento_libradores" id="fecha_nacimiento_libradores" value="<?php echo $fecha_nacimiento_libradores; ?>" />
<input type="hidden" name="observaciones_libradores" id="observaciones_libradores" value="<?php echo $observaciones_libradores; ?>" />
<input type="hidden" name="id_modalidades_envio" id="id_modalidades_envio" value="<?php echo $id_modalidades_envio; ?>" />
<input type="hidden" name="id_modalidades_entrega" id="id_modalidades_entrega" value="<?php echo $id_modalidades_entrega; ?>" />
<input type="hidden" name="id_modalidades_pago_libradores" id="id_modalidades_pago_libradores" value="<?php echo $id_modalidades_pago_libradores; ?>" />
<input type="hidden" name="plazo_entrega_libradores" id="plazo_entrega_libradores" value="<?php echo $plazo_entrega_libradores; ?>" />
<input type="hidden" name="id_iva_libradores" id="id_iva_libradores" value="<?php echo $id_iva_libradores; ?>" />
<input type="hidden" name="recargo_libradores" id="recargo_libradores" value="<?php echo $recargo_libradores; ?>" />
<input type="hidden" name="id_irpf_libradores" id="id_irpf_libradores" value="<?php echo $id_irpf_libradores; ?>" />
<input type="hidden" name="dia_pago_1_libradores" id="dia_pago_1_libradores" value="<?php echo $dia_pago_1_libradores; ?>" />
<input type="hidden" name="dia_pago_2_libradores" id="dia_pago_2_libradores" value="<?php echo $dia_pago_2_libradores; ?>" />
<input type="hidden" name="descuento_pp_libradores" id="descuento_pp_libradores" value="<?php echo $descuento_pp_libradores; ?>" />
<input type="hidden" name="descuento_librador_libradores" id="descuento_librador_libradores" value="<?php echo $descuento_librador_libradores; ?>" />
<input type="hidden" name="id_tarifa_web_libradores" id="id_tarifa_web_libradores" value="<?php echo $id_tarifa_web_libradores; ?>" />
<input type="hidden" name="id_tarifa_tpv_libradores" id="id_tarifa_tpv_libradores" value="<?php echo $id_tarifa_tpv_libradores; ?>" />
<input type="hidden" name="procedencia_libradores" id="procedencia_libradores" value="<?php echo $procedencia_libradores; ?>" />
<input type="hidden" name="id_cliente_origen_libradores" id="id_cliente_origen_libradores" value="<?php echo $id_cliente_origen_libradores; ?>" />
<input type="hidden" name="id_vendedor_libradores" id="id_vendedor_libradores" value="<?php echo $id_vendedor_libradores; ?>" />
<input type="hidden" name="activo_libradores" id="activo_libradores" value="<?php echo $id_nivel_comisiones_libradores; ?>" />
<input type="hidden" name="activo_libradores" id="inactivo_libradores" value="<?php echo $activo_libradores; ?>" />
<input type="hidden" name="id_banco_cobro_libradores" id="id_banco_cobro_libradores" value="<?php echo $id_banco_cobro_libradores; ?>" />

<script type="text/javascript">
    activarBotonesPorDefectoFicha();
</script>
