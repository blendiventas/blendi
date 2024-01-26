<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM bancos_cajas WHERE id=" . $id_bancos_cajas . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE bancos_cajas SET activo=" . $valor_sys . " WHERE id=" . $id_bancos_cajas . " LIMIT 1");
            $logs_sys .= "UPDATE bancos_cajas SET activo=" . $valor_sys . " WHERE id=" . $id_bancos_cajas . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_bancos_cajas)) {
                /*
                CREATE TABLE `bancos_cajas` (
                    `id` INT(10) NOT NULL AUTO_INCREMENT,
                    `descripcion` VARCHAR(35) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `entidad` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `agencia` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `dc` VARCHAR(2) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `cuenta` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `iban` VARCHAR(24) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `activo` TINYINT(1) NOT NULL DEFAULT '1',
                */
                $logs_sys .= "INSERT INTO bancos_cajas VALUES(
                              NULL,
                              '" . addslashes($descripcion) . "',
                              '" . addslashes($entidad) . "',
                              '" . addslashes($agencia) . "',
                              '" . addslashes($dc) . "',
                              '" . addslashes($cuenta) . "',
                              '" . addslashes($iban) . "',
                              " . $activo_bancos_cajas . ")<br />";
                $result = $conn->query("INSERT INTO bancos_cajas VALUES(
                              NULL,
                              '" . addslashes($descripcion) . "',
                              '" . addslashes($entidad) . "',
                              '" . addslashes($agencia) . "',
                              '" . addslashes($dc) . "',
                              '" . addslashes($cuenta) . "',
                              '" . addslashes($iban) . "',
                              " . $activo_bancos_cajas . ")");
                $id_bancos_cajas = $conn->id_insert();
                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE bancos_cajas SET 
                  descripcion='" . addslashes($descripcion) . "', 
                  entidad='" . addslashes($entidad) . "', 
                  agencia='" . addslashes($agencia) . "', 
                  dc='" . addslashes($dc) . "', 
                  cuenta='" . addslashes($cuenta) . "', 
                  iban='" . addslashes($iban) . "', 
                  activo=" . $activo_bancos_cajas . " 
                  WHERE id=" . $id_bancos_cajas . " LIMIT 1<br />";

                $result = $conn->query("UPDATE bancos_cajas SET 
                  descripcion='" . addslashes($descripcion) . "', 
                  entidad='" . addslashes($entidad) . "', 
                  agencia='" . addslashes($agencia) . "', 
                  dc='" . addslashes($dc) . "', 
                  cuenta='" . addslashes($cuenta) . "', 
                  iban='" . addslashes($iban) . "', 
                  activo=" . $activo_bancos_cajas . " 
                  WHERE id=" . $id_bancos_cajas . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_bancos_cajas,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM bancos_cajas WHERE id=" . $id_bancos_cajas . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM bancos_cajas WHERE id=" . $id_bancos_cajas . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
    }
}