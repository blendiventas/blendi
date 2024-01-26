<div class="w-full overflow-hidden shadow-lg bg-white" id="tiquet<?php echo $recepcionDePedido->numero_documento; ?>">
    <?php

    if ($recepcionDePedido->tipo_librador == 'tak') {
        $bgHeader = 'bg-blendi-200 dark:bg-blendidark-200';
    } else if ($recepcionDePedido->tipo_librador == 'del') {
        $bgHeader = 'bg-black dark:bg-white';
    } else {
        $bgHeader = 'bg-blendi-600 dark:bg-blendidark-600';
    }
    ?>
    <div class="flex <?php echo $bgHeader; ?> text-xs font-bold text-white dark:text-black">
        <div class="grow">
            <div class="pl-2 pr-2 pb-2 flex items-center">
                <div class="pt-2 pr-2 w-1/3">
                    <?php echo $recepcionDePedido->librador; ?>
                </div>
                <div class="pt-3 w-1/3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="float-left mr-2 w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>

                    <?php echo $recepcionDePedido->comensales; ?>
                </div>
                <div class="pt-3 w-1/3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="float-left mr-2 w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                    </svg>

                    <?php echo $recepcionDePedido->numero_documento; ?>
                </div>
            </div>
            <div class="pl-2 pr-2 pb-2 flex font-normal">
                <!--<div class="w-2/5">
                    <?php echo $recepcionDePedido->usuario; ?>
                </div>-->
                <div class="w-5/5">
                    Fecha: <?php echo substr($recepcionDePedido->fecha_hora, 8, 2) . "-" . substr($recepcionDePedido->fecha_hora, 5, 2) . "-" . substr($recepcionDePedido->fecha_hora, 0, 4); ?> <?php echo substr($recepcionDePedido->fecha_hora, 11, 2) . ":" . substr($recepcionDePedido->fecha_hora, 14, 2) . ":" . substr($recepcionDePedido->fecha_hora, 17, 2); ?>
                </div>
            </div>
        </div>
        <div class="flex items-center p-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 cursor-pointer" onclick="imprimirTiquet('tiquet<?php echo $recepcionDePedido->numero_documento; ?>');">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 cursor-pointer" onclick="toggleAll('capaProductosGrupo<?php echo $recepcionDePedido->id_documento_1; ?>')">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>


    <div>
        <?php
        foreach ($recepcionDePedido->productosPorGrupo as $productoPorGrupo) {
            if (count($productoPorGrupo->productos) > 0) {
                ?>
                <div class="shadow-lg mb-2">
                    <div class="flex items-center py-3 pl-5 cursor-pointer bg-gray-70 dark:bg-graydark-70 dark:text-white" onclick="toggleCapa('capaProductosGrupo<?php echo $recepcionDePedido->id_documento_1 . '_' . $productoPorGrupo->id; ?>');">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 capaProductosGrupo<?php echo $recepcionDePedido->id_documento_1; ?>Arrow" id="capaProductosGrupo<?php echo $recepcionDePedido->id_documento_1 . '_' . $productoPorGrupo->id; ?>Arrow">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                        <div class="px-3">
                            <?php
                            if ($productoPorGrupo->estado == 1) {
                                ?>
                                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 2.65249C0 1.22649 1.529 0.322493 2.779 1.00949L14.319 7.35749C15.614 8.06949 15.614 9.93049 14.319 10.6425L2.78 16.9905C1.53 17.6775 0.000999928 16.7735 0.000999928 15.3475V2.65249H0Z" fill="#156772"/>
                                </svg>
                                <?php
                            } else if ($productoPorGrupo->estado == 2) {
                                ?>
                                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 2.65249C0 1.22649 1.529 0.322493 2.779 1.00949L14.319 7.35749C15.614 8.06949 15.614 9.93049 14.319 10.6425L2.78 16.9905C1.53 17.6775 0.000999928 16.7735 0.000999928 15.3475V2.65249H0Z" fill="#E0E0E0"/>
                                </svg>
                                <?php
                            } else {
                                ?>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                </svg>
                                <?php
                            }
                            ?>
                        </div>
                        <h3 class="grow font-bold text-md mt-1">
                            <?php echo (empty($productoPorGrupo->nombre))? 'Sin grupo' : $productoPorGrupo->nombre; ?>
                        </h3>
                        <?php
                        if (!$tiquet_individual) {
                            ?>
                            <div class="px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-black" onclick="notificarPlatosHechos(<?php echo $recepcionDePedido->id_documento_1; ?>);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" />
                                </svg>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="capaProductosGrupo<?php echo $recepcionDePedido->id_documento_1; ?>" id="capaProductosGrupo<?php echo $recepcionDePedido->id_documento_1 . '_' . $productoPorGrupo->id; ?>">
                        <?php
                        foreach ($productoPorGrupo->productos as $producto) {
                            if (isset($producto->estado) && $producto->estado == -1 && !$tiquet_individual) {
                                continue;
                            }
                            ?>
                            <div class="flex items-center space-x-2 py-1 px-3 text-gray-700 border-t-2 border-gray-70 bg-white text-xs">
                                <?php
                                if ($tiquet_individual) {
                                    ?>
                                    <svg class="h-7 w-7 cursor-pointer text-gray-650" onclick="<?php echo "toggleEstado('setPrioritario', true, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");"; ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <?php
                                }
                                ?>
                                <div class="max-w-[48px] font-bold"><?php echo $producto->cantidad; ?></div>
                                <?php
                                if (isset($producto->alertar) && $producto->alertar == 3) {
                                    ?>
                                    <div class="cursor-pointer" onclick="<?php echo "toggleEstado('resetAlertar', true, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");"; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-cerise-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5" />
                                        </svg>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if (isset($producto->estado) && $producto->estado == 1) {
                                    ?>
                                    <div>
                                        <span class="p-1 rounded bg-cerise-200 text-cerise-500">
                                            Preparando
                                        </span>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if (isset($producto->alertar) && $producto->alertar == 1) {
                                    ?>
                                    <div>
                                        <span class="p-1 rounded cursor-pointer" onclick="<?php echo "toggleEstado('resetAlertar', true, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");"; ?>" style="background-color: #D5C3E7; color: #9B51E0;">
                                            Editado
                                        </span>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($tiquet_individual && $producto->estado == -1) {
                                    ?>
                                    <div>
                                        <span class="p-1 rounded text-white cursor-pointer" style="background-color: #828282;">
                                            Nuevo
                                        </span>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="grow cursor-pointer <?php if ($producto->estado == 3) { echo 'line-through'; } ?>" onclick="<?php if ($producto->estado != 3) { echo ($producto->estado == 1)? "toggleEstado('setPendiente', true, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");" : "toggleEstado('setCocinando', true, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");"; } ?>">
                                    <span class="font-bold">
                                        <?php echo $producto->descripcion_producto; ?>
                                    </span>
                                    <?php
                                    if ($producto->observaciones) {
                                        ?>
                                        <br><?php echo $producto->observaciones; ?>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php

                                if ($tiquet_individual && $producto->estado != 3) {
                                    ?>
                                    <div class="text-right">
                                        <?php
                                        if (empty($producto->id_producto_relacionado) && ($producto->tipo_producto == 3 || $producto->tipo_producto == 4)) {
                                            ?>
                                            <div class="py-2 text-blendi-600" onmouseover="this.style.cursor='pointer'" onclick="document.getElementById('botonOpenModalTiquetCocina').click(); editarProducto(<?php echo $producto->id_documento_2; ?>, '<?php echo $producto->slug; ?>',0);">
                                            <?php
                                        } else {
                                            ?>
                                            <div class="py-2 text-blendi-600" onmouseover="this.style.cursor='pointer'" onclick="document.getElementById('botonOpenModalTiquetCocina').click(); document.getElementById('botonOpenModalProducto').click(); detallesProductoModal('<?php echo  preg_replace("([^A-Za-z0-9 ])", "", $producto->descripcion_producto); ?>', <?php echo $producto->id_producto; ?>, '<?php echo $producto->id_producto_relacionado; ?>', '<?php echo $producto->tipo_producto; ?>', <?php echo $producto->id_documento_2; ?>, false, '', '');">
                                            <?php
                                        }
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                        </div>
                                    </div>
                                    <?php
                                    if ($recepcionDePedido->numero_productos > 1) {
                                        ?>
                                        <div class="text-right ml-4">
                                            <?php
                                            if (empty($producto->id_producto_relacionado)) {
                                                ?>
                                                <div class="py-2 text-blendi-600" onmouseover="this.style.cursor='pointer'" onclick="document.getElementById('botonOpenModalTiquetCocina').click(); eliminarProducto(<?php echo $producto->id_documento_2; ?>)">
                                                <?php
                                            } else {
                                                ?>
                                                <div class="py-2 text-blendi-600" onmouseover="this.style.cursor='pointer'" onclick="document.getElementById('botonOpenModalTiquetCocina').click(); detallesProductoModal('<?php echo  preg_replace("([^A-Za-z0-9 ])", "", $producto->descripcion_producto); ?>', <?php echo $producto->id_producto; ?>, '<?php echo $producto->id_producto_relacionado; ?>', '<?php echo $producto->tipo_producto; ?>', <?php echo $producto->id_documento_2; ?>, true, '', '');">
                                            <?php
                                            }
                                                ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else if (isset($producto->estado) && $producto->estado == 0) {
                                    $visto = true;
                                    if (isset($producto->hora_visto) && substr($producto->hora_visto, 0, 4) == '0000') {
                                        $visto = false;
                                    }
                                    ?>
                                    <div class="cursor-pointer" onclick="<?php if ($producto->estado != 3) { echo ($visto)? "toggleEstado('setVisto', false, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");" : "toggleEstado('setVisto', true, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");"; } ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 <?php echo ($visto)? "text-gray-250" : "text-black"; ?>">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <?php
                                }else if (isset($producto->estado) && ($producto->estado == 1 || $producto->estado == 2)) {
                                    $hecho = true;
                                    if ($producto->estado == 1) {
                                        $hecho = false;
                                    }
                                    ?>
                                    <div class="cursor-pointer" onclick="<?php if ($producto->estado != 3) { echo ($hecho)? "toggleEstado('setCocinando', true, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");" : "toggleEstado('setHecho', true, " . $recepcionDePedido->id_documento_1 . ", " . $producto->id_documento_2 . ", " . $producto->id_producto_relacionado . ");"; } ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 <?php echo ($hecho)? "text-gray-250" : "text-black"; ?>">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" />
                                        </svg>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
