<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/sw/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sw/MyVapid.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/sw/MyLogger.php';

use SKien\PNServer\PNDataProviderMySQL;
use SKien\PNServer\PNPayload;
use SKien\PNServer\PNServer;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$id_sesion = $_POST['id_sesion'];
$ip = $_POST['ip'];
$id_documento_1 = $_POST['id_documento_1'];

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
if ($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
} else {
    throw new Exception("Acceso no permitido.");
}
$datos = $conn->query("SELECT dominio_base, base, usuario_base, password_base from identificacion_panel WHERE id=" . $id_panel . " AND bloqueado=0 LIMIT 1");
$bbddHost = $datos[0]['dominio_base'];
$bbddUser = $datos[0]['usuario_base'];
$bbddPass = $datos[0]['password_base'];
$bbddDB = $datos[0]['base'];
unset($conn);

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$idTerminalesANotificar = [];

$numero_documento = '';
if ($id_documento_1) {
    $result = $conn->query("SELECT numero_documento, id_usuario FROM documentos_" . date('Y') . "_1 WHERE id = " . $id_documento_1 . " LIMIT 1");
    $numero_documento = $result[0]['numero_documento'];
    $id_usuario = $result[0]['id_usuario'];

    $result = $conn->query("SELECT id_terminal FROM usuarios_accesos WHERE id_usuario = " . $id_usuario . " AND activo = 1 ORDER BY id DESC LIMIT 1");
    if ($conn->registros() == 1) {
        $id_terminal = $result[0]['id_terminal'];
        $idTerminalesANotificar[] = $id_terminal;

        $logger = createLogger();
        $oDP = new PNDataProviderMySQL($bbddHost, $bbddUser, $bbddPass, $bbddDB, null, $logger, $id_terminal);
        if (!$oDP->isConnected()) {
            echo $oDP->getError();
            exit();
        }
        if (!$oDP->init()) {
            echo $oDP->getError();
            exit();
        }

        // the server to handle all
        $oServer = new PNServer($oDP);
        $oServer->setLogger($logger);

        // Set our VAPID keys
        $oServer->setVapid(getMyVapid());

        // create and set payload
        // - we don't set a title - so service worker uses default
        // - URL to icon can be
        //    * relative to the origin location of the service worker
        //    * absolute from the homepage (begining with a '/')
        //    * complete URL (beginning with https://)
        $oPayload = new PNPayload('Pedido ' . $numero_documento, "Platos listos.", '/images/logo_cuadrado_120x120.jpg');
        $oPayload->setTag('news', true);
        $oPayload->setURL('/recepcion_pedidos');

        $oServer->setPayload($oPayload);

        // load subscriptions from database
        if (!$oServer->loadSubscriptions()) {
            echo $oDP->getError();
            exit();
        }

        // ... and finally push !
        $oServer->push();
    }
}

$returnMessage = new stdClass();
$returnMessage->message = 'Pedido ' . $numero_documento . ". Platos listos.";
$returnMessage->terminales = $idTerminalesANotificar;

echo json_encode($returnMessage);
