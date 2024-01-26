<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

switch ($select_sys) {
    case "crear":
        $nombre_libradores = "";
        $razon_libradores = "";
        if($tipo_cuenta_registro == "persona") {
            $nombre_libradores = $nombre_registro;
        }else {
            $razon_libradores = $nombre_registro;
        }
        $result_libradores = $conn->query("SELECT id FROM libradores WHERE email='" . addslashes($email_registro) . "' LIMIT 1");
        if($conn->registros() == 0) {
            $query = "INSERT INTO libradores VALUES(
                              NULL,
                              '" . addslashes($codigo_librador_documento) . "',
                              '" . $tipo_librador . "',
                              '',
                              '" . addslashes($nombre_libradores) . "',
                              '',
                              '',
                              '" . addslashes($razon_libradores) . "',
                              '" . addslashes($razon_libradores) . "',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '0',
                              '',
                              '',
                              '',
                              '',
                              '" . addslashes($email_registro) . "',
                              '" . addslashes($password_registro) . "',
                              '0',
                              '0',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '0',
                              'null',
                              '',
                              '0',
                              '0',
                              '0',
                              '0',
                              '-1',
                              '0',
                              '0',
                              '0',
                              '0',
                              '0.00',
                              '0.00',
                              '1',
                              '1',
                              '',
                              '0',
                              '0',
                              '0',
                              '1', 
                              '1', 
                              '', 
                              '', 
                              '0', 
                              '0',
                              '1', 
                              '0', 
                              '0', 
                              '0', 
                              '0', 
                              '" . date('Y-m-d H:i:s') . "',
                              '" . date('Y-m-d H:i:s') . "')";

            $result = $conn->query($query);
            $id_libradores = $conn->id_insert();

            unset($conn);

            $select_sys = "identificar";
            require("datos-librador.php");
        }else {
            unset($conn);

            $select_sys = "identificar";
            require("datos-librador.php");
        }
        break;
    case "inicio":
        // inicio, se llama desde index-datos.php y puede ser desde libradores... o desde documentos-libradores.
        $librador_nombre = "";
        $librador_apellido_1 = "";
        $librador_apellido_2 = "";
        $librador_social = "";
        $librador_comercial = "";
        $id_librador_tak = 0;
        $servicio_domicilio = 0;
        if(empty($id_documento)) {
            if($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") {
                if (isset($_SESSION[$id_sesion_js]) && isset($_SESSION[$id_sesion_js]['id_librador'])) {
                    $id_librador = $_SESSION[$id_sesion_js]['id_librador'];
                }
                $pvp_iva_incluido = 0;
                $mostrar_precios_tpv = 0;
                if ($id_librador == 0) {
                    $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");
                    $id_librador = $result_configuracion[0]['id_librador'];
                    $id_librador_tak = $result_configuracion[0]['id_librador_tak'];
                    $servicio_domicilio = $result_configuracion[0]['servicio_domicilio'];
                    $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
                    $mostrar_precios_tpv = $result_configuracion[0]['mostrar_precios_tpv'];
                    $mostrar_mas_vendidos = $result_configuracion[0]['mostrar_mas_vendidos'];
                    $color_letra_botones = $result_configuracion[0]['color_letra_botones'];
                    $color_fondo_botones = $result_configuracion[0]['color_fondo_botones'];
                    if ($result_configuracion[0]['tipo_menu_superior'] == 0) {
                        $tipus_menu_web_superior = "normal";
                    }else {
                        $tipus_menu_web_superior = "scroll-horizontal";
                    }
                    $filas_menu_superior = $result_configuracion[0]['filas_menu'];
                    $decimales_cantidades= $result_configuracion[0]['decimales_cantidades'];
                    $decimales_importes= $result_configuracion[0]['decimales_importes'];
                } else {
                    $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");
                    $id_librador_tak = $result_configuracion[0]['id_librador_tak'];
                    $servicio_domicilio = $result_configuracion[0]['servicio_domicilio'];
                    $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
                    $mostrar_precios_tpv = $result_configuracion[0]['mostrar_precios_tpv'];
                    $mostrar_mas_vendidos = $result_configuracion[0]['mostrar_mas_vendidos'];
                    $color_letra_botones = $result_configuracion[0]['color_letra_botones'];
                    $color_fondo_botones = $result_configuracion[0]['color_fondo_botones'];
                    if ($result_configuracion[0]['tipo_menu_superior'] == 0) {
                        $tipus_menu_web_superior = "normal";
                    }else {
                        $tipus_menu_web_superior = "scroll-horizontal";
                    }
                    $filas_menu_superior = $result_configuracion[0]['filas_menu'];
                    $decimales_cantidades= $result_configuracion[0]['decimales_cantidades'];
                    $decimales_importes= $result_configuracion[0]['decimales_importes'];
                }
            }else {
                $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");
                $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
                $mostrar_precios_tpv = $result_configuracion[0]['mostrar_precios_tpv'];
                $mostrar_mas_vendidos = $result_configuracion[0]['mostrar_mas_vendidos'];
                $color_letra_botones = $result_configuracion[0]['color_letra_botones'];
                $color_fondo_botones = $result_configuracion[0]['color_fondo_botones'];
                if ($result_configuracion[0]['tipo_menu_superior'] == 0) {
                    $tipus_menu_web_superior = "normal";
                }else {
                    $tipus_menu_web_superior = "scroll-horizontal";
                }
                $filas_menu_superior = $result_configuracion[0]['filas_menu'];
                $decimales_cantidades= $result_configuracion[0]['decimales_cantidades'];
                $decimales_importes= $result_configuracion[0]['decimales_importes'];

                $result_identificacion_accesos = $conn->query("SELECT id FROM libradores
                                            WHERE tipo='" . $tipo_librador . "' LIMIT 1");
                if ($conn->registros() == 1) {
                    $id_librador = $result_identificacion_accesos[0]['id'];
                }
            }

            $result_libradores = $conn->query("SELECT codigo_librador,tipo,nombre,apellido_1,apellido_2,razon_social,razon_comercial,nif,
                                direccion,numero,escalera,piso,puerta,localidad,codigo_postal,provincia,id_zona,telefono_1,telefono_2,
                                fax,mobil,email,persona_contacto,banco,iban,id_modalidades_envio,id_modalidades_entrega,
                                id_modalidades_pago,id_iva,recargo,id_irpf,dia_pago_1,dia_pago_2,descuento_pp,
                                descuento_librador,id_tarifa_web,id_tarifa_tpv,id_vendedor,id_nivel_comisiones,id_banco_cobro 
                                FROM libradores WHERE id='" . $id_librador . "' LIMIT 1");

            $codigo_librador = stripslashes($result_libradores[0]['codigo_librador']);
            $tipo_librador = stripslashes($result_libradores[0]['tipo']);
            if (!empty($result_libradores[0]['nombre'])) {
                $librador_nombre = stripslashes($result_libradores[0]['nombre']);
            }
            if (!empty($result_libradores[0]['apellido_1'])) {
                $librador_apellido_1 = stripslashes($result_libradores[0]['apellido_1']);
            }
            if (!empty($result_libradores[0]['apellido_2'])) {
                $librador_apellido_2 = stripslashes($result_libradores[0]['apellido_2']);
            }
            if (!empty($result_libradores[0]['razon_social'])) {
                $librador_social = stripslashes($result_libradores[0]['razon_social']);
            }
            if (!empty($result_libradores[0]['razon_comercial'])) {
                $librador_comercial = stripslashes($result_libradores[0]['razon_comercial']);
            }
            $nif = stripslashes($result_libradores[0]['nif']);
            $direccion = stripslashes($result_libradores[0]['direccion']);
            $numero = stripslashes($result_libradores[0]['numero']);
            $escalera = stripslashes($result_libradores[0]['escalera']);
            $piso = stripslashes($result_libradores[0]['piso']);
            $puerta = stripslashes($result_libradores[0]['puerta']);
            $localidad = stripslashes($result_libradores[0]['localidad']);
            $codigo_postal = stripslashes($result_libradores[0]['codigo_postal']);
            $provincia = stripslashes($result_libradores[0]['provincia']);
            $id_zona = $result_libradores[0]['id_zona'];
            $telefono_1 = stripslashes($result_libradores[0]['telefono_1']);
            $telefono_2 = stripslashes($result_libradores[0]['telefono_2']);
            $fax = stripslashes($result_libradores[0]['fax']);
            $mobil = stripslashes($result_libradores[0]['mobil']);
            $email = stripslashes($result_libradores[0]['email']);
            $persona_contacto = stripslashes($result_libradores[0]['persona_contacto']);
            $banco = stripslashes($result_libradores[0]['banco']);
            $iban = stripslashes($result_libradores[0]['iban']);
            $id_modalidades_envio = $result_libradores[0]['id_modalidades_envio'];
            $id_modalidades_entrega = $result_libradores[0]['id_modalidades_entrega'];
            $id_modalidades_pago = $result_libradores[0]['id_modalidades_pago'];
            $modalidad_pago = "";
            $id_iva_modalidades_pago = 0;
            $incremento_pvp_modalidades_pago = 0;
            $incremento_por_modalidades_pago = 0;
            require("datos-modalidades.php");
            /*
             * Variables obtenidades en datos-modalidades.php
            $modalidad_pago
            $id_iva_modalidades_pago
            $incremento_pvp_modalidades_pago
            $incremento_por_modalidades_pago
            */
            $id_iva_librador = $result_libradores[0]['id_iva'];
            $recargo = $result_libradores[0]['recargo']; // 1/0 si/no
            $id_irpf_librador = $result_libradores[0]['id_irpf'];
            $iva_librador = -1;
            $recargo_librador = 0;
            $irpf_librador = 0;
            if (isset($matriz_iva_productos_iva[$id_iva_librador])) {
                $iva_librador = $matriz_iva_productos_iva[$id_iva_librador];
            }
            if ($recargo == 1) {
                if (isset($matriz_recargo_productos_iva[$id_iva_librador])) {
                    $recargo_librador = $matriz_recargo_productos_iva[$id_iva_librador];
                }
            }
            if (isset($matriz_irpf[$id_irpf_librador])) {
                $irpf_librador = $matriz_irpf[$id_irpf_librador];
            }
            $dia_pago_1 = $result_libradores[0]['dia_pago_1'];
            $dia_pago_2 = $result_libradores[0]['dia_pago_2'];
            $descuento_pp = $result_libradores[0]['descuento_pp'];
            $descuento_librador = $result_libradores[0]['descuento_librador'];
            if (!empty($total_documento) && !empty($descuento_librador)) {
                $total_sin_descuento = $total_documento / ((100 - $descuento_librador) / 100);
                $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total_sin_descuento;
            } else if (!empty($total) && !empty($descuento_librador)) {
                $total_sin_descuento = $total / ((100 - $descuento_librador) / 100);
                $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total_sin_descuento;
            } else {
                $descuento_librador_euro = 0;
            }
            $id_tarifa_web = $result_libradores[0]['id_tarifa_web'];
            $id_tarifa_tpv = $result_libradores[0]['id_tarifa_tpv'];
            $id_vendedor = $result_libradores[0]['id_vendedor'];
            $id_nivel_comisiones = $result_libradores[0]['id_nivel_comisiones'];
            $id_banco_cobro = $result_libradores[0]['id_banco_cobro'];

            $result_envio = $conn->query("SELECT * FROM libradores_envio WHERE id_librador='" . $id_librador . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $id_envio_librador_nombre[] = 0;
                if (!empty($result_envio[0]['nombre'])) {
                    $envio_librador_nombre[] = stripslashes($result_envio[0]['nombre']);
                } else {
                    $envio_librador_nombre[] = "";
                }
                if (!empty($result_envio[0]['apellido_1'])) {
                    $envio_librador_apellido_1[] = stripslashes($result_envio[0]['apellido_1']);
                } else {
                    $envio_librador_apellido_1[] = "";
                }
                if (!empty($result_envio[0]['apellido_2'])) {
                    $envio_librador_apellido_2[] = stripslashes($result_envio[0]['apellido_2']);
                } else {
                    $envio_librador_apellido_2[] = "";
                }
                if (!empty($result_envio[0]['razon_social'])) {
                    $envio_librador_social[] = stripslashes($result_envio[0]['razon_social']);
                } else {
                    $envio_librador_social[] = "";
                }
                if (!empty($result_envio[0]['razon_comercial'])) {
                    $envio_librador_comercial[] = stripslashes($result_envio[0]['razon_comercial']);
                } else {
                    $envio_librador_comercial[] = "";
                }
                $envio_direccion[] = stripslashes($result_envio[0]['direccion']);
                $envio_numero[] = stripslashes($result_envio[0]['numero']);
                $envio_escalera[] = stripslashes($result_envio[0]['escalera']);
                $envio_piso[] = stripslashes($result_envio[0]['piso']);
                $envio_puerta[] = stripslashes($result_envio[0]['puerta']);
                $envio_localidad[] = stripslashes($result_envio[0]['localidad']);
                $envio_codigo_postal[] = stripslashes($result_envio[0]['codigo_postal']);
                $envio_provincia[] = stripslashes($result_envio[0]['provincia']);
                $envio_id_zona[] = $result_envio[0]['id_zona'];
                $envio_telefono_1[] = stripslashes($result_envio[0]['telefono_1']);
                $envio_telefono_2[] = stripslashes($result_envio[0]['telefono_2']);
                $envio_mobil[] = stripslashes($result_envio[0]['mobil']);
                $envio_persona_contacto[] = stripslashes($result_envio[0]['persona_contacto']);
                $envio_observaciones[] = nl2br(stripslashes($result_envio[0]['observaciones']));
            }

            $result_envio = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_libradores_envio WHERE id_librador='" . $id_librador . "' ORDER BY fecha_documento DESC");
            if ($conn->registros() >= 1) {
                foreach ($result_envio as $key_envio => $valor_envio) {
                    $id_envio_librador_nombre[] = $valor_envio['id_documentos_1'];
                    if (!empty($result_envio[0]['nombre'])) {
                        $envio_librador_nombre[] = stripslashes($valor_envio['nombre']);
                    } else {
                        $envio_librador_nombre[] = "";
                    }
                    if (!empty($valor_envio['apellido_1'])) {
                        $envio_librador_apellido_1[] = stripslashes($valor_envio['apellido_1']);
                    } else {
                        $envio_librador_apellido_1[] = "";
                    }
                    if (!empty($valor_envio['apellido_2'])) {
                        $envio_librador_apellido_2[] = stripslashes($valor_envio['apellido_2']);
                    } else {
                        $envio_librador_apellido_2[] = "";
                    }
                    if (!empty($valor_envio['razon_social'])) {
                        $envio_librador_social[] = stripslashes($valor_envio['razon_social']);
                    } else {
                        $envio_librador_social[] = "";
                    }
                    if (!empty($valor_envio['razon_comercial'])) {
                        $envio_librador_comercial[] = stripslashes($valor_envio['razon_comercial']);
                    } else {
                        $envio_librador_comercial[] = "";
                    }
                    $envio_direccion[] = stripslashes($valor_envio['direccion']);
                    $envio_numero[] = stripslashes($valor_envio['numero']);
                    $envio_escalera[] = stripslashes($valor_envio['escalera']);
                    $envio_piso[] = stripslashes($valor_envio['piso']);
                    $envio_puerta[] = stripslashes($valor_envio['puerta']);
                    $envio_localidad[] = stripslashes($valor_envio['localidad']);
                    $envio_codigo_postal[] = stripslashes($valor_envio['codigo_postal']);
                    $envio_provincia[] = stripslashes($valor_envio['provincia']);
                    $envio_zona[] = stripslashes($valor_envio['zona']);
                    $result_zona = $conn->query("SELECT id FROM zonas WHERE zona='" . $valor_envio['zona'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $envio_id_zona[] = $result_zona[0]['id'];
                    } else {
                        $envio_id_zona[] = 0;
                    }
                    $envio_telefono_1[] = stripslashes($valor_envio['telefono_1']);
                    $envio_telefono_2[] = stripslashes($valor_envio['telefono_2']);
                    $envio_mobil[] = stripslashes($valor_envio['mobil']);
                    $envio_persona_contacto[] = stripslashes($valor_envio['persona_contacto']);
                    $envio_observaciones[] = nl2br(stripslashes($valor_envio['observaciones']));
                }
            }
            $fecha_recogida = date("Y-m-d");
            $hora_recogida = date("H:i:s");
            $fecha_entrega = date("Y-m-d");
            $hora_entrega = date("H:i:s");
        }else {
            $result_documento_1 = $conn->query("SELECT id_librador,tipo_librador,tipo_documento,modalidad_pago,
                                modalidad_envio,modalidad_entrega,irpf,descuento_pp,descuento_librador,hora_entrega,total 
                                FROM documentos_" . $ejercicio . "_1 WHERE id='" . $id_documento . "' LIMIT 1");
            if($conn->registros() == 1) {
                $total = $result_documento_1[0]['total'];
                $id_librador = $result_documento_1[0]['id_librador'];
                $tipo_librador = $result_documento_1[0]['tipo_librador'];
                $tipo_documento = $result_documento_1[0]['tipo_documento'];
            }
            $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");
            $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
            $mostrar_precios_tpv = $result_configuracion[0]['mostrar_precios_tpv'];
            $mostrar_mas_vendidos = $result_configuracion[0]['mostrar_mas_vendidos'];
            $color_letra_botones = $result_configuracion[0]['color_letra_botones'];
            $color_fondo_botones = $result_configuracion[0]['color_fondo_botones'];
            if ($result_configuracion[0]['tipo_menu_superior'] == 0) {
                $tipus_menu_web_superior = "normal";
            }else {
                $tipus_menu_web_superior = "scroll-horizontal";
            }
            $filas_menu_superior = $result_configuracion[0]['filas_menu'];
            $decimales_cantidades= $result_configuracion[0]['decimales_cantidades'];
            $decimales_importes= $result_configuracion[0]['decimales_importes'];

            $result_libradores = $conn->query("SELECT id_iva,dia_pago_1,dia_pago_2,id_vendedor,id_nivel_comisiones,id_banco_cobro,recargo 
                                FROM libradores WHERE id='" . $id_librador . "' LIMIT 1");

            $result_documento_libradores = $conn->query("SELECT codigo_librador,nombre,apellido_1,apellido_2,razon_social,razon_comercial,nif,
                                direccion,numero,escalera,piso,puerta,localidad,codigo_postal,provincia,telefono_1,telefono_2,
                                fax,mobil,email,persona_contacto,banco,iban,id_tarifa_web,id_tarifa_tpv 
                                FROM documentos_" . $ejercicio . "_libradores WHERE id_documentos_1='" . $id_documento . "' LIMIT 1");
            if (empty($result_documento_libradores)) {
                $result_documento_libradores = $conn->query("SELECT codigo_librador,nombre,apellido_1,apellido_2,razon_social,razon_comercial,nif,
                                direccion,numero,escalera,piso,puerta,localidad,codigo_postal,provincia,telefono_1,telefono_2,
                                fax,mobil,email,persona_contacto,banco,iban,id_tarifa_web,id_tarifa_tpv 
                                FROM libradores WHERE id='" . $id_librador . "' LIMIT 1");
            }
            $result_documento_libradores_envio = $conn->query("SELECT zona 
                                FROM documentos_" . $ejercicio . "_libradores_envio WHERE id_documentos_1='" . $id_documento . "' LIMIT 1");

            $codigo_librador = stripslashes($result_documento_libradores[0]['codigo_librador']);
            if (!empty($result_documento_libradores[0]['nombre'])) {
                $librador_nombre = stripslashes($result_documento_libradores[0]['nombre']);
            }
            if (!empty($result_documento_libradores[0]['apellido_1'])) {
                $librador_apellido_1 = stripslashes($result_documento_libradores[0]['apellido_1']);
            }
            if (!empty($result_documento_libradores[0]['apellido_2'])) {
                $librador_apellido_2 = stripslashes($result_documento_libradores[0]['apellido_2']);
            }
            if (!empty($result_documento_libradores[0]['razon_social'])) {
                $librador_social = stripslashes($result_documento_libradores[0]['razon_social']);
            }
            if (!empty($result_documento_libradores[0]['razon_comercial'])) {
                $librador_comercial = stripslashes($result_documento_libradores[0]['razon_comercial']);
            }
            $nif = stripslashes($result_documento_libradores[0]['nif']);
            $direccion = stripslashes($result_documento_libradores[0]['direccion']);
            $numero = stripslashes($result_documento_libradores[0]['numero']);
            $escalera = stripslashes($result_documento_libradores[0]['escalera']);
            $piso = stripslashes($result_documento_libradores[0]['piso']);
            $puerta = stripslashes($result_documento_libradores[0]['puerta']);
            $localidad = stripslashes($result_documento_libradores[0]['localidad']);
            $codigo_postal = stripslashes($result_documento_libradores[0]['codigo_postal']);
            $provincia = stripslashes($result_documento_libradores[0]['provincia']);
            $id_zona = 0;
            $result_zona = $conn->query("SELECT id FROM zonas WHERE zona='" . addslashes($result_documento_libradores_envio[0]['zona']) . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $id_zona = $result_zona[0]['id'];
            }
            $telefono_1 = stripslashes($result_documento_libradores[0]['telefono_1']);
            $telefono_2 = stripslashes($result_documento_libradores[0]['telefono_2']);
            $fax = stripslashes($result_documento_libradores[0]['fax']);
            $mobil = stripslashes($result_documento_libradores[0]['mobil']);
            $email = stripslashes($result_documento_libradores[0]['email']);
            $persona_contacto = stripslashes($result_documento_libradores[0]['persona_contacto']);
            $banco = stripslashes($result_documento_libradores[0]['banco']);
            $iban = stripslashes($result_documento_libradores[0]['iban']);

            $modalidad_envio = $result_documento_1[0]['modalidad_envio'];
            $modalidad_entrega = $result_documento_1[0]['modalidad_entrega'];
            $modalidad_pago = $result_documento_1[0]['modalidad_pago'];
            $result = $conn->query("SELECT id FROM modalidades_pago WHERE descripcion='" . addslashes($modalidad_pago) . "' LIMIT 1");
            if($conn->registros() == 1) {
                $id_modalidades_pago = $result[0]['id'];
            }
            $result = $conn->query("SELECT id FROM modalidades_envio WHERE descripcion='" . addslashes($modalidad_envio) . "' LIMIT 1");
            if($conn->registros() == 1) {
                $id_modalidades_envio = $result[0]['id'];
            }
            $result = $conn->query("SELECT id FROM modalidades_entrega WHERE descripcion='" . addslashes($modalidad_entrega) . "' LIMIT 1");
            if($conn->registros() == 1) {
                $id_modalidades_entrega = $result[0]['id'];
            }

            $id_iva_modalidades_pago = 0;
            $incremento_pvp_modalidades_pago = 0;
            $incremento_por_modalidades_pago = 0;
            require("datos-modalidades.php");
            /*
             * Variables obtenidades en datos-modalidades.php
            $modalidad_pago
            $id_iva_modalidades_pago
            $incremento_pvp_modalidades_pago
            $incremento_por_modalidades_pago
            */

            $recargo = $result_libradores[0]['recargo']; // 1/0 si/no

            $id_iva_librador = $result_libradores[0]['id_iva'];

            $irpf_librador = $result_documento_1[0]['irpf'];
            $result_irpf = $conn->query("SELECT id FROM irpf WHERE irpf='" . $irpf_librador . "' LIMIT 1");
            if($conn->registros() == 1) {
                $id_irpf_librador = $result_irpf[0]['id'];
            } else {
                $id_irpf_librador = 0;
            }
            $iva_librador = -1;
            $recargo_librador = 0;
            if (isset($matriz_iva_productos_iva[$id_iva_librador])) {
                $iva_librador = $matriz_iva_productos_iva[$id_iva_librador];
            }
            if ($recargo == 1) {
                if (isset($matriz_recargo_productos_iva[$id_iva_librador])) {
                    $recargo_librador = $matriz_recargo_productos_iva[$id_iva_librador];
                }
            }
            $dia_pago_1 = $result_libradores[0]['dia_pago_1'];
            $dia_pago_2 = $result_libradores[0]['dia_pago_2'];
            $descuento_pp = $result_documento_1[0]['descuento_pp'];
            $descuento_librador = $result_documento_1[0]['descuento_librador'];
            if (!empty($total_documento) && !empty($descuento_librador)) {
                $total_sin_descuento = $total_documento / ((100 - $descuento_librador) / 100);
                $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total_sin_descuento;
            } else if (!empty($total) && !empty($descuento_librador)) {
                $total_sin_descuento = $total / ((100 - $descuento_librador) / 100);
                $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total_sin_descuento;
            } else {
                $descuento_librador_euro = 0;
            }
            $id_tarifa_web = $result_documento_libradores[0]['id_tarifa_web'];
            $id_tarifa_tpv = $result_documento_libradores[0]['id_tarifa_tpv'];
            $id_vendedor = $result_libradores[0]['id_vendedor'];
            $id_nivel_comisiones = $result_libradores[0]['id_nivel_comisiones'];
            $id_banco_cobro = $result_libradores[0]['id_banco_cobro'];
            /*
            echo "FALTA en datos-librador.php:<br />";
            echo "- Obtener nombre del vendedor y listado de vendedores disponibles<br />";
            echo "- Obtener porcentaje de comisión y listado de comisiones disponibles<br />";
            echo "- Obtener nombre del banco de cobro y listado de bancos/cajas disponibles<br />";

            Mostrar los datos de envio de libradores_envio, si no existen mostrar los disponibles en
            documentos_2022_libradores_envio para seleccionar uno en concreto i si tampoco exiten,
            mostrar los datos de la tabla libradores.
            */
            $result_envio = $conn->query("SELECT * FROM libradores_envio WHERE id_librador='" . $id_librador . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $id_envio_librador_nombre[] = 0;
                if (!empty($result_envio[0]['nombre'])) {
                    $envio_librador_nombre[] = stripslashes($result_envio[0]['nombre']);
                } else {
                    $envio_librador_nombre[] = "";
                }
                if (!empty($result_envio[0]['apellido_1'])) {
                    $envio_librador_apellido_1[] = stripslashes($result_envio[0]['apellido_1']);
                } else {
                    $envio_librador_apellido_1[] = "";
                }
                if (!empty($result_envio[0]['apellido_2'])) {
                    $envio_librador_apellido_2[] = stripslashes($result_envio[0]['apellido_2']);
                } else {
                    $envio_librador_apellido_2[] = "";
                }
                if (!empty($result_envio[0]['razon_social'])) {
                    $envio_librador_social[] = stripslashes($result_envio[0]['razon_social']);
                } else {
                    $envio_librador_social[] = "";
                }
                if (!empty($result_envio[0]['razon_comercial'])) {
                    $envio_librador_comercial[] = stripslashes($result_envio[0]['razon_comercial']);
                } else {
                    $envio_librador_comercial[] = "";
                }
                $envio_direccion[] = stripslashes($result_envio[0]['direccion']);
                $envio_numero[] = stripslashes($result_envio[0]['numero']);
                $envio_escalera[] = stripslashes($result_envio[0]['escalera']);
                $envio_piso[] = stripslashes($result_envio[0]['piso']);
                $envio_puerta[] = stripslashes($result_envio[0]['puerta']);
                $envio_localidad[] = stripslashes($result_envio[0]['localidad']);
                $envio_codigo_postal[] = stripslashes($result_envio[0]['codigo_postal']);
                $envio_provincia[] = stripslashes($result_envio[0]['provincia']);
                $envio_id_zona[] = $result_envio[0]['id_zona'];
                $envio_telefono_1[] = stripslashes($result_envio[0]['telefono_1']);
                $envio_telefono_2[] = stripslashes($result_envio[0]['telefono_2']);
                $envio_mobil[] = stripslashes($result_envio[0]['mobil']);
                $envio_persona_contacto[] = stripslashes($result_envio[0]['persona_contacto']);
                $envio_observaciones[] = nl2br(stripslashes($result_envio[0]['observaciones']));
            }
            $result_envio = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_libradores_envio WHERE id_librador='" . $id_librador . "' ORDER BY fecha_documento DESC");
            if ($conn->registros() >= 1) {
                foreach ($result_envio as $key_envio => $valor_envio) {
                    $id_envio_librador_nombre[] = $valor_envio['id_documentos_1'];
                    if (!empty($result_envio[0]['nombre'])) {
                        $envio_librador_nombre[] = stripslashes($valor_envio['nombre']);
                    } else {
                        $envio_librador_nombre[] = "";
                    }
                    if (!empty($valor_envio['apellido_1'])) {
                        $envio_librador_apellido_1[] = stripslashes($valor_envio['apellido_1']);
                    } else {
                        $envio_librador_apellido_1[] = "";
                    }
                    if (!empty($valor_envio['apellido_2'])) {
                        $envio_librador_apellido_2[] = stripslashes($valor_envio['apellido_2']);
                    } else {
                        $envio_librador_apellido_2[] = "";
                    }
                    if (!empty($valor_envio['razon_social'])) {
                        $envio_librador_social[] = stripslashes($valor_envio['razon_social']);
                    } else {
                        $envio_librador_social[] = "";
                    }
                    if (!empty($valor_envio['razon_comercial'])) {
                        $envio_librador_comercial[] = stripslashes($valor_envio['razon_comercial']);
                    } else {
                        $envio_librador_comercial[] = "";
                    }
                    $envio_direccion[] = stripslashes($valor_envio['direccion']);
                    $envio_numero[] = stripslashes($valor_envio['numero']);
                    $envio_escalera[] = stripslashes($valor_envio['escalera']);
                    $envio_piso[] = stripslashes($valor_envio['piso']);
                    $envio_puerta[] = stripslashes($valor_envio['puerta']);
                    $envio_localidad[] = stripslashes($valor_envio['localidad']);
                    $envio_codigo_postal[] = stripslashes($valor_envio['codigo_postal']);
                    $envio_provincia[] = stripslashes($valor_envio['provincia']);
                    $envio_zona[] = stripslashes($valor_envio['zona']);
                    $result_zona = $conn->query("SELECT id FROM zonas WHERE zona='" . $valor_envio['zona'] . "' LIMIT 1");
                    if ($conn->registros() == 1) {
                        $envio_id_zona[] = $result_zona[0]['id'];
                    } else {
                        $envio_id_zona[] = 0;
                    }
                    $envio_telefono_1[] = stripslashes($valor_envio['telefono_1']);
                    $envio_telefono_2[] = stripslashes($valor_envio['telefono_2']);
                    $envio_mobil[] = stripslashes($valor_envio['mobil']);
                    $envio_persona_contacto[] = stripslashes($valor_envio['persona_contacto']);
                    $envio_observaciones[] = nl2br(stripslashes($valor_envio['observaciones']));
                }
            }
            $result_envio = $conn->query("SELECT fecha_envio,fecha_entrega FROM documentos_" . $ejercicio . "_libradores_envio 
                    WHERE id_documentos_1='" . $id_documento . "' LIMIT 1");

            $fecha_recogida = $result_envio[0]['fecha_entrega'];
            $hora_recogida = $result_documento_1[0]['hora_entrega'];
            $fecha_entrega = $result_envio[0]['fecha_entrega'];
            $hora_entrega = $result_documento_1[0]['hora_entrega'];
        }

        for ($bucle_ejercicios = date('Y'); $bucle_ejercicios >= 2022; $bucle_ejercicios--) {
            $result_deuda = $conn->query("SELECT id_documento FROM documentos_" . $bucle_ejercicios . "_recibos WHERE id_librador='" . $id_librador . "' AND pagado=0 LIMIT 1");
            if ($conn->registros() == 1) {
                $librador_con_deuda = $result_deuda[0]['id_documento'];
                break;
            }
        }

        break;
    case "identificar":
        $log = "ok";
        $log_id_librador = 0;
        $log_tipo_librador = "cli";
        if($email_registro != "" && $password_registro != "") {
            $result_libradores = $conn->query("SELECT id,tipo FROM libradores WHERE email='" . addslashes($email_registro) . "' AND 
                                        password_acceso='" . addslashes($password_registro) . "' AND activo=1 LIMIT 1");
            if ($conn->registros() == 1) {
                if (!isset($_SESSION[$id_sesion_js])) {
                    $_SESSION[$id_sesion_js] = [];
                }
                $_SESSION[$id_sesion_js]['id_librador'] = $result_libradores[0]['id'];
                $_SESSION[$id_sesion_js]['tipo_librador'] = $result_libradores[0]['tipo'];
                $_SESSION[$id_sesion_js]['tipo_documento'] = $tipo_documento_seleccionar;
                $log = "abrir-sesion";
                $log_id_librador = $result_libradores[0]['id'];
                $log_tipo_librador = $result_libradores[0]['tipo'];
            }
        }else {
            unset($_SESSION[$id_sesion_js]['id_librador']);
            unset($_SESSION[$id_sesion_js]['tipo_librador']);
            unset($_SESSION[$id_sesion_js]['tipo_documento']);
            $log = "cerrar-sesion";
        }
        if (isset($ajax)) {
            echo json_encode([
                'logs' => $log,
                'log_id_librador' => $log_id_librador,
                'log_tipo_librador' => $log_tipo_librador
            ]);
        }
        break;
    case "seleccionar-librador":
        $sqlToUpdate1 = "SELECT * FROM libradores
                              WHERE id='" . $id_librador . "' LIMIT 1";
        $sqlToUpdate = "SELECT * FROM libradores
                              WHERE id='" . $id_librador . "' LIMIT 1";
        $result = $conn->query($sqlToUpdate);
        if(!empty($id_documento)) {
            $id_documento_1 = $id_documento;
            $sqlToUpdate = "UPDATE documentos_" . $ejercicio . "_libradores SET 
                                  codigo_librador='" . addslashes($result[0]['codigo_librador']) . "',
                                  nombre='" . addslashes($result[0]['nombre']) . "',
                                  apellido_1='" . addslashes($result[0]['apellido_1']) . "',
                                  apellido_2='" . addslashes($result[0]['apellido_2']) . "',
                                  razon_social='" . addslashes($result[0]['razon_social']) . "',
                                  razon_comercial='" . addslashes($result[0]['razon_comercial']) . "',
                                  nif='" . addslashes($result[0]['nif']) . "',
                                  direccion='" . addslashes($result[0]['direccion']) . "',
                                  numero='" . addslashes($result[0]['numero']) . "',
                                  escalera='" . addslashes($result[0]['escalera']) . "',
                                  piso='" . addslashes($result[0]['piso']) . "',
                                  puerta='" . addslashes($result[0]['puerta']) . "',
                                  localidad='" . addslashes($result[0]['localidad']) . "',
                                  codigo_postal='" . addslashes($result[0]['codigo_postal']) . "',
                                  provincia='" . addslashes($result[0]['provincia']) . "',
                                  telefono_1='" . addslashes($result[0]['telefono_1']) . "',
                                  telefono_2='" . addslashes($result[0]['telefono_2']) . "',
                                  fax='" . addslashes($result[0]['fax']) . "',
                                  mobil='" . addslashes($result[0]['mobil']) . "',
                                  email='" . addslashes($result[0]['email']) . "',
                                  persona_contacto='" . addslashes($result[0]['persona_contacto']) . "', 
                                  id_tarifa_web='" . addslashes($result[0]['id_tarifa_web']) . "', 
                                  id_tarifa_tpv='" . addslashes($result[0]['id_tarifa_tpv']) . "' 
                                  WHERE id_documentos_1='" . $id_documento . "' LIMIT 1";
            $resultUpdate = $conn->query($sqlToUpdate);

            $sqlToUpdate = "UPDATE documentos_" . $ejercicio . "_libradores_envio SET
                                  id_librador='" . $id_librador . "',
                                  nombre='" . addslashes($result[0]['nombre']) . "',
                                  apellido_1='" . addslashes($result[0]['apellido_1']) . "',
                                  apellido_2='" . addslashes($result[0]['apellido_2']) . "',
                                  razon_social='" . addslashes($result[0]['razon_social']) . "',
                                  razon_comercial='" . addslashes($result[0]['razon_comercial']) . "',
                                  direccion='" . addslashes($result[0]['direccion']) . "',
                                  numero='" . addslashes($result[0]['numero']) . "',
                                  escalera='" . addslashes($result[0]['escalera']) . "',
                                  piso='" . addslashes($result[0]['piso']) . "',
                                  puerta='" . addslashes($result[0]['puerta']) . "',
                                  localidad='" . addslashes($result[0]['localidad']) . "',
                                  codigo_postal='" . addslashes($result[0]['codigo_postal']) . "',
                                  provincia='" . addslashes($result[0]['provincia']) . "',
                                  telefono_1='" . addslashes($result[0]['telefono_1']) . "',
                                  telefono_2='" . addslashes($result[0]['telefono_2']) . "',
                                  mobil='" . addslashes($result[0]['mobil']) . "',
                                  persona_contacto='" . addslashes($result[0]['persona_contacto']) . "' 
                                  WHERE id_documentos_1='" . $id_documento . "' LIMIT 1";
            $resultUpdate = $conn->query($sqlToUpdate);

            $resultUpdate = $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET 
                                  id_librador='" . $id_librador . "', 
                                  tipo_librador='" . addslashes($result[0]['tipo']) . "', 
                                  bloqueado=1 
                                  WHERE id='" . $id_documento . "' LIMIT 1");

            $resultUpdate = $conn->query("UPDATE documentos_" . $ejercicio . "_2 SET 
                                  id_librador='" . $id_librador . "', 
                                  tipo_librador='" . addslashes($result[0]['tipo']) . "' 
                                  WHERE id_documentos_1='" . $id_documento . "' LIMIT 1");

            $resultUpdate = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET
                                  id_librador='" . $id_librador . "' 
                                  WHERE id_documento='" . $id_documento . "'");

            $result = $conn->query("UPDATE documentos_" . $ejercicio . "_productos_sku_stock SET 
                                    tipo_librador='" . addslashes($result[0]['tipo']) . "', id_librador='" . $id_librador . "' 
                                    WHERE id_documento_1 = " . $id_documento);

            if (!isset($_SESSION[$id_sesion_js])) {
                $_SESSION[$id_sesion_js] = [];
            }
            $_SESSION[$id_sesion_js]['ejercicio'] = $ejercicio;
            $_SESSION[$id_sesion_js]['id_documento'] = $id_documento_1;
        }else {
            $sqlToUpdate1 = "SELECT * FROM libradores WHERE id='" . $id_librador . "' LIMIT 1";

            $id_sesion = $id_sesion_sys;
            $ip = $ip_sys;
            $so = $so_sys;

            $numero_documento = "";

            $result = $conn->query("SELECT * FROM libradores WHERE id='" . $id_librador . "' LIMIT 1");

            $base_total = 0;
            $total = 0;
            $id_modalidad_pago = $result[0]['id_modalidades_pago'];
            $fecha_documento = date("Y-m-d");
            $id_documento_1 = 0;
            $tipo_documento = $tipo_documento_seleccionar;
            $interface = "tpv";
            $fecha_entrega_desde = "";
            $fecha_entrega_hasta = "";

            $result_pago = $conn->query("SELECT descripcion FROM modalidades_pago WHERE id='" . $result[0]['id_modalidades_pago'] . "' LIMIT 1");
            $result_envio = $conn->query("SELECT descripcion FROM modalidades_envio WHERE id='" . $result[0]['id_modalidades_envio'] . "' LIMIT 1");
            $result_entrega = $conn->query("SELECT descripcion FROM modalidades_entrega WHERE id='" . $result[0]['id_modalidades_entrega'] . "' LIMIT 1");
            $modalidad_pago = $result_pago[0]['descripcion'];
            $modalidad_envio = $result_envio[0]['descripcion'];
            $modalidad_entrega = $result_entrega[0]['descripcion'];

            if (!empty($result[0]['id_irpf'])) {
                $result_irpf = $conn->query("SELECT irpf FROM irpf WHERE id='" . $result[0]['id_irpf'] . "' LIMIT 1");
                $irpf_librador = $result_irpf[0]['irpf'];
            } else {
                $irpf_librador = 0;
            }
            $importe_irpf = 0;
            $descuento_pp = $result[0]['descuento_pp'];
            $importe_descuento_pp = 0;
            $descuento_librador = $result[0]['descuento_librador'];
            $importe_descuento_librador = 0;

            $estado = 0;
            $entregado = 0;
            /* $id_usuario = ??? */
            if (!isset($id_usuario)) {
                $id_usuario = 0;
            }
            /* $id_terminal = ??? */
            if (!isset($id_terminal)) {
                $id_terminal = 0;
            }

            $codigo_librador_documento = $result[0]['codigo_librador'];
            $nombre_documento = $result[0]['nombre'];
            $apellido_1_documento = $result[0]['apellido_1'];
            $apellido_2_documento = $result[0]['apellido_2'];
            $razon_social_documento = $result[0]['razon_social'];
            $razon_comercial_documento = $result[0]['razon_comercial'];
            $nif_documento = $result[0]['nif'];
            $direccion_documento = $result[0]['direccion'];
            $numero_direccion_documento = $result[0]['numero'];
            $escalera_direccion_documento = $result[0]['escalera'];
            $piso_direccion_documento = $result[0]['piso'];
            $puerta_direccion_documento = $result[0]['puerta'];
            $localidad_documento = $result[0]['localidad'];
            $codigo_postal_documento = $result[0]['codigo_postal'];
            $provincia_documento = $result[0]['provincia'];
            $telefono_1_documento = $result[0]['telefono_1'];
            $telefono_2_documento = $result[0]['telefono_2'];
            $fax_documento = $result[0]['fax'];
            $mobil_documento = $result[0]['mobil'];
            $email_documento = $result[0]['email'];
            $persona_contacto_documento = $result[0]['persona_contacto'];
            $tipo_librador = $result[0]['tipo'];
            $result_zona = $conn->query("SELECT zona FROM zonas WHERE id='" . $result[0]['id_zona'] . "' LIMIT 1");
            $zona = $result_zona[0]['descripcion'];
            $observaciones_envio_documento = "";

            $insert_inicial = true;
            require("guardar_documento_1.php");
            require("guardar_documento_libradores.php");
            require("guardar_documento_libradores_envio.php");

            if (!empty($total_documento)) {
                $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total_documento;
            } else if (!empty($total)) {
                $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total;
            } else {
                $descuento_librador_euro = 0;
            }

            if (!isset($_SESSION[$id_sesion_js])) {
                $_SESSION[$id_sesion_js] = [];
            }
            $_SESSION[$id_sesion_js]['ejercicio'] = $ejercicio;
            $_SESSION[$id_sesion_js]['id_documento'] = $id_documento_1;

        }

        $result_libradores = $conn->query("DELETE FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' LIMIT 1");
        $querySql = "INSERT INTO identificacion_accesos 
            VALUES(NULL,".$id_librador.",'".$tipo_librador."','".$tipo_documento_seleccionar."','".$id_sesion_sys."','".$ip_sys."')";
        $result_identificacion_accesos = $conn->query($querySql);
        if (isset($ajax)) {
            echo json_encode([
                'logs' => "seleccionar-librador",
                'id_documento_1' => $id_documento_1,
                'id_librador' => $id_librador,
                'sqlToUpdate1' => $sqlToUpdate1
            ]);
        }
        break;
    case "lista-libradores":
        if($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") {
            $result_libradores = $conn->query("SELECT l.id,l.tipo,l.nombre,l.apellido_1,l.apellido_2,l.razon_social,l.razon_comercial,l.id_comedores,c.descripcion as descripcion_comedor
                            FROM libradores l, comedores c WHERE (l.tipo='mes') AND l.activo=1 AND l.id_comedores = c.id ORDER BY l.id_comedores,l.nombre,l.apellido_1,l.apellido_2,l.razon_social,l.razon_comercial");
            foreach ($result_libradores as $key_libradores => $valor_libradores) {
                $matriz_id_comedores_libradores_seleccionar[] = $valor_libradores['id_comedores'];
                $matriz_descripcion_comedores_libradores_seleccionar[] = 'Sala: ' . $valor_libradores['descripcion_comedor'];
                $matriz_id_libradores_seleccionar[] = $valor_libradores['id'];
                $matriz_tipo_libradores_seleccionar[] = $valor_libradores['tipo'];
                if(!empty($valor_libradores['nombre'])) {
                    $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['nombre'])." ".stripslashes($valor_libradores['apellido_1'])." ".stripslashes($valor_libradores['apellido_2']);
                }else {
                    if($valor_libradores['razon_social'] == $valor_libradores['razon_comercial']) {
                        $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['razon_comercial']);
                    }else {
                        $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['razon_social']) . " / " . stripslashes($valor_libradores['razon_comercial']);
                    }
                }
            }
            $result_libradores = $conn->query("SELECT id,tipo,nombre,apellido_1,apellido_2,razon_social,razon_comercial 
                            FROM libradores WHERE (tipo='cli' OR tipo='tak' OR tipo='del') AND activo=1 ORDER BY nombre,apellido_1,apellido_2,razon_social,razon_comercial");
        }else {
            $result_libradores = $conn->query("SELECT id,tipo,nombre,apellido_1,apellido_2,razon_social,razon_comercial 
                            FROM libradores WHERE tipo='".$tipo_librador."' AND activo=1 ORDER BY nombre,apellido_1,apellido_2,razon_social,razon_comercial");
        }
        foreach ($result_libradores as $key_libradores => $valor_libradores) {
            $matriz_id_comedores_libradores_seleccionar[] = null;
            if($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") {
                $matriz_descripcion_comedores_libradores_seleccionar[] = 'Clientes';
            } else if($tipo_librador == "pro") {
                $matriz_descripcion_comedores_libradores_seleccionar[] = 'Proveedores';
            } else if($tipo_librador == "cre") {
                $matriz_descripcion_comedores_libradores_seleccionar[] = 'Creditores';
            } else {
                $matriz_descripcion_comedores_libradores_seleccionar[] = $tipo_librador;
            }
            $matriz_id_libradores_seleccionar[] = $valor_libradores['id'];
            $matriz_tipo_libradores_seleccionar[] = $valor_libradores['tipo'];
            if(!empty($valor_libradores['nombre'])) {
                $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['nombre'])." ".stripslashes($valor_libradores['apellido_1'])." ".stripslashes($valor_libradores['apellido_2']);
            }else {
                if($valor_libradores['razon_social'] == $valor_libradores['razon_comercial']) {
                    $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['razon_comercial']);
                }else {
                    $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['razon_social']) . " / " . stripslashes($valor_libradores['razon_comercial']);
                }
            }
        }
        break;
    case "buscar-libradores":
        if($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") {
            $result_libradores = $conn->query("SELECT id,tipo,nombre,apellido_1,apellido_2,razon_social,razon_comercial 
                            FROM libradores WHERE (tipo='cli' OR tipo='tak' OR tipo='del' OR tipo='mes') AND activo=1 AND (nombre LIKE '%" . $busqueda . "%' OR apellido_1 LIKE '%" . $busqueda . "%' OR apellido_2 LIKE '%" . $busqueda . "%' OR razon_social LIKE '%" . $busqueda . "%' OR razon_comercial LIKE '%" . $busqueda . "%' OR nif LIKE '%" . $busqueda . "%' OR telefono_1 LIKE '%" . $busqueda . "%' OR telefono_2 LIKE '%" . $busqueda . "%' OR mobil LIKE '%" . $busqueda . "%' OR email LIKE '%" . $busqueda . "%') ORDER BY nombre,apellido_1,apellido_2,razon_social,razon_comercial LIMIT 10");
        }else {
            $result_libradores = $conn->query("SELECT id,tipo,nombre,apellido_1,apellido_2,razon_social,razon_comercial 
                            FROM libradores WHERE tipo='".$tipo_librador."' AND activo=1 AND (nombre LIKE '%" . $busqueda . "%' OR apellido_1 LIKE '%" . $busqueda . "%' OR apellido_2 LIKE '%" . $busqueda . "%' OR razon_social LIKE '%" . $busqueda . "%' OR razon_comercial LIKE '%" . $busqueda . "%' OR nif LIKE '%" . $busqueda . "%' OR telefono_1 LIKE '%" . $busqueda . "%' OR telefono_2 LIKE '%" . $busqueda . "%' OR mobil LIKE '%" . $busqueda . "%' OR email LIKE '%" . $busqueda . "%') ORDER BY nombre,apellido_1,apellido_2,razon_social,razon_comercial LIMIT 10");
        }
        $matriz_id_libradores_seleccionar = [];
        $matriz_tipo_libradores_seleccionar = [];
        $matriz_nombre_libradores_seleccionar = [];
        foreach ($result_libradores as $key_libradores => $valor_libradores) {
            $matriz_id_libradores_seleccionar[] = $valor_libradores['id'];
            $matriz_tipo_libradores_seleccionar[] = $valor_libradores['tipo'];
            if(!empty($valor_libradores['nombre'])) {
                $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['nombre'])." ".stripslashes($valor_libradores['apellido_1'])." ".stripslashes($valor_libradores['apellido_2']);
            }else {
                if($valor_libradores['razon_social'] == $valor_libradores['razon_comercial']) {
                    $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['razon_comercial']);
                }else {
                    $matriz_nombre_libradores_seleccionar[] = stripslashes($valor_libradores['razon_social']) . " / " . stripslashes($valor_libradores['razon_comercial']);
                }
            }
        }

        if ($ajax) {
            $return = new stdClass();
            $return->ids = $matriz_id_libradores_seleccionar;
            $return->tipos = $matriz_tipo_libradores_seleccionar;
            $return->descripciones = $matriz_nombre_libradores_seleccionar;

            echo json_encode($return);
        }
        break;
    case "datos-facturacion":
        $librador_nombre = "";
        $librador_apellido_1 = "";
        $librador_apellido_2 = "";
        $librador_social = "";
        $librador_comercial = "";
        $result_libradores = $conn->query("SELECT codigo_librador,nombre,apellido_1,apellido_2,razon_social,razon_comercial,nif,
                            direccion,numero,escalera,piso,puerta,localidad,codigo_postal,provincia,id_zona,telefono_1,telefono_2,
                            fax,mobil,email,persona_contacto,banco,iban,id_modalidades_envio,id_modalidades_entrega,
                            id_modalidades_pago,id_iva,recargo,id_irpf,dia_pago_1,dia_pago_2,descuento_pp,
                            descuento_librador,id_tarifa_web,id_tarifa_tpv,id_vendedor,id_nivel_comisiones,id_banco_cobro,id_grupo_clientes 
                            FROM libradores WHERE id='".$id_librador."' LIMIT 1");

        $codigo_librador = stripslashes($result_libradores[0]['codigo_librador']);
        if(!empty($result_libradores[0]['nombre'])) {
            $librador_nombre = stripslashes($result_libradores[0]['nombre']);
        }
        if(!empty($result_libradores[0]['apellido_1'])) {
            $librador_apellido_1 = stripslashes($result_libradores[0]['apellido_1']);
        }
        if(!empty($result_libradores[0]['apellido_2'])) {
            $librador_apellido_2 = stripslashes($result_libradores[0]['apellido_2']);
        }
        if(!empty($result_libradores[0]['razon_social'])) {
            $librador_social = stripslashes($result_libradores[0]['razon_social']);
        }
        if(!empty($result_libradores[0]['razon_comercial'])) {
            $librador_comercial = stripslashes($result_libradores[0]['razon_comercial']);
        }
        $nif = stripslashes($result_libradores[0]['nif']);
        $direccion = stripslashes($result_libradores[0]['direccion']);
        $numero = stripslashes($result_libradores[0]['numero']);
        $escalera = stripslashes($result_libradores[0]['escalera']);
        $piso = stripslashes($result_libradores[0]['piso']);
        $puerta = stripslashes($result_libradores[0]['puerta']);
        $localidad = stripslashes($result_libradores[0]['localidad']);
        $codigo_postal = stripslashes($result_libradores[0]['codigo_postal']);
        $provincia = stripslashes($result_libradores[0]['provincia']);
        $id_zona = $result_libradores[0]['id_zona'];
        $telefono_1 = stripslashes($result_libradores[0]['telefono_1']);
        $telefono_2 = stripslashes($result_libradores[0]['telefono_2']);
        $fax = stripslashes($result_libradores[0]['fax']);
        $mobil = stripslashes($result_libradores[0]['mobil']);
        $email = stripslashes($result_libradores[0]['email']);
        $persona_contacto = stripslashes($result_libradores[0]['persona_contacto']);
        $banco = stripslashes($result_libradores[0]['banco']);
        $iban = stripslashes($result_libradores[0]['iban']);
        $id_modalidades_envio = $result_libradores[0]['id_modalidades_envio'];
        $id_modalidades_entrega = $result_libradores[0]['id_modalidades_entrega'];
        $id_modalidades_pago = $result_libradores[0]['id_modalidades_pago'];
        $id_grupo_clientes = $result_libradores[0]['id_grupo_clientes'];
        if ($id_grupo_clientes < 0 || empty($id_grupo_clientes)) {
            $id_grupo_clientes = 0;
        }
        $modalidad_pago = "";
        $id_iva_modalidades_pago = 0;
        $incremento_pvp_modalidades_pago = 0;
        $incremento_por_modalidades_pago = 0;
        require("datos-modalidades.php");
        /*
         * Variables obtenidades en datos-modalidades.php
        $modalidad_pago
        $id_iva_modalidades_pago
        $incremento_pvp_modalidades_pago
        $incremento_por_modalidades_pago
        */
        $id_iva_librador = $result_libradores[0]['id_iva'];
        $recargo = $result_libradores[0]['recargo']; // 1/0 si/no
        $id_irpf_librador = $result_libradores[0]['id_irpf'];
        $iva_librador = -1;
        $recargo_librador = 0;
        $irpf_librador = 0;
        if(isset($matriz_iva_productos_iva[$id_iva_librador])) {
            $iva_librador = $matriz_iva_productos_iva[$id_iva_librador];
        }
        if ($recargo == 1) {
            if (isset($matriz_recargo_productos_iva[$id_iva_librador])) {
                $recargo_librador = $matriz_recargo_productos_iva[$id_iva_librador];
            }
        }
        if(isset($matriz_irpf[$id_irpf_librador])) {
            $irpf_librador = $matriz_irpf[$id_irpf_librador];
        }
        $dia_pago_1 = $result_libradores[0]['dia_pago_1'];
        $dia_pago_2 = $result_libradores[0]['dia_pago_2'];
        $descuento_pp = $result_libradores[0]['descuento_pp'];
        $descuento_librador = $result_libradores[0]['descuento_librador'];
        if (!empty($total_documento)) {
            $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total_documento;
        } else if (!empty($total)) {
            $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total;
        } else {
            $descuento_librador_euro = 0;
        }
        $id_tarifa_web = $result_libradores[0]['id_tarifa_web'];
        $id_tarifa_tpv = $result_libradores[0]['id_tarifa_tpv'];
        $id_vendedor = $result_libradores[0]['id_vendedor'];
        $id_nivel_comisiones = $result_libradores[0]['id_nivel_comisiones'];
        $id_banco_cobro = $result_libradores[0]['id_banco_cobro'];
        if (isset($ajax)) {
            echo json_encode([
                'codigo_librador' => $codigo_librador,
                'librador_nombre' => $librador_nombre,
                'librador_apellido_1' => $librador_apellido_1,
                'librador_apellido_2' => $librador_apellido_2,
                'librador_social' => $librador_social,
                'librador_comercial' => $librador_comercial,
                'nif' => $nif,
                'direccion' => $direccion,
                'numero' => $numero,
                'escalera' => $escalera,
                'piso' => $piso,
                'puerta' => $puerta,
                'localidad' => $localidad,
                'codigo_postal' => $codigo_postal,
                'provincia' => $provincia,
                'id_zona' => $id_zona,
                'telefono_1' => $telefono_1,
                'telefono_2' => $telefono_2,
                'fax' => $fax,
                'mobil' => $mobil,
                'email' => $email,
                'persona_contacto' => $persona_contacto,
                'banco' => $banco,
                'iban' => $iban,
                'id_modalidades_envio' => $id_modalidades_envio,
                'id_modalidades_entrega' => $id_modalidades_entrega,
                'id_modalidades_pago' => $id_modalidades_pago,
                'id_iva_modalidades_pago' => $id_iva_modalidades_pago,
                'incremento_pvp_modalidades_pago' => $incremento_pvp_modalidades_pago,
                'incremento_por_modalidades_pago' => $incremento_por_modalidades_pago,
                'modalidad_pago' => $modalidad_pago,
                'id_iva_librador' => $id_iva_librador,
                'recargo' => $recargo,
                'id_irpf_librador' => $id_irpf_librador,
                'iva_librador' => $iva_librador,
                'recargo_librador' => $recargo_librador,
                'irpf_librador' => $irpf_librador,
                'dia_pago_1' => $dia_pago_1,
                'dia_pago_2' => $dia_pago_2,
                'descuento_pp' => $descuento_pp,
                'descuento_librador' => $descuento_librador,
                'id_tarifa_web' => $id_tarifa_web,
                'id_tarifa_tpv' => $id_tarifa_tpv,
                'id_vendedor' => $id_vendedor,
                'id_nivel_comisiones' => $id_nivel_comisiones,
                'id_banco_cobro' => $id_banco_cobro
            ]);
        }
        break;
    case "guardar-seleccionar-librador":
        $log_guardar_ficha = $guardar_ficha;
        $log_id_librador = $id_librador;

        if(empty($nombre_documento) && empty($apellido_1_documento) && empty($apellido_2_documento) && empty($razon_social_documento) && empty($razon_comercial_documento)) {
            if(!empty($mobil_documento)) {
                $razon_social_documento = $mobil_documento;
            }else if(!empty($telefono_1_documento)) {
                $razon_social_documento = $telefono_1_documento;
            }
        }

        if($guardar_ficha == 1) {
            if ($id_librador == -1) {
                $log1 = "INSERT INTO libradores VALUES(
                              NULL,
                              '" . addslashes($codigo_librador_documento) . "',
                              '" . $tipo_librador . "',
                              '',
                              '" . addslashes($nombre_documento) . "',
                              '" . addslashes($apellido_1_documento) . "',
                              '" . addslashes($apellido_2_documento) . "',
                              '" . addslashes($razon_social_documento) . "',
                              '" . addslashes($razon_comercial_documento) . "',
                              '" . addslashes($nif_documento) . "',
                              '" . addslashes($direccion_documento) . "',
                              '" . addslashes($numero_direccion_documento) . "',
                              '" . addslashes($escalera_direccion_documento) . "',
                              '" . addslashes($piso_direccion_documento) . "',
                              '" . addslashes($puerta_direccion_documento) . "',
                              '" . addslashes($localidad_documento) . "',
                              '" . addslashes($codigo_postal_documento) . "',
                              '" . addslashes($provincia_documento) . "',
                              '0',
                              '" . addslashes($telefono_1_documento) . "',
                              '" . addslashes($telefono_2_documento) . "',
                              '" . addslashes($fax_documento) . "',
                              '" . addslashes($mobil_documento) . "',
                              '" . addslashes($email_documento) . "',
                              '',
                              '0',
                              '0',
                              '" . addslashes($persona_contacto_documento) . "',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '0',
                              'null',
                              '',
                              '0',
                              '0',
                              '0',
                              '0',
                              '-1',
                              '0',
                              '0',
                              '0',
                              '0',
                              '0.00',
                              '0.00',
                              '1',
                              '1',
                              '',
                              '0',
                              '0',
                              '0',
                              '1', 
                              '1', 
                              '', 
                              '', 
                              '0', 
                              '0',
                              '1', 
                              '0', 
                              '0', 
                              '0', 
                              '0', 
                              '" . date('Y-m-d H:i:s') . "',
                              '" . date('Y-m-d H:i:s') . "')";
                $result = $conn->query("INSERT INTO libradores VALUES(
                              NULL,
                              '" . addslashes($codigo_librador_documento) . "',
                              '" . $tipo_librador . "',
                              '',
                              '" . addslashes($nombre_documento) . "',
                              '" . addslashes($apellido_1_documento) . "',
                              '" . addslashes($apellido_2_documento) . "',
                              '" . addslashes($razon_social_documento) . "',
                              '" . addslashes($razon_comercial_documento) . "',
                              '" . addslashes($nif_documento) . "',
                              '" . addslashes($direccion_documento) . "',
                              '" . addslashes($numero_direccion_documento) . "',
                              '" . addslashes($escalera_direccion_documento) . "',
                              '" . addslashes($piso_direccion_documento) . "',
                              '" . addslashes($puerta_direccion_documento) . "',
                              '" . addslashes($localidad_documento) . "',
                              '" . addslashes($codigo_postal_documento) . "',
                              '" . addslashes($provincia_documento) . "',
                              '0',
                              '" . addslashes($telefono_1_documento) . "',
                              '" . addslashes($telefono_2_documento) . "',
                              '" . addslashes($fax_documento) . "',
                              '" . addslashes($mobil_documento) . "',
                              '" . addslashes($email_documento) . "',
                              '',
                              '0',
                              '0',
                              '" . addslashes($persona_contacto_documento) . "',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '',
                              '0',
                              'null',
                              '',
                              '0',
                              '0',
                              '0',
                              '0',
                              '-1',
                              '0',
                              '0',
                              '0',
                              '0',
                              '0.00',
                              '0.00',
                              '1',
                              '1',
                              '',
                              '0',
                              '0',
                              '0',
                              '1', 
                              '1', 
                              '', 
                              '', 
                              '0', 
                              '0',
                              '1', 
                              '0', 
                              '0', 
                              '0', 
                              '0', 
                              '" . date('Y-m-d H:i:s') . "',
                              '" . date('Y-m-d H:i:s') . "')");
                $id_librador = $conn->id_insert();
            } else {
                $log1 = "UPDATE libradores SET 
                              codigo_librador='" . addslashes($codigo_librador_documento) . "',
                              nombre='" . addslashes($nombre_documento) . "',
                              apellido_1='" . addslashes($apellido_1_documento) . "',
                              apellido_2='" . addslashes($apellido_2_documento) . "',
                              razon_social='" . addslashes($razon_social_documento) . "',
                              razon_comercial='" . addslashes($razon_comercial_documento) . "',
                              nif='" . addslashes($nif_documento) . "',
                              direccion='" . addslashes($direccion_documento) . "',
                              numero='" . addslashes($numero_direccion_documento) . "',
                              escalera='" . addslashes($escalera_direccion_documento) . "',
                              piso='" . addslashes($piso_direccion_documento) . "',
                              puerta='" . addslashes($puerta_direccion_documento) . "',
                              localidad='" . addslashes($localidad_documento) . "',
                              codigo_postal='" . addslashes($codigo_postal_documento) . "',
                              provincia='" . addslashes($provincia_documento) . "',
                              telefono_1='" . addslashes($telefono_1_documento) . "',
                              telefono_2='" . addslashes($telefono_2_documento) . "',
                              fax='" . addslashes($fax_documento) . "',
                              mobil='" . addslashes($mobil_documento) . "',
                              email='" . addslashes($email_documento) . "',
                              persona_contacto='" . addslashes($persona_contacto_documento) . "',
                              fecha_modificacion='" . date('Y-m-d H:i:s') . "' WHERE id='" . $id_librador . "' LIMIT 1";
                $result = $conn->query("UPDATE libradores SET 
                              codigo_librador='" . addslashes($codigo_librador_documento) . "',
                              nombre='" . addslashes($nombre_documento) . "',
                              apellido_1='" . addslashes($apellido_1_documento) . "',
                              apellido_2='" . addslashes($apellido_2_documento) . "',
                              razon_social='" . addslashes($razon_social_documento) . "',
                              razon_comercial='" . addslashes($razon_comercial_documento) . "',
                              nif='" . addslashes($nif_documento) . "',
                              direccion='" . addslashes($direccion_documento) . "',
                              numero='" . addslashes($numero_direccion_documento) . "',
                              escalera='" . addslashes($escalera_direccion_documento) . "',
                              piso='" . addslashes($piso_direccion_documento) . "',
                              puerta='" . addslashes($puerta_direccion_documento) . "',
                              localidad='" . addslashes($localidad_documento) . "',
                              codigo_postal='" . addslashes($codigo_postal_documento) . "',
                              provincia='" . addslashes($provincia_documento) . "',
                              telefono_1='" . addslashes($telefono_1_documento) . "',
                              telefono_2='" . addslashes($telefono_2_documento) . "',
                              fax='" . addslashes($fax_documento) . "',
                              mobil='" . addslashes($mobil_documento) . "',
                              email='" . addslashes($email_documento) . "',
                              persona_contacto='" . addslashes($persona_contacto_documento) . "',
                              fecha_modificacion='" . date('Y-m-d') . "' WHERE id='" . $id_librador . "' LIMIT 1");
            }
        }
        if($tipo_librador == "tak") {
            $nombre_documento = $mobil_documento;
        }
        $sqlToUpdate = "UPDATE documentos_" . $ejercicio . "_libradores SET 
                              codigo_librador='" . addslashes($codigo_librador_documento) . "',
                              nombre='" . addslashes($nombre_documento) . "',
                              apellido_1='" . addslashes($apellido_1_documento) . "',
                              apellido_2='" . addslashes($apellido_2_documento) . "',
                              razon_social='" . addslashes($razon_social_documento) . "',
                              razon_comercial='" . addslashes($razon_comercial_documento) . "',
                              nif='" . addslashes($nif_documento) . "',
                              direccion='" . addslashes($direccion_documento) . "',
                              numero='" . addslashes($numero_direccion_documento) . "',
                              escalera='" . addslashes($escalera_direccion_documento) . "',
                              piso='" . addslashes($piso_direccion_documento) . "',
                              puerta='" . addslashes($puerta_direccion_documento) . "',
                              localidad='" . addslashes($localidad_documento) . "',
                              codigo_postal='" . addslashes($codigo_postal_documento) . "',
                              provincia='" . addslashes($provincia_documento) . "',
                              telefono_1='" . addslashes($telefono_1_documento) . "',
                              telefono_2='" . addslashes($telefono_2_documento) . "',
                              fax='" . addslashes($fax_documento) . "',
                              mobil='" . addslashes($mobil_documento) . "',
                              email='" . addslashes($email_documento) . "',
                              persona_contacto='" . addslashes($persona_contacto_documento) . "' 
                              WHERE id_documentos_1='" . $id_documento . "' LIMIT 1";
        $result = $conn->query($sqlToUpdate);
        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET 
                              id_librador='" . $id_librador . "', 
                              tipo_librador='" . addslashes($tipo_librador) . "', 
                              fecha_entrega_desde='" . $fecha_recogida_documento . "', 
                              fecha_entrega_hasta='" . $fecha_recogida_documento . "', 
                              hora_entrega='" . $hora_recogida_documento . "' 
                              WHERE id='" . $id_documento . "' LIMIT 1");
        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET 
                              id_librador='" . $id_librador . "'  
                              WHERE id_documento='" . $id_documento . "'");
        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_libradores_envio SET  
                              fecha_envio='" . $fecha_recogida_documento . "', 
                              fecha_entrega='" . $fecha_recogida_documento . "'  
                              WHERE id_documentos_1='" . $id_documento . "' LIMIT 1");

        $_SESSION[$id_sesion_js]['id_librador'] = $id_librador;
        $_SESSION[$id_sesion_js]['tipo_librador'] = $tipo_librador;
        $_SESSION[$id_sesion_js]['tipo_documento'] = $tipo_documento_seleccionar;

        if (isset($ajax)) {
            echo json_encode([
                'logs0' => $log1,
                'logs1' => $log_guardar_ficha,
                'logs2' => $log_id_librador
            ]);
        }
        break;
    case "seleccionar-envio":
        $nombre_envio_documento = "";
        $razon_social_envio_documento = "";
        $razon_comercial_envio_documento = "";
        $direccion_envio_documento = "";
        $numero_direccion_envio_documento = "";
        $escalera_direccion_envio_documento = "";
        $piso_direccion_envio_documento = "";
        $puerta_direccion_envio_documento = "";
        $localidad_envio_documento = "";
        $codigo_postal_envio_documento = "";
        $provincia_envio_documento = "";
        $telefono_1_envio_documento = "";
        $telefono_2_envio_documento = "";
        $mobil_envio_documento = "";
        $persona_contacto_envio_documento = "";
        $observaciones_envio_documento = "";
        $result = $conn->query("SELECT * FROM documentos_".$ejercicio."_libradores_envio WHERE id".$id_datos_envio." LIMIT 1");
        if($conn->registros() == 1) {
            $nombre_envio_documento = $result[0]['nombre'];
            $razon_social_envio_documento = $result[0]['razon_social'];
            $razon_comercial_envio_documento = $result[0]['razon_comercial'];
            $direccion_envio_documento = $result[0]['direccion'];
            $numero_direccion_envio_documento = $result[0]['numero'];
            $escalera_direccion_envio_documento = $result[0]['escalera'];
            $piso_direccion_envio_documento = $result[0]['piso'];
            $puerta_direccion_envio_documento = $result[0]['puerta'];
            $localidad_envio_documento = $result[0]['localidad'];
            $codigo_postal_envio_documento = $result[0]['codigo_postal'];
            $provincia_envio_documento = $result[0]['provincia'];
            $telefono_1_envio_documento = $result[0]['telefono_1'];
            $telefono_2_envio_documento = $result[0]['telefono_2'];
            $mobil_envio_documento = $result[0]['mobil'];
            $persona_contacto_envio_documento = $result[0]['persona_contacto'];
            $observaciones_envio_documento = $result[0]['observaciones'];
        }
        if (isset($ajax)) {
            echo json_encode([
                'nombre_envio_documento' => $nombre_envio_documento,
                'razon_social_envio_documento' => $razon_social_envio_documento,
                'razon_comercial_envio_documento' => $razon_comercial_envio_documento,
                'direccion_envio_documento' => $direccion_envio_documento,
                'numero_direccion_envio_documento' => $numero_direccion_envio_documento,
                'escalera_direccion_envio_documento' => $escalera_direccion_envio_documento,
                'piso_direccion_envio_documento' => $piso_direccion_envio_documento,
                'puerta_direccion_envio_documento' => $puerta_direccion_envio_documento,
                'localidad_envio_documento' => $localidad_envio_documento,
                'codigo_postal_envio_documento' => $codigo_postal_envio_documento,
                'provincia_envio_documento' => $provincia_envio_documento,
                'telefono_1_envio_documento' => $telefono_1_envio_documento,
                'telefono_2_envio_documento' => $telefono_2_envio_documento,
                'mobil_envio_documento' => $mobil_envio_documento,
                'persona_contacto_envio_documento' => $persona_contacto_envio_documento,
                'observaciones_envio_documento' => $observaciones_envio_documento
            ]);
        }
        break;
    case "guardar-envio":
        /*
        Guardar los datos de envio en $id_datos_envio de documentos_XXXX_librador_envio
        */
        $log0 = $actualizar_ficha;
        $log1 = "";
        if($actualizar_ficha == 1) {
            $result = $conn->query("SELECT * FROM libradores_envio WHERE id_librador='".$id_librador."' LIMIT 1");
            if($conn->registros() != 1) {
                $log1 = "INSERT INTO libradores_envio VALUES(
                              NULL,
                              '" . $id_librador . "',
                              '" . addslashes($nombre_envio_documento) . "',
                              '" . addslashes($apellido_1_envio) . "',
                              '" . addslashes($apellido_2_envio) . "',
                              '" . addslashes($razon_social_envio_documento) . "',
                              '" . addslashes($razon_comercial_envio_documento) . "',
                              '" . addslashes($direccion_envio_documento) . "',
                              '" . addslashes($numero_direccion_envio_documento) . "',
                              '" . addslashes($escalera_direccion_envio_documento) . "',
                              '" . addslashes($piso_direccion_envio_documento) . "',
                              '" . addslashes($puerta_direccion_envio_documento) . "',
                              '" . addslashes($localidad_envio_documento) . "',
                              '" . addslashes($codigo_postal_envio_documento) . "',
                              '" . addslashes($provincia_envio_documento) . "',
                              '" . $id_zona_envio . "',
                              '" . addslashes($telefono_1_envio_documento) . "',
                              '" . addslashes($telefono_2_envio_documento) . "',
                              '" . addslashes($mobil_envio_documento) . "',
                              '" . addslashes($persona_contacto_envio_documento) . "',
                              '" . addslashes($observaciones_envio_documento) . "',
                              '1',
                              '" . date('Y-m-d') . "',
                              '" . date('Y-m-d') . "')";
                $result = $conn->query("INSERT INTO libradores_envio VALUES(
                              NULL,
                              '" . $id_librador . "',
                              '" . addslashes($nombre_envio_documento) . "',
                              '" . addslashes($apellido_1_envio) . "',
                              '" . addslashes($apellido_2_envio) . "',
                              '" . addslashes($razon_social_envio_documento) . "',
                              '" . addslashes($razon_comercial_envio_documento) . "',
                              '" . addslashes($direccion_envio_documento) . "',
                              '" . addslashes($numero_direccion_envio_documento) . "',
                              '" . addslashes($escalera_direccion_envio_documento) . "',
                              '" . addslashes($piso_direccion_envio_documento) . "',
                              '" . addslashes($puerta_direccion_envio_documento) . "',
                              '" . addslashes($localidad_envio_documento) . "',
                              '" . addslashes($codigo_postal_envio_documento) . "',
                              '" . addslashes($provincia_envio_documento) . "',
                              '" . $id_zona_envio . "',
                              '" . addslashes($telefono_1_envio_documento) . "',
                              '" . addslashes($telefono_2_envio_documento) . "',
                              '" . addslashes($mobil_envio_documento) . "',
                              '" . addslashes($persona_contacto_envio_documento) . "',
                              '" . addslashes($observaciones_envio_documento) . "',
                              '1',
                              '" . date('Y-m-d') . "',
                              '" . date('Y-m-d') . "')");
            } else {
                $log1 = "UPDATE libradores_envio SET 
                              nombre='" . addslashes($nombre_envio_documento) . "',
                              apellido_1='" . addslashes($apellido_1_envio) . "',
                              apellido_2='" . addslashes($apellido_2_envio) . "',
                              razon_social='" . addslashes($razon_social_envio_documento) . "',
                              razon_comercial='" . addslashes($razon_comercial_envio_documento) . "',
                              direccion='" . addslashes($direccion_envio_documento) . "',
                              numero='" . addslashes($numero_direccion_envio_documento) . "',
                              escalera='" . addslashes($escalera_direccion_envio_documento) . "',
                              piso='" . addslashes($piso_direccion_envio_documento) . "',
                              puerta='" . addslashes($puerta_direccion_envio_documento) . "',
                              localidad='" . addslashes($localidad_envio_documento) . "',
                              codigo_postal='" . addslashes($codigo_postal_envio_documento) . "',
                              provincia='" . addslashes($provincia_envio_documento) . "',
                              id_zona='" . $id_zona_envio . "',
                              telefono_1='" . addslashes($telefono_1_envio_documento) . "',
                              telefono_2='" . addslashes($telefono_2_envio_documento) . "',
                              mobil='" . addslashes($mobil_envio_documento) . "',
                              persona_contacto='" . addslashes($persona_contacto_envio_documento) . "',
                              observaciones='" . addslashes($observaciones_envio_documento) . "',
                              activo='1',
                              fecha_modificacion='" . date('Y-m-d') . "' WHERE id_librador='" . $id_librador . "' LIMIT 1";
                $result = $conn->query("UPDATE libradores_envio SET 
                              nombre='" . addslashes($nombre_envio_documento) . "',
                              apellido_1='" . addslashes($apellido_1_envio) . "',
                              apellido_2='" . addslashes($apellido_2_envio) . "',
                              razon_social='" . addslashes($razon_social_envio_documento) . "',
                              razon_comercial='" . addslashes($razon_comercial_envio_documento) . "',
                              direccion='" . addslashes($direccion_envio_documento) . "',
                              numero='" . addslashes($numero_direccion_envio_documento) . "',
                              escalera='" . addslashes($escalera_direccion_envio_documento) . "',
                              piso='" . addslashes($piso_direccion_envio_documento) . "',
                              puerta='" . addslashes($puerta_direccion_envio_documento) . "',
                              localidad='" . addslashes($localidad_envio_documento) . "',
                              codigo_postal='" . addslashes($codigo_postal_envio_documento) . "',
                              provincia='" . addslashes($provincia_envio_documento) . "',
                              id_zona='" . $id_zona_envio . "',
                              telefono_1='" . addslashes($telefono_1_envio_documento) . "',
                              telefono_2='" . addslashes($telefono_2_envio_documento) . "',
                              mobil='" . addslashes($mobil_envio_documento) . "',
                              persona_contacto='" . addslashes($persona_contacto_envio_documento) . "',
                              observaciones='" . addslashes($observaciones_envio_documento) . "',
                              activo='1',
                              fecha_modificacion='" . date('Y-m-d') . "' WHERE id_librador='" . $id_librador . "' LIMIT 1");
            }
        }
        $result_zona = $conn->query("SELECT zona FROM zonas WHERE id='" . $id_zona_envio . "' LIMIT 1");
        if ($conn->registros() == 1) {
            $zona = stripslashes($result_zona[0]['zona']);
        } else {
            $zona = "";
        }
        $log2 = "UPDATE documentos_" . $ejercicio . "_libradores_envio SET 
                              nombre='" . addslashes($nombre_envio_documento) . "',
                              apellido_1='" . addslashes($apellido_1_envio) . "',
                              apellido_2='" . addslashes($apellido_2_envio) . "',
                              razon_social='" . addslashes($razon_social_envio_documento) . "',
                              razon_comercial='" . addslashes($razon_comercial_envio_documento) . "',
                              direccion='" . addslashes($direccion_envio_documento) . "',
                              numero='" . addslashes($numero_direccion_envio_documento) . "',
                              escalera='" . addslashes($escalera_direccion_envio_documento) . "',
                              piso='" . addslashes($piso_direccion_envio_documento) . "',
                              puerta='" . addslashes($puerta_direccion_envio_documento) . "',
                              localidad='" . addslashes($localidad_envio_documento) . "',
                              codigo_postal='" . addslashes($codigo_postal_envio_documento) . "',
                              provincia='" . addslashes($provincia_envio_documento) . "',
                              zona='" . addslashes($zona) . "',
                              telefono_1='" . addslashes($telefono_1_envio_documento) . "',
                              telefono_2='" . addslashes($telefono_2_envio_documento) . "',
                              mobil='" . addslashes($mobil_envio_documento) . "',
                              persona_contacto='" . addslashes($persona_contacto_envio_documento) . "',
                              observaciones='" . addslashes($observaciones_envio_documento) . "' 
                              WHERE id_documentos_1='" . $id_documento . "' LIMIT 1";
        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_libradores_envio SET 
                              nombre='" . addslashes($nombre_envio_documento) . "',
                              apellido_1='" . addslashes($apellido_1_envio) . "',
                              apellido_2='" . addslashes($apellido_2_envio) . "',
                              razon_social='" . addslashes($razon_social_envio_documento) . "',
                              razon_comercial='" . addslashes($razon_comercial_envio_documento) . "',
                              direccion='" . addslashes($direccion_envio_documento) . "',
                              numero='" . addslashes($numero_direccion_envio_documento) . "',
                              escalera='" . addslashes($escalera_direccion_envio_documento) . "',
                              piso='" . addslashes($piso_direccion_envio_documento) . "',
                              puerta='" . addslashes($puerta_direccion_envio_documento) . "',
                              localidad='" . addslashes($localidad_envio_documento) . "',
                              codigo_postal='" . addslashes($codigo_postal_envio_documento) . "',
                              provincia='" . addslashes($provincia_envio_documento) . "',
                              zona='" . addslashes($zona) . "',
                              telefono_1='" . addslashes($telefono_1_envio_documento) . "',
                              telefono_2='" . addslashes($telefono_2_envio_documento) . "',
                              mobil='" . addslashes($mobil_envio_documento) . "',
                              persona_contacto='" . addslashes($persona_contacto_envio_documento) . "',
                              observaciones='" . addslashes($observaciones_envio_documento) . "' 
                              WHERE id_documentos_1='" . $id_documento . "' LIMIT 1");
        if (isset($ajax)) {
            echo json_encode([
                'logs0' => $log0,
                'logs1' => $log1,
                'logs2' => $log2
            ]);
        }
        break;
    case "guardar-datos-documento":
        $datos = "";
        $descuento_pp = $descuento_pp_documento_cesta;
        $descuento_librador = $descuento_librador_documento_cesta;
        $id_documento_1 = $id_documento;
        $base_total = 0;
        $irpf_librador = $irpf_documento_cesta;
        $total = 0;
        require("calcular_totales.php");

        if (empty((float) $descuento_librador_documento_cesta) && !empty($descuento_librador_euro_documento_cesta) && (float) $descuento_librador_euro_documento_cesta > 0) {
            $descuento_librador = ((float) $descuento_librador_euro_documento_cesta / $total) * 100;
            $descuento_librador_documento_cesta = $descuento_librador;

            $base_total = 0;
            $irpf_librador = $irpf_documento_cesta;
            $total = 0;
            require("calcular_totales.php");
        }

        $dato_pp2 = $importe_descuento_pp;

        $log0 = $guardar_ficha;
        $log1 = "";
        $id_irpf = 0;
        if(!empty($irpf_documento_cesta)) {
            $result_irpf = $conn->query("SELECT id,activo FROM irpf WHERE irpf='" . $irpf_documento_cesta . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $id_irpf = $result_irpf[0]['id'];
                if ($result_irpf[0]['activo'] == 0) {
                    $result_irpf = $conn->query("UPDATE irpf SET activo=1 WHERE id='" . $id_irpf . "' LIMIT 1");
                }
            } else {
                $result_irpf = $conn->query("INSERT INTO irpf VALUES(NULL,'" . $irpf_documento_cesta . "','1')");
                $id_irpf = $conn->id_insert();
            }
        }
        if($guardar_ficha == 1) {
            $result = $conn->query("UPDATE libradores SET 
                          id_modalidades_envio='" . $id_modalidad_envio . "',
                          id_modalidades_entrega='" . $id_modalidad_entrega . "',
                          id_modalidades_pago='" . $id_modalidad_pago . "',
                          id_irpf='" . $id_irpf . "',
                          descuento_pp='" . $descuento_pp_documento_cesta . "',
                          descuento_librador='" . $descuento_librador_documento_cesta . "' 
                          WHERE id='" . $id_librador . "' LIMIT 1");
        } else {
            $result = $conn->query("UPDATE libradores SET 
                          id_irpf='" . $id_irpf . "'
                          WHERE id='" . $id_librador . "' LIMIT 1");
        }
        $result = $conn->query("UPDATE libradores SET 
                          recargo='" . $recargo_documento_cesta . "' 
                          WHERE id='" . $id_librador . "' LIMIT 1");
        $log2 = "UPDATE documentos_" . $ejercicio . "_1 SET 
                              fecha_documento='" . $fecha_documento . "',
                              fecha_entrada='" . $fecha_entrada . "',
                              numero_documento='" . addslashes($numero_documento) . "',
                              serie_documento='" . addslashes($serie_documento) . "',
                              modalidad_pago='" . $id_modalidad_pago . "',
                              modalidad_envio='" . $id_modalidad_envio . "',
                              modalidad_entrega='" . $id_modalidad_entrega . "',
                              irpf='" . $irpf_documento_cesta . "',
                              importe_irpf='" . $importe_irpf . "',
                              descuento_pp='" . $descuento_pp_documento_cesta . "',
                              importe_descuento_pp='" . $importe_descuento_pp . "',
                              descuento_librador='" . $descuento_librador_documento_cesta . "',
                              importe_descuento_librador='" . $importe_descuento_librador . "',
                              base='" . $base_total . "',
                              total='" . $total . "' 
                              WHERE id='" . $id_documento . "' LIMIT 1";

        $modalidad_pago = "";
        $modalidad_envio = "";
        $modalidad_entrega = "";
        $result = $conn->query("SELECT descripcion FROM modalidades_pago WHERE id='" . $id_modalidad_pago . "' LIMIT 1");
        if($conn->registros() == 1) {
            $modalidad_pago = stripslashes($result[0]['descripcion']);
        }
        $result = $conn->query("SELECT descripcion FROM modalidades_envio WHERE id='" . $id_modalidad_envio . "' LIMIT 1");
        if($conn->registros() == 1) {
            $modalidad_envio = stripslashes($result[0]['descripcion']);
        }
        $result = $conn->query("SELECT descripcion FROM modalidades_entrega WHERE id='" . $id_modalidad_entrega . "' LIMIT 1");
        if($conn->registros() == 1) {
            $modalidad_entrega = stripslashes($result[0]['descripcion']);
        }
        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET 
                              fecha_documento='" . $fecha_documento . "',
                              fecha_entrada='" . $fecha_entrada . "',
                              numero_documento='" . addslashes($numero_documento) . "',
                              serie_documento='" . addslashes($serie_documento) . "',
                              modalidad_pago='" . addslashes($modalidad_pago) . "',
                              modalidad_envio='" . addslashes($modalidad_envio) . "',
                              modalidad_entrega='" . addslashes($modalidad_entrega) . "',
                              irpf='" . $irpf_documento_cesta . "',
                              importe_irpf='" . $importe_irpf . "',
                              descuento_pp='" . $descuento_pp_documento_cesta . "',
                              importe_descuento_pp='" . $importe_descuento_pp . "',
                              descuento_librador='" . $descuento_librador_documento_cesta . "',
                              importe_descuento_librador='" . $importe_descuento_librador . "',
                              base='" . $base_total . "',
                              total='" . $total . "' 
                              WHERE id='" . $id_documento . "' LIMIT 1");

        // Modificamos la estructura de recibos.
        if ($tipo_documento_seleccionar == 'tiq' || $tipo_documento_seleccionar == 'fac') {
            $result_modalidades_pago_lineas = $conn->query("SELECT dias,porcentaje FROM modalidades_pago_lineas WHERE id_forma_pago='".$id_modalidad_pago."' ORDER BY dias");
            foreach ($result_modalidades_pago_lineas as $key_modalidades_pago_lineas => $valor_modalidades_pago_lineas) {
                $suma_importe_recibos = $total / 100 * $valor_modalidades_pago_lineas['porcentaje'];
                $importe_recibos[] = number_format($suma_importe_recibos, 2, ".", "");
                $fecha_recibo = date("d-m-Y",strtotime($fecha_documento."+ " . $valor_modalidades_pago_lineas['dias'] . " days"));
                $dias_recibos[]= DateTime::createFromFormat('d-m-Y', $fecha_recibo)->format('Y-m-d');
            }
            if(isset($importe_recibos) && count($importe_recibos) > 1) {
                // INICIO Cuadramos los importes
                $suma_importe_recibos = 0;
                foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                    $suma_importe_recibos += $valor_importe_recibos;
                }
                $diferencia_importe_recibos = $total - $suma_importe_recibos;
                if (!empty($diferencia_importe_recibos)) {
                    $importe_recibos[0] = $importe_recibos[0] + $diferencia_importe_recibos;
                }
                // FINAL Cuadramos los importes
            }
            $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_recibos WHERE id_documento = '" . $id_documento . "'");
            $numero_efecto = 0;
            foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                $numero_efecto += 1;
                $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(
                NULL,
                '" . $id_documento . "',
                '" . addslashes($tipo_documento_seleccionar) . "',
                '" . $id_librador . "',
                '" . $valor_importe_recibos . "',
                '" . $fecha_documento . "',
                '" . $dias_recibos[$key_importe_recibos] . "',
                '0',
                '',
                '',
                '0',
                '0',
                '" . $id_modalidad_pago . "',
                '" . $numero_efecto . "',
                '0',
                '0',
                '',
                NULL,
                '')");
            }
            unset($importe_recibos);
            unset($dias_recibos);
        }
        // FIN Modificamos la estructura de recibos.


        if (isset($ajax)) {
            echo json_encode([
                'logs0' => $log0,
                'logs1' => $log1,
                'logs2' => $log2,
                'datos' => $datos,
                'datopp0' => $dato_pp2,
                'datopp1' => $importe_descuento_pp
            ]);
        }
        break;
    case "guardar-datos-descuentos":
        $datos = "";
        $descuento_pp = $descuento_pp_documento_cesta;
        $descuento_librador = $descuento_librador_documento_cesta;

        $id_documento_1 = $id_documento;
        $base_total = 0;
        $irpf_librador = $irpf_documento_cesta;
        $total = 0;
        require("calcular_totales.php");

        if (empty((float) $descuento_librador_documento_cesta) && !empty($descuento_librador_euro_documento_cesta) && (float) $descuento_librador_euro_documento_cesta > 0) {
            $descuento_librador = ((float) $descuento_librador_euro_documento_cesta / $total) * 100;
            $descuento_librador_documento_cesta = $descuento_librador;

            $base_total = 0;
            $irpf_librador = $irpf_documento_cesta;
            $total = 0;
            require("calcular_totales.php");
        }

        $dato_pp2 = $importe_descuento_pp;

        $log0 = $guardar_ficha;
        $log1 = "";
        $id_irpf = 0;
        if(!empty($irpf_documento_cesta)) {
            $result_irpf = $conn->query("SELECT id,activo FROM irpf WHERE irpf='" . $irpf_documento_cesta . "' LIMIT 1");
            if ($conn->registros() == 1) {
                $id_irpf = $result_irpf[0]['id'];
                if ($result_irpf[0]['activo'] == 0) {
                    $result_irpf = $conn->query("UPDATE irpf SET activo=1 WHERE id='" . $id_irpf . "' LIMIT 1");
                }
            } else {
                $result_irpf = $conn->query("INSERT INTO irpf VALUES(NULL,'" . $irpf_documento_cesta . "','1')");
                $id_irpf = $conn->id_insert();
            }
        }
        if($guardar_ficha == 1) {
            $result = $conn->query("UPDATE libradores SET 
                          id_irpf='" . $id_irpf . "',
                          descuento_pp='" . $descuento_pp_documento_cesta . "',
                          descuento_librador='" . $descuento_librador_documento_cesta . "' 
                          WHERE id='" . $id_librador . "' LIMIT 1");
        } else {
            $result = $conn->query("UPDATE libradores SET 
                          id_irpf='" . $id_irpf . "'
                          WHERE id='" . $id_librador . "' LIMIT 1");
        }
        $result = $conn->query("UPDATE libradores SET 
                          recargo='" . $recargo_documento_cesta . "' 
                          WHERE id='" . $id_librador . "' LIMIT 1");
        $log2 = "UPDATE documentos_" . $ejercicio . "_1 SET 
                              irpf='" . $irpf_documento_cesta . "',
                              importe_irpf='" . $importe_irpf . "',
                              descuento_pp='" . $descuento_pp_documento_cesta . "',
                              importe_descuento_pp='" . $importe_descuento_pp . "',
                              descuento_librador='" . $descuento_librador_documento_cesta . "',
                              importe_descuento_librador='" . $importe_descuento_librador . "',
                              base='" . $base_total . "',
                              total='" . $total . "' 
                              WHERE id='" . $id_documento . "' LIMIT 1";
        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET 
                              irpf='" . $irpf_documento_cesta . "',
                              importe_irpf='" . $importe_irpf . "',
                              descuento_pp='" . $descuento_pp_documento_cesta . "',
                              importe_descuento_pp='" . $importe_descuento_pp . "',
                              descuento_librador='" . $descuento_librador_documento_cesta . "',
                              importe_descuento_librador='" . $importe_descuento_librador . "',
                              base='" . $base_total . "',
                              total='" . $total . "' 
                              WHERE id='" . $id_documento . "' LIMIT 1");

        // Modificamos la estructura de recibos.
        if ($tipo_documento_seleccionar == 'tiq' || $tipo_documento_seleccionar == 'fac') {
            $result_modalidades_pago_lineas = $conn->query("SELECT dias,porcentaje FROM modalidades_pago_lineas WHERE id_forma_pago='".$id_modalidad_pago."' ORDER BY dias");
            foreach ($result_modalidades_pago_lineas as $key_modalidades_pago_lineas => $valor_modalidades_pago_lineas) {
                $suma_importe_recibos = $total / 100 * $valor_modalidades_pago_lineas['porcentaje'];
                $importe_recibos[] = number_format($suma_importe_recibos, 2, ".", "");
                $fecha_recibo = date("d-m-Y",strtotime($fecha_documento."+ " . $valor_modalidades_pago_lineas['dias'] . " days"));
                $dias_recibos[]= DateTime::createFromFormat('d-m-Y', $fecha_recibo)->format('Y-m-d');
            }
            if(isset($importe_recibos) && count($importe_recibos) > 1) {
                // INICIO Cuadramos los importes
                $suma_importe_recibos = 0;
                foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                    $suma_importe_recibos += $valor_importe_recibos;
                }
                $diferencia_importe_recibos = $total - $suma_importe_recibos;
                if (!empty($diferencia_importe_recibos)) {
                    $importe_recibos[0] = $importe_recibos[0] + $diferencia_importe_recibos;
                }
                // FINAL Cuadramos los importes
            }
            $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_recibos WHERE id_documento = '" . $id_documento . "'");
            $numero_efecto = 0;
            foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                $numero_efecto += 1;
                $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(
                NULL,
                '" . $id_documento . "',
                '" . addslashes($tipo_documento_seleccionar) . "',
                '" . $id_librador . "',
                '" . $valor_importe_recibos . "',
                '" . $fecha_documento . "',
                '" . $dias_recibos[$key_importe_recibos] . "',
                '0',
                '',
                '',
                '0',
                '0',
                '" . $id_modalidad_pago . "',
                '" . $numero_efecto . "',
                '0',
                '0',
                '',
                NULL,
                '')");
            }
            unset($importe_recibos);
            unset($dias_recibos);
        }
        // FIN Modificamos la estructura de recibos.


        if (isset($ajax)) {
            echo json_encode([
                'logs0' => $log0,
                'logs1' => $log1,
                'logs2' => $log2,
                'datos' => $datos,
                'datopp0' => $dato_pp2,
                'datopp1' => $importe_descuento_pp
            ]);
        }
        break;
    case "dividir-cobro":

        $datos = "Total fraccionar: ".$total_fraccionar;

        // Modificamos la estructura de recibos.
        if(!empty($fracciones)) {
            $porcentaje_fracciones = 100 / $fracciones;
            for ($bucle_fracciones = 0; $bucle_fracciones < $fracciones; $bucle_fracciones++) {
                $suma_importe_recibos = $total_fraccionar / 100 * $porcentaje_fracciones;
                $importe_recibos[] = number_format($suma_importe_recibos, 2, ".", "");
            }
            if (isset($importe_recibos) && count($importe_recibos) > 1) {
                // INICIO Cuadramos los importes
                $suma_importe_recibos = 0;
                foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
                    $suma_importe_recibos += $valor_importe_recibos;
                }
                $diferencia_importe_recibos = $total_fraccionar - $suma_importe_recibos;
                if (!empty($diferencia_importe_recibos)) {
                    $importe_recibos[0] = $importe_recibos[0] + $diferencia_importe_recibos;
                }
                // FINAL Cuadramos los importes
            }
        }else {
            $importe_recibos[] = $total_fraccionar;
        }
        $result = $conn->query("DELETE FROM documentos_" . $ejercicio . "_recibos WHERE id_documento = '" . $id_documento . "'");
        $numero_efecto = 0;
        foreach ($importe_recibos as $key_importe_recibos => $valor_importe_recibos) {
            $numero_efecto += 1;
            $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(
            NULL,
            '" . $id_documento . "',
            '" . addslashes($tipo_documento_seleccionar) . "',
            '" . $id_librador . "',
            '" . $valor_importe_recibos . "',
            '" . $fecha_documento . "',
            '" . date("Y-m-d") . "',
            '0',
            '',
            '',
            '0',
            '0',
            '" . $id_modalidad_pago . "',
            '" . $numero_efecto . "',
            '0',
            '0',
            '',
            NULL,
            '')");
        }
        unset($importe_recibos);
        // FIN Modificamos la estructura de recibos.


        if (isset($ajax)) {
            echo json_encode([
                'datos' => $datos
            ]);
        }
        break;
    case "guardar-nota-documento":
        /*
        CREATE TABLE `documentos_2022_observaciones` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_documentos_1` INT(11) NOT NULL,
            `id_documentos_2` INT(11) NOT NULL,
            `id_documentos_combo` INT(11) NOT NULL,
            `observacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
        */
        $result = $conn->query("SELECT id FROM documentos_" . $ejercicio . "_observaciones WHERE id_documentos_1 = '" . $id_documento . "' AND 
                                            id_documentos_2=0 AND id_documentos_combo=0 LIMIT 1");
        if($conn->registros() == 1) {
            $result = $conn->query("UPDATE documentos_" . $ejercicio . "_observaciones SET 
            observacion='" . addslashes($nota_documento_cesta) . "' WHERE id=".$result[0]['id']." LIMIT 1");
        }else {
            $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_observaciones VALUES(
                NULL,
                '" . $id_documento . "',
                '0',
                '0',
                '" . addslashes($nota_documento_cesta) . "')");
        }

        if (isset($ajax)) {
            echo json_encode([
                'logs' => $datos
            ]);
        }
        break;
    case "buscar-librador-del":
        $id_librador = 0;
        $result = $conn->query("SELECT id,nombre,direccion,numero,escalera,piso,puerta,localidad,codigo_postal 
                                FROM libradores WHERE mobil = '" . $mobil_envio_documento . "' AND tipo='del' LIMIT 1");
        if($conn->registros() == 1) {
            $id_librador = $result[0]['id'];
            $nombre_del[] = stripslashes($result[0]['nombre']);
            $direccion_del[] = stripslashes($result[0]['direccion']);
            $numero_del[] = stripslashes($result[0]['numero']);
            $escalera_del[] = stripslashes($result[0]['escalera']);
            $piso_del[] = stripslashes($result[0]['piso']);
            $puerta_del[] = stripslashes($result[0]['puerta']);
            $localidad_del[] = stripslashes($result[0]['localidad']);
            $codigo_postal_del[] = stripslashes($result[0]['codigo_postal']);

            $result = $conn->query("SELECT id,nombre,direccion,numero,escalera,piso,puerta,localidad,codigo_postal 
                                FROM documentos_".$ejercicio."_libradores_envio WHERE id_librador = '" . $result[0]['id'] . "' 
                                GROUP BY nombre,direccion,numero,escalera,piso,puerta,localidad,codigo_postal");
            foreach ($result as $key => $valor) {

                if($nombre_del[0] != stripslashes($valor['nombre']) || $direccion_del[0] != stripslashes($valor['direccion']) ||
                    $numero_del[0] != stripslashes($valor['numero']) || $escalera_del[0] != stripslashes($valor['escalera']) ||
                    $piso_del[0] != stripslashes($valor['piso']) || $puerta_del[0] != stripslashes($valor['puerta']) ||
                    $localidad_del[0] != stripslashes($valor['localidad']) || $codigo_postal_del[0] != stripslashes($valor['codigo_postal']))
                {
                    $nombre_del[] = stripslashes($valor['nombre']);
                    $direccion_del[] = stripslashes($valor['direccion']);
                    $numero_del[] = stripslashes($valor['numero']);
                    $escalera_del[] = stripslashes($valor['escalera']);
                    $piso_del[] = stripslashes($valor['piso']);
                    $puerta_del[] = stripslashes($valor['puerta']);
                    $localidad_del[] = stripslashes($valor['localidad']);
                    $codigo_postal_del[] = stripslashes($valor['codigo_postal']);
                }
            }
        }

        if (isset($ajax)) {
            echo json_encode([
                'id_librador' => $id_librador,
                'nombre_del' => $nombre_del,
                'direccion_del' => $direccion_del,
                'numero_del' => $numero_del,
                'escalera_del' => $escalera_del,
                'piso_del' => $piso_del,
                'puerta_del' => $puerta_del,
                'localidad_del' => $localidad_del,
                'codigo_postal_del' => $codigo_postal_del
            ]);
        }
        break;
    case "guardar-datos-del":
        $log = "(".$id_panel.")";
        if($id_librador == -1) {
            $log .= "INSERT libradores";
            $result = $conn->query("INSERT INTO libradores VALUES(
                          NULL,
                          '',
                          '" . addslashes($tipo_librador) . "',
                          '',
                          '" . addslashes($nombre_documento) . "',
                          '',
                          '',
                          '" . addslashes($mobil_documento) . "',
                          '',
                          '',
                          '" . addslashes($direccion_documento) . "',
                          '" . addslashes($numero_direccion_documento) . "',
                          '" . addslashes($escalera_direccion_documento) . "',
                          '" . addslashes($piso_direccion_documento) . "',
                          '" . addslashes($puerta_direccion_documento) . "',
                          '" . addslashes($localidad_documento) . "',
                          '" . addslashes($codigo_postal_documento) . "',
                          '',
                          '0',
                          '',
                          '',
                          '',
                          '" . addslashes($mobil_documento) . "',
                          '',
                          '',
                          '0',
                          '0',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '0',
                          'null',
                          '',
                          '0',
                          '0',
                          '0',
                          '0',
                          '-1',
                          '0',
                          '0',
                          '0',
                          '0',
                          '0.00',
                          '0.00',
                          '1',
                          '1',
                          '',
                          '0',
                          '0',
                          '0',
                          '1', 
                          '1', 
                          '',
                          '',
                          '0',
                          '0',
                          '0',
                          '0',
                          '0',
                          '0',
                          '0',
                          '" . date('Y-m-d H:i:s') . "',
                          '" . date('Y-m-d H:i:s') . "')");
            $id_librador = $conn->id_insert();

        }else {
            $log .= "-UPDATE libradores";
            $result = $conn->query("UPDATE libradores SET  
                            tipo='" . addslashes($tipo_librador) . "',
                            nombre='" . addslashes($nombre_documento) . "',
                            razon_social='" . addslashes($mobil_documento) . "',
                            direccion='" . addslashes($direccion_documento) . "',
                            numero='" . addslashes($numero_direccion_documento) . "',
                            escalera='" . addslashes($escalera_direccion_documento) . "',
                            piso='" . addslashes($piso_direccion_documento) . "',
                            puerta='" . addslashes($puerta_direccion_documento) . "',
                            localidad='" . addslashes($localidad_documento) . "',
                            codigo_postal='" . addslashes($codigo_postal_documento) . "',
                            mobil='" . addslashes($mobil_documento) . "',
                            fecha_modificacion='" . date("Y-m-d") . "' 
                          WHERE id='" . $id_librador . "' LIMIT 1");
        }

        $sqlToUpdate1 = "SELECT * FROM libradores WHERE id='" . $id_librador . "' LIMIT 1";

        $id_sesion = $id_sesion_sys;
        $ip = $ip_sys;
        $so = $so_sys;

        $numero_documento = "";

        $result = $conn->query("SELECT * FROM libradores WHERE id='" . $id_librador . "' LIMIT 1");

        $base_total = 0;
        $total = 0;
        $id_modalidad_pago = $result[0]['id_modalidades_pago'];
        $fecha_documento = date("Y-m-d");
        $id_documento_1 = 0;
        $tipo_documento = $tipo_documento_seleccionar;
        $interface = "tpv";
        $fecha_entrega_desde = "";
        $fecha_entrega_hasta = "";

        $result_pago = $conn->query("SELECT descripcion FROM modalidades_pago WHERE id='" . $result[0]['id_modalidades_pago'] . "' LIMIT 1");
        $result_envio = $conn->query("SELECT descripcion FROM modalidades_envio WHERE id='" . $result[0]['id_modalidades_envio'] . "' LIMIT 1");
        $result_entrega = $conn->query("SELECT descripcion FROM modalidades_entrega WHERE id='" . $result[0]['id_modalidades_entrega'] . "' LIMIT 1");
        $modalidad_pago = $result_pago[0]['descripcion'];
        $modalidad_envio = $result_envio[0]['descripcion'];
        $modalidad_entrega = $result_entrega[0]['descripcion'];

        if (!empty($result[0]['id_irpf'])) {
            $result_irpf = $conn->query("SELECT irpf FROM irpf WHERE id='" . $result[0]['id_irpf'] . "' LIMIT 1");
            $irpf_librador = $result_irpf[0]['irpf'];
        } else {
            $irpf_librador = 0;
        }
        $importe_irpf = 0;
        $descuento_pp = $result[0]['descuento_pp'];
        $importe_descuento_pp = 0;
        $descuento_librador = $result[0]['descuento_librador'];
        $importe_descuento_librador = 0;

        $estado = 0;
        $entregado = 0;
        /* $id_usuario = ??? */
        if (!isset($id_usuario)) {
            $id_usuario = 0;
        }
        /* $id_terminal = ??? */
        if (!isset($id_terminal)) {
            $id_terminal = 0;
        }

        $codigo_librador_documento = $result[0]['codigo_librador'];
        $nombre_documento = $result[0]['nombre'];
        $apellido_1_documento = $result[0]['apellido_1'];
        $apellido_2_documento = $result[0]['apellido_2'];
        $razon_social_documento = $result[0]['razon_social'];
        $razon_comercial_documento = $result[0]['razon_comercial'];
        $nif_documento = $result[0]['nif'];
        $direccion_documento = $result[0]['direccion'];
        $numero_direccion_documento = $result[0]['numero'];
        $escalera_direccion_documento = $result[0]['escalera'];
        $piso_direccion_documento = $result[0]['piso'];
        $puerta_direccion_documento = $result[0]['puerta'];
        $localidad_documento = $result[0]['localidad'];
        $codigo_postal_documento = $result[0]['codigo_postal'];
        $provincia_documento = $result[0]['provincia'];
        $telefono_1_documento = $result[0]['telefono_1'];
        $telefono_2_documento = $result[0]['telefono_2'];
        $fax_documento = $result[0]['fax'];
        $mobil_documento = $result[0]['mobil'];
        $email_documento = $result[0]['email'];
        $persona_contacto_documento = $result[0]['persona_contacto'];
        $result_zona = $conn->query("SELECT zona FROM zonas WHERE id='" . $result[0]['id_zona'] . "' LIMIT 1");
        $zona = $result_zona[0]['descripcion'];
        $observaciones_envio_documento = "";

        $insert_inicial = true;
        require("guardar_documento_1.php");
        require("guardar_documento_libradores.php");
        require("guardar_documento_libradores_envio.php");

        if (!empty($total_documento)) {
            $descuento_librador_euro = (0 + ($descuento_librador / 100)) * $total_documento;
        } else {
            $descuento_librador_euro = 0;
        }

        $result_libradores = $conn->query("DELETE FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' LIMIT 1");
        $querySql = "INSERT INTO identificacion_accesos 
            VALUES(NULL,".$id_librador.",'".$tipo_librador."','".$tipo_documento_seleccionar."','".$id_sesion_sys."','".$ip_sys."')";
        $result_identificacion_accesos = $conn->query($querySql);

        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_1 SET 
                              fecha_entrega_desde='" . $fecha_entrega_documento . "',
                              fecha_entrega_hasta='" . $fecha_entrega_documento . "',
                              hora_entrega='" . $hora_entrega_documento . "' 
                              WHERE id='" . $id_documento_1 . "' LIMIT 1");
        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_2 SET 
                              fecha_entrega_desde='" . $fecha_entrega_documento . "',
                              fecha_entrega_hasta='" . $fecha_entrega_documento . "' 
                              WHERE id_documentos_1='" . $id_documento_1 . "'");
        $result = $conn->query("UPDATE documentos_" . $ejercicio . "_libradores_envio SET 
                              fecha_envio='" . addslashes($fecha_entrega_documento) . "',
                              fecha_entrega='" . addslashes($fecha_entrega_documento) . "'
                              WHERE id_documentos_1='" . $id_documento_1 . "' LIMIT 1");

        if (isset($ajax)) {
            echo json_encode([
                'id_documento_1' => $id_documento_1,
                'logs' => $log
            ]);
        }
        break;
}
unset($conn);