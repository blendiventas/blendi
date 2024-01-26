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

$embalajes = $_POST['embalaje_producto_' . $elemento];
if (is_array($embalajes)) {
    foreach ($embalajes as $id_productos_embalajes) {
        $result = $conn->query("SELECT * FROM productos_embalajes WHERE id=".$id_productos_embalajes." LIMIT 1");
        if($conn->registros() == 1) {
            $datosRegistroStock = [];
            $datosRegistroStock['ejercicio'] = $ejercicio;
            $datosRegistroStock['tipo_documento'] = $tipo_documento;
            $datosRegistroStock['id_documento_1'] = $id_documento_1;
            $datosRegistroStock['id_documento_2'] = $id_documento_2;
            $datosRegistroStock['tipo_librador'] = $tipo_librador;
            $datosRegistroStock['id_librador'] = $id_librador;
            $datosRegistroStock['conn'] = $conn;
            $datosRegistroStock['id_productos_detalles_enlazado'] = 0;
            $datosRegistroStock['id_productos_detalles_multiples'] = 0;
            $datosRegistroStock['id_packs'] = 0;
            $datosRegistroStock['id_unidades'] = '';
            $datosRegistroStock['id_producto'] = $result[0]['id_producto_relacionado'];
            $datosRegistroStock['cantidad'] = $result[0]['cantidad'] * $cantidad;
            $datosRegistroStock['sumar'] = $result[0]['sumar'];
            $datosRegistroStock['coste_producto_linea'] = 0;
            $datosRegistroStock['lote_producto'] = "";
            $datosRegistroStock['caducidad_producto'] = "0000-00-00";
            $datosRegistroStock['numero_serie_producto'] = "";
            registroStock($datosRegistroStock, $decimales_cantidades, $decimales_importes, $result[0]['id_producto_relacionado'], [], true);
        }
    }
}