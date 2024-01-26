<!-- Modal toggle -->
<button id="botonOpenModalEntregaDomicilio" class="hidden" type="button" data-modal-toggle="capa-entrega-domicilio-modal">
    Toggle modal
</button>

<!-- Main modal -->
<div id="capa-entrega-domicilio-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold" id="capa_mesa_seleccionada">
                    Datos del nuevo envio a domicilio
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="capa-entrega-domicilio-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Cerrar pantalla</span>
                </button>
            </div>
            <!-- Modal body -->
            <input type="hidden" id="id-mesa-comensales-guardar" value="0" />
            <input type="hidden" id="id-documento-comensales-guardar" value="0" />
            <input type="hidden" id="ejercicio-documento-comensales-guardar" value="<?php echo $ejercicio; ?>" />
            <input type="hidden" id="id-librador-comensales-guardar" value="0" />
            <div class="w-full p-3">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <?php
                    $class_grids = "grid-2-cesta-del";
                    ?>
                    <div class="<?php echo $class_grids; ?>" id="capa-nombre-del">
                        <div class="row text-left input-cesta">
                            <strong>Nombre:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="nombre_documento_buscar" id="nombre_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-direccion-del">
                        <div class="row text-left input-cesta">
                            <strong>Dirección:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="direccion_documento_buscar" id="direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-numero-del">
                        <div class="row text-left input-cesta">
                            <strong>Número:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="numero_direccion_documento_buscar" id="numero_direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-escalera-del">
                        <div class="row text-left input-cesta">
                            <strong>Escalera:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="escalera_direccion_documento_buscar" id="escalera_direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-piso-del">
                        <div class="row text-left input-cesta">
                            <strong>Piso:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="piso_direccion_documento_buscar" id="piso_direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-puerta-del">
                        <div class="row text-left input-cesta">
                            <strong>Puerta:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="puerta_direccion_documento_buscar" id="puerta_direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-localidad-del">
                        <div class="row text-left input-cesta">
                            <strong>Localidad:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="localidad_documento_buscar" id="localidad_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-codigo-postal-del">
                        <div class="row text-left input-cesta">
                            <strong>Código postal:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="codigo_postal_documento_buscar" id="codigo_postal_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="grid-2-cesta" id="capa-mobil-del">
                        <div class="row text-left input-cesta">
                            <strong>Teléfono:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="number" class="w-full mt-10p" style="text-align: center; width: 120px; margin-left: auto; margin-right: auto;" id="mobil_documento_buscar" onkeydown="return controlSpacios(event);" onkeyup="return buscarDatosDel(9);" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-fecha-entrega-del">
                        <div class="row text-left input-cesta">
                            <strong>Fecha entrega:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="date" class="w-full sin-borde input-cesta" name="fecha_entrega_documento_buscar" id="fecha_entrega_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-hora-entrega-del">
                        <div class="row text-left input-cesta">
                            <strong>Hora entrega:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="time" class="w-full sin-borde input-cesta" name="hora_entrega_documento_buscar" id="hora_entrega_documento_buscar" value="" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="<?php echo $class_grids; ?>" id="capa-guardar-del">
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <button class="button-documento" onclick="document.getElementById('tipo_librador').value='del'; delIni('del');">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="<?php echo $class_grids; ?>" id="capa-guardar-nueva-direccion-del">
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <button class="button-documento" onclick="document.getElementById('tipo_librador').value='del'; document.getElementById('id_librador_cesta').value = -1; delIni('del');">
                                Guardar
                            </button>
                        </div>
                    </div>
                    <div class="mt-10p <?php echo $class_grids; ?>" id="capa-cancelar-nueva-direccion-del">
                        <button class="botones-cesta" data-modal-toggle="capa-entrega-domicilio-modal">Cancelar</button>
                    </div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <?php
                    $class_grids = "grid-2-cesta-del";
                    ?>
                    <div class="<?php echo $class_grids; ?>" id="capa-otras-direcciones-del">
                        <div class="row text-left input-cesta">
                            <strong>Otras direcciones:</strong>
                        </div>
                        <div class="row text-left">
                            <select class="w-full form-select" name="otras_direcciones_documento_buscar" id="otras_direcciones_documento_buscar" onchange="cambiarSelectBuscar();"></select>
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-nombres-del">
                        <div class="row text-left input-cesta">
                            <strong>Nombre:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="nombres_documento_buscar" id="nombres_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-direcciones-del">
                        <div class="row text-left input-cesta">
                            <strong>Dirección:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="direcciones_documento_buscar" id="direcciones_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-numeros-del">
                        <div class="row text-left input-cesta">
                            <strong>Número:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="numeros_direccion_documento_buscar" id="numeros_direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-escaleras-del">
                        <div class="row text-left input-cesta">
                            <strong>Escalera:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="escaleras_direccion_documento_buscar" id="escaleras_direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-pisos-del">
                        <div class="row text-left input-cesta">
                            <strong>Piso:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="pisos_direccion_documento_buscar" id="pisos_direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-puertas-del">
                        <div class="row text-left input-cesta">
                            <strong>Puerta:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="puertas_direccion_documento_buscar" id="puertas_direccion_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-localidades-del">
                        <div class="row text-left input-cesta">
                            <strong>Localidad:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="localidades_documento_buscar" id="localidades_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-codigos-postal-del">
                        <div class="row text-left input-cesta">
                            <strong>Código postal:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="text" class="w-full sin-borde input-cesta" name="codigos_postal_documento_buscar" id="codigos_postal_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-mobiles-del">
                        <div class="row text-left input-cesta">
                            <strong>Teléfono:</strong>
                        </div>
                        <div class="row text-left" id="mobiles_documento_buscar">

                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-fechas-entrega-del">
                        <div class="row text-left input-cesta">
                            <strong>Fecha entrega:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="date" class="w-full sin-borde input-cesta" name="fechas_entrega_documento_buscar" id="fechas_entrega_documento_buscar" value="" />
                        </div>
                    </div>
                    <div class="<?php echo $class_grids; ?>" id="capa-horas-entrega-del">
                        <div class="row text-left input-cesta">
                            <strong>Hora entrega:</strong>
                        </div>
                        <div class="row text-left">
                            <input type="time" class="w-full sin-borde input-cesta" name="horas_entrega_documento_buscar" id="horas_entrega_documento_buscar" value="" />
                        </div>
                    </div>
                </div>
                <div class="w-full mt-4" id="capas-guardar-del">
                    <div class="<?php echo $class_grids; ?> grid grid-cols-3">
                        <div class="text-center">
                            <button class="button-documento" onclick="crearNuevaDireccion();">
                                Crear nueva dirección
                            </button>
                        </div>
                        <div class="text-center">
                            <button class="button-documento" onclick="document.getElementById('tipo_librador').value='del'; delIni('dels');">
                                Guardar
                            </button>
                        </div>
                        <div class="text-center <?php echo $class_grids; ?>" id="capas-cancelar-nueva-direccion-del">
                            <button class="botones-cesta" data-modal-toggle="capa-entrega-domicilio-modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>