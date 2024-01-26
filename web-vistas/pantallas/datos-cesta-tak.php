<?php
$select_sys = "bancos-cajas";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-bancos-cajas.php");
$id_banco_cobro_defecto = 0;
if (count($id_bancos_cajas) > 0) {
    $id_banco_cobro_defecto = $id_bancos_cajas[0];
}
?>

<input type="hidden" name="id_librador_cesta" id="id_librador_cesta" value="<?php echo $id_librador; ?>" />
<input type="hidden" name="tipo_librador" id="tipo_librador" value="<?php echo $tipo_librador; ?>" />
<input type="hidden" name="id_banco_cobro_defecto" id="id_banco_cobro_defecto" value="<?php echo $id_banco_cobro_defecto; ?>" />

<?php
unset($id_bancos_cajas);
unset($descripcion_bancos_cajas);
unset($iban_bancos_cajas);
?>

<input type="hidden" name="codigo_librador_documento" id="codigo_librador_documento" value="" />
<input type="hidden" name="apellido_1_documento" id="apellido_1_documento" value="" />
<input type="hidden" name="apellido_2_documento" id="apellido_2_documento" value="" />
<input type="hidden" name="razon_social_documento" id="razon_social_documento" value="" />
<input type="hidden" name="razon_comercial_documento" id="razon_comercial_documento" value="" />
<input type="hidden" name="nif_documento" id="nif_documento" value="" />
<input type="hidden" name="direccion_documento" id="direccion_documento" value="" />
<input type="hidden" name="numero_direccion_documento" id="numero_direccion_documento" value="" />
<input type="hidden" name="escalera_direccion_documento" id="escalera_direccion_documento" value="" />
<input type="hidden" name="piso_direccion_documento" id="piso_direccion_documento" value="" />
<input type="hidden" name="puerta_direccion_documento" id="puerta_direccion_documento" value="" />
<input type="hidden" name="localidad_documento" id="localidad_documento" value="" />
<input type="hidden" name="codigo_postal_documento" id="codigo_postal_documento" value="" />
<input type="hidden" name="provincia_documento" id="provincia_documento" value="" />
<input type="hidden" name="telefono_1_documento" id="telefono_1_documento" value="" />
<input type="hidden" name="telefono_2_documento" id="telefono_2_documento" value="" />
<input type="hidden" name="fax_documento" id="fax_documento" value="" />
<input type="hidden" name="email_documento" id="email_documento" value="" />
<input type="hidden" name="persona_contacto_documento" id="persona_contacto_documento" value="" />

<?php
if(($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") && empty($numero_documento)) {
    ?>
    <input type="hidden" name="serie_documento" id="serie_documento" value="" />
    <?php
}

$class = "hidden";
if(empty($mobil)) {
    $class = "";
}
if($fecha_recogida == "0000-00-00") {
    $fecha_recogida = date("Y-m-d");
}
if($hora_recogida == "00:00:00") {
    $hora_recogida = date("H:m:s");
}
if(empty($librador_nombre) && !empty($librador_social)) {
    $librador_nombre = $librador_social;
}

?>

<!-- INICIO MODAL -->
<div class="flex bg-gray-25 dark:bg-graydark-650">
    <a href="#" class="bg-gray-25 dark:bg-graydark-650 w-full flex items-center justify-center font-medium text-sm text-center p-3 text-blendi-600 font-bold hover:text-blendidark-50" type="button" onclick="modalTak.show()">
        <span class="text-blendi-600">
            <?php echo $librador_nombre; ?>
        </span>
        <!--<div class="pl-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </div>-->
    </a>
    <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50" onclick="imprimirDocumento(idDocumento,ejercicio,'','');">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
        </svg>
    </a>
    <a href="#" class="bg-gray-25 dark:bg-graydark-650 p-3 hover:text-blendidark-50" onclick="cerrarDocumento(false);">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </a>
</div>
<div id="modal-tak" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                    Configuración del documento
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"  onclick="modalTak.hide()">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Cerrar</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6 modal-body overflow-y-auto">
                <div class="flex items-center p-3 bg-gray-50">
                    <button class="button-documento grow" onclick="collapseMenu('capa-datos-cabecera-tak'); return false;">
                        Datos recogida local
                    </button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" id="capa-datos-cabecera-tak-show" onclick="collapseMenu('capa-datos-cabecera-tak'); return false;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer hidden" id="capa-datos-cabecera-tak-hidden" onclick="collapseMenu('capa-datos-cabecera-tak'); return false;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="w-4 ml-2">&nbsp;</div>
                </div>
                <div class="<?php echo $class; ?> mt-4" id="capa-datos-cabecera-tak">
                    <input type="hidden" name="nombre_documento" id="nombre_documento" value="<?php echo $librador_nombre; ?>" />
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="grid-2-cesta w-full">
                            <div class="row text-left input-cesta">
                                <strong>Número:</strong>
                            </div>
                            <div class="row text-left">
                                <?php echo $numero_documento; ?>
                            </div>
                        </div>
                        <div class="grid-2-cesta w-full">
                            <div class="row text-left input-cesta">
                                <strong>Nombre:</strong>
                            </div>
                            <div class="row text-left">
                                <?php echo $librador_nombre; ?>
                            </div>
                        </div>
                        <div class="grid-2-cesta w-full">
                            <div class="row text-left input-cesta">
                                <strong>Alias:</strong>
                            </div>
                            <div class="row text-left">
                                <input type="text" class="sin-borde input-cesta w-full" name="mobil_documento" id="mobil_documento" value="<?php echo $mobil; ?>" />
                            </div>
                        </div>
                        <div class="grid-2-cesta w-full">
                            <div class="row text-left input-cesta">
                                <strong>Fecha recogida:</strong>
                            </div>
                            <div class="row text-left">
                                <input type="date" class="sin-borde input-cesta w-full" name="fecha_recogida_documento" id="fecha_recogida_documento" value="<?php echo $fecha_recogida; ?>" />
                            </div>
                        </div>
                        <div class="grid-2-cesta w-full">
                            <div class="row text-left input-cesta">
                                <strong>Hora recogida:</strong>
                            </div>
                            <div class="row text-left">
                                <input type="time" class="sin-borde input-cesta w-full" name="hora_recogida_documento" id="hora_recogida_documento" value="<?php echo $hora_recogida; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="grid-2-cesta grid grid-cols-2 gap-4 mt-5">
                        <div class="row">
                            <button class="button-documento" onclick="identificar('4');">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>

                <?php
                require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-enviar.php");
                require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-documento.php");
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function() {
        window.modalTak = new Modal(document.getElementById('modal-tak'));
    })();
</script>
