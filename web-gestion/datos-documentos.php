<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "obtener_numero_documento":
        //$query = "SELECT * FROM documentos_".$ejercicio."_1 WHERE id='".$id_documento."' AND tipo_documento='".$tipo_documento."' AND tipo_librador='".$tipo_librador."' LIMIT 1";
        $query = "SELECT * FROM documentos_".$ejercicio."_1 WHERE id='".$id_documento."' LIMIT 1";
        $result_documentos = $conn->query($query);

        $numero_documento = '';
        $fecha_documento = date('Y-m-d');
        $fecha_entrada = date('Y-m-d');
        if ($conn->registros() == 1) {
            $numero_documento = $result_documentos[0]['numero_documento'];
            $serie_documento = $result_documentos[0]['serie_documento'];
            $fecha_documento = $result_documentos[0]['fecha_documento'];
            $fecha_entrada = $result_documentos[0]['fecha_entrada'];
            $comensales = $result_documentos[0]['comensales'];
        }
        if (isset($ajax)) {
            echo json_encode([
                'query' => $query,
                'ejercicio' => $ejercicio,
                'id_documento' => $id_documento,
                'numero_documento' => $numero_documento,
                'serie_documento' => $serie_documento
            ]);
        }
        break;
    case "obtener_lineas_documento":
        $query = "SELECT COUNT(id) AS registros FROM documentos_".$ejercicio."_2 WHERE id_documentos_1='".$id_documento."'";
        $result_documentos = $conn->query($query);

        $lineas_documento = $result_documentos[0]['registros'];
        if (isset($ajax)) {
            echo json_encode([
                'query' => $query,
                'ejercicio' => $ejercicio,
                'id_documento' => $id_documento,
                'lineas_documento' => $lineas_documento
            ]);
        }
        break;
    case "obtener_modelos":
        $id_modelos_impresion_1 = [];
        $descripcion_modelos_impresion_1 = [];
        $predeterminado_modelos_impresion_1 = [];
        $query = "SELECT id,descripcion,predeterminado FROM modelos_impresion_1 WHERE tipo_documento='" . $tipo_documento . "' AND activo=1 ORDER BY descripcion";
        $result_modelos = $conn->query($query);
        foreach ($result_modelos as $key_modelos => $valor_modelos) {
            $id_modelos_impresion_1[] = $valor_modelos['id'];
            $descripcion_modelos_impresion_1[] = stripslashes($valor_modelos['descripcion']);
            $predeterminado_modelos_impresion_1[] = $valor_modelos['predeterminado'];
        }
        if (isset($ajax)) {
            echo json_encode([
                'query' => $query,
                'id_modelos_impresion_1' => $id_modelos_impresion_1,
                'descripcion_modelos_impresion_1' => $descripcion_modelos_impresion_1,
                'predeterminado_modelos_impresion_1' => $predeterminado_modelos_impresion_1
            ]);
        }
        break;
    case "obtener_series":
        $ids_serie = [];
        $series_serie = [];
        $query = "SELECT id,serie FROM documentos_numeraciones_series WHERE tipo_documento='" . $tipo_documento . "' ORDER BY serie";
        $result_modelos = $conn->query($query);
        foreach ($result_modelos as $key_modelos => $valor_modelos) {
            $ids_serie[] = $valor_modelos['id'];
            $series_serie[] = stripslashes($valor_modelos['serie']);
        }
        if (isset($ajax)) {
            echo json_encode([
                'ids_serie' => $ids_serie,
                'series_serie' => $series_serie
            ]);
        }
        break;
    case "obtener_info_volcados":
        /*
        Busquem totes les linies del document $id_documento_1
        (que serà cada d'un dels documents llistats i que el seu estat sigui diferent de 0)
        */
        $query1 = "SELECT id FROM documentos_" . $ejercicio . "_2 WHERE id_documentos_1=" . $id_documento_1 . " AND estado<>0";
        $result_lineas = $conn->query($query1);
        if ($conn->registros() >= 1) {
            $ids_documentos_volcados = [];
            foreach ($result_lineas as $key_lineas => $valor_lineas) {
                /*
                Busquem tot els id de documentos 1 on s'han volcat els documents.
                Guardem els id's a la matriu $ids_documentos_volcados
                */
                $query2 = "SELECT id_documentos_1 FROM documentos_" . $ejercicio . "_2 WHERE id_documento_2_anterior=" . $valor_lineas['id'];
                $result_documentos = $conn->query($query2);
                if ($conn->registros() >= 1) {
                    foreach ($result_documentos as $key_documentos => $valor_documentos) {
                        if(!in_array($valor_documentos['id_documentos_1'], $ids_documentos_volcados)) {
                            $ids_documentos_volcados[] = $valor_documentos['id_documentos_1'];
                        }
                    }
                }
            }
        }
        /*
        Si exiteix la matriu $ids_documentos_volcados, la podem recorrer per consultar els documents on s'han volcat
        els documents del llistat mostrant el document o poder si es massa complicat,
        mostrem únicament el numero de registre o número de document.
        */
        $returnInfo = new stdClass();
        $returns = [];
        if (isset($ids_documentos_volcados)) {
            foreach ($ids_documentos_volcados as $key_documentos_volcados => $valor_documentos_volcados) {
                $query1 = "SELECT * FROM documentos_" . $ejercicio . "_1 WHERE id=" . $valor_documentos_volcados . " LIMIT 1";
                $result_documentos = $conn->query($query1);
                if ($conn->registros() >= 1) {
                    foreach ($result_documentos as $key_documentos => $valor_documentos) {
                        $returnInfo = new stdClass();
                        $returnInfo->tipo_documento = $valor_documentos['tipo_documento'];
                        $returnInfo->tipo_librador = $valor_documentos['tipo_librador'];
                        $returnInfo->id_librador = $valor_documentos['id_librador'];
                        if($valor_documentos['tipo_documento'] == "com") {
                            $tipo_documento = "el pedido";
                        }else if($valor_documentos['tipo_documento'] == "alb") {
                            $tipo_documento = "el albarán";
                        }else if($valor_documentos['tipo_documento'] == "fac") {
                            $tipo_documento = "la factura";
                        }
                        if(!empty($valor_documentos['numero_documento'])) {
                            $returnInfo->numero_documento = $valor_documentos['numero_documento'];
                            $returnInfo->info = "Volcado en " . $tipo_documento . " número documento: " . $valor_documentos['numero_documento'];
                        }
                        if(!empty($valor_documentos['numero_registro'])) {
                            $returnInfo->numero_registro = $valor_documentos['numero_registro'];
                            $returnInfo->info = "Volcado en " . $tipo_documento . " con número de registro: " . $valor_documentos['numero_registro'];
                        }
                        if(!empty($valor_documentos['serie_documento'])) {
                            $returnInfo->info .= " Serie: " . $valor_documentos['serie_documento'];
                        }
                        $returns[] = $returnInfo;
                    }
                }
            }
        }
        if (isset($ajax)) {
            echo json_encode($returns);
        }
        break;
}
unset($conn);