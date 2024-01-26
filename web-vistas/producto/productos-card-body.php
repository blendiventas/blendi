<?php
if (($mostrar_disponibilidad && $disponibilidad_producto_sys[$key]) || ($peso_producto_sys[$key] > 0.00000 && $mostrar_peso) || !empty($envio_gratis_producto_sys[$key]))
{
    ?>
    <div class="grid grid-cols-3">
        <div class="text-left">
            <?php
            if($disponibilidad_producto_sys[$key] == "1" && $mostrar_disponibilidad) {
                echo "En stock";
            }else if($disponibilidad_producto_sys[$key] == "2" && $mostrar_disponibilidad) {
                echo "Consultar disponibilidad";
            }else if($disponibilidad_producto_sys[$key] == "3" && $mostrar_disponibilidad) {
                echo "No disponible";
            }else {
                echo "&nbsp;";
            }
            ?>
        </div>
        <div class="text-right">
            <?php
            if($peso_producto_sys[$key] > 0.00000 && $mostrar_peso) {
                ?>
                <?php
                $peso_producto_sysToPrint = number_format($peso_producto_sys[$key],2,",",".");
                ?>
                <span class='titulos-productos'>Peso:&nbsp;</span><?php echo $peso_producto_sysToPrint; ?> Kgr.
                <?php
            }else {
                echo "&nbsp;";
            }
            ?>
        </div>
        <div class="text-center">
            <?php
            if(!empty($envio_gratis_producto_sys[$key])) {
                echo "ENVIO GRATIS";
            }else {
                echo "&nbsp;";
            }
            ?>
        </div>
    </div>
    <?php
}
?>
