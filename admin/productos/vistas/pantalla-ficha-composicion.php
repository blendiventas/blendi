<!--
$descripcion_productos
$tipo_producto_productos
-->
<input type="hidden" name="apartado" id="apartado" value="composicion" />

<h2>
    Añadir nuevo producto a la composición de <?php echo $descripcion_productos; ?>
</h2>
<?php
$checked_descripcion = " checked";
$checked_referencia = "";
$checked_codigo_barras = "";
if(isset($buscar_por)) {
    if($buscar_por == "referencia") {
        $checked_descripcion = "";
        $checked_referencia = " checked";
        $checked_codigo_barras = "";
    }
    if($buscar_por == "codigo_barras") {
        $checked_descripcion = "";
        $checked_referencia = "";
        $checked_codigo_barras = " checked";
    }
}
if(!isset($texto_buscar)) {
    $texto_buscar = "";
}
?>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="texto_buscar">Buscar</label><br>
        <div class="text-center pr-2 mt-2 flex">
            <button type="button" onclick="buscarProductos('<?php echo $id_url; ?>', '<?php echo $apartado_url; ?>');" class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-white px-3 text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
            <input type="text" id="textoBuscarComposicion" name="texto_buscar" placeholder="Buscar..." class="block grow flex-1 rounded-none rounded-r-md border-l-0 border-gray-300 focus:border-blendi-500 focus:ring-blendi-500 sm:text-sm">
            <button type="button" onclick="buscarProductos('<?php echo $id_url; ?>', '<?php echo $apartado_url; ?>');" class="hidden md:block ml-4 rounded items-center inline-flex justify-center border border-transparent bg-gray-450 py-2 px-4 text-sm font-medium text-white shadow-sm" id="capa_boton_buscar_producto">
                Buscar
            </button>
            <script type="text/javascript">
                eventoKeyUpEnterBuscarProductos('<?php echo $id_url; ?>', '<?php echo $apartado_url; ?>');
            </script>
        </div>
    </div>
    <div class="col-span-2 flex justify-center">
        <div>
            <label>Buscar por...</label><br>
            <div class="flex flex-wrap">
                <div onclick="activarElementoUnicoFicha('buscar_productos_1', 'capa_buscar_productos_1', 'capa_unicos_buscar_productos');" id="capa_buscar_productos_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_buscar_productos poin">
                    <div class="font-bold text-left mr-2">
                        Descripción
                    </div>
                    <div id="contracheck_buscar_productos_1" class="hidden w-6 h-6 contracheck_capa_unicos_buscar_productos">
                        &nbsp;
                    </div>
                    <div id="check_buscar_productos_1" class="hidden check_capa_unicos_buscar_productos">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="buscar_productos" id="buscar_productos_1" value="descripcion" class="hidden" />
                    <?php
                    if (!isset($buscar_por) || ($buscar_por != 'referencia' && $buscar_por != 'codigo_barras')) {
                        ?>
                        <script type="text/javascript">
                            activarElementoUnicoFicha('buscar_productos_1', 'capa_buscar_productos_1', "capa_unicos_buscar_productos");
                        </script>
                        <?php
                    }
                    ?>
                </div>
                <div onclick="activarElementoUnicoFicha('buscar_productos_2', 'capa_buscar_productos_2', 'capa_unicos_buscar_productos');" id="capa_buscar_productos_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_buscar_productos">
                    <div class="font-bold text-left mr-2">
                        Referencia
                    </div>
                    <div id="contracheck_buscar_productos_2" class="hidden w-6 h-6 contracheck_capa_unicos_buscar_productos">
                        &nbsp;
                    </div>
                    <div id="check_buscar_productos_2" class="hidden check_capa_unicos_buscar_productos">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="buscar_productos" id="buscar_productos_2" value="referencia" class="hidden" />
                    <?php
                    if (isset($buscar_por) && $buscar_por == 'referencia') {
                        ?>
                        <script type="text/javascript">
                            activarElementoUnicoFicha('buscar_productos_2', 'capa_buscar_productos_2', "capa_unicos_buscar_productos");
                        </script>
                        <?php
                    }
                    ?>
                </div>
                <div onclick="activarElementoUnicoFicha('buscar_productos_3', 'capa_buscar_productos_3', 'capa_unicos_buscar_productos');" id="capa_buscar_productos_3" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_buscar_productos">
                    <div class="font-bold text-left mr-2">
                        Código barras
                    </div>
                    <div id="contracheck_buscar_productos_3" class="hidden w-6 h-6 contracheck_capa_unicos_buscar_productos">
                        &nbsp;
                    </div>
                    <div id="check_buscar_productos_3" class="hidden check_capa_unicos_buscar_productos">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="radio" name="buscar_productos" id="buscar_productos_3" value="codigo_barras" class="hidden" />
                    <?php
                    if (isset($buscar_por) && $buscar_por == 'codigo_barras') {
                        ?>
                        <script type="text/javascript">
                            activarElementoUnicoFicha('buscar_productos_3', 'capa_buscar_productos_3', "capa_unicos_buscar_productos");
                        </script>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($buscar_por) && isset($texto_buscar)) {
    $select_sys = "buscar-productos";
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");
    if(isset($descripciones_productos_encontrados)) {
        ?>
        <div id="capa_resultados_busqueda">
            <?php
            require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/componentes/mostrar-productos-encontrados.php");
            ?>
        </div>
        <?php
    }else {
        ?>
        <div class="grid grid-cols-1 items-center h-10 bg-white sm:mx-5 mt-3">
            No se han encontrado coincidencias.
        </div>
        <?php
    }
}
?>

<div class="grid grid-cols-12 items-center h-10 bg-gray-50 dark:text-white mt-6">
    <div class="text-center px-3 col-span-1">
        &nbsp;
    </div>
    <div class="px-3 col-span-5">
        Descripción
    </div>
    <div class="px-3 col-span-4">
        Cantidad y unidad
    </div>
    <div class="text-center px-3 col-span-2">
        &nbsp;
    </div>
</div>
<div class="overflow-y-auto bg-white">
    <?php
    $select_sys = "listado-filtrado-productos-relacionados";
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/gestion/datos-select-php.php");

    switch ($tipo_producto_productos) {
        case "1":
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-select-productos-relacionados-elaborados.php");
            break;
        case "2":
            require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-select-productos-relacionados.php");
            break;
        case "3":
        case "4":
            // require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-select-productos-relacionados-combo.php");
            break;
        default:
            break;
    }
    ?>
</div>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
