<?php
$select_sys = "editar-ficha";
require($_SERVER['DOCUMENT_ROOT']."/admin/categorias/gestion/datos-select-php.php");

if ($es_ajax) {
    ?>
    <script type="text/javascript">
        modificarTituloFichaModal('Ficha de <?php echo (!empty($crear_subcategoria_url) || (isset($de_categorias) && !empty($de_categorias)))? 'subcategoría' : 'categoría'; ?> <span class="font-medium"><?php echo $descripcion_categorias; ?></span>');
        setRutaSys('categorias');
    </script>
    <?php
}

if(!empty($id_url)) {
    ?>
    <div class="w-full flex flex-wrap bg-gray-70 dark:bg-blendi-35">
        <div class="p-3 <?php echo (empty($apartado_url))? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="<?php echo $definicion_tipo_librador; ?>" onclick="cambiarApartadoFicha('')">
                Datos básicos
            </a>
        </div>
        <?php
        if ($sector != 'restauracion') {
            ?>
            <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'imagen')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
                <a href="#" title="Datos dirección" onclick="cambiarApartadoFicha('imagen')">
                    Datos imagen
                </a>
            </div>
            <?php
        }
        ?>
        <div class="p-3 <?php echo (isset($apartado_url) && $apartado_url == 'web')? 'bg-white' : 'bg-gray-70 dark:bg-blendi-35'; ?>">
            <a href="#" title="Datos dirección" onclick="cambiarApartadoFicha('web')">
                Datos web
            </a>
        </div>
    </div>
    <?php
}
?>
<form class="formulario" id="form_datos_post" name="form_datos_post" method="post">
    <input type="hidden" name="id_categorias" id="id_categorias" value="<?php echo $id_url; ?>" />
    <div class="capa_form_datos p-3">
        <?php
        if(!isset($apartado_url) OR $apartado_url == "null") {
            ?>
            <input type="hidden" name="apartado" id="apartado" value="null" />
            <input type="hidden" name="id_idioma_categorias" id="id_idioma_categorias" value="<?php echo $id_idioma_categorias; ?>" />
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="descripcion_categorias">Descripción:</label><br>
                    <input type="text" name="descripcion_categorias" id="descripcion_categorias" placeholder="Descripción" maxlength="60" class="w-full" value="<?php echo $descripcion_categorias; ?>" required />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <?php
                if(!empty($id_url) || !empty($crear_subcategoria_url)) {
                    ?>
                    <div>
                        <?php
                        $id_select_sys = "de_categorias";
                        $withRaiz = true;
                        if(!empty($crear_subcategoria_url)) {
                            $withRaiz = false;
                        }
                        require($_SERVER['DOCUMENT_ROOT']."/admin/categorias/componentes/form-select.php");
                        ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <input type="hidden" name="de_categorias" value="0" />
                    <?php
                }
                ?>
                <div>
                    <?php
                    $id_select_sys = "id_grupo";
                    require($_SERVER['DOCUMENT_ROOT']."/admin/categorias/componentes/form-select-grupo.php");
                    ?>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label>Activo:</label><br>
                    <div class="flex flex-wrap">
                        <div onclick="activarElementoUnicoFicha('activo_categorias_1', 'capa_activo_categorias_1', 'capa_unicos_activo_categorias')" id="capa_activo_categorias_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_categorias poin">
                            <div class="font-bold text-left mr-2">
                                Si
                            </div>
                            <div id="contracheck_activo_categorias_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo_categorias">
                                &nbsp;
                            </div>
                            <div id="check_activo_categorias_1" class="hidden check_capa_unicos_activo_categorias">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="activo_categorias" id="activo_categorias_1" value="1" class="hidden" />
                            <?php
                            if ($activa_categorias == 1) {
                                ?>
                                <script type="text/javascript">
                                    activarElementoUnicoFicha('activo_categorias_1', 'capa_activo_categorias_1', "capa_unicos_activo_categorias");
                                </script>
                                <?php
                            }
                            ?>
                        </div>
                        <div onclick="activarElementoUnicoFicha('activo_categorias_2', 'capa_activo_categorias_2', 'capa_unicos_activo_categorias')" id="capa_activo_categorias_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_categorias">
                            <div class="font-bold text-left mr-2">
                                No
                            </div>
                            <div id="contracheck_activo_categorias_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo_categorias">
                                &nbsp;
                            </div>
                            <div id="check_activo_categorias_2" class="hidden check_capa_unicos_activo_categorias">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="activo_categorias" id="activo_categorias_2" value="0" class="hidden" />
                            <?php
                            if ($activa_categorias != 1) {
                                ?>
                                <script type="text/javascript">
                                    activarElementoUnicoFicha('activo_categorias_2', 'capa_activo_categorias_2', "capa_unicos_activo_categorias");
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
                    <label for="orden_categorias">Orden:</label><br>
                    <input type="text" name="orden_categorias" id="orden_categorias" placeholder="Orden" maxlength="20" class="w-full" value="<?php echo $orden_categorias; ?>" />
                </div>
            </div>
            <a href="#" class="flex flex-wrap items-center mt-3" onclick="collapseCapa('capa-terminales');">
                <div>
                    Terminales de la categoría
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2" id="capa-terminales-hidden">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2 hidden" id="capa-terminales-show">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
            </a>
            <div id="capa-terminales" class="hidden">
                <?php
                $select_sys = "listado-filtrado-activos";
                require($_SERVER['DOCUMENT_ROOT']."/admin/terminales/gestion/datos-select-php.php");
                if(isset($matriz_id_terminales)) {
                    foreach ($matriz_id_terminales as $key_id_terminales => $valor_id_terminales) {
                        $checkedTerminal = '';
                        foreach ($categorias_terminales_id_terminal as $valor_categorias_terminales_id_terminal) {
                            if ($valor_id_terminales == $valor_categorias_terminales_id_terminal) {
                                $checkedTerminal = ' checked';
                                break;
                            }
                        }
                        ?>
                        <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                            <div class="flex flex-wrap">
                                <input type="checkbox" id="id_terminal_categorias_terminales_<?php echo $valor_id_terminales; ?>" name="id_terminal_categorias_terminales[<?php echo $valor_id_terminales; ?>]"  class="text-blendi-600" value="<?php echo $valor_id_terminales; ?>"<?php echo $checkedTerminal; ?>>
                                <div class="ml-2">
                                    <?php echo $matriz_descripcion_terminales[$key_id_terminales]; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    unset($matriz_id_terminales);
                    unset($matriz_descripcion_terminales);
                }else {
                    echo "No se han encontrado terminales definidos";
                }
                ?>
            </div>
            <?php
        }elseif ($apartado_url == "imagen") {
            ?>
            <input type="hidden" name="apartado" id="apartado" value="imagen" />
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3" id="capa_li_imagen">
                <?php
                $id_images_sys = $id_url;
                $sub_id_images_sys = 0;
                $imagen_sys = $imagen_categorias;
                $updated_sys = $updated_categorias;
                $alt_sys = $alt_categorias;
                $tittle_sys = $tittle_categorias;
                $destino_sys = "categorias";
                $modulo_renombrar = "categorias";
                $tabla = "categorias";
                $id_renombrar = $id_url;
                $etiqueta_id_retorno = "id_categorias";
                $link_otros = "";
                $nombre_imagen_sys = explode(".",$imagen_categorias);
                require($_SERVER['DOCUMENT_ROOT']."/admin/componentes/form-images.php");
                ?>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="alt_categorias">Alt imagen:</label><br>
                    <input type="text" name="alt_categorias" id="alt_categorias" placeholder="Alt imagen" maxlength="60" class="w-full" value="<?php echo $alt_categorias; ?>" />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="tittle_categorias">Title imagen:</label><br>
                    <input type="text" name="tittle_categorias" id="tittle_categorias" placeholder="Title imagen" maxlength="100" class="w-full" value="<?php echo $tittle_categorias; ?>" />
                </div>
            </div>
            <div class="hidden">
                Color fondo: <input type="color" style="height: 35px;" id="color_fondo" name="color_fondo" value="<?php echo $color_fondo_categorias; ?>" /><br />
                Color letra: <input type="color" style="height: 35px;" id="color_letra" name="color_letra" value="<?php echo $color_letra_categorias; ?>" />
            </div>
            <?php
        }elseif ($apartado_url == "web") {
            if(empty($descripcion_url_categorias)) {
                $descripcion_url_categorias = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_categorias);
            }
            if(empty($titulo_meta_categorias)) {
                $titulo_meta_categorias = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_categorias);
            }
            if(empty($descripcion_meta_categorias)) {
                $descripcion_meta_categorias = preg_replace('/[^a-zA-Z0-9\']/', '-', $descripcion_categorias);
            }
            ?>
            <input type="hidden" name="apartado" id="apartado" value="web" />
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="descripcion_url_categorias">Descripción URL:</label><br>
                    <input type="text" name="descripcion_url_categorias" id="descripcion_url_categorias" placeholder="Descripción URL" maxlength="60" class="w-full" value="<?php echo $descripcion_url_categorias; ?>" required />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="titulo_meta_categorias">Título meta:</label><br>
                    <input type="text" name="titulo_meta_categorias" id="titulo_meta_categorias" placeholder="Título meta" maxlength="60" class="w-full" value="<?php echo $titulo_meta_categorias; ?>" required />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="descripcion_meta_categorias">Descripción meta:</label><br>
                    <input type="text" name="descripcion_meta_categorias" id="descripcion_meta_categorias" placeholder="Descripción meta" class="w-full" maxlength="160" value="<?php echo $descripcion_meta_categorias; ?>" required />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="texto_inicio_categorias">Texto inicio:</label><br>
                    <textarea name="texto_inicio_categorias" id="texto_inicio_categorias" cols="40" rows="6" class="w-full">
                        <?php echo $texto_inicio_categorias; ?>
                    </textarea>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label>Mostrar en inicio:</label><br>
                    <div class="flex flex-wrap">
                        <div onclick="activarElementoUnicoFicha('inicio_categorias_1', 'capa_inicio_categorias_1', 'capa_unicos_inicio_categorias')" id="capa_inicio_categorias_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_inicio_categorias poin">
                            <div class="font-bold text-left mr-2">
                                Si
                            </div>
                            <div id="contracheck_inicio_categorias_1" class="hidden w-6 h-6 contracheck_capa_unicos_inicio_categorias">
                                &nbsp;
                            </div>
                            <div id="check_inicio_categorias_1" class="hidden check_capa_unicos_inicio_categorias">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="inicio_categorias" id="inicio_categorias_1" value="1" class="hidden" />
                            <?php
                            if ($inicio_categorias == 1) {
                                ?>
                                <script type="text/javascript">
                                    activarElementoUnicoFicha('inicio_categorias_1', 'capa_inicio_categorias_1', "capa_unicos_inicio_categorias");
                                </script>
                                <?php
                            }
                            ?>
                        </div>
                        <div onclick="activarElementoUnicoFicha('inicio_categorias_2', 'capa_inicio_categorias_2', 'capa_unicos_inicio_categorias')" id="capa_inicio_categorias_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_inicio_categorias">
                            <div class="font-bold text-left mr-2">
                                No
                            </div>
                            <div id="contracheck_inicio_categorias_2" class="hidden w-6 h-6 contracheck_capa_unicos_inicio_categorias">
                                &nbsp;
                            </div>
                            <div id="check_inicio_categorias_2" class="hidden check_capa_unicos_inicio_categorias">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="inicio_categorias" id="inicio_categorias_2" value="0" class="hidden" />
                            <?php
                            if ($inicio_categorias != 1) {
                                ?>
                                <script type="text/javascript">
                                    activarElementoUnicoFicha('inicio_categorias_2', 'capa_inicio_categorias_2', "capa_unicos_inicio_categorias");
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
                    <label for="orden_inicio_categorias">Orden en inicio:</label><br>
                    <input type="text" name="orden_inicio_categorias" id="orden_inicio_categorias" placeholder="Orden en inicio" maxlength="20" class="w-full" value="<?php echo $orden_inicio_categorias; ?>" />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label>Mostrar buscador:</label><br>
                    <div class="flex flex-wrap">
                        <div onclick="activarElementoUnicoFicha('mostrar_buscador_categorias_1', 'capa_mostrar_buscador_categorias_1', 'capa_unicos_mostrar_buscador_categorias')" id="capa_mostrar_buscador_categorias_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_buscador_categorias poin">
                            <div class="font-bold text-left mr-2">
                                Si
                            </div>
                            <div id="contracheck_mostrar_buscador_categorias_1" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_buscador_categorias">
                                &nbsp;
                            </div>
                            <div id="check_mostrar_buscador_categorias_1" class="hidden check_capa_unicos_mostrar_buscador_categorias">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="mostrar_buscador_categorias" id="mostrar_buscador_categorias_1" value="1" class="hidden" />
                            <?php
                            if ($mostrar_buscador_categorias == 1) {
                                ?>
                                <script type="text/javascript">
                                    activarElementoUnicoFicha('mostrar_buscador_categorias_1', 'capa_mostrar_buscador_categorias_1', "capa_unicos_mostrar_buscador_categorias");
                                </script>
                                <?php
                            }
                            ?>
                        </div>
                        <div onclick="activarElementoUnicoFicha('mostrar_buscador_categorias_2', 'capa_mostrar_buscador_categorias_2', 'capa_unicos_mostrar_buscador_categorias')" id="capa_mostrar_buscador_categorias_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_mostrar_buscador_categorias">
                            <div class="font-bold text-left mr-2">
                                No
                            </div>
                            <div id="contracheck_mostrar_buscador_categorias_2" class="hidden w-6 h-6 contracheck_capa_unicos_mostrar_buscador_categorias">
                                &nbsp;
                            </div>
                            <div id="check_mostrar_buscador_categorias_2" class="hidden check_capa_unicos_mostrar_buscador_categorias">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="radio" name="mostrar_buscador_categorias" id="mostrar_buscador_categorias_2" value="0" class="hidden" />
                            <?php
                            if ($mostrar_buscador_categorias != 1) {
                                ?>
                                <script type="text/javascript">
                                    activarElementoUnicoFicha('mostrar_buscador_categorias_2', 'capa_mostrar_buscador_categorias_2', "capa_unicos_mostrar_buscador_categorias");
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
                    $id_select_sys = 'id_grupo_clientes_categorias';
                    $id_grupos_clientes_url = $id_grupo_clientes_categorias;
                    require($_SERVER['DOCUMENT_ROOT']."/admin/grupos_clientes/componentes/form-select.php");
                    ?>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="link_categorias">Mostrar link:</label><br>
                    <input type="text" name="link_categorias" id="link_categorias" placeholder="Mostrar link" maxlength="100" class="w-full" value="<?php echo $link_categorias; ?>" />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="link_externo_categorias">Redirigir a link:</label><br>
                    <input type="text" name="link_externo_categorias" id="link_externo_categorias" placeholder="Redirigir a link" maxlength="100" class="w-full" value="<?php echo $link_externo_categorias; ?>" />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
                <div>
                    <label for="texto_titulo_categorias">Texto título:</label><br>
                    <textarea name="texto_titulo_categorias" id="texto_titulo_categorias" cols="40" rows="6" class="w-full">
                        <?php echo $texto_titulo_categorias; ?>
                    </textarea>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</form>
