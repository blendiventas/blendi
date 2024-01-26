<?php
$tipo = $tipo_libradores_url;
?>
<div class="grid grid-cols-12 items-center h-10 bg-gray-50 sm:mx-5 mt-3 dark:text-white">
    <div class="text-center hidden sm:block sm:col-span-2 px-3">
        Habilitado
    </div>
    <div class="px-3 col-span-10 sm:col-span-6 md:col-span-4">
        <?php
        if ($tipo_libradores_url === 'cli') {
            echo 'Cliente';
        } else if ($tipo_libradores_url === 'pro') {
            echo 'Proveedor';
        } else if ($tipo_libradores_url === 'cre') {
            echo 'Creditor';
        }
        ?>
    </div>
    <div class="hidden col-span-2 sm:block px-3">
        Teléfono
    </div>
    <div class="hidden col-span-2 md:block px-3">
        Contacto
    </div>
    <div class="text-center px-3 col-span-2">
        Ficha
    </div>
</div>
<?php
if ($tipo_libradores_url === 'cli') {
    $definicion_tipo_librador = "clientes";
} else if ($tipo_libradores_url === 'pro') {
    $definicion_tipo_librador = "proveedores";
} else if ($tipo_libradores_url === 'cre') {
    $definicion_tipo_librador = "creditores";
}
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT'] . "/admin/libradores/gestion/datos-select-php.php");
if(isset($matriz_id_libradores)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($matriz_id_libradores as $key => $valor) {
            ?>
            <div class="grid grid-cols-12 items-center h-14 bg-white border-2 border-gray-50" id="linea_<?php echo $valor; ?>">
                <div class="hidden sm:block sm:col-span-2 px-3" id="capa_img_activo_<?php echo $valor; ?>">
                    <?php
                    if ($matriz_activo_libradores[$key] == 1) {
                        $imagen_src = $host_base_sys."images/valid-20.png";
                        $alt_src = "Activo";
                    } else {
                        $imagen_src = $host_base_sys."images/invalid-20.png";
                        $alt_src = "Inactivo";
                    }
                    ?>
                    <input type="checkbox" class="block w-7 h-7 mx-auto text-blendi-600" id="habilitar_<?php echo $valor; ?>"
                            <?php echo ($matriz_activo_libradores[$key] == 1)? ' checked ' : ''; ?>
                            <?php if ($matriz_prioritario_libradores[$key] == 0) { ?> onmouseover="this.style.cursor='pointer'" onclick="toogleHabilitar('<?php echo $valor; ?>', 'libradores');" <?php } else { ?> disabled <?php } ?>>
                </div>
                <div class="px-3 col-span-10 sm:col-span-6 md:col-span-4">
                    <?php
                    if (!empty($matriz_razon_comercial_libradores[$key])) {
                        echo $matriz_razon_comercial_libradores[$key];
                    } else {
                        echo $matriz_nombre_libradores[$key];
                        if (!empty($matriz_apellido_1_libradores[$key])) {
                            echo ' ' . $matriz_apellido_1_libradores[$key];
                        }
                        if (!empty($matriz_apellido_2_libradores[$key])) {
                            echo ' ' . $matriz_apellido_2_libradores[$key];
                        }
                    }
                    ?>
                </div>
                <div class="hidden col-span-2 sm:block px-3">
                    <?php
                    $primerTelefonoYaExiste = false;
                    if (!empty($matriz_mobil_libradores[$key])) {
                        echo $matriz_mobil_libradores[$key];
                        $primerTelefonoYaExiste = true;
                    }
                    if (!empty($matriz_telefono_1_libradores[$key])) {
                        echo (($primerTelefonoYaExiste)? ' / ' : '') . $matriz_telefono_1_libradores[$key];
                        $primerTelefonoYaExiste = true;
                    }
                    if (!empty($matriz_telefono_2_libradores[$key])) {
                        echo (($primerTelefonoYaExiste)? ' / ' : '') . $matriz_telefono_2_libradores[$key];
                        $primerTelefonoYaExiste = true;
                    }
                    ?>
                </div>
                <div class="hidden col-span-2 md:block px-3">
                    <?php echo $matriz_persona_contacto_libradores[$key]; ?>
                </div>
                <div class="col-span-2 px-3">
                    <!-- <?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-libradores/id_libradores=<?php echo $valor; ?>/tipo=<?php echo $tipo_libradores_url; ?> -->
                    <a href="#" class="botones-apartados" title="<?php echo $definicion_tipo_librador; ?>" onclick="abrirFicha(<?php echo $valor; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php
        }
        unset($matriz_id_libradores);
        unset($matriz_codigo_librador_libradores);
        unset($matriz_razon_social_libradores);
        unset($matriz_razon_comercial_libradores);
        unset($matriz_nombre_libradores);
        unset($matriz_apellido_1_libradores);
        unset($matriz_apellido_2_libradores);
        unset($matriz_telefono_1_libradores);
        unset($matriz_telefono_2_libradores);
        unset($matriz_mobil_libradores);
        unset($matriz_persona_contacto_libradores);
        unset($matriz_activo_libradores);
        ?>
    </div>
    <?php
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/componentes/footer-listados.php");
}else {
    ?>
    <div class="flex items-center justify-center h-10 bg-white mx-5">
        <div class="text-center grow px-3">
            No existen&nbsp;<?php echo $definicion_tipo_librador; ?>&nbsp;definidos.
        </div>
    </div>
    <?php
}
?>