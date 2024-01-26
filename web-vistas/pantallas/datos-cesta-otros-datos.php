<?php
$clase_comensales = " hidden";
if ($existen_mesas == true) {
    $clase_comensales = "";
}
if($mostrar_cesta == "superior") {
    ?>
    <div class="grid-4-cesta-pie" id="capa_otros_datos_cesta">
        <div class="row-cesta borders-documentos hidden">
            <input type="hidden" name="estado" id="estado" value="" />
            <strong>Estado: </strong><span name="estado_texto" id="estado_texto"></span>
        </div>
        <input type="hidden" name="id_terminal" id="id_terminal" value="" />
        <div class="row-cesta">
            <div class="flex flex-wrap items-center justify-center p-6 space-x-2">
                <button data-modal-toggle="modal-otros-datos-documento" type="button" class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5">Descartar</button>
                <button type="button" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="identificar('8');">Guardar</button>
            </div>
        </div>
    </div>
    <?php
}else {
    ?>
    <div class="grid-1-cesta-lateral" id="capa_otros_datos_cesta">
        <div class="row-cesta hidden">
            <input type="hidden" name="estado" id="estado" value="" />
            <strong>Estado: </strong><span name="estado_texto" id="estado_texto"></span>
        </div>
        <input type="hidden" name="id_terminal" id="id_terminal" value="" />
    </div>
    <div class="grid-1-cesta-lateral" id="capa_otros_datos_textarea_cesta">
        <div class="row-cesta">
            <div class="flex flex-wrap items-center justify-center p-6 space-x-2">
                <button data-modal-toggle="modal-otros-datos-documento" type="button" class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5">Descartar</button>
                <button type="button" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="identificar('8');">Guardar</button>
            </div>
        </div>
    </div>
    <?php
}