<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = "";

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result_usuarios = $conn->query("SELECT bloqueo FROM usuarios WHERE id=" . $id_usuarios . " LIMIT 1");
            if ($result_usuarios[0]['bloqueo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result_usuarios = $conn->query("UPDATE usuarios SET bloqueo=" . $valor_sys . " WHERE id=" . $id_usuarios . " LIMIT 1");
            $logs_sys .= "UPDATE usuarios SET bloqueo=" . $valor_sys . " WHERE id=" . $id_usuarios . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar-dark-mode":
            $result_usuarios_accesos = $conn->query("SELECT id_usuario FROM usuarios_accesos WHERE sesion='" . $id_sesion_sys . "' AND activo=1 LIMIT 1");
            if (empty($result_usuarios_accesos[0])) {
                throw new Exception('Usuario no encontrado.');
            }
            $id_usuarios = $result_usuarios_accesos[0]['id_usuario'];

            $result_usuarios = $conn->query("UPDATE usuarios SET  
                  dark='".(($dark_usuarios == 'true') ? 1 : 0)."' 
                  WHERE id=" . $id_usuarios . " LIMIT 1");
            $resultado_sys = "UPDATE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => '',
                    'id' => $id_usuarios,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardar":
            if(empty($id_usuarios)) {
                $logs_sys .= "INSERT INTO usuarios VALUES(
                              NULL,
                              '" . addslashes($usuario_usuarios) . "',
                              '" . addslashes($password_usuarios) . "',
                              '" . $id_terminal_usuarios . "',
                              '" . $id_empresa_usuarios . "',
                              '" . $id_idioma_usuarios . "',
                              '" . $bloqueo_usuarios . "',
                              '" . $dark_usuarios . "',
                              '" . $id_comercial_usuarios . "',
                              '" . $avatar_usuarios . "')<br />";
                $result_tarifas = $conn->query("INSERT INTO usuarios VALUES(
                              NULL,
                              '" . addslashes($usuario_usuarios) . "',
                              '" . addslashes($password_usuarios) . "',
                              '" . $id_terminal_usuarios . "',
                              '" . $id_empresa_usuarios . "',
                              '" . $id_idioma_usuarios . "',
                              '" . $bloqueo_usuarios . "',
                              '" . $dark_usuarios . "',
                              '" . $id_comercial_usuarios . "',
                              '" . $avatar_usuarios . "')");

                $id_usuarios = $conn->id_insert();

                if (isset($permisos_usuarios) && $permisos_usuarios == 1) {
                    $queryPermisos = "INSERT INTO `usuarios_permisos` (`id`, `id_usuario`, `menu_clientes`, `clientes`, `presupuestos_clientes`, `pedidos_clientes`, `albaranes_clientes`, `facturas_clientes`, `tiquets_clientes`, `mesas`, `zonas`, `modalidades_envio`, `modalidades_entrega`, `modalidades_pago`, `menu_proveedores`, `proveedores`, `presupuestos_proveedores`, `pedidos_proveedores`, `albaranes_proveedores`, `facturas_proveedores`, `tiquets_proveedores`, `menu_creditores`, `creditores`, `presupuestos_creditores`, `pedidos_creditores`, `albaranes_creditores`, `facturas_creditores`, `tiquets_creditores`, `menu_productos`, `productos`, `categorias`, `categorias_elaborados`, `detalles_productos`, `grupos`, `menu_listados`, `stocks_listados`, `mas_vendidos_listados`, `recepcion_pedidos`, `menu_general`, `tipos_iva`, `tipos_irpf`, `bancos_cajas`, `tarifas`, `usuarios`, `idiomas`, `datos_empresa`, `impresion_documentos`, `iconos`, `gestor`, `terminales`) VALUES (NULL, ".$id_usuarios.", 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 0, 1);";
                } else if (isset($permisos_usuarios) && ($permisos_usuarios == 2 || $permisos_usuarios == 3 || $permisos_usuarios == 4)) {
                    $queryPermisos = "INSERT INTO `usuarios_permisos` (`id`, `id_usuario`, `menu_clientes`, `clientes`, `presupuestos_clientes`, `pedidos_clientes`, `albaranes_clientes`, `facturas_clientes`, `tiquets_clientes`, `mesas`, `zonas`, `modalidades_envio`, `modalidades_entrega`, `modalidades_pago`, `menu_proveedores`, `proveedores`, `presupuestos_proveedores`, `pedidos_proveedores`, `albaranes_proveedores`, `facturas_proveedores`, `tiquets_proveedores`, `menu_creditores`, `creditores`, `presupuestos_creditores`, `pedidos_creditores`, `albaranes_creditores`, `facturas_creditores`, `tiquets_creditores`, `menu_productos`, `productos`, `categorias`, `categorias_elaborados`, `detalles_productos`, `grupos`, `menu_listados`, `stocks_listados`, `mas_vendidos_listados`, `recepcion_pedidos`, `menu_general`, `tipos_iva`, `tipos_irpf`, `bancos_cajas`, `tarifas`, `usuarios`, `idiomas`, `datos_empresa`, `impresion_documentos`, `iconos`, `gestor`, `terminales`) VALUES (NULL, ".$id_usuarios.", 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);";
                } else {
                    $queryPermisos = "INSERT INTO `usuarios_permisos` (`id`, `id_usuario`, `menu_clientes`, `clientes`, `presupuestos_clientes`, `pedidos_clientes`, `albaranes_clientes`, `facturas_clientes`, `tiquets_clientes`, `mesas`, `zonas`, `modalidades_envio`, `modalidades_entrega`, `modalidades_pago`, `menu_proveedores`, `proveedores`, `presupuestos_proveedores`, `pedidos_proveedores`, `albaranes_proveedores`, `facturas_proveedores`, `tiquets_proveedores`, `menu_creditores`, `creditores`, `presupuestos_creditores`, `pedidos_creditores`, `albaranes_creditores`, `facturas_creditores`, `tiquets_creditores`, `menu_productos`, `productos`, `categorias`, `categorias_elaborados`, `detalles_productos`, `grupos`, `menu_listados`, `stocks_listados`, `mas_vendidos_listados`, `recepcion_pedidos`, `menu_general`, `tipos_iva`, `tipos_irpf`, `bancos_cajas`, `tarifas`, `usuarios`, `idiomas`, `datos_empresa`, `impresion_documentos`, `iconos`, `gestor`, `terminales`) VALUES (NULL, ".$id_usuarios.", 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);";
                }
                $result_permisos = $conn->query($queryPermisos);

                $resultado_sys = "INSERT";
            }else {
                $logs_sys .= "UPDATE usuarios SET  
                  usuario='" . addslashes($usuario_usuarios) . "', 
                  password='" . $password_usuarios . "', 
                  terminal='" . $id_terminal_usuarios . "', 
                  bloqueo='".$bloqueo_usuarios."',
                  dark='".$dark_usuarios."',
                  avatar='" . $avatar_usuarios . "' 
                  WHERE id=" . $id_usuarios . " LIMIT 1<br />";

                $result_tarifas = $conn->query("UPDATE usuarios SET  
                  usuario='" . addslashes($usuario_usuarios) . "', 
                  password='" . $password_usuarios . "', 
                  terminal='" . $id_terminal_usuarios . "', 
                  bloqueo='".$bloqueo_usuarios."',
                  dark='".$dark_usuarios."',
                  avatar='" . $avatar_usuarios . "' 
                  WHERE id=" . $id_usuarios . " LIMIT 1");

                $resultado_sys = "UPDATE";
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_usuarios,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "guardar-permisos":
            $logs_sys .= "UPDATE usuarios_permisos SET  
                menu_clientes=".$menu_clientes_usuarios_permisos.",
                clientes=".$clientes_usuarios_permisos.",
                presupuestos_clientes=".$presupuestos_clientes_usuarios_permisos.",
                pedidos_clientes=".$pedidos_clientes_usuarios_permisos.",
                albaranes_clientes=".$albaranes_clientes_usuarios_permisos.",
                facturas_clientes=".$facturas_clientes_usuarios_permisos.",
                tiquets_clientes=".$tiquets_clientes_usuarios_permisos.",
                mesas=".$mesas_usuarios_permisos.",
                zonas=".$zonas_usuarios_permisos.",
                modalidades_envio=".$modalidades_envio_usuarios_permisos.",
                modalidades_entrega=".$modalidades_entrega_usuarios_permisos.",
                modalidades_pago=".$modalidades_pago_usuarios_permisos.",
                menu_proveedores=".$menu_proveedores_usuarios_permisos.",
                proveedores=".$proveedores_usuarios_permisos.",
                presupuestos_proveedores=".$presupuestos_proveedores_usuarios_permisos.",
                pedidos_proveedores=".$pedidos_proveedores_usuarios_permisos.",
                albaranes_proveedores=".$albaranes_proveedores_usuarios_permisos.",
                facturas_proveedores=".$facturas_proveedores_usuarios_permisos.",
                tiquets_proveedores=".$tiquets_proveedores_usuarios_permisos.",
                menu_creditores=".$menu_creditores_usuarios_permisos.",
                creditores=".$creditores_usuarios_permisos.",
                presupuestos_creditores=".$presupuestos_creditores_usuarios_permisos.",
                pedidos_creditores=".$pedidos_creditores_usuarios_permisos.",
                albaranes_creditores=".$albaranes_creditores_usuarios_permisos.",
                facturas_creditores=".$facturas_creditores_usuarios_permisos.",
                tiquets_creditores=".$tiquets_creditores_usuarios_permisos.",
                menu_productos=".$menu_productos_usuarios_permisos.",
                productos=".$productos_usuarios_permisos.",
                categorias=".$categorias_usuarios_permisos.",
                detalles_productos=".$detalles_productos_usuarios_permisos.",
                categorias_elaborados=".$categorias_elaborados_usuarios_permisos.",
                grupos=".$grupos_usuarios_permisos.",
                menu_listados=".$menu_listados_usuarios_permisos.",
                stocks_listados=".$stocks_listados_usuarios_permisos.",
                mas_vendidos_listados=".$mas_vendidos_listados_usuarios_permisos.",
                recepcion_pedidos=".$recepcion_pedidos_permisos.",
                menu_general=".$menu_general_usuarios_permisos.",
                tipos_iva=".$tipos_iva_usuarios_permisos.",
                tipos_irpf=".$tipos_irpf_usuarios_permisos.",
                bancos_cajas=".$bancos_cajas_usuarios_permisos.",
                tarifas=".$tarifas_usuarios_permisos.",
                usuarios=".$usuarios_usuarios_permisos.",
                idiomas=".$idiomas_usuarios_permisos.",
                datos_empresa=".$datos_empresa_usuarios_permisos.",
                impresion_documentos=".$impresion_documentos_usuarios_permisos.",
                iconos=".$iconos_usuarios_permisos.",
                gestor=".$gestor_permisos." ,
                terminales=".$terminales_permisos." ,
              WHERE id_usuario=" . $id_usuarios . " LIMIT 1";

            $result_permisos = $conn->query("UPDATE usuarios_permisos SET  
                menu_clientes=".$menu_clientes_usuarios_permisos.",
                clientes=".$clientes_usuarios_permisos.",
                presupuestos_clientes=".$presupuestos_clientes_usuarios_permisos.",
                pedidos_clientes=".$pedidos_clientes_usuarios_permisos.",
                albaranes_clientes=".$albaranes_clientes_usuarios_permisos.",
                facturas_clientes=".$facturas_clientes_usuarios_permisos.",
                tiquets_clientes=".$tiquets_clientes_usuarios_permisos.",
                mesas=".$mesas_usuarios_permisos.",
                zonas=".$zonas_usuarios_permisos.",
                modalidades_envio=".$modalidades_envio_usuarios_permisos.",
                modalidades_entrega=".$modalidades_entrega_usuarios_permisos.",
                modalidades_pago=".$modalidades_pago_usuarios_permisos.",
                menu_proveedores=".$menu_proveedores_usuarios_permisos.",
                proveedores=".$proveedores_usuarios_permisos.",
                presupuestos_proveedores=".$presupuestos_proveedores_usuarios_permisos.",
                pedidos_proveedores=".$pedidos_proveedores_usuarios_permisos.",
                albaranes_proveedores=".$albaranes_proveedores_usuarios_permisos.",
                facturas_proveedores=".$facturas_proveedores_usuarios_permisos.",
                tiquets_proveedores=".$tiquets_proveedores_usuarios_permisos.",
                menu_creditores=".$menu_creditores_usuarios_permisos.",
                creditores=".$creditores_usuarios_permisos.",
                presupuestos_creditores=".$presupuestos_creditores_usuarios_permisos.",
                pedidos_creditores=".$pedidos_creditores_usuarios_permisos.",
                albaranes_creditores=".$albaranes_creditores_usuarios_permisos.",
                facturas_creditores=".$facturas_creditores_usuarios_permisos.",
                tiquets_creditores=".$tiquets_creditores_usuarios_permisos.",
                menu_productos=".$menu_productos_usuarios_permisos.",
                productos=".$productos_usuarios_permisos.",
                categorias=".$categorias_usuarios_permisos.",
                detalles_productos=".$detalles_productos_usuarios_permisos.",
                categorias_elaborados=".$categorias_elaborados_usuarios_permisos.",
                grupos=".$grupos_usuarios_permisos.",
                menu_listados=".$menu_listados_usuarios_permisos.",
                stocks_listados=".$stocks_listados_usuarios_permisos.",
                mas_vendidos_listados=".$mas_vendidos_listados_usuarios_permisos.",
                recepcion_pedidos=".$recepcion_pedidos_permisos.",
                menu_general=".$menu_general_usuarios_permisos.",
                tipos_iva=".$tipos_iva_usuarios_permisos.",
                tipos_irpf=".$tipos_irpf_usuarios_permisos.",
                bancos_cajas=".$bancos_cajas_usuarios_permisos.",
                tarifas=".$tarifas_usuarios_permisos.",
                usuarios=".$usuarios_usuarios_permisos.",
                idiomas=".$idiomas_usuarios_permisos.",
                datos_empresa=".$datos_empresa_usuarios_permisos.",
                impresion_documentos=".$impresion_documentos_usuarios_permisos.",
                iconos=".$iconos_usuarios_permisos.",
                gestor=".$gestor_permisos." 
              WHERE id_usuario=" . $id_usuarios . " LIMIT 1");

            $resultado_sys = "UPDATE";
            
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_usuarios,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM usuarios WHERE id=" . $id_usuarios . " LIMIT 1<br />";
            $result_tarifas = $conn->query("DELETE FROM usuarios WHERE id=" . $id_usuarios . " LIMIT 1");
            $resultado_sys = "DELETE";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
    }
}