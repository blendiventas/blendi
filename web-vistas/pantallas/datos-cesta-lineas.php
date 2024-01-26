<?php
if($mostrar_cesta == "superior") {
    ?>
    <div class="grid grid-cols-12 font-bold text-sm" id="capa_cabecera_lineas_cesta">
        <div>
            &nbsp;
        </div>
        <div class="col-span-2">
            Referencia
        </div>
        <div class="col-span-4">
            Descripción
        </div>
        <div class="col-span-2 text-center">
            <?php
            if($tipo_librador == "pro" OR $tipo_librador == "cre") {
                echo "Coste";
            }else {
                echo "PVP";
            }
            ?>
        </div>
        <div class="text-center">
            Uds.
        </div>
        <div class="col-span-2 text-center">
            Total
        </div>
        <div class="row-cesta borders-documentos">
            &nbsp;
        </div>
    </div>
    <?php
}else {
    ?>
    <!-- <div class="grid grid-cols-12 font-bold text-sm" id="capa_cabecera_lineas_cesta"> -->
    <div class="text-gray-700 bg-white flex justify-start items-center text-xs mt-1 mb-4 px-4 font-bold">
        <div>
            Uds.
        </div>
        <!--
        <div class="col-span-2 text-center">
            <?php
            /*
            if($tipo_librador == "pro" OR $tipo_librador == "cre") {
                echo "Coste";
            }else {
                if($pvp_iva_incluido == 1) {
                    echo "PVP";
                }else {
                    echo "Importe";
                }
            }
            */
            ?>
        </div>
        -->
        <div class="ml-5">
            Descripción
        </div>
        <div class="grow"></div>
        <div class="hidden lg:block">
            Precio
        </div>
        <div class="ml-8">
            Total
        </div>
        <!-- <div class="col-span-2 text-right" id="capa_total_documento"></div> -->
    </div>
    <?php
}
?>
<div class="text-sm" id="contenido_lineas"></div>
<div class="grid grid-cols-12 text-sm mt-2" id="contenido_resumen_lineas"></div>