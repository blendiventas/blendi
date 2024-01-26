<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$apartado_url = filter_input(INPUT_POST, 'apartado', FILTER_SANITIZE_STRING);
$id_productos_images = filter_input(INPUT_POST, 'id_productos_images', FILTER_SANITIZE_NUMBER_INT);
$id_productos = filter_input(INPUT_POST, 'id_productos', FILTER_SANITIZE_NUMBER_INT);
$nombre_imagen = filter_input(INPUT_POST, 'nombre_imagen', FILTER_SANITIZE_STRING);
$alt_productos_images = filter_input(INPUT_POST, 'alt_productos_images', FILTER_SANITIZE_STRING);
$tittle_productos_images = filter_input(INPUT_POST, 'tittle_productos_images', FILTER_SANITIZE_STRING);
$activo_productos_images = filter_input(INPUT_POST, 'activo_productos_images', FILTER_SANITIZE_NUMBER_INT);
$orden_productos_images = filter_input(INPUT_POST, 'orden_productos_images', FILTER_SANITIZE_STRING);

$id_enlazado = filter_input(INPUT_POST, 'att_enl', FILTER_SANITIZE_NUMBER_INT);
$id_multiple = filter_input(INPUT_POST, 'att_mult', FILTER_SANITIZE_NUMBER_INT);
$id_pack = filter_input(INPUT_POST, 'id_pack', FILTER_SANITIZE_NUMBER_INT);
$id_ancla = filter_input(INPUT_POST, 'id_ancla', FILTER_SANITIZE_NUMBER_INT);

$logs_sys = new stdClass();

$ajax_sys = true;

/*
$logs_sys->accion = $select_sys;
$logs_sys->id_productos_images = $id_productos_images;
$logs_sys->id_productos = $id_productos;
$logs_sys->id_enlazado = $id_enlazado;
$logs_sys->id_multiple = $id_multiple;
$logs_sys->id_pack = $id_pack;
$logs_sys->id_ancla = $id_ancla;

echo json_encode([
    'logs' => $logs_sys,
    'id' => $id_productos,
    'id_images' => $id_productos_images,
    'att_enl' => $id_enlazado,
    'att_mult' => $id_multiple,
    'pack' => $id_pack,
    'ancla' => $id_ancla,
    'resultado' => $resultado_sys,
    'apartado' => $apartado_url
]);
*/
require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/productos/imagenes/gestion/datos-update-php.php");