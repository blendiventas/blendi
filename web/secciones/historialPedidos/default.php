<section class="py-20 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="mb-8 text-5xl font-bold font-heading">Historial de pedidos</h2>
        <p class="mb-14 text-lg text-gray-500">Tus últimos pedidos</p>
        <?php
        if (count($pedidosUsuario) > 0) {
            foreach ($pedidosUsuario as $pedidoUsuario) {
                ?>
                <div class="mb-12 py-8 px-8 md:px-20 bg-white">
                    <div class="flex flex-wrap mb-8 pb-4 border-b">
                        <div class="mr-20">
                            <h3 class="text-gray-600">Número</h3>
                            <p class="text-blue-300 font-bold font-heading"><?php echo $pedidoUsuario->numero_documento; ?></p>
                        </div>
                        <div class="mr-auto">
                            <h3 class="text-gray-600">Fecha</h3>
                            <p class="text-blue-300 font-bold font-heading"><?php echo $pedidoUsuario->fecha_documento; ?></p>
                        </div>
                        <!--<a class="inline-flex mt-6 md:mt-0 w-full lg:w-auto justify-center items-center py-4 px-6 border hover:border-gray-500 rounded-md font-bold font-heading" href="#">
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1V0.25C0.585786 0.25 0.25 0.585786 0.25 1L1 1ZM15 19V19.75C15.4142 19.75 15.75 19.4142 15.75 19H15ZM1 19H0.25C0.25 19.4142 0.585786 19.75 1 19.75L1 19ZM10 1L10.5303 0.46967C10.3897 0.329018 10.1989 0.25 10 0.25V1ZM15 6H15.75C15.75 5.80109 15.671 5.61032 15.5303 5.46967L15 6ZM15 18.25H1V19.75H15V18.25ZM1.75 19V1H0.25V19H1.75ZM1 1.75H10V0.25H1V1.75ZM14.25 6V19H15.75V6H14.25ZM9.46967 1.53033L14.4697 6.53033L15.5303 5.46967L10.5303 0.46967L9.46967 1.53033ZM8.25 1V5H9.75V1H8.25ZM11 7.75H15V6.25H11V7.75ZM8.25 5C8.25 6.51878 9.48122 7.75 11 7.75V6.25C10.3096 6.25 9.75 5.69036 9.75 5H8.25Z" fill="black"></path>
                            </svg>
                            <span class="ml-4">View Invoice</span>
                        </a>-->
                    </div>
                    <?php
                    foreach ($pedidoUsuario->lineas as $lineaPedidoUsuario) {
                        ?>
                        <div class="flex flex-wrap -mx-4 mb-8">
                            <div class="w-full lg:w-1/6 px-4 mb-8 lg:mb-0">
                                <div class="flex items-center justify-center h-72 bg-gray-100">
                                    <?php if (!empty($lineaPedidoUsuario->imagen)) { ?><img class="h-64 object-cover" src="<?php echo $lineaPedidoUsuario->imagen; ?>" alt="<?php echo $lineaPedidoUsuario->descripcion; ?>"><?php } ?>
                                </div>
                            </div>
                            <div class="w-full lg:w-5/6 px-4">
                                <div class="flex mb-16">
                                    <div class="mr-auto">
                                        <h3 class="text-lg font-bold font-heading"><?php echo $lineaPedidoUsuario->descripcion; ?></h3>
                                    </div>
                                    <span class="text-lg font-bold font-heading text-blue-300"><?php echo $lineaPedidoUsuario->total_despues_descuento; ?>€</span>
                                </div>
                                <div class="flex flex-wrap -mx-10">
                                    <div class="w-full lg:w-auto px-10 mb-6 lg:mb-0">
                                        <h4 class="mb-6 font-bold font-heading">Preparado</h4>
                                        <p class="text-gray-500">07/17/2021</p>
                                    </div>
                                    <div class="w-full lg:w-auto px-10 mb-6 lg:mb-0">
                                        <h4 class="mb-6 font-bold font-heading">Entregado</h4>
                                        <p class="text-gray-500">07/23/2021</p>
                                    </div>
                                    <!--<div class="w-full lg:w-auto ml-auto px-10"><a class="inline-block w-full md:w-auto mb-4 md:mb-0 mr-4 bg-gray-100 hover:bg-gray-200 text-center font-bold font-heading py-4 px-8 rounded-md uppercase transition duration-200" href="#">View summary</a><a class="inline-block w-full md:w-auto bg-orange-300 hover:bg-orange-400 text-center text-white font-bold font-heading py-4 px-8 rounded-md uppercase transition duration-200" href="#">Buy again</a></div>-->
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="mb-12 py-8 px-8 md:px-20 bg-white">
                <p>
                    No se han encontrado pedidos.
                </p>
            </div>
            <?php
        }
        ?>
    </div>
</section>
