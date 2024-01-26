<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "proveedores":
            $result_proveedores = $conn->query("SELECT id,nombre_comercial FROM proveedores WHERE activo=1 ORDER BY nombre_comercial");
            foreach ($result_proveedores as $key_proveedores => $valor_proveedores) {
                $matriz_id_proveedores[] = $valor_proveedores['id'];
                $matriz_descripcion_proveedores[] = stripslashes($valor_proveedores['descripcion']);
            }
            break;
        case "nombre-proveedor":
            $nombre_proveedor = "";
            $result_proveedores = $conn->query("SELECT nombre_comercial FROM proveedores WHERE id=".$id_proveedor." LIMIT 1");
            if($conn->registros() == 1) {
                $nombre_proveedor = stripslashes($result_proveedores[0]['nombre_comercial']);
            }
            break;
    }
}