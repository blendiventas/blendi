<input type="hidden" name="apartado" id="apartado" value="costes" />

<h2>
    Añadir nuevo producto.
</h2>
<?php

$detalle_mostrar = 'Coste sin IVA';
if ($tipo_libradores_url == 'cli') {
    if ($pvp_iva_incluido) {
        $detalle_mostrar = 'Importe con IVA';
    } else {
        $detalle_mostrar = 'Importe sin IVA';
    }
}


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
$select_sys = "listado-costes-importes";
require($_SERVER['DOCUMENT_ROOT']."/admin/libradores/gestion/datos-select-php.php");

if(isset($buscar_por) && isset($texto_buscar)) {
    $select_sys = "buscar-productos";
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-select-php.php");
    if(isset($descripciones_productos_encontrados)) {
        ?>
        <div id="capa_resultados_busqueda">
            <?php
            require($_SERVER['DOCUMENT_ROOT'] . "/admin/libradores/componentes/mostrar-productos-encontrados.php");
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
        <?php
        echo $detalle_mostrar;
        ?>
    </div>
    <div class="text-center px-3 col-span-2">
        &nbsp;
    </div>
</div>
<div class="overflow-y-auto bg-white">
    <?php
    foreach ($matriz_id_producto_libradores_productos as $key_id_producto_libradores_productos => $id_producto_libradores_productos) {
        ?>
        <div class="grid grid-cols-12 items-center h-16 bg-white border-2 border-gray-50">
            <div class="px-3 col-span-6 flex flex-wrap items-center">
                <?php
                $id_producto = $id_producto_libradores_productos;
                $id_enlazado = 0;
                $id_multiple = 0;
                $id_pack = 0;
                require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/imagenes/componentes/mostrar-imagenes.php");

                echo "<strong>".$matriz_descripcion_libradores_productos[$key_id_producto_libradores_productos]."</strong>";
                ?>
            </div>
            <div class="grid grid-cols-1 col-span-4 items-center h-10 bg-white">
                <div>
                    <input type="number" class="coste_importe w-full h-9" name="coste_importe_<?php echo $key_id_producto_libradores_productos; ?>" id="coste_importe_<?php echo $key_id_producto_libradores_productos; ?>" placeholder="<?php echo $detalle_mostrar; ?>" value="<?php echo $matriz_coste_importe_libradores_productos[$key_id_producto_libradores_productos]; ?>" step="0.01" required />
                </div>
            </div>
            <div class="col-span-2 flex flex-wrap items-center justify-end" id="capa_guardar_coste_importe_<?php echo $key_id_producto_libradores_productos; ?>">
                <div>
                    <a href="#" onclick="guardarCostesImportes('<?php echo $matriz_id_libradores_productos[$key_id_producto_libradores_productos]; ?>','<?php echo $id_url; ?>','<?php echo $matriz_id_producto_libradores_productos[$key_id_producto_libradores_productos]; ?>','coste_importe_','<?php echo $key_id_producto_libradores_productos; ?>');" id="guardar_coste_importe_<?php echo $key_id_producto_libradores_productos; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </a>
                </div>
                <div class="ml-4 mr-3">
                    <a href="#" onclick="eliminarCostesImportes('<?php echo $matriz_id_libradores_productos[$key_id_producto_libradores_productos]; ?>','<?php echo $key_id_producto_libradores_productos; ?>');" id="eliminar_coste_importe_<?php echo $key_id_producto_libradores_productos; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    unset($matriz_id_producto_libradores_productos);
    unset($matriz_descripcion_libradores_productos);
    unset($matriz_id_libradores_productos);
    unset($matriz_coste_importe_libradores_productos);
    ?>
</div>

<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
