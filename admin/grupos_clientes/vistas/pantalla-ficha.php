<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/grupos_clientes/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha del Grupo de clientes <span class="font-medium"><?php echo (empty($descripcion_grupos_clientes))? '' : $descripcion_grupos_clientes; ?></span>');
        setRutaSys('grupos_clientes');
    </script>
    <?php
}

?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_grupos_clientes" id="id_grupos_clientes" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="descripcion_grupos_clientes">Descripción:</label><br>
                <input type="text" name="descripcion_grupos_clientes" id="descripcion_grupos_clientes" class="w-full" placeholder="Descripción" value="<?php echo $descripcion_grupos_clientes; ?>" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <?php
                if($activo_grupos_clientes == 1) {
                    $checked_activo_sys = " checked";
                    $checked_inactivo_sys = "";
                }else {
                    $checked_activo_sys = "";
                    $checked_inactivo_sys = " checked";
                }
                ?>
                <label>Activo:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('activo_grupos_clientes_1', 'capa_activo_grupos_clientes_1', 'capa_unicos_activo_grupos_clientes')" id="capa_activo_grupos_clientes_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_grupos_clientes poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_activo_grupos_clientes_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo_grupos_clientes">
                            &nbsp;
                        </div>
                        <div id="check_activo_grupos_clientes_1" class="hidden check_capa_unicos_activo_grupos_clientes">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_grupos_clientes" id="activo_grupos_clientes_1" value="1" class="hidden" />
                        <?php
                        if ($activo_grupos_clientes == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_grupos_clientes_1', 'capa_activo_grupos_clientes_1', "capa_unicos_activo_grupos_clientes");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('activo_grupos_clientes_2', 'capa_activo_grupos_clientes_2', 'capa_unicos_activo_grupos_clientes')" id="capa_activo_grupos_clientes_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_grupos_clientes">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_activo_grupos_clientes_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo_grupos_clientes">
                            &nbsp;
                        </div>
                        <div id="check_activo_grupos_clientes_2" class="hidden check_capa_unicos_activo_grupos_clientes">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_grupos_clientes" id="activo_grupos_clientes_2" value="0" class="hidden" />
                        <?php
                        if ($activo_grupos_clientes != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_grupos_clientes_2', 'capa_activo_grupos_clientes_2', "capa_unicos_activo_grupos_clientes");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div>
                <?php
                if($prioritario_grupos_clientes == 1) {
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
                    <div onclick="activarElementoUnicoFicha('prioritario_grupos_clientes_1', 'capa_prioritario_grupos_clientes_1', 'capa_unicos_prioritario_grupos_clientes')" id="capa_prioritario_grupos_clientes_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_prioritario_grupos_clientes poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_prioritario_grupos_clientes_1" class="hidden w-6 h-6 contracheck_capa_unicos_prioritario_grupos_clientes">
                            &nbsp;
                        </div>
                        <div id="check_prioritario_grupos_clientes_1" class="hidden check_capa_unicos_prioritario_grupos_clientes">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="prioritario_grupos_clientes" id="prioritario_grupos_clientes_1" value="1" class="hidden" />
                        <?php
                        if ($prioritario_grupos_clientes == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('prioritario_grupos_clientes_1', 'capa_prioritario_grupos_clientes_1', "capa_unicos_prioritario_grupos_clientes");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('prioritario_grupos_clientes_2', 'capa_prioritario_grupos_clientes_2', 'capa_unicos_prioritario_grupos_clientes')" id="capa_prioritario_grupos_clientes_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_prioritario_grupos_clientes <?php echo ($disabled_sys)? 'hidden' : ''; ?>">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_prioritario_grupos_clientes_2" class="hidden w-6 h-6 contracheck_capa_unicos_prioritario_grupos_clientes">
                            &nbsp;
                        </div>
                        <div id="check_prioritario_grupos_clientes_2" class="hidden check_capa_unicos_prioritario_grupos_clientes">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="prioritario_grupos_clientes" id="prioritario_grupos_clientes_2" value="0" class="hidden" />
                        <?php
                        if ($prioritario_grupos_clientes != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('prioritario_grupos_clientes_2', 'capa_prioritario_grupos_clientes_2', "capa_unicos_prioritario_grupos_clientes");
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
