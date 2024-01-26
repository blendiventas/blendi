<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-grupos":
            if (!isset($parametro_pagina)) {
                $parametro_pagina = 0;
            }
            if (!isset($parametro_resultados)) {
                $parametro_resultados = 10;
            }

            $whereBusqueda = '';
            if (isset($parametro_busqueda) && !empty($parametro_busqueda)) {
                $whereBusqueda .= " AND (descripcion LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM productos_relacionados_grupos WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT id,descripcion FROM productos_relacionados_grupos WHERE id_idioma=".$id_idioma_sys." ORDER BY orden LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_productos_grupos[] = $valor['id'];
                $matriz_descripcion_productos_grupos[] = stripslashes($valor['descripcion']);
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_productos_grupos' => $matriz_id_productos_grupos,
                    'matriz_descripcion_productos_grupos' => $matriz_descripcion_productos_grupos
                ]);
            }
            break;
        case "editar-ficha":
            /*
            CREATE TABLE `productos_grupos` (
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_idioma` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `descripcion` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            PRIMARY KEY (`id`) USING BTREE,INDEX `indice` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;
            */
            if(empty($id_url)) {
                $id_productos_grupos = 0;
                $id_idioma_productos_grupos = $id_idioma_sys;
                $descripcion_productos_grupos = "";
                $orden_productos_grupos = "";
            }else {
                $result_productos_detalles = $conn->query("SELECT * FROM productos_relacionados_grupos WHERE id=".$id_url." LIMIT 1");
                if($conn->registros() == 1) {
                    $id_productos_grupos = $result_productos_detalles[0]['id'];
                    $id_idioma_productos_grupos = $result_productos_detalles[0]['id_idioma'];
                    $descripcion_productos_grupos = stripslashes($result_productos_detalles[0]['descripcion']);
                    $orden_productos_grupos = stripslashes($result_productos_detalles[0]['orden']);

                }

            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_productos_grupos' => $id_productos_grupos,
                    'id_idioma_productos_grupos' => $id_idioma_productos_grupos,
                    'descripcion_productos_grupos' => $descripcion_productos_grupos,
                    'orden_productos_grupos' => $orden_productos_grupos
                ]);
            }
            break;
    }
}