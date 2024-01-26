<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$matriz_logs_sys[] = "Panel: ".$id_panel_sys;

if($select_sys =="inicio" OR $select_sys =="id-password" OR $select_sys =="registros") {
    $identificacion_acceso_sys = true;
}else {
    $matriz_logs_sys[] = "Comprobar identificacion";
    require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
    $matriz_logs_sys[] = "Identificacion comprobada";
}
if($identificacion_acceso_sys == true) {
    $matriz_logs_sys[] = "Acceso correcto";
    switch ($select_sys) {
        case "inicio":
            $matriz_logs_sys[] = "SELECT id,usuario,avatar,password FROM usuarios WHERE bloqueo=0 ORDER BY usuario<br />";
            $result_usuarios = $conn->query("SELECT id,usuario,avatar,password FROM usuarios WHERE bloqueo=0 ORDER BY usuario");
            foreach ($result_usuarios as $key_usuarios => $valor_usuarios) {
                $matriz_id_usuarios[] = $valor_usuarios['id'];
                $matriz_usuario_usuarios[] = stripslashes($valor_usuarios['usuario']);
                $matriz_avatar_usuarios[] = $valor_usuarios['avatar'];
                $matriz_password_usuarios[] = $valor_usuarios['password'];
            }
            if (isset($ajax)) {
                echo json_encode([
                    'logs' => $matriz_logs_sys,
                    'id' => $matriz_id_usuarios,
                    'usuario' => $matriz_usuario_usuarios,
                    'avatar' => $matriz_avatar_usuarios
                ]);
            }
            break;
        case "id-password":
            $correcto_sys = false;
            $sector = '';
            $result_usuarios = $conn->query("SELECT id,terminal FROM usuarios WHERE id=" . $id_usuario_sys . " AND password='" . addslashes($password_usuario_sys) . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $correcto_sys = true;
                if($result_usuarios[0]['terminal'] == -1) {
                    $id_terminal_sys = 1;
                }else {
                    $id_terminal_sys = $result_usuarios[0]['terminal'];
                }
                $result = $conn->query("UPDATE usuarios_accesos SET activo=0 WHERE sesion='" . $id_sesion_sys . "' AND activo=1");
                $dia_sys = date("Y-m-d");
                $hora_sys = date("H:i:s");
                $result = $conn->query("INSERT INTO usuarios_accesos VALUES(
                                        NULL,
                                        " . $id_usuario_sys . ",
                                        '" . $id_sesion_sys . "',
                                        '" . addslashes($ip_sys) . "',
                                        '" . $dia_sys . "',
                                        '" . $hora_sys . "',
                                        '1',
                                        '" . $id_terminal_sys . "')");

                $conn_ctic = new db(0);
                $conn_ctic->query("SET NAMES 'utf8'");
                $result_ctic = $conn_ctic->query("SELECT sector FROM identificacion_panel WHERE id = " . $id_panel_sys . " LIMIT 1");
                if ($conn_ctic->registros() == 1) {
                    $sector = stripslashes($result_ctic[0]['sector']);
                }
                unset($conn_ctic);
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'correcto' => $correcto_sys,
                    'sector' => $sector
                ]);
            }
            break;
        case "registros":
            $matriz_logs_sys[] = "SELECT COUNT(id) AS registros FROM usuarios WHERE bloqueo=0";
            $result = $conn->query("SELECT COUNT(id) AS registros FROM usuarios WHERE bloqueo=0");
            $registros_sys = $result[0]['registros'];
            if (isset($ajax)) {
                echo json_encode([
                    'logs' => $matriz_logs_sys,
                    'registros' => $registros_sys
                ]);
            }
            break;
        case "listado-filtrado":
            if (!isset($parametro_pagina)) {
                $parametro_pagina = 0;
            }
            if (!isset($parametro_resultados)) {
                $parametro_resultados = 10;
            }

            $whereBusqueda = '';
            if (isset($parametro_busqueda) && !empty($parametro_busqueda)) {
                $whereBusqueda .= " AND (usuario LIKE '%" . addslashes($parametro_busqueda) . "%') ";
            }
            if (isset($parametro_filtro_habilitado)) {
                $whereBusqueda .= " AND bloqueo = " . $parametro_filtro_habilitado . " ";
            }

            $result = $conn->query("SELECT COUNT(*) AS number_results FROM usuarios WHERE id<>0" . $whereBusqueda);
            $resultsListadoFiltrado = $result[0]['number_results'];
            $result_usuarios = $conn->query("SELECT id,usuario,terminal,bloqueo,avatar FROM usuarios WHERE id<>0" . $whereBusqueda . " ORDER BY usuario LIMIT " . ($parametro_resultados * $parametro_pagina) . "," . $parametro_resultados);
            $cantidadPaginas = ceil($resultsListadoFiltrado / $parametro_resultados);
            foreach ($result_usuarios as $key_usuarios => $valor_usuarios) {
                if ($valor_usuarios['terminal'] == -1) {
                    $matriz_descripcion_terminal[] = "Acceso a todos los terminales";
                }else {
                    $result_terminales = $conn->query("SELECT descripcion FROM terminales WHERE id=" . $valor_usuarios['terminal'] . " LIMIT 1");
                    if ($conn->registros() == 1) {
                        $matriz_descripcion_terminal[] = stripslashes($result_terminales[0]['descripcion']);
                    }else {
                        $matriz_descripcion_terminal[] = "<span style='color: red;'>Error de asignación de terminal.</span>";
                    }
                }
                $matriz_id_usuarios[] = $valor_usuarios['id'];
                $matriz_usuario_usuarios[] = stripslashes($valor_usuarios['usuario']);
                $matriz_bloqueo_usuarios[] = $valor_usuarios['bloqueo'];
                $matriz_avatar_usuarios[] = $valor_usuarios['avatar'];
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'matriz_id_usuarios' => $matriz_id_usuarios,
                    'matriz_usuario_usuarios' => $matriz_usuario_usuarios,
                    'matriz_descripcion_usuarios' => $matriz_descripcion_terminal,
                    'matriz_bloqueo_usuarios' => $matriz_bloqueo_usuarios
                ]);
            }
            break;
        case "editar-ficha":
            if(empty($id_url)) {
                $id_usuarios = 0;
                $usuario_usuarios = "";
                $password_usuarios = "";
                $bloqueo_usuarios = 0;
                $dark_usuarios = 0;
                $avatar = '1';
            }else {
                $result_usuarios = $conn->query("SELECT * FROM usuarios WHERE id=" . $id_url . " LIMIT 1");
                foreach ($result_usuarios as $key_usuarios => $valor_usuarios) {
                    $id_usuarios = $valor_usuarios['id'];
                    $usuario_usuarios = stripslashes($valor_usuarios['usuario']);
                    $password_usuarios = stripslashes($valor_usuarios['password']);
                    $id_terminal_usuarios = $valor_usuarios['terminal'];
                    $bloqueo_usuarios = $valor_usuarios['bloqueo'];
                    $dark_usuarios = $valor_usuarios['dark'];
                    $avatar = $valor_usuarios['avatar'];
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'id_usuarios' => $id_usuarios,
                    'usuario_usuarios' => $usuario_usuarios,
                    'password_usuarios' => $password_usuarios,
                    'bloqueo_usuarios' => $bloqueo_usuarios
                ]);
            }
            break;
        case "editar-ficha-permisos":
            $result_permisos_usuarios = $conn->query("SELECT * FROM usuarios_permisos WHERE id_usuario=" . $id_url . " LIMIT 1");
            foreach ($result_permisos_usuarios as $key_permisos_usuarios => $valor_permisos_usuarios) {
                $menu_clientes_usuarios_permisos = $valor_permisos_usuarios['menu_clientes'];
                $clientes_usuarios_permisos = $valor_permisos_usuarios['clientes'];
                $presupuestos_clientes_usuarios_permisos = $valor_permisos_usuarios['presupuestos_clientes'];
                $pedidos_clientes_usuarios_permisos = $valor_permisos_usuarios['pedidos_clientes'];
                $albaranes_clientes_usuarios_permisos = $valor_permisos_usuarios['albaranes_clientes'];
                $facturas_clientes_usuarios_permisos = $valor_permisos_usuarios['facturas_clientes'];
                $tiquets_clientes_usuarios_permisos = $valor_permisos_usuarios['tiquets_clientes'];
                $mesas_usuarios_permisos = $valor_permisos_usuarios['mesas'];
                $zonas_usuarios_permisos = $valor_permisos_usuarios['zonas'];
                $modalidades_envio_usuarios_permisos = $valor_permisos_usuarios['modalidades_envio'];
                $modalidades_entrega_usuarios_permisos = $valor_permisos_usuarios['modalidades_entrega'];
                $modalidades_pago_usuarios_permisos = $valor_permisos_usuarios['modalidades_pago'];
                $menu_proveedores_usuarios_permisos = $valor_permisos_usuarios['menu_proveedores'];
                $proveedores_usuarios_permisos = $valor_permisos_usuarios['proveedores'];
                $presupuestos_proveedores_usuarios_permisos = $valor_permisos_usuarios['presupuestos_proveedores'];
                $pedidos_proveedores_usuarios_permisos = $valor_permisos_usuarios['pedidos_proveedores'];
                $albaranes_proveedores_usuarios_permisos = $valor_permisos_usuarios['albaranes_proveedores'];
                $facturas_proveedores_usuarios_permisos = $valor_permisos_usuarios['facturas_proveedores'];
                $tiquets_proveedores_usuarios_permisos = $valor_permisos_usuarios['tiquets_proveedores'];
                $menu_creditores_usuarios_permisos = $valor_permisos_usuarios['menu_creditores'];
                $creditores_usuarios_permisos = $valor_permisos_usuarios['creditores'];
                $presupuestos_creditores_usuarios_permisos = $valor_permisos_usuarios['presupuestos_creditores'];
                $pedidos_creditores_usuarios_permisos = $valor_permisos_usuarios['pedidos_creditores'];
                $albaranes_creditores_usuarios_permisos = $valor_permisos_usuarios['albaranes_creditores'];
                $facturas_creditores_usuarios_permisos = $valor_permisos_usuarios['facturas_creditores'];
                $tiquets_creditores_usuarios_permisos = $valor_permisos_usuarios['tiquets_creditores'];
                $menu_productos_usuarios_permisos = $valor_permisos_usuarios['menu_productos'];
                $productos_usuarios_permisos = $valor_permisos_usuarios['productos'];
                $categorias_usuarios_permisos = $valor_permisos_usuarios['categorias'];
                $detalles_productos_usuarios_permisos = $valor_permisos_usuarios['detalles_productos'];
                $categorias_elaborados_usuarios_permisos = $valor_permisos_usuarios['categorias_elaborados'];
                $grupos_productos_usuarios_permisos = $valor_permisos_usuarios['grupos'];
                $menu_listados_usuarios_permisos = $valor_permisos_usuarios['menu_listados'];
                $stocks_listados_usuarios_permisos = $valor_permisos_usuarios['stocks_listados'];
                $mas_vendidos_listados_usuarios_permisos = $valor_permisos_usuarios['mas_vendidos_listados'];
                $recepcion_pedidos_permisos = $valor_permisos_usuarios['recepcion_pedidos'];
                $menu_general_usuarios_permisos = $valor_permisos_usuarios['menu_general'];
                $tipos_iva_usuarios_permisos = $valor_permisos_usuarios['tipos_iva'];
                $tipos_irpf_usuarios_permisos = $valor_permisos_usuarios['tipos_irpf'];
                $bancos_cajas_usuarios_permisos = $valor_permisos_usuarios['bancos_cajas'];
                $tarifas_usuarios_permisos = $valor_permisos_usuarios['tarifas'];
                $usuarios_usuarios_permisos = $valor_permisos_usuarios['usuarios'];
                $idiomas_usuarios_permisos = $valor_permisos_usuarios['idiomas'];
                $datos_empresa_usuarios_permisos = $valor_permisos_usuarios['datos_empresa'];
                $impresion_documentos_usuarios_permisos = $valor_permisos_usuarios['impresion_documentos'];
                $iconos_usuarios_permisos = $valor_permisos_usuarios['iconos'];
                $gestor_permisos = $valor_permisos_usuarios['gestor'];
                $terminales_permisos = $valor_permisos_usuarios['terminales'];
            }
            break;
        case "editar-ficha-accesos":
            $result_accesos_usuarios = $conn->query("SELECT ua.*, t.descripcion as terminal FROM usuarios_accesos ua JOIN terminales t ON ua.id_terminal = t.id WHERE ua.id_usuario=" . $id_url . " ORDER BY ua.dia DESC, ua.hora DESC LIMIT 500");
            foreach ($result_accesos_usuarios as $key_accesos_usuarios => $valor_accesos_usuarios) {
                $ip[] = $valor_accesos_usuarios['ip'];
                $dia[] = $valor_accesos_usuarios['dia'];
                $hora[] = $valor_accesos_usuarios['hora'];
                $terminal_accesos[] = $valor_accesos_usuarios['terminal'];
            }
            break;
    }
}