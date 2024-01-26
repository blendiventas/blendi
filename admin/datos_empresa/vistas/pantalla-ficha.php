<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/datos_empresa/gestion/datos-select-php.php");

?>
<script type="text/javascript">
    setRutaSys('datos_empresa');
    setIdFicha(<?php echo $id_url; ?>);
</script>
<div class="w-full flex flex-wrap">
    <div class="p-3 <?php echo (empty($apartado_url))? 'bg-white' : ''; ?>">
        <a href="#" title="Datos básicos" onclick="cambiarApartadoFicha('')">
            Datos básicos
        </a>
    </div>
    <?php
    if(!empty($id_url)) {
        ?>
        <div class="p-3 <?php echo (!empty($apartado_url) && $apartado_url == 'configuracion')? 'bg-white' : ''; ?>">
            <a href="#" title="Datos básicos" onclick="cambiarApartadoFicha('configuracion')">
                Datos de configuración
            </a>
        </div>
        <?php
    }
    ?>
</div>

<form  class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id" id="id" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <ul>
            <?php
            if(!isset($apartado_url) OR $apartado_url == "null") {
                ?>
                <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                    <div>
                        <label for="nombre_fiscal_datos_empresa">Nombre fiscal:</label><br />
                        <input type="text" class="w-full" name="nombre_fiscal_datos_empresa" id="nombre_fiscal_datos_empresa" placeholder="Nombre fiscal" value="<?php echo $nombre_fiscal_datos_empresa; ?>" required />
                    </div>
                    <div>
                        <label for="nombre_comercial_datos_empresa">Nombre comercial:</label><br />
                        <input type="text" class="w-full" name="nombre_comercial_datos_empresa" id="nombre_comercial_datos_empresa" placeholder="Nombre comercial" value="<?php echo $nombre_comercial_datos_empresa; ?>" required />
                    </div>
                    <div>
                        <label for="nif_datos_empresa">NIF:</label><br />
                        <input type="text" class="w-full" name="nif_datos_empresa" id="nif_datos_empresa" placeholder="NIF" value="<?php echo $nif_datos_empresa; ?>" required />
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
                    <div>
                        <label for="direccion_datos_empresa">Dirección:</label><br />
                        <input type="text" class="w-full" name="direccion_datos_empresa" id="direccion_datos_empresa" placeholder="Dirección" value="<?php echo $direccion_datos_empresa; ?>" required />
                    </div>
                    <div>
                        <label for="codigo_postal_datos_empresa">Código postal:</label><br />
                        <input type="text" class="w-full" name="codigo_postal_datos_empresa" id="codigo_postal_datos_empresa" placeholder="Código postal" value="<?php echo $codigo_postal_datos_empresa; ?>" required />
                    </div>
                    <div>
                        <label for="poblacion_datos_empresa">Población:</label><br />
                        <input type="text" class="w-full" name="poblacion_datos_empresa" id="poblacion_datos_empresa" placeholder="Población" value="<?php echo $poblacion_datos_empresa; ?>" required />
                    </div>
                    <div>
                        <label for="provincia_datos_empresa">Provincia:</label><br />
                        <input type="text" class="w-full" name="provincia_datos_empresa" id="provincia_datos_empresa" placeholder="Provincia" value="<?php echo $provincia_datos_empresa; ?>" required />
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
                    <div>
                        <label for="tel1_datos_empresa">Teléfono 1:</label><br />
                        <input type="text" class="w-full" name="tel1_datos_empresa" id="tel1_datos_empresa" placeholder="Teléfono 1" value="<?php echo $tel1_datos_empresa; ?>" />
                    </div>
                    <div>
                        <label for="tel2_datos_empresa">Teléfono 2:</label><br />
                        <input type="text" class="w-full" name="tel2_datos_empresa" id="tel2_datos_empresa" placeholder="Teléfono 2" value="<?php echo $tel2_datos_empresa; ?>" />
                    </div>
                    <div>
                        <label for="movil_datos_empresa">Móvil:</label><br />
                        <input type="text" class="w-full" name="movil_datos_empresa" id="movil_datos_empresa" placeholder="Móvil" value="<?php echo $movil_datos_empresa; ?>" required />
                    </div>
                    <div>
                        <label for="fax_datos_empresa">Fax:</label><br />
                        <input type="text" class="w-full" name="fax_datos_empresa" id="fax_datos_empresa" placeholder="Fax" value="<?php echo $fax_datos_empresa; ?>" />
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
                    <div>
                        <label for="email_datos_empresa">Email:</label><br />
                        <input type="email" class="w-full"  name="email_datos_empresa" id="email_datos_empresa" placeholder="Email" value="<?php echo $email_datos_empresa; ?>" required />
                    </div>
                    <input type="hidden" name="tarifas_datos_empresa" id="tarifas_datos_empresa" value="<?php echo $tarifas_datos_empresa; ?>" />
                    <div>
                        <label>IVA incluido:</label><br />
                        <div class="flex flex-wrap">
                            <div onclick="activarElementoUnicoFicha('iva_incluido_datos_empresa_1', 'capa_iva_incluido_datos_empresa_1', 'capa_unicos_iva_incluido_datos_empresa')" id="capa_iva_incluido_datos_empresa_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_iva_incluido_datos_empresa poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_iva_incluido_datos_empresa_1" class="hidden w-6 h-6 contracheck_capa_unicos_iva_incluido_datos_empresa">
                                    &nbsp;
                                </div>
                                <div id="check_iva_incluido_datos_empresa_1" class="hidden check_capa_unicos_iva_incluido_datos_empresa">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="iva_incluido_datos_empresa" id="iva_incluido_datos_empresa_1" value="1" class="hidden" />
                                <?php
                                if ($iva_incluido_datos_empresa == 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('iva_incluido_datos_empresa_1', 'capa_iva_incluido_datos_empresa_1', "capa_unicos_iva_incluido_datos_empresa");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                            <div onclick="activarElementoUnicoFicha('iva_incluido_datos_empresa_2', 'capa_iva_incluido_datos_empresa_2', 'capa_unicos_iva_incluido_datos_empresa')" id="capa_iva_incluido_datos_empresa_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_iva_incluido_datos_empresa">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_iva_incluido_datos_empresa_2" class="hidden w-6 h-6 contracheck_capa_unicos_iva_incluido_datos_empresa">
                                    &nbsp;
                                </div>
                                <div id="check_iva_incluido_datos_empresa_2" class="hidden check_capa_unicos_iva_incluido_datos_empresa">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="iva_incluido_datos_empresa" id="iva_incluido_datos_empresa_2" value="0" class="hidden" />
                                <?php
                                if ($iva_incluido_datos_empresa != 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('iva_incluido_datos_empresa_2', 'capa_iva_incluido_datos_empresa_2', "capa_unicos_iva_incluido_datos_empresa");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-3 items-center space-x-3">
                    <div>
                        <label for="url_web_datos_empresa">URL página web:</label><br />
                        <input type="text" class="w-full" name="url_web_datos_empresa" id="url_web_datos_empresa" placeholder="URL página web" value="<?php echo $url_web_datos_empresa; ?>" />
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3" id="capa_guardar_update">
                    <div>
                        &nbsp;
                    </div>
                    <div>
                        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarFichaDatosEmpresa('guardar');">Guardar</button>
                    </div>
                    <div>
                        &nbsp;
                    </div>
                </div>
                <?php
            }elseif ($apartado_url == "configuracion") {
                /*
                CREATE TABLE `configuracion` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `id_librador` INT(11) NOT NULL DEFAULT '0',
                    `pvp_iva_incluido` TINYINT(1) NOT NULL DEFAULT '0',
                    `color_letra_botones` VARCHAR(7) NOT NULL DEFAULT '#ffffff' COLLATE 'utf8_spanish_ci',
                    `color_fondo_botones` VARCHAR(7) NOT NULL DEFAULT '#156772' COLLATE 'utf8_spanish_ci',
                    `fecha_modificacion` DATE NULL DEFAULT NULL,

                $id_configuracion = $valor['id'];
                $id_librador_configuracion = $valor['id_librador'];
                $pvp_iva_incluido_configuracion = $valor['pvp_iva_incluido'];
                $color_letra_botones_configuracion = $valor['color_letra_botones'];
                $color_fondo_botones_configuracion = $valor['color_fondo_botones'];
                $fecha_modificacion_configuracion = $valor['fecha_modificacion'];
                */
                ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
                    <div>
                        <?php
                        $etiqueta_select_id_librador_configuracion = "Cliente por defecto:";
                        $id_select_sys = "id_librador_configuracion";
                        $id_librador_buscar_configuracion = $id_librador_configuracion;
                        require($_SERVER['DOCUMENT_ROOT']."/admin/datos_empresa/componentes/form-select.php");
                        ?>
                    </div>
                    <div>
                        <?php
                        $etiqueta_select_id_librador_configuracion = "Cliente entregas en local por defecto:";
                        $id_select_sys = "id_librador_tak_configuracion";
                        $id_librador_buscar_configuracion = $id_librador_tak_configuracion;
                        require($_SERVER['DOCUMENT_ROOT']."/admin/datos_empresa/componentes/form-select.php");
                        ?>
                    </div>
                    <div>
                        <label>Activar entregas a domicilio:</label>
                        <div class="flex flex-wrap">
                            <div onclick="activarElementoUnicoFicha('servicio_domicilio_configuracion_1', 'capa_servicio_domicilio_configuracion_1', 'capa_unicos_servicio_domicilio_configuracion')" id="capa_servicio_domicilio_configuracion_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_servicio_domicilio_configuracion poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_servicio_domicilio_configuracion_1" class="hidden w-6 h-6 contracheck_capa_unicos_servicio_domicilio_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_servicio_domicilio_configuracion_1" class="hidden check_capa_unicos_servicio_domicilio_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="servicio_domicilio_configuracion" id="servicio_domicilio_configuracion_1" value="1" class="hidden" />
                                <?php
                                if ($servicio_domicilio_configuracion == 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('servicio_domicilio_configuracion_1', 'capa_servicio_domicilio_configuracion_1', "capa_unicos_servicio_domicilio_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                            <div onclick="activarElementoUnicoFicha('servicio_domicilio_configuracion_2', 'capa_servicio_domicilio_configuracion_2', 'capa_unicos_servicio_domicilio_configuracion')" id="capa_servicio_domicilio_configuracion_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_servicio_domicilio_configuracion">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_servicio_domicilio_configuracion_2" class="hidden w-6 h-6 contracheck_capa_unicos_servicio_domicilio_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_servicio_domicilio_configuracion_2" class="hidden check_capa_unicos_servicio_domicilio_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="servicio_domicilio_configuracion" id="servicio_domicilio_configuracion_2" value="0" class="hidden" />
                                <?php
                                if ($servicio_domicilio_configuracion != 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('servicio_domicilio_configuracion_2', 'capa_servicio_domicilio_configuracion_2', "capa_unicos_servicio_domicilio_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
                    <div>
                        <label>Menú línea única:</label><br />
                        <div class="flex flex-wrap">
                            <div onclick="activarElementoUnicoFicha('tipo_menu_superior_configuracion_1', 'capa_tipo_menu_superior_configuracion_1', 'capa_unicos_tipo_menu_superior_configuracion')" id="capa_tipo_menu_superior_configuracion_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_tipo_menu_superior_configuracion poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_tipo_menu_superior_configuracion_1" class="hidden w-6 h-6 contracheck_capa_unicos_tipo_menu_superior_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_tipo_menu_superior_configuracion_1" class="hidden check_capa_unicos_tipo_menu_superior_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="tipo_menu_superior_configuracion" id="tipo_menu_superior_configuracion_1" value="1" class="hidden" />
                                <?php
                                if ($tipo_menu_superior_configuracion == 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('tipo_menu_superior_configuracion_1', 'capa_tipo_menu_superior_configuracion_1', "capa_unicos_tipo_menu_superior_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                            <div onclick="activarElementoUnicoFicha('tipo_menu_superior_configuracion_2', 'capa_tipo_menu_superior_configuracion_2', 'capa_unicos_tipo_menu_superior_configuracion')" id="capa_tipo_menu_superior_configuracion_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_tipo_menu_superior_configuracion">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_tipo_menu_superior_configuracion_2" class="hidden w-6 h-6 contracheck_capa_unicos_tipo_menu_superior_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_tipo_menu_superior_configuracion_2" class="hidden check_capa_unicos_tipo_menu_superior_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="tipo_menu_superior_configuracion" id="tipo_menu_superior_configuracion_2" value="0" class="hidden" />
                                <?php
                                if ($tipo_menu_superior_configuracion != 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('tipo_menu_superior_configuracion_2', 'capa_tipo_menu_superior_configuracion_2', "capa_unicos_tipo_menu_superior_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label>PVP IVA incluido:</label><br />
                        <div class="flex flex-wrap">
                            <div onclick="activarElementoUnicoFicha('pvp_iva_incluido_configuracion_1', 'capa_pvp_iva_incluido_configuracion_1', 'capa_unicos_pvp_iva_incluido_configuracion')" id="capa_pvp_iva_incluido_configuracion_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_pvp_iva_incluido_configuracion poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_pvp_iva_incluido_configuracion_1" class="hidden w-6 h-6 contracheck_capa_unicos_pvp_iva_incluido_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_pvp_iva_incluido_configuracion_1" class="hidden check_capa_unicos_pvp_iva_incluido_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="pvp_iva_incluido_configuracion" id="pvp_iva_incluido_configuracion_1" value="1" class="hidden" />
                                <?php
                                if ($pvp_iva_incluido_configuracion == 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('pvp_iva_incluido_configuracion_1', 'capa_pvp_iva_incluido_configuracion_1', "capa_unicos_pvp_iva_incluido_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                            <div onclick="activarElementoUnicoFicha('pvp_iva_incluido_configuracion_2', 'capa_pvp_iva_incluido_configuracion_2', 'capa_unicos_pvp_iva_incluido_configuracion')" id="capa_pvp_iva_incluido_configuracion_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_pvp_iva_incluido_configuracion">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_pvp_iva_incluido_configuracion_2" class="hidden w-6 h-6 contracheck_capa_unicos_pvp_iva_incluido_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_pvp_iva_incluido_configuracion_2" class="hidden check_capa_unicos_pvp_iva_incluido_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="pvp_iva_incluido_configuracion" id="pvp_iva_incluido_configuracion_2" value="0" class="hidden" />
                                <?php
                                if ($pvp_iva_incluido_configuracion != 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('pvp_iva_incluido_configuracion_2', 'capa_pvp_iva_incluido_configuracion_2', "capa_unicos_pvp_iva_incluido_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label>Mostrar precios TPV:</label><br />
                        <div class="flex flex-wrap">
                            <div onclick="activarElementoUnicoFicha('mostrar_precios_tpv_configuracion_1', 'capa_mostrar_precios_tpv_configuracion_1', 'capa_unicos_mostrar_precios_tpv_configuracion')" id="capa_mostrar_precios_tpv_configuracion_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_precios_tpv_configuracion poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_mostrar_precios_tpv_configuracion_1" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_precios_tpv_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_mostrar_precios_tpv_configuracion_1" class="hidden check_capa_unicos_mostrar_precios_tpv_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="mostrar_precios_tpv_configuracion" id="mostrar_precios_tpv_configuracion_1" value="1" class="hidden" />
                                <?php
                                if ($mostrar_precios_tpv_configuracion == 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('mostrar_precios_tpv_configuracion_1', 'capa_mostrar_precios_tpv_configuracion_1', "capa_unicos_mostrar_precios_tpv_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                            <div onclick="activarElementoUnicoFicha('mostrar_precios_tpv_configuracion_2', 'capa_mostrar_precios_tpv_configuracion_2', 'capa_unicos_mostrar_precios_tpv_configuracion')" id="capa_mostrar_precios_tpv_configuracion_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_precios_tpv_configuracion">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_mostrar_precios_tpv_configuracion_2" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_precios_tpv_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_mostrar_precios_tpv_configuracion_2" class="hidden check_capa_unicos_mostrar_precios_tpv_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="mostrar_precios_tpv_configuracion" id="mostrar_precios_tpv_configuracion_2" value="0" class="hidden" />
                                <?php
                                if ($mostrar_precios_tpv_configuracion != 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('mostrar_precios_tpv_configuracion_2', 'capa_mostrar_precios_tpv_configuracion_2', "capa_unicos_mostrar_precios_tpv_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label>Mostrar más vendidos:</label><br />
                        <div class="flex flex-wrap">
                            <div onclick="activarElementoUnicoFicha('mostrar_mas_vendidos_configuracion_1', 'capa_mostrar_mas_vendidos_configuracion_1', 'capa_unicos_mostrar_mas_vendidos_configuracion')" id="capa_mostrar_mas_vendidos_configuracion_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_mas_vendidos_configuracion poin">
                                <div class="font-bold text-left mr-2">
                                    Si
                                </div>
                                <div id="contracheck_mostrar_mas_vendidos_configuracion_1" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_mas_vendidos_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_mostrar_mas_vendidos_configuracion_1" class="hidden check_capa_unicos_mostrar_mas_vendidos_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="mostrar_mas_vendidos_configuracion" id="mostrar_mas_vendidos_configuracion_1" value="1" class="hidden" />
                                <?php
                                if ($mostrar_mas_vendidos_configuracion == 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('mostrar_mas_vendidos_configuracion_1', 'capa_mostrar_mas_vendidos_configuracion_1', "capa_unicos_mostrar_mas_vendidos_configuracion");
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                            <div onclick="activarElementoUnicoFicha('mostrar_mas_vendidos_configuracion_2', 'capa_mostrar_mas_vendidos_configuracion_2', 'capa_unicos_mostrar_mas_vendidos_configuracion')" id="capa_mostrar_mas_vendidos_configuracion_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_mas_vendidos_configuracion">
                                <div class="font-bold text-left mr-2">
                                    No
                                </div>
                                <div id="contracheck_mostrar_mas_vendidos_configuracion_2" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_mas_vendidos_configuracion">
                                    &nbsp;
                                </div>
                                <div id="check_mostrar_mas_vendidos_configuracion_2" class="hidden check_capa_unicos_mostrar_mas_vendidos_configuracion">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="mostrar_mas_vendidos_configuracion" id="mostrar_mas_vendidos_configuracion_2" value="0" class="hidden" />
                                <?php
                                if ($mostrar_mas_vendidos_configuracion != 1) {
                                    ?>
                                    <script type="text/javascript">
                                        activarElementoUnicoFicha('mostrar_mas_vendidos_configuracion_2', 'capa_mostrar_mas_vendidos_configuracion_2', "capa_unicos_mostrar_mas_vendidos_configuracion");
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
                        <label for="filas_menu_configuracion">Filas del menú multilíneas:</label><br />
                        <select id="filas_menu_configuracion" class="w-full" name="filas_menu_configuracion" required>
                            <?php
                            for ($bucle = 1 ; $bucle <= 10 ; $bucle++) {
                                $selected_sys = "";
                                if ($bucle == $filas_menu_configuracion) {
                                    $selected_sys = " selected";
                                }
                                ?>
                                <option value="<?php echo $bucle; ?>"<?php echo $selected_sys; ?>><?php echo $bucle; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="decimales_cantidades_configuracion">Número decimales para cantidades:</label><br />
                        <select id="decimales_cantidades_configuracion" class="w-full" name="decimales_cantidades_configuracion" required>
                            <?php
                            for ($bucle = 0 ; $bucle <= 5 ; $bucle++) {
                                $selected_sys = "";
                                if ($bucle == $decimales_cantidades_configuracion) {
                                    $selected_sys = " selected";
                                }
                                ?>
                                <option value="<?php echo $bucle; ?>"<?php echo $selected_sys; ?>><?php echo $bucle; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="decimales_importes_configuracion">Número decimales para importes:</label><br />
                        <select id="decimales_importes_configuracion" class="w-full" name="decimales_importes_configuracion" required>
                            <?php
                            for ($bucle = 0 ; $bucle <= 5 ; $bucle++) {
                                $selected_sys = "";
                                if ($bucle == $decimales_importes_configuracion) {
                                    $selected_sys = " selected";
                                }
                                ?>
                                <option value="<?php echo $bucle; ?>"<?php echo $selected_sys; ?>><?php echo $bucle; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                Color fondo: <input type="color" class="w-full" style="height: 35px;" id="color_fondo_configuracion" name="color_fondo_configuracion" value="<?php echo $color_fondo_botones_configuracion; ?>" /><br />
                Color letra: <input type="color" class="w-full" style="height: 35px;" id="color_letra_configuracion" name="color_letra_configuracion" value="<?php echo $color_letra_botones_configuracion; ?>" />
                <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                    <div>
                        Fecha última modificación: <?php echo $fecha_modificacion_configuracion; ?>
                    </div>
                    <div class="box">
                        &nbsp;
                    </div>
                    <div id="capa_guardar_update">
                        <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarConfiguracion('guardar-configuracion');">Guardar</button>
                    </div>
                </div>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3" id="capa_li_imagen">
        <?php
        $id_images_sys = $id_url;
        $sub_id_images_sys = 0;
        $imagen_sys = $logo_datos_empresa;
        $updated_sys = $updated_datos_empresa;
        $alt_sys = $nombre_comercial_datos_empresa;
        $tittle_sys = $nombre_comercial_datos_empresa;
        $destino_sys = "datos_empresa";
        $modulo_renombrar = "datos_empresa";
        $tabla = "datos_empresa";
        $id_renombrar = $id_url;
        $etiqueta_id_retorno = "id_datos_empresa";
        $link_otros = "";
        $eliminar_imagen_disabled = true;
        $nombre_imagen_sys = explode(".",$logo_datos_empresa);
        require($_SERVER['DOCUMENT_ROOT']."/admin/componentes/form-images.php");
        ?>
    </div>
</form>