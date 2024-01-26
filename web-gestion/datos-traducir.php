<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "traducir":
        $traduccion = $texto_traducir;
        $result = $conn->query("SELECT traduccion FROM diccionario WHERE id_idioma=".$id_idioma." AND texto='".addslashes($texto_traducir)."' LIMIT 1");
        if($conn->registros() == 1) {
            $traduccion = stripslashes($result[0]['traduccion']);
        }
        break;
}
unset($conn);