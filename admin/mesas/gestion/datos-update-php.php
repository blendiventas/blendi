<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = $select_sys."<br />";

require($_SERVER['DOCUMENT_ROOT'] . "/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "eliminar-margen-izquierda":
            $result = $conn->query("SELECT id FROM libradores WHERE tipo='mes' AND id_comedores='" . $id_comedor . "'");
            foreach ($result as $key => $valor) {
                $result_update = $conn->query("UPDATE libradores SET ancho_pos=ancho_pos - " . $margen . " WHERE id='" . $valor['id'] . "' LIMIT 1");
            }
            break;
        case "insertar-linea":
            $result = $conn->query("INSERT INTO libradores_lineas VALUES(
                                    NULL,
                                    '" . $id_comedor . "',
                                    '" . $ancho_pos_linea . "',
                                    '" . $alto_pos_linea . "',
                                    '" . $ancho_linea . "',
                                    '" . $alto_linea . "'
                )");
            if ($ajax_sys) {
                echo json_encode('ok');
            }
            break;
        case "guardar-linea":
            $result = $conn->query("UPDATE libradores_lineas SET 
                                    ancho_pos = ancho_pos + " . $ancho_pos_linea . ",
                                    alto_pos = alto_pos + " . $alto_pos_linea . ",
                                    ancho = '" . $ancho_linea . "',
                                    alto = '" . $alto_linea . "'
                                WHERE id = " . $id_linea . " LIMIT 1");
            if ($ajax_sys) {
                echo json_encode('ok');
            }
            break;
        case "eliminar-linea":
            $result = $conn->query("DELETE FROM libradores_lineas 
                                WHERE id = " . $id_linea . " LIMIT 1");
            if ($ajax_sys) {
                echo json_encode('ok');
            }
            break;
    }
}
