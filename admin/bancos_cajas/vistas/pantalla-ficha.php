<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/bancos_cajas/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de banco / caja <span class="font-medium"><?php echo $descripcion; ?></span>');
        setRutaSys('bancos_cajas');
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
?>
<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_bancos_cajas" id="id_bancos_cajas" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" class="w-full" value="<?php echo $descripcion; ?>" maxlength="35" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-12 mt-3 items-center space-x-3">
            <div class="col-span-1 sm:col-span-2">
                <label for="entidad">Entidad:</label>
                <input type="text" name="entidad" id="entidad" placeholder="Entidad" class="w-full" value="<?php echo $entidad; ?>" maxlength="4" required />
            </div>
            <div class="px-3 col-span-1 sm:col-span-2">
                <label for="agencia">Agencia:</label>
                <input type="text" name="agencia" id="agencia" placeholder="Agencia" class="w-full" value="<?php echo $agencia; ?>" maxlength="4" required />
            </div>
            <div class="px-3 col-span-1 sm:col-span-2">
                <label for="dc">DC:</label>
                <input type="text" name="dc" id="dc" placeholder="DC" class="w-full" value="<?php echo $dc; ?>" maxlength="2" required />
            </div>
            <div class="px-3 col-span-1 sm:col-span-6">
                <label for="dc">Cuenta:</label>
                <input type="text" name="cuenta" id="cuenta" placeholder="cuenta" class="w-full" value="<?php echo $cuenta; ?>" maxlength="10" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label for="dc">IBAN:</label>
                <input type="text" name="iban" id="iban" placeholder="iban" class="w-full" value="<?php echo $iban; ?>" maxlength="24" required />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
            <div>
                <label>Activo:</label><br>
                <div class="flex flex-wrap">
                    <div onclick="activarElementoUnicoFicha('activo_bancos_cajas_1', 'capa_activo_bancos_cajas_1', 'capa_unicos_activo_bancos_cajas')" id="capa_activo_bancos_cajas_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_bancos_cajas poin">
                        <div class="font-bold text-left mr-2">
                            Si
                        </div>
                        <div id="contracheck_activo_bancos_cajas_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo_bancos_cajas">
                            &nbsp;
                        </div>
                        <div id="check_activo_bancos_cajas_1" class="hidden check_capa_unicos_activo_bancos_cajas">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_bancos_cajas" id="activo_bancos_cajas_1" value="1" class="hidden" />
                        <?php
                        if ($activo_bancos_cajas == 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_bancos_cajas_1', 'capa_activo_bancos_cajas_1', "capa_unicos_activo_bancos_cajas");
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                    <div onclick="activarElementoUnicoFicha('activo_bancos_cajas_2', 'capa_activo_bancos_cajas_2', 'capa_unicos_activo_bancos_cajas')" id="capa_activo_bancos_cajas_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_bancos_cajas">
                        <div class="font-bold text-left mr-2">
                            No
                        </div>
                        <div id="contracheck_activo_bancos_cajas_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo_bancos_cajas">
                            &nbsp;
                        </div>
                        <div id="check_activo_bancos_cajas_2" class="hidden check_capa_unicos_activo_bancos_cajas">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="radio" name="activo_bancos_cajas" id="activo_bancos_cajas_2" value="0" class="hidden" />
                        <?php
                        if ($activo_bancos_cajas != 1) {
                            ?>
                            <script type="text/javascript">
                                activarElementoUnicoFicha('activo_bancos_cajas_2', 'capa_activo_bancos_cajas_2', "capa_unicos_activo_bancos_cajas");
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
