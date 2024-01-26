<?php

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "listado-filtrado":
        $result = $conn->query("SELECT * FROM zonas ORDER BY zona");
        foreach ($result as $key => $valor) {
            $matriz_id_libradores_zonas[] = $valor['id'];
            $matriz_zona_libradores_zonas[] = $valor['zona'];
        }
        if (isset($ajax_sys)) {
            echo json_encode([
                'id_libradores_zonas' => $matriz_id_libradores_zonas,
                'zona_libradores_zonas' => $matriz_zona_libradores_zonas,
            ]);
        }
        break;
}
unset($conn);