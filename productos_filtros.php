<button id="capa-boton-filtro-productos-<?php echo $posicion_filtro; ?>" class="button-filtro" onclick="collapseCapa('capa-filtro-productos-<?php echo $posicion_filtro; ?>');">
    Ordenar por <?php echo $orden_descripcion; ?>
</button>
<div id="capa-filtro-productos-<?php echo $posicion_filtro; ?>" class="hidden">
    <div class="box">
        <a href="<?php echo $host_url.$url_categoria_paginador."/pag=".$pagina."_ord=a-z"; ?>" class="menu">
            <div class="box button-filtro-opcion">
                <span class="text-08">A-Z</span>
            </div>
        </a>
    </div>
    <div class="box">
        <a href="<?php echo $host_url.$url_categoria_paginador."/pag=".$pagina."_ord=z-a"; ?>" class="menu">
            <div class="box button-filtro-opcion">
                <span class="text-08">Z-A</span>
            </div>
        </a>
    </div>
    <div class="box">
        <a href="<?php echo $host_url.$url_categoria_paginador."/pag=".$pagina."_ord=precio"; ?>" class="menu">
            <div class="box button-filtro-opcion">
                <span class="text-08">Precio más alto</span>
            </div>
        </a>
    </div>
    <div class="box">
        <a href="<?php echo $host_url.$url_categoria_paginador."/pag=".$pagina."_ord=-precio"; ?>" class="menu">
            <div class="box button-filtro-opcion">
                <span class="text-08">Precio más bajo</span>
            </div>
        </a>
    </div>
</div>