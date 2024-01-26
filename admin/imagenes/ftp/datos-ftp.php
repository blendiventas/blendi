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
$modulo = filter_input(INPUT_POST, 'modulo', FILTER_SANITIZE_STRING);
$tabla = filter_input(INPUT_POST, 'tabla', FILTER_SANITIZE_STRING);
$id_renombrar = filter_input(INPUT_POST, 'id_renombrar', FILTER_SANITIZE_NUMBER_INT);

$id_enlazado = filter_input(INPUT_POST, 'att_enl', FILTER_SANITIZE_NUMBER_INT);
$id_multiple = filter_input(INPUT_POST, 'att_mult', FILTER_SANITIZE_NUMBER_INT);
$id_pack = filter_input(INPUT_POST, 'id_pack', FILTER_SANITIZE_NUMBER_INT);
$id_ancla = filter_input(INPUT_POST, 'id_ancla', FILTER_SANITIZE_NUMBER_INT);

$logs_sys = new stdClass();

$ajax_sys = true;
/*
$logs_sys->datos1 = "id_panel_sys: ".$id_panel_sys;
$logs_sys->datos2 = "apartado_url: ".$apartado_url;
$logs_sys->datos3 = "id_productos: ".$id_productos;
$logs_sys->datos4 = "nombre_imagen: ".$nombre_imagen;
$logs_sys->datos5 = "modulo: ".$modulo;
$logs_sys->datos6 = "tabla: ".$tabla;

echo json_encode([
    'logs' => $logs_sys
]);
*/

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

if($select_sys == "renombrar") {
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/imagenes/ftp/renombrar.php");
}