<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);

session_start();
ob_start();
if (!isset($_SESSION["id_sesion"]))
{
    $_SESSION["id_sesion"] = session_id();
    $matriz_logs_sys[] = "Crear id sesion";
    $matriz_logs_sys[] = urlencode(json_encode($_SESSION));
}

$id_sesion_sys = $_SESSION["id_sesion"];
$matriz_logs_sys[] = "sesion: ".$id_sesion_sys;
$matriz_logs_sys[] = urlencode(json_encode($_SESSION));

require("index-url.php");
// Si $ruta_sys es empty, no accedir
require("index-iniciar.php");

if (isset($es_ajax) && !empty($es_ajax)) {
    if($acceso_correcto_sys != 0) {
        require($ruta_sys . "ajax/resultado.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="<?php echo $lang_sys; ?>" class="h-99-3 <?php if ($darkMode) { echo 'dark'; } ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="copyright" content="https://www.ciclotic.com" />
    <meta name="author" content="cicloTIC" />

    <meta name="robots" content="<?php echo $robots_sys; ?>" />

    <title><?php echo $descripcion_title_sys; ?></title>

    <link rel="canonical" href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/">

    <link href="<?php echo $host_base_sys."admin/"; ?>styles.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $host ?>css/flowbite.min.css" />

    <meta name="theme-color" content="#7952b3" />

    <script src="<?php echo $host ?>js/tailwind.js"></script>
    <?php
    if ($darkMode) {
        ?>
        <script src="<?php echo $host ?>js/tailwind-config-dark.js?ver=1.00"></script>
        <link rel="stylesheet" href="<?php echo $host ?>styles-dark.css" />
        <?php
    } else {
        ?>
        <script src="<?php echo $host ?>js/tailwind-config.js?ver=1.00"></script>
        <?php
    }
    ?>
    <script src="<?php echo $host ?>js/flowbite.js?ver=1.00"></script>
    <script src="<?php echo $host ?>js/socket.io.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="<?php echo $host_base_sys."admin/"; ?>script.js?ver=1.24" type="text/javascript"></script>
    <?php
    if(!empty($ruta_sys)) {
        if ($ruta_sys === 'mesas/') {
            ?>
            <script src="<?php echo $host_base_sys."admin/".$ruta_sys; ?>interact.min.js?ver=1.03" type="text/javascript"></script>
            <?php
        }
        ?>
        <script src="<?php echo $host_base_sys."admin/".$ruta_sys; ?>script.js?ver=1.07" type="text/javascript"></script>
        <?php
    }
    ?>
    <script src="<?php echo $host_base_sys ?>lib/kioskboard/kioskboard-aio-2.3.0.min.js"></script>

    <!-- Favicons -->
    <!--
    <link rel="apple-touch-icon" href="<?php echo $host_base_sys; ?>assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="<?php echo $host_base_sys; ?>assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php echo $host_base_sys; ?>assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="<?php echo $host_base_sys; ?>assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    -->
    <link rel="icon" href="<?php echo $host_base_sys; ?>favicon.ico">
    <meta name="theme-color" content="#7952b3">
</head>

<body class="d-flex flex-column h-99-3 dark:text-gray-600 m-0 <?php echo $color_fondo_pantalla; ?>">
    <?php
    if($acceso_correcto_sys == 0) {
        ?>
        <div class="grid-1 bg-header hidden">
            <div class="box bg-header">
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/">
                    <img src="<?php echo $host_base_sys; ?>images/logo.png" id="imagen-logo" class="w-300p"
                         alt=""
                         title="">
                </a>
            </div>
        </div>
        <?php
        $path_url_sys = explode('/', $_GET["url"]);
        if ($path_url_sys[0] == 'registro') {
            require("vistas/formulario-registro.php");
        } elseif ($path_url_sys[0] == 'registro-completar') {
            require("usuarios/gestion/registro.php");
            require("vistas/formulario-inicio.php");
        } else {
            require("vistas/formulario-inicio.php");
        }
        //require("vistas/footer.php");
    }else {
        if ($ruta_sys == 'usuarios/inicio/' &&
            (
                    (isset($step1_datos_configuracion_inicial) && $step1_datos_configuracion_inicial != 1) ||
                    (isset($step2_datos_configuracion_inicial) && $step2_datos_configuracion_inicial != 1) ||
                    (isset($step3_datos_configuracion_inicial) && $step3_datos_configuracion_inicial != 1) ||
                    (isset($step4_datos_configuracion_inicial) && $step4_datos_configuracion_inicial != 1)
            )
        ) {
            ?>
            <form id="formulario-steps-hidden" action="/admin/usuarios-inicio" target="_self" method="post">
                <input type="hidden" name="empresa" id="formulario-steps-hidden-empresa" value="<?php echo (isset($_POST['empresa']))? $_POST['empresa'] : ''; ?>" />
                <input type="hidden" name="clave" id="formulario-steps-hidden-clave" value="<?php echo (isset($_POST['clave']))? $_POST['clave'] : ''; ?>" />
            </form>
            <main class="w-full h-full home">
                <div class="grid grid-cols-1 sm:grid-cols-2 h-full">
                    <div class="items-center">
                        <div class="grid grid-cols-12 mt-20">
                            <div class="col-span-5">&nbsp;</div>
                            <div class="col-span-2">
                                <img src="/images/logo_white_sl.png" title="Blendi" />
                            </div>
                            <div class="col-span-5">&nbsp;</div>
                        </div>
                        <div class="mt-20 text-3xl text-white text-center w-full font-medium">
                            Tu restaurante
                        </div>
                        <div class="text-sm text-white text-center mt-3 w-full">
                            Introduce la información esencial de tu restaurante<br>
                            para empezar a configurar tu cuenta Blendi
                        </div>
                        <div id="logo_blendi_vector" class="relative w-full mt-20 mx-auto">
                            <div id="config-inicial-group-47">
                                <?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/group-47.svg'); ?>
                            </div>
                            <div id="config-inicial-group-74">
                                <?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/group-74.svg'); ?>
                            </div>
                            <div id="config-inicial-group-1033">
                                <?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/group-1033.svg'); ?>
                            </div>
                            <div id="config-inicial-group-1036">
                                <?php
                                if ($step1_datos_configuracion_inicial != 1) {
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/group-1036.svg');
                                } else if ($step2_datos_configuracion_inicial != 1) {
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/group-1036-2.svg');
                                } else if ($step3_datos_configuracion_inicial != 1) {
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/group-1036-3.svg');
                                } else if ($step4_datos_configuracion_inicial != 1) {
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/group-1036-4.svg');
                                }
                                ?>
                            </div>
                            <div id="config-inicial-lettuce-2">
                                <?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/lettuce-2.svg'); ?>
                            </div>
                            <div id="config-inicial-taco">
                                <?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/taco.svg'); ?>
                            </div>
                            <div id="config-inicial-vector-108">
                                <?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/vector-108.svg'); ?>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-12">
                            <div class="col-span-5">&nbsp;</div>
                            <div class="col-span-2 flex space-x-3">
                                <?php
                                if ($step1_datos_configuracion_inicial != 1) {
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse-checked.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                } else if ($step2_datos_configuracion_inicial != 1) {
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse-checked.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                } else if ($step3_datos_configuracion_inicial != 1) {
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse-checked.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                } else if ($step4_datos_configuracion_inicial != 1) {
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse.svg');
                                    echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/images/config-inicial/ellipse-checked.svg');
                                }
                                ?>
                            </div>
                            <div class="col-span-5">&nbsp;</div>
                        </div>
                    </div>
                    <div class="w-full bg-white backdrop-blur-lg px-3 sm:px-20 text-gray-450">
                        <?php
                        if ($step1_datos_configuracion_inicial != 1) {
                            ?>
                            <form action="#" id="config-step1">
                                <input type="hidden" name="config-step" value="1" />
                                <div class="mt-3 sm:mt-32">
                                    <label for="config-step1-nombre-fiscal" class="block mb-2 text-l">Nombre fiscal</label>
                                    <div>
                                        <input type="text" name="config-step1-nombre-fiscal" id="config-step1-nombre-fiscal" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="El buen gusto S.L." maxlength="45" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step1-telefono" class="block mb-2 text-l">Teléfono</label>
                                    <div>
                                        <input type="text" name="config-step1-telefono" id="config-step1-telefono" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="686 686 686" maxlength="20" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step1-nombre-comercial" class="block mb-2 text-l">Nombre de la empresa</label>
                                    <div>
                                        <input type="text" name="config-step1-nombre-comercial" id="config-step1-nombre-comercial" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="El buen gusto" maxlength="45" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step1-cif" class="block mb-2 text-l">CIF/NIF</label>
                                    <div>
                                        <input type="text" name="config-step1-cif" id="config-step1-cif" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="J65656565" maxlength="20" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step1-provincia" class="block mb-2 text-l">Provincia</label>
                                    <div>
                                        <input type="text" name="config-step1-provincia" id="config-step1-provincia" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="Barcelona" maxlength="45" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step1-cp" class="block mb-2 text-l">Código postal</label>
                                    <div>
                                        <input type="text" name="config-step1-cp" id="config-step1-cp" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="08242" maxlength="10" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step1-poblacion" class="block mb-2 text-l">Población</label>
                                    <div>
                                        <input type="text" name="config-step1-poblacion" id="config-step1-poblacion" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="Manresa" maxlength="45" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step1-direccion" class="block mb-2 text-l">Dirección</label>
                                    <div>
                                        <input type="text" name="config-step1-direccion" id="config-step1-direccion" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="C/ El Bruc, Nº 35 Local 1" maxlength="150" />
                                    </div>
                                </div>
                                <div class="flex space-x-3 mt-8">
                                    <button type="button" class="text-gray-650 bg-white border-2 border-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSteps('config-step1', true)" id="config-step1-omitir">Omitir paso</button>
                                    <button type="button" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSteps('config-step1', false)" id="config-step1-continuar">Continuar</button>
                                </div>
                            </form>
                            <?php
                        } else if ($step2_datos_configuracion_inicial != 1) {
                            $id_usuarios = 0;
                            $usuario_usuarios = "";
                            $password_usuarios = "";
                            $bloqueo_usuarios = 0;
                            $dark_usuarios = 0;
                            $avatar = '1';
                            ?>
                            <form action="#" id="config-step2">
                                <input type="hidden" name="config-step" value="2" />
                                <div class="mt-3 sm:mt-32 text-2xl font-medium">
                                    Usuarios
                                </div>
                                <div class="mt-3 flex items-center space-x-2">
                                    <?php
                                    $select_sys = "inicio";
                                    require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-select-php.php");
                                    foreach ($matriz_id_usuarios as $key_matriz_id_usuarios => $matriz_id_usuario) {
                                        $avatar = (empty($matriz_avatar_usuarios[$key_matriz_id_usuarios]))? null : $matriz_avatar_usuarios[$key_matriz_id_usuarios];
                                        if (!$avatar) {
                                            $avatar = substr($matriz_id_usuario, strlen($matriz_id_usuario) - 1, 1);
                                        }
                                        ?>
                                        <img src="/avatars/avatar<?php echo $avatar; ?>.svg?ver=1" style="width: 50px;"  />
                                        <div class="grow">
                                            <?php echo $matriz_usuario_usuarios[$key_matriz_id_usuarios]; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="mt-3 text-2xl font-medium">
                                    Nuevo usuario
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
                                    <div>
                                        <label for="usuario_usuarios">Nombre usuario:</label>
                                        <input type="text" name="usuario_usuarios" id="usuario_usuarios" placeholder="Nombre usuario" class="w-full" value="<?php echo $usuario_usuarios; ?>" maxlength="50" required />
                                    </div>
                                    <div>
                                        <label for="password_usuarios">Contraseña acceso:</label>
                                        <input type="text" name="password_usuarios" id="password_usuarios" placeholder="Contraseña acceso" class="w-full" value="<?php echo $password_usuarios; ?>" maxlength="20" required />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
                                    <div>
                                        <label for="usuario_usuarios">Permisos:</label><br>
                                        <select name="permisos_usuarios">
                                            <option value="1" selected>Gerente</option>
                                            <option value="2">Barra</option>
                                            <option value="3">Camarero</option>
                                            <option value="4">Cocina</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
                                    <div>
                                        <label for="avatar">Avatar:</label>
                                        <input type="hidden" name="avatar_usuarios" id="avatar_usuarios" value="<?php echo $avatar; ?>" />
                                        <img src="/avatars/avatar<?php echo $avatar; ?>.svg?ver=1" id="id_avatar_usuario" class="w-full p-2">
                                    </div>
                                    <div class="text-center">
                                        <button type="button" id="boton_editar_avatar" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="document.getElementById('capa_avatares').style.display='block'; document.getElementById('boton_editar_avatar').style.display='none'; document.getElementById('boton_listo_avatar').style.display='block';">Editar avatar</button>
                                        <button type="button" id="boton_listo_avatar" class="hidden text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="document.getElementById('capa_avatares').style.display='none'; document.getElementById('boton_editar_avatar').style.display='block'; document.getElementById('boton_listo_avatar').style.display='none';">Listo</button>
                                    </div>
                                    <div class="hidden text-center col-span-2" id="capa_avatares">
                                        <?php
                                        $avatares = 0;
                                        for ($bucle1 = 1 ; $bucle1 <= 4 ; $bucle1++) {
                                            ?>
                                            <div class="grid grid-cols-3 sm:grid-cols-6 mt-3 items-center">
                                                <?php
                                                for ($bucle2 = 1 ; $bucle2 <= 6 ; $bucle2++) {
                                                    ?>
                                                    <div>
                                                        <img src="/avatars/avatar<?php echo $avatares; ?>.svg?ver=1" class="w-full p-2" onclick="document.getElementById('id_avatar_usuario').src='/avatars/avatar<?php echo $avatares; ?>.svg?ver=1'; document.getElementById('avatar_usuarios').value=<?php echo $avatares; ?>">
                                                    </div>
                                                    <?php
                                                    $avatares += 1;
                                                    if($avatares == 21) {
                                                        break;
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if($avatares == 21) {
                                                break;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                                <input type="hidden" name="activo_usuarios" id="activo_usuarios_2" value="0" class="hidden" />

                                <div class="grid grid-cols-1 mt-3 items-center space-x-3">
                                    <div>
                                        <label>Night:</label><br>
                                        <div class="flex flex-wrap">
                                            <div onclick="activarElementoUnicoFicha('dark_usuarios_1', 'capa_dark_usuarios_1', 'capa_unicos_dark_usuarios')" id="capa_dark_usuarios_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_dark_usuarios poin">
                                                <div class="font-bold text-left mr-2">
                                                    Si
                                                </div>
                                                <div id="contracheck_dark_usuarios_1" class="hidden w-6 h-6 contracheck_capa_unicos_dark_usuarios">
                                                    &nbsp;
                                                </div>
                                                <div id="check_dark_usuarios_1" class="hidden check_capa_unicos_dark_usuarios">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <input type="radio" name="dark_usuarios" id="dark_usuarios_1" value="1" class="hidden" />
                                                <?php
                                                if ($dark_usuarios == 1) {
                                                    ?>
                                                    <script type="text/javascript">
                                                        activarElementoUnicoFicha('dark_usuarios_1', 'capa_dark_usuarios_1', "capa_unicos_dark_usuarios");
                                                    </script>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div onclick="activarElementoUnicoFicha('dark_usuarios_2', 'capa_dark_usuarios_2', 'capa_unicos_dark_usuarios')" id="capa_dark_usuarios_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_dark_usuarios">
                                                <div class="font-bold text-left mr-2">
                                                    No
                                                </div>
                                                <div id="contracheck_dark_usuarios_2" class="hidden w-6 h-6 contracheck_capa_unicos_dark_usuarios">
                                                    &nbsp;
                                                </div>
                                                <div id="check_dark_usuarios_2" class="hidden check_capa_unicos_dark_usuarios">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <input type="radio" name="dark_usuarios" id="dark_usuarios_2" value="0" class="hidden" />
                                                <?php
                                                if ($dark_usuarios != 1) {
                                                    ?>
                                                    <script type="text/javascript">
                                                        activarElementoUnicoFicha('dark_usuarios_2', 'capa_dark_usuarios_2', "capa_unicos_dark_usuarios");
                                                    </script>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="id_terminal_usuarios" name="id_terminal_usuarios" value="-1" />
                                <div class="flex space-x-3 mt-8">
                                    <button type="button" class="text-gray-650 bg-white border-2 border-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSteps('config-step2', true)" id="config-step2-omitir">Omitir paso</button>
                                    <button type="button" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSteps('config-step2', false)" id="config-step2-continuar">Guardar usuario</button>
                                </div>
                            </form>
                            <?php
                        } else if ($step3_datos_configuracion_inicial != 1) {
                            ?>
                            <div class="mt-3 sm:mt-32 text-2xl font-medium">
                                Logo
                            </div>
                            <div class="grid grid-cols-1 mt-3 items-center space-x-3" id="capa_li_imagen">
                                <?php
                                $id_images_sys = 1;
                                $sub_id_images_sys = 0;
                                $imagen_sys = $logo_datos_empresa;
                                $updated_sys = $updated_datos_empresa;
                                $alt_sys = $nombre_comercial_datos_empresa;
                                $tittle_sys = $nombre_comercial_datos_empresa;
                                $destino_sys = "datos_empresa";
                                $modulo_renombrar = "datos_empresa";
                                $tabla = "datos_empresa";
                                $id_renombrar = 1;
                                $etiqueta_id_retorno = "id_datos_empresa";
                                $link_otros = "";
                                $eliminar_imagen_disabled = true;
                                $nombre_imagen_sys = explode(".",$logo_datos_empresa);
                                $username = (isset($_POST['empresa']) && !empty($_POST['empresa']))? $_POST['empresa'] : null;
                                $password = (isset($_POST['clave']) && !empty($_POST['clave']))? $_POST['clave'] : null;
                                require($_SERVER['DOCUMENT_ROOT']."/admin/componentes/form-images.php");
                                ?>
                            </div>
                            <div class="mt-7 text-2xl font-medium">
                                Tu negocio
                            </div>
                            <form action="#" id="config-step3">
                                <input type="hidden" name="config-step" value="3" />
                                <div class="mt-3">
                                    <label for="config-step3-espacios" class="block mb-2 text-l">Espacios</label>
                                    <div>
                                        <input type="text" name="config-step3-espacios" id="config-step3-espacios" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="Comedor, Barra, Terraza" maxlength="100" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step3-tarifas" class="block mb-2 text-l">Tarifas</label>
                                    <div>
                                        <input type="text" name="config-step3-tarifas" id="config-step3-tarifas" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="Sala, Terraza, Take away" maxlength="100" />
                                    </div>
                                </div>
                                <div class="flex space-x-3 mt-8">
                                    <button type="button" class="text-gray-650 bg-white border-2 border-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSteps('config-step3', true)" id="config-step3-omitir">Omitir paso</button>
                                    <button type="button" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSteps('config-step3', false)" id="config-step3-continuar">Continuar</button>
                                </div>
                            </form>
                            <?php
                        } else if ($step4_datos_configuracion_inicial != 1) {
                            ?>
                            <form action="#" id="config-step4">
                                <input type="hidden" name="config-step" value="4" />
                                <div class="mt-3 sm:mt-32">
                                    <label for="config-step4-iva" class="block mb-2 text-l">Precio PVP</label>
                                    <div class="flex space-x-2 items-center">
                                        <input type="radio" name="config-step4-iva" id="config-step4-iva" checked value="1" />
                                        <div>
                                            Precios con IVA incluido
                                        </div>
                                        <input type="radio" name="config-step4-iva" id="config-step4-iva" class="ml-5" value="0" />
                                        <div>
                                            Precios sin IVA
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="config-step4-metodos-pago" class="block mb-2 text-l">Métodos de pago</label>
                                    <div>
                                        <input type="text" name="config-step4-metodos-pago" id="config-step4-metodos-pago" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="Efectivo, Tarjeta" maxlength="100" />
                                    </div>
                                </div>
                                <div class="flex space-x-3 mt-8">
                                    <button type="button" class="text-gray-650 bg-white border-2 border-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSteps('config-step4', true)" id="config-step4-omitir">Omitir paso</button>
                                    <button type="button" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSteps('config-step4', false)" id="config-step4-continuar">Continuar</button>
                                </div>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </main>
            <?php
        } else if ($ruta_sys == 'home/') {
            require("home.php");
        } else if ($ruta_sys == 'suscripcion/') {
            ?>
            <main class="w-full h-full home">
                <form action="#" id="config-suscripcion" class="grid grid-cols-1 sm:grid-cols-2 h-full">
                    <div class="items-center bg-blendi-600">
                        <div class="grid grid-cols-12 mt-20">
                            <div class="col-span-4">&nbsp;</div>
                            <div class="col-span-2">
                                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/tiquets/<?php echo $id_sesion_sys; ?>/tpv/ventas-inicio" title="TPV" class="text-white" id="link-suscripcion-back">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                                    </svg>
                                </a>
                            </div>
                            <div class="col-span-2">
                                <img src="/images/logo_white_sl.png" title="Blendi" />
                            </div>
                            <div class="col-span-4">&nbsp;</div>
                        </div>
                        <div class="mt-12 text-2xl text-white text-center w-full font-medium underline">
                            Detalles de tu suscripción
                        </div>
                        <div class="grid grid-cols-12 text-white text-left mt-6 w-full">
                            <div class="col-span-2">&nbsp;</div>
                            <div class="col-span-8">
                                <div class="w-full text-xl font-medium">
                                    Software:
                                </div>
                                <div class="w-full text-xs">
                                    Elige una de las siguientes opciones
                                </div>
                                <div class="w-full mt-2 flex space-x-5 items-center">
                                    <input type="radio" name="software-compra" id="software-compra-1" value="1" data-precio="650" onclick="suscripcionModificarIVAyTotal()" class="text-black" />
                                    <div class="grow">
                                        <div class="text-xl">
                                            Compra del software
                                        </div>
                                        <div class="text-xs">
                                            Pago único de 650€
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-2 flex space-x-5 items-center">
                                    <input type="radio" name="software-compra" id="software-compra-2" checked value="0" data-precio="30" onclick="suscripcionModificarIVAyTotal()" class="text-black" />
                                    <div class="grow">
                                        <div class="text-xl">
                                            Suscripción sin compra
                                        </div>
                                        <div class="text-xs">
                                            Pago mensual adicional de 30€/mes durante 24 meses, apartir del mes 25 pago de 20€/mes
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">&nbsp;</div>
                        </div>
                        <div class="grid grid-cols-12 text-white text-left mt-6 w-full">
                            <div class="col-span-2">&nbsp;</div>
                            <div class="col-span-8">
                                <div class="w-full text-xl font-medium">
                                    Plan Blendi:
                                </div>
                                <div class="w-full text-xs">
                                    Elige una de las siguientes opciones
                                </div>
                                <div class="w-full mt-2 flex space-x-5 items-center">
                                    <input type="radio" name="software-plan" id="software-plan-1" checked value="1" data-precio="55" onclick="suscripcionModificarIVAyTotal()" class="text-black" />
                                    <div class="text-xl">
                                        Blendi Basic
                                    </div>
                                    <div class="grow text-right text-xl">
                                        55.00 €/mes
                                    </div>
                                </div>
                                <div class="w-full mt-2 flex space-x-5 items-center">
                                    <input type="radio" name="software-plan" id="software-plan-2" value="2" data-precio="69" onclick="suscripcionModificarIVAyTotal()" class="text-black" />
                                    <div class="text-xl">
                                        Blendi PRO
                                    </div>
                                    <div class="grow text-right text-xl">
                                        69.00 €/mes
                                    </div>
                                </div>
                                <div class="w-full mt-2 flex space-x-5 items-center">
                                    <input type="radio" name="software-plan" id="software-plan-3" value="3" disabled data-precio="119" onclick="suscripcionModificarIVAyTotal()" class="text-black" />
                                    <div class="text-xl">
                                        Blendi Genius
                                    </div>
                                    <div class="grow text-right text-xl">
                                        119.00 €/mes
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">&nbsp;</div>
                        </div>
                        <div class="grid grid-cols-12 text-white text-left mt-6 w-full">
                            <div class="col-span-2">&nbsp;</div>
                            <div class="col-span-8">
                                <div class="w-full text-xl font-medium">
                                    Terminales:
                                </div>
                                <div class="w-full text-xs">
                                    Todos los planes tienen 3 terminales incluidos
                                </div>
                                <div class="w-full mt-2 flex space-x-5 items-center">
                                    <div class="text-xl">
                                        Añade más
                                    </div>
                                    <div class="grow text-right text-xl">
                                        <select class="w-full text-black" name="terminales-adicionales" id="terminales-adicionales" onchange="suscripcionModificarIVAyTotal()">
                                            <option value="0" selected>Ninguno adicional</option>
                                            <option value="1">1 adicional</option>
                                            <option value="2">2 adicionales</option>
                                            <option value="3">3 adicionales</option>
                                            <option value="4">4 adicionales</option>
                                            <option value="5">5 adicionales</option>
                                            <option value="6">6 adicionales</option>
                                            <option value="7">7 adicionales</option>
                                            <option value="8">8 adicionales</option>
                                            <option value="9">9 adicionales</option>
                                            <option value="10">10 adicionales</option>
                                            <option value="11">11 adicionales</option>
                                            <option value="12">12 adicionales</option>
                                            <option value="13">13 adicionales</option>
                                            <option value="14">14 adicionales</option>
                                            <option value="15">15 adicionales</option>
                                            <option value="16">16 adicionales</option>
                                            <option value="17">17 adicionales</option>
                                            <option value="18">18 adicionales</option>
                                            <option value="19">19 adicionales</option>
                                            <option value="20">20 adicionales</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">&nbsp;</div>
                        </div>
                        <div class="grid grid-cols-12 text-white text-left mt-6 w-full">
                            <div class="col-span-2">&nbsp;</div>
                            <div class="col-span-8">
                                <div class="w-full text-sm">
                                    Resumen de tu selección
                                </div>
                            </div>
                            <div class="col-span-2">&nbsp;</div>
                        </div>
                        <div class="grid grid-cols-12 text-white text-left w-full">
                            <div class="col-span-2">&nbsp;</div>
                            <div class="col-span-8 border-b border-t border-white">
                                <div class="w-full mt-2 flex space-x-2 items-center">
                                    <div class="text-xl">
                                        Software
                                    </div>
                                    <div class="grow text-right text-xl" id="software-total">
                                        30.00
                                    </div>
                                    <div class="text-xl">
                                        €
                                    </div>
                                </div>
                                <div class="w-full flex space-x-2 items-center">
                                    <div class="text-xl">
                                        Plan Blendi
                                    </div>
                                    <div class="grow text-right text-xl" id="plan-total">
                                        55.00
                                    </div>
                                    <div class="text-xl">
                                        €
                                    </div>
                                </div>
                                <div class="w-full flex space-x-2 items-center">
                                    <div class="text-xl">
                                        Terminales
                                    </div>
                                    <div class="grow text-right text-xl" id="terminales-total">
                                        0.00
                                    </div>
                                    <div class="text-xl">
                                        €
                                    </div>
                                </div>
                                <div class="w-full mb-2 flex space-x-2 items-center">
                                    <div class="text-xl">
                                        IVA
                                    </div>
                                    <div class="grow text-right text-xl" id="pagar-iva">
                                        17.85
                                    </div>
                                    <div class="text-xl">
                                        €
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">&nbsp;</div>
                        </div>

                        <div class="grid grid-cols-12 text-white text-left mt-3 mb-6 w-full">
                            <div class="col-span-2">&nbsp;</div>
                            <div class="col-span-8">
                                <div class="w-full mb-2 flex space-x-2 items-center font-medium">
                                    <div class="text-xl">
                                        Total a pagar hoy
                                    </div>
                                    <div class="grow text-right text-xl" id="pagar-total">
                                        102.85
                                    </div>
                                    <div class="text-xl">
                                        €
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">&nbsp;</div>
                        </div>
                    </div>
                    <div class="w-full bg-white backdrop-blur-lg px-3 sm:px-20 text-gray-450">
                        <input type="hidden" name="config-suscripcion" value="1" />
                        <div class="mt-3 sm:mt-32">
                            <label for="config-suscripcion-iban" class="block mb-2 text-l">IBAN</label>
                            <div>
                                <input type="text" name="config-suscripcion-iban" id="config-suscripcion-iban" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="ES00 0000 0000 0000 0000 0000" maxlength="45" />
                            </div>
                        </div>
                        <div class="flex space-x-3 mt-8">
                            <button type="button" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="sendFromSuscription()" id="config-suscripcion-continuar">Suscribirse</button>
                            <?php
                            if (!empty($iban_datos_empresa)) {
                                ?>
                                <button type="button" class="text-gray-650 bg-white border-2 border-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="document.getElementById('config-suscripcion-iban').value=''; sendFromSuscription()" id="config-cancelar-suscripcion-continuar">Cancelar suscripción</button>
                                <?php
                            }
                            ?>
                        </div>

                        <?php
                        if (!empty($iban_datos_empresa) && $software_blendi_datos_empresa !== null && $plan_blendi_datos_empresa !== null && $teminales_adicionales_datos_empresa !== null) {
                            ?>
                            Opciones actuales:<br>
                            Sofware: <?php echo ($software_blendi_datos_empresa)? 'Compra única' : 'Mensual'; ?><br>
                            Plan: <?php echo ($plan_blendi_datos_empresa == 1)? 'Basic' : ''; ?><?php echo ($plan_blendi_datos_empresa == 2)? 'PRO' : ''; ?><?php echo ($plan_blendi_datos_empresa == 3)? 'Genius' : ''; ?><br>
                            Terminales adicionales: <?php echo ($teminales_adicionales_datos_empresa)? $teminales_adicionales_datos_empresa : '0'; ?><br>
                            Fecha del primer pago: <?php echo ($fecha_inicio_plan_datos_empresa)? $fecha_inicio_plan_datos_empresa->format('Y-m-d') : ''; ?>
                            <?php
                        }
                        ?>
                    </div>
                </form>
            </main>
            <?php
        } else {

            require("vistas/cabecera.php");
            ?>
            <div class="bg-main pt-20">
                <div id="main">
                    <?php
                    require($ruta_sys . "vistas/pantalla-inicio.php");
                    ?>
                </div>
            </div>
            <button id="botonOpenModalFicha" class="hidden" type="button" data-modal-toggle="capa-ficha-modal">
                Toggle modal
            </button>
            <div id="capa-ficha-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full justify-center items-center">
                <div class="relative p-4 w-full h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-gray-70 shadow dark:bg-blendi-35">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-4">
                            <h3 class="text-xl font-semibold" id="titulo-ficha-modal">
                                Ficha
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="cerrarFicha()">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Cerrar pantalla</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="w-full overflow-y-auto bg-white" id="body-ficha-modal">
                            Cargando ficha...
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-end p-6 space-x-2 bg-white">
                            <div>&nbsp;</div>
                            <div class="flex items-center justify-end space-x-2 bg-white" id="botones_por_defecto_ficha">
                                <button onclick="cerrarFicha()" type="button" class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5">Descartar</button>
                                <button type="button" class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="guardarFicha('eliminar');" id="boton-eliminar-ficha-modal">Eliminar</button>
                                <button type="button" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="guardarFicha('guardar');" id="boton-guardar-ficha-modal">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <!--<div id="div-totop" class="cmn-divfloat" onclick="window.scrollTo(0, 0);">
        <img class="icono-totop" src="<?php echo $host_base_sys; ?>icons/System/arrow-drop-up-line.svg" alt="My Happy SVG" />
    </div>-->

    <div id="notificaciones-mensajes" class="fixed bottom-2 right-2 bg-white dark:text-black p-3 w-1/4 hidden">
        <div id="notificaciones-mensajes-titulo" class="text-md font-bold">
            &nbsp;
        </div>
        <div id="notificaciones-mensajes-body" class="text-sm">
            &nbsp;
        </div>
    </div>

    <script>
        window.addEventListener('load', (event) => {
            console.log("Ruta: <?php echo $ruta_sys; ?>");

            setCapaBodyFichaModalHeight();

            <?php
            if($acceso_correcto_sys == 0) {
                ?>
                console.log("0");
                if(document.getElementById("empresa")) {
                    document.getElementById("empresa").focus();
                }
                if(document.getElementById("password_usuarios_1")) {
                    document.getElementById("password_usuarios_1").focus();
                }
                <?php
            }else {
                ?>
                console.log("1 de 3");
                if(document.getElementById('link-cerrar-tpv')) {
                    console.log("2/2 de 3");
                    document.getElementById('link-cerrar').style.display = 'block';
                }
                <?php
            }
            if(isset($matriz_logs_sys)) {
                foreach ($matriz_logs_sys as $key => $valor) {
                    echo 'console.log("'.$valor.'");';
                }
            }
            ?>

            if (anclaFichaModal) {
                abrirFicha(anclaFichaModal);
            }
            console.log("3 de 3");
        });

        /*(function() {
            const $divtop = document.getElementById("div-totop");
            addEventListener("scroll", function() {
                if(window.scrollY < document.querySelector('div#main').offsetTop) {
                    $divtop.style.display = "none";
                }else {
                    $divtop.style.display = "block";
                }
            })
        })()*/

    </script>
    <script type="application/javascript">
        if (location.host == 'software.blendi.es') {
            const socket = io("blendinotifications.es:9000");

            let sendMessage = function (panel, terminal, message) {
                console.log('SendMessage: Socket not connected');
            }
            let assignPanelAndTerminal = function (panel, terminal) {
                console.log('AssignPanelAndTerminal: Socket not connected');
            }

            socket.on("connect", () => {
                console.log(socket.id);

                sendMessage = function (panel, terminal, message) {
                    // send a message to the server
                    socket.emit("sendMessage", panel, terminal, message);
                }
                assignPanelAndTerminal = function (panel, terminal) {
                    // assign panel and terminal to the server
                    socket.emit("assignPanelAndTerminal", panel, terminal);
                }

                // receive a message from the server
                socket.on("newMessage", (...message) => {
                    let notificaciones = document.getElementById('notificaciones-mensajes');
                    if (notificaciones) {
                        let notificacionesTitulo = document.getElementById('notificaciones-mensajes-titulo');
                        let notificacionesBody = document.getElementById('notificaciones-mensajes-body');

                        if (notificacionesTitulo && notificacionesBody) {
                            notificacionesTitulo.innerHTML = "Nueva notificación";
                            notificacionesBody.innerHTML = message;

                            notificaciones.classList.remove('hidden');

                            ocultarNotificaciones = setTimeout(function () {
                                let notificaciones = document.getElementById('notificaciones-mensajes');
                                if (notificaciones) {
                                    notificaciones.classList.add('hidden');
                                }
                            }, 10000);
                        }
                    }
                });

                assignPanelAndTerminal('<?php echo $id_panel_sys; ?>', '<?php echo (empty($id_terminal_sys)) ? '1' : $id_terminal_sys; ?>');
            });
        }
    </script>
</body>
</html>
<?php
$length = ob_get_length();
header('Content-Length: '.$length);
