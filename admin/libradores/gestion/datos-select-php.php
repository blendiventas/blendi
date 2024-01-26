<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT'] . "/admin/accesos/identificacion.php");

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
                $whereBusqueda .= " AND (razon_social LIKE '%" . addslashes($parametro_busqueda) . "%' OR razon_comercial LIKE '%" . addslashes($parametro_busqueda) . "%' OR nombre LIKE '%" . addslashes($parametro_busqueda) . "%' OR apellido_1 LIKE '%" . addslashes($parametro_busqueda) . "%' OR apellido_2 LIKE '%" . addslashes($parametro_busqueda) . "%' OR telefono_1 LIKE '%" . addslashes($parametro_busqueda) . "%' OR telefono_2 LIKE '%" . addslashes($parametro_busqueda) . "%' OR mobil LIKE '%" . addslashes($parametro_busqueda) . "%' OR persona_contacto LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }
            if (isset($parametro_filtro_habilitado)) {
                $whereBusqueda .= " AND activo = " . $parametro_filtro_habilitado . " ";
            }

            if($tipo == "cli" || $tipo == "tak" || $tipo == "del") {
                $result = $conn->query("SELECT COUNT(*) AS number_results FROM libradores WHERE (tipo = 'cli' OR tipo = 'tak' OR tipo = 'del')" . $whereBusqueda);
                $resultsListadoFiltrado = $result[0]['number_results'];
                $result = $conn->query("SELECT * FROM libradores WHERE (tipo = 'cli' OR tipo = 'tak' OR tipo = 'del')" . $whereBusqueda . " ORDER BY nombre, apellido_1, apellido_2, razon_social LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            }else {
                $result = $conn->query("SELECT COUNT(*) AS number_results FROM libradores WHERE tipo = '" . addslashes($tipo) . "'" . $whereBusqueda);
                $resultsListadoFiltrado = $result[0]['number_results'];
                $result = $conn->query("SELECT * FROM libradores WHERE tipo = '" . addslashes($tipo) . "'" . $whereBusqueda . " ORDER BY nombre, apellido_1, apellido_2, razon_social LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            }
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result as $key => $valor) {
                $matriz_id_libradores[] = $valor['id'];
                $matriz_codigo_librador_libradores[] = stripslashes($valor['codigo_librador']);
                $matriz_razon_social_libradores[] = stripslashes($valor['razon_social']);
                $matriz_razon_comercial_libradores[] = stripslashes($valor['razon_comercial']);
                $matriz_nombre_libradores[] = stripslashes($valor['nombre']);
                $matriz_apellido_1_libradores[] = stripslashes($valor['apellido_1']);
                $matriz_apellido_2_libradores[] = stripslashes($valor['apellido_2']);
                $matriz_telefono_1_libradores[] = stripslashes($valor['telefono_1']);
                $matriz_telefono_2_libradores[] = stripslashes($valor['telefono_2']);
                $matriz_mobil_libradores[] = stripslashes($valor['mobil']);
                $matriz_persona_contacto_libradores[] = stripslashes($valor['persona_contacto']);
                $matriz_activo_libradores[] = $valor['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_libradores' => $matriz_id_libradores,
                    'codigo_librador' => $matriz_codigo_librador_libradores,
                    'razon_social' => $matriz_razon_social_libradores,
                    'razon_comercial' => $matriz_razon_comercial_libradores,
                    'nombre_libradores' => $matriz_nombre_libradores,
                    'apellido_1_libradores' => $matriz_apellido_1_libradores,
                    'apellido_2_libradores' => $matriz_apellido_2_libradores,
                    'activo_libradores' => $matriz_activo_libradores
                ]);
            }
            break;
        case "listado-filtrado-sin-paginas":

            if($tipo == "cli" || $tipo == "tak" || $tipo == "del") {
                $result = $conn->query("SELECT COUNT(*) AS number_results FROM libradores WHERE (tipo = 'cli' OR tipo = 'tak' OR tipo = 'del')");
                $resultsListadoFiltrado = $result[0]['number_results'];
                $result = $conn->query("SELECT * FROM libradores WHERE (tipo = 'cli' OR tipo = 'tak' OR tipo = 'del') ORDER BY nombre, apellido_1, apellido_2, razon_social");
            }else {
                $result = $conn->query("SELECT COUNT(*) AS number_results FROM libradores WHERE tipo = '" . addslashes($tipo) . "'");
                $resultsListadoFiltrado = $result[0]['number_results'];
                $result = $conn->query("SELECT * FROM libradores WHERE tipo = '" . addslashes($tipo) . "' ORDER BY nombre, apellido_1, apellido_2, razon_social");
            }
            foreach ($result as $key => $valor) {
                $matriz_id_libradores[] = $valor['id'];
                $matriz_codigo_librador_libradores[] = stripslashes($valor['codigo_librador']);
                $matriz_razon_social_libradores[] = stripslashes($valor['razon_social']);
                $matriz_razon_comercial_libradores[] = stripslashes($valor['razon_comercial']);
                $matriz_nombre_libradores[] = stripslashes($valor['nombre']);
                $matriz_apellido_1_libradores[] = stripslashes($valor['apellido_1']);
                $matriz_apellido_2_libradores[] = stripslashes($valor['apellido_2']);
                $matriz_telefono_1_libradores[] = stripslashes($valor['telefono_1']);
                $matriz_telefono_2_libradores[] = stripslashes($valor['telefono_2']);
                $matriz_mobil_libradores[] = stripslashes($valor['mobil']);
                $matriz_persona_contacto_libradores[] = stripslashes($valor['persona_contacto']);
                $matriz_activo_libradores[] = $valor['activo'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_libradores' => $matriz_id_libradores,
                    'codigo_librador' => $matriz_codigo_librador_libradores,
                    'razon_social' => $matriz_razon_social_libradores,
                    'razon_comercial' => $matriz_razon_comercial_libradores,
                    'nombre_libradores' => $matriz_nombre_libradores,
                    'apellido_1_libradores' => $matriz_apellido_1_libradores,
                    'apellido_2_libradores' => $matriz_apellido_2_libradores,
                    'activo_libradores' => $matriz_activo_libradores
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url) || empty($tipo_libradores_url)) {
                $consulta_sql = "empty";
                $id_libradores = 0;
                $codigo_librador_libradores = "";
                $tipo_librador_libradores = "";
                $id_grupo_clientes_libradores = "";
                $nombre_libradores = "";
                $apellido_1_libradores = "";
                $apellido_2_libradores = "";
                $razon_social_libradores = "";
                $razon_comercial_libradores = "";
                $nif_libradores = "";
                $direccion_libradores = "";
                $numero_libradores = "";
                $escalera_libradores = "";
                $piso_libradores = "";
                $puerta_libradores = "";
                $localidad_libradores = "";
                $codigo_postal_libradores = "";
                $provincia_libradores = "";
                $id_zona_libradores = 0;
                $telefono_1_libradores = "";
                $telefono_2_libradores = "";
                $fax_libradores = "";
                $mobil_libradores = "";
                $email_libradores = "";
                $id_categoria_sms_libradores = 0;
                $id_categoria_email_libradores = 0;
                $persona_contacto_libradores = "";
                $banco_libradores = "";
                $entidad_libradores = "";
                $agencia_libradores = "";
                $dc_libradores = "";
                $cuenta_libradores = "";
                $iban_libradores = "";
                $sexo_libradores = 0;
                $fecha_nacimiento_libradores = null;
                $observaciones_libradores = "";
                $id_modalidades_envio_libradores = 1;
                $id_modalidades_entrega_libradores = 1;
                $id_modalidades_pago_libradores = 1;
                $plazo_entrega_libradores = 0;
                $id_iva_libradores = 0;
                $recargo_libradores = 0;
                $id_irpf_libradores = 0;
                $dia_pago_1_libradores = 0;
                $dia_pago_2_libradores = 0;
                $descuento_pp_libradores = 0.00;
                $descuento_librador_libradores = 0.00;
                $id_tarifa_web_libradores = 0;
                $id_tarifa_tpv_libradores = 0;
                $procedencia_libradores = "";
                $id_cliente_origen_libradores = 0;
                $id_vendedor_libradores = 0;
                $id_nivel_comisiones_libradores = 0;
                $activo_libradores = 1;
                $id_banco_cobro_libradores = 0;
                $imagen_mesa='';
                $imagen_mesa_ocupada='';
                $radio='0';
                $id_comedor='0';
                $comensales='0';
                $ancho_pos='0';
                $alto_pos='0';
                $ancho='0';
                $alto='0';
                $fecha_alta_libradores = "";
                $fecha_modificacion_libradores = "";
            }else {
                $consulta_sql = "SELECT * FROM libradores WHERE id=" . $id_url . " LIMIT 1";
                $result = $conn->query("SELECT * FROM libradores WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result as $key => $valor) {
                    $id_libradores = $valor['id'];
                    $codigo_librador_libradores = stripslashes($valor['codigo_librador']);
                    $tipo_librador_libradores = stripslashes($valor['tipo']);
                    $id_grupo_clientes_libradores = $valor['id_grupo_clientes'];
                    $razon_social_libradores = stripslashes($valor['razon_social']);
                    $razon_comercial_libradores = stripslashes($valor['razon_comercial']);
                    $nombre_libradores = stripslashes($valor['nombre']);
                    $apellido_1_libradores = stripslashes($valor['apellido_1']);
                    $apellido_2_libradores = stripslashes($valor['apellido_2']);
                    $nif_libradores = stripslashes($valor['nif']);
                    $direccion_libradores = stripslashes($valor['direccion']);
                    $numero_libradores = stripslashes($valor['numero']);
                    $escalera_libradores = stripslashes($valor['escalera']);
                    $piso_libradores = stripslashes($valor['piso']);
                    $puerta_libradores = stripslashes($valor['puerta']);
                    $localidad_libradores = stripslashes($valor['localidad']);
                    $codigo_postal_libradores = stripslashes($valor['codigo_postal']);
                    $provincia_libradores = stripslashes($valor['provincia']);
                    $id_zona_libradores = stripslashes($valor['id_zona']);
                    $telefono_1_libradores = stripslashes($valor['telefono_1']);
                    $telefono_2_libradores = stripslashes($valor['telefono_2']);
                    $fax_libradores = stripslashes($valor['fax']);
                    $mobil_libradores = stripslashes($valor['mobil']);
                    $email_libradores = stripslashes($valor['email']);
                    $password_acceso_libradores = stripslashes($valor['password_acceso']);
                    $id_categoria_sms_libradores = $valor['id_categoria_sms'];
                    $id_categoria_email_libradores = $valor['id_categoria_email'];
                    $persona_contacto_libradores = stripslashes($valor['persona_contacto']);
                    $banco_libradores = stripslashes($valor['banco']);
                    $entidad_libradores = stripslashes($valor['entidad']);
                    $agencia_libradores = stripslashes($valor['agencia']);
                    $dc_libradores = stripslashes($valor['dc']);
                    $cuenta_libradores = stripslashes($valor['cuenta']);
                    $iban_libradores = stripslashes($valor['iban']);
                    $sexo_libradores = stripslashes($valor['sexo']);
                    $fecha_nacimiento_libradores = stripslashes($valor['fecha_nacimiento']);
                    $observaciones_libradores = stripslashes($valor['observaciones']);
                    $id_modalidades_envio_libradores = stripslashes($valor['id_modalidades_envio']);
                    $id_modalidades_entrega_libradores = stripslashes($valor['id_modalidades_entrega']);
                    $id_modalidades_pago_libradores = stripslashes($valor['id_modalidades_pago']);
                    $plazo_entrega_libradores = stripslashes($valor['plazo_entrega']);
                    $id_iva_libradores = stripslashes($valor['id_iva']);
                    $recargo_libradores = stripslashes($valor['recargo']);
                    $id_irpf_libradores = stripslashes($valor['id_irpf']);
                    $dia_pago_1_libradores = stripslashes($valor['dia_pago_1']);
                    $dia_pago_2_libradores = stripslashes($valor['dia_pago_2']);
                    $descuento_pp_libradores = stripslashes($valor['descuento_pp']);
                    $descuento_librador_libradores = stripslashes($valor['descuento_librador']);
                    $id_tarifa_web_libradores = $valor['id_tarifa_web'];
                    $id_tarifa_tpv_libradores = $valor['id_tarifa_tpv'];
                    $procedencia_libradores = stripslashes($valor['procedencia']);
                    $id_cliente_origen_libradores = $valor['id_cliente_origen'];
                    $id_vendedor_libradores = $valor['id_vendedor'];
                    $id_nivel_comisiones_libradores = $valor['id_nivel_comisiones'];
                    $activo_libradores = $valor['activo'];
                    $id_banco_cobro_libradores = stripslashes($valor['id_banco_cobro']);
                    $imagen_mesa = stripslashes($valor['imagen_mesa']);
                    $imagen_mesa_ocupada = stripslashes($valor['imagen_mesa_ocupada']);
                    $radio = $valor['radio'];
                    $id_comedor = $valor['id_comedores'];
                    $comensales = $valor['comensales'];
                    $ancho_pos = $valor['ancho_pos'];
                    $alto_pos = $valor['alto_pos'];
                    $ancho = $valor['ancho'];
                    $alto = $valor['alto'];
                    $fecha_alta_libradores = $valor['fecha_alta'];
                    $fecha_modificacion_libradores = $valor['fecha_modificacion'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'prueba' => "Entra",
                    'consulta_sql' => $consulta_sql,
                    'id_libradores' => $id_libradores,
                    'codigo_librador_libradores' => $codigo_librador_libradores,
                    'tipo_librador_libradores' => $tipo_librador_libradores,
                    'id_grupo_clientes_libradores' => $id_grupo_clientes_libradores,
                    'razon_social' => $razon_social_libradores,
                    'razon_comercial' => $razon_comercial_libradores,
                    'nombre_libradores' => $nombre_libradores,
                    'apellido_1_libradores' => $apellido_1_libradores,
                    'apellido_2_libradores' => $apellido_2_libradores,
                    'nif_libradores' => $nif_libradores,
                    'direccion_libradores' => $direccion_libradores,
                    'numero_libradores' => $numero_libradores,
                    'escalera_libradores' => $escalera_libradores,
                    'piso_libradores' => $piso_libradores,
                    'puerta_libradores' => $puerta_libradores,
                    'localidad_libradores' => $localidad_libradores,
                    'codigo_postal_libradores' => $codigo_postal_libradores,
                    'provincia_libradores' => $provincia_libradores,
                    'id_zona_libradores' => $id_zona_libradores,
                    'telefono_1_libradores' => $telefono_1_libradores,
                    'telefono_2_libradores' => $telefono_2_libradores,
                    'fax_libradores' => $fax_libradores,
                    'mobil_libradores' => $mobil_libradores,
                    'email_libradores' => $email_libradores,
                    'password_acceso_libradores' => $password_acceso_libradores,
                    'id_categoria_sms_libradores' => $id_categoria_sms_libradores,
                    'id_categoria_email_libradores' => $id_categoria_email_libradores,
                    'persona_contacto_libradores' => $persona_contacto_libradores,
                    'banco_libradores' => $banco_libradores,
                    'entidad_libradores' => $entidad_libradores,
                    'agencia_libradores' => $agencia_libradores,
                    'dc_libradores' => $dc_libradores,
                    'cuenta_libradores' => $cuenta_libradores,
                    'iban_libradores' => $iban_libradores,
                    'sexo_libradores' => $sexo_libradores,
                    'fecha_nacimiento_libradores' => $fecha_nacimiento_libradores,
                    'observaciones_libradores' => $observaciones_libradores,
                    'id_modalidades_envio_libradores' => $id_modalidades_envio_libradores,
                    'id_modalidades_entrega_libradores' => $id_modalidades_entrega_libradores,
                    'id_modalidades_pago_libradores' => $id_modalidades_pago_libradores,
                    'plazo_entrega_libradores' => $plazo_entrega_libradores,
                    'id_iva_libradores' => $id_iva_libradores,
                    'recargo' => $recargo_libradores,
                    'id_irpf_libradores' => $id_irpf_libradores,
                    'dia_pago_1_libradores' => $dia_pago_1_libradores,
                    'dia_pago_2_libradores' => $dia_pago_2_libradores,
                    'descuento_pp_libradores' => $descuento_pp_libradores,
                    'descuento_librador_libradores' => $descuento_librador_libradores,
                    'id_tarifa_web_libradores' => $id_tarifa_web_libradores,
                    'id_tarifa_tpv_libradores' => $id_tarifa_tpv_libradores,
                    'procedencia_libradores' => $procedencia_libradores,
                    'id_cliente_origen_libradores' => $id_cliente_origen_libradores,
                    'id_vendedor_libradores' => $id_vendedor_libradores,
                    'id_nivel_comisiones_libradores' => $id_nivel_comisiones_libradores,
                    'activo_libradores' => $activo_libradores,
                    'id_banco_cobro_libradores' => $id_banco_cobro_libradores,
                    'imagen_mesa' => $imagen_mesa,
                    'imagen_mesa_ocupada' => $imagen_mesa_ocupada,
                    'radio' => $radio,
                    'id_comedor' => $id_comedor,
                    'comensales' => $comensales,
                    'ancho_pos' => $ancho_pos,
                    'alto_pos' => $alto_pos,
                    'ancho' => $ancho,
                    'alto' => $alto,
                    'fecha_alta_libradores' => $fecha_alta_libradores,
                    'fecha_modificacion_libradores' => $fecha_modificacion_libradores
                ]);
            }
            break;
        case "listado-costes-importes":
            $result = $conn->query("SELECT productos.id AS id_producto,productos.descripcion AS descripcion,libradores_productos.id AS id,libradores_productos.coste_importe AS coste_importe 
                        FROM libradores_productos,productos 
                        WHERE libradores_productos.id_librador=".$id_url." AND libradores_productos.id_producto=productos.id 
                        ORDER BY productos.descripcion");

            foreach ($result as $key => $valor) {
                $matriz_id_producto_libradores_productos[] = $valor['id_producto'];
                $matriz_descripcion_libradores_productos[] = stripslashes($valor['descripcion']);
                $matriz_id_libradores_productos[] = $valor['id'];
                $matriz_coste_importe_libradores_productos[] = $valor['coste_importe'];
            }
            break;
    }
}