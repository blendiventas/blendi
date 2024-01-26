<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "principal":
        $result = $conn->query("SELECT * FROM datos_empresa WHERE id=1");

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
            $iban_datos_empresa = $valor['iban'];
            $software_blendi_datos_empresa = $valor['software_blendi'];
            $plan_blendi_datos_empresa = $valor['plan_blendi'];
            $teminales_adicionales_datos_empresa = $valor['teminales_adicionales'];
            $fecha_inicio_plan_datos_empresa = $valor['fecha_inicio_plan'];
            if ($fecha_inicio_plan_datos_empresa) {
                $fecha_inicio_plan_datos_empresa = new DateTime($fecha_inicio_plan_datos_empresa);
            } else {
                $fecha_inicio_plan_datos_empresa = new DateTime();
            }
            $logo_datos_empresa = $valor['logo'];
            $updated_datos_empresa = $valor['updated'];
        }

        $result = $conn->query("SELECT * FROM datos_configuracion_inicial WHERE id=1");

        $porcentaje_carta_configuracion_inicial = 0;
        $porcentaje_usuarios_configuracion_inicial = 0;
        $porcentaje_datos_facturacion_configuracion_inicial = 0;
        $porcentaje_datos_personales_configuracion_inicial = 0;
        foreach ($result as $key => $valor) {
            $id_datos_configuracion_inicial = $valor['id'];
            $step1_datos_configuracion_inicial = $valor['step1'];
            $step2_datos_configuracion_inicial = $valor['step2'];
            $step3_datos_configuracion_inicial = $valor['step3'];
            $step4_datos_configuracion_inicial = $valor['step4'];
            $plan_datos_configuracion_inicial = $valor['plan'];
            $porcentaje_carta_configuracion_inicial = $valor['porcentaje_carta'];
            $porcentaje_usuarios_configuracion_inicial = $valor['porcentaje_usuarios'];
            $porcentaje_datos_facturacion_configuracion_inicial = $valor['porcentaje_datos_facturacion'];
            $porcentaje_datos_personales_configuracion_inicial = $valor['porcentaje_datos_personales'];
        }

        $id_grupo_clientes_prioritario = 0;
        $descripcion_grupo_clientes_prioritario = '';
        if (!empty($tienda)) {
            $result = $conn->query("SELECT * FROM grupos_clientes WHERE prioritario=1 LIMIT 1");

            foreach ($result as $key => $valor) {
                $id_grupo_clientes_prioritario = $valor['id'];
                $descripcion_grupo_clientes_prioritario = $valor['descripcion'];
            }
        }

        if (isset($id_usuario) && $id_usuario == 1 && isset($ruta_sys) && $ruta_sys == 'home/') {
            $porcentaje_carta_configuracion_inicial_anterior = $porcentaje_carta_configuracion_inicial;
            if ($porcentaje_carta_configuracion_inicial != 100) {
                $porcentaje_carta_configuracion_inicial = 0;

                $numeroCategorias = $conn->query("SELECT * FROM categorias WHERE id <> 0");
                $numeroCategorias = $conn->registros();
                if ($numeroCategorias > 0) {
                    $porcentaje_carta_configuracion_inicial += ($numeroCategorias > 1)? 50 : 25;
                }

                $numeroProductos = $conn->query("SELECT * FROM productos WHERE id <> 0");
                $numeroProductos = $conn->registros();
                if ($numeroProductos > 0) {
                    $porcentaje_carta_configuracion_inicial += ($numeroProductos > 1)? 50 : 25;
                }
            }

            $porcentaje_usuarios_configuracion_inicial_anterior = $porcentaje_usuarios_configuracion_inicial;
            if ($porcentaje_usuarios_configuracion_inicial != 100) {
                $porcentaje_usuarios_configuracion_inicial = 0;

                $numeroUsuarios = $conn->query("SELECT * FROM usuarios WHERE id <> 0");
                $numeroUsuarios = $conn->registros();
                if ($numeroUsuarios > 0) {
                    $porcentaje_usuarios_configuracion_inicial += ($numeroUsuarios > 1)? 100 : 50;
                }
            }

            $porcentaje_datos_facturacion_configuracion_inicial_anterior = $porcentaje_datos_facturacion_configuracion_inicial;
            if ($porcentaje_datos_facturacion_configuracion_inicial != 100) {
                $porcentaje_datos_facturacion_configuracion_inicial = 0;

                $porcentaje_datos_facturacion_configuracion_inicial += ($nombre_fiscal_datos_empresa != '')? 20 : 0;
                $porcentaje_datos_facturacion_configuracion_inicial += ($nif_datos_empresa != '')? 20 : 0;
                $porcentaje_datos_facturacion_configuracion_inicial += ($direccion_datos_empresa != '')? 10 : 0;
                $porcentaje_datos_facturacion_configuracion_inicial += ($codigo_postal_datos_empresa != '')? 10 : 0;
                $porcentaje_datos_facturacion_configuracion_inicial += ($poblacion_datos_empresa != '')? 10 : 0;
                $porcentaje_datos_facturacion_configuracion_inicial += ($provincia_datos_empresa != '')? 10 : 0;
                $porcentaje_datos_facturacion_configuracion_inicial += ($tel1_datos_empresa != '' || $movil_datos_empresa != '' || $email_datos_empresa != '')? 20 : 0;
            }

            $porcentaje_datos_personales_configuracion_inicial_anterior = $porcentaje_datos_personales_configuracion_inicial;
            if ($porcentaje_datos_personales_configuracion_inicial != 100) {
                $porcentaje_datos_personales_configuracion_inicial = 0;

                $porcentaje_datos_personales_configuracion_inicial += (!empty($plan_blendi_datos_empresa))? 50 : 0;
                $porcentaje_datos_personales_configuracion_inicial += (!empty($logo_datos_empresa) && $logo_datos_empresa != 'logo.gif')? 50 : 0;
            }

            if (
                $porcentaje_carta_configuracion_inicial_anterior != $porcentaje_carta_configuracion_inicial ||
                $porcentaje_usuarios_configuracion_inicial_anterior != $porcentaje_usuarios_configuracion_inicial ||
                $porcentaje_datos_facturacion_configuracion_inicial_anterior != $porcentaje_datos_facturacion_configuracion_inicial ||
                $porcentaje_datos_personales_configuracion_inicial_anterior != $porcentaje_datos_personales_configuracion_inicial
            ) {
                $result = $conn->query("UPDATE datos_configuracion_inicial SET 
                        porcentaje_carta = " . $porcentaje_carta_configuracion_inicial . ", 
                        porcentaje_usuarios = " . $porcentaje_usuarios_configuracion_inicial . ", 
                        porcentaje_datos_facturacion = " . $porcentaje_datos_facturacion_configuracion_inicial . ", 
                        porcentaje_datos_personales = " . $porcentaje_datos_personales_configuracion_inicial . " 
                    WHERE id=1");
            }
        }

        $result_comedores = $conn->query("SELECT id FROM comedores WHERE activo=1");
        $total_mesas_primer_comedor = 0;
        if ($conn->registros() < 1) {
            $existen_mesas = false;
            $mesas_mostrar = false;
        } else {
            $existen_mesas = true;
            $mesas_mostrar = true;

            if (isset($id_usuario) && $id_usuario == 1 && isset($ruta_sys) && $ruta_sys == 'home/') {
                $result_total_mesas_comedores = $conn->query("SELECT COUNT(id) AS total_mesas FROM libradores WHERE id_comedores=" . $result_comedores[0]['id']);
                if ($conn->registros() > 0) {
                    $total_mesas_primer_comedor = $result_total_mesas_comedores[0]['total_mesas'];
                }
            }
        }

        $productos_por_grupo_home = [];
        if (isset($id_usuario) && $id_usuario == 1 && isset($ruta_sys) && $ruta_sys == 'home/') {
            $result_productos_por_grupo_home = $conn->query("SELECT prg.descripcion AS descripcion, COUNT(pc.id_producto) AS total_productos FROM productos_relacionados_grupos prg JOIN categorias c ON prg.id = c.id_grupo JOIN productos_categorias pc ON c.id = pc.id_categoria GROUP BY prg.descripcion ORDER BY COUNT(pc.id_producto) DESC");

            $countGrupos = 0;
            foreach ($result_productos_por_grupo_home as $value_productos_por_grupo_home) {
                if ($countGrupos > 3) {
                    break;
                }
                $new_productos_por_grupo_home = new stdClass();
                $new_productos_por_grupo_home->grupo = $value_productos_por_grupo_home['descripcion'];
                $new_productos_por_grupo_home->productos = $value_productos_por_grupo_home['total_productos'];
                $productos_por_grupo_home[] = $new_productos_por_grupo_home;

                $countGrupos++;
            }
        }
        break;
}
unset($conn);