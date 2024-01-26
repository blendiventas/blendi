<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM idiomas WHERE id=" . $id_idiomas . " LIMIT 1");
            if ($result[0]['activa'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE idiomas SET activo=" . $valor_sys . " WHERE id=" . $id_idiomas . " LIMIT 1");
            $logs_sys .= "UPDATE idiomas SET activo=" . $valor_sys . " WHERE id=" . $id_idiomas . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_idiomas)) {
                if(!empty($idioma_idiomas)) {
                    if($principal_idiomas == 1) {
                        $logs_sys .= "UPDATE idiomas SET principal=0 WHERE principal=1<br />";
                        $result = $conn->query("UPDATE idiomas SET principal=0 WHERE principal=1");
                    }
                    $logs_sys .= "INSERT INTO idiomas VALUES(
                                  NULL,
                                  '" . addslashes($idioma_idiomas) . "',
                                  '',
                                  '',
                                  '" . addslashes($lang_idiomas) . "',
                                  '" . addslashes($locale_idiomas) . "',
                                  " . $activo_idiomas . ",
                                  '" . $principal_idiomas . "')<br />";
                    $result = $conn->query("INSERT INTO idiomas VALUES(
                                  NULL,
                                  '" . addslashes($idioma_idiomas) . "',
                                  '',
                                  '',
                                  '" . addslashes($lang_idiomas) . "',
                                  '" . addslashes($locale_idiomas) . "',
                                  " . $activo_idiomas . ",
                                  '" . $principal_idiomas . "')");
                    $id_idiomas = $conn->id_insert();
                    $resultado_sys = "INSERT";
                }else {
                    $id_idiomas = 0;
                    $resultado_sys = "INSERT ERROR descripción idioma";
                }
            }else {
                /*
                CREATE TABLE `idiomas` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `idioma` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
                    `bandera` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
                    `updated` VARCHAR(12) NOT NULL COLLATE 'utf8_spanish_ci',
                    `lang` VARCHAR(2) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `locale` VARCHAR(5) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                    `activo` TINYINT(1) NULL DEFAULT '1',
                    `principal` TINYINT(1) NULL DEFAULT '0',
                PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;
                */
                if($principal_idiomas == 1) {
                    $logs_sys .= "UPDATE idiomas SET principal=0 WHERE principal=1<br />";
                    $result = $conn->query("UPDATE idiomas SET principal=0 WHERE principal=1");
                }
                $logs_sys .= "UPDATE idiomas SET
                  idioma='" . addslashes($idioma_idiomas) . "', 
                  lang='" . addslashes($lang_idiomas) . "', 
                  locale='" . addslashes($locale_idiomas) . "',
                  activo=" . $activo_idiomas . ", 
                  principal='" . $principal_idiomas . "' 
                  WHERE id=" . $id_idiomas . " LIMIT 1<br />";
                $result = $conn->query("UPDATE idiomas SET
                  idioma='" . addslashes($idioma_idiomas) . "', 
                  lang='" . addslashes($lang_idiomas) . "', 
                  locale='" . addslashes($locale_idiomas) . "',
                  activo=" . $activo_idiomas . ", 
                  principal='" . $principal_idiomas . "' 
                  WHERE id=" . $id_idiomas . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_idiomas,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM idiomas WHERE id=" . $id_idiomas . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM idiomas WHERE id=" . $id_idiomas . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "subir-imagen":
            $result = $conn->query("UPDATE idiomas SET bandera='" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "', updated='" . $updated_sys . "' WHERE id=" . $id_sys . " LIMIT 1");
            break;
    }
}