<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "listado":
        /*
        CREATE TABLE `productos_iva` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `iva` DOUBLE(7,2) NOT NULL DEFAULT '0.00',
            `recargo` DOUBLE(7,2) NOT NULL DEFAULT '0.00',
            `prioritario` TINYINT(1) NOT NULL DEFAULT '0',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
        CREATE TABLE `irpf` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `irpf` DOUBLE(7,2) NOT NULL DEFAULT '0.00',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
        */
        $result_productos_iva = $conn->query("SELECT id,iva,recargo FROM productos_iva WHERE activo='1' ORDER BY iva");
        foreach ($result_productos_iva as $key_productos_iva => $valor_productos_iva) {
            $matriz_iva_productos_iva[$valor_productos_iva['id']] = $valor_productos_iva['iva'];
            $matriz_recargo_productos_iva[$valor_productos_iva['id']] = $valor_productos_iva['recargo'];
        }
        $result_irpf = $conn->query("SELECT id,irpf FROM irpf WHERE activo='1' ORDER BY irpf");
        foreach ($result_irpf as $key_irpf => $valor_irpf) {
            $matriz_irpf[$valor_irpf['id']] = $valor_irpf['irpf'];
        }
        break;
}
unset($conn);