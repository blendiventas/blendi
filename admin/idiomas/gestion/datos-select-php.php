<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "total":
            $result_idiomas = $conn->query("SELECT * FROM idiomas ORDER BY idioma");
            foreach ($result_idiomas as $key_idiomas => $valor_idiomas) {
                $matriz_id_idiomas[] = $valor_idiomas['id'];
                $matriz_idioma_idiomas[] = stripslashes($valor_idiomas['idioma']);
                $matriz_bandera_idiomas[] = stripslashes($valor_idiomas['bandera']);
                $matriz_updated_idiomas[] = $valor_idiomas['updated'];
                $matriz_lang_idiomas[] = stripslashes($valor_idiomas['lang']);
                $matriz_locale_idiomas[] = stripslashes($valor_idiomas['locale']);
                $matriz_activo_idiomas[] = $valor_idiomas['activo'];
                $matriz_principal_idiomas[] = $valor_idiomas['principal'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $matriz_id_idiomas,
                    'idioma' => $matriz_idioma_idiomas,
                    'bandera' => $matriz_bandera_idiomas,
                    'updated' => $matriz_updated_idiomas,
                    'lang' => $matriz_lang_idiomas,
                    'locale' => $matriz_locale_idiomas,
                    'activo' => $matriz_activo_idiomas,
                    'principal' => $matriz_principal_idiomas
                ]);
            }
            break;
        case "activos":
            $result_idiomas = $conn->query("SELECT * FROM idiomas WHERE idioma=" . $id_idioma_sys . " AND activo=1 ORDER BY idioma");
            foreach ($result_idiomas as $key_idiomas => $valor_idiomas) {
                $matriz_id_idiomas[] = $valor_idiomas['id'];
                $matriz_idioma_idiomas[] = stripslashes($valor_idiomas['idioma']);
                $matriz_bandera_idiomas[] = stripslashes($valor_idiomas['bandera']);
                $matriz_updated_idiomas[] = $valor_idiomas['updated'];
                $matriz_lang_idiomas[] = stripslashes($valor_idiomas['lang']);
                $matriz_locale_idiomas[] = stripslashes($valor_idiomas['locale']);
                $matriz_principal_idiomas[] = $valor_idiomas['principal'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $matriz_id_idiomas,
                    'idioma' => $matriz_idioma_idiomas,
                    'bandera' => $matriz_bandera_idiomas,
                    'updated' => $matriz_updated_idiomas,
                    'lang' => $matriz_lang_idiomas,
                    'locale' => $matriz_locale_idiomas,
                    'principal' => $matriz_principal_idiomas
                ]);
            }
            break;
        case "idioma":
            $result_idiomas = $conn->query("SELECT id,idioma,principal FROM idiomas WHERE activo=1 ORDER BY idioma");
            foreach ($result_idiomas as $key_idiomas => $valor_idiomas) {
                $matriz_id_idiomas[] = $valor_idiomas['id'];
                $matriz_idioma_idiomas[] = stripslashes($valor_idiomas['idioma']);
                $matriz_principal_idiomas[] = $valor_idiomas['principal'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $matriz_id_idiomas,
                    'idioma' => $matriz_idioma_idiomas,
                    'principal' => $matriz_principal_idiomas
                ]);
            }
            break;
        case "editar-ficha":
            $idioma_idiomas = "";
            $bandera_idiomas = "";
            $updated_idiomas = "";
            $lang_idiomas = "";
            $locale_idiomas = "";
            $activo_idiomas = 1;
            $principal_idiomas = 0;
            $result_idiomas = $conn->query("SELECT * FROM idiomas WHERE id=" . $id_idiomas_url . " LIMIT 1");
            if($conn->registros() == 1) {
                $idioma_idiomas = stripslashes($result_idiomas[0]['idioma']);
                $bandera_idiomas = stripslashes($result_idiomas[0]['bandera']);
                $updated_idiomas = $result_idiomas[0]['updated'];
                $lang_idiomas = stripslashes($result_idiomas[0]['lang']);
                $locale_idiomas = stripslashes($result_idiomas[0]['locale']);
                $activo_idiomas = $result_idiomas[0]['activo'];
                $principal_idiomas = $result_idiomas[0]['principal'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'idioma' => $idioma_idiomas,
                    'bandera' => $bandera_idiomas,
                    'updated' => $updated_idiomas,
                    'lang' => $lang_idiomas,
                    'locale' => $locale_idiomas,
                    'activo' => $activo_idiomas,
                    'principal' => $principal_idiomas
                ]);
            }
            break;
    }
}