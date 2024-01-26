<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(isset($acceso_correcto_sys) && $acceso_correcto_sys) {
    switch ($select_sys) {
        case "subir-imagen":
            $result = $conn->query("UPDATE datos_empresa SET logo='" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "', updated='" . $updated_sys . "' WHERE id=" . $id_sys . " LIMIT 1");
            break;
    }
}