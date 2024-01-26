<?php
if (!empty($descarga_url)) {
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/listados_es/gestion/datos-select-php.php");
} else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/listados_es/vistas/pantalla-lista.php");
}
