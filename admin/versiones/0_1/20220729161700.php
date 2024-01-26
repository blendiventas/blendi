<?php
$result = $conn->query('CREATE VIEW articulos AS SELECT p.id AS `Id articulo`, p.descripcion AS articulos, u.abreviatura AS Unidad, p.peso_bruto AS "Peso bruto", p.peso_neto AS "Peso neto", p.coste AS "Coste" FROM productos p JOIN productos_unidades pu ON p.id = pu.id_producto JOIN unidades u ON pu.id_unidad = u.id WHERE pu.principal = 1;');
$result = $conn->query('CREATE VIEW compras_2022 AS SELECT concat(dl.nombre, " ", dl.apellido_1, " ", dl.apellido_2) AS Proveedor, dl.razon_comercial AS "Razon Comercial", d2.descripcion_producto AS articulos, d2.unidad AS Unidad, d2.coste AS "Coste" FROM documentos_2022_1 d1 JOIN documentos_2022_2 d2 ON d1.id = d2.id_documentos_1 JOIN documentos_2022_libradores dl ON dl.id_documentos_1 = d1.id WHERE d1.tipo_librador = "pro";');
$result = $conn->query('CREATE VIEW packaging AS SELECT p.id AS `Id Embalaje`, p.descripcion AS articulos, p.coste AS "Coste", p.id AS Codigo FROM productos_embalajes pe JOIN productos p ON pe.id_producto_relacionado = p.id JOIN productos_unidades pu ON p.id = pu.id_producto GROUP BY pe.id_producto_relacionado;');
$result = $conn->query('create VIEW escandallos as SELECT p.id AS `Id nombre plato`, pe.id AS `Id productos`, `c`.`descripcion` AS `Nombre partida`,`p`.`descripcion` AS `Nombre plato`,`pe`.`tipo_producto` AS `Origen`,`pe`.`descripcion` AS `Productos`,`pre`.`cantidad` AS `Peso racion`, pe.coste AS `Coste elaborado`, pc.cantidad_base AS `Cantidad final` from (((`productos_relacionados_elaborados` `pre` join `productos` `p` on((`pre`.`id_producto` = `p`.`id`))) join `productos` `pe` on((`pre`.`id_producto_relacionado` = `pe`.`id`))) join `categorias_elaborados` `c` on((`c`.`id` = `pre`.`id_categoria_estadisticas`))) JOIN productos_costes pc ON pc.id_producto = pe.id  order by `p`.`descripcion`;');
$result = $conn->query('CREATE VIEW `plato_packaging_precios` AS SELECT p.id AS `Id Producto`, pee.id AS `Id Embalaje`, p.descripcion `Producto`, p.producto_venta AS `Venta`, pee.descripcion AS `Producto embalaje`, pp.id_tarifa, pp.pvp FROM productos p JOIN productos_pvp pp ON p.id = pp.id_producto LEFT OUTER JOIN productos_embalajes pe ON pe.id_producto = p.id  LEFT OUTER JOIN productos pee ON pee.id = pe.id_producto_relacionado ORDER BY Producto ASC;');

// SELECT p.fecha_modificacion AS "Fecha modificacion", c.descripcion AS "Nombre partida", p.descripcion AS "Nombre plato", pe.descripcion AS Subroductos, pre.cantidad AS "Peso subproducto", pec.tiempo AS "Tiempo base" FROM productos_relacionados_elaborados pre JOIN productos p ON pre.id_producto = p.id JOIN productos pe ON pre.id_producto_relacionado = pe.id JOIN productos_costes pec ON pe.id = pec.id_producto JOIN categorias_elaborados c ON c.id = pre.id_categoria_estadisticas WHERE p.producto_venta = 0 ORDER BY p.descripcion;