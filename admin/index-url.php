<?php
/*
Las variables que acaban en _sys son del sistema
Las variables que acaban en _url son las pasadas por URL GET
Los name y id de formularios se denominan con nombreCampo_nombreTabla
El resto de variables referentes a valores de campos de tablas se estructuran:
- para un único registro: $nombreCampo_nombreTabla
- para varios registros: $matriz_nombreCampo_nombreTabla
*/

$protocol = 'http://';

$host_base_sys = $protocol . $_SERVER['HTTP_HOST'] . "/";
$host = $protocol . $_SERVER['HTTP_HOST'] . "/";
$host_url = $host;
$host_idioma = $host;
$host_images = $protocol . $_SERVER['HTTP_HOST'] . "/images/";
$lang_sys = "es";
$locale_og_sys = "es_ES";
$descripcion_title_sys = "Administrador";
$robots_sys = "noindex, nofollow";

$color_fondo_pantalla = 'bg-blendi-35';

$id_idioma_sys = 4; // idioma castellano por defecto
$idioma_sys = "castellano";
$id_usuario_sys = 0;
$usuario_sys = "";
$id_terminal_sys = 1;
$dia_sys = "";
$hora_sys = "";

$ip_sys = "";
$id_panel_sys = 0;
$dominio_ftp_sys = "";
$revisar_tablas_sys = 0;
$acceso_correcto_sys = 0;

$ruta_sys = "";
$parametro_pagina = 0;
$parametro_resultados = 10;

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_sys = $_SERVER['HTTP_CLIENT_IP'];
} else {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_sys = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_sys = $_SERVER['REMOTE_ADDR'];
    }
}

