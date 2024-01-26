<?php
if (!isset($id_documentos_combo)) {
    $id_documentos_combo = null;
}
if($accion == "insertar-producto" || $accion == "modificar-producto") {
    if (!empty($observacion)) {
        $logs->insert_obs = "INSERT INTO documentos_" . $ejercicio . "_observaciones VALUES(
            NULL,
            '" . $id_documento_1 . "',
            '" . $id_documento_2 . "',
            '" . $id_documentos_combo . "',
            '" . addslashes($observacion) . "')";
        $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_observaciones VALUES(
            NULL,
            '" . $id_documento_1 . "',
            '" . $id_documento_2 . "',
            '" . $id_documentos_combo . "',
            '" . addslashes($observacion) . "')");
    }
}