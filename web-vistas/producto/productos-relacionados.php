<?php
/*
if ($tipo_producto_productos == 0) Normal
if ($tipo_producto_productos == 1) Elaborado
if ($tipo_producto_productos == 2) Compuesto
if ($tipo_producto_productos == 3) Combo manual
if ($tipo_producto_productos == 4) Combo automático
*/
if (!isset($indice_adicional)) {
    $indice_adicional = '';
}
if (!isset($key_producto_relacionado)) {
    $key_producto_relacionado = 0;
}
if($pvp_iva_incluido == 0 && $tipo_librador != 'pro' && $tipo_librador != 'cre') {
    if ($sumar_con_producto_relacionado[$key_producto_relacionado]) {
        $sumar_con_producto_relacionado[$key_producto_relacionado] = $sumar_con_producto_relacionado[$key_producto_relacionado] / (1 + ($iva_producto_sys / 100));
    }
    if ($sumar_sin_producto_relacionado[$key_producto_relacionado]) {
        $sumar_sin_producto_relacionado[$key_producto_relacionado] = $sumar_sin_producto_relacionado[$key_producto_relacionado] / (1 + ($iva_producto_sys / 100));
    }
    if ($sumar_mitad_producto_relacionado[$key_producto_relacionado]) {
        $sumar_mitad_producto_relacionado[$key_producto_relacionado] = $sumar_mitad_producto_relacionado[$key_producto_relacionado] / (1 + ($iva_producto_sys / 100));
    }
    if ($sumar_doble_producto_relacionado[$key_producto_relacionado]) {
        $sumar_doble_producto_relacionado[$key_producto_relacionado] = $sumar_doble_producto_relacionado[$key_producto_relacionado] / (1 + ($iva_producto_sys / 100));
    }
}
if($mostrar_producto_relacionado[$key_producto_relacionado] == 1 || empty($id_producto_relacionado[$key_producto_relacionado])) {
    if ($titulo_descripcion_producto_relacionado[$key_producto_relacionado] && $titulo_descripcion_producto_relacionado_anterior != $titulo_descripcion_producto_relacionado[$key_producto_relacionado]) {
        ?>
        </div>
        <div class="text-left font-bold text-sm mt-3 ml-4">
            <?php echo $titulo_descripcion_producto_relacionado[$key_producto_relacionado]; ?>
        </div>
        <div class="flex flex-wrap text-xs">
        <?php
        $titulo_descripcion_producto_relacionado_anterior = $titulo_descripcion_producto_relacionado[$key_producto_relacionado];
    }
    ?>
    <div id="capa_contenido_producto_cesta_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" class="opcionRelacionada <?php if($modelo_producto_relacionado[$key_producto_relacionado] == '5') { echo 'w-full'; } ?> opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>">
        <div id="capa-opciones-linea-radios_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" class="flex flex-wrap justify-center items-center">
            <input type="hidden" name="descripcion_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="descripcion_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $descripcion_producto_relacionado[$key_producto_relacionado]; ?>" />
            <?php echo '&nbsp;'; ?>
            <input type="hidden" name="cantidad_incremento_<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="cantidad_incremento_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $cantidad_con_producto_relacionado[$key_producto_relacionado]; ?>" />
            <input type="hidden" name="sumar_incremento_<?php echo $key_producto_relacionado . $indice_adicional; ?>" id="sumar_incremento_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo $sumar_con_producto_relacionado[$key_producto_relacionado]; ?>" />
            <?php
            if($modelo_producto_relacionado[$key_producto_relacionado] == 0) {
                ?>
                <div onclick="toogleElementoProductoCompuesto('toggle_con_sin<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>', 'capa_toggle_con_sin_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>')" id="capa_toggle_con_sin_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" class="rounded border-2 border-gray-400 p-2 cursor-pointer flex items-center ml-3 mt-3 h-9">
                    <div class="font-bold text-left mr-2">
                        <?php
                        if ($titulo_descripcion_producto_relacionado_anterior != $descripcion_producto_relacionado[$key_producto_relacionado]) {
                            echo $descripcion_producto_relacionado[$key_producto_relacionado];
                        }
                        ?>
                    </div>
                    <div class="font-bold text-left">
                        <?php
                        if($sumar_con_producto_relacionado[$key_producto_relacionado] != 0.00) {
                            echo "+&nbsp;".number_format($sumar_con_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.')."&nbsp;€";
                        }
                        if($sumar_sin_producto_relacionado[$key_producto_relacionado] != 0.00) {
                            echo "(Sin +&nbsp;".number_format($sumar_sin_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.')."&nbsp;€)";
                        }
                        ?>
                    </div>
                    <div class="hidden ellipseCheck">
                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-8 h-5">
                            <ellipse cx="11.936" cy="8" rx="6.70213" ry="6" fill="#156772"/>
                            <path d="M9.70197 8.5L11.3775 10L14.1701 6.5M18.6381 8C18.6381 8.78793 18.4648 9.56815 18.128 10.2961C17.7912 11.0241 17.2975 11.6855 16.6751 12.2426C16.0528 12.7998 15.3139 13.2417 14.5008 13.5433C13.6877 13.8448 12.8162 14 11.936 14C11.0559 14 10.1844 13.8448 9.37122 13.5433C8.55808 13.2417 7.81924 12.7998 7.19689 12.2426C6.57454 11.6855 6.08087 11.0241 5.74406 10.2961C5.40724 9.56815 5.23389 8.78793 5.23389 8C5.23389 6.4087 5.94 4.88258 7.19689 3.75736C8.45379 2.63214 10.1585 2 11.936 2C13.7135 2 15.4182 2.63214 16.6751 3.75736C17.932 4.88258 18.6381 6.4087 18.6381 8Z" stroke="#F2F2F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <input type="checkbox" name="<?php echo $key_producto_relacionado; ?>_opciones_<?php echo $contador_elementos; ?>" id="toggle_con_sin<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="con" onchange="modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" class="hidden opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input <?php echo $key_producto_relacionado . 'opcionRelacionadaTipo' . $modelo_producto_relacionado[$key_producto_relacionado] . 'Input'; ?>" data-price="<?php echo $sumar_con_producto_relacionado[$key_producto_relacionado]; ?>" />
                    <?php
                    if ($por_defecto_producto_relacionado[$key_producto_relacionado] != 2) {
                        ?>
                        <script type="text/javascript">
                            toogleElementoProductoCompuesto('toggle_con_sin<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>', 'capa_toggle_con_sin_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>');
                        </script>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }else if($modelo_producto_relacionado[$key_producto_relacionado] == 1) {
                $checked_con = " checked";
                $checked_mitad = "";
                $checked_sin = "";
                $checked_doble = "";
                if($por_defecto_producto_relacionado[$key_producto_relacionado] == 1) {
                    $checked_con = "";
                    $checked_mitad = " checked";
                }else if($por_defecto_producto_relacionado[$key_producto_relacionado] == 2) {
                    $checked_con = "";
                    $checked_sin = " checked";
                }else if($por_defecto_producto_relacionado[$key_producto_relacionado] == 3) {
                    $checked_con = "";
                    $checked_doble = " checked";
                }
                ?>
                <div class="ml-3 font-bold text-left mr-2">
                    <?php
                    if ($titulo_descripcion_producto_relacionado_anterior != $descripcion_producto_relacionado[$key_producto_relacionado]) {
                        echo $descripcion_producto_relacionado[$key_producto_relacionado];
                    }
                    ?>
                </div>
                <div class="text-left mr-2">
                    <input type="radio" name="<?php echo $key_producto_relacionado; ?>_opciones_<?php echo $contador_elementos; ?>" id="opcion_con_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="con"<?php echo $checked_con; ?> onchange="modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" class="opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input <?php echo $key_producto_relacionado; ?>opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input" data-price="<?php echo $sumar_con_producto_relacionado[$key_producto_relacionado]; ?>" />
                    <button class="w-70" onclick="checkCurrentRadio(this); modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true); return false;">
                        Con
                        <?php
                        if($sumar_con_producto_relacionado[$key_producto_relacionado] != 0.00) {
                            echo "+&nbsp;".number_format($sumar_con_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.')."&nbsp;€";
                        }
                        ?>
                    </button>
                </div>
                <div class="text-left mr-2">
                    <input type="radio" name="<?php echo $key_producto_relacionado; ?>_opciones_<?php echo $contador_elementos; ?>" id="opcion_mitad_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="mitad"<?php echo $checked_mitad; ?> onchange="modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" class="opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input <?php echo $key_producto_relacionado; ?>opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input" data-price="<?php echo $sumar_mitad_producto_relacionado[$key_producto_relacionado]; ?>" />
                    <button class="w-70" onclick="checkCurrentRadio(this); modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true); return false;">
                        Mitad
                        <?php
                        if($sumar_mitad_producto_relacionado[$key_producto_relacionado] != 0.00) {
                            echo "+&nbsp;".number_format($sumar_mitad_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.')."&nbsp;€";
                        }
                        ?>
                    </button>
                </div>
                <div class="text-left mr-2">
                    <input type="radio" name="<?php echo $key_producto_relacionado; ?>_opciones_<?php echo $contador_elementos; ?>" id="opcion_sin_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="sin"<?php echo $checked_sin; ?> onchange="modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" class="opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input <?php echo $key_producto_relacionado; ?>opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input" data-price="<?php echo $sumar_sin_producto_relacionado[$key_producto_relacionado]; ?>" />
                    <button class="w-70" onclick="checkCurrentRadio(this); modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true); return false;">
                        Sin
                        <?php
                        if($sumar_sin_producto_relacionado[$key_producto_relacionado] != 0.00) {
                            echo "+&nbsp;".number_format($sumar_sin_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.')."&nbsp;€";
                        }
                        ?>
                    </button>
                </div>
                <div class="text-left mr-2">
                    <input type="radio" name="<?php echo $key_producto_relacionado; ?>_opciones_<?php echo $contador_elementos; ?>" id="opcion_doble_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="doble"<?php echo $checked_doble; ?> onchange="modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" class="opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input <?php echo $key_producto_relacionado; ?>opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input" data-price="<?php echo $sumar_doble_producto_relacionado[$key_producto_relacionado]; ?>" />
                    <button class="w-70" onclick="checkCurrentRadio(this); modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true); return false;">
                        Doble
                        <?php
                        if($sumar_doble_producto_relacionado[$key_producto_relacionado] != 0.00) {
                            echo "+&nbsp;".number_format($sumar_doble_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.')."&nbsp;€";
                        }
                        ?>
                    </button>
                </div>
                <?php
            }else if($modelo_producto_relacionado[$key_producto_relacionado] == 2) {
                ?>
                <div class="font-bold text-left mr-2">
                    <?php
                    if ($titulo_descripcion_producto_relacionado_anterior != $descripcion_producto_relacionado[$key_producto_relacionado]) {
                        echo $descripcion_producto_relacionado[$key_producto_relacionado];
                    }
                    ?>
                </div>
                <div class="font-bold text-center mr-2">
                    <?php
                    if ($sumar_con_producto_relacionado[$key_producto_relacionado] != 0.00) {
                        echo "+&nbsp;" . number_format($sumar_con_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.') . "&nbsp;€";
                    }else {
                        echo "&nbsp;";
                    }
                    ?>
                </div>
                <div class="text-center mr-2">
                    <div class="mt-1 mb-1 mr-1 w-8 h-8 rounded-full text-white bg-blendi-600 dark:bg-blendidark-600" id="sumar_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" onmouseover="this.style.cursor='pointer'" onclick="sumarIncrementoProductoCesta('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $key_producto_relacionado . $indice_adicional; ?>','<?php echo $anadidoModal; ?>');">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 pt-1 m-auto text-white dark:text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </div>
                    <br />
                    <label class="titulos-productos" for="cantidad_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>">Cant.</label>
                    <input type="number" class="input-cantidad-opciones opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input <?php if(empty($key_producto_relacionado)){ echo '0'; }else{ echo $key_producto_relacionado; } ?>opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input" name="<?php echo $key_producto_relacionado; ?>_cantidad_<?php echo $contador_elementos; ?>" id="cantidad_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" placeholder="Cantidad" value="<?php echo $cantidad_con_producto_relacionado[$key_producto_relacionado]; ?>" onkeyup="modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);" data-price="<?php echo $sumar_con_producto_relacionado[$key_producto_relacionado]; ?>" />
                    <br />
                    <div class="mt-1 mb-1 ml-1 w-8 h-8 rounded-full text-white bg-blendi-600 dark:bg-blendidark-600" id="restar_producto_relacionado_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" onmouseover="this.style.cursor='pointer'" onclick="restarIncrementoProductoCesta('cantidad_','<?php echo $contador_elementos; ?>','<?php echo $key_producto_relacionado . $indice_adicional; ?>','<?php echo $anadidoModal; ?>');">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1 pt-1 m-auto text-white dark:text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                        </svg>
                    </div>
                </div>
                <?php
            }else if($modelo_producto_relacionado[$key_producto_relacionado] == 3) {
                ?>
                <div onclick="activarElementoUnicoProductoCompuesto('opcion_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>', 'capa_opcion_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>', 'capa_unicos_producto_compuesto_opcion_<?php echo $contador_elementos; ?>')" id="capa_opcion_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" class="rounded border-2 border-gray-400 p-2 cursor-pointer flex items-center ml-3 mt-3 h-9 capa_unicos_producto_compuesto_opcion_<?php echo $contador_elementos; ?>">
                    <div class="font-bold text-left mr-2">
                        <?php
                        if ($titulo_descripcion_producto_relacionado_anterior != $descripcion_producto_relacionado[$key_producto_relacionado]) {
                            echo $descripcion_producto_relacionado[$key_producto_relacionado];
                        }
                        ?>
                    </div>
                    <div class="font-bold text-left">
                        <?php
                        if(isset($sumar_con_producto_relacionado)) {
                            if ($sumar_con_producto_relacionado[$key_producto_relacionado] != 0.00) {
                                echo "+&nbsp;" . number_format($sumar_con_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.') . "&nbsp;€";
                            }else {
                                echo "&nbsp;";
                            }
                        }
                        ?>
                    </div>
                    <div class="hidden ellipseCheck">
                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-8 h-5">
                            <ellipse cx="11.936" cy="8" rx="6.70213" ry="6" fill="#156772"/>
                            <path d="M9.70197 8.5L11.3775 10L14.1701 6.5M18.6381 8C18.6381 8.78793 18.4648 9.56815 18.128 10.2961C17.7912 11.0241 17.2975 11.6855 16.6751 12.2426C16.0528 12.7998 15.3139 13.2417 14.5008 13.5433C13.6877 13.8448 12.8162 14 11.936 14C11.0559 14 10.1844 13.8448 9.37122 13.5433C8.55808 13.2417 7.81924 12.7998 7.19689 12.2426C6.57454 11.6855 6.08087 11.0241 5.74406 10.2961C5.40724 9.56815 5.23389 8.78793 5.23389 8C5.23389 6.4087 5.94 4.88258 7.19689 3.75736C8.45379 2.63214 10.1585 2 11.936 2C13.7135 2 15.4182 2.63214 16.6751 3.75736C17.932 4.88258 18.6381 6.4087 18.6381 8Z" stroke="#F2F2F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <input type="radio" name="0_opcion_<?php echo $contador_elementos; ?>" id="opcion_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" value="<?php echo (!empty($id_producto_relacionado[$key_producto_relacionado]))? $id_producto_relacionado[$key_producto_relacionado] : $id_titulo_relacionado_producto_relacionado[$key_producto_relacionado]; ?>" onclick="modificarCantidades<?php echo (isset($origenCombo) && $origenCombo)? 'Combo' : ''; ?>('<?php echo $contador_elementos; ?>', '<?php echo $anadidoModal; ?>', false);" class="opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input hidden 0opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input" data-price="<?php echo $sumar_con_producto_relacionado[$key_producto_relacionado]; ?>" />
                    <?php
                    if ($checked_unico_producto_relacionado[$key_producto_relacionado]) {
                        ?>
                        <script type="text/javascript">
                            activarElementoUnicoProductoCompuesto('opcion_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>', 'capa_opcion_<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>', "capa_unicos_producto_compuesto_opcion_<?php echo $contador_elementos; ?>");
                        </script>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }elseif($modelo_producto_relacionado[$key_producto_relacionado] == 5) {
                $checked = " checked";
                if($por_defecto_producto_relacionado[$key_producto_relacionado] == 2) {
                    $checked = "";
                }
                ?>
                <div class="mx-5 w-full">
                    <div class="font-bold text-left">
                        <?php
                        if ($titulo_descripcion_producto_relacionado_anterior != $descripcion_producto_relacionado[$key_producto_relacionado]) {
                            echo $descripcion_producto_relacionado[$key_producto_relacionado];
                        }
                        ?>
                    </div>
                    <textarea name="<?php echo $key_producto_relacionado; ?>_opciones_<?php echo $contador_elementos; ?>" id="texto<?php echo $key_producto_relacionado . $indice_adicional; ?><?php echo $anadidoModal; ?>" class="w-full opcionRelacionadaTipo<?php echo $modelo_producto_relacionado[$key_producto_relacionado]; ?>Input <?php echo $key_producto_relacionado . 'opcionRelacionadaTipo' . $modelo_producto_relacionado[$key_producto_relacionado] . 'Input'; ?>" data-price="<?php echo $sumar_con_producto_relacionado[$key_producto_relacionado]; ?>" onchange="modificarCantidades('<?php echo $contador_elementos; ?>','<?php echo $anadidoModal; ?>', true);"><?php echo $observaciones_producto_relacionado[$key_producto_relacionado]; ?></textarea>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                        <?php
                        if($sumar_con_producto_relacionado[$key_producto_relacionado] != 0.00) {
                            echo "+&nbsp;".number_format($sumar_con_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.')."&nbsp;€";
                        }
                        if($sumar_sin_producto_relacionado[$key_producto_relacionado] != 0.00) {
                            echo "(Sin +&nbsp;".number_format($sumar_sin_producto_relacionado[$key_producto_relacionado], $decimales_importes, ',', '.')."&nbsp;€)";
                        }
                        ?>
                    </span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}
$modelo_relacionado_anterior = $modelo_producto_relacionado[$key_producto_relacionado];
?>
