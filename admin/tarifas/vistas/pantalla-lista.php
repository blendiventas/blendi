<div class="grid grid-cols-12 items-center h-10 bg-gray-50 sm:mx-5 mt-3 dark:text-white">
    <div class="text-center hidden sm:block sm:col-span-2 px-3">
        Activa
    </div>
    <div class="px-3 col-span-10 sm:col-span-6">
        Tarifa
    </div>
    <div class="text-center hidden sm:block sm:col-span-2 px-3">
        Prioritaria
    </div>
    <div class="text-center px-3 col-span-2">
        Ficha
    </div>
</div>
<hr />
<?php
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/tarifas/gestion/datos-select-php.php");
if(isset($matriz_id_tarifas)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($matriz_id_tarifas as $key => $valor) {
            ?>
            <div class="grid grid-cols-12 items-center h-14 bg-white border-2 border-gray-50" id="linea_<?php echo $valor; ?>">
                <div class="hidden sm:block sm:col-span-2 px-3" id="capa_img_activo_<?php echo $valor; ?>">
                    <input type="checkbox" class="block w-7 h-7 mx-auto text-blendi-600" id="habilitar_<?php echo $valor; ?>"
                        <?php echo ($matriz_activa_tarifas[$key] == 1)? ' checked ' : ''; ?>
                        <?php if ($matriz_prioritaria_tarifas[$key] == 0) { ?> onmouseover="this.style.cursor='pointer'" onclick="toogleHabilitar('<?php echo $valor; ?>', 'tarifas');" <?php } else { ?> disabled <?php } ?>>
                </div>
                <div class="px-3 col-span-10 sm:col-span-6"><?php echo $matriz_descripcion_tarifas[$key]; ?></div>
                <div class="text-center hidden sm:block sm:col-span-2 px-3">
                    <input type="checkbox" class="block w-7 h-7 mx-auto text-blendi-600" id="prioritario_<?php echo $valor; ?>"
                        <?php echo ($matriz_prioritaria_tarifas[$key] == 1)? ' checked ' : ''; ?> disabled>
                </div>
                <div class="col-span-2 px-3">
                    <a href="#" class="botones-apartados" title="IVA" onclick="abrirFicha(<?php echo $valor; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php
        }
        unset($matriz_id_tarifas);
        unset($matriz_id_idioma_tarifas);
        unset($matriz_descripcion_tarifas);
        unset($matriz_prioritaria_tarifas);
        unset($matriz_activa_tarifas);
        unset($matriz_orden_tarifas);
        ?>
    </div>
    <?php
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/componentes/footer-listados.php");
}else {
    ?>
    <div class="flex items-center justify-center h-10 bg-white mx-5">
        <div class="text-center grow px-3">
            No existen tarifas definidas.
        </div>
    </div>
    <?php
}
?>
