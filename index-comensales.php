<!-- Modal toggle -->
<button id="botonOpenModalComensales" class="hidden" type="button" data-modal-toggle="capa-comensales">
    Toggle modal
</button>

<!-- Main modal -->
<div id="capa-comensales" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold" id="capa_mesa_seleccionada">
                    Introducir el número de comensales.
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="capa-comensales">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Cerrar pantalla</span>
                </button>
            </div>
            <!-- Modal body -->
            <input type="hidden" id="id-mesa-comensales-guardar" value="0" />
            <input type="hidden" id="id-documento-comensales-guardar" value="0" />
            <input type="hidden" id="ejercicio-documento-comensales-guardar" value="<?php echo $ejercicio; ?>" />
            <input type="hidden" id="id-librador-comensales-guardar" value="0" />
            <div class="w-full py-3">
                <input type="hidden" id="comensales-guardar" value="0" />
                <div class="flex justify-center">
                    <select id="lista_comensales_guardar" onchange="controlListaComensales('');">
                        <?php
                        for ($bucle = 0 ; $bucle <= 50 ; $bucle++) {
                            echo "<option value='".$bucle."'>".$bucle."</option>";
                        }
                        ?>
                        <option value="-1">Otra cantidad</option>
                    </select>
                </div>
                <input type="number" class="mt-10p hidden" style="text-align: center; width: 120px; margin-left: auto; margin-right: auto;" id="numero_comensales_guardar" value="" />
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                <button data-modal-toggle="capa-comensales" type="button" class="text-white dark:text-black bg-blendi-600 dark:bg-blendidark-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center" onclick="guardarComensales('');">Abrir mesa <span id="descripcion_boton_abrir_mesa"></span></button>
                <button data-modal-toggle="capa-comensales" type="button" class="text-gray-500 bg-white hover:bg-gray-100 dark:hover:bg-graydark-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<button id="botonOpenModalComensalesLoading" class="hidden" type="button" data-modal-toggle="capa-comensales-loading">
    Toggle modal
</button>

<div id="capa-comensales-loading" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-white p-3">
            Abriendo mesa...
        </div>
    </div>
</div>
