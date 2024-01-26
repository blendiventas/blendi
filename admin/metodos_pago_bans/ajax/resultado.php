<?php
if(!isset($id_url)) {
    require($_SERVER['DOCUMENT_ROOT']."/admin/metodos_pago_bans/vistas/pantalla-lista.php");
}else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/metodos_pago_bans/vistas/pantalla-ficha.php");
}