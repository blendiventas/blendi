<?php
if(!isset($id_url)) {
    require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_envio/vistas/pantalla-lista.php");
}else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/modalidades_envio/vistas/pantalla-ficha.php");
}