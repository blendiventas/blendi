<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_productos_pvp = filter_input(INPUT_POST, 'idProductosPVP', FILTER_SANITIZE_NUMBER_INT);
$id_producto = filter_input(INPUT_POST, 'idProductoProductosPVP', FILTER_SANITIZE_NUMBER_INT);
$id_detalles_enlazado = filter_input(INPUT_POST, 'idProductosDetallesEnlazadoProductosPVP', FILTER_SANITIZE_NUMBER_INT);
$id_detalles_multiples = filter_input(INPUT_POST, 'idProductosDetallesMultiplesProductosPVP', FILTER_SANITIZE_NUMBER_INT);
$id_packs = filter_input(INPUT_POST, 'idPacksProductosPVP', FILTER_SANITIZE_NUMBER_INT);
$id_tarifas = filter_input(INPUT_POST, 'idTarifas', FILTER_SANITIZE_NUMBER_INT);

$margen = $_POST['margen'];
$pvp = $_POST['pvp'];

$id_ofertas = $_POST['id_ofertas'];
$oferta_desde = $_POST['oferta_desde'];
$oferta_hasta = $_POST['oferta_hasta'];
$pvp_oferta = $_POST['pvp_oferta'];

$logs_sys = new stdClass();

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/productos/pvp/gestion/datos-update-php.php");