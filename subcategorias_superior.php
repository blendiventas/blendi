<?php
foreach ($categorias['id'] as $key => $valor) {
    if($categorias['de'][$key] == $id_categoria_padre_mostrar) {
        ?>
        <a href="#" title="<?php echo $categorias['alt'][$key]; ?>" onclick="cargarCategoria('<?php echo $categorias['descripcion_url'][$key]; ?>')" class="inline-block text-sm px-4 mx-6 <?php echo (!empty($id_categoria_mostrar) && $id_categoria_mostrar == $valor)? 'border-b-2 border-b-blendi-700' : 'hover:border-b-2 hover:border-b-blendi-700'; ?> h-8 mt-2">
            <?php echo $categorias['descripcion'][$key]; ?>
        </a>
        <?php
    }
}
?>