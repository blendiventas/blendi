<div class="grid grid-cols-12 items-center h-10 bg-gray-50 sm:mx-5 mt-3 dark:text-white">
    <div class="text-center hidden sm:block sm:col-span-1 px-3">
        Activo
    </div>
    <div class="px-3 col-span-1 sm:col-span-3">
        Tipo
    </div>
    <div class="hidden col-span-1 sm:block px-3">
        Modelo
    </div>
    <div class="hidden col-span-5 sm:block px-3">
        PDF
    </div>
    <div class="text-center px-3 col-span-1">
        Ficha
    </div>
</div>
<?php
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/impresion_documentos/gestion/datos-select-php.php");
if(isset($matriz_id_modelos)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($matriz_id_modelos as $key => $valor) {
            $tituloDocumento = 'Factura';
            switch($matriz_tipo_documento_modelos[$key])
            {
                case "pre":
                    $tituloDocumento = "Presupuesto";
                    break;
                case "ped":
                    $tituloDocumento = "Pedido";
                    break;
                case "alb":
                    $tituloDocumento = "Albarán";
                    break;
                default:
                    break;
            }
            ?>
            <div class="grid grid-cols-12 items-center h-14 bg-white border-2 border-gray-50" id="linea_<?php echo $valor; ?>">
                <div class="text-center hidden sm:block sm:col-span-1 px-3" id="capa_img_activo_<?php echo $valor; ?>">
                    <input type="checkbox" class="block w-7 h-7 mx-auto text-blendi-600 cursor-pointer" id="habilitar_<?php echo $valor; ?>"
                        <?php echo ($matriz_activo_modelos[$key] == 1)? ' checked ' : ''; ?> onclick="toogleHabilitar('<?php echo $valor; ?>', 'impresion_documentos');" />
                </div>
                <div class="px-3 col-span-1 sm:col-span-3">
                    <?php echo $tituloDocumento; ?>
                </div>
                <div class="hidden col-span-1 sm:block px-3">
                    <?php echo $matriz_descripcion_modelos[$key]; ?>
                </div>
                <div class="hidden col-span-5 sm:block px-3" id="capa_boton_subir_imagen_<?php echo $valor; ?>">
                    <input id="image-file" type="file" onchange="SavePDF(this,'<?php echo $id_panel_sys; ?>','<?php echo $key; ?>','<?php echo $valor; ?>');" />
                </div>
                <div id="capa_info_subir_pdf_<?php echo $valor; ?>"></div>
                <div class="text-center px-3 col-span-1">
                    <a href="#" class="botones-apartados" title="<?php echo $matriz_descripcion_modelos[$key]; ?>" onclick="abrirFicha(<?php echo $valor; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php
        }
        unset($matriz_id_modelos);
        unset($matriz_descripcion_modelos);
        unset($matriz_tipo_documento_modelos);
        unset($matriz_activo_modelos);
        ?>
    </div>
    <?php
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/componentes/footer-listados.php");
}else {
    ?>
    <div class="flex items-center justify-center h-10 bg-white mx-5">
        <div class="text-center grow px-3">
            No existen modelos definidos.
        </div>
    </div>
    <?php
}
?>
