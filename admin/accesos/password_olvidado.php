<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/enviar_mails/php_mailer/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/enviar_mails/php_mailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/enviar_mails/php_mailer/SMTP.php';

$email = (isset($_POST['email']))? $_POST['email'] : null;

if (!$email) {
    throw new Exception('Es necesario un email.');
}

function randomToken()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 30; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");
$conn = new db(0);
$conn->query("SET NAMES 'utf8'");

$result = $conn->query("SELECT id FROM identificacion_panel WHERE empresa='" . addslashes($email) . "' AND bloqueado=0 LIMIT 1");

if($conn->registros() == 1) {
    $idIdentificacionPanel = $result[0]['id'];
    $tokenRecuperacion = randomToken();

    $result = $conn->query("UPDATE identificacion_panel SET password = '" . $tokenRecuperacion . "' WHERE id = " . $idIdentificacionPanel . " LIMIT 1");

    $autenticacio = "1";
    $cuenta = "mail.blendi.es";
    $user_name = "admin@blendi.es";
    $password = "1J0?jNI0?";
    $port = 465;
    $asunto = "Restauración contraseña de Blendi Ventas";
    $cuenta_enviar_mail = $email;

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
    $mail->FromName = 'Blendi Ventas';
    $mail->Timeout = 120;
    $mail->Body = 'Utiliza este enlace para restaurar tu contraseña: <a href="' . $_SERVER["HTTP_HOST"] . '/?accion=restaurar_password&email=' . urlencode($email) . '&token=' . $tokenRecuperacion . '" title="Restaurar contraseña">' . $_SERVER["HTTP_HOST"] . '/?accion=restaurar_password&email=' . urlencode($email) . '&token=' . $tokenRecuperacion . '</a>';
    $mail->AddAddress($cuenta_enviar_mail);
    $mail->Subject = $asunto;
    $exito = $mail->Send();
    if ($mail->ErrorInfo == "SMTP Error: Data not accepted") {
        $exito = true;
    }
    if (!$exito) {
        throw new \Exception("No se ha podido enviar el e-mail. " . $mail->ErrorInfo);
    }

    $mail->ClearAddresses();

    echo json_encode('Se ha enviado el correo.');
}
