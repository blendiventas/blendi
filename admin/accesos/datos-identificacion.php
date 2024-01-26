<?php
if (!isset($conn)) {
    require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");
    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");
}

/* IDENTIFICACION EMPRESA */
$result = $conn->query("SELECT id,sector,m_cocina,dominio_ftp,base,revisar_tablas FROM identificacion_panel WHERE empresa='" . addslashes($_POST['empresa']) . "' AND password='" . addslashes($_POST['clave']) . "' AND bloqueado=0 LIMIT 1");
if ($conn->registros() == 1) {
    $id_panel_sys = $result[0]['id'];
    $sector = $result[0]['sector'];
    $m_cocina = $result[0]['m_cocina'];
    $dominio_ftp_sys = stripslashes($result[0]['dominio_ftp']) . "/";
    $nombre_base_sys = stripslashes($result[0]['base']);
    $dia_sys = date("Y-m-d");
    $hora_sys = date("H:i:s");
    $revisar_tablas_sys = $result[0]['revisar_tablas'];
    $result = $conn->query("INSERT INTO identificacion_accesos VALUES(
                                        NULL,
                                        " . $id_panel_sys . ",
                                        '" . $id_sesion_sys . "',
                                        '" . addslashes($ip_sys) . "',
                                        '" . $dia_sys . "',
                                        '" . $hora_sys . "')");
    $id_identificacion_accesos_sys = $conn->id_insert();
    $acceso_correcto_sys = 1;
}else {
    $dia_sys = date("Y-m-d");
    $hora_sys = date("H:i:s");
    $result = $conn->query("INSERT INTO identificacion_accesos VALUES(
                                        NULL,
                                        0,
                                        '" . $id_sesion_sys . "',
                                        '" . addslashes($ip_sys) . "',
                                        '" . $dia_sys . "',
                                        '" . $hora_sys . "')");
    $result = $conn->query("SELECT COUNT(id) AS registros FROM identificacion_accesos WHERE (sesion='" . $id_sesion_sys . "' OR ip='".addslashes($ip_sys)."') AND id_panel=0 AND dia='" . $dia_sys . "'");
    $registrosAccesos = $result[0]['registros'];
    if($result[0]['registros'] >= 10) {
        $result = $conn->query("SELECT id FROM identificacion_panel WHERE empresa='" . addslashes($_POST['empresa']) . "' LIMIT 1");
        if($conn->registros() == 1) {
            $result = $conn->query("UPDATE identificacion_panel SET bloqueado=1 WHERE id=".$result[0]['id']." LIMIT 1");
        }
    }
}
unset($conn);