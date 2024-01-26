<div class="grid grid-cols-12 items-center h-10 bg-gray-50 sm:mx-5 mt-3 dark:text-white">
    <div class="px-3 col-span-10 sm:col-span-10">
        Descripción
    </div>
    <div class="text-center px-3 col-span-2">
        Ficha
    </div>
</div>
<hr />
<?php
$select_sys = "listado-grupos";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/grupos/gestion/datos-select-php.php");
/*
$matriz_id_productos_grupos
$matriz_descripcion_productos_grupos
*/
if(isset($matriz_id_productos_grupos)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($matriz_id_productos_grupos as $key_id_productos_grupos => $valor_id_productos_grupos) {
            ?>
            <div class="grid grid-cols-12 items-center h-14 bg-white border-2 border-gray-50" id="linea_<?php echo $valor_id_productos_grupos; ?>">
                <div class="px-3 col-span-10 sm:col-span-10"><?php echo $matriz_descripcion_productos_grupos[$key_id_productos_grupos]; ?></div>
                <div class="col-span-2 px-3">
                    <a href="#" class="botones-apartados" title="<?php echo $matriz_descripcion_productos_grupos[$key_id_productos_grupos]; ?>" onclick="abrirFicha(<?php echo $valor_id_productos_grupos; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php
        }
        unset($matriz_id_productos_grupos);
        unset($matriz_descripcion_productos_grupos);
        ?>
    </div>
    <?php
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/componentes/footer-listados.php");
}else {
    ?>
    <div class="flex items-center justify-center h-10 bg-white mx-5">
        <div class="text-center grow px-3">
            No existen grupos definidos.
        </div>
    </div>
    <?php
}
?>
