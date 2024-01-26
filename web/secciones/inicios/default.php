<section class="py-20 overflow-x-hidden">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center -mx-3">
            <?php
            if (isset($categoriasInicio)) {
                foreach ($categoriasInicio['descripcion'] as $categoriaInicioKey => $categoriaInicioDescripcion) {
                    ?>
                    <a href="<?php echo $host_links . '/' . $categoriasInicio['descripcion_url'][$categoriaInicioKey]; ?>" class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6">
                        <div class="h-full p-6 md:p-12 border">
                            <div class="flex items-center">
                                <span class="flex-shrink-0 inline-flex mr-4 md:mr-10 items-center justify-center w-20 h-20 bg-blue-300 rounded-full">
                                    <svg width="37" height="37" viewbox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M34.9845 11.6702C33.7519 10.3368 32 9.60814 30.0543 9.60814H24.9767V6.75543C24.9767 6.2438 24.5581 5.8252 24.0465 5.8252H0.930233C0.418605 5.8252 0 6.2438 0 6.75543V27.2128C0 27.7244 0.418605 28.143 0.930233 28.143H4.63566C4.93798 29.864 6.43411 31.174 8.24031 31.174C10.0465 31.174 11.5426 29.864 11.845 28.143H24.0465H26.0853C26.3876 29.864 27.8837 31.174 29.6899 31.174C31.4961 31.174 32.9922 29.864 33.2946 28.143H36.0698C36.5814 28.143 37 27.7244 37 27.2128V17.6004C36.9922 15.143 36.3023 13.0888 34.9845 11.6702ZM1.86047 7.68566H23.1163V10.5384V26.2903H11.6822C11.1783 24.8795 9.82171 23.864 8.24031 23.864C6.65892 23.864 5.30233 24.8795 4.79845 26.2903H1.86047V7.68566ZM8.24031 29.3136C7.24806 29.3136 6.44186 28.5074 6.44186 27.5151C6.44186 26.5229 7.24806 25.7167 8.24031 25.7167C9.23256 25.7167 10.0388 26.5229 10.0388 27.5151C10.0388 28.5074 9.23256 29.3136 8.24031 29.3136ZM29.6899 29.3136C28.6977 29.3136 27.8915 28.5074 27.8915 27.5151C27.8915 26.5229 28.6977 25.7167 29.6899 25.7167C30.6822 25.7167 31.4884 26.5229 31.4884 27.5151C31.4884 28.5074 30.6822 29.3136 29.6899 29.3136ZM35.1318 26.2826H33.1318C32.6279 24.8717 31.2713 23.8562 29.6899 23.8562C28.1085 23.8562 26.7519 24.8717 26.2481 26.2826H24.9845V11.4686H30.062C33.1938 11.4686 35.1395 13.8174 35.1395 17.6004V26.2826H35.1318Z" fill="white"></path>
                                    </svg>
                                </span>
                                <div>
                                    <h3 class="mb-4 text-lg font-bold font-heading"><?php echo $categoriaInicioDescripcion; ?></h3>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
