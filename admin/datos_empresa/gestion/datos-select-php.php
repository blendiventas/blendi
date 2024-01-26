<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "editar-ficha":
            $result = $conn->query("SELECT * FROM datos_empresa LIMIT 1");
            foreach ($result as $key => $valor) {
                $id_datos_empresa = $valor['id'];
                $nombre_fiscal_datos_empresa = $valor['nombre_fiscal'];
                $nombre_comercial_datos_empresa = $valor['nombre_comercial'];
                $nif_datos_empresa = $valor['nif'];
                $direccion_datos_empresa = $valor['direccion'];
                $codigo_postal_datos_empresa = $valor['codigo_postal'];
                $poblacion_datos_empresa = $valor['poblacion'];
                $provincia_datos_empresa = $valor['provincia'];
                $tel1_datos_empresa = $valor['tel1'];
                $tel2_datos_empresa = $valor['tel2'];
                $movil_datos_empresa = $valor['movil'];
                $fax_datos_empresa = $valor['fax'];
                $email_datos_empresa = $valor['email'];
                $tarifas_datos_empresa = $valor['tarifas'];
                $iva_incluido_datos_empresa = $valor['iva_incluido'];
                $logo_datos_empresa = $valor['logo'];
                $updated_datos_empresa = $valor['updated'];
            }

            $result = $conn->query("SELECT * FROM configuracion LIMIT 1");
            foreach ($result as $key => $valor) {
                $id_configuracion = $valor['id'];
                $id_librador_configuracion = $valor['id_librador'];
                $id_librador_tak_configuracion = $valor['id_librador_tak'];
                $servicio_domicilio_configuracion = $valor['servicio_domicilio'];
                $pvp_iva_incluido_configuracion = $valor['pvp_iva_incluido'];
                $mostrar_precios_tpv_configuracion = $valor['mostrar_precios_tpv'];
                $mostrar_mas_vendidos_configuracion = $valor['mostrar_mas_vendidos'];
                $color_letra_botones_configuracion = $valor['color_letra_botones'];
                $color_fondo_botones_configuracion = $valor['color_fondo_botones'];
                $tipo_menu_superior_configuracion = $valor['tipo_menu_superior'];
                $filas_menu_configuracion = $valor['filas_menu'];
                $decimales_cantidades_configuracion = $valor['decimales_cantidades'];
                $decimales_importes_configuracion = $valor['decimales_importes'];
                $fecha_modificacion_configuracion = $valor['fecha_modificacion'];
            }

            unset($conn);
            $url_web_datos_empresa = "";
            $conn = new db(0);
            $conn->query("SET NAMES 'utf8'");
            $id_panel = $result[0]['id_panel'];
            $result = $conn->query("SELECT dominio_ftp FROM identificacion_panel WHERE id='" . $id_panel_sys . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $url_web_datos_empresa = $result[0]['dominio_ftp'];
            }
            unset($conn);

            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_datos_empresa' => $id_datos_empresa,
                    'nombre_fiscal_datos_empresa' => $nombre_fiscal_datos_empresa,
                    'nombre_comercial_datos_empresa' => $nombre_comercial_datos_empresa,
                    'nif_datos_empresa' => $nif_datos_empresa,
                    'direccion_datos_empresa' => $direccion_datos_empresa,
                    'codigo_postal_datos_empresa' => $codigo_postal_datos_empresa,
                    'poblacion_datos_empresa' => $poblacion_datos_empresa,
                    'provincia_datos_empresa' => $provincia_datos_empresa,
                    'tel1_datos_empresa' => $tel1_datos_empresa,
                    'tel2_datos_empresa' => $tel2_datos_empresa,
                    'movil_datos_empresa' => $movil_datos_empresa,
                    'fax_datos_empresa' => $fax_datos_empresa,
                    'email_datos_empresa' => $email_datos_empresa,
                    'tarifas_datos_empresa' => $tarifas_datos_empresa,
                    'iva_incluido_datos_empresa' => $iva_incluido_datos_empresa,
                    'logo_datos_empresa' => $logo_datos_empresa,
                    'updated_datos_empresa' => $updated_datos_empresa,
                    'url_web_datos_empresa' => $url_web_datos_empresa
                ]);
            }
            break;
    }
}