<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/Exception.php';
require 'php_mailer/PHPMailer.php';
require 'php_mailer/SMTP.php';

$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so_sys = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$idioma_sys = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$interface_js_sys = filter_input(INPUT_POST, 'interface_js', FILTER_SANITIZE_STRING);
$id_panel = null;
$tipo_librador = filter_input(INPUT_POST, 'tipo_librador', FILTER_SANITIZE_STRING);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$decimales_cantidades = $_POST['decimales_cantidades'];
$decimales_importes = $_POST['decimales_importes'];
$id_usuario_impresion = $_POST['id_usuario'];

if ($select_sys == "imprimir-documento") {
    $ejercicios = $_POST['ejercicio'];
    $ids_documentos_1 = $_POST['id_documento_1'];
}else if ($select_sys == "enviar-documentos" OR $select_sys == "imprimir-documentos") {
    $ejercicios = explode(',', $_POST['ejercicios']);
    $ids_documentos_1 = explode(',', $_POST['documentos']);
    if ($select_sys == "enviar-documentos") {
        $mails = explode(',', $_POST['mails']);
    }
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

function enviarDocumento($conn, $pdf, $mail, $empresa, $cuerpo_mail, $ejercicio, $decimales_importes, $decimales_cantidades, $raiz, $id_documento_1, $select_sys, $id_usuario_impresion, $tienda = null) {
    if($select_sys != "imprimir-documentos") {
        unset($pdf);
        $nombre_archivo = $raiz . "/nombre_" . $id_documento_1 . ".pdf";
        $nombre_pdf = "nombre_" . $id_documento_1 . ".pdf";
    }

    require("crear_pdf.php");

    switch ($select_sys) {
        case "enviar-documentos":
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $now = new DateTime();
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
                $mail->AddAttachment($nombre_archivo, 'nombre_' . $id_documento_1 . '.pdf');
                $mail->Body = ((empty($plantilla))? '' : utf8_decode($plantilla)) . utf8_decode($cuerpo_mail) . '<br><img src="https://' . $_SERVER['SERVER_NAME'] . '/enviar_mails/email_visto.php?id_panel=' . $conn->id_panel . '&id_librador=' . $id_librador . '&tipo_librador=' . $tipo_librador . '&tipo_documento=' . $tipo_documento . '&numero_documento=' . urlencode($numero_documento) . '" alt="Logo Blendi" title="Logo Blendi" width="100" />';
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
            }
            break;
        case "imprimir-documento":
            $logs_sys = "imprimir-documento";
            break;
        case "imprimir-documentos":
            $logs_sys = "imprimir-documentos";
            break;
    }
    if($select_sys != "imprimir-documentos") {
        return $nombre_pdf;
    }
}

$tienda = '';
if ($interface_js_sys == 'tpv') {
    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");
    $result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id_panel'];
    } else {
        throw new Exception("Acceso no permitido.");
    }
    unset($conn);
} else {
    $tienda = $_POST['tienda'];

    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");

    $result = $conn->query("SELECT id,sector FROM identificacion_panel WHERE web_blendi='" . addslashes($tienda) . "' LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id'];
        $sector = $result[0]['sector'];
    } else {
        throw new Exception('Negocio no encontrado.');
    }
    unset($conn);

    $correo_enviar = $_POST['correo_enviar'];

}

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$empresa = "";

$logs_sys = [];
$logs_sys[] = $select_sys;

$raiz = $_SERVER['DOCUMENT_ROOT'] . '/enviar_mails/ficheros/' . $id_panel;
if ( !is_dir( $raiz ) ) {
    mkdir( $raiz );
}

try {
    require_once('fpdf/fpdf.php');
    require_once('fpdf/fpdi.php');

    if($select_sys == "enviar-documentos") {
        $result = $conn->query("SELECT nombre_fiscal FROM datos_empresa LIMIT 1");
        $empresa = stripslashes($result[0]['nombre_fiscal']);
    }

} catch (Exception $e) {
    $logs_sys[] = $e->getMessage();
}

try {
    $nombre_merged = '';
    if(!is_array($ids_documentos_1)) {

        $ejercicio = $ejercicios;
        $id_documento_1 = $ids_documentos_1;

        $nombre_pdf = enviarDocumento($conn, '', '','', '', $ejercicio, $decimales_importes, $decimales_cantidades, $raiz, $id_documento_1, $select_sys, $id_usuario_impresion, $tienda);
    }else {
        if($select_sys == "imprimir-documentos") {
            $nombre_archivo = $raiz . "/documento_" . time() . ".pdf";
            $nombre_pdf = "documento_" . time() . ".pdf";

            $pdf = new FPDI();
            foreach ($ids_documentos_1 as $key_ids_documentos_1 => $valor_ids_documentos_1) {
                $ejercicio = $ejercicios[$key_ids_documentos_1];
                $id_documento_1 = $valor_ids_documentos_1;

                if ($interface_js_sys != 'tpv') {
                    $result_mail = $conn->query("SELECT email FROM documentos_" . $ejercicio . "_libradores WHERE id_documentos_1='" . $id_documento_1 . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $mail = $result_mail[0]['email'];
                        if (empty($mail) || $mail != $correo_enviar) {
                            throw new Exception('Mail no encontrado.');
                        }
                    } else {
                        throw new Exception('Mail no encontrado.');
                    }
                }

                enviarDocumento($conn, $pdf, '', '', '', $ejercicio, $decimales_importes, $decimales_cantidades, $raiz, $id_documento_1, $select_sys, $id_usuario_impresion, $tienda);
            }
            $pdf->Output('F', $nombre_archivo, true);
        }else {
            foreach ($ids_documentos_1 as $key_ids_documentos_1 => $valor_ids_documentos_1) {
                $ejercicio = $ejercicios[$key_ids_documentos_1];
                $id_documento_1 = $valor_ids_documentos_1;
                if ($select_sys == "enviar-documentos") {
                    if ($interface_js_sys == 'tpv') {
                        $mail =$mails[$key_ids_documentos_1];
                    } else {
                        $result_mail = $conn->query("SELECT email FROM documentos_" . $ejercicio . "_libradores WHERE id_documentos_1='" . $id_documento_1 . "' LIMIT 1");
                        if ($conn->registros() == 1) {
                            $mail = $result_mail[0]['email'];
                            if (empty($mail) || $mail != $correo_enviar) {
                                throw new Exception('Mail no encontrado.');
                            }
                        } else {
                            throw new Exception('Mail no encontrado.');
                        }
                    }
                    $cuerpo_mail = "Se ha generado un nuevo documento a su nombre.";
                    enviarDocumento($conn, '', trim($mail), $empresa, $cuerpo_mail, $ejercicio, $decimales_importes, $decimales_cantidades, $raiz, $id_documento_1, $select_sys, $id_usuario_impresion, $tienda);
                }else {
                    enviarDocumento($conn, '', trim($mail), '', '', $ejercicio, $decimales_importes, $decimales_cantidades, $raiz, $id_documento_1, $select_sys, $id_usuario_impresion, $tienda);
                }
            }
        }
    }
} catch (\Exception $e) {
    $logs_sys[] = $e->getMessage();
}


if (isset($ajax_sys)) {
    /*
    echo json_encode([
        'logs' => $logs_sys,
        'nombrePDF' => $nombre_pdf,
        'nombrePDFEnUno' => $nombre_merged
    ]);
    */
    echo json_encode([
        'logs' => $logs_sys,
        'nombrePDF' => $nombre_pdf
    ]);
}