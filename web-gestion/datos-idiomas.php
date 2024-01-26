<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "activos":
        $result = $conn->query("SELECT id,idioma,bandera,lang FROM idiomas WHERE activo='1' ORDER BY idioma");
        foreach ($result as $key => $valor) {
            $idioma_disponible[$valor['id']] = stripslashes($valor['idioma']);
            $idioma_bandera[$valor['id']] = stripslashes($valor['bandera']);
            $idioma_lang[$valor['id']] = stripslashes($valor['lang']);
        }
        break;
    case "path":
        if($path_idioma[0] != "es") {
            $result = $conn->query("SELECT id,locale FROM idiomas WHERE lang='" . addslashes($path_idioma[0]) . "' AND activo=1 LIMIT 1");
            if ($conn->registros() == 1) {
                $lang = $path_idioma[0];
                $locale_og = $result[0]['locale'];
                $id_idioma = $result[0]['id'];
                $idioma = $lang . "/";
                $host_idioma .= $idioma;
            }
        }else if($idioma_server != "es-ES") {
            $result = $conn->query("SELECT id,lang FROM idiomas WHERE locale='" . addslashes($idioma_server) . "' AND activo=1 LIMIT 1");
            if ($conn->registros() == 1) {
                $lang = $result[0]['lang'];
                $locale_og = $idioma_server;
                $id_idioma = $result[0]['id'];
                $idioma = $lang . "/";
                $host_idioma .= $idioma;
            }
        }
        for($bucle_paths = 0 ; $bucle_paths < count($path_idioma) ; $bucle_paths++) {
            if(isset($path_idioma[$bucle_paths])) {
                if(!empty($path_idioma[$bucle_paths])) {
                    if(!array_search($path_idioma[$bucle_paths], $idioma_lang)) {
                        //$path_components[] = $path_idioma[$bucle_paths];
                        if(!empty($url_base)) {
                            $url_base .= "/";
                        }
                        $url_base .= $path_idioma[$bucle_paths];
                    }
                }
            }
        }
        break;
}
unset($conn);