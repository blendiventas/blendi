<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/iva/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha del IVA <span class="font-medium"><?php echo (empty($iva_productos_iva))? '' : $iva_productos_iva; ?></span>');
        setRutaSys('iva');
    </script>
    <?php
}

?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_productos_iva" id="id_productos_iva" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="iva_productos_iva">Porcentaje IVA:</label><br>
                <input type="number" name="iva_productos_iva" id="iva_productos_iva" class="w-full" placeholder="Porcentaje IVA" value="<?php echo $iva_productos_iva; ?>" min="0.00" step="0.01" required />
            </div>
            <div>
                <label for="recargo_productos_iva">Porcentaje recargo de equivalencia:</label><br>
                <input type="number" name="recargo_productos_iva" id="recargo_productos_iva" class="w-full" placeholder="Porcentaje recargo de equivalencia" value="<?php echo $recargo_productos_iva; ?>" min="0.00" step="0.01" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <?php
                if($activo_productos_iva == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                }
                ?>
                <label>Activo:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('activo_iva_1', 'capa_activo_iva_1', 'capa_unicos_activo_iva')" id="capa_activo_iva_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_iva poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_activo_iva_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo_iva">
                            &nbsp;
                        </div>
                        <div id="check_activo_iva_1" class="hidden check_capa_unicos_activo_iva">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_productos_iva" id="activo_iva_1" value="1" class="hidden" />
                        <?php
                        if ($activo_productos_iva == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_iva_1', 'capa_activo_iva_1', "capa_unicos_activo_iva");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('activo_iva_2', 'capa_activo_iva_2', 'capa_unicos_activo_iva')" id="capa_activo_iva_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_iva">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_activo_iva_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo_iva">
                            &nbsp;
                        </div>
                        <div id="check_activo_iva_2" class="hidden check_capa_unicos_activo_iva">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_productos_iva" id="activo_iva_2" value="0" class="hidden" />
                        <?php
                        if ($activo_productos_iva != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_iva_2', 'capa_activo_iva_2', "capa_unicos_activo_iva");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div>
                <?php
                if($prioritario_productos_iva == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                    $disabled_sys = " disabled";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                    $disabled_sys = "";
                }
                ?>
                <label>Tipo prioritario:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('prioritario_iva_1', 'capa_prioritario_iva_1', 'capa_unicos_prioritario_iva')" id="capa_prioritario_iva_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_prioritario_iva poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_prioritario_iva_1" class="hidden w-6 h-6 contracheck_capa_unicos_prioritario_iva">
                            &nbsp;
                        </div>
                        <div id="check_prioritario_iva_1" class="hidden check_capa_unicos_prioritario_iva">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="prioritario_productos_iva" id="prioritario_iva_1" value="1" class="hidden" />
                        <?php
                        if ($prioritario_productos_iva == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('prioritario_iva_1', 'capa_prioritario_iva_1', "capa_unicos_prioritario_iva");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('prioritario_iva_2', 'capa_prioritario_iva_2', 'capa_unicos_prioritario_iva')" id="capa_prioritario_iva_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_prioritario_iva <?php echo ($disabled_sys)? 'hidden' : ''; ?>">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_prioritario_iva_2" class="hidden w-6 h-6 contracheck_capa_unicos_prioritario_iva">
                            &nbsp;
                        </div>
                        <div id="check_prioritario_iva_2" class="hidden check_capa_unicos_prioritario_iva">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="prioritario_productos_iva" id="prioritario_iva_2" value="0" class="hidden" />
                        <?php
                        if ($prioritario_productos_iva != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('prioritario_iva_2', 'capa_prioritario_iva_2', "capa_unicos_prioritario_iva");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
