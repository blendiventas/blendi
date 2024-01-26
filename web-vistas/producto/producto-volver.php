<div class="grid grid-cols-2 mr-2" id="capa-boton-volver<?php echo $anadidoModal; ?>">
    <div class="row">
        <?php
        $titulo_volver = "Atrás";
        if(!empty($descripcion_categoria)) {
            $titulo_volver = "Volver a ".$descripcion_categoria;
        }
        if($pagina != 1 OR !empty($orden_path)) {
            ?>
            <!--  <?php echo $host_url.$path_components[$indice_componente]."/pag=".$pagina."_ord=".$orden_path; ?> -->
            <a href="#" onclick="cargarCategoria('<?php echo $path_components[$indice_componente]; ?>')" id="link_boton_volver<?php echo $anadidoModal; ?>" target="_self">
                <button type="button" class="hover:text-blendi-600"><?php echo $titulo_volver; ?></button>
            </a>
            <?php
        }else {
            ?>
            <!-- <?php echo $host_url.$path_components[$indice_componente]; ?> -->
            <a href="#" onclick="cargarCategoria('<?php echo $path_components[$indice_componente]; ?>')" id="link_boton_volver<?php echo $anadidoModal; ?>" target="_self">
                <button type="button" class="hover:text-blendi-600"><?php echo $titulo_volver; ?></button>
            </a>
            <?php
        }
        ?>
    </div>
    <div class="text-right">
        <?php
        if($control_boton_comprar == 1) {
            if($tipo_producto_backup != 3 && $tipo_producto_backup != 4) {
                ?>
                <button type="button" class="hover:text-blendi-600" id="boton_guardar_pie_ficha<?php echo $anadidoModal; ?>" onclick="comprarProducto('0','insertar-producto','0','0','0', '<?php echo $anadidoModal; ?>')"><?php echo $texto_boton; ?></button>
                <?php
            }
        }else {
            echo "&nbsp;";
        }
        ?>
    </div>
</div>
</div>
<hr />