<?php
$result = $conn->query("CREATE VIEW salidas AS
SELECT d2.fecha, d2.hora, p.descripcion AS producto, c.descripcion AS categoria, d2.cantidad, d2.coste, d2.base_despues_descuento / d2.cantidad AS importe_unidad, d2.base_despues_descuento AS importe_total, CONCAT(l.nombre, ' ', l.apellido_1, ' ', l.apellido_2) AS cliente, l.razon_comercial AS razon_comercial
FROM documentos_2022_2 d2 INNER JOIN productos p ON d2.id_producto = p.id INNER JOIN productos_categorias pc ON p.id = pc.id_producto INNER JOIN categorias c ON pc.id_categoria = c.id INNER JOIN libradores l ON d2.id_librador = l.id;");
$result = $conn->query("CREATE VIEW comensales AS 
SELECT d1.fecha_documento, d1.hora, concat(`l`.`nombre`,' ',`l`.`apellido_1`,' ',`l`.`apellido_2`) AS `cliente`,`l`.`razon_comercial` AS `razon_comercial`, d1.comensales
FROM documentos_2022_1 d1 INNER JOIN libradores l ON d1.id_librador = l.id;");