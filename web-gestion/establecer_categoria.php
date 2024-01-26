<?php
session_start();

header('Content-Type: application/json');
$id_sesion = $_POST['id_sesion'];
$id_sesion_js = $_POST['id_sesion_js'];
$ip = $_POST['ip'];
$interface = $_POST['interface_js'];
$id_panel = $_POST['id_panel'];
$id_categoria = $_POST['id_categoria'];

$_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'] = $id_categoria;

echo 'ok';