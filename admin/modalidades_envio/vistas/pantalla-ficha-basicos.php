<input type="hidden" name="apartado" id="apartado" value="null" />
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="descripcion_modalidades_envio">Descripción:</label><br>
        <input type="text" name="descripcion_modalidades_envio" id="descripcion_modalidades_envio" class="w-full" placeholder="Descripción" value="<?php echo $descripcion_modalidades_envio; ?>" required />
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="explicacion_modalidades_envio">Explicación:</label><br>
        <textarea name="explicacion_modalidades_envio" id="explicacion_modalidades_envio" class="w-full" placeholder="Explicación" required><?php echo $explicacion_modalidades_envio; ?></textarea>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <?php
        $id_select_sys = "id_iva_modalidades_envio";
        $id_iva_url = $id_iva_modalidades_envio;
        require($_SERVER['DOCUMENT_ROOT']."/admin/iva/componentes/form-select.php");
        ?>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="incremento_pvp_modalidades_envio">Incremento PVP:</label><br>
        <input type="number" name="incremento_pvp_modalidades_envio" id="incremento_pvp_modalidades_envio" class="w-full" placeholder="Incremento PVP" value="<?php echo $incremento_pvp_modalidades_envio; ?>" min="0.00" step="1" required />
    </div>
</div>
<script type="text/javascript">
    activarBotonesPorDefectoFicha();
</script>