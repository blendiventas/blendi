<?php
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-zonas.php");
// si la zona viene de un documento creado
if(isset($envio_id_zona)) {
    // si la zona no exite en la tabla, la añadimos a la matriz
    $existe_zona = false;
    foreach ($matriz_id_libradores_zonas as $key_id_libradores_zona => $valor_id_libradores_zona) {
        if ($valor_id_libradores_zona = $envio_id_zona[0]) {
            $existe_zona = true;
            break;
        }
    }
    if ($existe_zona == false) {
        $matriz_id_libradores_zonas[] = 0;
        $matriz_zona_libradores_zonas[] = $envio_zona[0];
    }
}
$clase_botones_datos = "";
?>
<form id="formulario_cesta" method="post" class="relative h-full">
    <input type="hidden" id="procedencia" name="procedencia" value="<?php echo $procedencia; ?>">
    <input type="hidden" name="tipo_documento" id="tipo_documento" value="<?php echo $tipo_documento; ?>" />
    <?php
    if($mostrar_cesta == "superior") {
        require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-facturacion.php");
        require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-lineas.php");
        require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-totales.php");
        require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-otros-datos.php");
        require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-botones.php");
    }else {
        if($tipo_librador == "tak") {
            ?>
            <div class="sm:absolute top-0 w-full" id="capa_cabecera_cesta_1">
                <?php
                require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-tak.php");
                ?>
            </div>
            <?php
        }else if($tipo_librador == "del") {
            ?>
            <div class="sm:absolute top-0 w-full" id="capa_cabecera_cesta_1">
                <?php
                require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-del.php");
                ?>
            </div>
            <?php
        }else {
            if($id_usuario != 1) {
                $clase_botones_datos = " hidden";
            }
            ?>
            <div class="sm:absolute top-0 w-full" id="capa_cabecera_cesta_1">
                <?php
                require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-facturacion.php");
                ?>
            </div>
            <?php
        }
        ?>
        <div class="pt-2 sm:pt-12 px-2">
            <?php
            require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-lineas.php");
            ?>
        </div>
        <div class="sm:absolute bottom-0 w-full bg-gray-25 dark:bg-graydark-650 px-2 pb-2">
            <?php
            require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-totales.php");
            require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-botones.php");
            ?>
        </div>
        <?php
    }
    ?>
</form>