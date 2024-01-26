<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/Exception.php';
require 'php_mailer/PHPMailer.php';
require 'php_mailer/SMTP.php';

$id_sesion = $_POST['id_sesion'];
$ip = $_POST['ip'];
$so = $_POST['so'];
$idioma = $_POST['idioma'];
$ejercicio = $_POST['ejercicio'];
$id_documento_1 = $_POST['id_documento_1'];
$mail = $_POST['mail'];
$now = new DateTime();

require 'crear_pdf_documento_unico.php';

$query = "INSERT INTO libradores_historico_correos VALUES(NULL, " . $id_librador . ", '" . $tipo_librador . "', '" . $tipo_documento . "', '" . $numero_documento . "', '" . addslashes($mail) . "', '" . $now->format('Y-m-d H:i:s') . "', 0)";
$conn->query($query);

$autenticacio = "1";
$cuenta = "blendi-es.correoseguro.dinaserver.com";
$user_name = "admin@blendi.es";
$password = "3EzRR5^1^0?1";
$port = 465;
$asunto = "Nuevo documento de " . $empresa;
$cuenta_enviar_mail = $mail;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->CharSet = "UTF-8";
$mail->Host = $cuenta;
if (!empty($autenticacio)) {
    $mail->SMTPAuth = true;
}
$mail->isHTML(true);
$mail->Username = $user_name;
$mail->Password = $password;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = $port;
$mail->From = $user_name;
$mail->FromName = $empresa;
$mail->Timeout = 120;
$mail->AddAttachment($nombre_archivo, $nombre_pdf);
$mail->Body = utf8_decode('Se ha solicitado el envío de un documento de ' . $empresa . ' a este correo.') . '<br><img src="https://' . $_SERVER['SERVER_NAME'] . '/enviar_mails/email_visto.php?id_panel=' . $conn->id_panel . '&id_librador=' . $id_librador . '&tipo_librador=' . $tipo_librador . '&tipo_documento=' . $tipo_documento . '&numero_documento=' . urlencode($numero_documento) . '" alt="Logo Blendi" title="Logo Blendi" width="100" />';
$mail->AddAddress(trim($cuenta_enviar_mail));
$mail->Subject = $asunto;
$exito = $mail->Send();
if ($mail->ErrorInfo == "SMTP Error: Data not accepted") {
    $exito = true;
}
if ($exito) {
    $logs_sys[] = "Enviado correctamente.";
} else {
    //$result = $conn->query("UPDATE mails_historic SET error='1' WHERE id='".$id_seguiment."' LIMIT 1");
    $logs_sys[] = "No se ha podido enviar el e-mail. " . $mail->ErrorInfo;
}
$mail->ClearAddresses();