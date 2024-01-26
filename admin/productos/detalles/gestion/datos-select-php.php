<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":
            /*
            CREATE TABLE `productos_detalles` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_idioma` INT(11) NOT NULL DEFAULT '0',
                `detalle` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
            */
            $result_productos_detalles = $conn->query("SELECT id,detalle,activo FROM productos_detalles WHERE id_idioma=" . $id_idioma_sys . " ORDER BY orden");
            foreach ($result_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
                $matriz_id_productos_detalles[] = $valor_productos_detalles['id'];
                $matriz_detalle_productos_detalles[] = stripslashes($valor_productos_detalles['detalle']);
                $matriz_activo_productos_detalles[] = $valor_productos_detalles['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_productos_detalles' => $matriz_id_productos_detalles,
                    'matriz_detalle_productos_detalles' => $matriz_detalle_productos_detalles,
                    'matriz_activo_productos_detalles' => $matriz_activo_productos_detalles
                ]);
            }
            break;
        case "detalle-de":
            $result = $conn->query("SELECT detalle FROM productos_detalles WHERE id=" . $de_sys . " LIMIT 1");
            if ($conn->registros() == 1) {
                $detalle_de_productos_detalles = stripslashes($result[0]['detalle']);
            }
            if (isset($ajax)) {
                echo json_encode([
                    'logs' => $matriz_logs_sys,
                    'detalle_de_productos_detalles' => $detalle_de_productos_detalles
                ]);
            }
            break;
        case "dato-de":
            $result = $conn->query("SELECT detalle FROM productos_detalles_datos WHERE id=" . $de_sys . " LIMIT 1");
            if ($conn->registros() == 1) {
                $dato_de_productos_detalles = stripslashes($result[0]['detalle']);
            }
            if (isset($ajax)) {
                echo json_encode([
                    'logs' => $matriz_logs_sys,
                    'dato_de_productos_detalles' => $dato_de_productos_detalles
                ]);
            }
            break;
        case "detalle-ficha":
            $result = $conn->query("SELECT id,detalle,activo FROM productos_detalles WHERE id=" . $de_sys . " LIMIT 1");
            if ($conn->registros() == 1) {
                $id_productos_detalles = $result[0]['id'];
                $detalle_productos_detalles = stripslashes($result[0]['detalle']);
                $activo_productos_detalles = $result[0]['activo'];
            }
            break;
        case "listado-filtrado-detalles":
            if(empty($id_productos_detalles_url)) {
                $result_productos_detalles = $conn->query("SELECT id,detalle FROM productos_detalles WHERE id_idioma=" . $id_idioma_sys . " AND activo=1 ORDER BY orden");
            }else {
                $result_productos_detalles = $conn->query("SELECT id,detalle FROM productos_detalles WHERE id_idioma=" . $id_idioma_sys . " AND id<>'" . $id_productos_detalles_url . "' AND activo=1 ORDER BY orden");
            }
            foreach ($result_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
                $matriz_id_productos_detalles[] = $valor_productos_detalles['id'];
                $matriz_detalle_productos_detalles[] = stripslashes($valor_productos_detalles['detalle']);
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_productos_detalles' => $matriz_id_productos_detalles,
                    'matriz_detalle_productos_detalles' => $matriz_detalle_productos_detalles
                ]);
            }
            break;
        case "listado-filtrado-datos":
            $result_productos_detalles_datos = $conn->query("SELECT id,detalle,orden,activo FROM productos_detalles_datos WHERE id_productos_detalles=" . $id_productos_detalles_url . " ORDER BY orden");
            foreach ($result_productos_detalles_datos as $key_productos_detalles_datos => $valor_productos_detalles_datos) {
                $matriz_id_productos_detalles_datos[] = $valor_productos_detalles_datos['id'];
                $matriz_detalle_productos_detalles_datos[] = stripslashes($valor_productos_detalles_datos['detalle']);
                $matriz_orden_productos_detalles_datos[] = stripslashes($valor_productos_detalles_datos['orden']);
                $matriz_activo_productos_detalles_datos[] = $valor_productos_detalles_datos['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_productos_detalles_datos' => $matriz_id_productos_detalles_datos,
                    'matriz_detalle_productos_detalles_datos' => $matriz_detalle_productos_detalles_datos,
                    'matriz_orden_productos_detalles_datos' => $matriz_orden_productos_detalles_datos,
                    'matriz_activo_productos_detalles_datos' => $matriz_activo_productos_detalles_datos
                ]);
            }
            break;
        case "listado_relaciones_producto":
            $result_productos_detalles_relacion = $conn->query("SELECT * FROM productos_detalles_enlazado WHERE id_producto=" . $id_url." ORDER BY id");
            foreach ($result_productos_detalles_relacion as $key_productos_detalles_relacion => $valor_productos_detalles_relacion) {
                $matriz_productos_detalles_relacion_id[] = $valor_productos_detalles_relacion['id'];
                $matriz_productos_detalles_relacion_id_atributo_principal[] = $valor_productos_detalles_relacion['id_atributo_principal'];
                $matriz_productos_detalles_relacion_id_dato_principal[] = $valor_productos_detalles_relacion['id_dato_principal'];
                $matriz_productos_detalles_relacion_id_atributo_enlazado[] = $valor_productos_detalles_relacion['id_atributo_enlazado'];
                $matriz_productos_detalles_relacion_id_dato_enlazado[] = $valor_productos_detalles_relacion['id_dato_enlazado'];
                $matriz_productos_detalles_relacion_activo[] = $valor_productos_detalles_relacion['activo'];
            }
            break;
        case "listado_atributos_multiples":
            $result_productos_detalles_multiples = $conn->query("SELECT id,id_atributo,id_dato,activo FROM productos_detalles_multiples WHERE id_producto=" . $id_url." ORDER BY id");
            foreach ($result_productos_detalles_multiples as $key_productos_detalles_multiples => $valor_productos_detalles_multiples) {
                $matriz_productos_detalles_multiples_id[] = $valor_productos_detalles_multiples['id'];
                $productos_detalles_multiples_id_atributo = $valor_productos_detalles_multiples['id_atributo'];
                $matriz_productos_detalles_multiples_id_dato[] = $valor_productos_detalles_multiples['id_dato'];
                $matriz_productos_detalles_multiples_activo[] = $valor_productos_detalles_multiples['activo'];
            }
            break;
        case "listado_atributos_unicos":
            /*
            CREATE TABLE `productos_detalles_unicos` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_atributo` INT(11) NOT NULL DEFAULT '0',
                `id_dato` INT(11) NOT NULL DEFAULT '0',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `fecha_alta` DATE NOT NULL,
                `fecha_modificacion` DATE NOT NULL,
                PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;
            */
            $result_productos_detalles_unicos = $conn->query("SELECT id_atributo,id_dato,activo FROM productos_detalles_unicos WHERE id_producto=" . $id_url." ORDER BY id_atributo");
            foreach ($result_productos_detalles_unicos as $key_productos_detalles_unicos => $valor_productos_detalles_unicos) {
                $matriz_productos_detalles_unicos_id_atributo[] = $valor_productos_detalles_unicos['id_atributo'];
                $matriz_productos_detalles_unicos_id_dato[] = $valor_productos_detalles_unicos['id_dato'];
                $matriz_productos_detalles_unicos_activo[] = $valor_productos_detalles_unicos['activo'];
            }
            break;
        case "listado_productos_relacion_datos":
            $result_productos_detalles_relacion = $conn->query("SELECT 
                id,de_id_datos,id_productos_detalles,id_productos_detalles_datos 
                FROM productos_detalles_relacion_datos 
                WHERE id_productos_detalles_relacion=" . $id_productos_detalles_relacion." ORDER BY de_id_datos,id_productos_detalles_datos");
            //ORDER BY (abans) de_id_datos,id
            //id_productos_detalles,id_productos_detalles_datos
            foreach ($result_productos_detalles_relacion as $key_productos_detalles_relacion => $valor_productos_detalles_relacion) {
                $matriz_productos_detalles_relacion_datos_de_id[] = $valor_productos_detalles_relacion['id'];
                $matriz_productos_detalles_relacion_datos_de_de_id[] = $valor_productos_detalles_relacion['de_id_datos'];
                $matriz_productos_detalles_relacion_datos_de_id_productos_detalles[] = $valor_productos_detalles_relacion['id_productos_detalles'];
                $matriz_productos_detalles_relacion_datos_de_id_productos_detalles_datos[] = $valor_productos_detalles_relacion['id_productos_detalles_datos'];
            }
            break;
        case "editar-ficha":
            if(empty($id_productos_detalles_url)) {
                $id_productos_detalles = 0;
                $id_idioma_productos_detalles = $id_idioma_sys;
                $detalle_productos_detalles = "";
                $orden_productos_detalles = "";
                $activo_productos_detalles = 1;
            }else {
                $result_productos_detalles = $conn->query("SELECT * FROM productos_detalles WHERE id=".$id_productos_detalles_url." LIMIT 1");
                if($conn->registros() == 1) {
                    $id_productos_detalles = $result_productos_detalles[0]['id'];
                    $id_idioma_productos_detalles = $result_productos_detalles[0]['id_idioma'];
                    $detalle_productos_detalles = stripslashes($result_productos_detalles[0]['detalle']);
                    $orden_productos_detalles = $result_productos_detalles[0]['orden'];
                    $activo_productos_detalles = $result_productos_detalles[0]['activo'];

                }

            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_productos_detalles' => $id_productos_detalles,
                    'id_idioma_productos_detalles' => $id_idioma_productos_detalles,
                    'detalle_productos_detalles' => $detalle_productos_detalles,
                    'orden_productos_detalles' => $orden_productos_detalles,
                    'activo_productos_detalles' => $activo_productos_detalles
                ]);
            }
            break;
        case "detalles-ficha-producto":
            $result_productos_detalles = $conn->query("SELECT * FROM productos_detalles WHERE id=".$id_productos_detalles_url." LIMIT 1");
            if($conn->registros() == 1) {
                $id_productos_detalles = $result_productos_detalles[0]['id'];
                $id_idioma_productos_detalles = $result_productos_detalles[0]['id_idioma'];
                $detalle_productos_detalles = stripslashes($result_productos_detalles[0]['detalle']);
                $orden_productos_detalles = $result_productos_detalles[0]['orden'];
                $activo_productos_detalles = $result_productos_detalles[0]['activo'];
                $result_productos_detalles_datos = $conn->query("SELECT * FROM productos_detalles_datos WHERE id_productos_detalles=".$id_productos_detalles_url." ORDER BY orden");
                if($conn->registros() == 1) {
                    foreach ($result_productos_detalles_datos as $key_productos_detalles_datos => $valor_productos_detalles_datos) {
                        $matriz_id_productos_detalles_datos[] = $valor_productos_detalles_datos['id'];
                        $matriz_detalle_productos_detalles_datos[] = stripslashes($valor_productos_detalles_datos['detalle']);
                    }
                }
            }else {
                $id_productos_detalles = 0;
                $id_idioma_productos_detalles = $id_idioma_sys;
                $detalle_productos_detalles = "";
                $orden_productos_detalles = "";
                $activo_productos_detalles = 1;
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_productos_detalles' => $id_productos_detalles,
                    'id_idioma_productos_detalles' => $id_idioma_productos_detalles,
                    'detalle_productos_detalles' => $detalle_productos_detalles,
                    'orden_productos_detalles' => $orden_productos_detalles,
                    'activo_productos_detalles' => $activo_productos_detalles,
                    'matriz_id_productos_detalles_datos' => $matriz_id_productos_detalles_datos,
                    'matriz_detalle_productos_detalles_datos' => $matriz_detalle_productos_detalles_datos
                ]);
            }
            break;
        case "descripcion_enlazado":
            $descripcion_productos_detalles_enlazado = "";
            $result_productos_detalles_relacion = $conn->query("SELECT * FROM productos_detalles_enlazado WHERE id=" . $id_productos_detalles_enlazado." LIMIT 1");
            if($conn->registros() == 1) {
                $de_sys = $result_productos_detalles_relacion[0]['id_atributo_principal'];
                $select_sys = "detalle-de";
                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
                $descripcion_productos_detalles_enlazado = $detalle_de_productos_detalles.": ";
                $de_sys = $result_productos_detalles_relacion[0]['id_dato_principal'];
                $select_sys = "dato-de";
                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
                $descripcion_productos_detalles_enlazado .= $dato_de_productos_detalles;
                $de_sys = $result_productos_detalles_relacion[0]['id_atributo_enlazado'];
                $select_sys = "detalle-de";
                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
                $descripcion_productos_detalles_enlazado .= " / ".$detalle_de_productos_detalles.": ";
                $de_sys = $result_productos_detalles_relacion[0]['id_dato_enlazado'];
                $select_sys = "dato-de";
                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
                $descripcion_productos_detalles_enlazado .= $dato_de_productos_detalles;
            }
            break;
        case "descripcion_multiple":
            $descripcion_productos_detalles_multiples = "";
            $result_productos_detalles_relacion = $conn->query("SELECT * FROM productos_detalles_multiples WHERE id=" . $id_productos_detalles_multiples." LIMIT 1");
            if($conn->registros() == 1) {
                $de_sys = $result_productos_detalles_relacion[0]['id_atributo'];
                $select_sys = "detalle-de";
                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
                $descripcion_productos_detalles_multiples = $detalle_de_productos_detalles.": ";
                $de_sys = $result_productos_detalles_relacion[0]['id_dato'];
                $select_sys = "dato-de";
                require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
                $descripcion_productos_detalles_multiples .= $dato_de_productos_detalles;
            }
            break;
    }
}