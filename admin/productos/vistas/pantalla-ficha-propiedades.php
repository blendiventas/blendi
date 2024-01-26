<input type="hidden" name="apartado" id="apartado" value="propiedades" />
<li>
    <?php
    /*
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/componentes/form-datos.php");
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/componentes/form-checkbox.php");
    */
    require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/componentes/form-select.php");
    ?>
</li>
<hr />
<a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-detalles/apartado=propiedades/id_productos=<?php echo $id_url; ?>" class="botones-apartados" title="Detalles productos" >
    <img id="icono-collapse-capa-general" class="icon bg-white" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-down-line.svg" alt="My Happy SVG"/>
    Detalles productos
</a>
<div class="grid-1 mb-2">
    <div class="box">
        <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos/ancla=linea_<?php echo $id_url; ?>" class="botones-apartados w-50 display-inline-grid" title="Productos">
            Volver
        </a>
    </div>
</div>
