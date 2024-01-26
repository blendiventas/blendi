<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$logs_sys = $select_sys."<br />";

require($_SERVER['DOCUMENT_ROOT'] . "/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "estado":
            $result = $conn->query("SELECT activo FROM libradores WHERE id=" . $id_libradores . " LIMIT 1");
            if ($result[0]['activo'] == 0) {
                $valor_sys = 1;
            } else {
                $valor_sys = 0;
            }
            $result = $conn->query("UPDATE libradores SET activo=" . $valor_sys . " WHERE id=" . $id_libradores . " LIMIT 1");
            $logs_sys .= "UPDATE libradores SET activo=" . $valor_sys . " WHERE id=" . $id_libradores . " LIMIT 1";
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'valor' => $valor_sys
                ]);
            }
            break;
        case "guardar":

            if($apartado == 'costes-importes') {
                /*
                $id_libradores_productos = $_POST['id_libradores_productos'];
                $id_librador = $_POST['id_librador'];
                $id_producto = $_POST['id_producto'];
                $coste_importe = $_POST['coste_importe'];

                CREATE TABLE `libradores_productos` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `id_librador` INT(11) NOT NULL DEFAULT '0',
                    `id_producto` INT(11) NOT NULL DEFAULT '0',
                    `coste_importe` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
                */
                if (empty($id_libradores_productos)) {
                    $result = $conn->query("INSERT INTO libradores_productos VALUES(
                          NULL,
                          '" . $id_librador . "',
                          '" . $id_producto . "',
                          '" . $coste_importe . "')");
                } else {
                    $result = $conn->query("UPDATE libradores_productos SET
                      id_librador='" . $id_librador . "',
                      id_producto='" . $id_producto . "',
                      coste_importe='" . $coste_importe . "' 
                      WHERE id=" . $id_libradores_productos . " LIMIT 1");
                }
                $logs_sys = '';
                $id_libradores = '';
                $resultado_sys = '';
            }else if($apartado == 'eliminar-costes-importes') {
                $result = $conn->query("DELETE FROM libradores_productos WHERE id=" . $id_libradores_productos . " LIMIT 1");

                $logs_sys = '';
                $id_libradores = '';
                $resultado_sys = '';
            }else {
                if (empty($id_libradores)) {
                    $logs_sys .= "INSERT INTO libradores VALUES(
                          NULL,
                          '" . addslashes($codigo_librador_libradores) . "',
                          '" . addslashes($tipo) . "',
                          '" . $id_grupo_clientes_libradores . "',
                          '" . addslashes($nombre_libradores) . "',
                          '" . addslashes($apellido_1_libradores) . "',
                          '" . addslashes($apellido_2_libradores) . "',
                          '" . addslashes($razon_social_libradores) . "',
                          '" . addslashes($razon_comercial_libradores) . "',
                          '" . addslashes($nif_libradores) . "',
                          '" . addslashes($direccion_libradores) . "',
                          '" . addslashes($numero_libradores) . "',
                          '" . addslashes($escalera_libradores) . "',
                          '" . addslashes($piso_libradores) . "',
                          '" . addslashes($puerta_libradores) . "',
                          '" . addslashes($localidad_libradores) . "',
                          '" . addslashes($codigo_postal_libradores) . "',
                          '" . addslashes($provincia_libradores) . "',
                          '" . addslashes($id_zona_libradores) . "',
                          '" . addslashes($telefono_1_libradores) . "',
                          '" . addslashes($telefono_2_libradores) . "',
                          '" . addslashes($fax_libradores) . "',
                          '" . addslashes($mobil_libradores) . "',
                          '" . addslashes($email_libradores) . "',
                          '" . addslashes($password_acceso_libradores) . "',
                          '" . $id_categoria_sms_libradores . "',
                          '" . $id_categoria_email_libradores . "',
                          '" . addslashes($persona_contacto_libradores) . "',
                          '" . addslashes($banco_libradores) . "',
                          '" . addslashes($entidad_libradores) . "',
                          '" . addslashes($agencia_libradores) . "',
                          '" . addslashes($dc_libradores) . "',
                          '" . addslashes($cuenta_libradores) . "',
                          '" . addslashes($iban_libradores) . "',
                          '" . addslashes($sexo_libradores) . "',
                          '" . addslashes($fecha_nacimiento_libradores) . "',
                          '" . addslashes($observaciones_libradores) . "',
                          '" . addslashes($id_modalidades_envio_libradores) . "',
                          '" . addslashes($id_modalidades_entrega_libradores) . "',
                          '" . addslashes($id_modalidades_pago_libradores) . "',
                          '" . $plazo_entrega_libradores . "',
                          '" . addslashes($id_iva_libradores) . "',
                          '" . addslashes($recargo_libradores) . "',
                          '" . addslashes($id_irpf_libradores) . "',
                          '" . addslashes($dia_pago_1_libradores) . "',
                          '" . addslashes($dia_pago_2_libradores) . "',
                          '" . addslashes($descuento_pp_libradores) . "',
                          '" . addslashes($descuento_librador_libradores) . "',
                          '" . $id_tarifa_web_libradores . "',
                          '" . $id_tarifa_tpv_libradores . "',
                          '" . addslashes($procedencia_libradores) . "',
                          '" . $id_cliente_origen_libradores . "',
                          '" . $id_vendedor_libradores . "',
                          '" . $id_nivel_comisiones_libradores . "',
                          " . $activo_libradores . ", 
                          " . $id_banco_cobro_libradores . ", 
                          '" . addslashes($imagen_mesa) . "', 
                          '" . addslashes($imagen_mesa_ocupada) . "',
                          '" . $radio . "',
                          '" . $id_comedor . "',
                          '" . $comensales . "', 
                          '" . $ancho_pos . "', 
                          '" . $alto_pos . "', 
                          '" . $ancho . "', 
                          '" . $alto . "', 
                          '" . date('Y-m-d') . "',
                          '" . date('Y-m-d') . "')<br />";

                    $result = $conn->query("INSERT INTO libradores VALUES(
                          NULL,
                          '" . addslashes($codigo_librador_libradores) . "',
                          '" . addslashes($tipo) . "',
                          '" . $id_grupo_clientes_libradores . "',
                          '" . addslashes($nombre_libradores) . "',
                          '" . addslashes($apellido_1_libradores) . "',
                          '" . addslashes($apellido_2_libradores) . "',
                          '" . addslashes($razon_social_libradores) . "',
                          '" . addslashes($razon_comercial_libradores) . "',
                          '" . addslashes($nif_libradores) . "',
                          '" . addslashes($direccion_libradores) . "',
                          '" . addslashes($numero_libradores) . "',
                          '" . addslashes($escalera_libradores) . "',
                          '" . addslashes($piso_libradores) . "',
                          '" . addslashes($puerta_libradores) . "',
                          '" . addslashes($localidad_libradores) . "',
                          '" . addslashes($codigo_postal_libradores) . "',
                          '" . addslashes($provincia_libradores) . "',
                          '" . addslashes($id_zona_libradores) . "',
                          '" . addslashes($telefono_1_libradores) . "',
                          '" . addslashes($telefono_2_libradores) . "',
                          '" . addslashes($fax_libradores) . "',
                          '" . addslashes($mobil_libradores) . "',
                          '" . addslashes($email_libradores) . "',
                          '" . addslashes($password_acceso_libradores) . "',
                          '" . $id_categoria_sms_libradores . "',
                          '" . $id_categoria_email_libradores . "',
                          '" . addslashes($persona_contacto_libradores) . "',
                          '" . addslashes($banco_libradores) . "',
                          '" . addslashes($entidad_libradores) . "',
                          '" . addslashes($agencia_libradores) . "',
                          '" . addslashes($dc_libradores) . "',
                          '" . addslashes($cuenta_libradores) . "',
                          '" . addslashes($iban_libradores) . "',
                          '" . addslashes($sexo_libradores) . "',
                          '" . addslashes($fecha_nacimiento_libradores) . "',
                          '" . addslashes($observaciones_libradores) . "',
                          '" . addslashes($id_modalidades_envio_libradores) . "',
                          '" . addslashes($id_modalidades_entrega_libradores) . "',
                          '" . addslashes($id_modalidades_pago_libradores) . "',
                          '" . $plazo_entrega_libradores . "',
                          '" . addslashes($id_iva_libradores) . "',
                          '" . addslashes($recargo_libradores) . "',
                          '" . addslashes($id_irpf_libradores) . "',
                          '" . addslashes($dia_pago_1_libradores) . "',
                          '" . addslashes($dia_pago_2_libradores) . "',
                          '" . addslashes($descuento_pp_libradores) . "',
                          '" . addslashes($descuento_librador_libradores) . "',
                          '" . $id_tarifa_web_libradores . "',
                          '" . $id_tarifa_tpv_libradores . "',
                          '" . addslashes($procedencia_libradores) . "',
                          '" . $id_cliente_origen_libradores . "',
                          '" . $id_vendedor_libradores . "',
                          '" . $id_nivel_comisiones_libradores . "',
                          " . $activo_libradores . ", 
                          " . $id_banco_cobro_libradores . ", 
                          '" . addslashes($imagen_mesa) . "', 
                          '" . addslashes($imagen_mesa_ocupada) . "',
                          '" . $radio . "', 
                          '" . $id_comedor . "',
                          '" . $comensales . "', 
                          '" . $ancho_pos . "', 
                          '" . $alto_pos . "', 
                          '" . $ancho . "', 
                          '" . $alto . "',
                          '" . date('Y-m-d') . "',
                          '" . date('Y-m-d') . "')");
                    $id_libradores = $conn->id_insert();
                    if (empty($codigo_librador_libradores)) {
                        $result = $conn->query("UPDATE libradores SET
                            codigo_librador='" . $id_libradores . "'
                            WHERE id=" . $id_libradores . " AND tipo = '" . addslashes($tipo) . "' LIMIT 1");
                    }
                    $resultado_sys = "INSERT";
                } else {
                    $logs_sys .= "UPDATE libradores SET
                      codigo_librador='" . addslashes($codigo_librador_libradores) . "',
                      tipo='" . addslashes($tipo) . "',
                      id_grupo_clientes='" . $id_grupo_clientes_libradores . "',
                      nombre='" . addslashes($nombre_libradores) . "',
                      apellido_1='" . addslashes($apellido_1_libradores) . "',
                      apellido_2='" . addslashes($apellido_2_libradores) . "',
                      razon_social='" . addslashes($razon_social_libradores) . "',
                      razon_comercial='" . addslashes($razon_comercial_libradores) . "',
                      nif='" . addslashes($nif_libradores) . "',
                      direccion='" . addslashes($direccion_libradores) . "',
                      numero='" . addslashes($numero_libradores) . "',
                      escalera='" . addslashes($escalera_libradores) . "',
                      piso='" . addslashes($piso_libradores) . "',
                      puerta='" . addslashes($puerta_libradores) . "',
                      localidad='" . addslashes($localidad_libradores) . "',
                      codigo_postal='" . addslashes($codigo_postal_libradores) . "',
                      provincia='" . addslashes($provincia_libradores) . "',
                      id_zona='" . addslashes($id_zona_libradores) . "',
                      telefono_1='" . addslashes($telefono_1_libradores) . "',
                      telefono_2='" . addslashes($telefono_2_libradores) . "',
                      fax='" . addslashes($fax_libradores) . "',
                      mobil='" . addslashes($mobil_libradores) . "',
                      email='" . addslashes($email_libradores) . "',
                      password_acceso='" . addslashes($password_acceso_libradores) . "',
                      id_categoria_sms='" . $id_categoria_sms_libradores . "',
                      id_categoria_email='" . $id_categoria_email_libradores . "',
                      persona_contacto='" . addslashes($persona_contacto_libradores) . "',
                      banco='" . addslashes($banco_libradores) . "',
                      entidad='" . addslashes($entidad_libradores) . "',
                      agencia='" . addslashes($agencia_libradores) . "',
                      dc='" . addslashes($dc_libradores) . "',
                      cuenta='" . addslashes($cuenta_libradores) . "',
                      iban='" . addslashes($iban_libradores) . "',
                      sexo='" . addslashes($sexo_libradores) . "',
                      fecha_nacimiento='" . addslashes($fecha_nacimiento_libradores) . "',
                      observaciones='" . addslashes($observaciones_libradores) . "',
                      id_modalidades_envio='" . addslashes($id_modalidades_envio_libradores) . "',
                      id_modalidades_entrega='" . addslashes($id_modalidades_entrega_libradores) . "',
                      id_modalidades_pago='" . addslashes($id_modalidades_pago_libradores) . "',
                      plazo_entrega='" . $plazo_entrega_libradores . "',
                      id_iva='" . addslashes($id_iva_libradores) . "',
                      recargo='" . addslashes($recargo_libradores) . "',
                      id_irpf='" . addslashes($id_irpf_libradores) . "',
                      dia_pago_1='" . addslashes($dia_pago_1_libradores) . "',
                      dia_pago_2='" . addslashes($dia_pago_2_libradores) . "',
                      descuento_pp='" . addslashes($descuento_pp_libradores) . "',
                      descuento_librador='" . addslashes($descuento_librador_libradores) . "',
                      id_tarifa_web='" . $id_tarifa_web_libradores . "',
                      id_tarifa_tpv='" . $id_tarifa_tpv_libradores . "',
                      procedencia='" . addslashes($procedencia_libradores) . "',
                      id_cliente_origen='" . $id_cliente_origen_libradores . "',
                      id_vendedor='" . $id_vendedor_libradores . "',
                      id_nivel_comisiones='" . $id_nivel_comisiones_libradores . "',
                      activo='" . $activo_libradores . "', 
                      id_banco_cobro='" . $id_banco_cobro_libradores . "',
                      imagen_mesa='" . $imagen_mesa . "',
                      imagen_mesa_ocupada='" . $imagen_mesa_ocupada . "',
                      radio='" . $radio . "',
                      id_comedores='" . $id_comedor . "',
                      comensales='" . $comensales . "',
                      ancho_pos='" . $ancho_pos . "',
                      alto_pos='" . $alto_pos . "',
                      ancho='" . $ancho . "',
                      alto='" . $alto . "',
                      fecha_modificacion='" . date('Y-m-d H:i:s') . "' 
                      WHERE id=" . $id_libradores . " AND tipo = '" . addslashes($tipo) . "' LIMIT 1<br />";

                    $result = $conn->query("UPDATE libradores SET
                      codigo_librador='" . addslashes($codigo_librador_libradores) . "',
                      tipo='" . addslashes($tipo) . "',
                      id_grupo_clientes='" . $id_grupo_clientes_libradores . "',
                      nombre='" . addslashes($nombre_libradores) . "',
                      apellido_1='" . addslashes($apellido_1_libradores) . "',
                      apellido_2='" . addslashes($apellido_2_libradores) . "',
                      razon_social='" . addslashes($razon_social_libradores) . "',
                      razon_comercial='" . addslashes($razon_comercial_libradores) . "',
                      nif='" . addslashes($nif_libradores) . "',
                      direccion='" . addslashes($direccion_libradores) . "',
                      numero='" . addslashes($numero_libradores) . "',
                      escalera='" . addslashes($escalera_libradores) . "',
                      piso='" . addslashes($piso_libradores) . "',
                      puerta='" . addslashes($puerta_libradores) . "',
                      localidad='" . addslashes($localidad_libradores) . "',
                      codigo_postal='" . addslashes($codigo_postal_libradores) . "',
                      provincia='" . addslashes($provincia_libradores) . "',
                      id_zona='" . addslashes($id_zona_libradores) . "',
                      telefono_1='" . addslashes($telefono_1_libradores) . "',
                      telefono_2='" . addslashes($telefono_2_libradores) . "',
                      fax='" . addslashes($fax_libradores) . "',
                      mobil='" . addslashes($mobil_libradores) . "',
                      email='" . addslashes($email_libradores) . "',
                      password_acceso='" . addslashes($password_acceso_libradores) . "',
                      id_categoria_sms='" . $id_categoria_sms_libradores . "',
                      id_categoria_email='" . $id_categoria_email_libradores . "',
                      persona_contacto='" . addslashes($persona_contacto_libradores) . "',
                      banco='" . addslashes($banco_libradores) . "',
                      entidad='" . addslashes($entidad_libradores) . "',
                      agencia='" . addslashes($agencia_libradores) . "',
                      dc='" . addslashes($dc_libradores) . "',
                      cuenta='" . addslashes($cuenta_libradores) . "',
                      iban='" . addslashes($iban_libradores) . "',
                      sexo='" . addslashes($sexo_libradores) . "',
                      fecha_nacimiento='" . addslashes($fecha_nacimiento_libradores) . "',
                      observaciones='" . addslashes($observaciones_libradores) . "',
                      id_modalidades_envio='" . addslashes($id_modalidades_envio_libradores) . "',
                      id_modalidades_entrega='" . addslashes($id_modalidades_entrega_libradores) . "',
                      id_modalidades_pago='" . addslashes($id_modalidades_pago_libradores) . "',
                      plazo_entrega='" . $plazo_entrega_libradores . "',
                      id_iva='" . addslashes($id_iva_libradores) . "',
                      recargo='" . addslashes($recargo_libradores) . "',
                      id_irpf='" . addslashes($id_irpf_libradores) . "',
                      dia_pago_1='" . addslashes($dia_pago_1_libradores) . "',
                      dia_pago_2='" . addslashes($dia_pago_2_libradores) . "',
                      descuento_pp='" . addslashes($descuento_pp_libradores) . "',
                      descuento_librador='" . addslashes($descuento_librador_libradores) . "',
                      id_tarifa_web='" . $id_tarifa_web_libradores . "',
                      id_tarifa_tpv='" . $id_tarifa_tpv_libradores . "',
                      procedencia='" . addslashes($procedencia_libradores) . "',
                      id_cliente_origen='" . $id_cliente_origen_libradores . "',
                      id_vendedor='" . $id_vendedor_libradores . "',
                      id_nivel_comisiones='" . $id_nivel_comisiones_libradores . "',
                      activo='" . $activo_libradores . "', 
                      id_banco_cobro='" . $id_banco_cobro_libradores . "',
                      imagen_mesa='" . addslashes($imagen_mesa) . "',
                      imagen_mesa_ocupada='" . addslashes($imagen_mesa_ocupada) . "',
                      radio='" . $radio . "',
                      id_comedores='" . $id_comedor . "',
                      comensales='" . $comensales . "',
                      ancho_pos='" . $ancho_pos . "',
                      alto_pos='" . $alto_pos . "',
                      ancho='" . $ancho . "',
                      alto='" . $alto . "',
                      fecha_modificacion='" . date('Y-m-d H:i:s') . "' 
                      WHERE id=" . $id_libradores . " LIMIT 1");

                    $resultado_sys = "UPDATE";
                }
            }
            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_libradores,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "mover":
            $logs_sys .= "UPDATE libradores SET 
              ancho_pos=ancho_pos+(" . $ancho_pos . "),
              alto_pos=alto_pos+(" . $alto_pos . "),
              fecha_modificacion='" . date('Y-m-d H:i:s') . "' 
              WHERE id=" . $id_libradores . " LIMIT 1<br />";

            $result = $conn->query("UPDATE libradores SET 
              ancho_pos=ancho_pos+(" . $ancho_pos . "),
              alto_pos=alto_pos+(" . $alto_pos . "),
              fecha_modificacion='" . date('Y-m-d H:i:s') . "' 
              WHERE id=" . $id_libradores . " LIMIT 1");

            $resultado_sys = "UPDATE";

            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'id' => $id_libradores,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "dimensionar":
            $logs_sql = "UPDATE libradores SET ancho='".$ancho."',alto='".$alto."',fecha_modificacion='".date('Y-m-d H:i:s')."' WHERE id=".$id_libradores." LIMIT 1";

            $result = $conn->query("UPDATE libradores SET 
              ancho='" . $ancho . "',
              alto='" . $alto . "',
              fecha_modificacion='" . date('Y-m-d H:i:s') . "' 
              WHERE id=" . $id_libradores . " LIMIT 1");

            $resultado_sys = "UPDATE";

            if (isset($ajax_sys)) {
                echo json_encode([
                    'logs' => $logs_sys,
                    'sql' => $logs_sql,
                    'id' => $id_libradores,
                    'resultado' => $resultado_sys
                ]);
            }
            break;
        case "eliminar":
            $logs_sys .= "DELETE FROM libradores WHERE id=" . $id_libradores . " AND tipo = '" . addslashes($tipo) . "' LIMIT 1<br />";
            $result = $conn->query("DELETE FROM libradores WHERE id=" . $id_libradores . " AND tipo = '" . addslashes($tipo) . "' LIMIT 1");
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
