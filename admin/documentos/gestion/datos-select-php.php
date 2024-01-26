<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

if(!isset($logs_sys)) {
    $logs_sys = new stdClass();
}

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "datos-proveedores":
            for ($bucle = date("Y"); $bucle >= 2022; $bucle--) {
                $result = $conn->query("SELECT documentos_" . $bucle . "_1.id_librador AS id_librador FROM documentos_" . $bucle . "_1,documentos_" . $bucle . "_2 
                                    WHERE documentos_" . $bucle . "_2.id_producto=" . $id_producto_productos_otros . " 
                                    AND documentos_" . $bucle . "_2.id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_otros . " 
                                    AND documentos_" . $bucle . "_2.id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_otros . " 
                                    AND documentos_" . $bucle . "_2.id_packs=" . $id_packs_productos_otros . " 
                                    AND documentos_" . $bucle . "_1.tipo_librador='pro' 
                                    AND documentos_" . $bucle . "_1.id=documentos_" . $bucle . "_2.id_documentos_1 
                                    GROUP BY documentos_" . $bucle . "_1.id_librador ORDER BY documentos_" . $bucle . "_1.fecha_documento DESC");
                if ($conn->registros() >= 1) {
                    foreach ($result as $key => $valor) {
                        $id_librador[] = $valor['id_librador'];
                    }
                }
            }
            break;
        case "datos-costes":
            for($bucle = date("Y") ; $bucle >= 2022 ; $bucle--) {
                $result = $conn->query("SELECT documentos_".$bucle."_productos_sku_stock.id_librador,
                                    documentos_".$bucle."_productos_sku_stock.tipo_documento,
                                    documentos_".$bucle."_productos_sku_stock.numero_serie,
                                    documentos_".$bucle."_productos_sku_stock.lote,
                                    documentos_".$bucle."_productos_sku_stock.caducidad,
                                    documentos_".$bucle."_productos_sku_stock.cantidad,
                                    documentos_".$bucle."_productos_sku_stock.coste AS importe,
                                    documentos_".$bucle."_productos_sku_stock.fecha 
                                    FROM productos_sku,documentos_".$bucle."_productos_sku_stock 
                                    WHERE productos_sku.id_producto=" . $id_producto_productos_otros . " 
                                    AND productos_sku.id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_otros . " 
                                    AND productos_sku.id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_otros . " 
                                    AND productos_sku.id_packs=" . $id_packs_productos_otros . " 
                                    AND productos_sku.id=documentos_".$bucle."_productos_sku_stock.id_productos_sku 
                                    AND documentos_".$bucle."_productos_sku_stock.tipo_librador='pro' 
                                    ORDER BY documentos_".$bucle."_productos_sku_stock.fecha DESC");
                /*
                    $id_librador[] = $valor['id_librador'];
                    $tipo_documento[] = $valor['tipo_documento'];
                    $numero_serie[] = $valor['numero_serie'];
                    $lote[] = $valor['lote'];
                    $caducidad[] = $valor['caducidad'];
                    $cantidad[] = $valor['cantidad'];
                    $importe[] = $valor['importe'];
                    $descuento[] = $valor['descuento'];
                    $descuento[] = 0;
                    $fecha[] = $valor['fecha'];
                $result = $conn->query("SELECT documentos_".$bucle."_1.id_librador AS id_librador,
                                    documentos_".$bucle."_1.tipo_documento,
                                    documentos_".$bucle."_2.numero_serie AS numero_serie,
                                    documentos_".$bucle."_2.lote AS lote,
                                    documentos_".$bucle."_2.caducidad AS caducidad,
                                    documentos_".$bucle."_2.cantidad AS cantidad,
                                    documentos_".$bucle."_2.importe AS importe,
                                    documentos_".$bucle."_2.importe_descuento_base AS descuento,
                                    documentos_".$bucle."_2.fecha AS fecha 
                                    FROM documentos_".$bucle."_1,documentos_".$bucle."_2 
                                    WHERE documentos_".$bucle."_2.id_producto=" . $id_producto_productos_otros . " 
                                    AND documentos_".$bucle."_2.id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_otros . " 
                                    AND documentos_".$bucle."_2.id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_otros . " 
                                    AND documentos_".$bucle."_2.id_packs=" . $id_packs_productos_otros . " 
                                    AND documentos_".$bucle."_1.tipo_librador='pro' 
                                    AND documentos_".$bucle."_1.id=documentos_".$bucle."_2.id_documentos_1 
                                    ORDER BY documentos_".$bucle."_1.fecha_documento DESC");
                                    //GROUP BY documentos_".$bucle."_1.id_librador ORDER BY documentos_".$bucle."_1.fecha_documento DESC");
                */
                if ($conn->registros() >= 1) {
                    foreach ($result as $key => $valor) {
                        $id_librador[] = $valor['id_librador'];
                        $tipo_documento[] = $valor['tipo_documento'];
                        $numero_serie[] = $valor['numero_serie'];
                        $lote[] = $valor['lote'];
                        $caducidad[] = $valor['caducidad'];
                        $cantidad[] = $valor['cantidad'];
                        $importe[] = $valor['importe'];
                        $fecha[] = $valor['fecha'];
                    }
                }
            }
            break;
        case "datos-stock":
            for($bucle = date("Y") ; $bucle >= 2022 ; $bucle--) {
                /*
                $result = $conn->query("SELECT documentos_".$bucle."_productos_sku_stock.id_librador,
                                    documentos_".$bucle."_productos_sku_stock.tipo_librador,
                                    documentos_".$bucle."_productos_sku_stock.numero_serie,
                                    documentos_".$bucle."_productos_sku_stock.lote,
                                    documentos_".$bucle."_productos_sku_stock.caducidad,
                                    documentos_".$bucle."_productos_sku_stock.cantidad,
                                    documentos_".$bucle."_productos_sku_stock.fecha 
                                    FROM productos_sku,documentos_".$bucle."_productos_sku_stock 
                                    WHERE productos_sku.id_producto=" . $id_producto_productos_otros . " 
                                    AND productos_sku.id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_otros . " 
                                    AND productos_sku.id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_otros . " 
                                    AND productos_sku.id_packs=" . $id_packs_productos_otros . " 
                                    AND productos_sku.id=documentos_".$bucle."_productos_sku_stock.id_productos_sku 
                                    AND documentos_".$bucle."_productos_sku_stock.tipo_librador='pro' 
                                    ORDER BY documentos_".$bucle."_productos_sku_stock.fecha DESC");
                */
                $result = $conn->query("SELECT documentos_".$bucle."_1.id_librador AS id_librador,
                                    documentos_".$bucle."_1.tipo_librador,
                                    documentos_".$bucle."_2.numero_serie AS numero_serie,
                                    documentos_".$bucle."_2.lote AS lote,
                                    documentos_".$bucle."_2.caducidad AS caducidad,
                                    documentos_".$bucle."_2.cantidad AS cantidad,
                                    documentos_".$bucle."_2.fecha AS fecha 
                                    FROM documentos_".$bucle."_1,documentos_".$bucle."_2 
                                    WHERE documentos_".$bucle."_2.id_producto=" . $id_producto_productos_otros . " 
                                    AND documentos_".$bucle."_2.id_productos_detalles_enlazado=" . $id_productos_detalles_enlazado_productos_otros . " 
                                    AND documentos_".$bucle."_2.id_productos_detalles_multiples=" . $id_productos_detalles_multiples_productos_otros . " 
                                    AND documentos_".$bucle."_2.id_packs=" . $id_packs_productos_otros . " 
                                    AND (documentos_".$bucle."_1.tipo_librador='pro' OR documentos_".$bucle."_1.tipo_librador='cre') 
                                    AND documentos_".$bucle."_2.id_documento_anterior=0 
                                    AND documentos_".$bucle."_1.id=documentos_".$bucle."_2.id_documentos_1 
                                    GROUP BY documentos_".$bucle."_1.id_librador ORDER BY documentos_".$bucle."_1.fecha DESC");
                if ($conn->registros() >= 1) {
                    foreach ($result as $key => $valor) {
                        $id_librador[] = $valor['id_librador'];
                        $tipo_librador[] = $valor['tipo_librador'];
                        $numero_serie[] = $valor['numero_serie'];
                        $lote[] = $valor['lote'];
                        $caducidad[] = $valor['caducidad'];
                        $cantidad[] = $valor['cantidad'];
                        $fecha[] = $valor['fecha'];
                    }
                }
            }
            break;
    }
}