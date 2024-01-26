<?php
if(!isset($id_url)) {
    require($_SERVER['DOCUMENT_ROOT']."/admin/iva/vistas/pantalla-lista.php");
}else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/iva/vistas/pantalla-ficha.php");
}