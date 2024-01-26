<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_productos_irpf = filter_input(INPUT_POST, 'id_productos_irpf', FILTER_SANITIZE_NUMBER_INT);
$id_irpf = filter_input(INPUT_POST, 'id_irpf', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_productos_irpf = filter_input(INPUT_POST, 'id_idioma_productos_irpf', FILTER_SANITIZE_NUMBER_INT);
$irpf_productos_irpf = filter_input(INPUT_POST, 'irpf_productos_irpf', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$activo_productos_irpf = filter_input(INPUT_POST, 'activo_productos_irpf', FILTER_SANITIZE_NUMBER_INT);
if ($id_irpf) {
    $id_productos_irpf = $id_irpf;
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/irpf/gestion/datos-update-php.php");