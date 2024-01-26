<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_pago/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de la modalidad de pago <span class="font-medium"><?php echo (empty($descripcion_libradores_modalidades_pago))? '' : $descripcion_libradores_modalidades_pago; ?></span>');
        setRutaSys('modalidades_pago');
    </script>
    <?php
}
?>

<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_libradores_modalidades_pago" id="id_libradores_modalidades_pago" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 mt-3 items-center space-x-3" id="formModalidadesPago">
            <div>
                <label for="descripcion_libradores_modalidades_pago">Descripción:</label><br />
                <input type="text" class="w-full" name="descripcion_libradores_modalidades_pago" id="descripcion_libradores_modalidades_pago" placeholder="Descripción" value="<?php echo $descripcion_libradores_modalidades_pago; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 mt-3 items-center space-x-3">
            <div>
                <label for="modalidades_pago_productos_modalidades_pago">Explicación:</label><br />
                <textarea name="explicacion_libradores_modalidades_pago" class="w-full" id="explicacion_libradores_modalidades_pago" placeholder="Expliación" ><?php echo $explicacion_libradores_modalidades_pago; ?></textarea>
            </div>
        </div>
        </div>
        <div class="grid grid-cols-1 mt-3 items-center space-x-3">
            <div>
                <label for="tienda_virtual_libradores_modalidades_pago">Tienda virtual:</label><br />
                <input type="checkbox" class="w-full" name="tienda_virtual_libradores_modalidades_pago" id="tienda_virtual_libradores_modalidades_pago" <?php if ($tienda_virtual_libradores_modalidades_pago) { echo 'checked'; } ?> />
            </div>
        </div>
        <div class="grid grid-cols-1 mt-3 items-center space-x-3">
            <div>
                <label for="defecto_libradores_modalidades_pago">Defecto:</label><br />
                <input type="checkbox" class="w-full" name="defecto_libradores_modalidades_pago" id="defecto_libradores_modalidades_pago" <?php if ($defecto_libradores_modalidades_pago) { echo 'checked'; } ?> />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="incremento_pvp_libradores_modalidades_pago">Incremento pvp:</label><br />
                <input type="number" class="w-full" name="incremento_pvp_libradores_modalidades_pago" id="incremento_pvp_libradores_modalidades_pago" placeholder="Incremento pvp" value="<?php echo $incremento_pvp_libradores_modalidades_pago; ?>" />
            </div>
            <div>
                <label for="incremento_por_libradores_modalidades_pago">Incremento por:</label><br />
                <input type="number" class="w-full" name="incremento_por_libradores_modalidades_pago" id="incremento_por_libradores_modalidades_pago" placeholder="Incremento por" value="<?php echo $incremento_por_libradores_modalidades_pago; ?>" />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <h4>Días para el pago de la modalidad</h4>
            </div>
            <div id="lineas_modalidad_pago">
                <input type="hidden" name="id_modalidades_pago_lineas[]" value="0" />
                Días&nbsp;
                <input type="number" class="w-full" name="dias_modalidades_pago_lineas[]" placeholder="Días" /><br>
                Porcentaje&nbsp;
                <input type="number" class="w-full" name="porcentaje_modalidades_pago_lineas[]" placeholder="Porcentaje" />
            </div>
        </div>
            <div>
                <button type="button" onclick="anadirLinea();">Añadir</button>
            </div>
            <?php
            foreach ($lineas_modalidades_pago as $linea_modalidades_pago) {
                ?>
                <div class="grid grid-cols-1 mt-3 items-center space-x-3">
                    <div>
                        <input type="hidden" name="id_modalidades_pago_lineas[]" value="<?php echo $linea_modalidades_pago['id']; ?>" />
                        Días&nbsp;
                        <input type="number" class="w-full" name="dias_modalidades_pago_lineas[]" placeholder="Días" value="<?php echo $linea_modalidades_pago['dias']; ?>" /><br>
                        Porcentaje&nbsp;
                        <input type="number" class="w-full" name="porcentaje_modalidades_pago_lineas[]" placeholder="Porcentaje" value="<?php echo $linea_modalidades_pago['porcentaje']; ?>" />
                    </div>
                </div>
                <div>
                    <button type="button" onclick="eliminarLinea(this);">Eliminar</button>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</form>
