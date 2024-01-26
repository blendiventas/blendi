<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    $updated_sys = date("y-m-d") . date("H:m:s");
    $updated_sys = str_replace("-", "", $updated_sys);
    $updated_sys = str_replace(":", "", $updated_sys);
    $nombre_imagen = preg_replace('/[^a-zA-Z0-9\']/', '-', $nombre_imagen);
    $nombre_imagen_nuevo = $nombre_imagen . "-" . $updated_sys;
    $nombre_imagen_anterior = "";

    if($tabla == "idiomas") {
        $campo_imagen = "bandera";
        $campo_as = " AS imagen";
    }elseif($tabla == "datos_empresa") {
        $campo_imagen = "logo";
        $campo_as = " AS imagen";
    }else {
        $campo_imagen = "imagen";
        $campo_as = "";
    }
    $logs_sys->select1 = "SELECT ".$campo_imagen.$campo_as." FROM " . $tabla . " WHERE id=" . $id_renombrar . " LIMIT 1";
    $result_productos = $conn->query("SELECT ".$campo_imagen.$campo_as." FROM " . $tabla . " WHERE id=" . $id_renombrar . " LIMIT 1");
    if ($conn->registros() == 1) {
        $nombre_imagen_anterior = stripslashes($result_productos[0]['imagen']);
    }

    $logs_sys->anterior = $nombre_imagen_anterior;
    $logs_sys->nuevo = $nombre_imagen_nuevo;

    if(!empty($nombre_imagen_anterior) && !empty($nombre_imagen_nuevo)) {
        unset($conn);
        $extension = explode(".",$nombre_imagen_anterior);
        $nombre_imagen_nuevo = $nombre_imagen_nuevo.".".$extension[count($extension) - 1];

        $conn = new db(0);
        $conn->query("SET NAMES 'utf8'");
        //$logs_sys->select = "SELECT dominio_ftp,ftp,password_ftp FROM identificacion_panel WHERE id=" . $id_panel_sys . " AND bloqueado=0 LIMIT 1";
        $result = $conn->query("SELECT dominio_ftp,ftp,password_ftp FROM identificacion_panel WHERE id=" . $id_panel_sys . " AND bloqueado=0 LIMIT 1");
        if ($conn->registros() == 1) {
            //$logs_sys->paso1 = "Identificado";
            unset($conn);
            //$destino_sys = "/www/" . $destino_sys . "/";
            $dominio_ftp_sys = stripslashes($result[0]['dominio_ftp']);
            $usuario_ftp_sys = stripslashes($result[0]['ftp']);
            $password_ftp_sys = stripslashes($result[0]['password_ftp']);

            if ($modulo == "productos-imagenes") {
                $nombre_imagen_nuevo_guardar = "/www/images/productos/" . $id_panel_sys . "/" . $nombre_imagen_nuevo;
                $nombre_imagen_anterior_guardar = "/www/images/productos/" . $id_panel_sys . "/" . $nombre_imagen_anterior;;
            }else {
                $nombre_imagen_nuevo_guardar = "/www/images/" . $modulo . "/" . $nombre_imagen_nuevo;
                $nombre_imagen_anterior_guardar = "/www/images/" . $modulo . "/" . $nombre_imagen_anterior;;
            }

            $ftp = ftp_ssl_connect($dominio_ftp_sys);
            //$logs_sys->paso2 = "Conectado";
            if (ftp_login($ftp, $usuario_ftp_sys, $password_ftp_sys)) {
                //$logs_sys->paso3 = "Logeado";
                $logs_sys->datos_nombres = $nombre_imagen_anterior_guardar."->".$nombre_imagen_nuevo_guardar;
                if (ftp_rename($ftp, $nombre_imagen_anterior_guardar, $nombre_imagen_nuevo_guardar)) {
                    $logs_sys->acciones = "Se ha renombrado ".$nombre_imagen_anterior." a ".$nombre_imagen_nuevo." con éxito";

                    unset($conn);
                    $conn = new db($id_panel_sys);
                    $conn->query("SET NAMES 'utf8'");
                    $logs_sys->update_imagen = "UPDATE ".$tabla." SET ".$campo_imagen."='".$nombre_imagen_nuevo."' WHERE id=" . $id_renombrar . " LIMIT 1";
                    $result_productos = $conn->query("UPDATE ".$tabla." SET ".$campo_imagen."='".$nombre_imagen_nuevo."' WHERE id=" . $id_renombrar . " LIMIT 1");

                } else {
                    $logs_sys->acciones = "Hubo un problema al renombrar ".$nombre_imagen_anterior." a ".$nombre_imagen_nuevo;
                }
            } else {
                $logs_sys->acciones = "Ha habido un problema en la conexión ftp.";
            }
            ftp_close($ftp);

        } else {
            $logs_sys->acciones = "No se ha podido establecer la conexión al servidor";
        }
    }
    if (isset($ajax_sys)) {
        echo json_encode([
            'logs' => $logs_sys,
            'id' => $id_productos,
            'apartado' => $apartado_url
        ]);
    }
}