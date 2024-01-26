<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":

            if (empty($inicio_url) || empty($fin_url)) {
                break;
            }
            if (empty($ejercicio_url)) {
                $ejercicio_url = substr($inicio_url, 0, 4);
            }

            $entradas_salidas = [];
            $query = "SELECT p.id as id, p.descripcion as descripcion,d2.cantidad as cantidad,d2.coste as coste
            FROM documentos_" . $ejercicio_url . "_1 d1,documentos_" . $ejercicio_url . "_2 d2,productos p
            WHERE fecha_documento>='" . $inicio_url . "' AND fecha_documento<='" . $fin_url . "'
            AND d1.id=d2.id_documentos_1 AND d1.tipo_documento='alb' AND d1.tipo_librador='pro'
            AND p.id=d2.id_producto ORDER BY p.descripcion;";
            $result_e = $conn->query($query);
            foreach ($result_e as $key_e => $valor_e) {
                $entradas_salidas['descripcion_producto'][$valor_e['id']] = stripslashes($valor_e['descripcion']);
                if (empty($entradas_salidas['cantidad_entrada'][$valor_e['id']])) {
                    $entradas_salidas['cantidad_entrada'][$valor_e['id']] = 0;
                }
                $entradas_salidas['cantidad_entrada'][$valor_e['id']] += $valor_e['cantidad'];
                if (empty($entradas_salidas['coste_entrada'][$valor_e['id']])) {
                    $entradas_salidas['coste_entrada'][$valor_e['id']] = 0;
                }
                $entradas_salidas['coste_entrada'][$valor_e['id']] += $valor_e['cantidad'] * $valor_e['coste'];
                $entradas_salidas['cantidad_salida'][$valor_e['id']] = 0;
                $entradas_salidas['importe_salida'][$valor_e['id']] = 0;
            }

            $query = "SELECT p.id as id, p.descripcion as descripcion,d2.cantidad as cantidad,d2.importe as importe
            FROM documentos_" . $ejercicio_url . "_1 d1,documentos_" . $ejercicio_url . "_2 d2,productos p
            WHERE fecha_documento>='" . $inicio_url . "' AND fecha_documento<='" . $fin_url . "'
            AND d1.id=d2.id_documentos_1 AND d1.tipo_documento='alb' AND d1.tipo_librador='cli'
            AND p.id=d2.id_producto ORDER BY p.descripcion;";
            $result_s = $conn->query($query);
            foreach ($result_s as $key_s => $valor_s) {
                $entradas_salidas['descripcion_producto'][$valor_s['id']] = stripslashes($valor_s['descripcion']);
                if (empty($entradas_salidas['cantidad_salida'][$valor_s['id']] )) {
                    $entradas_salidas['cantidad_salida'][$valor_s['id']] = 0;
                }
                $entradas_salidas['cantidad_salida'][$valor_s['id']] += $valor_s['cantidad'];
                if (empty($entradas_salidas['importe_salida'][$valor_s['id']] )) {
                    $entradas_salidas['importe_salida'][$valor_s['id']] = 0;
                }
                $entradas_salidas['importe_salida'][$valor_s['id']] += $valor_s['cantidad'] * $valor_s['importe'];

                if (empty($entradas_salidas['cantidad_entrada'][$valor_s['id']] )) {
                    $entradas_salidas['cantidad_entrada'][$valor_s['id']] = 0;
                }
                if (empty($entradas_salidas['coste_entrada'][$valor_s['id']])) {
                    $entradas_salidas['coste_entrada'][$valor_s['id']] = 0;
                }
            }
            asort($entradas_salidas['descripcion_producto']);

            if (!empty($descarga_url) && $descarga_url == 'csv') {
                $return = 'Descripción;Cantidad entrada;Coste entrada;Cantidad salida;Importe salida';

                foreach ($entradas_salidas['descripcion_producto'] as $id_producto => $valor) {
                    $return .= "\n";
                    $return .= $valor . ';' . number_format($entradas_salidas['cantidad_entrada'][$id_producto], 2, ',', '.') . ';' . number_format($entradas_salidas['coste_entrada'][$id_producto], 3, ',', '.') . ';' . number_format($entradas_salidas['cantidad_salida'][$id_producto], 2, ',', '.') . ';' . number_format($entradas_salidas['importe_salida'][$id_producto], 3, ',', '.');
                }

                header("Content-Type: text/csv");
                header("Content-Disposition: attachment; filename=listadoES-" . $ejercicio_url . ".csv");
                echo $return;
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'descripcion_producto' => $entradas_salidas['descripcion_producto'],
                    'cantidad_entrada' => $entradas_salidas['cantidad_entrada'],
                    'coste_entrada' => $entradas_salidas['coste_entrada'],
                    'cantidad_salida' => $entradas_salidas['cantidad_salida'],
                    'importe_salida' => $entradas_salidas['importe_salida']
                ]);
            }
            break;
    }
}