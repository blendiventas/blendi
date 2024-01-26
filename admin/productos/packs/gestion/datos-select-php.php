<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "packs":
            $result = $conn->query("SELECT descripcion FROM productos WHERE id=" . $id_url . " LIMIT 1");
            if ($conn->registros() == 1) {
                $descripcion_productos = stripslashes($result[0]['descripcion']);
            }
            $result_productos_packs = $conn->query("SELECT * FROM productos_packs WHERE id_producto=" . $id_url . " ORDER BY orden");
            foreach ($result_productos_packs as $key_productos_packs => $valor_productos_packs) {
                $matriz_id_productos_packs[] = $valor_productos_packs['id'];
                $matriz_id_productos_detalles_enlazado_productos_packs[] = $valor_productos_packs['id_productos_detalles_enlazado'];
                $matriz_id_productos_detalles_multiple_productos_packs[] = $valor_productos_packs['id_productos_detalles_multiples'];
                $matriz_cantidad_pack_productos_packs[] = $valor_productos_packs['cantidad_pack'];
                $matriz_activo_productos_packs[] = $valor_productos_packs['activo'];
                $matriz_orden_productos_packs[] = $valor_productos_packs['orden'];
                $matriz_fecha_alta_productos_packs[] = $valor_productos_packs['fecha_alta'];
                $matriz_fecha_modificacion_productos_packs[] = $valor_productos_packs['fecha_modificacion'];
            }
            break;
        case "listado-packs":
            $result_productos_packs = $conn->query("SELECT * FROM productos_packs WHERE id_producto=" . $id_url . " ORDER BY orden");
            foreach ($result_productos_packs as $key_productos_packs => $valor_productos_packs) {
                $matriz_id_productos_packs[] = $valor_productos_packs['id'];
                $matriz_id_productos_detalles_enlazado_productos_packs[] = $valor_productos_packs['id_productos_detalles_enlazado'];
                $matriz_id_productos_detalles_multiple_productos_packs[] = $valor_productos_packs['id_productos_detalles_multiples'];
                $matriz_cantidad_pack_productos_packs[] = $valor_productos_packs['cantidad_pack'];
                $matriz_activo_productos_packs[] = $valor_productos_packs['activo'];
                $matriz_orden_productos_packs[] = $valor_productos_packs['orden'];
                $matriz_fecha_alta_productos_packs[] = $valor_productos_packs['fecha_alta'];
                $matriz_fecha_modificacion_productos_packs[] = $valor_productos_packs['fecha_modificacion'];
            }
            break;
        case "descripcion-pack":
            $descripcion_pack = "";
            $result_productos_packs = $conn->query("SELECT cantidad_pack FROM productos_packs WHERE id=" . $id_packs . " LIMIT 1");
            if($conn->registros() == 1) {
                $descripcion_pack = "Pack de ".$result_productos_packs[0]['cantidad_pack']."&nbsp;unid.";
            }
            break;
    }
}