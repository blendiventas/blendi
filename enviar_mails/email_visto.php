<?php

$id_librador = $_GET['id_librador'];
$tipo_librador = $_GET['tipo_librador'];
$tipo_documento = $_GET['tipo_documento'];
$numero_documento = urldecode($_GET['numero_documento']);
$id_panel = $_GET['id_panel'];


require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$conn->query("UPDATE libradores_historico_correos SET visto = 1 WHERE id_librador = " . addslashes($id_librador) . " AND tipo_librador = '" . addslashes($tipo_librador) . "' AND tipo_documento = '" . addslashes($tipo_documento) . "' AND numero_documento = '" . addslashes($numero_documento) . "'");

header ("Location: https://" . $_SERVER['SERVER_NAME'] . "/images/logos/logo.png");
