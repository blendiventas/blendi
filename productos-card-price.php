<div class="flex">
    <?php
    if($mostrar_precios_tpv) {
        if(empty($profesionales[$key]) OR (!empty($profesionales[$key] AND isset($id_cliente)))) {
            ?>
            <div class="card-footer font-normal grow mt-1">
                <div class="box color-black vertical-center">
                    <?php
                    if($tipo_librador == "cli" || $tipo_librador == "mes" || $tipo_librador == "tak" || $tipo_librador == "del") {
                        if(!empty($descripcion_ofertas[$key])) {
                            ?>
                            <div class="grid-2">
                                <div class="row tachado">
                                    <?php
                                    $pvpToPrint = number_format($pvp[$key], 2, ",", ".");
                                    ?>
                                    <?php echo $etiqueta_pvp; ?><br /><span class="precio"><?php echo $pvpToPrint; ?>&nbsp;€</span>
                                </div>
                                <div class="row">
                                    <?php echo $descripcion_oferta[$key]; ?><br />
                                    Desde&nbsp;<?php echo $oferta_desde[$key]; ?><br />
                                    Hasta&nbsp;<?php echo $oferta_hasta[$key]; ?><br />
                                    <?php
                                    $pvp_ofertaToPrint = number_format($pvp_oferta[$key], 2, ",", ".");
                                    ?>
                                    <?php echo $etiqueta_pvp; ?>&nbsp;<span class="precio"><?php echo $pvp_ofertaToPrint; ?>&nbsp;€</span>
                                </div>
                            </div>
                            <?php
                        }else {
                            $pvpToPrint = number_format($pvp[$key], 2, ",", ".");
                            ?>
                            <?php echo $etiqueta_pvp; ?>&nbsp;<span class="precio"><?php echo $pvpToPrint; ?>&nbsp;€</span>
                            <?php
                        }
                    } else {
                        $costeToPrint = number_format($coste[$key], 2, ",", ".");
                        ?>
                        Coste&nbsp;<span class="precio"><?php echo $costeToPrint; ?>&nbsp;€</span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }else {
            ?>
            <div class="card-footer mt-1">
                <div class="box button-menu mt-1 mb-1 vertical-center">
                    Producto exclusivo para profesionales.<br />
                    Identifíquese aquí.
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="grow mt-1">
            &nbsp;
        </div>
        <?php
    }
    ?>
</div>
