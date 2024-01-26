<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $logs_sys->Select_estado = "SELECT activo FROM productos_detalles WHERE id=" . $id_productos_detalles_url . " LIMIT 1";
            $result = $conn->query("SELECT activo FROM productos_detalles WHERE id=" . $id_productos_detalles_url . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE productos_detalles SET activo=" . $valor_sys . " WHERE id=" . $id_productos_detalles_url . " LIMIT 1");
            $logs_sys->Update_estado = "UPDATE productos_detalles SET activo=" . $valor_sys . " WHERE id=" . $id_productos_detalles_url . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "estado_datos":
            $logs_sys->Select_estado = "SELECT activo FROM productos_detalles_datos WHERE id=" . $id_productos_detalles_url . " LIMIT 1";
            $result = $conn->query("SELECT activo FROM productos_detalles_datos WHERE id=" . $id_productos_detalles_url . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE productos_detalles_datos SET activo=" . $valor_sys . " WHERE id=" . $id_productos_detalles_url . " LIMIT 1");
            $logs_sys->Update_estado = "UPDATE productos_detalles_datos SET activo=" . $valor_sys . " WHERE id=" . $id_productos_detalles_url . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "estado-atributo-enlazado":
            /*
            CREATE TABLE `productos_detalles_enlazado` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_principal` INT(11) NOT NULL DEFAULT '0',
                `id_dato_principal` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_enlazado` INT(11) NOT NULL DEFAULT '0',
                `id_dato_enlazado` INT(11) NOT NULL DEFAULT '0',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `fecha_alta` DATE NOT NULL,
                `fecha_modificacion` DATE NOT NULL,
                PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC;
            */
            $logs_sys->Select_estado = "SELECT activo FROM productos_detalles_enlazado WHERE id=" . $id_productos_detalles_relacion_url . " LIMIT 1";
            $result = $conn->query("SELECT activo FROM productos_detalles_enlazado WHERE id=" . $id_productos_detalles_relacion_url . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE productos_detalles_enlazado SET activo=" . $valor_sys . " WHERE id=" . $id_productos_detalles_relacion_url . " LIMIT 1");
            $logs_sys->Update_estado = "UPDATE productos_detalles_enlazado SET activo=" . $valor_sys . " WHERE id=" . $id_productos_detalles_relacion_url . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar-datos":
            if (empty($id_productos_detalles_datos_url)) {
                if (!empty($detalle_productos_detalles_datos)) {
                    $logs_sys->Insert = "INSERT INTO productos_detalles_datos VALUES(
                                    NULL,
                                    '" . $id_productos_detalles_url . "',
                                    '" . addslashes($detalle_productos_detalles_datos) . "',
                                    '" . addslashes($orden_productos_detalles_datos) . "',
                                    '" . $activo_productos_detalles_datos . "')<br />";

                    $result_insert = $conn->query("INSERT INTO productos_detalles_datos VALUES(
                                    NULL,
                                    '" . $id_productos_detalles_url . "',
                                    '" . addslashes($detalle_productos_detalles_datos) . "',
                                    '" . addslashes($orden_productos_detalles_datos) . "',
                                    '" . $activo_productos_detalles_datos . "')");

                    $id_productos_detalles_datos_url = $conn->id_insert();
                    $resultado_sys = "INSERT";
                } else {
                    $id_productos_detalles_datos_url = 0;
                    $resultado_sys = "INSERT ERROR descripcion";
                }
            } else {
                if (empty($apartado_url) or $apartado_url == "null") {
                    $logs_sys->Update = "UPDATE productos_detalles_datos SET detalle='" . addslashes($detalle_productos_detalles_datos) . "',orden='" . addslashes($orden_productos_detalles_datos) . "', activo='" . $activo_productos_detalles_datos . "' WHERE id=" . $id_productos_detalles_datos_url . " LIMIT 1<br />";
                    $result = $conn->query("UPDATE productos_detalles_datos SET
                        detalle='" . addslashes($detalle_productos_detalles_datos) . "',
                        orden='" . addslashes($orden_productos_detalles_datos) . "', 
                        activo='" . $activo_productos_detalles_datos . "' 
                        WHERE id=" . $id_productos_detalles_datos_url . " LIMIT 1");

                    $resultado_sys = "UPDATE";
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "eliminar-datos":
            $logs_sys->Delete = "DELETE FROM productos_detalles_datos WHERE id=" . $id_productos_detalles_datos_url . " LIMIT 1<br />";
            $result = $conn->query("DELETE FROM productos_detalles_datos WHERE id=" . $id_productos_detalles_datos_url . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardarAtributoEnlazado":
            $logs_sys->datos_logs1 = "guardarAtributoEnlazado";
            /*
            $id_atributo_principal = $_POST['id_atributo_principal'];
            $id_atributo_enlazado = $_POST['id_atributo_enlazado'];
            $atributos_principales = $_POST['atributos_principales']; // matriz
            $atributos_enlazados = $_POST['atributos_enlazados']; // matriz
            CREATE TABLE `productos_detalles_enlazado` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_principal` INT(11) NOT NULL DEFAULT '0',
                `id_dato_principal` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_enlazado` INT(11) NOT NULL DEFAULT '0',
                `id_dato_enlazado` INT(11) NOT NULL DEFAULT '0',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `fecha_alta` DATE NOT NULL,
                `fecha_modificacion` DATE NOT NULL,
                PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC;
            (5)(6)-(14)(15)(17)(21)(22)
            */
            foreach ($atributos_principales as $key_atributos_principales => $valor_atributos_principales) {
                foreach ($atributos_enlazados as $key_atributos_enlazados => $valor_atributos_enlazados) {
                    $result_insert = $conn->query("INSERT INTO productos_detalles_enlazado VALUES(
                                    NULL,
                                    '" . $id_url . "',
                                    '" . $id_atributo_principal . "',
                                    '" . $valor_atributos_principales . "',
                                    '" . $id_atributo_enlazado . "',
                                    '" . $valor_atributos_enlazados . "',
                                    '1',
                                    '" . date("Y-m-d") . "','" . date("Y-m-d") . "')");

                    $id_detalles_enlazado = $conn->id_insert();
                    $id_packs = 0;
                    $cantidad_pack = 0;
                    $id_producto = $id_url;
                    $id_detalles_multiples = 0;
                    $select_sys = "copiar-pvp";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/pvp/gestion/datos-update-php.php");
                }
            }
            $resultado_sys = "INSERT";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys,
                    'id_producto' => $id_url
                ]);
            }
            break;
        case "guardarAtributoVertical":
            $logs_sys->datos_logs1 = "guardarAtributoVertical";
            /*
            $id_atributo_principal = $_POST['id_atributo_principal'];
            $id_atributo_enlazado = $_POST['id_atributo_enlazado'];
            $atributos_principales = $_POST['atributos_principales']; // matriz
            $atributos_enlazados = $_POST['atributos_enlazados']; // matriz
            CREATE TABLE `productos_detalles_enlazado` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_principal` INT(11) NOT NULL DEFAULT '0',
                `id_dato_principal` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_enlazado` INT(11) NOT NULL DEFAULT '0',
                `id_dato_enlazado` INT(11) NOT NULL DEFAULT '0',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `fecha_alta` DATE NOT NULL,
                `fecha_modificacion` DATE NOT NULL,
                PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC;
            (5)(6)-(14)(15)(17)(21)(22)
            */
            $result_insert = $conn->query("SELECT id_atributo_enlazado,id_dato_enlazado FROM productos_detalles_enlazado 
                    WHERE id_producto=" . $id_url . " GROUP BY id_dato_enlazado");
            foreach ($atributos_principales as $key_atributos_principales => $valor_atributos_principales) {
                foreach ($result_insert as $key_atributos_enlazados => $valor_atributos_enlazados) {
                    $result_insert = $conn->query("INSERT INTO productos_detalles_enlazado VALUES(
                                    NULL,
                                    '" . $id_url . "',
                                    '" . $id_atributo_principal . "',
                                    '" . $valor_atributos_principales . "',
                                    '" . $valor_atributos_enlazados['id_atributo_enlazado'] . "',
                                    '" . $valor_atributos_enlazados['id_dato_enlazado'] . "',
                                    '1',
                                    '" . date("Y-m-d") . "','" . date("Y-m-d") . "')");

                    $id_detalles_enlazado = $conn->id_insert();
                    $id_packs = 0;
                    $cantidad_pack = 0;
                    $id_producto = $id_url;
                    $id_detalles_multiples = 0;
                    $select_sys = "copiar-pvp";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/pvp/gestion/datos-update-php.php");
                }
            }
            $resultado_sys = "INSERT";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys,
                    'id_producto' => $id_url
                ]);
            }
            break;
        case "guardarAtributoHorizontal":
            $logs_sys->datos_logs1 = "guardarAtributoVertical";
            /*
            $id_atributo_principal = $_POST['id_atributo_principal'];
            $id_atributo_enlazado = $_POST['id_atributo_enlazado'];
            $atributos_principales = $_POST['atributos_principales']; // matriz
            $atributos_enlazados = $_POST['atributos_enlazados']; // matriz
            CREATE TABLE `productos_detalles_enlazado` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_principal` INT(11) NOT NULL DEFAULT '0',
                `id_dato_principal` INT(11) NOT NULL DEFAULT '0',
                `id_atributo_enlazado` INT(11) NOT NULL DEFAULT '0',
                `id_dato_enlazado` INT(11) NOT NULL DEFAULT '0',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `fecha_alta` DATE NOT NULL,
                `fecha_modificacion` DATE NOT NULL,
                PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC;
            (5)(6)-(14)(15)(17)(21)(22)
            */
            $result_insert = $conn->query("SELECT id_atributo_principal,id_dato_principal FROM productos_detalles_enlazado 
                    WHERE id_producto=" . $id_url . " GROUP BY id_dato_principal");
            foreach ($result_insert as $key_atributos_principales => $valor_atributos_principales) {
                foreach ($atributos_enlazados as $key_atributos_enlazados => $valor_atributos_enlazados) {
                    $result_insert = $conn->query("INSERT INTO productos_detalles_enlazado VALUES(
                                    NULL,
                                    '" . $id_url . "',
                                    '" . $valor_atributos_principales['id_atributo_principal'] . "',
                                    '" . $valor_atributos_principales['id_dato_principal'] . "',
                                    '" . $id_atributo_enlazado . "',
                                    '" . $valor_atributos_enlazados . "',
                                    '1',
                                    '" . date("Y-m-d") . "','" . date("Y-m-d") . "')");

                    $id_detalles_enlazado = $conn->id_insert();
                    $id_packs = 0;
                    $cantidad_pack = 0;
                    $id_producto = $id_url;
                    $id_detalles_multiples = 0;
                    $select_sys = "copiar-pvp";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/pvp/gestion/datos-update-php.php");
                }
            }
            $resultado_sys = "INSERT";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys,
                    'id_producto' => $id_url
                ]);
            }
            break;
        case "guardarAtributoMultiple":
            $logs_sys->datos_logs1 = "guardarAtributoMultiple";
            /*
            $id_atributo_multiple = $_POST['id_atributo_multiple'];
            $atributos_multiples = $_POST['atributos_multiples'];
            CREATE TABLE `productos_detalles_multiples` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `id_producto` INT(11) NOT NULL DEFAULT '0',
                `id_atributo` INT(11) NOT NULL DEFAULT '0',
                `id_dato` INT(11) NOT NULL DEFAULT '0',
                `activo` TINYINT(1) NOT NULL DEFAULT '1',
                `fecha_alta` DATE NOT NULL,
                `fecha_modificacion` DATE NOT NULL,
                PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC;
            (5)(6)-(14)(15)(17)(21)(22)
            */
            $atributos_existentes = false;
            $result_select = $conn->query("SELECT * FROM productos_detalles_multiples WHERE id_producto=" . $id_url . " ORDER BY id");
            if ($conn->registros() >= 1) {
                $atributos_existentes = true;
                foreach ($result_select as $key_select => $valor_select) {
                    $existe = false;
                    foreach ($atributos_multiples as $key_atributos_multiples => $valor_atributos_multiples) {
                        if ($valor_select['id_dato'] == $valor_atributos_multiples) {
                            $existe = true;
                            break;
                        }
                    }
                    if ($existe == false) {
                        $result_update = $conn->query("UPDATE productos_detalles_multiples SET activo=0 WHERE id=" . $valor_select['id'] . " LIMIT 1");
                    }
                }
            }
            foreach ($atributos_multiples as $key_atributos_multiples => $valor_atributos_multiples) {
                $insert = true;
                if ($atributos_existentes == true) {
                    foreach ($result_select as $key_select => $valor_select) {
                        if ($valor_select['id_dato'] == $valor_atributos_multiples) {
                            $insert = false;
                            $id_update = $valor_select['id'];
                            break;
                        }
                    }
                }
                if ($insert == true) {
                    $result_insert = $conn->query("INSERT INTO productos_detalles_multiples VALUES(
                                NULL,
                                '" . $id_url . "',
                                '" . $id_atributo_multiple . "',
                                '" . $valor_atributos_multiples . "',
                                '1',
                                '" . date("Y-m-d") . "','" . date("Y-m-d") . "')");
                    $id_detalles_multiples = $conn->id_insert();
                    $id_packs = 0;
                    $cantidad_pack = 0;
                    $id_producto = $id_url;
                    $id_detalles_enlazado = 0;
                    $select_sys = "copiar-pvp";
                    require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/pvp/gestion/datos-update-php.php");
                } else {
                    $result_update = $conn->query("UPDATE productos_detalles_multiples SET activo=1 WHERE id=" . $id_update . " LIMIT 1");
                }
            }
            $resultado_sys = "INSERT";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys,
                    'id_producto' => $id_url
                ]);
            }
            break;
        case "guardarAtributoUnico":
            $logs_sys->datos_logs1 = "guardarAtributoUnico";
            /*
            $id_atributo_unico = $_POST['id_atributo_unico'];
            $atributo_unico = $_POST['atributo_unico'];
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
            $id_update = 0;
            $logs_sys->datos_logs1 = "SELECT * FROM productos_detalles_unicos WHERE id_producto=" . $id_url . " AND id_atributo=" . $id_atributo_unico . " LIMIT 1";
            $result_select = $conn->query("SELECT * FROM productos_detalles_unicos WHERE id_producto=" . $id_url . " AND id_atributo=" . $id_atributo_unico . " LIMIT 1");
            if ($conn->registros() == 1) {
                $id_update = $result_select[0]['id'];
            }
            if(empty($id_update)) {
                $logs_sys->datos_insert = "INSERT INTO productos_detalles_unicos VALUES(NULL,'" . $id_url . "','" . $id_atributo_unico . "','" . $atributo_unico . "','1','" . date("Y-m-d") . "','" . date("Y-m-d") . "')";
                $result_insert = $conn->query("INSERT INTO productos_detalles_unicos VALUES(
                            NULL,
                            '" . $id_url . "',
                            '" . $id_atributo_unico . "',
                            '" . $atributo_unico . "',
                            '1',
                            '" . date("Y-m-d") . "','" . date("Y-m-d") . "')");
            }else {
                $logs_sys->datos_update = "UPDATE productos_detalles_unicos SET id_dato=".$atributo_unico." WHERE id=".$id_update." LIMIT 1";
                $result_update = $conn->query("UPDATE productos_detalles_unicos SET id_dato=".$atributo_unico." WHERE id=".$id_update." LIMIT 1");
            }
            $resultado_sys = "INSERT";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys,
                    'id_producto' => $id_url
                ]);
            }
            break;
        case "eliminarAtributoUnico":
            $logs_sys->datos_logs1 = "eliminarAtributoUnico";
            /*
            $id_atributo_unico = $_POST['id_atributo_unico'];
            $atributo_unico = $_POST['atributo_unico'];
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
            $logs_sys->datos_logs1 = "DELETE FROM productos_detalles_unicos WHERE id_producto=" . $id_url . " AND id_atributo=" . $id_atributo_unico . " LIMIT 1";
            $result_delete = $conn->query("DELETE FROM productos_detalles_unicos WHERE id_producto=" . $id_url . " AND id_atributo=" . $id_atributo_unico . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys,
                    'id_producto' => $id_url
                ]);
            }
            break;
    }
}