<?php
header('Content-Type: application/json');
session_start();

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

if (isset($_POST['id_documento_1'])) {
    require('documento_guardar_post.php');

    if($interface == "tpv") {
        $conn = new db(0);
        $conn->query("SET NAMES 'utf8'");
        $result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
        if ($conn->registros() == 1) {
            $id_panel = $result[0]['id_panel'];
        } else {
            throw new Exception("Acceso no permitido.");
        }
        unset($conn);
    } else {
        throw new Exception('No está habilitada la entrada de documentos fuera de la TPV.');
    }

    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");

    $result_configuracion = $conn->query("SELECT pvp_iva_incluido FROM configuracion");
    $pvp_iva_incluido = 0;
    if ($conn->registros() >= 1) {
        $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
    }

    $modalidad_pago = "";
    $modalidad_envio = "";
    $modalidad_entrega = "";
    $result = $conn->query("SELECT descripcion FROM modalidades_pago WHERE id='".$id_modalidad_pago."' LIMIT 1");
    if($conn->registros() == 1) {
        $modalidad_pago = stripslashes($result[0]['descripcion']);
    }
    $result = $conn->query("SELECT descripcion FROM modalidades_envio WHERE id='".$id_modalidad_envio."' LIMIT 1");
    if($conn->registros() == 1) {
        $modalidad_envio = stripslashes($result[0]['descripcion']);
    }
    $result = $conn->query("SELECT descripcion FROM modalidades_entrega WHERE id='".$id_modalidad_entrega."' LIMIT 1");
    if($conn->registros() == 1) {
        $modalidad_entrega = stripslashes($result[0]['descripcion']);
    }
    if (empty($id_terminal)) {
        $result_usuarios = $conn->query("SELECT id,terminal FROM usuarios WHERE id=" . $id_usuario . " LIMIT 1");
        if ($conn->registros() == 1) {
            if ($result_usuarios[0]['terminal'] == -1) {
                $result = $conn->query("SELECT id FROM terminales WHERE activo=1 ORDER BY id ASC LIMIT 1");
                if ($conn->registros() == 1) {
                    $id_terminal = $result[0]['id'];
                }
            } else {
                $id_terminal = $result_usuarios[0]['terminal'];
            }
        } else {
            $result = $conn->query("SELECT id FROM terminales WHERE activo=1 ORDER BY id ASC LIMIT 1");
            if($conn->registros() == 1) {
                $id_terminal = $result[0]['id'];
            }
        }
    }
}else{
    $tienda = $_POST['tienda'];
    if (empty($tienda)) {
        throw new Exception('No se ha indicado la tienda.');
    }

    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");

    $result = $conn->query("SELECT id,sector FROM identificacion_panel WHERE web_blendi='" . addslashes($tienda) . "' LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id'];
        $sector = $result[0]['sector'];
    } else {
        throw new Exception('Negocio no encontrado.');
    }
    unset($conn);

    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");

    require('documento_guardar_producto.php');

    $id_modalidad_pago = "";
    $id_modalidad_envio = "";
    $id_modalidad_entrega = "";
    $result = $conn->query("SELECT id FROM modalidades_pago WHERE descripcion='".$modalidad_pago."' LIMIT 1");
    if($conn->registros() == 1) {
        $id_modalidad_pago = stripslashes($result[0]['id']);
    }
    $result = $conn->query("SELECT id FROM modalidades_envio WHERE descripcion='".$modalidad_envio."' LIMIT 1");
    if($conn->registros() == 1) {
        $id_modalidad_envio = stripslashes($result[0]['id']);
    }
    $result = $conn->query("SELECT id FROM modalidades_entrega WHERE descripcion='".$modalidad_entrega."' LIMIT 1");
    if($conn->registros() == 1) {
        $id_modalidad_entrega = stripslashes($result[0]['id']);
    }
}

$logs = new stdClass();

