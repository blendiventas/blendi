<?php
if(!isset($id_url)) {
    require($_SERVER['DOCUMENT_ROOT']."/admin/bancos_cajas/vistas/pantalla-lista.php");
}else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/bancos_cajas/vistas/pantalla-ficha.php");
}