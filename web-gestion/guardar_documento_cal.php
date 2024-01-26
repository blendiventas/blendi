<?php
/*
    CREATE TABLE `documentos_2022_1` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_sesion` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
        `ip` VARCHAR(15) NOT NULL COLLATE 'utf8_spanish_ci',
        `so` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
        `tipo_documento` VARCHAR(3) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        `procedencia` VARCHAR(3) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        `tipo_librador` VARCHAR(3) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        `id_librador` INT(11) NULL DEFAULT NULL,
        `fecha_documento` DATE NULL DEFAULT NULL,
        `fecha_entrada` DATE NULL DEFAULT NULL,
        `fecha_entrega_desde` DATE NULL DEFAULT NULL,
        `fecha_entrega_hasta` DATE NULL DEFAULT NULL,
        `numero_documento` VARCHAR(25) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        `serie_documento` VARCHAR(5) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        `modalidad_pago` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        `modalidad_envio` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        `modalidad_entrega` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        `irpf` DOUBLE(7,2) NULL DEFAULT NULL,
        `importe_irpf` DOUBLE(15,2) NULL DEFAULT NULL,
        `descuento_pp` DOUBLE(7,2) NULL DEFAULT NULL,
        `importe_descuento_pp` DOUBLE(15,2) NULL DEFAULT NULL,
        `descuento_librador` DOUBLE(7,2) NULL DEFAULT NULL,
        `importe_descuento_librador` DOUBLE(15,2) NULL DEFAULT NULL,
        `total` DOUBLE(15,2) NULL DEFAULT NULL,
        `estado` TINYINT(1) NOT NULL DEFAULT '0',
        `id_usuario` INT(10) NULL DEFAULT NULL,
        `comensales` SMALLINT(5) NULL DEFAULT NULL,
        `hora` TIME NULL DEFAULT NULL,
        `id_terminal` INT(11) NOT NULL,
    PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;

    CREATE TABLE `documentos_2022_2` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_documentos_1` INT(11) NOT NULL,
        `tipo_documento` VARCHAR(3) NOT NULL DEFAULT '' COLLATE 'utf8_spanish_ci',
        `tipo_librador` VARCHAR(3) NOT NULL DEFAULT '' COLLATE 'utf8_spanish_ci',
        `id_librador` INT(11) NOT NULL DEFAULT '0',
        `fecha` DATE NOT NULL,
        `fecha_entrega_desde` DATE NOT NULL,
        `fecha_entrega_hasta` DATE NOT NULL,
        `id_producto` INT(11) NOT NULL DEFAULT '0',
        `id_productos_detalles_enlazado` INT(11) NOT NULL DEFAULT '0',
        `id_productos_detalles_multiples` INT(11) NOT NULL DEFAULT '0',
        `id_packs` INT(11) NOT NULL DEFAULT '0',
        `imagen_producto` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
        `descripcion_producto` VARCHAR(250) NOT NULL COLLATE 'utf8_spanish_ci',
        `detalles_producto` VARCHAR(250) NOT NULL COLLATE 'utf8_spanish_ci',
        `descripcion_oferta` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
        `codigo_barras_producto` VARCHAR(20) NOT NULL COLLATE 'utf8_spanish_ci',
        `referencia_producto` VARCHAR(20) NOT NULL COLLATE 'utf8_spanish_ci',
        `referencia_librador` VARCHAR(20) NOT NULL COLLATE 'utf8_spanish_ci',
        `numero_serie` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
        `lote` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
        `caducidad` DATE NOT NULL,
        `cantidad` DOUBLE(7,2) NOT NULL DEFAULT '0.00',
        `importe` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
        `importe_fijo` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
        `base_antes_descuento` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
        `descuento_base` DOUBLE(7,2) NOT NULL DEFAULT '0.00',
        `importe_descuento_base` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
        `base_despues_descuento` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
        `iva` DOUBLE(7,2) NOT NULL DEFAULT '0.00',
        `importe_iva` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
        `recargo` DOUBLE(7,2) NOT NULL DEFAULT '0.00',
        `importe_recargo` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
        `pvp_unidad` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
        `total_antes_descuento` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
        `descuento_total` DOUBLE(7,2) NOT NULL DEFAULT '0.00',
        `importe_descuento_total` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
        `total_despues_descuento` DOUBLE(15,2) NOT NULL DEFAULT '0.00',
        `id_documento_anterior` INT(11) NOT NULL DEFAULT '0',
*/
/*
- Comprobar si queda alguna linea para eliminar o no el documento 1
- Calcular los datos de:

// Buscar las condiciones del librador si su id noes empty
$tipo_librador = filter_input(INPUT_POST, 'tipo_librador', FILTER_SANITIZE_STRING);
$id_librador = filter_input(INPUT_POST, 'id_librador', FILTER_SANITIZE_NUMBER_INT);

// Buscar las condiciones de la modalidad de pago, envio y entrega si no es empty
$modalidad_pago = filter_input(INPUT_POST, 'modalidad_pago', FILTER_SANITIZE_STRING);
$modalidad_envio = filter_input(INPUT_POST, 'modalidad_envio', FILTER_SANITIZE_STRING);
$modalidad_entrega = filter_input(INPUT_POST, 'modalidad_entrega', FILTER_SANITIZE_STRING);


$irpf = filter_input(INPUT_POST, 'irpf', FILTER_SANITIZE_NUMBER_FLOAT);
$importe_irpf = filter_input(INPUT_POST, 'importe_irpf', FILTER_SANITIZE_NUMBER_FLOAT);
$descuento_pp = filter_input(INPUT_POST, 'descuento_pp', FILTER_SANITIZE_NUMBER_FLOAT);
$importe_descuento_pp = filter_input(INPUT_POST, 'importe_descuento_pp', FILTER_SANITIZE_NUMBER_FLOAT);
$descuento_librador = filter_input(INPUT_POST, 'descuento_librador', FILTER_SANITIZE_NUMBER_FLOAT);
$importe_descuento_librador = filter_input(INPUT_POST, 'importe_descuento_librador', FILTER_SANITIZE_NUMBER_FLOAT);
$total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_NUMBER_FLOAT);

$cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_SANITIZE_NUMBER_FLOAT);
$importe = filter_input(INPUT_POST, 'importe', FILTER_SANITIZE_NUMBER_FLOAT);
$importe_fijo = filter_input(INPUT_POST, 'importe_fijo', FILTER_SANITIZE_NUMBER_FLOAT);
$base = filter_input(INPUT_POST, 'base', FILTER_SANITIZE_NUMBER_FLOAT);
$descuento_base = filter_input(INPUT_POST, 'descuento_base', FILTER_SANITIZE_NUMBER_FLOAT);
$importe_descuento_base = filter_input(INPUT_POST, 'importe_descuento_base', FILTER_SANITIZE_NUMBER_FLOAT);
$iva = $_POST['iva'];
$importe_iva = filter_input(INPUT_POST, 'importe_iva', FILTER_SANITIZE_NUMBER_FLOAT);
$recargo = $_POST['recargo'];
$importe_recargo = filter_input(INPUT_POST, 'importe_recargo', FILTER_SANITIZE_NUMBER_FLOAT);
$pvp_unidad = $_POST['pvp_unidad'];
$pvp_linea = $_POST['pvp_linea'];
$descuento_total = filter_input(INPUT_POST, 'descuento_total', FILTER_SANITIZE_NUMBER_FLOAT);
$importe_descuento_total = filter_input(INPUT_POST, 'importe_descuento_total', FILTER_SANITIZE_NUMBER_FLOAT);


$total_linea = $cantidad * $pvp_linea;

*/