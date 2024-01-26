<div>
    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 xl:grid-cols-5 gap-2 m-2">
        <?php
        foreach ($recepcionDePedidos as $recepcionDePedido) {
            foreach ($recepcionDePedido->productosPorGrupo as $productoPorGrupo) {
                if (!(count($productoPorGrupo->productos) > 0)) {
                    continue;
                }
                if ($productoPorGrupo->estado != 2) {
                    continue;
                }
                foreach ($productoPorGrupo->productos as $producto) {
                    if (empty($producto->id_det)) {
                        continue;
                    }
                    ?>
                    <script type="text/javascript">
                        (function() {
                            window.eliminarProducto<?php echo $producto->id_det; ?> = setTimeout(function() {
                                eliminarRecepcionPedido(<?php echo $producto->id_det; ?>);
                            }, 7000);
                        })();
                    </script>
                    <?php
                }
            }
            require 'tiquet-cocina.php';
        }
        ?>
    </div>
</div>