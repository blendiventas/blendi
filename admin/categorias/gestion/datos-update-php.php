<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

function slugify($text, string $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activa FROM categorias WHERE id=" . $id_categorias . " LIMIT 1");
            if ($result[0]['activa'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE categorias SET activa=" . $valor_sys . " WHERE id=" . $id_categorias . " LIMIT 1");
            if (isset($ajax_sys)) {
                echo json_encode([
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_categorias)) {
                if(!empty($descripcion_categorias)) {
                    $result = $conn->query("INSERT INTO categorias VALUES(
                                  NULL,
                                  " . $id_idioma_categorias . ",
                                  '" . addslashes($descripcion_categorias) . "',
                                  '" . slugify($descripcion_categorias) . "',
                                  '" . addslashes($descripcion_categorias) . "',
                                  '" . addslashes($descripcion_categorias) . "',
                                  '',
                                  '',
                                  '',
                                  '',
                                  '" . $id_grupo_categorias . "',
                                  '',
                                  " . $de_categorias . ",
                                  " . $activo_categorias . ",
                                  '" . addslashes($orden_categorias) . "',
                                  0,
                                  '',
                                  0,
                                  '',
                                  '',
                                  '',
                                  '',
                                  '#156772',
                                  '#ffffff')");
                    $id_categorias = $conn->id_insert();

                    foreach ($id_terminal_categorias_terminales as $key_terminales => $valor_terminales) {
                        $result = $conn->query("INSERT INTO categorias_terminales VALUES(
                                    NULL,
                                    '" . $id_categorias . "',
                                    '" . $valor_terminales . "')");
                    }

                    $resultado_sys = "INSERT";
                }else {
                    $id_categorias = 0;
                    $resultado_sys = "INSERT ERROR descripcion";
                }
            }else {
                if(empty($apartado_url) ||  $apartado_url == "null") {
                    $result = $conn->query("UPDATE categorias SET 
                      id_idioma=" . $id_idioma_categorias . ", 
                      descripcion='" . addslashes($descripcion_categorias) . "', 
                      id_grupo='" . $id_grupo_categorias . "', 
                      de=" . $de_categorias . ", 
                      activa=" . $activo_categorias . ", 
                      orden='" . addslashes($orden_categorias) . "' 
                      WHERE id=" . $id_categorias . " LIMIT 1");

                    $result_categorias_terminales = $conn->query("SELECT id,id_terminal FROM categorias_terminales WHERE id_categoria=".$id_categorias);
                    foreach ($result_categorias_terminales as $key_categorias_terminales => $valor_categorias_terminales) {
                        $existe = false;
                        foreach ($id_terminal_categorias_terminales as $key_terminales => $valor_terminales) {
                            if($valor_categorias_terminales['id_terminal'] == $valor_terminales) {
                                $existe = true;
                            }
                        }
                        if(!$existe) {
                            $result = $conn->query("DELETE FROM categorias_terminales WHERE id=".$valor_categorias_terminales['id']." LIMIT 1");
                        }
                    }
                    foreach ($id_terminal_categorias_terminales as $key_terminales => $valor_terminales) {
                        $result_productos_categorias = $conn->query("SELECT id FROM categorias_terminales 
                            WHERE id_categoria=" . $id_categorias . " AND id_terminal=".$valor_terminales." LIMIT 1");
                        if($conn->registros() != 1) {
                            $result = $conn->query("INSERT INTO categorias_terminales VALUES(
                                    NULL,
                                    '" . $id_categorias . "',
                                    '" . $valor_terminales . "')");
                        }
                    }

                    $resultado_sys = "UPDATE";
                }elseif($apartado_url == "imagen") {
                    $result = $conn->query("UPDATE categorias SET 
                      alt='" . addslashes($alt_categorias) . "', 
                      tittle='" . addslashes($tittle_categorias) . "',
                      color_fondo='" . addslashes($color_fondo_categorias) . "',
                      color_letra='" . addslashes($color_letra_categorias) . "' 
                      WHERE id=" . $id_categorias . " LIMIT 1");
                    $resultado_sys = "UPDATE";
                }elseif($apartado_url == "web") {
                    $result = $conn->query("UPDATE categorias SET 
                      descripcion_url='" . slugify($descripcion_url_categorias) . "', 
                      titulo_meta='" . addslashes($titulo_meta_categorias) . "', 
                      descripcion_meta='" . addslashes($descripcion_meta_categorias) . "', 
                      texto_inicio='" . addslashes($texto_inicio_categorias) . "', 
                      inicio=" . $inicio_categorias . ", 
                      orden_inicio='" . addslashes($orden_inicio_categorias) . "', 
                      mostrar_buscador=" . $mostrar_buscador_categorias . ", 
                      id_grupo_clientes='" . $id_grupo_clientes_categorias . "', 
                      link='" . addslashes($link_categorias) . "', 
                      link_externo='" . addslashes($link_externo_categorias) . "', 
                      texto_titulo='" . addslashes($texto_titulo_categorias) . "' 
                      WHERE id=" . $id_categorias . " LIMIT 1");
                    $resultado_sys = "UPDATE";
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id' => $id_categorias,
                    'apartado' => $apartado_url,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "subir-imagen":
            $result = $conn->query("UPDATE categorias SET imagen='" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "', updated='" . $updated_sys . "' WHERE id=" . $id_sys . " LIMIT 1");
            break;
        case "eliminar-imagen":
            $updated_sys = date("y-m-d").date("H:m:s");
            $updated_sys = str_replace("-","",$updated_sys);
            $updated_sys = str_replace(":","",$updated_sys);

            $result = $conn->query("UPDATE categorias SET 
              imagen='', 
              updated='" . $updated_sys . "' 
              WHERE id=" . $id_categorias . " LIMIT 1");

            $resultado_sys = "UPDATE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id' => $id_categorias,
                    'resultado' => $resultado_sys,
                    'apartado' => $apartado_url
                ]);
            }
            break;
        case "eliminar":
            $result = $conn->query("DELETE FROM categorias WHERE id=" . $id_categorias . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'resultado' => $resultado_sys
                ]);
            }
            break;
    }
}