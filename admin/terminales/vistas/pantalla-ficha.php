<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/terminales/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de terminal <span class="font-medium"><?php echo $descripcion; ?></span>');
        setRutaSys('terminales');
    </script>
    <?php
}

if(!empty($id_url)) {
    ?>
    <div class="w-full flex flex-wrap bg-gray-70 dark:bg-blendi-35">
        <div class="p-3 <?php echo (empty($apartado_url))? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="<?php echo $descripcion; ?>" onclick="cambiarApartadoFicha('')">
                Datos básicos
            </a>
        </div>
    </div>
    <?php
}
/*
CREATE TABLE `terminales` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
	`mostrar_todo` TINYINT(1) NOT NULL DEFAULT '0',
	`activo` TINYINT(1) NOT NULL DEFAULT '1',
	`fecha_alta` DATE NULL DEFAULT NULL,
	`fecha_modificacion` DATE NULL DEFAULT NULL,
*/
?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_terminal" id="id_terminal" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="descripcion_terminal">Descripción:</label>
                <input type="text" name="descripcion_terminal" id="descripcion_terminal" placeholder="Descripción" class="w-full" value="<?php echo $descripcion_terminal; ?>" maxlength="50" required />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label>Mostrar todo:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('mostrar_todo_terminales_1', 'capa_mostrar_todo_terminales_1', 'capa_mostrar_todo_terminales')" id="capa_mostrar_todo_terminales_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_mostrar_todo_terminales poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_mostrar_todo_terminales_1" class="hidden w-6 h-6 contracheck_capa_mostrar_todo_terminales">
                            &nbsp;
                        </div>
                        <div id="check_mostrar_todo_terminales_1" class="hidden check_capa_mostrar_todo_terminales">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="mostrar_todo_terminales" id="mostrar_todo_terminales_1" value="1" class="hidden" />
                        <?php
                        if ($mostrar_todo_terminal == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('mostrar_todo_terminales_1', 'capa_mostrar_todo_terminales_1', "capa_mostrar_todo_terminales");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('mostrar_todo_terminales_2', 'capa_mostrar_todo_terminales_2', 'capa_mostrar_todo_terminales')" id="capa_mostrar_todo_terminales_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_mostrar_todo_terminales">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_mostrar_todo_terminales_2" class="hidden w-6 h-6 contracheck_capa_mostrar_todo_terminales">
                            &nbsp;
                        </div>
                        <div id="check_mostrar_todo_terminales_2" class="hidden check_capa_mostrar_todo_terminales">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="mostrar_todo_terminales" id="mostrar_todo_terminales_2" value="0" class="hidden" />
                        <?php
                        if ($mostrar_todo_terminal != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('mostrar_todo_terminales_2', 'capa_mostrar_todo_terminales_2', "capa_mostrar_todo_terminales");
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
                <label>Activo:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('activo_terminales_1', 'capa_activo_terminales_1', 'capa_activo_terminales')" id="capa_activo_terminales_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_activo_terminales poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_activo_terminales_1" class="hidden w-6 h-6 contracheck_capa_activo_terminales">
                            &nbsp;
                        </div>
                        <div id="check_activo_terminales_1" class="hidden check_capa_activo_terminales">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_terminales" id="activo_terminales_1" value="1" class="hidden" />
                        <?php
                        if ($activo_terminal == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_terminales_1', 'capa_activo_terminales_1', "capa_activo_terminales");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('activo_terminales_2', 'capa_activo_terminales_2', 'capa_activo_terminales')" id="capa_activo_terminales_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_activo_terminales">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_activo_terminales_2" class="hidden w-6 h-6 contracheck_capa_activo_terminales">
                            &nbsp;
                        </div>
                        <div id="check_activo_terminales_2" class="hidden check_capa_activo_terminales">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_terminales" id="activo_terminales_2" value="0" class="hidden" />
                        <?php
                        if ($activo_terminal != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_terminales_2', 'capa_activo_terminales_2', "capa_activo_terminales");
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
