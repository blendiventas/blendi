<?php
if (!empty($descarga_url)) {
    $select_sys = "listado-filtrado";
    require($_SERVER['DOCUMENT_ROOT']."/admin/listado_notificaciones_mail/gestion/datos-select-php.php");
} else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/listado_notificaciones_mail/vistas/pantalla-lista.php");
}
