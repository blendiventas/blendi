<?php
$id_sesion_sys = $_POST['id_sesion'];
$ip_sys = $_POST['ip'];
$ruta_sys = $_POST['ruta'];
$destino_sys = $_POST['destino'];
$nombre_sys = $_POST['nombre'];
$updated_sys = date("y-m-d").date("H:m:s");
$updated_sys = str_replace("-","",$updated_sys);
$updated_sys = str_replace(":","",$updated_sys);
$id_sys = $_POST['id_foto'];
$sub_id_sys = $_POST['id_producto'];
$id_enlazado = $_POST['id_enlazado'];
$id_multiple = $_POST['id_multiple'];
$id_pack = $_POST['id_pack'];
$tipoFile_sys = $_FILES["file"]['type'];

if(empty($nombre_sys)) {
    $partes_nombre_sys = explode(".",$_FILES["file"]["name"]);
    $nombre_sys = preg_replace('/[^a-zA-Z0-9\']/', '-', $partes_nombre_sys[0]);
}

if (isset($_POST['empresa']) && !empty($_POST['empresa']) && isset($_POST['clave']) && !empty($_POST['clave'])) {
    require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/datos-identificacion.php");
} else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/datos-acceso.php");
}

$hora_sys = date("H:m:s");
$hora_sys = str_replace(":","",$hora_sys);

$matriz_logs_sys[] = "Id panel: ".$id_panel_sys;
$matriz_logs_sys[] = "Destino: ".$destino_sys;
$matriz_logs_sys[] = "Nombre: ".$nombre_sys;
$matriz_logs_sys[] = "Hora: ".$hora_sys;
$matriz_logs_sys[] = "Updated: ".$updated_sys;
$matriz_logs_sys[] = "Id: ".$id_sys;
$matriz_logs_sys[] = "Sub id sys: ".$sub_id_sys;
$matriz_logs_sys[] = "Tipo file: ".$tipoFile_sys;
$matriz_logs_sys[] = "Tmp name file: ".$_FILES["file"]["tmp_name"];
$matriz_logs_sys[] = "Name file: ".$_FILES["file"]["name"];

if($tipoFile_sys == "image/jpeg" || $tipoFile_sys == "image/png" || $tipoFile_sys == "image/gif") {
    $extension_sys = "";
    if($tipoFile_sys == "image/jpeg") {
        $extension_sys = ".jpg";
    }elseif($tipoFile_sys == "image/png") {
        $extension_sys = ".png";
    }elseif($tipoFile_sys == "image/gif") {
        $extension_sys = ".gif";
    }

    if ( !is_dir( $_SERVER['DOCUMENT_ROOT'] . '/images/temp/' . $id_panel_sys ) ) {
        mkdir( $_SERVER['DOCUMENT_ROOT'] . '/images/temp/' . $id_panel_sys );
    }
    $nombre_sys = $id_panel_sys . '/' . $nombre_sys;

    $matriz_logs_sys[] = "Extension: ".$extension_sys;
    if(!move_uploaded_file($_FILES["file"]["tmp_name"], "../images/temp/".$nombre_sys . "-" . $hora_sys . $extension_sys)) {
        $matriz_logs_sys[] = "No se ha podido subir la imagen a ".$nombre_sys.$extension_sys;
    }else {
        $conn = new db(0);
        $conn->query("SET NAMES 'utf8'");

        $matriz_logs_sys[] = "SELECT dominio_ftp,ftp,password_ftp FROM identificacion_panel WHERE id=" . $id_panel_sys . " AND bloqueado=0 LIMIT 1";

        $result = $conn->query("SELECT dominio_ftp,ftp,password_ftp FROM identificacion_panel WHERE id=" . $id_panel_sys . " AND bloqueado=0 LIMIT 1");
        if ($conn->registros() == 1) {
            unset($conn);
            if ( !is_dir( $_SERVER['DOCUMENT_ROOT'] . '/' . $destino_sys ) ) {
                mkdir( $_SERVER['DOCUMENT_ROOT'] . '/' . $destino_sys );
            }
            if ( !is_dir( $_SERVER['DOCUMENT_ROOT'] . '/' . $destino_sys . '/' . $id_panel_sys ) ) {
                mkdir( $_SERVER['DOCUMENT_ROOT'] . '/' . $destino_sys . '/' . $id_panel_sys );
            }
            $destino_sys = "/www/".$destino_sys."/";
            $dominio_ftp_sys = stripslashes($result[0]['dominio_ftp']);
            $usuario_ftp_sys = stripslashes($result[0]['ftp']);
            $password_ftp_sys = stripslashes($result[0]['password_ftp']);
            $matriz_logs_sys[] = "Remote file name: ".$destino_sys . $nombre_sys . "-" . $hora_sys . $extension_sys;
            $matriz_logs_sys[] = "Local file name: "."../images/temp/" . $nombre_sys . "-" . $hora_sys . $extension_sys;

            $ftp = ftp_ssl_connect($dominio_ftp_sys) or die("No se pudo conectar a $dominio_ftp_sys");;
            if(ftp_login($ftp, $usuario_ftp_sys, $password_ftp_sys)) {
                if (ftp_put($ftp, $destino_sys . $nombre_sys . "-" . $hora_sys . $extension_sys, "../images/temp/" . $nombre_sys . "-" . $hora_sys . $extension_sys, FTP_BINARY)) {
                    $id_productos = $sub_id_sys;
                    $select_sys = "subir-imagen";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/".$ruta_sys."gestion/datos-update-php.php");
                    unset($conn);
                    $matriz_logs_sys[] = "Imagen subida correctamente."."/admin/".$ruta_sys."gestion/datos-update-php.php";
                } else {
                    $matriz_logs_sys[] = "Ha habido un problema en la transferencia ftp.";
                }
            }else {
                $matriz_logs_sys[] = "Ha habido un problema en la conexión ftp.";
            }
            ftp_close($ftp);

        }else {
            unset($conn);
            $matriz_logs_sys[] = "No se ha podido establecer la conexión al servidor";
        }
        unlink("../images/temp/".$nombre_sys . "-" . $hora_sys . $extension_sys);
    }
}else {
    $matriz_logs_sys[] = "(".$tipoFile_sys.") Solo se pueden subir archivos jpg, png o gif";
}
if(!empty($sub_id_sys)) {
    $id_sys = $sub_id_sys;
}
echo json_encode([
    'logs' => $matriz_logs_sys,
    'id' => $id_sys
]);