<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":
            /*
            CREATE TABLE `productos_images` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NULL DEFAULT '0',
                `$id_url` INT(11) NULL DEFAULT '0',
                `id_productos_detalles_multiples` INT(11) NULL DEFAULT '0',
                `id_packs` INT(11) NULL DEFAULT '0',
                `imagen` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `updated` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `alt` VARCHAR(60) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `tittle` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
            */
            $result = $conn->query("SELECT * FROM productos_images WHERE id_producto=".$id_url." AND 
                                        id_productos_detalles_enlazado=".$id_productos_detalles_enlazado_url." AND 
                                        id_productos_detalles_multiples=".$id_productos_detalles_multiples_url." AND 
                                        id_packs=".$id_packs_url." ORDER BY orden");
            foreach ($result as $key => $valor) {
                $matriz_id_productos_images[] = $valor['id'];
                $matriz_imagen_productos_images[] = stripslashes($valor['imagen']);
                $matriz_update_productos_images[] = stripslashes($valor['updated']);
                $matriz_alt_productos_images[] = stripslashes($valor['alt']);
                $matriz_tittle_productos_images[] = stripslashes($valor['tittle']);
                $matriz_activo_productos_images[] = stripslashes($valor['activo']);
            }
            break;
        case "editar-imagen":
            if(empty($id_productos_images_url)) {
                $id_productos_images_url = 0;
                $imagen_productos_images = "";
                $update_productos_images = "";
                $alt_productos_images = "";
                $tittle_productos_images = "";
                $activo_productos_images = 1;
                $orden_productos_images = "";
            }else {
                $result = $conn->query("SELECT * FROM productos_images WHERE id=".$id_productos_images_url." AND id_producto=".$id_url." AND 
                                        id_productos_detalles_enlazado=".$id_productos_detalles_enlazado_url." AND 
                                        id_productos_detalles_multiples=".$id_productos_detalles_multiples_url." AND 
                                        id_packs=".$id_packs_url." LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_productos_images_url = $valor['id'];
                    $imagen_productos_images = stripslashes($valor['imagen']);
                    $update_productos_images = stripslashes($valor['updated']);
                    $alt_productos_images = stripslashes($valor['alt']);
                    $tittle_productos_images = stripslashes($valor['tittle']);
                    $activo_productos_images = stripslashes($valor['activo']);
                    $orden_productos_images = stripslashes($valor['orden']);
                }
            }
            break;
        case "imagen-producto-encontrado":
            if(!empty($id_producto) && empty($id_enlazado) && empty($id_multiple) && empty($id_pack)) {
                $result = $conn->query("SELECT imagen,updated,alt,tittle FROM productos WHERE id=".$id_producto." LIMIT 1");
            }else {
                $result = $conn->query("SELECT imagen,updated,alt,tittle FROM productos_images WHERE 
                                    id_producto=" . $id_producto . " AND 
                                    id_productos_detalles_enlazado=" . $id_enlazado . " AND 
                                    id_productos_detalles_multiples=" . $id_multiple . " AND 
                                    id_packs=" . $id_pack . " AND 
                                    activo=1 ORDER BY orden,id LIMIT 1");
            }
            foreach ($result as $key => $valor) {
                $imagen_productos_images = stripslashes($valor['imagen']);
                $update_productos_images = stripslashes($valor['updated']);
                $alt_productos_images = stripslashes($valor['alt']);
                $tittle_productos_images = stripslashes($valor['tittle']);
            }
            break;
    }
}