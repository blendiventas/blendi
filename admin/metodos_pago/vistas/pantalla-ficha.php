<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/metodos_pago/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha del método de pago <span class="font-medium"><?php echo (empty($descripcion_metodos_pago))? '' : $descripcion_metodos_pago; ?></span>');
        setRutaSys('metodos_pago');
    </script>
    <?php
}

?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_metodos_pago" id="id_metodos_pago" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="descripcion_metodos_pago">Descripción:</label><br>
                <input type="text" name="descripcion_metodos_pago" id="descripcion_metodos_pago" class="w-full" placeholder="Descripción" value="<?php echo $descripcion_metodos_pago; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <?php
                if($activo_metodos_pago == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                }
                ?>
                <label>Activo:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('activo_metodo_pago_1', 'capa_activo_metodo_pago_1', 'capa_unicos_activo_metodo_pago')" id="capa_activo_metodo_pago_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_metodo_pago poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_activo_metodo_pago_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo_metodo_pago">
                            &nbsp;
                        </div>
                        <div id="check_activo_metodo_pago_1" class="hidden check_capa_unicos_activo_metodo_pago">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_metodos_pago" id="activo_metodo_pago_1" value="1" class="hidden" />
                        <?php
                        if ($activo_metodos_pago == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_metodo_pago_1', 'capa_activo_metodo_pago_1', "capa_unicos_activo_metodo_pago");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('activo_metodo_pago_2', 'capa_activo_metodo_pago_2', 'capa_unicos_activo_metodo_pago')" id="capa_activo_metodo_pago_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_metodo_pago">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_activo_metodo_pago_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo_metodo_pago">
                            &nbsp;
                        </div>
                        <div id="check_activo_metodo_pago_2" class="hidden check_capa_unicos_activo_metodo_pago">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_metodos_pago" id="activo_metodo_pago_2" value="0" class="hidden" />
                        <?php
                        if ($activo_metodos_pago != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_metodo_pago_2', 'capa_activo_metodo_pago_2', "capa_unicos_activo_metodo_pago");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div>
                <?php
                if($prioritario_metodos_pago == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                    $disabled_sys = " disabled";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                    $disabled_sys = "";
                }
                ?>
                <label>Prioritario:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('prioritario_metodo_pago_1', 'capa_prioritario_metodo_pago_1', 'capa_unicos_prioritario_metodo_pago')" id="capa_prioritario_metodo_pago_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_prioritario_metodo_pago poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_prioritario_metodo_pago_1" class="hidden w-6 h-6 contracheck_capa_unicos_prioritario_metodo_pago">
                            &nbsp;
                        </div>
                        <div id="check_prioritario_metodo_pago_1" class="hidden check_capa_unicos_prioritario_metodo_pago">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="prioritario_metodos_pago" id="prioritario_metodo_pago_1" value="1" class="hidden" />
                        <?php
                        if ($prioritario_metodos_pago == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('prioritario_metodo_pago_1', 'capa_prioritario_metodo_pago_1', "capa_unicos_prioritario_metodo_pago");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('prioritario_metodo_pago_2', 'capa_prioritario_metodo_pago_2', 'capa_unicos_prioritario_metodo_pago')" id="capa_prioritario_metodo_pago_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_prioritario_metodo_pago <?php echo ($disabled_sys)? 'hidden' : ''; ?>">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_prioritario_metodo_pago_2" class="hidden w-6 h-6 contracheck_capa_unicos_prioritario_metodo_pago">
                            &nbsp;
                        </div>
                        <div id="check_prioritario_metodo_pago_2" class="hidden check_capa_unicos_prioritario_metodo_pago">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="prioritario_metodos_pago" id="prioritario_metodo_pago_2" value="0" class="hidden" />
                        <?php
                        if ($prioritario_metodos_pago != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('prioritario_metodo_pago_2', 'capa_prioritario_metodo_pago_2', "capa_unicos_prioritario_metodo_pago");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <?php
                if($directo_metodos_pago == 1) {
                    $checked_directo_sys = " checked";
                    $checked_indirecto_sys = "";
                }else {
                    $checked_directo_sys = "";
                    $checked_indirecto_sys = " checked";
                }
                ?>
                <label>Pago directo:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('directo_metodo_pago_1', 'capa_directo_metodo_pago_1', 'capa_unicos_directo_metodo_pago')" id="capa_directo_metodo_pago_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_directo_metodo_pago poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_directo_metodo_pago_1" class="hidden w-6 h-6 contracheck_capa_unicos_directo_metodo_pago">
                            &nbsp;
                        </div>
                        <div id="check_directo_metodo_pago_1" class="hidden check_capa_unicos_directo_metodo_pago">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="directo_metodos_pago" id="directo_metodo_pago_1" value="1" class="hidden" />
                        <?php
                        if ($directo_metodos_pago == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('directo_metodo_pago_1', 'capa_directo_metodo_pago_1', "capa_unicos_directo_metodo_pago");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('directo_metodo_pago_2', 'capa_directo_metodo_pago_2', 'capa_unicos_directo_metodo_pago')" id="capa_directo_metodo_pago_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_directo_metodo_pago">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_directo_metodo_pago_2" class="hidden w-6 h-6 contracheck_capa_unicos_directo_metodo_pago">
                            &nbsp;
                        </div>
                        <div id="check_directo_metodo_pago_2" class="hidden check_capa_unicos_directo_metodo_pago">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="directo_metodos_pago" id="directo_metodo_pago_2" value="0" class="hidden" />
                        <?php
                        if ($directo_metodos_pago != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('directo_metodo_pago_2', 'capa_directo_metodo_pago_2', "capa_unicos_directo_metodo_pago");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="explicacion_metodos_pago">Explicación:</label><br>
                <textarea name="explicacion_metodos_pago" id="explicacion_metodos_pago" class="w-full" placeholder="Explicación" required><?php echo $explicacion_metodos_pago; ?></textarea>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="interface_metodos_pago">Interface:</label><br>
                <select name="interface_metodos_pago" id="interface_metodos_pago" class="w-full">
                    <option value="tpv" <?php if ($interface_metodos_pago == 'tpv') { echo 'selected'; } ?>>TPV</option>
                    <option value="web" <?php if ($interface_metodos_pago == 'web') { echo 'selected'; } ?>>Web</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <?php
                $id_select_sys = "id_iva_metodos_pago";
                $id_iva_url = $id_iva_metodos_pago;
                require($_SERVER['DOCUMENT_ROOT']."/admin/iva/componentes/form-select.php");
                ?>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="incremento_pvp_metodos_pago">Incremento PVP:</label><br>
                <input type="number" name="incremento_pvp_metodos_pago" id="incremento_pvp_metodos_pago" class="w-full" placeholder="Incremento PVP" value="<?php echo $incremento_pvp_metodos_pago; ?>" min="0.00" step="1" required />
            </div>
            <div>
                <label for="incremento_por_metodos_pago">Incremento por porcentaje:</label><br>
                <input type="number" name="incremento_por_metodos_pago" id="incremento_por_metodos_pago" class="w-full" placeholder="Incremento por porcentaje" value="<?php echo $incremento_por_metodos_pago; ?>" min="0.00" step="1" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="ruta_metodos_pago">Ruta:</label><br>
                <input type="text" name="ruta_metodos_pago" id="ruta_metodos_pago" class="w-full" placeholder="Ruta" value="<?php echo $ruta_metodos_pago; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="sistema_metodos_pago">Sistema:</label><br>
                <input type="text" name="sistema_metodos_pago" id="sistema_metodos_pago" class="w-full" placeholder="Sistema" value="<?php echo $sistema_metodos_pago; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="imagen_metodos_pago">Imagen:</label><br>
                <input type="text" name="imagen_metodos_pago" id="imagen_metodos_pago" class="w-full" placeholder="Imagen" value="<?php echo $imagen_metodos_pago; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="orden_metodos_pago">Orden:</label><br>
                <input type="text" name="orden_metodos_pago" id="orden_metodos_pago" class="w-full" placeholder="Orden" value="<?php echo $orden_metodos_pago; ?>" required />
            </div>
        </div>
    </div>
</form>
