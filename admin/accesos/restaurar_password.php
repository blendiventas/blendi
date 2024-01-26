<?php

$email = (isset($_POST['email']))? $_POST['email'] : null;
$token = (isset($_POST['token']))? $_POST['token'] : null;
$nuevoPassword = (isset($_POST['nuevo_password']))? $_POST['nuevo_password'] : null;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");
$conn = new db(0);
$conn->query("SET NAMES 'utf8'");

$result = $conn->query("SELECT id FROM identificacion_panel WHERE empresa='" . addslashes($email) . "' AND password='" . addslashes($token) . "' AND bloqueado=0 LIMIT 1");

if($conn->registros() == 1) {
    $idIdentificacionPanel = $result[0]['id'];

    $result = $conn->query("UPDATE identificacion_panel SET password = '" . addslashes($nuevoPassword) . "' WHERE id = " . $idIdentificacionPanel . " LIMIT 1");

    echo json_encode('Password modificado correctamente.');
}