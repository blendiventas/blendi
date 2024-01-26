<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = $select_sys."<br />";

require($_SERVER['DOCUMENT_ROOT'] . "/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    /*
    CREATE TABLE `comedores` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `descripcion` VARCHAR(60) NOT NULL DEFAULT '' COLLATE 'utf8_spanish_ci',
        `principal` TINYINT(1) NOT NULL DEFAULT '0',
        `activo` TINYINT(1) NOT NULL DEFAULT '1',
        `fecha_alta` DATE NULL DEFAULT NULL,
        `fecha_modificacion` DATE NULL DEFAULT NULL,
    */
    switch ($select_sys) {
        case "guardar-completo":
            if ($principal) {
                $result = $conn->query("UPDATE comedores SET 
                        principal = '0',
                        fecha_modificacion = '" . date("Y-m-d") . "' 
                    WHERE principal = 1 LIMIT 1");
            }
            if(empty($id_comedores) || $id_comedores < 0) {
                $result = $conn->query("INSERT INTO comedores VALUES(
                                    NULL,
                                    '" . addslashes($descripcion) . "',
                                    '" . $principal . "',
                                    '" . $activo . "',
                                    '" . addslashes($orden) . "',
                                    '" . date("Y-m-d") . "',
                                    '" . date("Y-m-d") . "')");
                $id_comedores = $conn->id_insert();

                $result = $conn->query("INSERT INTO libradores VALUES(
                          NULL,
                          '',
                          'mes',
                          '',
                          '" . $id_comedores . "-1',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '1',
                          '',
                          '-1',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '1',
                          '2',
                          '',
                          '',
                          '',
                          '',
                          1, 
                          0, 
                          '', 
                          '',
                          '', 
                          '" . $id_comedores . "',
                          '', 
                          '100', 
                          '100', 
                          '133', 
                          '143',
                          '" . date('Y-m-d') . "',
                          '" . date('Y-m-d') . "')");
                $id_libradores = $conn->id_insert();
                if (empty($codigo_librador_libradores)) {
                    $result = $conn->query("UPDATE libradores SET
                            codigo_librador='" . $id_libradores . "'
                            WHERE id=" . $id_libradores . " AND tipo = 'mes' LIMIT 1");
                }
            }else {
                $result = $conn->query("UPDATE comedores SET 
                                    descripcion = '" . addslashes($descripcion) . "',
                                    principal = '" . $principal . "',
                                    activo = '" . $activo . "',
                                    orden = '" . addslashes($orden) . "',
                                    fecha_modificacion = '" . date("Y-m-d") . "' 
                                WHERE id = " . $id_comedores . " LIMIT 1");
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_comedores' => $id_comedores
                ]);
            }
            break;
        case "eliminar":
            if ($principal) {
                break;
            }
            if(empty($id_comedores) || $id_comedores < 0) {
                break;
            }else {
                $result = $conn->query("DELETE FROM libradores WHERE id_comedores = " . $id_comedores);
                $result = $conn->query("DELETE FROM libradores_lineas WHERE id_comedores = " . $id_comedores);
                $result = $conn->query("DELETE FROM comedores WHERE id = " . $id_comedores);
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_comedores' => $id_comedores
                ]);
            }
            break;
        case "guardar-descripcion":
            if(empty($id_comedores)) {
                $result = $conn->query("INSERT INTO comedores VALUES(
                                    NULL,
                                    '" . addslashes($descripcion) . "',
                                    '0',
                                    '1',
                                    '',
                                    '" . date("Y-m-d") . "',
                                    '" . date("Y-m-d") . "')");
                $id_comedores = $conn->id_insert();
            }else {
                $result = $conn->query("UPDATE comedores SET 
                                    descripcion = '" . addslashes($descripcion) . "',
                                    fecha_modificacion = '" . date("Y-m-d") . "' 
                                WHERE id = " . $id_comedores . " LIMIT 1");
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_comedores' => $id_comedores
                ]);
            }
            break;
        case "guardar-principal":
            $result = $conn->query("UPDATE comedores SET 
                                principal = '0',
                                fecha_modificacion = '" . date("Y-m-d") . "' 
                            WHERE principal = 1 LIMIT 1");
            $result = $conn->query("UPDATE comedores SET 
                                principal = '1',
                                fecha_modificacion = '" . date("Y-m-d") . "' 
                            WHERE id = " . $id_comedores . " LIMIT 1");
            break;
        case "guardar-activo":
            if($activo_comedores == 1) {
                $activo_comedores = 0;
            }else {
                $activo_comedores = 1;
            }
            $result = $conn->query("UPDATE comedores SET 
                                    activo = '" . $activo_comedores . "',
                                    fecha_modificacion = '" . date("Y-m-d") . "' 
                                WHERE id = " . $id_comedores . " AND principal=0 LIMIT 1");
            if (isset($ajax_sys)) {
                echo json_encode([
                    'activo_comedores' => $activo_comedores,
                    'fecha_modificacion' => date("Y-m-d")
                ]);
            }
            break;
    }
}
