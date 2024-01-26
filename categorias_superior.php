<?php

foreach ($categorias['id'] as $key => $valor) {
    if($categorias['de'][$key] == 0) {
        $class_enlace = "";
        if($valor == $id_categoria_mostrar) {
            $class_enlace = "font-bold border-b-2 border-b-blendi-700";
        }
        ?>
        <!-- <?php echo $host_url.$categorias['descripcion_url'][$key]; ?> -->
        <a href="#" title="<?php echo $categorias['alt'][$key]; ?>" onclick="cargarCategoria('<?php echo $categorias['descripcion_url'][$key]; ?>')" class="<?php echo $class_enlace; ?> uppercase inline-block text-sm px-4 h-8 flex items-center categoria_menu">
            <?php echo strtoupper($categorias['descripcion'][$key]); ?>
        </a>
        <?php
    }
}