if(($tipo_documento == 'fac' || $tipo_documento == 'tiq') && empty($id_documento_1) && $tipo_librador != 'pro' && $tipo_librador != 'cre') {
    $query = "SELECT fecha_documento FROM documentos_".$ejercicio."_1 WHERE 
                    tipo_documento='" . $tipo_documento . "' AND tipo_librador<>'pro' AND tipo_librador<>'cre' 
                    ORDER BY numero_documento DESC LIMIT 1";
    $result_documentos = $conn->query($query);

    if ($conn->registros() == 1) {
        if($fecha_documento < $result_documentos[0]['fecha_documento']) {
            $fecha_documento = $result_documentos[0]['fecha_documento'];
        }
    }
}

if(isset($_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'])) {
    if($_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'] != 0) {
        $select_sys = "descripcion-relacionado-grupos";
        require ('datos-productos.php');
    }
}

$encuentra_producto_en_documento = false;
if($accion == "insertar-producto" && empty($id_linea) && !empty($id_documento_1) && ($tipo_producto == 0 || $tipo_producto == 1)) {
    // Buscamos si el producto existe en el documento para incrementar su cantidad
    $result = $conn->query("SELECT id,cantidad,coste,importe,fijo,pvp_unidad FROM documentos_".$ejercicio."_2 
        WHERE 
        id_documentos_1='".$id_documento_1."' AND 
        id_producto='".$id_producto."' AND 
        id_productos_detalles_enlazado='".$id_enlazado."' AND 
        id_productos_detalles_multiples='".$id_multiple."' AND 
        id_packs='".$id_pack."' AND 
        id_productos_relacionados_grupos='".$id_productos_relacionados_grupos."' AND 
        detalles_producto='".addslashes($detalles_producto)."' AND 
        descripcion_oferta='".addslashes($descripcion_oferta)."' AND 
        numero_serie='".addslashes($numero_serie_producto)."' AND 
        lote='".addslashes($lote_producto)."' AND 
        caducidad='".$caducidad_producto."' AND 
        id_unidades='".$id_unidades."' AND 
        descuento_base='".$descuento_base."' AND 
        orden='".$orden."' AND 
        pvp_unidad='".$pvp_unidad."' AND 
        id_documento_2_anterior=0 AND 
        estado=0 
        LIMIT 1");
    if($conn->registros() == 1) {
        $result_observaciones = $conn->query("SELECT id,observacion FROM documentos_".$ejercicio."_observaciones 
        WHERE 
        id_documentos_1='".$id_documento_1."' AND 
        id_documentos_2='".$result[0]['id']."'  
        LIMIT 1");
        $sustituirLinea = true;
        if($conn->registros() == 1) {
            $sustituirLinea = false;
            if ($result_observaciones[0]['observacion'] == $observacion) {
                $sustituirLinea = true;
            }
        }
        if ($sustituirLinea) {
            $encuentra_producto_en_documento = true;
            $id_linea = $result[0]['id'];
            $cantidad = $cantidad + $result[0]['cantidad'];
            $pvp_unidad = $result[0]['pvp_unidad'];
        }
    }
}

if(($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") && !empty($lote_producto) && $cantidad > $cantidad_lote_producto) {
    if (empty($id_linea)) {
        $cantidad = $cantidad_lote_producto;
    } else {
        $result = $conn->query("SELECT cantidad FROM documentos_".$ejercicio."_2 WHERE id='".$id_linea."' LIMIT 1");
        if($conn->registros() == 1) {
            $cantidad_anterior = $result[0]['cantidad'];
            if ($cantidad > $cantidad_anterior + $cantidad_lote_producto) {
                $cantidad = $cantidad_anterior + $cantidad_lote_producto;
            }
        }
    }
}

if(!empty($id_unidades)) {
    $result = $conn->query("SELECT abreviatura FROM unidades WHERE id = " . $id_unidades . " LIMIT 1");
    if ($conn->registros() == 1) {
        $unidad_producto = stripslashes($result[0]['abreviatura']);
    }
}

function registroStock($datos, $decimales_cantidades, $decimales_importes, $id_producto_padre, $productos_anadidos, $recorrerRelacionados = false) {
    if (in_array($id_producto_padre . '-' . $datos['id_producto'], $productos_anadidos)) {
        return;
    }

    $productos_anadidos[] = $id_producto_padre . '-' . $datos['id_producto'];
    $id_producto_padre = $datos['id_producto'];

    $datos['id_productos_sku'] = (isset($datos['id_productos_sku']))? $datos['id_productos_sku'] : 0;
    $datos['lote_producto'] = (isset($datos['lote_producto']))? $datos['lote_producto'] : '';
    $datos['caducidad_producto'] = (isset($datos['caducidad_producto']))? $datos['caducidad_producto'] : '';
    $datos['numero_serie_producto'] = (isset($datos['numero_serie_producto']))? $datos['numero_serie_producto'] : '';
    $datos['sumar'] = (!isset($datos['sumar']))? 1 : $datos['sumar'];
    if(empty($datos['coste_producto_linea'])) {
        $result = $datos['conn']->query("SELECT coste FROM productos WHERE id = " . $datos['id_producto'] . " LIMIT 1");
        if ($datos['conn']->registros() == 1) {
            //$datos['coste_producto_linea'] = number_format(($result[0]['coste'] * $datos['cantidad']),$decimales_importes, ".", "");
            /* $datos['coste_producto_linea'] = number_format($result[0]['coste'],$decimales_importes, ".", ""); */
            $datos['coste_producto_linea'] = $result[0]['coste'];
        }
    }
    $datos['id_unidades'] = (isset($datos['id_unidades']))? $datos['id_unidades'] : 0;
    if(!empty($datos['id_unidades'])) {
        $result = $datos['conn']->query("SELECT abreviatura FROM unidades WHERE id = " . $datos['id_unidades'] . " LIMIT 1");
        if ($datos['conn']->registros() == 1) {
            $datos['unidad_producto'] = stripslashes($result[0]['abreviatura']);
        }
    }else {
        $datos['unidad_producto'] = (isset($datos['unidad_producto'])) ? $datos['unidad_producto'] : '';
    }
    if ($datos['sumar']) {
        $datos['importe'] = (isset($datos['importe']))? $datos['importe'] : 0;
    } else {
        $datos['importe'] = 0;
    }

    $result = $datos['conn']->query("INSERT INTO documentos_".$datos['ejercicio']."_productos_sku_stock VALUES(
       NULL,
       '".$datos['id_producto']."',
       '".$datos['id_productos_sku']."',
       '".$datos['lote_producto']."',
       '".$datos['caducidad_producto']."',
       '".$datos['numero_serie_producto']."',
       '".((isset($datos['codigo_barras']))? $datos['codigo_barras'] : '')."',
       '".$datos['tipo_documento']."',
       '".date("Y-m-d")."',
       '".$datos['id_documento_1']."',
       '".$datos['id_documento_2']."',
       '".$datos['tipo_librador']."',
       '".$datos['id_librador']."',
       '".number_format($datos['coste_producto_linea'], $decimales_importes, ".", "")."',
       '".number_format($datos['cantidad'], $decimales_cantidades, ".", "")."',
       '".$datos['id_unidades']."',
       '".$datos['unidad_producto']."',
       '".number_format($datos['importe'], $decimales_importes, ".", "")."',
       '".date("Y-m-d")."',
       '".date("Y-m-d")."')");

    $id_productos_sku_stock_insert = $datos['conn']->id_insert();
    if (!isset($datos['codigo_barras'])) {
        $codigo_barras = $id_productos_sku_stock_insert;
        if(strlen($codigo_barras) < 10) {
            $codigo_barras = str_repeat("0", 11 - strlen($codigo_barras)) . $codigo_barras;
        }
        $result_update_sku_stock = $datos['conn']->query("UPDATE documentos_".$datos['ejercicio']."_productos_sku_stock SET codigo_barras='" . addslashes($codigo_barras) . "' WHERE id=" . $id_productos_sku_stock_insert . " LIMIT 1");
    }

    if ($recorrerRelacionados) {
        $productos_encontrados = [];
        $result = $datos['conn']->query("SELECT * FROM productos_relacionados WHERE id_producto = " . $datos['id_producto']);
        if($datos['conn']->registros() >= 1) {
            $productos_encontrados = $result;
        }
        $result = $datos['conn']->query("SELECT * FROM productos_relacionados_elaborados WHERE id_producto = " . $datos['id_producto']);
        if($datos['conn']->registros() >= 1) {
            $productos_encontrados = $result;
        }
        if($productos_encontrados) {
            $cantidad_producto_padre = $datos['cantidad'];
            for ($i = 0; $i < count($productos_encontrados); $i++) {
                if (isset($productos_encontrados[$i]['modelo']) && $productos_encontrados[$i]['modelo'] == 3) {
                    continue;
                }
                if (isset($productos_encontrados[$i]['por_defecto']) && $productos_encontrados[$i]['por_defecto'] == 2) {
                    continue;
                }
                if (isset($productos_encontrados[$i]['modelo'])) {
                    switch ($productos_encontrados[$i]['modelo']) {
                        case '0':
                        case '2':
                            $cantidad_por_defecto = $productos_encontrados[$i]['cantidad_con'];
                            break;
                        case '1':
                            if($productos_encontrados[$i]['por_defecto'] == 0) {
                                $cantidad_por_defecto = $productos_encontrados[$i]['cantidad_con'];
                            } else if ($productos_encontrados[$i]['por_defecto'] == 1) {
                                $cantidad_por_defecto = $productos_encontrados[$i]['cantidad_mitad'];
                            } else {
                                $cantidad_por_defecto = $productos_encontrados[$i]['cantidad_doble'];
                            }
                            break;
                        default:
                            $cantidad_por_defecto = 1;
                            break;
                    }
                    $datos['id_producto'] = $productos_encontrados[$i]['id_relacionado'];
                } else {
                    $cantidad_por_defecto = $productos_encontrados[$i]['cantidad'];
                    $datos['id_producto'] = $productos_encontrados[$i]['id_producto_relacionado'];
                }

                // Los productos relacionados no tienen lotes ni números de serie
                // o en todo caso se debería buscar pues no será el mismo que el producto principal
                $datos['lote_producto'] = "";
                $datos['caducidad_producto'] = "0000-00-00";
                $datos['numero_serie_producto'] = "";
                // También reseteamos el coste
                $datos['coste_producto_linea'] = 0;
                // También reseteamos el código de barras
                unset($datos['codigo_barras']);

                $datos['id_productos_detalles_enlazado'] = $productos_encontrados[$i]['id_productos_detalles_enlazado'];
                $datos['id_productos_detalles_multiples'] = $productos_encontrados[$i]['id_productos_detalles_multiples'];
                $datos['id_packs'] = $productos_encontrados[$i]['id_packs'];
                $datos['cantidad'] = $cantidad_producto_padre * $cantidad_por_defecto;
                if(isset($productos_encontrados[$i]['id_unidad'])) {
                    $datos['id_unidades'] = $productos_encontrados[$i]['id_unidad'];
                }
                registroStock($datos, $decimales_cantidades, $decimales_importes, $id_producto_padre, $productos_anadidos, true);
            }
        }
    }
}

function eliminarRegistroStock($datos, $id_producto_padre, $productos_anadidos, $recorrerRelacionados = false) {
    if (in_array($id_producto_padre . '-' . $datos['id_producto'], $productos_anadidos)) {
        return;
    }

    $productos_anadidos[] = $id_producto_padre . '-' . $datos['id_producto'];
    $id_producto_padre = $datos['id_producto'];

    $result = $datos['conn']->query("DELETE FROM documentos_".$datos['ejercicio']."_productos_sku_stock WHERE 
       id_documento_1 = '".$datos['id_documento_1']."' AND 
       id_documento_2 = '".$datos['id_documento_2']."' AND 
       id_producto = '".$datos['id_producto']."' LIMIT 1");

    if ($recorrerRelacionados) {
        $productos_encontrados = [];
        $result = $datos['conn']->query("SELECT * FROM productos_relacionados WHERE id_producto = " . $datos['id_producto']);
        if($datos['conn']->registros() >= 1) {
            $productos_encontrados = $result;
        }
        $result = $datos['conn']->query("SELECT * FROM productos_relacionados_elaborados WHERE id_producto = " . $datos['id_producto']);
        if($datos['conn']->registros() >= 1) {
            $productos_encontrados = $result;
        }
        if($productos_encontrados) {
            for ($i = 0; $i < count($productos_encontrados); $i++) {
                if (isset($productos_encontrados[$i]['modelo']) && $productos_encontrados[$i]['modelo'] == 3) {
                    continue;
                }
                if (isset($productos_encontrados[$i]['por_defecto']) && $productos_encontrados[$i]['por_defecto'] == 2) {
                    continue;
                }
                if (isset($productos_encontrados[$i]['modelo'])) {
                    $datos['id_producto'] = $productos_encontrados[$i]['id_relacionado'];
                } else {
                    $datos['id_producto'] = $productos_encontrados[$i]['id_producto_relacionado'];
                }

                eliminarRegistroStock($datos, $id_producto_padre, $productos_anadidos, true);
            }
        }
    }
}

if(empty($tipo_documento)) {
    $tipo_documento = "ped";
}

function isDate($value)
{
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

if(!empty($descripcion_atributos_producto)) {
    $descripcion_producto .= " ".$descripcion_atributos_producto;
}

if(!isDate($caducidad)) {
    $caducidad = "";
}

$zona = "";
$result = $conn->query("SELECT zona FROM zonas WHERE id='".$id_zona_documento."' LIMIT 1");
if($conn->registros() == 1) {
    $zona = stripslashes($result[0]['zona']);
}


if (!empty($id_pack)) {
    $result = $conn->query("SELECT cantidad_pack FROM productos_packs WHERE id='".$id_pack."' LIMIT 1");
    if($conn->registros() == 1) {
        $coste_producto = $coste_producto * $result[0]['cantidad_pack'];
    }
}

$coste_producto_linea = $coste_producto;

$datos = "documento-guardar.php INICIO\n";

require 'calcular_totales_linea.php';

$base_total = 0;
$total = 0;

$logs->id_usuario_antes = "ID usuario antes: ".$id_usuario;

$id_documento_2_original = 0;
if ($id_linea && $tipo_producto != 3 && $tipo_producto != 4) {
    $accion = "eliminar-producto";
    $id_documento_2 = $id_linea;
    $id_documento_2_original = $id_linea;
    require ('guardar_documento_2.php');
    if (!isset($_POST['line_clean'])){
        $accion = "insertar-producto";
        $id_documento_2 = null;
    }
}
if ($id_linea && ($tipo_producto == 3 || $tipo_producto == 4)) {
    $id_documento_2 = $id_linea;
    $id_documento_2_original = $id_linea;
    $accion = "modificar-producto";
}
$insert_inicial = false;
if(empty($id_documento_1)) {
    $insert_inicial = true;
}
if($accion == "insertar-producto" && empty($id_documento_1)) {
    require("datos-modalidades.php");
    require("guardar_documento_1.php");
}
if(isset($codigo_librador_documento)) {
    require("guardar_documento_libradores.php");
    require("guardar_documento_libradores_envio.php");
}
require("guardar_documento_2.php");
require("guardar_documento_obs.php");
if($tipo_producto == 1) { // elaborado
    require("guarda_producto-elaborado.php");
}else if($tipo_producto == 2) { // compuesto
    require("guarda_producto-compuesto.php");
}else if($tipo_producto == 3 || $tipo_producto == 4) { // combo manual o combo automático
    require("guarda_producto-combo.php");
}
if ($tipo_librador == 'tak' || $tipo_librador == 'del') {
    require("guarda_producto-embalaje.php");
}

require("calcular_totales.php");
require("guardar_documento_1.php");

$select_sys = "lineas-documento";
require("datos-productos.php");
$logs->numeroProductos = $lineas_documento;

$logs->datos = $datos;

$logs->id_documento_1 = $id_documento_1;
$logs->id_documento_2 = $id_documento_2;
$logs->cantidad = $cantidad;
$logs->ejercicio = $ejercicio;
$logs->tipo_librador = $tipo_librador;
$logs->tipo_documento = $tipo_documento;
$logs->control_stock = $control_stock;
$logs->numero_documento = $numero_documento;
$logs->tipo_producto_sys = $tipo_producto;
$logs->id_usuario_despues = "ID usuario despues: ".$id_usuario;

echo json_encode($logs);