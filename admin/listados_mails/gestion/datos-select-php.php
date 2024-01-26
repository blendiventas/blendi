<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":
            $condiciones = '';
            if (isset($inicio_url) && isset($fin_url)) {
                $condiciones = " WHERE lhc.fecha_envio >= '" . $inicio_url . "' AND lhc.fecha_envio <= '" . $fin_url . "' ";
            }
            $query = "SELECT l.nombre as nombre, l.apellido_1 as apellido_1, l.apellido_2 as apellido_2, l.razon_social as razon_social, l.razon_comercial as razon_comercial, lhc.id_librador as id_librador, lhc.tipo_librador as tipo_librador, lhc.tipo_documento as tipo_documento, lhc.numero_documento as numero_documento, lhc.mail as mail, lhc.fecha_envio as fecha_envio, lhc.visto as visto FROM libradores_historico_correos lhc JOIN libradores l ON lhc.id_librador = l.id " . $condiciones ."ORDER BY lhc.id DESC LIMIT 300";
            $result = $conn->query($query);
            $descripcion_librador = [];
            $tipo_librador_mails = [];
            $tipo_documento_mails = [];
            $numero_documento_mails = [];
            $mail_mails = [];
            $fecha_envio_mails = [];
            $abierto_mails = [];
            foreach ($result as $key => $valor) {
                if (empty($valor['nombre'])) {
                    if (empty($valor['razon_social'])) {
                        if (empty($valor['razon_comercial'])) {
                            $descripcion_librador[] = $valor['id_librador'];
                        } else {
                            $descripcion_librador[] = $valor['razon_comercial'];
                        }
                    } else{
                        $descripcion_librador[] = $valor['razon_social'];
                    }
                } else {
                    $descripcion_librador[] = $valor['nombre'];
                }

                $tipo_librador_mails[] = $valor['tipo_librador'];
                $tipo_documento_mails[] = $valor['tipo_documento'];
                $numero_documento_mails[] = $valor['numero_documento'];
                $mail_mails[] = $valor['mail'];
                $fecha_envio_mails[] = $valor['fecha_envio'];
                $abierto_mails[] = $valor['visto'];
            }

            if (!empty($descarga_url) && $descarga_url == 'csv') {
                $return = 'Librador;Tipo librador;Tipo documento;Número documento;Mail;Fecha envío;Abierto';

                foreach ($descripcion_librador as $key => $valor) {
                    $return .= "\n";
                    $return .= $valor . ';' . $tipo_librador_mails[$key] . ';' . $tipo_documento_mails[$key] . ';' . $numero_documento_mails[$key] . ';' . $mail_mails[$key] . ';' . $fecha_envio_mails[$key] . ';' . $abierto_mails[$key];
                }

                header("Content-Type: text/csv");
                header("Content-Disposition: attachment; filename=listadoMails.csv");
                echo $return;
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'descripcion_librador' => $descripcion_librador,
                    'tipo_librador_mails' => $tipo_librador_mails,
                    'tipo_documento_mails' => $tipo_documento_mails,
                    'numero_documento_mails' => $numero_documento_mails,
                    'mail_mails' => $mail_mails,
                    'fecha_envio_mails' => $fecha_envio_mails,
                    'abierto_mails' => $abierto_mails
                ]);
            }
            break;
    }
}