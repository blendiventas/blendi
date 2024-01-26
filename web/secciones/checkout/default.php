<section class="py-20 bg-gray-100">
    <div id="mensaje-actualizacion-carrito" style="display: none;"
         class="container mx-auto px-4 p-4 mb-4 text-blendigray-100 rounded-lg bg-blue-100 dark:bg-gray-800 dark:text-blendigray-100">
        <div class="flex justify-start items-center">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="pl-2" id="texto-actualizacion-carrito"></span>
        </div>
    </div>
    <form name="checkout_form" id="checkout_form">
        <div class="container mx-auto px-4">
            <div class="p-8 bg-white">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full sm:w-1/2 px-4 mb-10 lg:mb-0">
                        <div class="flex mb-12 items-center">
                            <span class="flex-shrink-0 inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-blendi-300 text-white">1</span>
                            <h3 class="text-lg font-bold font-heading">Dirección de envío</h3>
                        </div>

                        <?php
                        $id_zona = 0;
                        if (!empty($matriz_id_libradores_zonas)) {
                            $id_zona = $matriz_id_libradores_zonas[0];
                            ?>
                            <div class="mb-10">
                                <label class="font-bold font-heading text-gray-600" for="">Zona</label>
                                <select class="block w-full mt-4 py-4 px-8 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" name="zona" id="zona" onchange="loadMetodosEnvio(this.value)">
                                    <?php
                                    foreach ($matriz_id_libradores_zonas as $key_libradores_zonas => $id_libradores_zonas) {
                                        ?>
                                        <option value="<?php echo $id_libradores_zonas; ?>"><?php echo $matriz_zona_libradores_zonas[$key_libradores_zonas]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                        }
                        if (!isset($id_librador)) {
                            ?>
                            <div class="mb-10">
                                <label class="font-bold font-heading text-gray-600" for="">Email</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="email" name="email_documento" onchange="checkEmailCheckout(this);">
                            </div>
                            <div class="mb-12">
                                <p class="mb-5 text-sm text-gray-500">¿Quieres crear una cuenta?</p>
                                <div class="py-4 px-6 rounded-full bg-blue-50">
                                    <label class="flex items-center" for="">
                                        <input type="checkbox" onclick="if (this.checked) { document.getElementById('password_registro').classList.remove('hidden'); document.getElementById('signup_password').value = ''; this.classList.add('hidden'); } else { document.getElementById('password_registro').classList.add('hidden'); }">
                                        <span class="ml-2 text-sm">Registro/Escojer password</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-10 hidden" id="password_registro">
                                <label class="font-bold font-heading text-gray-600" for="">Password</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="password" id="signup_password" name="signup_password" value="<?php echo rand(time(), time() + 999999); ?>">
                            </div>
                            <?php
                        } else {
                            ?>
                            <input type="hidden" id="email_documento" name="email_documento" value="<?php echo (isset($email))? $email : ''; ?>">
                            <script type="application/javascript">
                                checkEmailCheckout(document.getElementById('email_documento'));
                            </script>
                            <?php
                        }
                        ?>
                        <div class="mb-10">
                            <label class="font-bold font-heading text-gray-600" for="">Nombre</label>
                            <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="nombre_envio_documento" onkeyup="document.getElementById('nombre_documento').value=this.value" value="<?php echo (isset($librador_nombre))? $librador_nombre : ''; ?>">
                        </div>
                        <div class="mb-10 flex space-x-2">
                            <div>
                                <label class="font-bold font-heading text-gray-600" for="">Apellido 1</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="apellido_1_envio_documento" onkeyup="document.getElementById('apellido_1_documento').value=this.value" value="<?php echo (isset($librador_apellido_1))? $librador_apellido_1 : ''; ?>">
                            </div>
                            <div>
                                <label class="font-bold font-heading text-gray-600" for="">Apellido 2</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="apellido_2_envio_documento" onkeyup="document.getElementById('apellido_2_documento').value=this.value" value="<?php echo (isset($librador_apellido_2))? $librador_apellido_2 : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-10">
                            <label class="font-bold font-heading text-gray-600" for="">Dirección</label>
                            <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="direccion_envio_documento" onkeyup="document.getElementById('direccion_documento').value=this.value" value="<?php echo (isset($direccion))? $direccion : ''; ?>">
                        </div>
                        <div class="mb-10 flex space-x-2">
                            <div>
                                <label class="font-bold font-heading text-gray-600" for="">N°</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="numero_direccion_envio_documento" onkeyup="document.getElementById('numero_direccion_documento').value=this.value" value="<?php echo (isset($numero))? $numero : ''; ?>">
                            </div>
                            <div>
                                <label class="font-bold font-heading text-gray-600" for="">Escalera</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="escalera_direccion_envio_documento" onkeyup="document.getElementById('escalera_direccion_documento').value=this.value" value="<?php echo (isset($escalera))? $escalera : ''; ?>">
                            </div>
                            <div>
                                <label class="font-bold font-heading text-gray-600" for="">Piso</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="piso_direccion_envio_documento" onkeyup="document.getElementById('piso_direccion_documento').value=this.value" value="<?php echo (isset($piso))? $piso : ''; ?>">
                            </div>
                            <div>
                                <label class="font-bold font-heading text-gray-600" for="">Puerta</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="puerta_direccion_envio_documento" onkeyup="document.getElementById('puerta_direccion_documento').value=this.value" value="<?php echo (isset($puerta))? $puerta : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-10 flex space-x-2">
                            <!--<div class="w-full md:w-3/5 px-4 mb-10 md:mb-0">
                                <label class="font-bold font-heading text-gray-600" for="">País</label>
                                <select class="block w-full mt-4 py-4 px-8 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" name="" id="">
                                    <option value="1">España</option>
                                </select>
                            </div>-->
                            <div class="w-full sm:w-2/5">
                                <label class="font-bold font-heading text-gray-600" for="">Provincia</label>
                                <!--<select class="block w-full mt-4 py-4 px-8 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" name="provincia_documento" id="">
                                    <option value="1">Barcelona</option>
                                    <option value="2">Madrid</option>
                                </select>-->
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="provincia_envio_documento" onkeyup="document.getElementById('provincia_documento').value=this.value" value="<?php echo (isset($provincia))? $provincia : ''; ?>">
                            </div>
                            <div class="w-full sm:w-2/5">
                                <label class="font-bold font-heading text-gray-600" for="">Localidad</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="localidad_envio_documento" onkeyup="document.getElementById('localidad_documento').value=this.value" value="<?php echo (isset($localidad))? $localidad : ''; ?>">
                            </div>
                            <div class="w-full sm:w-1/5">
                                <label class="font-bold font-heading text-gray-600" for="">CP</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" name="codigo_postal_envio_documento" onkeyup="document.getElementById('codigo_postal_documento').value=this.value" value="<?php echo (isset($codigo_postal))? $codigo_postal : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-10">
                            <label class="flex items-center" for="">
                                <input type="checkbox" onclick="toogleDatosDeFacturacion()">
                                <span class="ml-2 text-sm">Tengo una dirección de facturación diferente</span>
                            </label>
                        </div>
                        <div class="hidden" id="datos_facturacion_checkout">
                            <div class="mb-10">
                                <label class="font-bold font-heading text-gray-600" for="">Nombre</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="nombre_documento" name="nombre_documento" value="<?php echo (isset($librador_nombre))? $librador_nombre : ''; ?>">
                            </div>
                            <div class="mb-10 flex space-x-2">
                                <div>
                                    <label class="font-bold font-heading text-gray-600" for="">Apellido 1</label>
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="apellido_1_documento" name="apellido_1_documento" value="<?php echo (isset($librador_apellido_1))? $librador_apellido_1 : ''; ?>">
                                </div>
                                <div>
                                    <label class="font-bold font-heading text-gray-600" for="">Apellido 2</label>
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="apellido_2_documento" name="apellido_2_documento" value="<?php echo (isset($librador_apellido_2))? $librador_apellido_2 : ''; ?>">
                                </div>
                            </div>
                            <div class="mb-10">
                                <label class="font-bold font-heading text-gray-600" for="">Dirección</label>
                                <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="direccion_documento" name="direccion_documento" value="<?php echo (isset($direccion))? $direccion : ''; ?>">
                            </div>
                            <div class="mb-10 flex space-x-2">
                                <div>
                                    <label class="font-bold font-heading text-gray-600" for="">N°</label>
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="numero_direccion_documento" name="numero_direccion_documento" value="<?php echo (isset($numero))? $numero : ''; ?>">
                                </div>
                                <div>
                                    <label class="font-bold font-heading text-gray-600" for="">Escalera</label>
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="escalera_direccion_documento" name="escalera_direccion_documento" value="<?php echo (isset($escalera))? $escalera : ''; ?>">
                                </div>
                                <div>
                                    <label class="font-bold font-heading text-gray-600" for="">Piso</label>
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="piso_direccion_documento" name="piso_direccion_documento" value="<?php echo (isset($piso))? $piso : ''; ?>">
                                </div>
                                <div>
                                    <label class="font-bold font-heading text-gray-600" for="">Puerta</label>
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="puerta_direccion_documento" name="puerta_direccion_documento" value="<?php echo (isset($puerta))? $puerta : ''; ?>">
                                </div>
                            </div>
                            <div class="mb-10 flex space-x-2">
                                <!--<div class="w-full md:w-3/5 px-4 mb-10 md:mb-0">
                                    <label class="font-bold font-heading text-gray-600" for="">País</label>
                                    <select class="block w-full mt-4 py-4 px-8 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" name="" id="">
                                        <option value="1">España</option>
                                    </select>
                                </div>-->
                                <div class="w-full sm:w-2/5">
                                    <label class="font-bold font-heading text-gray-600" for="">Provincia</label>
                                    <!--<select class="block w-full mt-4 py-4 px-8 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" name="provincia_documento" id="">
                                        <option value="1">Barcelona</option>
                                        <option value="2">Madrid</option>
                                    </select>-->
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="provincia_documento" name="provincia_documento" value="<?php echo (isset($provincia))? $provincia : ''; ?>">
                                </div>
                                <div class="w-full sm:w-2/5">
                                    <label class="font-bold font-heading text-gray-600" for="">Localidad</label>
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="localidad_documento" name="localidad_documento" value="<?php echo (isset($localidad))? $localidad : ''; ?>">
                                </div>
                                <div class="w-full sm:w-1/5">
                                    <label class="font-bold font-heading text-gray-600" for="">CP</label>
                                    <input class="block w-full mt-4 py-4 px-4 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" id="codigo_postal_documento" name="codigo_postal_documento" value="<?php echo (isset($codigo_postal))? $codigo_postal : ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 px-4 mb-10 lg:mb-0">
                        <div class="flex mb-12 items-center">
                            <span class="flex-shrink-0 inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-blendi-300 text-white">2</span>
                            <h3 class="text-lg font-bold font-heading">Métodos de envío</h3>
                        </div>
                        <div class="mb-12 pb-10 border-b" id="metodos_envio_checkout">
                            <?php
                            $select_sys = "obtener_metodos_envio_html";
                            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-checkout.php");
                            ?>
                        </div>
                        <div class="flex mb-12 items-center">
                            <span class="flex-shrink-0 inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-blendi-300 text-white">3</span>
                            <h3 class="text-lg font-bold font-heading">Entrega</h3>
                        </div>
                        <div class="mb-12 pb-10 border-b">
                            <?php
                            $select_sys = "obtener_metodos_entrega";
                            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-checkout.php");
                            foreach ($id_modalidades_entrega as $key_modalidad_entrega => $id_modalidad_entrega) {
                                ?>
                                <div class="flex mb-3 font-bold font-heading text-gray-600">
                                    <input class="mr-5 mt-1" type="radio" name="modalidad_entrega" id="modalidad_entrega_<?php echo $key_modalidad_entrega; ?>" value="<?php echo $id_modalidad_entrega; ?>">
                                    <div class="grow"><?php echo $descripcion_modalidades_entrega[$key_modalidad_entrega]; ?></div>
                                </div>
                                <div class="mb-5">
                                    <?php echo $explicacion_modalidades_entrega[$key_modalidad_entrega]; ?>
                                </div>
                                <?php
                            }
                            unset($id_modalidades_entrega);
                            unset($descripcion_modalidades_entrega);
                            unset($explicacion_modalidades_entrega);
                            ?>
                        </div>
                        <div class="flex mb-12 items-center">
                            <span class="flex-shrink-0 inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-blendi-300 text-white">4</span>
                            <h3 class="text-lg font-bold font-heading">Métodos de pago</h3>
                        </div>
                        <div class="mb-12 pb-10 border-b">
                            <?php
                            $select_sys = "obtener_metodos_pago";
                            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-checkout.php");
                            foreach ($id_metodos_pago as $key_metodo_pago => $id_metodo_pago) {
                                ?>
                                <div class="flex mb-3 font-bold font-heading text-gray-600">
                                    <input class="mr-5 mt-1 metodo_pago" data-key-metodo-pago="<?php echo $key_metodo_pago; ?>" type="radio" name="metodo_pago" id="metodo_pago_<?php echo $key_metodo_pago; ?>" value="<?php echo $id_metodo_pago; ?>" onclick="actualizarMetodosPago()">
                                    <?php
                                    if (!empty($imagen_metodos_pago)) {
                                        ?>
                                        <div><img src="<?php echo $imagen_metodos_pago[$key_metodo_pago]; ?>" /></div>
                                        <?php
                                    }
                                    ?>
                                    <div class="grow ml-3"><?php echo $descripcion_metodos_pago[$key_metodo_pago]; ?></div>
                                    <div id="metodo_pago_precio_<?php echo $key_metodo_pago; ?>" data-precio-porcentaje="<?php echo $incremento_por_metodos_pago[$key_metodo_pago]; ?>"><?php echo number_format($incremento_pvp_metodos_pago[$key_metodo_pago], 2, ',', '.'); ?>€</div>
                                </div>
                                <div class="mb-5">
                                    <?php echo $explicacion_metodos_pago[$key_metodo_pago]; ?>
                                </div>
                                <?php
                            }
                            unset($id_metodos_pago);
                            unset($descripcion_metodos_pago);
                            unset($explicacion_metodos_pago);
                            unset($id_iva_metodos_pago);
                            unset($incremento_pvp_metodos_pago);
                            unset($incremento_por_metodos_pago);
                            unset($imagen_metodos_pago);
                            ?>
                        </div>
                        <div class="flex mb-12 items-center">
                            <span class="flex-shrink-0 inline-flex mr-8 items-center justify-center w-12 h-12 rounded-full bg-blendi-300 text-white">5</span>
                            <h3 class="text-lg font-bold font-heading">Resumen del pedido</h3>
                        </div>
                        <div class="mb-12 p-4 bg-blue-300" id="resumen_pedido">
                            &nbsp;
                        </div>
                        <div class="mb-10">
                            <span class="inline-block mb-4 font-medium">Aplicar código de descuento:</span>
                            <div class="flex mb-12 flex-wrap lg:flex-nowrap items-center">
                                <input class="mb-4 md:mb-0 mr-4 px-4 py-4 placeholder-gray-800 font-bold font-heading border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" placeholder="SUMMER30X">
                                <a class="inline-block mb-4 md:mb-0 px-6 py-4 text-white font-bold font-heading uppercase bg-gray-800 hover:bg-gray-700 rounded-md" href="#">Aplicar</a>
                            </div>
                        </div>
                        <div>
                            <span class="block mb-4 font-medium">Comentario para el pedido:</span>
                            <textarea class="mb-12 w-full resize-none border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" name="observaciones_envio_documento" id="" cols="30" rows="10"></textarea><a class="block w-full py-4 bg-orange-300 hover:bg-orange-400 text-center text-white font-bold font-heading uppercase rounded-md transition duration-200" href="#" onclick="terminarPedido()">Terminar pedido</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
