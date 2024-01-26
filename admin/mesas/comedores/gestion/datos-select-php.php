<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "editar-ficha":
            if(empty($id_comedor)) {
                $descripcion_libradores_modalidades_envio = '';
                $explicacion_libradores_modalidades_envio = '';
            }else {
                $result = $conn->query("SELECT * FROM comedores WHERE id=" . $id_comedor . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $descripcion = $valor['descripcion'];
                    $principal = $valor['principal'];
                    $activo = $valor['activo'];
                    $orden = $valor['orden'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_comedor' => $id_comedor,
                    'descripcion' => $descripcion,
                    'principal' => $principal,
                    'activo' => $activo,
                    'orden' => $orden,
                ]);
            }
            break;
    }
}