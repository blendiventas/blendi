<?php
session_start();

header('Content-Type: application/json');
$id_documento = $_POST['id_documento'];
$id_sesion_js = $_POST['id_sesion_js'];
$ejercicio = $_POST['ejercicio'];

$_SESSION[$id_sesion_js]['ejercicio'] = $ejercicio;
$_SESSION[$id_sesion_js]['id_documento'] = $id_documento;

echo 'ok';