/* PARAMETROS URL */
if(isset($_GET["url"])) {

    $path_url_sys = explode('/', $_GET["url"]);
    foreach ($path_url_sys as $key_sys => $valor_sys) {
        if($key_sys == 0) {
            if ($path_url_sys[0] == "usuarios-inicio") {
                $ruta_sys = "usuarios/inicio/";
                $color_fondo_pantalla = 'bg-blendi-600';
            } else if ($path_url_sys[0] == "gestion-productos") {
                $ruta_sys = "productos/";
            } else if ($path_url_sys[0] == "gestion-documentos") {
                $ruta_sys = "documentos/";
            } else if ($path_url_sys[0] == "gestion-productos-detalles") {
                $ruta_sys = "productos/detalles/";
            } else if ($path_url_sys[0] == "gestion-productos-grupos") {
                $ruta_sys = "productos/grupos/";
            } else if ($path_url_sys[0] == "gestion-productos-imagenes") {
                $ruta_sys = "productos/imagenes/";
            } else if ($path_url_sys[0] == "gestion-productos-listados-stocks") {
                $ruta_sys = "productos/listados/stocks/";
            } else if ($path_url_sys[0] == "gestion-productos-listados-mas-vendidos") {
                $ruta_sys = "productos/listados/mas-vendidos/";
            } else if ($path_url_sys[0] == "gestion-libradores") {
                $ruta_sys = "libradores/";
            } else if ($path_url_sys[0] == "gestion-categorias") {
                $ruta_sys = "categorias/";
            } else if ($path_url_sys[0] == "gestion-idiomas") {
                $ruta_sys = "idiomas/";
            } else if ($path_url_sys[0] == "gestion-diccionario") {
                $ruta_sys = "diccionario/";
            } else if ($path_url_sys[0] == "gestion-tipos-iva") {
                $ruta_sys = "iva/";
            } else if ($path_url_sys[0] == "gestion-grupos_clientes") {
                $ruta_sys = "grupos_clientes/";
            } else if ($path_url_sys[0] == "gestion-listados-iva") {
                $ruta_sys = "listados_iva/";
            } else if ($path_url_sys[0] == "gestion-listados-es") {
                $ruta_sys = "listados_es/";
            } else if ($path_url_sys[0] == "gestion-listados-mails") {
                $ruta_sys = "listados_mails/";
            } else if ($path_url_sys[0] == "gestion-listados-notificaciones-stock") {
                $ruta_sys = "listado_notificaciones_mail/";
            } else if ($path_url_sys[0] == "gestion-tipos-irpf") {
                $ruta_sys = "irpf/";
            } else if ($path_url_sys[0] == "gestion-comedores") {
                $ruta_sys = "mesas/comedores/";
            } else if ($path_url_sys[0] == "gestion-mesas") {
                $ruta_sys = "mesas/";
                $color_fondo_pantalla = 'bg-white';
            } else if ($path_url_sys[0] == "gestion-zonas") {
                $ruta_sys = "zonas/";
            } else if ($path_url_sys[0] == "gestion-categorias_elaborados") {
                $ruta_sys = "categorias_elaborados/";
            } else if ($path_url_sys[0] == "gestion-modalidades_envio") {
                $ruta_sys = "modalidades_envio/";
            } else if ($path_url_sys[0] == "gestion-modalidades_entrega") {
                $ruta_sys = "modalidades_entrega/";
            } else if ($path_url_sys[0] == "gestion-modalidades_pago") {
                $ruta_sys = "modalidades_pago/";
            } else if ($path_url_sys[0] == "gestion-suscripcion") {
                $ruta_sys = "suscripcion/";
            } else if ($path_url_sys[0] == "gestion-home") {
                $ruta_sys = "home/";
            } else if ($path_url_sys[0] == "gestion-metodos_pago") {
                $ruta_sys = "metodos_pago/";
            } else if ($path_url_sys[0] == "gestion-metodos_pago_bans") {
                $ruta_sys = "metodos_pago_bans/";
            } else if ($path_url_sys[0] == "gestion-bancos_cajas") {
                $ruta_sys = "bancos_cajas/";
            } else if ($path_url_sys[0] == "gestion-clientes") {
                $ruta_sys = "clientes/";
            } else if ($path_url_sys[0] == "gestion-tarifas") {
                $ruta_sys = "tarifas/";
            } else if ($path_url_sys[0] == "gestion-usuarios") {
                $ruta_sys = "usuarios/";
            } else if ($path_url_sys[0] == "gestion-datos_empresa") {
                $ruta_sys = "datos_empresa/";
            } else if ($path_url_sys[0] == "gestion-impresion_documentos") {
                $ruta_sys = "impresion_documentos/";
            } else if ($path_url_sys[0] == "gestion-iconos") {
                $ruta_sys = "iconos/";
            } else if ($path_url_sys[0] == "gestion-recepcion-pedidos") {
                $ruta_sys = $host_base_sys . "recepcion_pedidos/";
            } else if ($path_url_sys[0] == "gestion-datos_terminales") {
                $ruta_sys = "terminales/";
            }
        }else {
            $parametros_url = explode('=', $path_url_sys[$key_sys]);
            if($parametros_url[0] == "ajax") {
                $es_ajax = $parametros_url[1];
            }
            if($parametros_url[0] == "pagina") {
                $parametro_pagina= (int) $parametros_url[1] - 1;
            }
            if($parametros_url[0] == "resultados") {
                $parametro_resultados= (int) $parametros_url[1];
            }
            if($parametros_url[0] == "busqueda") {
                $parametro_busqueda= urldecode($parametros_url[1]);
            }
            if($parametros_url[0] == "habilitado") {
                $parametro_filtro_habilitado = urldecode($parametros_url[1]);
            }
            if($parametros_url[0] == "id") {
                $id_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_categorias") {
                $id_categorias_url = $parametros_url[1];
            }
            if($parametros_url[0] == "crear_subcategoria") {
                $crear_subcategoria_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_productos") {
                $id_productos_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_idiomas") {
                $id_idiomas_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_datos_empresa") {
                $id_datos_empresa_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_libradores") {
                $id_libradores_url = $parametros_url[1];
            }
            if($parametros_url[0] == "tipo") {
                $tipo_libradores_url = $parametros_url[1];
            }
            if($parametros_url[0] == "ejercicio") {
                $ejercicio_url = $parametros_url[1];
            }
            if($parametros_url[0] == "mostrar") {
                $mostrar_url = $parametros_url[1];
            }
            if($parametros_url[0] == "tipo_documento") {
                $tipo_documento_url = $parametros_url[1];
            }
            if($parametros_url[0] == "vista") {
                $vista_url = $parametros_url[1];
            }
            if($parametros_url[0] == "descarga") {
                $descarga_url = $parametros_url[1];
            }
            if($parametros_url[0] == "inicio") {
                $inicio_url = $parametros_url[1];
            }
            if($parametros_url[0] == "fin") {
                $fin_url = $parametros_url[1];
            }
            if (isset($tipo_libradores_url) && $tipo_libradores_url !== 'cli' && $tipo_libradores_url !== 'tak' && $tipo_libradores_url !== 'del' && $tipo_libradores_url !== 'mes' && $tipo_libradores_url !== 'pro' && $tipo_libradores_url !== 'cre') {
                throw new Exception('Un librador debe ser cliente, proveedor o creditor.');
            }
            if($parametros_url[0] == "id_libradores_zonas") {
                $id_libradores_zonas_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_categorias_elaborados") {
                $id_categorias_elaborados_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_libradores_modalidades_envio") {
                $id_libradores_modalidades_envio_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_libradores_modalidades_entrega") {
                $id_libradores_modalidades_entrega_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_libradores_modalidades_pago") {
                $id_libradores_modalidades_pago_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_iva") {
                $id_productos_iva_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_irpf") {
                $id_productos_irpf_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_bancos_cajas") {
                $id_bancos_cajas_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_tarifas") {
                $id_tarifas_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_usuarios") {
                $id_usuarios_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_ofertas") {
                $id_ofertas_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_productos_detalles") {
                $id_productos_detalles_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_productos_detalles_datos") {
                $id_productos_detalles_datos_url = $parametros_url[1];
            }
            if($parametros_url[0] == "ancla") {
                $ancla_url = $parametros_url[1];
            }
            if($parametros_url[0] == "ancla_ficha_modal") {
                $ancla_ficha_modal = $parametros_url[1];
            }
            if($parametros_url[0] == "apartado") {
                $apartado_url = $parametros_url[1];
            }
            if($parametros_url[0] == "tipo_producto") {
                $id_tipo_productos_relacionados = $parametros_url[1];
            }
            if($parametros_url[0] == "id_images") {
                $id_productos_images_url = $parametros_url[1];
            }
            if($parametros_url[0] == "datos-atributo") {
                $id_productos_detalles_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_relacion_atributo") {
                $id_productos_detalles_relacion_url = $parametros_url[1];
            }
            if($parametros_url[0] == "att_pral") {
                $id_atributo_principal = $parametros_url[1];
            }
            if($parametros_url[0] == "att_enl") {
                $id_productos_detalles_enlazado_url = $parametros_url[1];
            }
            if($parametros_url[0] == "att_mult") {
                $id_productos_detalles_multiples_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_pack") {
                $id_packs_url = $parametros_url[1];
            }
            if($parametros_url[0] == "att_unico") {
                $id_atributo_unico = $parametros_url[1];
            }
            if($parametros_url[0] == "id_ancla") {
                $id_ancla_url = $parametros_url[1];
            }
            if($parametros_url[0] == "buscar") {
                $buscar_por = $parametros_url[1];
            }
            if($parametros_url[0] == "texto") {
                $texto_buscar = $parametros_url[1];
            }
            if($parametros_url[0] == "id_grupos") {
                $id_productos_grupos_url = $parametros_url[1];
            }
            if($parametros_url[0] == "accion") {
                $accion_url = $parametros_url[1];
            }
            if($parametros_url[0] == "librado") {
                $librado_url = $parametros_url[1];
            }
            if($parametros_url[0] == "documento") {
                $documento_url = $parametros_url[1];
            }
            if($parametros_url[0] == "id_modelo") {
                $id_modelos = $parametros_url[1];
            }
            if($parametros_url[0] == "id_terminal") {
                $id_terminal = $parametros_url[1];
            }
            if($parametros_url[0] == "id_comedor") {
                $id_comedor = $parametros_url[1];
            }
        }
    }
}
if(isset($_POST["id_idioma"])) {
    $id_idiomas_url = $_POST["id_idioma"];
}
