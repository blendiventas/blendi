<?php
if (!isset($tipo_libradores_url) || ($tipo_libradores_url !== 'cli' && $tipo_libradores_url !== 'pro' && $tipo_libradores_url !== 'cre')) {
    throw new Exception('Un librador debe ser cliente, proveedor o creditor.');
}
if(!isset($id_url)) {
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/libradores/vistas/pantalla-lista.php");
}else {
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/libradores/vistas/pantalla-ficha.php");
}