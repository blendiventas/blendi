<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "descripcion_url":
        $result = $conn->query("SELECT id,descripcion,descripcion_url,titulo_meta,descripcion_meta,de,color_fondo,color_letra,id_grupo_clientes FROM categorias WHERE descripcion_url='".addslashes($descripcion_url_familia)."' AND activa=1 LIMIT 1");
        if($conn->registros() == 1) {
            $categorias_mostrar = true;
            $id_categoria_mostrar = $result[0]['id'];
            $de_categoria_mostrar = $result[0]['de'];
            $descripcion_categoria = stripslashes($result[0]['descripcion']);
            $descripcion_url_categoria = stripslashes($result[0]['descripcion_url']);
            $descripcion_title = stripslashes($result[0]['titulo_meta']);
            $descripcion_meta = stripslashes($result[0]['descripcion_meta']);
            $color_fondo_categoria = $result[0]['color_fondo'];
            $color_letra_categoria = $result[0]['color_letra'];
            $id_grupo_clientes_categoria = $result[0]['id_grupo_clientes'];
            if ($id_grupo_clientes_categoria < 0 || empty($id_grupo_clientes_categoria)) {
                $id_grupo_clientes_categoria = 0;
            }
            if(empty($de_categoria_mostrar)) {
                $cadena_h1 = stripslashes($result[0]['titulo_meta']);
            }else {
                $result_raiz = $conn->query("SELECT descripcion,descripcion_url FROM categorias WHERE id='".$de_categoria_mostrar."' LIMIT 1");
                $cadena_h1 = '<a href="'.$host_url.stripslashes($result_raiz[0]['descripcion_url']).'" class="color-black" target="_self">';
                $cadena_h1 .= stripslashes($result_raiz[0]['descripcion']);
                $cadena_h1 .= '</a>';
                $cadena_h1 .= '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>';
                $cadena_h1 .= stripslashes($result[0]['titulo_meta']);
            }
        }
        break;
    case "activas":
        $result = $conn->query("SELECT * FROM categorias WHERE activa=1 ORDER BY orden,descripcion");
        $categorias = [];
        if ($conn->registros() >= 1) {
            foreach ($result as $key => $valor) {
                $categorias['id'][] = stripslashes($valor['id']);
                $categorias['descripcion'][] = stripslashes($valor['descripcion']);
                $categorias['descripcion_url'][] = stripslashes($valor['descripcion_url']);
                $categorias['alt'][] = stripslashes($valor['alt']);
                $categorias['id_grupo'][] = stripslashes($valor['id_grupo']);
                $categorias['de'][] = stripslashes($valor['de']);
                $categorias['color_fondo'][] = $valor['color_fondo'];
                $categorias['color_letra'][] = $valor['color_letra'];
            }
        }
        break;
    case "activas_inicio":
        $result = $conn->query("SELECT * FROM categorias WHERE activa=1 AND inicio = 1 ORDER BY orden,descripcion");
        $categoriasInicio = [];
        if ($conn->registros() >= 1) {
            foreach ($result as $key => $valor) {
                $categoriasInicio['id'][] = stripslashes($valor['id']);
                $categoriasInicio['descripcion'][] = stripslashes($valor['descripcion']);
                $categoriasInicio['descripcion_url'][] = stripslashes($valor['descripcion_url']);
                $categoriasInicio['alt'][] = stripslashes($valor['alt']);
                $categoriasInicio['id_grupo'][] = stripslashes($valor['id_grupo']);
                $categoriasInicio['de'][] = stripslashes($valor['de']);
                $categoriasInicio['color_fondo'][] = $valor['color_fondo'];
                $categoriasInicio['color_letra'][] = $valor['color_letra'];
            }
        }
        break;
}
unset($conn);