<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$omitir = $_POST['omitir'];
$configStep = $_POST['config-step'];

if($configStep == "1") {
    $configStep1NombreFiscal = $_POST['config-step1-nombre-fiscal'];
    $configStep1Telefono = $_POST['config-step1-telefono'];
    $configStep1NombreComercial = $_POST['config-step1-nombre-comercial'];
    $configStep1Cif = $_POST['config-step1-cif'];
    $configStep1Provincia = $_POST['config-step1-provincia'];
    $configStep1CP = $_POST['config-step1-cp'];
    $configStep1Poblacion = $_POST['config-step1-poblacion'];
    $configStep1Direccion = $_POST['config-step1-direccion'];
} else if ($configStep == "2") {
    $id_idioma_usuarios = filter_input(INPUT_POST, 'id_idioma_usuarios', FILTER_SANITIZE_NUMBER_INT);
    if (empty($id_idioma_usuarios)) {
        $id_idioma_usuarios = 4;
    }
    $usuario_usuarios = filter_input(INPUT_POST, 'usuario_usuarios', FILTER_SANITIZE_STRING);
    $password_usuarios = filter_input(INPUT_POST, 'password_usuarios', FILTER_SANITIZE_STRING);
    $permisos_usuarios = filter_input(INPUT_POST, 'permisos_usuarios', FILTER_SANITIZE_STRING);
    $id_terminal_usuarios = filter_input(INPUT_POST, 'id_terminal_usuarios', FILTER_SANITIZE_NUMBER_INT);
    $id_empresa_usuarios = filter_input(INPUT_POST, 'id_empresa_usuarios', FILTER_SANITIZE_NUMBER_INT);
    if (empty($id_empresa_usuarios)) {
        $id_empresa_usuarios = -1;
    }
    $id_comercial_usuarios = filter_input(INPUT_POST, 'id_comercial_usuarios', FILTER_SANITIZE_NUMBER_INT);
    $bloqueo_usuarios = filter_input(INPUT_POST, 'activo_usuarios', FILTER_SANITIZE_NUMBER_INT);
    $dark_usuarios = filter_input(INPUT_POST, 'dark_usuarios', FILTER_SANITIZE_NUMBER_INT);
    $avatar_usuarios = filter_input(INPUT_POST, 'avatar_usuarios', FILTER_SANITIZE_NUMBER_INT);
} else if ($configStep == "3") {
    $configStep3Espacios = $_POST['config-step3-espacios'];
    $configStep3Tarifas = $_POST['config-step3-tarifas'];
} else if ($configStep == "4") {
    $configStep4IVA = $_POST['config-step4-iva'];
    $configStep4MetodosPago = $_POST['config-step4-metodos-pago'];
} else {
    echo json_encode('Paso no admitido.');
    exit();
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/datos-identificacion.php");

if (!isset($acceso_correcto_sys) || $acceso_correcto_sys !== 1) {
    echo json_encode('ko');
    exit();
}

$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$pasarAlSiguientePaso = true;
if((!$omitir || $omitir == "0" || $omitir == "false") && $configStep == "1") {
    $result_datos_empresa = $conn->query("UPDATE datos_empresa SET 
        nombre_fiscal='" . stripslashes($configStep1NombreFiscal) . "',
        tel1='" . stripslashes($configStep1Telefono) . "',
        nombre_comercial='" . stripslashes($configStep1NombreComercial) . "',
        nif='" . stripslashes($configStep1Cif) . "',
        provincia='" . stripslashes($configStep1Provincia) . "',
        codigo_postal='" . stripslashes($configStep1CP) . "',
        poblacion='" . stripslashes($configStep1Poblacion) . "',
        direccion='" . stripslashes($configStep1Direccion) . "' 
        WHERE id=1 LIMIT 1");
} else if((!$omitir || $omitir == "0" || $omitir == "false") && $configStep == "2") {
    if ($usuario_usuarios) {
        if (empty($password_usuarios)) {
            $password_usuarios = '1234';
        }

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

        $pasarAlSiguientePaso = false;
    }
} else if((!$omitir || $omitir == "0" || $omitir == "false") && $configStep == "3") {
    $configStep3Espacios = explode(',', $configStep3Espacios);
    foreach ($configStep3Espacios as $keyConfigStep3Espacio => $configStep3Espacio) {
        $configStep3Espacio = trim($configStep3Espacio);

        $principal = '0';
        if ($keyConfigStep3Espacio === 0) {
            $principal = '1';
        }
        $result = $conn->query("INSERT INTO comedores VALUES(
            NULL,
            '" . addslashes($configStep3Espacio) . "',
            '" . addslashes($principal) . "',
            '1',
            '',
            '" . date("Y-m-d") . "',
            '" . date("Y-m-d") . "')");

        $id_comedor = $conn->id_insert();

        $result = $conn->query("INSERT INTO libradores VALUES(
                          NULL,
                          '',
                          'mes',
                          '',
                          '" . $id_comedor . "-1',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '1',
                          '',
                          '-1',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '',
                          '1',
                          '2',
                          '',
                          '',
                          '',
                          '',
                          1, 
                          0, 
                          '', 
                          '',
                          '', 
                          '" . $id_comedor . "',
                          '', 
                          '100', 
                          '100', 
                          '133', 
                          '143',
                          '" . date('Y-m-d') . "',
                          '" . date('Y-m-d') . "')");
        $id_libradores = $conn->id_insert();
        if (empty($codigo_librador_libradores)) {
            $result = $conn->query("UPDATE libradores SET
                            codigo_librador='" . $id_libradores . "'
                            WHERE id=" . $id_libradores . " AND tipo = 'mes' LIMIT 1");
        }
    }

    $configStep3Tarifas = explode(',', $configStep3Tarifas);
    foreach ($configStep3Tarifas as $keyConfigStep3Tarifa => $configStep3Tarifa) {
        $configStep3Tarifa = trim($configStep3Tarifa);

        if($keyConfigStep3Tarifa === 0) {
            $result_tarifas = $conn->query("UPDATE tarifas SET 
                descripcion='" . addslashes($configStep3Tarifa) . "' 
                WHERE id=2 LIMIT 1");
        } else if($keyConfigStep3Tarifa === 1) {
            $result_tarifas = $conn->query("UPDATE tarifas SET 
                descripcion='" . addslashes($configStep3Tarifa) . "' 
                WHERE id=1 LIMIT 1");
        }else {
            $result_tarifas = $conn->query("INSERT INTO tarifas VALUES(
                NULL,
                4,
                '" . addslashes($configStep3Tarifa) . "',
                0,
                1,
                '" . ($keyConfigStep3Tarifa + 1) . "')");
        }
    }
} else if((!$omitir || $omitir == "0" || $omitir == "false") && $configStep == "4") {
    $result_datos_empresa = $conn->query("UPDATE datos_empresa SET 
                iva_incluido=" . ((empty($configStep4IVA))? '0' : '1') . " 
                WHERE id=1 LIMIT 1");
    $result_configuracion = $conn->query("UPDATE configuracion SET 
                pvp_iva_incluido=" . ((empty($configStep4IVA))? '0' : '1') . " 
                WHERE id=1 LIMIT 1");

    $configStep4MetodosPago = explode(',', $configStep4MetodosPago);
    foreach ($configStep4MetodosPago as $keyConfigStep4MetodoPago => $configStep4MetodoPago) {
        $configStep4MetodoPago = trim($configStep4MetodoPago);

        if (!empty($configStep4MetodoPago)) {
            if($keyConfigStep4MetodoPago === 0) {
                $result_metodos_pago = $conn->query("UPDATE metodos_pago SET 
                descripcion='" . addslashes($configStep4MetodoPago) . "' 
                WHERE id=1 LIMIT 1");
            } else if($keyConfigStep4MetodoPago === 1) {
                $result_metodos_pago = $conn->query("UPDATE metodos_pago SET 
                descripcion='" . addslashes($configStep4MetodoPago) . "' 
                WHERE id=2 LIMIT 1");
            }else {
                $result_metodos_pago = $conn->query("INSERT INTO `metodos_pago` VALUES (NULL, '" . addslashes($configStep4MetodoPago) . "', '', 'tpv', 0, 0, 0.00, 0.00, '', '', NULL, NULL, " . ($keyConfigStep4MetodoPago + 1) . ", 0, 1);");
            }
        }
    }
}

if($configStep == "1") {
    $fechaInicioPlan = new DateTime();
    $fechaInicioPlan->modify('+15 days');
    $result_datos_empresa = $conn->query("UPDATE datos_empresa SET 
        fecha_inicio_plan='" . $fechaInicioPlan->format('Y-m-d H:i:s') . "' 
        WHERE id=1 LIMIT 1");
}

if ($pasarAlSiguientePaso) {
    $result_datos_configuracion_inicial = $conn->query("UPDATE datos_configuracion_inicial SET 
        step" . $configStep . "=1 
        WHERE id=1 LIMIT 1");
}

echo json_encode('ok');