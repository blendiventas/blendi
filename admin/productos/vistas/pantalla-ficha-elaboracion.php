<input type="hidden" name="apartado" id="apartado" value="elaboracion" />
<?php
$id_producto_productos = $id_url;
$id_productos_detalles_enlazado_productos = 0;
$id_productos_detalles_multiples_productos = 0;
$id_packs_productos = 0;
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/componentes/form-datos-elaboracion.php");
?>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
