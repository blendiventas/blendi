<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "guardar":
            $logs_sys .= "UPDATE datos_empresa SET 
              nombre_fiscal='" . $nombre_fiscal_datos_empresa . "', 
              nombre_comercial='" . $nombre_comercial_datos_empresa . "', 
              nif='" . $nif_datos_empresa . "', 
              direccion='" . $direccion_datos_empresa . "', 
              codigo_postal='" . $codigo_postal_datos_empresa . "', 
              poblacion='" . $poblacion_datos_empresa . "', 
              provincia='" . $provincia_datos_empresa . "', 
              tel1='" . $tel1_datos_empresa . "', 
              tel2='" . $tel2_datos_empresa . "', 
              movil='" . $movil_datos_empresa . "', 
              fax='" . $fax_datos_empresa . "', 
              email='" . $email_datos_empresa . "', 
              tarifas='" . $tarifas_datos_empresa . "', 
              iva_incluido='" . $iva_incluido_datos_empresa . "' 
              WHERE id=" . $id . " LIMIT 1<br />";

            $result = $conn->query("UPDATE datos_empresa SET 
              nombre_fiscal='" . $nombre_fiscal_datos_empresa . "', 
              nombre_comercial='" . $nombre_comercial_datos_empresa . "', 
              nif='" . $nif_datos_empresa . "', 
              direccion='" . $direccion_datos_empresa . "', 
              codigo_postal='" . $codigo_postal_datos_empresa . "', 
              poblacion='" . $poblacion_datos_empresa . "', 
              provincia='" . $provincia_datos_empresa . "', 
              tel1='" . $tel1_datos_empresa . "', 
              tel2='" . $tel2_datos_empresa . "', 
              movil='" . $movil_datos_empresa . "', 
              fax='" . $fax_datos_empresa . "', 
              email='" . $email_datos_empresa . "', 
              tarifas='" . $tarifas_datos_empresa . "', 
              iva_incluido='" . $iva_incluido_datos_empresa . "' 
              WHERE id=" . $id . " LIMIT 1");

            if(empty($url_web_datos_empresa)) {
                $url_web_datos_empresa = "tpv-e.es";
            }
            unset($conn);
            $conn = new db(0);
            $conn->query("SET NAMES 'utf8'");
            $id_panel = $result[0]['id_panel'];
            $result = $conn->query("UPDATE identificacion_panel SET dominio_ftp='".$url_web_datos_empresa."' WHERE id='" . $id_panel_sys . "' LIMIT 1");
            unset($conn);

            $resultado_sys = "UPDATE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "subir-imagen":
            $result = $conn->query("UPDATE datos_empresa SET logo='" . addslashes($nombre_sys . "-" . $hora_sys . $extension_sys) . "', updated='" . $updated_sys . "' WHERE id=" . $id_sys . " LIMIT 1");
            break;
        case "guardar-configuracion":
            if(empty($color_letra) OR empty($color_fondo)) {
                $color_letra = "#ffffff";
                $color_fondo = "#156772";
            }
            $logs_sys .= "UPDATE configuracion SET id_librador='" . $id_librador . "',id_librador_tak='" . $id_librador_tak . "', servicio_domicilio='" . $servicio_domicilio . "',pvp_iva_incluido='" . $pvp_iva_incluido . "', mostrar_mas_vendidos='" . $mostrar_mas_vendidos_configuracion . "', color_letra_botones='" . $color_letra . "', color_fondo_botones='" . $color_fondo . "', tipo_menu_superior='" . $tipo_menu_superior . "', filas_menu='" . $filas_menu . "',decimales_cantidades='" . $decimales_cantidades . "',decimales_importes='" . $decimales_importes . "',fecha_modificacion='" . date("Y-m-d") . "' WHERE id=1 LIMIT 1<br />";
            $result = $conn->query("UPDATE configuracion SET 
              id_librador='" . $id_librador . "',
              id_librador_tak='" . $id_librador_tak . "', 
              servicio_domicilio='" . $servicio_domicilio . "',
              pvp_iva_incluido='" . $pvp_iva_incluido . "', 
              mostrar_precios_tpv='" . $mostrar_precios_tpv . "',
              mostrar_mas_vendidos='" . $mostrar_mas_vendidos_configuracion . "', 
              color_letra_botones='" . $color_letra . "', 
              color_fondo_botones='" . $color_fondo . "', 
              tipo_menu_superior='" . $tipo_menu_superior . "', 
              filas_menu='" . $filas_menu . "',
              decimales_cantidades='" . $decimales_cantidades . "',
              decimales_importes='" . $decimales_importes . "',
              fecha_modificacion='" . date("Y-m-d") . "' 
              WHERE id=1 LIMIT 1");


            $resultado_sys = "UPDATE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
    }
}