<?php
/*
CREATE TABLE `documentos_2022_productos_elaborados` (
	id
	id_documentos_2
	cantidad_base
	id_unidades_base
	rentabilidad
	id_categoria_elaborados
	tiempo
	coste
	PRIMARY KEY (`id`) USING BTREE
PRIMARY KEY (`id`) USING BTREE)COLLATE='latin1_swedish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;

CREATE TABLE `documentos_2022_productos_relacionados_elaborados` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_documentos_2` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_productos_detalles_enlazado` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_productos_detalles_multiples` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_packs` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_categoria_estadisticas` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`id_producto_relacionado` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`fijo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`cantidad` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
	`coste` DOUBLE NOT NULL DEFAULT '0',
	`id_unidad` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`sumar` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
	`mostrar` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
PRIMARY KEY (`id`) USING BTREE,INDEX `indice` (`id_documentos_2`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;
*/

if (!isset($id_producto_anadir)) {
    $id_producto_anadir = $id_producto;
}

$coste_producto_relacionado_elaborado = 0;
$result = $conn->query("SELECT * FROM productos_relacionados_elaborados WHERE id_producto='".$id_producto_anadir."'");
if($conn->registros() >= 1) {
    for ($i = 0; $i < count($result); $i++) {
        $result_incre = $conn->query("SELECT * FROM productos_relacionados_elaborados_incre WHERE id_producto_rel=" . $result[$i]['id'] . " AND id_tarifa = " . $id_tarifa_web . " LIMIT 1");
        $sumar = 0;
        if ($conn->registros() >= 1) {
            $sumar = $result_incre[0]['sumar'];
        }
        $result_insert = $conn->query("INSERT INTO documentos_" . $ejercicio . "_productos_relacionados_elaborados VALUES(
            NULL,
            '" . $id_documento_2 . "',
            '" . $result[$i]['id_productos_detalles_enlazado'] . "',
            '" . $result[$i]['id_productos_detalles_multiples'] . "',
            '" . $result[$i]['id_packs'] . "',
            '" . $result[$i]['id_categoria_estadisticas'] . "',
            '" . $result[$i]['id_producto_relacionado'] . "',
            '" . $result[$i]['fijo'] . "',
            '" . $result[$i]['cantidad'] * $cantidad . "',
            '" . $coste_producto_relacionado_elaborado . "',
            '" . $result[$i]['id_unidad'] . "',
            '" . $sumar . "',
            '" . $result[$i]['mostrar'] . "',
            '" . $result[$i]['orden'] . "')");

        $insertarStock = true;
        if (!empty($lote_producto) && !empty($id_producto_anadir)) {
            $result_sku_stock = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_productos_sku_stock WHERE id_producto=" . $id_producto_anadir . " AND lote = '" . addslashes($lote_producto) . "' LIMIT 1");

            if ($conn->registros() >= 1 && $result_sku_stock[0]['tipo_documento'] == 'ela') {
                $insertarStock = false;
            }
        }

        if ($insertarStock) {
            $datosRegistroStock = [];
            $datosRegistroStock['ejercicio'] = $ejercicio;
            $datosRegistroStock['tipo_documento'] = $tipo_documento;
            $datosRegistroStock['id_documento_1'] = $id_documento_1;
            $datosRegistroStock['id_documento_2'] = $id_documento_2;
            $datosRegistroStock['tipo_librador'] = $tipo_librador;
            $datosRegistroStock['id_librador'] = $id_librador;
            $datosRegistroStock['conn'] = $conn;
            $datosRegistroStock['id_productos_detalles_enlazado'] = $result[$i]['id_productos_detalles_enlazado'];
            $datosRegistroStock['id_productos_detalles_multiples'] = $result[$i]['id_productos_detalles_multiples'];
            $datosRegistroStock['id_packs'] = $result[$i]['id_packs'];
            $datosRegistroStock['id_unidades'] = $result[$i]['id_unidad'];
            $datosRegistroStock['id_producto'] = $result[$i]['id_producto_relacionado'];
            $datosRegistroStock['cantidad'] = $result[$i]['cantidad'] * $cantidad;
            $datosRegistroStock['importe'] = $sumar / (1 + ($iva_aplicar / 100));
            $datosRegistroStock['coste_producto_linea'] = 0;
            $datosRegistroStock['lote_producto'] = "";
            $datosRegistroStock['caducidad_producto'] = "0000-00-00";
            $datosRegistroStock['numero_serie_producto'] = "";
            registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $result[$i]['id_producto_relacionado'], [], true);
        }
    }
}