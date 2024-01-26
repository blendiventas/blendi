<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
if(isset($_POST['id_terminales'])) {
    $id_terminal = $_POST['id_terminales'];
}else if(isset($_POST['id_terminal'])) {
    $id_terminal = $_POST['id_terminal'];
}
//$id_terminal = filter_input(INPUT_POST, 'id_terminal', FILTER_SANITIZE_NUMBER_INT);
$descripcion_terminal = filter_input(INPUT_POST, 'descripcion_terminal', FILTER_SANITIZE_STRING);
$mostrar_todo_terminal = filter_input(INPUT_POST, 'mostrar_todo_terminales', FILTER_SANITIZE_NUMBER_INT);
$activo_terminal = filter_input(INPUT_POST, 'activo_terminales', FILTER_SANITIZE_NUMBER_INT);

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/terminales/gestion/datos-update-php.php");