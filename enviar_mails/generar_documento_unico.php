<?php
header('Content-Type: application/json');

$id_sesion = $_POST['id_sesion'];
$ip = $_POST['ip'];
$so = $_POST['so'];
$idioma = $_POST['idioma'];
$ejercicio = $_POST['ejercicio'];
$id_documento_1 = $_POST['id_documento_1'];

require 'crear_pdf_documento_unico.php';

$return = new stdClass();
$return->documento = '/enviar_mails/ficheros/' . $id_panel . '/' . $nombre_pdf;

echo json_encode($return);