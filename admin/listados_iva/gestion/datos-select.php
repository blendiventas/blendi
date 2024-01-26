<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);

$ejercicio_url = $_POST['ejercicio'];
/* Opciones mostrar
    iva-sportado-1t
    iva-sportado-2t
    iva-sportado-3t
    iva-sportado-4t
    iva-sportado-ej
    iva-repercutido-1t
    iva-repercutido-2t
    iva-repercutido-3t
    iva-repercutido-4t
    iva-repercutido-ej
*/
$mostrar_url = $_POST['mostrar'];
/* Opciones mostrar
    tiq
    fac
*/
$tipo_documento_url = $_POST['tipo_documento'];
$vista_url = $_POST['vista'];
$descarga_url = $_POST['descarga'];

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/listados_iva/gestion/datos-select-php.php");