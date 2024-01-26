<?php
if (!empty($descarga_url)) {
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/listados_mails/gestion/datos-select-php.php");
} else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/listados_mails/vistas/pantalla-lista.php");
}
