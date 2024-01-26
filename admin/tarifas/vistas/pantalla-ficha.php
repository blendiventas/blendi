<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de la tarifa <span class="font-medium"><?php echo (empty($descripcion_tarifas))? '' : $descripcion_tarifas; ?></span>');
        setRutaSys('tarifas');
    </script>
    <?php
}

if(!empty($id_url)) {
    ?>
    <div class="w-full flex flex-wrap bg-gray-70 dark:bg-blendi-35">
        <div class="p-3 <?php echo (empty($apartado_url))? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="<?php echo $descripcion_tarifas; ?>" onclick="cambiarApartadoFicha('')">
                Datos básicos
            </a>
        </div>
    </div>
    <?php
}
?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_tarifas" id="id_tarifas" value="<?php echo $id_url; ?>" />
    <input type="hidden" name="id_idioma_tarifas" id="id_idioma_tarifas" value="<?php echo $id_idioma_tarifas; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="descripcion_tarifas">Descripción:</label>
                <input type="text" name="descripcion_tarifas" id="descripcion_tarifas" placeholder="Descripción" class="w-full" value="<?php echo $descripcion_tarifas; ?>" maxlength="50" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label>Tarifa prioritaria:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('prioritaria_tarifas_1', 'capa_prioritaria_tarifas_1', 'capa_unicos_prioritaria_tarifas')" id="capa_prioritaria_tarifas_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_prioritaria_tarifas poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_prioritaria_tarifas_1" class="hidden w-6 h-6 contracheck_capa_unicos_prioritaria_tarifas">
                            &nbsp;
                        </div>
                        <div id="check_prioritaria_tarifas_1" class="hidden check_capa_unicos_prioritaria_tarifas">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="prioritaria_tarifas" id="prioritaria_tarifas_1" value="1" class="hidden" />
                        <?php
                        if ($prioritaria_tarifas == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('prioritaria_tarifas_1', 'capa_prioritaria_tarifas_1', "capa_unicos_prioritaria_tarifas");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('prioritaria_tarifas_2', 'capa_prioritaria_tarifas_2', 'capa_unicos_prioritaria_tarifas')" id="capa_prioritaria_tarifas_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_prioritaria_tarifas <?php echo ($disabled_sys)? 'hidden' : ''; ?>">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_prioritaria_tarifas_2" class="hidden w-6 h-6 contracheck_capa_unicos_prioritaria_tarifas">
                            &nbsp;
                        </div>
                        <div id="check_prioritaria_tarifas_2" class="hidden check_capa_unicos_prioritaria_tarifas">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="prioritaria_tarifas" id="prioritaria_tarifas_2" value="0" class="hidden" />
                        <?php
                        if ($prioritaria_tarifas != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('prioritaria_tarifas_2', 'capa_prioritaria_tarifas_2', "capa_unicos_prioritaria_tarifas");
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
                <label>Activa:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('activa_tarifas_1', 'capa_activa_tarifas_1', 'capa_unicos_activa_tarifas')" id="capa_activa_tarifas_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activa_tarifas poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_activa_tarifas_1" class="hidden w-6 h-6 contracheck_capa_unicos_activa_tarifas">
                            &nbsp;
                        </div>
                        <div id="check_activa_tarifas_1" class="hidden check_capa_unicos_activa_tarifas">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activa_tarifas" id="activa_tarifas_1" value="1" class="hidden" />
                        <?php
                        if ($activa_tarifas == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activa_tarifas_1', 'capa_activa_tarifas_1', "capa_unicos_activa_tarifas");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('activa_tarifas_2', 'capa_activa_tarifas_2', 'capa_unicos_activa_tarifas')" id="capa_activa_tarifas_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activa_tarifas">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_activa_tarifas_2" class="hidden w-6 h-6 contracheck_capa_unicos_activa_tarifas">
                            &nbsp;
                        </div>
                        <div id="check_activa_tarifas_2" class="hidden check_capa_unicos_activa_tarifas">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activa_tarifas" id="activa_tarifas_2" value="0" class="hidden" />
                        <?php
                        if ($activa_tarifas != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activa_tarifas_2', 'capa_activa_tarifas_2', "capa_unicos_activa_tarifas");
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
                <label for="orden_tarifas">Orden:</label>
                <input type="text" name="orden_tarifas" id="orden_tarifas" placeholder="Orden" class="w-full" value="<?php echo $orden_tarifas; ?>" maxlength="20" />
            </div>
        </div>
    </div>
</form>
