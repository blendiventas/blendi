<?php
if(!isset($id_url)) {
    require($_SERVER['DOCUMENT_ROOT']."/admin/zonas/vistas/pantalla-lista.php");
}else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/zonas/vistas/pantalla-ficha.php");
}