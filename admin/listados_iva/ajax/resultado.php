<?php
if (!empty($descarga_url)) {
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/listados_iva/gestion/datos-select-php.php");
} else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/listados_iva/vistas/pantalla-lista.php");
}
