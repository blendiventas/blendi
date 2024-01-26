<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":
            if (!isset($parametro_pagina)) {
                $parametro_pagina = 0;
            }
            if (!isset($parametro_resultados)) {
                $parametro_resultados = 10;
            }

            $whereBusqueda = '';
            if (isset($parametro_busqueda) && !empty($parametro_busqueda)) {
                $whereBusqueda .= " AND (descripcion LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }
            if (isset($parametro_filtro_habilitado)) {
                $whereBusqueda .= " AND activa = " . $parametro_filtro_habilitado . " ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM categorias WHERE id <> 0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result = $conn->query("SELECT id,descripcion,imagen,updated,de,activa,orden,color_fondo,color_letra FROM categorias WHERE id_idioma=" . $id_idioma_sys . $whereBusqueda . " ORDER BY de,descripcion LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_categorias[] = $valor['id'];
                $matriz_descripcion_categorias[] = stripslashes($valor['descripcion']);
                $matriz_imagen_categorias[] = stripslashes($valor['imagen']);
                $matriz_updated_categorias[] = stripslashes($valor['updated']);
                $matriz_de_categorias[] = $valor['de'];
                $matriz_activa_categorias[] = stripslashes($valor['activa']);
                $matriz_orden_categorias[] = stripslashes($valor['orden']);
                $matriz_color_fondo_categorias[] = stripslashes($valor['color_fondo']);
                $matriz_color_letra_categorias[] = stripslashes($valor['color_letra']);
            }
            if (isset($ajax)) {
                echo json_encode([
                    'logs' => $matriz_logs_sys,
                    'id' => $matriz_id_categorias,
                    'descripcion' => $matriz_descripcion_categorias,
                    'imagen' => $matriz_imagen_categorias,
                    'updated' => $matriz_updated_categorias,
                    'de' => $matriz_de_categorias,
                    'activa' => $matriz_activa_categorias,
                    'orden' => $matriz_orden_categorias,
                    'color_fondo' => $matriz_color_fondo_categorias,
                    'color_letra' => $matriz_color_letra_categorias
                ]);
            }
            break;
        case "categoria-de":
            $categoria_de_categorias = "Desconocida";
            $result = $conn->query("SELECT descripcion FROM categorias WHERE id=" . $de_sys . " LIMIT 1");
            if ($conn->registros() == 1) {
                $categoria_de_categorias = stripslashes($result[0]['descripcion']);
            }
            if (isset($ajax)) {
                echo json_encode([
                    'logs' => $matriz_logs_sys,
                    'categoria_de' => $categoria_de_categorias
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_categorias = 0;
                $id_idioma_categorias = $id_idioma_sys;
                $descripcion_categorias = "";
                $descripcion_url_categorias = "";
                $titulo_meta_categorias = "";
                $descripcion_meta_categorias = "";
                $imagen_categorias = "";
                $updated_categorias = "";
                $alt_categorias = "";
                $tittle_categorias = "";
                $id_grupo_categorias = 0;
                $texto_inicio_categorias = "";
                $de_categorias = 0;
                $activa_categorias = 1;
                $orden_categorias = "";
                $inicio_categorias = 0;
                $orden_inicio_categorias = "";
                $mostrar_buscador_categorias = 0;
                $id_grupo_clientes_categorias = 0;
                $link_categorias = "";
                $link_externo_categorias = "";
                $texto_titulo_categorias = "";
                $color_fondo_categorias = "#156772";
                $color_letra_categorias = "#ffffff";
            }else {
                //$matriz_logs_w[] = "SELECT * FROM categorias WHERE id=" . $parametro_id . " LIMIT 1";
                $result = $conn->query("SELECT * FROM categorias WHERE id=" . $id_url . " LIMIT 1");
                if ($conn->registros() == 1) {
                    $id_categorias = $result[0]['id'];
                    $id_idioma_categorias = $result[0]['id_idioma'];
                    $descripcion_categorias = stripslashes($result[0]['descripcion']);
                    $descripcion_url_categorias = stripslashes($result[0]['descripcion_url']);
                    $titulo_meta_categorias = stripslashes($result[0]['titulo_meta']);
                    $descripcion_meta_categorias = stripslashes($result[0]['descripcion_meta']);
                    $imagen_categorias = stripslashes($result[0]['imagen']);
                    $updated_categorias = stripslashes($result[0]['updated']);
                    $alt_categorias = stripslashes($result[0]['alt']);
                    $tittle_categorias = stripslashes($result[0]['tittle']);
                    $id_grupo_categorias = $result[0]['id_grupo'];
                    $texto_inicio_categorias = stripslashes($result[0]['texto_inicio']);
                    $de_categorias = $result[0]['de'];
                    $activa_categorias = $result[0]['activa'];
                    $orden_categorias = stripslashes($result[0]['orden']);
                    $inicio_categorias = $result[0]['inicio'];
                    $orden_inicio_categorias = stripslashes($result[0]['orden_inici']);
                    $mostrar_buscador_categorias = $result[0]['mostrar_buscador'];
                    $id_grupo_clientes_categorias = $result[0]['id_grupo_clientes'];
                    $link_categorias = stripslashes($result[0]['link']);
                    $link_externo_categorias = stripslashes($result[0]['link_externo']);
                    $texto_titulo_categorias = stripslashes($result[0]['texto_titulo']);
                    $color_fondo_categorias = $result[0]['color_fondo'];
                    $color_letra_categorias = $result[0]['color_letra'];
                }
                $result = $conn->query("SELECT * FROM categorias_terminales WHERE id_categoria=" . $id_url);
                $categorias_terminales_id = [];
                $categorias_terminales_id_categoria = [];
                $categorias_terminales_id_terminal = [];
                if ($conn->registros() >= 1) {
                    foreach ($result as $value_categorias_terminales) {
                        $categorias_terminales_id[] = $value_categorias_terminales['id'];
                        $categorias_terminales_id_categoria[] = $value_categorias_terminales['id_categoria'];
                        $categorias_terminales_id_terminal[] = $value_categorias_terminales['id_terminal'];
                    }
                }
            }
            if (isset($ajax)) {
                echo json_encode([
                    'logs' => $matriz_logs_w,
                    'id_idioma' => $id_idioma_categorias,
                    'descripcion' => $descripcion_categorias,
                    'descripcion_url' => $descripcion_url_categorias,
                    'titulo_meta' => $titulo_meta_categorias,
                    'descripcion_meta' => $descripcion_meta_categorias,
                    'imagen' => $imagen_categorias,
                    'updated' => $updated_categorias,
                    'alt' => $alt_categorias,
                    'tittle' => $tittle_categorias,
                    'id_categorias' => $id_categorias,
                    'texto_inicio' => $texto_inicio_categorias,
                    'de' => $de_categorias,
                    'activa' => $activa_categorias,
                    'orden' => $orden_categorias,
                    'inicio' => $inicio_categorias,
                    'orden_inicio' => $orden_inicio_categorias,
                    'mostrar_buscador' => $mostrar_buscador_categorias,
                    'id_grupo_clientes' => $id_grupo_clientes_categorias,
                    'link' => $link_categorias,
                    'link_externo' => $link_externo_categorias,
                    'texto_titulo' => $texto_titulo_categorias,
                    'color_fondo_categorias' => $color_fondo_categorias,
                    'color_letra_categorias' => $color_letra_categorias
                ]);
            }
            break;
        case "categorias":
            //$matriz_logs_sys[] = "SELECT id,descripcion FROM categorias WHERE id_idioma=" . $id_idioma . " AND activa=1 ORDER BY de,descripcion";
            if(isset($id_categorias)) {
                $result = $conn->query("SELECT id,descripcion FROM categorias WHERE id<>" . $id_categorias . " AND id_idioma=" . $id_idioma_sys . " AND activa=1 ORDER BY de,descripcion");
            }else {
                $result = $conn->query("SELECT id,descripcion FROM categorias WHERE id_idioma=" . $id_idioma_sys . " AND activa=1 ORDER BY de,descripcion");
            }
            foreach ($result as $key => $valor) {
                $matriz_id_categorias[] = $valor['id'];
                $matriz_descripcion_categorias[] = stripslashes($valor['descripcion']);
            }
            if (isset($ajax)) {
                echo json_encode([
                    'logs' => $matriz_logs_sys,
                    'id' => $matriz_id_categorias,
                    'descripcion' => $matriz_descripcion_categorias
                ]);
            }
            break;
    }
}